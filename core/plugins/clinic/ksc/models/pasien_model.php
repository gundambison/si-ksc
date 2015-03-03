<?php
/*
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

	public function __construct(){
		parent::__construct();
		$this->loadConnection('default');
	}
	
	public function detail($id){
		$sql=sprintf("select pat_id,  pat_name1,  pat_name2 ,  pat_addr ,pat_addr2,  pat_addr3 , 
		if(pat_gen=1,'M','F') gender, pat_birth,   pat_blood,  pat_mr
		from {$this->table} p 
		left join {$this->tableMr} pmr on p.pat_id =pmr.pmr_pat
		where pat_id=%s", $id);
		$data=$this->resOne($sql,1);
		$data['name']=$data['pat_name1'].trim(" ".$data['pat_name2']);
		if(count($data)>1){
			if($data['pat_mr']=='') $data['pat_mr']=sprintf("%010s",$data['pat_id']);
			$row=$this->cleanFieldName('pat_',$data);
			return $row;
		}else{
			return false;
		}
	}
	
	public function detailAsuransi($id){
		$result= array();
		$sql="select  ins_id,ins_name from 
		%s p,%s a where pat_ins=ins_id and pat_id=%s";
		$sql=sprintf($sql, $this->table, $this->tableAsuransi, $id);		
		$result= $this->resOne($sql);
		if(isset($result['ins_name']))
			return $this->cleanFieldName('ins_',$result);
		return array();
	}
	 
	public function detailPerusahaan($id){
		$result= array();
		$sql="select  com_id,com_name from 
		%s p,%s a where pat_com=com_id and pat_id=%s";
		$sql=sprintf($sql, $this->table, $this->tableCompany, $id);
		$result= $this->resOne($sql);
		if(isset($result['com_name']))
			return $this->cleanFieldName('com_',$result);
		return array();
	}
	
	public function detailMR($id){
		$result=array();
		$sql="select diagnosa, action,type,medic,input date,modified from %s where pasien=%s order by input asc";
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
				'modified'=>$row['modified']
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
	
	public function showNum($start=0,$limit=15,$status=1,$data=array()){
		if($limit <=0) $limit=15;
		if($start<0) $start=0;
		
		if($status==0){
			$where=" pat_status=0";
		}elseif($status==1){
			$where=" pat_status=1";
		}else{
			$where='1';
		}
		
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
	
	public function savemedrec($data){
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
			
		);
		$insert = $this->insertData($this->tableMedrec, $medrec,1 ); //saran biarkan ada log 
		if($insert){
			return $id;
		}
		else{
			return false;
		}
	}
}