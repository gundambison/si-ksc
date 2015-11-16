<?php
/*
ALTER TABLE `klinik_medrec` ADD `symptoms` TEXT NOT NULL AFTER `input`, ADD `constraints` TEXT NOT NULL AFTER `symptoms`, ADD `following` TEXT NOT NULL AFTER `constraints`;

ALTER TABLE `klinik_medrec` ADD `medic` TEXT NOT NULL AFTER `action` 

CREATE TABLE IF NOT EXISTS `klinik_medrec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `input` datetime NOT NULL,
  `diagnosa` text NOT NULL,
  `action` text NOT NULL,
  `obat` text not NULL,
  `type` int(11) NOT NULL,
  `pasien` int(11) NOT NULL,`user` int(11) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `pasien` (`pasien`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
*/
class Models_Clinic_Ksc_Pasien_model extends Base_Model {
var $table=		'klinik_pasien';
var $tableMr=	'klinik_pasienmr';
var $tableMedrec='klinik_medrec';

var $tableAsuransi=	'klinik_asuransi';
var $tableCompany=	'klinik_company';
var $tableDegeneratif= 'klinik_pasiendeg';
var $tableReligi='klinik_religion';

	public function __construct(){
		parent::__construct();
		$this->loadConnection('default');
	}
	
	public function detailSimple($id){
		$sql=sprintf("select pat_id,  pat_name1,  pat_name2 ,  pat_addr ,pat_addr2,  pat_addr3, pat_wni,
		if(pat_gen=1,'M','F') gender, pat_birth,   pat_blood, pat_desc description,pat_phone,pat_inp, pat_religi,pat_status,pat_com,pat_ins
		from {$this->table} p  
 		where pat_id=%s", $id);
		$data=$this->resOne($sql);
		 
		if(count($data)>1){
			$data['pat_mr']=sprintf("%010s",$data['pat_id']);
			$row=$this->cleanFieldName('pat_',$data);
			//========village
			$pos=$row['addr2'];
			if(intval($pos)){
				$sql='select vil_name from klinik_village where vil_id='.$pos;
				$data=$this->resOne($sql);
				$row['village']=$data['vil_name'];
			}else{ 
				$row['village']='';
			}
			
			$row['name']=trim($row['name1'])." ".trim($row['name2']);
			$row['address']=trim($row['addr'])."\n". trim($row['village'])."\n";
			if(strtolower($row['addr2'])!=='lain-lain')
				$row['address'].= trim($row['addr3']);			
			
			return $row;
		}else{
			return false;
		}
		
	}
	public function detail($id){
		$sql=sprintf("select pat_id,  pat_name1,  pat_name2 ,  pat_addr ,pat_addr2,  pat_addr3, pat_wni,
		if(pat_gen=1,'M','F') gender, pat_birth,   pat_blood,  if(pat_mr is null,'-',pat_mr) pat_mr, pat_desc description,pat_phone,pat_inp,
		pat_religi, if(religi_name is null,'',religi_name) religi_name,pat_status,pat_com,pat_ins
		from {$this->table} p 
		left join {$this->tableMr} pmr on p.pat_id =pmr.pmr_pat
		left join {$this->tableReligi} r on r.religi_id=pat_religi
		where pat_id=%s", $id);
		$data=$this->resOne($sql);
		$data['name']=$data['pat_name1'].trim(" ".$data['pat_name2']);
		if(count($data)>1){
			if($data['pat_mr']=='-'||trim($data['pat_mr'])==''){
				//$this->logger->write('info', 'data: '.json_encode($data)." |id=".$id);
				$data['pat_mr']=sprintf("%010s",$data['pat_id']);
				$sql="select count(pmr_pat) c from {$this->tableMr} where pmr_pat=$id";
				$dtMR=$this->resOne($sql);
				 
				if($dtMR['c']!=1){
					$this->logger->write('info', 'mr kosong?|sql:'.$sql.'|detail:'.print_r($dtMR,1));
				  $this->insertData($this->tableMr,array('pmr_pat'=>$id,'pat_mr'=>$data['pat_mr']));
				}else{ 
					$this->logger->write('info', 'mr update|detail:'.print_r($dtMR,1)."|id:$id|mr:{$data['pat_mr']}");
					//$stat=$this->updateMR($data['pat_mr'],$id);
					$sql="update {$this->table}mr set pat_mr='%s' where pmr_pat=%s";
					$query=$this->query(sprintf($sql,$data['pat_mr'],$id),1 );
				}
				 
			}else{
				$this->logger->write('info','no update mr');
				
			}
			$row=$this->cleanFieldName('pat_',$data);
			//========village
			$pos=$row['addr2'];
			if(intval($pos)){
				$sql='select vil_name from klinik_village where vil_id='.$pos;
				$data=$this->resOne($sql);
				$row['village']=$data['vil_name'];
			}else{ 
				$row['village']='';
			}
			
			$row['name']=trim($row['name1'])." ".trim($row['name2']);
			$row['address']=trim($row['addr'])."\n". trim($row['village'])."\n";
			if(strtolower($row['addr2'])!=='lain-lain')
				$row['address'].= trim($row['addr3']);
			
			$this->logger->write('debug','data:'.print_r($row,1));
			return $row;
		}else{
			return false;
		}
	}
	
	public function detailDegeneratif($id){
		$sql2="select deg_id id, deg_name name from klinik_degeneratif";
		$qDeg=$this->query($sql2);
		if($qDeg==false){ return array(); }
		
		$sql2="select pd_det detail from klinik_pasiendeg where pd_pat=$id";
		$patData=$this->resOne($sql2);
		//if($patData==false){ return array(); }
		$aPD=array(); 
		$ar2=explode("\n",$patData['detail']);
		foreach($ar2 as $idDeg){
			$aPD[$idDeg]=1;	
		}
		$this->logger->write('debug','pasienDeg:'.print_r($aPD,1));		
		$deg=array();
	 
		foreach( $this->_fetchAll($qDeg) as $row ){			    
			 $row['active']=isset($aPD[$row['id']])?TRUE:FALSE; 			 
			$deg[]= $row ;
		}
		 
		$this->logger->write('debug','pasienDeg:'.print_r($deg,1));	
		return $deg;		 
	}
	
	public function detailAsuransi($id){
		$result= array();
		$sql="select  ins_id,ins_name from 
		%s p,%s a where pat_ins=ins_id and pat_id=%s";
		$sql=sprintf($sql, $this->table, $this->tableAsuransi, $id);		
		$result0= $this->resOne($sql,1);
		if(isset($result['ins_name']))
			$result= $this->cleanFieldName('ins_',$result0);
		return $result;
	}
	 
	public function detailPerusahaan($id){
		$result= array('no data');
		$sql="select  com_id,com_name from 
		%s p,%s a where pat_com=com_id and pat_id=%s";
		$sql=sprintf($sql, $this->table, $this->tableCompany, $id);
		$result0= $this->resOne($sql,1);
		$this->logger->write('debug', 'result0: '.print_r($result0,1));
		if(isset($result0['com_name']))
			$result= $this->cleanFieldName('com_',$result0);
		$this->logger->write('debug', 'result: '.print_r($result,1));
		return $result;
	}
	
	public function updateMR($mr,$id){
		$this->detail($id);	
		$sql="update {$this->table}mr set pat_mr='%s' where pmr_pat=%s";
		$query=$this->query(sprintf($sql,$mr,$id),1 ); //debug
		if($query){
			return true;
		}
		else{
			return false;		
		}
	}
	public function update($data, $key)
	{
		$sql="update {$this->table} set ";
//tambahkan detail yang kurang
		//$this->logger->write('debug', 'Act:Update Patient |data:'.json_encode($data));
		$convertToNum=array('pat_religi','pat_com','pat_ins','pat_addr2');
		foreach($convertToNum as $nm){
			$data[$nm]=intval($data[$nm]);
		}
		
		$fields=array();
		foreach($data as $name=>$value)
		{
			$fields[]="$name='".$this->conn->real_escape_string($value)."' ";					
		}
		
		$sql.=implode(",", $fields); 
		///$key="com_id='$key'";
		$sql.="where $key";
	
		$query=$this->query($sql,1 ); //debug
		if($query){
			return true;
		}
		else{
			return false;		
		}
		
	}
	
	function updateDegeneratif($deg, $patid){
		$sql="select count(pd_pat) c from %s where pd_pat=%s";
		//$q=$this->query($sql);
		$dt=$this->resOne(sprintf($sql,$this->tableDegeneratif,$patid));
		if($dt['c']==0){
			$sql="insert into %s(pd_pat) values('%s')";
			$stat=$this->query(sprintf($sql,$this->tableDegeneratif,$patid),1);
			if($stat==false) return false;
		}
		$sql0="update %s set 
		pd_det='%s' where pd_pat=%s";
		$sql=sprintf($sql0, $this->tableDegeneratif, $deg,$patid);
		//pd_det, pd_pat
		$query=$this->query($sql,1 ); //debug
		if($query){
			return true;
		}
		else{
			return false;		
		}
		
	}
	
	public function detailMR($id){
		$result=array();
		$sql="select id,diagnosa, action,type,medic,input date,modified from %s where pasien=%s order by input asc";
/*
Format:
- Pasien (nama)
- mr
- diagnosa : detail, gigi, gigiBagian
- action 
- type		
*/
		$sql=sprintf($sql,$this->tableMedrec, $id);
		$query=$this->query($sql,1 ); //1 for debug
		if($query){
			$result=array();
			$pasien=$this->detail($id);
			foreach( $this->_fetchAll($query) as $row ){
				$ar=json_decode($row['diagnosa'],1);
				$diagnosa=array(
					'detail'=>isset($ar['detail'])?$ar['detail']:'',
					'gigi'=>isset($ar['gigi'])?$ar['gigi']:'',
					'gigiBagian'=>isset($ar['gigiBagian'])?$ar['gigiBagian']:'',				
				);
				$result[]=array(
				'date'=>date("Y-m-d",strtotime($row['date'])),
				'pasien'=>$pasien['name'],
				'mr'=>$pasien['mr'],
				'diagnosa'=>$diagnosa,
				'medic'=>$row['medic'], 
				'action'=>(string)$row['action'],
				'type'=>(int)$row['type'],
				'modified'=>$row['modified'],
				'id'=>$row['id']
				);
			}
		
			return $result;
		}
		else{
			return false;		
		}
	
	}
	
	public function total(){
		$sql=sprintf("select count(pat_status) c from %s where pat_status=1",
		$this->table);
		$data=$this->resOne($sql);
		return (int)$data['c'];
		
	}
	
	public function showNum($start=0,$limit=15,$fields,$data=array()){
		if($limit <=0) $limit=15;
		if($start<0) $start=0;
		
		$where=1;
/*		
		$sql=sprintf("select 
		pat_id, concat(pat_name1, ' ',pat_name2) name,  concat(pat_addr,' ',pat_addr2,' ', pat_addr3) address, 
		if(pat_gen=1,'M','F') gender, pat_birth, pat_phone,  pat_desc, pat_blood,   pat_wni, pat_mr
		from {$this->table} p 
		left join {$this->tableMr} pmr on p.pat_id =pmr.pmr_pat
		where %s
		order by pat_id desc 
		limit %d,%d ",
		$where, $start,$limit);
	
		$query=$this->query($sql,1 ); //1 for debug
		if($query){
			$result=array();
			foreach( $this->_fetchAll($query) as $row ){
				if($row['pat_mr']=='') $row['pat_mr']=sprintf("%010s",$row['pat_id']);
				$row=$this->cleanFieldName('pat_',$row); 
				$result[]=$row;
				$tmp=implode(", ",array_keys($row) );
			}
*/	
		$sql=sprintf("select 
		pat_id id
		from {$this->table} p 
		left join {$this->tableMr} pmr on p.pat_id =pmr.pmr_pat
		where %s
		order by {$fields} 
		limit %d,%d ",
		$where, $start,$limit);
	
		$query=$this->query($sql,1 ); //1 for debug
		if($query){
			$result=array();
			foreach( $this->_fetchAll($query) as $row ){
				$pasienData=$this->detail($row['id']);
				$result[]=$pasienData;
				$tmp=implode(", ",array_keys($row) );
			}
			
			return $result;
		}
		else{
			return false;		
		}
	}
	
	public function searchData($cari,$limit,$fields){
		$sql="select pat_id id from klinik_pasien p
		left join {$this->tableMr} pmr on p.pat_id =pmr.pmr_pat
		where $cari order by $fields limit $limit";
		$query=$this->query($sql,1 ); //1 for debug
		if($query){
			$result=array();
			foreach( $this->_fetchAll($query) as $row ){
				$pasienData=$this->detail($row['id']);
				$result[]=$pasienData;
				$tmp=implode(", ",array_keys($row) );
			}
			
			return $result;
		}
		else{
			return false;		
		}
	}
/*
mendapatkan pasien terbaru
*/	
	public function showNew($limit=15,&$tmp=''){
		if($limit <=0) $limit=15;
		$sql=sprintf("select 
		pat_id, concat(pat_name1, ' ',pat_name2) name,  concat(pat_addr,' ',pat_addr2,' ', pat_addr3) address, 
		if(pat_gen=1,'M','F') gender, pat_birth,   pat_blood,  pat_mr
		from {$this->table} p 
		left join {$this->tableMr} pmr on p.pat_id =pmr.pmr_pat
		where  pat_status=1
		order by pat_id desc 
		limit %d ",$limit);
		$query=$this->query($sql); //1 for debug
		if($query){
			$result=array();
			foreach( $this->_fetchAll($query) as $row ){
				if($row['pat_mr']=='') $row['pat_mr']=sprintf("%010s",$row['pat_id']);
				$row=$this->cleanFieldName('pat_',$row); 
				$result[]=$row;
				//$tmp=implode(", ",array_keys($row) );
			}
			return $result;
		}
		else{
			return false;		
		}
		
	} 
	
	public function savemedrec($data,&$daf ){
		$id=$this->idTable('medrec',726352);
		$medrec=array(
			'id'=>$id,
			'input'=>$data['date'],
			'diagnosa'=>json_encode($data['diagnosa']),
			'action'=>$data['action'],
			'medic'=>$data['medic'],
			'pasien'=>$data['pasien_id'],
			'type'=>$data['types'],
			'user'=>$data['user'],
			
			'symptoms'=>$data['symptoms'],
			'constraints'=>$data['constraints'],
			'following'=>$data['following']
			
		);
		
		$insert = $this->insertData($this->tableMedrec, $medrec,1 ); //saran biarkan ada log 
		$daf=$this->addDaftar($id, $data['daf'], $data['pasien_id'], 
		$data['diagnosa']['detail']);
		if($insert){
			return $id;
		}
		else{
			return false;
		}
	}
	
	public function removeDaftarDiagnosa($daf)
	{
		$sql0="select dd_daf daf,dd_diag diag,d_code1 code1,d_code2 code2,d_name name,dd_modified edited
		from klinik_daftardiagnosa 
		left join klinik_daftar on dd_daf=daf_id
		left join klinik_diagnosa on dd_diag=d_id
		where dd_daf=$daf";
		$query=$this->query($sql0,1); //1 for debug
		if($query){
			$result=array();
			foreach( $this->_fetchAll($query) as $row ){
				$result[]=$row;
			}
			$this->logger->write('debug', 'act:removeDaftarDiagnosa|daf:'.$daf.'|data:'.json_encode($result));	
 		}else{ 
			$sql="ALTER TABLE `klinik_daftardiagnosa` ADD `dd_modified` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'hanya nambah log'" ;
			$this->query($sql,1);
			$query=$this->query($sql0,1); //1 for debug
			$result=array();
			foreach( $this->_fetchAll($query) as $row ){
				$result[]=$row;
			}
			$this->logger->write('debug', 'act:removeDaftarDiagnosa|daf:'.$daf.'|data:'.json_encode($result));
			
		}
		
		$sql="update klinik_daftardiagnosa set dd_daf='-%s' where dd_daf='%s'";
		$sql=sprintf($sql,$daf,$daf);
		$this->query($sql,1);
		
	}
	
	public function addDaftarDiagnosa($daf,$id)
	{ 
		$sql="update klinik_daftardiagnosa set dd_daf='-%s' where dd_daf='%s' and dd_diag='%s'";
		$sql=sprintf($sql,$daf,$daf,$id);
		$this->query($sql,1);
		$data=array('dd_daf'=>$daf,'dd_diag'=>$id);
		$insert = $this->insertData('klinik_daftardiagnosa', $data,1 );
		 
	}
	
	private function addDaftar($id,$daf, $id )
	{		
		$daf1=0;
		$sql="select dafpat_dafid id from 	klinik_daftarpasien where dafpat_patid=$id order by dafpat_id desc limit 1";
		$data=$this->resOne($sql,1); //1 for debug
		if($data){
			$daf1=$data['id'];
			if($data['id']!=$daf){
				$this->logger->write('error', 'daf berbeda');	
				$stat=0; 
			}
			else{
				$stat=1;
			}
		}else{
			$this->logger->write('error', 'daf tak ditemukan');
			$stat=2;
		}
		$date=date("Y-m-d H:i:s");
		$data=array('daftar'=>$daf1,'daftar0'=>$daf,'status'=>$stat,'medrec'=>$id,'created'=>$date);
		$insert = $this->insertData('klinik_medrecdaftar', $data,1 );
		if(!$insert){
			$sql="CREATE TABLE IF NOT EXISTS klinik_medrecdaftar (
id int(11) NOT NULL,
  daftar int(11) NOT NULL,
  daftar0 int(11) NOT NULL,
  medrec int(11) NOT NULL,
  `status` int(11) NOT NULL,
  detail text NOT NULL,
  created datetime NOT NULL,
  modified timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='medrec - daftar';";
			$this->query($sql,1);
			$sql="ALTER TABLE klinik_medrecdaftar ADD PRIMARY KEY (id), ADD KEY daftar (daftar,daftar0,medrec);";
			$this->query($sql,1); 
			$sql="ALTER TABLE klinik_medrecdaftar MODIFY id int(11) NOT NULL AUTO_INCREMENT;";
			$this->query($sql,1); 
			$insert = $this->insertData('klinik_medrecdaftar', $data,1 );
		}else{ }
		
		return $daf1;
	}
}