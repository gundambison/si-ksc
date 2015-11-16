<?php
class Models_Clinic_Ksc_Doctortypes_model extends Base_Model {
var $table='klinik_docspecialis'; //main table
var $tablePasien='klinik_pasien';
var $tableMr='klinik_pasienmr';
var $tableDoctor='klinik_doctor';
var $daftarPasien='klinik_daftarpasien';
/*
	Detail Doctortypes berdasarkan id
*/
	public function detail($id,$field='spec_id')
	{
		$sql=sprintf("select 
		`spec_id`, `spec_name`, `spec_desc`, `spec_type`
		from 
		`{$this->table}` 
		where `%s`='%s'",$field, $id);
		$data=$this->resOne($sql,1);
		if(count($data)>1){
			$row=$this->cleanFieldName('spec_',$data);
			return $row;
		}
		else{
			return false;
		}
	}
/*
	Total Doctortypes  
*/	
	public function total()
	{
		$sql=sprintf("select count(spec_id) c from `%s`",
		$this->table);
		$data=$this->resOne($sql);
		return (int)$data['c'];
		
	}
/*
	Detail Doctortypes berdasarkan id
*/	
	public function getAll($showDoc=0)
	{
		 
		$sql=sprintf("select 
		`spec_id`, `spec_name`, `spec_desc`, `spec_type`
		from 
		`{$this->table}` 
		limit %d", 150); //max untuk hal tak di inginkan
		$query=$this->query($sql  ); //debug
		if($query){
			$result=array();
			foreach( $this->_fetchAll($query) as $data ){				 
				$row=$this->cleanFieldName('spec_',$data);
				
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
	list field tersedia : `spec_id`, `spec_name`, `spec_desc`, `spec_type` 
	id : spec_id
*/
	public function add($data){
		$id=$this->idTable('spec_',716352);
//tambahkan detail yang kurang	
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
		$key="spec_id='$key'";
		$sql.="where $key";
	
		$query=$this->query($sql,1 ); //debug
		if($query){
			return $result;
		}
		else{
			return false;		
		}
		
	}
/*
 
*/
	public function pasien($id=0, $limit=15,$start=0 ){
		if($limit <=0) $limit=15;
		$now=date("Y-m-d", strtotime('-5 week'));
		$sql = sprintf("select pat_id pasien_id,dafpat_dafid daftar, concat(pat_name1, ' ',pat_name2) name, `dafpat_id` daftar_pasien,`dafpat_date` daftarDate,`doc_id`,`doc_name` dokter ,`spec_id`, `spec_name` type,if(pat_gen=1,'M','F') gender, pat_birth,   pat_blood,  pat_mr
		from %s, `%s` ,%s, %s p left join %s pmr on p.pat_id =pmr.pmr_pat
		where  
		`dafpat_type`=0
		and `dafpat_patid`=`pat_id` 
		and `dafpat_docid`=`doc_id`
		and `doc_specId`=`spec_id`
		and `spec_id`=%d
		and `dafpat_date` > '%s'
		order by `dafpat_date` desc
		limit %d,%d",
		$this->table, $this->tableDoctor,$this->daftarPasien, $this->tablePasien, $this->tableMr,$id, $now, $start,$limit);
		
		$sqlMedrec="select count(id) totalMr from %s where daftar='%s' ";
  
		$query=$this->query($sql,1 ); //1 for debug
		if($query){
			$result=array();
			foreach( $this->_fetchAll($query) as $row ){
				if($row['pat_mr']=='') $row['pat_mr']=sprintf("%010s",$row['pasien_id']);
				 
				$sql=sprintf($sqlMedrec,'klinik_medrecdaftar', $row['daftar']);				
				$mrData=$this->resOne($sql);
				if($mrData['totalMr']!=0){
					$row['medrecStatus']=1; 
					$this->logger->write('info', 'pasien:'.$row['pasien_id'].'|name:'.$row['name']. '|total:'.$mrData['totalMr']);
				}else{ 
					$row['medrecStatus']=0;
				}
				
				$row=$this->cleanFieldName('dafpat_',$row); 
				$row=$this->cleanFieldName('pat_',$row); 
				$daf=$row['daftar']; 
 				
				$result[$daf]=$row;
				//$tmp=implode(", ",array_keys($row) );
			}
 
			if($id==1){
//GP PUNYA RULE SENDIRI			
				$sql = sprintf("select pat_id pasien_id,dafpat_dafid daftar, concat(pat_name1, ' ',pat_name2) name, `dafpat_id` daftar_pasien,`dafpat_date` daftarDate,'1' doc_id ,'GP' dokter,'1' spec_id, 'Poli Umum' type ,if(pat_gen=1,'M','F') gender, pat_birth,   pat_blood,  pat_mr
		from  %s, %s p left join %s pmr on p.pat_id =pmr.pmr_pat
		where  
		`dafpat_type`=0
		and `dafpat_patid`=`pat_id` 
		and `dafpat_docid`='0'			 
		and `dafpat_date` > '%s'
		order by `dafpat_date` desc
		limit %d,%d",
		 $this->daftarPasien, $this->tablePasien, $this->tableMr, $now, $start, $limit);
				$query=$this->query($sql,1 ); //1 for debug
				if($query){ 
					foreach( $this->_fetchAll($query) as $row ){
						if($row['pat_mr']=='') $row['pat_mr']=sprintf("%010s",$row['pasien_id']);
						$row=$this->cleanFieldName('dafpat_',$row); 
						$row=$this->cleanFieldName('pat_',$row); 
						$daf=$row['daftar']; 
						$result[$daf]=$row;
						//$tmp=implode(", ",array_keys($row) );
					}
			 
				}
			}
			 
//			$this->logger->write('info','key='.json_encode(array_keys($result)));
			krsort($result);
//			$this->logger->write('info','key='.json_encode(array_keys($result)));			 
			$result1=array();
			foreach($result as $data){
				$result1[]=$data;
			}
			//$this->logger->write('info','key='.json_encode(array_keys($result1)));
			
			return $result1;
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
		$this->logger->write('info', 'model: Doctortypes');
	}
	
}