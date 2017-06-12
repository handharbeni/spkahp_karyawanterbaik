<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profil extends CI_Controller
{
    function __construct()
    {
        parent::__construct();        
        $this->load->library('form_validation');
        $this->load->library('m_db');
        if(empty(akses()))
        {
			redirect(base_url().'logout');
		}
    }
    
    function index()
    {
        $meta['judul']="Ubah Profil";
        $this->load->view('tema/header',$meta);
        $this->load->view('tema/profilview');
        $this->load->view('tema/footer');
    }
    
    function uploadphoto()
    {		
		$gambar=$_FILES['file']['name'];		
        $ext=pathinfo($gambar,PATHINFO_EXTENSION);
		$imgname="ava-".md5(user_info('user_id')).".".$ext;
		$path = FCPATH.'konten/images/';
		$allow= "jpg|bmp|gif|png|jpeg";
		$maxsize	= 1000;
		$max_filename=0;				
				
		$this->load->library('m_file');
		if($this->m_file->custom_upload_image_single(TRUE,TRUE,$imgname,$path,$allow,$maxsize,0,0,'file',FALSE)==TRUE)
		{
			$s=array(
			'user_id'=>user_info('user_id'),
			);
			$d=array(
			'photo'=>$imgname,
			);
			$this->load->library('m_db');
			$this->m_db->edit_row('pengguna',$d,$s);
			echo json_encode(array(
			'status'=>'ok',
			'message'=>'Avatar berhasil diupload dan diubah',
			'url'=>base_url().'konten/images/'.$imgname,
			));		
		}else{
			echo json_encode(array(
			'status'=>'no',
			'message'=>'Avatar gagal diupload dan diubah.',
			));
		}
	}
    
    function updateadmin()
    {    	
    	$s=array(
    	'user_id'=>user_info('user_id'),
    	);
		foreach($_POST as $k=>$v)
		{
			if(!empty($v) && $k!="password")
			{
				$d=array(
				$k=>$v,
				);
				$this->m_db->edit_row('pengguna',$d,$s);
			}elseif(!empty($v) && $k=="password"){
				$d2=array(
				'password'=>md5($v),
				);
				$this->m_db->edit_row('pengguna',$d2,$s);
			}
		}
		set_header_message('success','Update Profil','Berhasil update profil');
		redirect(base_url().'profil');
	}
	
	function updatemanajemen()
	{
		$s=array(
    	'user_id'=>user_info('user_id'),
    	);
    	$nama=$this->input->post('nama');
    	$password=$this->input->post('password');
    	$tmp=$this->input->post('tempat');
    	$tgl=$this->input->post('tgl_lahir');
    	$table=$this->input->post('table');
    	$d=array();
    	if(!empty($password))
    	{
			$d=array(
			'nama'=>$nama,
			'password'=>md5($password),
			);
		}else{
			$d=array(
			'nama'=>$nama,
			);
		}
		
		$d2=array(
		'nama'=>$nama,
		'tempat'=>$tmp,
		'tgl_lahir'=>$tgl,
		);
    	
    	$this->m_db->edit_row($table,$d2,$s);
    	$this->m_db->edit_row('pengguna',$d,$s);
    	
    	set_header_message('success','Update Profil','Berhasil update profil');
		redirect(base_url().'profil');
    	
	}
	
    
}
