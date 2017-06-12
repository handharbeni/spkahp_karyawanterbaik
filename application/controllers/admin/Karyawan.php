<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Karyawan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();        
        $this->load->library('form_validation');
        $this->load->library('m_db');
        if(akses()!="admin")
        {
			redirect(base_url().'logout');
		}
		$this->load->model('karyawan_model','mod_karyawan');
		$s=array(
			'user_id'=>6
		);
    }
    
    function index()
    {
        $meta['judul']="Semua Karyawan";
        $this->load->view('tema/header',$meta);
        $d['data']=$this->mod_karyawan->karyawan_data(array());
        $this->load->view(akses().'/karyawan/karyawanview',$d);
        $this->load->view('tema/footer');
    }
    
    function add()
    {
		$this->form_validation->set_rules('nisn','NIP','required');
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('tahun','Tahun Masuk','required');
		$this->form_validation->set_rules('tanggal','Tahun Masuk','required');
		if($this->form_validation->run()==TRUE)
		{
			$nisn=$this->input->post('nisn');
			$nama=$this->input->post('nama');
			$divisi=$this->input->post('divisi');
			$tahun=$this->input->post('tahun');
			$jk=$this->input->post('jk');
			$tempat=$this->input->post('tempat');
			$tgl=$this->input->post('tanggal');
			$alamat=$this->input->post('alamat');
			if($this->mod_karyawan->karyawan_add($nisn,$nama,$divisi,$jk,$tahun,$tempat,$tgl,$alamat)==TRUE)
			{
				set_header_message('success','Tambah Karyawan','Berhasil menambah Karyawan');
				redirect(base_url(akses().'/karyawan'));
			}else{
				set_header_message('danger','Tambah Karyawan','Gagal menambah Karyawan');
				redirect(base_url(akses().'/karyawan/add'));
			}
			
		}else{
			$meta['judul']="Tambah Karyawan";
	        $this->load->view('tema/header',$meta);	        
	        $this->load->view(akses().'/karyawan/karyawanadd');
	        $this->load->view('tema/footer');
		}
	}
    
    function edit()
    {
		$this->form_validation->set_rules('karyawanid','Karyawan ID','required');
		$this->form_validation->set_rules('nisn','NISNS','required');
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('tahun','Tahun Masuk','required');
		$this->form_validation->set_rules('tempat','Tahun Masuk','required');
		$this->form_validation->set_rules('tanggal','Tahun Masuk','required');
		if($this->form_validation->run()==TRUE)
		{
			$karyawanid=$this->input->post('karyawanid');
			$nisn=$this->input->post('nisn');
			$nama=$this->input->post('nama');

			$divisi=$this->input->post('divisi');
			$tahun=$this->input->post('tahun');

			$jk=$this->input->post('jk');
			$tempat=$this->input->post('tempat');
			$tgl=$this->input->post('tanggal');
			$alamat=$this->input->post('alamat');
			
			if($this->mod_karyawan->karyawan_edit($karyawanid,$nisn,$nama,$divisi,$jk,$tahun,$tempat,$tgl,$alamat)==TRUE)
			{
				set_header_message('success','Ubah Karyawan','Berhasil mengubah Karyawan');
				redirect(base_url(akses().'/karyawan'));
			}else{
				set_header_message('danger','Ubah Karyawan','Gagal mengubah Karyawan');
				redirect(base_url(akses().'/karyawan'));
			}
			
		}else{
			$meta['judul']="Ubah Karyawan";
	        $this->load->view('tema/header',$meta);
	        $id=$this->input->get('id');
	        $s=array(
	        	'karyawan_id' => $id
	        );
	        $d['data']=$this->mod_karyawan->karyawan_data($s);
	        $this->load->view(akses().'/karyawan/karyawanedit',$d);
	        $this->load->view('tema/footer');
		}
	}
	
	function delete()
	{
		$id=$this->input->get('id');
		if($this->mod_karyawan->karyawan_delete($id)==TRUE)
		{
			set_header_message('success','Hapus Karyawan','Berhasil menghapus Karyawan');
			redirect(base_url(akses().'/karyawan'));
		}else{
			set_header_message('danger','Hapus Karyawan','Gagal menghapus Karyawan');
			redirect(base_url(akses().'/karyawan'));
		}
	}
    
}
