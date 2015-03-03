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
			return $row;
		}
		else{
			return false;
		}
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
	  
/*
	Insert data 
	list field tersedia : `daf_id`, `daf_timeEnter`, `daf_timeArrive`, `daf_userInp`, `daf_comment`, `daf_enable`, `daf_deleteBy` 
	id : daf_id
*/
	public function add($data){
		$id=$this->idTable('daf_',716352);
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
		$key="daf_id='$key'";
		$sql.="where $key";
	
		$query=$this->query($sql,1 ); //debug
		if($query){
			return $result;
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