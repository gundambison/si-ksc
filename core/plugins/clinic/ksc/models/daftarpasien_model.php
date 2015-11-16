<?php
/*
2015-10-19
	function listSearch()
*/
class Models_Clinic_Ksc_Daftarpasien_model extends Base_Model {
var $table='klinik_daftarpasien'; //main table
var $tablePay='klinik_daftarpasienpay';
var $tableDetail='klinik_daftardetail';
/*
	Detail Daftarpasien berdasarkan id
*/
	public function searchId($condition=''){
		$sql=sprintf("select 
		count(`dafpat_id`) c, dafpat_id id
		from 
		`{$this->table}` 
		where %s",$condition );
		$data=$this->resOne($sql,1);
		if(count($data)>1){			 
			return $data;
		}
		else{
			return false;
		}
		
	}
	
	function listByPasien($patid){
		$sql='SELECT dafpat_id id
			 FROM `klinik_daftar` as daf, 
			 klinik_daftarpasien as dafPat, 
			 klinik_pasien as pat
			where
			daf.daf_id = dafPat.dafpat_dafid and
			dafPat.dafpat_patid = pat.pat_id and			
			pat.pat_id ='.$patid.'		
			ORDER BY  `dafpat_dafid` DESC ';
		$query=$this->query($sql,1 ); //debug
		if($query){
			$result=array();
			foreach( $this->_fetchAll($query) as $data ){		 
				$result[]=$data['id'];				 
			}
			return $result;
		}
		else{
			return false;		
		}
	}
	
	public function detail($id,$field='dafpat_id')
	{
		 
		$sql=sprintf("select 
		`dafpat_id`, `dafpat_dafid`, `dafpat_patid`, `dafpat_usrid`, `dafpat_docid`, `dafpat_date`, `dafpat_jasaadmin`, `dafpat_jasadr`, `dafpat_farno`, `dafpat_fartot`, `dafpat_other`,
		(`dafpat_jasaadmin`+`dafpat_jasadr`) `total`, (`dafpat_jasaadmin`+`dafpat_jasadr`+dafpat_fartot) total2, 
		`dafpat_atasNama`, `dafpat_uniqCode`, `dafpat_appBy`, `dafpat_appDate`, `dafpat_deleteBy`, `dafpat_type`, `dafpat_payId`
		from 
		`{$this->table}` 
		where `%s`='%s'",$field, $id);
		$query=$this->query($sql,1 ); //debug
		$data0=$this->_fetchAll($query,1);
		if(count($data0)==1){
			$data=$data0[0];
			$row=$this->cleanFieldName('dafpat_',$data);			
			$row['tarif']=$this->tarifParse($row['other'],$row['dafid']);
			$row['num']=1;
			return $row;
		}
		if($count($data0)>1){
			$row=array();
			foreach($data as $r){
			    $row0=$this->cleanFieldName('dafpat_',$data);			
				$row0['tarif']=$this->tarifParse($row0['other'],$row0['dafid']);
				$row[]=$row;
			}
			return $row;
		}
		else{
			return false;
		}
	}
/*
	Total Daftarpasien  
*/	
	public function total()
	{
		$sql=sprintf("select count(dafpat_id) c from `%s`",
		$this->table);
		$data=$this->resOne($sql);
		return (int)$data['c'];
		
	}
	
	private function tarifParse($txt,$dafid){
	$data=array();
	$list=explode("\n",trim($txt));
	foreach($list as $v){
		$data2=explode("[break]",$v);
		$data[]=array('name'=>$data2[0],
		'price'=>$data2[1],
		'quantity'=>$data2[2],
		'subtotal'=>$data2[1]*$data2[2]
		);
		
	}
	$result=array();
	$sql="select tarif_name name,dafJas_tarifPrice price from klinik_daftartarif,klinik_tarif
			where tarif_id=dafJas_tarifID and
			dafJas_dafid={$dafid}
			limit 50";
	$query=$this->query($sql,1 ); //debug
		if($query){
			
			foreach( $this->_fetchAll($query) as $data2 ){	
				$result[]=$data2;
			}
		}else{}
	//$result['raw']=$data;
	return $result ;
	}
/*
	Detail Daftarpasien berdasarkan id
*/	
	public function getAll( )
	{
		$sql=sprintf("select 
		`dafpat_id`, `dafpat_dafid`, `dafpat_patid`, `dafpat_usrid`, `dafpat_docid`, `dafpat_date`, `dafpat_jasaadmin`, `dafpat_jasadr`, `dafpat_farno`, `dafpat_fartot`, `dafpat_other`, `dafpat_total`, `dafpat_atasNama`, `dafpat_uniqCode`, `dafpat_appBy`, `dafpat_appDate`, `dafpat_deleteBy`, `dafpat_type`, `dafpat_payId`
		from 
		`{$this->table}` 
		limit %d", 150); //max untuk hal tak di inginkan
		$query=$this->query($sql,1 ); //debug
		if($query){
			$result=array();
			foreach( $this->_fetchAll($query) as $data ){				 
				$row=$this->cleanFieldName('dafpat_',$data);
				$result[]=$row;				 
			}
			return $result;
		}
		else{
			return false;		
		}
	}
	
	public function kwitansi($daf,&$stat){
		$sql="select 
		`dafpat_id`,  `dafpat_date`,  `dafpat_uniqCode`,  `dafpat_type` typeid
		from 
		`{$this->table}`
		where dafpat_dafid=$daf";
		$query=$this->query($sql,1 ); //debug
		if($query){
			$result=array();
			foreach( $this->_fetchAll($query) as $data ){				 
				$row=$this->cleanFieldName('dafpat_',$data);
				if($row['typeid']==0){
					$row['type']='NEW';
					$stat='new';
				}
				
				if($row['typeid']==1){
					$row['type']='PAY';
					$stat='pay';
				}
				if($row['typeid']==2){
					$row['type']='CANCEL';
				}
				
				if($row['typeid']==5){
					$row['type']='LAB';
					$stat='pay';
				}
				
				if(!isset($row['type'])){
					$row['type']='OTHER';
				}
				
				$result[]=$row;				 
			}
			$stat=strtoupper($stat);
			return $result;
		}
		else{
			return false;		
		}
	}
	
	public function listV1($limit=15,$start=0,$where='',$sortField='dafpat_id', $sortType='desc' ){
		if($limit>200)$limit=200;//max untuk hal tak di inginkan
		if($where==''){
			$where='daf_enable=1 and daf_id = dafpat_dafid ';
		}
		
		$div=ceil($start/$limit/3)+1;
		if($div<17)$div=17;
		
		$dateBack=date('Y-m-d',strtotime('-'.$div.' days'));
		$sql=sprintf("select 
		`dafpat_id`, `dafpat_dafid`, `dafpat_patid`, `dafpat_usrid`, `dafpat_docid`, `dafpat_date`, `dafpat_jasaadmin`, `dafpat_jasadr`, `dafpat_farno`, `dafpat_fartot`, `dafpat_other`, `dafpat_total`, `dafpat_atasNama`, `dafpat_uniqCode`, `dafpat_appBy`, `dafpat_appDate`, `dafpat_deleteBy`, `dafpat_type`, `dafpat_payId`
		from 
		`{$this->table}`, klinik_daftar
		where %s and dafpat_date > '$dateBack'
		group by dafpat_dafid
		order by %s %s				
		limit %d,%d", 
		$where, $sortField, $sortType, $start,$limit); 
		$this->logger->write('query','daftarPasien model |date:'.$dateBack.' |query:'.$sql); 
		$query=$this->query($sql); //debug
		if($query){
			$result=array();
			foreach( $this->_fetchAll($query) as $data ){				 
				$row=$this->cleanFieldName('dafpat_',$data);
				$result[]=$row;				 
			}
			return $result;
		}
		else{
			return false;		
		}
	}
	  
	public function listSearch($limit=15,$start=0,$search='',$sortField='dafpat_id', $sortType='desc' ){
		if($limit>100)$limit=100;//max untuk hal tak di inginkan
		 $where='daf_enable=1 and daf_id = dafpat_dafid ';
		 
		$cari="%".$search.'%';
		$where.=sprintf("and (		
			dafpat_dafid like '%s' or
			dafpat_id like '%s' or
			dafpat_uniqCode like '%s'
		)",$cari,$cari,$cari );
		$div=ceil($start/$limit/3)+1;
		 
		$sql=sprintf("select 
		`dafpat_id`, `dafpat_dafid`, `dafpat_patid`, `dafpat_usrid`, `dafpat_docid`, `dafpat_date`, `dafpat_jasaadmin`, `dafpat_jasadr`, `dafpat_farno`, `dafpat_fartot`, `dafpat_other`, `dafpat_total`, `dafpat_atasNama`, `dafpat_uniqCode`, `dafpat_appBy`, `dafpat_appDate`, `dafpat_deleteBy`, `dafpat_type`, `dafpat_payId`
		from 
		`{$this->table}`, klinik_daftar
		where %s 		
		group by dafpat_dafid
		order by %s %s				
		limit %d,%d", 
		$where, $sortField, $sortType, $start,$limit); 
		$this->logger->write('query','daftarPasien model |search:'.$search.' |query:'.$sql); 
		$query=$this->query($sql); //debug
		if($query){
			$result=array();
			foreach( $this->_fetchAll($query) as $data ){				 
				$row=$this->cleanFieldName('dafpat_',$data);
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
	list field tersedia : `dafpat_id`, `dafpat_dafid`, `dafpat_patid`, `dafpat_usrid`, `dafpat_docid`, `dafpat_date`, `dafpat_jasaadmin`, `dafpat_jasadr`, `dafpat_farno`, `dafpat_fartot`, `dafpat_other`, `dafpat_total`, `dafpat_atasNama`, `dafpat_uniqCode`, `dafpat_appBy`, `dafpat_appDate`, `dafpat_deleteBy`, `dafpat_type`, `dafpat_payId` 
	id : dafpat_id
*/
	public function add($data,$payData){
		$id=$this->idTable('dafpat_',716352);
//tambahkan detail yang kurang	
		$this->logger->write('debug', 'Act:Add data:'.json_encode($data));
		$insert = $this->insertData($this->table, $data,1 ); //saran biarkan ada log 
		if($insert){
			$this->logger->write('debug', 'Act:Add pay:'.json_encode($payData));
						
			if($payData['pay']==1) $payId=1;			
			if($payData['pay']==2) $payId=2;			
			if($payData['pay']==3) $payId=3;
			
			$data2=array('dpp_daf'=>$data['dafpat_dafid'], 
			'dpp_type'=>$payId);
			$this->insertData($this->tablePay,$data2,1);
			if($payData['pay']==3){ $payId=3;
				$data2=array(
				'dpi_daf'=>$data['dafpat_dafid'],
				'dpi_ins'=>$payData['id'],
				'dpi_comp'=>$payData['comp'],
				'dpi_card'=>$payData['no'],
				'dpi_polis'=>$payData['polis'],
				'dpi_name'=>$payData['name']
				);
				$this->insertData('klinik_daftarpasienins',$data2,1);
				$this->logger->write('debug', 'Act:Add pay |asuransi:'.json_encode($data2));
			}
			
			if($payData['pay']==2){ $payId=2;
				$data2=array(
				'dpc_daf'=>$data['dafpat_dafid'],
				'dpc_nip'=>$payData['nip'],
				'dpc_parent'=>$payData['name'],
				'dpc_comp'=>$payData['id'],
				);
				$this->insertData('klinik_daftarpasiencomp',$data2,1);				
				$this->logger->write('debug', 'Act:Add pay |perusahaan:'.json_encode($data2));
			}
			
			return true;
		}
		else{
			return false;
		}		
	}
	
	function addDetail($data){
		$this->logger->write('debug', 'Act:AddDetail data:'.json_encode($data));
		$insert = $this->insertData($this->tableDetail, $data,1 ); //saran biarkan ada log 
		if($insert){
			return true;
		}else{
			return false;
		}
	}
	
	function makeMin($dafpat_dafid){
		$sql="update {$this->table} set dafpat_dafid='-{$dafpat_dafid}' where dafpat_dafid={$dafpat_dafid}";
		$query=$this->query($sql,1 ); //debug
		if($query){
			return true;
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
		$key="dafpat_id='$key'";
		$sql.="where $key";
	
		$query=$this->query($sql,1 ); //debug
		if($query){
			return true;
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
		$this->logger->write('info', 'model: Daftarpasien');
	}
	
}