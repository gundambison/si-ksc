<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class rumah extends CI_Controller {
/*Halaman utama*/
        public function index()
        {
			//memanggil base dari rumah
			$d=$this->base(); 
			/* UNTUK POST */
			if(!is_null($_POST)&&count($_POST))
			{
			//print_r($_POST);
				$act=$_POST['act'];
				if($act=='login')
				{
					$d['error']=$this->login();
				
				}
			
			}
			
			//List content yang akan tampil			
			$aModul=array('login','listbuku');
			$d['modul']=$aModul;
			
			$d['buku']=$this->rumahmodel->viewAllBuku();
			$d['totalBuku']=$this->rumahmodel->totalBuku();
			$d['totalRows']=$this->rumahmodel->totalRows();
			//error kalau ada
			$ses=$this->session->all_userdata(); 
			if(@!is_null($ses['error']))
			{
				$d['error']=$ses['error'];
				$this->session->unset_userdata('error');
			}
			
			//Kirimkan data
            $this->load->view($d['base'],$d);
			
        }
		
		public function insert()
		{			 
			echo "data dimasukkan ke id :".
				$this->rumahmodel->inputBuku()."<br>";
			$this->index(); 
			//cara yang tidak bijaksana!
		}
		
		function base()
		{
			$lang='ina';			 
			$d=array('base'=>'rumah_view');
			$this->lang->load('my',$lang);			
			return $d;
		}
		
		function tes()
		{
			//memanggil base dari rumah
			$d=$this->base(); 
			//List content yang akan tampil			
			$aModul=array('listbuku');
			$d['modul']=$aModul;
			
			$d['buku']=$this->rumahmodel->viewAllBuku();
			$d['totalBuku']=$this->rumahmodel->totalBuku();
			$d['totalRows']=$this->rumahmodel->totalRows();
			//Kirimkan data
            $this->load->view($d['base'],$d);
		}
		
		//============LOGIN=============
		function login()
		{
			/*untuk tes kedua kita 
			input user dan password*/
			$num=$this->rumahmodel->userCheck();
			if($num==1){
			//perbaikan karena seharusnya ada di model
				$this->rumahmodel->userLogin();			
				redirect( current_url());
			}else{
				$err='Login anda tak dikenali';
			
			}
			//die("num=".$num);
			return $err;
		}
		
		function logout()
		{
			$this->session->unset_userdata('name');
			$this->session->unset_userdata('pass');
			redirect( base_url());
		}
		
		public function input()
        {
			//memanggil base dari rumah
			$d=$this->base(); 
			//hanya boleh dimasuki oleh yang punya role input
			if($this->rumahmodel->userNotPermit('insert'))
			{
				 
				redirect( base_url());
			}
			
			//List content yang akan tampil			
			$aModul=array( 'inputbuku');
			$d['modul']=$aModul;			
			//Kirimkan data
            $this->load->view($d['base'],$d);
			 
		}
		
		public function hapus()
        {
			//memanggil base dari rumah
			$d=$this->base(); 
			//hanya boleh dimasuki oleh yang punya role input
			if($this->rumahmodel->userNotPermit('hapus'))
			{
				 
				redirect( base_url());
				exit();
			}
			
			//HAPUS!!?? hanya update saja
			$idDel =  intval($this->uri->segment(3)) ;
			if(@!is_null($idDel))
				$this->rumahmodel->delBuku($idDel);
			
			//List content yang akan tampil			
			$aModul=array( 'listbuku');
			$d['modul']=$aModul;	
			$d['buku']=$this->rumahmodel->viewAllBuku();
			$d['totalBuku']=$this->rumahmodel->totalBuku();
			$d['totalRows']=$this->rumahmodel->totalRows();		
			$d['del']=TRUE;

			
			//Kirimkan data
            $this->load->view($d['base'],$d);
			
		}
		
}