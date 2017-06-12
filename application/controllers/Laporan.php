<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Laporan extends CI_Controller
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
		$this->load->model('penilaian_model','mod_bea');
		$this->load->model('kriteria_model','mod_kriteria');
		$this->load->model('karyawan_model','mod_karyawan');
    }
    
    function penerimapenilaian()
    {
		$id=$this->input->get('id');
		$nama=$this->mod_bea->penilaian_info($id,'judul');
		$meta['judul']="Daftar Penerima penilaian ".$nama;
        $this->load->view('tema/cetak/header',$meta);
        $d['data']=$this->mod_bea->penilaian_data(array('penilaian_id'=>$id));
        $this->load->view('laporan/penerimapenilaianview',$d);
        $this->load->view('tema/cetak/footer');
	}
    
}