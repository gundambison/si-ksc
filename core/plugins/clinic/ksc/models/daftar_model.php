<?php
class Models_Clinic_Ksc_Daftar_model extends Base_Model {
var $table='klinik_daftar'; //main table
/*
	Detail Daftar berdasarkan id
*/
	public function detail($id,$field='daf_id')
	{
		$sql=sprintf("select 
		`daf_id`, `daf_timeEnter`, `daf_timeArrive`, `daf_userInp`, `daf_comment`, `daf_enable`, `daf_deleteBy`
		from 
		`{$this->table}` 
		where `%s`='%s'",$field, $id);
		$data=$this->resOne($sql,1);
		if(count($data)>1){
			$row=$this->cleanFieldName('daf_',$data);
			$row['anamnesa']=$this->anamDaf($id);
			$sql="SELECT `dd_rujuk` rujuk, `dd_pat` pat, `dd_doc` doc, `dd_pay` pay0, `dd_other` other, dpp_type pay2 FROM 
			`klinik_daftardetail`, klinik_daftarpasienpay  
			WHERE `dd_daf`=$id and dd_daf=dpp_daf";
			$dt=$this->resOne($sql);
			if($dt['doc']==0){
				$sql2="select dafpat_docid doc from klinik_daftarpasien where dafpat_dafid=$id order by dafpat_id asc limit 1";
				$dt2=$this->resOne($sql2);
				$sql2="update klinik_daftardetail set dd_doc=$dt2[doc] where dd_daf=$id";
				$sql=$this->query($sql2,1);
				$dt=$this->resOne($sql);
			}
			$row['detail']=$dt;
			$row['doc_id']=$dt['doc'];
			$row['pat_id']=$dt['pat'];
			
			$dt=array();
			$sql="select count(dd_diag) total from klinik_daftardiagnosa,klinik_diagnosa where dd_daf=$id and d_id=dd_diag";
			$data=$this->resOne($sql,1);
			if($data['total']!=0){
				$sql="select dd_diag,d_code1,d_code2,d_index,d_name from klinik_daftardiagnosa,klinik_diagnosa where dd_daf=$id and d_id=dd_diag";
				$dt=$this->_fetchAll($sql);
			}
			$row['diagnosa']=$dt;
			
			$row['type']='cash';
			$sql="select  dpi_ins ins,dpi_card card, dpi_polis polis, dpi_name cardname, dpi_comp comp,ins_name name  from 
			klinik_daftarpasienins left join klinik_asuransi on ins_id=dpi_ins 
			where dpi_daf=$id";
			$dt=$this->resOne($sql);
			$row['asuransi']=$dt;
			if( count($dt)!=0 ) $row['type']='asuransi';
				
			$sql="select  dpc_nip nip,dpc_parent name, dpc_comp comp1, dpc_comp2 comp2  
			from klinik_daftarpasiencomp left join klinik_company on com_id = dpc_comp
			where dpc_daf=$id";
			$dt=$this->resOne($sql);
			$row['perusahaan']=$dt;
			if( count($dt)!=0 ) $row['type']='perusahaan';
			
			ksort($row);
			return $row;
		}
		else{
			return false;
		}
	}
	
	public function anamDaf($id){
		$sql="select da_text text from klinik_daftaranam where da_daf=$id";
		return $this->resOne($sql,1);
	
	}
	
	public function addDetail($daf,$daftar ){
		$sql0="INSERT INTO `klinik_daftardetail` (`dd_daf`,dd_pat,dd_doc,dd_other) 
		select dafpat_dafid,dafpat_patid,dafpat_docid,'add automatis' from klinik_daftarpasien dp left join klinik_daftardetail dd on dafpat_dafid=dd_daf where dd_daf is null and dafpat_type=0 group by dafpat_dafid";
		$sql="select count(dd_daf) c from  klinik_daftardetail where dd_daf=$daf and dd_pat>0";
		$row=$this->resOne($sql);
		if($row['c']==0){			 
			$sql="INSERT INTO `klinik_daftardetail` (`dd_daf`,dd_pat,dd_doc,dd_other)values( $daf, {$daftar['patid']},{$daftar['docid']},'add automatis')";
			$sql="select count(dd_daf) c from  klinik_daftardetail where dd_daf=$daf";
			$row2=$this->resOne($sql);	
			$data=array('dd_daf'=>$daf, 
			'dd_pat'=>$daftar['patid'],
			'dd_doc'=>$daftar['docid'],
			);
			if($row2['c']==1){
				$sql="SELECT `dd_rujuk` rujuk, `dd_pat` pat, `dd_doc` doc, `dd_pay` pay0, `dd_other` other, dpp_type pay2 FROM 
			`klinik_daftardetail`, klinik_daftarpasienpay  
			WHERE `dd_daf`=$id and dd_daf=dpp_daf";
				$daftarDetail=$this->resOne($sql);
				$sql="delete from klinik_daftardetail where dd_daf=$daf";
				$this->query($sql,1);
				$data['dd_other']='update:'.json_encode($daftarDetail);
			}
			else{ 
			$data['dd_other']='add automatis'; 
			}
			
			return $this->insertData('klinik_daftardetail',$data);
		}else{ return true; }
		
	}
/*
	Total Daftar  
*/	
	public function total()
	{
		$sql=sprintf("select count(daf_id) c from `%s`",
		$this->table);
		$data=$this->resOne($sql);
		return (int)$data['c'];
		
	}
/*
	Detail Daftar berdasarkan id
*/	
	public function getAll( )
	{
		$sql=sprintf("select 
		`daf_id`, `daf_timeEnter`, `daf_timeArrive`, `daf_userInp`, `daf_comment`, `daf_enable`, `daf_deleteBy`
		from 
		`{$this->table}` 
		limit %d", 150); //max untuk hal tak di inginkan
		$query=$this->query($sql,1 ); //debug
		if($query){
			$result=array();
			foreach( $this->_fetchAll($query) as $data ){				 
				$row=$this->cleanFieldName('daf_',$data);
				$result[]=$row;				 
			}
			return $result;
		}
		else{
			return false;		
		}
	}
	
	function showTarif($daf){
		$sql="SELECT dafJas_tarifID tarif_id, tarif_name name, dafJas_tarifprice price, dafjas_num num,(dafJas_tarifprice*dafjas_num) subtotal, dafjas_userid uid, dafjas_time time
		FROM `klinik_daftartarif` left join klinik_tarif on tarif_id=dafJas_tarifID
		WHERE `dafJas_dafid` =$daf";
		$query=$this->query($sql,1 ); //debug
		if($query){
			$result=array();
			foreach( $this->_fetchAll($query) as $data ){				 
				$row=$this->cleanFieldName('daf_',$data);
				$result[]=$row;				 
			}
			return $result;
		}
		else{
			return false;		
		}
	}
/*
	Insert data 
	list field tersedia : `daf_id`, `daf_timeEnter`, `daf_timeArrive`, `daf_userInp`, `daf_comment`, `daf_enable`, `daf_deleteBy` 
	id : daf_id
*/
	private function maxId(){
		$sql="select max(daf_id) n from {$this->table}";
		$dt=$this->resOne($sql);
		return $dt['n'];
	}
	public function add($data){
		//$id=$this->idTable('daf_',$this->maxId() );
//tambahkan detail yang kurang	
		$id=$this->maxId() + 1;
		$data['daf_id']=$id;
		$this->idTable('daf_',$id );
		$this->logger->write('debug', 'Act:Add data:'.json_encode($data));
		$insert = $this->insertData($this->table, $data,1 ); //saran biarkan ada log 
		if($insert){
			return $id;
		}
		else{
			return false;
		}		
	}
	
/*
	Update Data table utama.
*/
	public function update($data, $key)
	{
		$sql="update {$this->table} set ";
//tambahkan detail yang kurang
		$this->logger->write('debug', 'Act:Update data:'.json_encode($data));
		$fields=array();
		foreach($data as $name=>$value)
		{
			$fields[]="$name='".$this->conn->real_escape_string($value)."' ";					
		}
		
		$sql.=implode(",", $fields); 
		$key="daf_id='$key'";
		$sql.="where $key";
	
		$query=$this->query($sql,1 ); //debug
		if($query){
			return true;
		}
		else{
			return false;		
		}
		
	}
	
	function listByDate($date ){
		
		$sql=sprintf("select d.*,u.name real_name,u.username username from %s d left join %s u on daf_userInp=u.id
		where daf_timeEnter like '%s' limit 40", $this->table, 'jos_users',  $date."%");
		
		$query=$this->query($sql,1 ); //debug
		if($query){
			$result=array();
			foreach( $this->_fetchAll($query) as $row ){ 
				$data=array(
				  'daftar'=>$row,
				  'daf_id'=>$row['daf_id']				  
				);
				$sql=sprintf("select * from klinik_daftaranam where da_daf=%s", $row['daf_id'] ); 
				$sql=$this->query($sql,1 );
				$data['anam']=$this->_fetchAll($sql);
				
				$sql=sprintf("select * from klinik_daftardetail where dd_daf=%s", $row['daf_id'] );
				$sql=$this->query($sql,1 );
				$data['daftarDetail']=$this->_fetchAll($sql);
				
				$sql=sprintf("select * from klinik_daftarekses where ekses_daf=%s", $row['daf_id'] );
				$sql=$this->query($sql,1 );
				$data['daftarEkses']=$this->_fetchAll($sql);
				
				//klinik_daftarpasiencancel 
				$sql=sprintf("select c.* from klinik_daftarpasiencancel c, %s 
				where dafPatCan_dafpatid=dafpat_id and
				dafpat_dafid=%s", 'klinik_daftarpasien', $row['daf_id'] );
				$sql=$this->query($sql,1 );
				$data['daftarPasienCancel']=$this->_fetchAll($sql);
				
				$sql=sprintf("select * from  klinik_daftarpasiencomp where dpc_daf=%s", $row['daf_id'] );
				$sql=$this->query($sql,1 );
				$data['daftarComp']=$this->_fetchAll($sql);
				
				$sql=sprintf("select * from klinik_daftarpasienins where dpi_daf=%s", $row['daf_id'] );
				$sql=$this->query($sql,1 );
				$data['daftarIns']=$this->_fetchAll($sql);
				
				$sql=sprintf("select dpp_type type from klinik_daftarpasienpay where dpp_daf=%s", $row['daf_id'] );
				$r=$this->resOne($sql);
				switch ($r['type']){
					case 1: $data['pay']='Tunai'; break;
					case 2: $data['pay']='Company'; break;
					case 3: $data['pay']='Insurance'; break;
					defaut: $data['pay']='Other ('.$r['type'].")";   
				}	
				
				$sql=sprintf("select d.*,tarif_name,tarif_price priceNow from  klinik_daftartarif d
				left join klinik_tarif t on tarif_id=dafJas_tarifID
				where dafJas_dafid=%s", $row['daf_id'] );
				$sql=$this->query($sql,1 );
				$data['daftarTarif']=$this->_fetchAll($sql); 
				
				$result[]=$data;				 
			}
			return $result;
		}
		else{
			return false;		
		}
	}

/*
	Start 
*/
	public function __construct(){
		parent::__construct();
		$this->loadConnection('default');
		$this->logger->write('info', 'model: Daftar');
	}
	
}