<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Penilaian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();        
        $this->load->library('form_validation');
        $this->load->library('m_db');
        if(akses()!="manager")
        {
			redirect(base_url().'logout');
		}
		$this->load->model('penilaian_model','mod_penilaian');
        $this->load->model('kriteria_model','mod_kriteria');        
    }
    
    function index()
    {
        $meta['judul']="Semua Penilaian";
        $this->load->view('tema/header',$meta);
        $d['data']=$this->mod_penilaian->penilaian_data();
        $this->load->view(akses().'/penilaian/penilaian/penilaianview',$d);
        $this->load->view('tema/footer');
    }
    function add()
    {
        $this->form_validation->set_rules('judul','Judul Penilaian','required');
        $this->form_validation->set_rules('keterangan','Keterangan Penilaian','required');
        $this->form_validation->set_rules('tahun','Tahun Bulan Penilaian','required');
        $this->form_validation->set_rules('kuota','Kuota Penilaian','required');
        if($this->form_validation->run()==TRUE)
        {
            $judul=$this->input->post('judul');
            $ket=$this->input->post('keterangan');
            $tahun=$this->input->post('tahun');
            $kuota=$this->input->post('kuota');
            
            if($this->mod_penilaian->penilaian_add($judul,$ket,$tahun,$kuota)==TRUE)
            {
                set_header_message('success','Tambah Penilaian','Berhasil menambah penilaian');
                redirect(base_url(akses()).'/penilaian/penilaian');
            }else{
                set_header_message('danger','Tambah Penilaian','Gagal menambah penilaian');
                redirect(base_url(akses()).'/penilaian/penilaian/add');
            }
        }else{
            $meta['judul']="Tambah Penilaian";
            $this->load->view('tema/header',$meta);
            $this->load->view(akses().'/penilaian/penilaian/penilaianadd');
            $this->load->view('tema/footer');
        }
    }
        
    function edit()
    {
        $this->form_validation->set_rules('penilaianid','ID penilaian','required');
        $this->form_validation->set_rules('judul','Judul penilaian','required');
        $this->form_validation->set_rules('keterangan','Keterangan penilaian','required');
        $this->form_validation->set_rules('tahun','Tahun Bulan penilaian','required');
        $this->form_validation->set_rules('kuota','Kuota penilaian','required');
        if($this->form_validation->run()==TRUE)
        {
            $penilaianid=$this->input->post('penilaianid');
            $judul=$this->input->post('judul');
            $ket=$this->input->post('keterangan');
            $tahun=$this->input->post('tahun');
            $kuota=$this->input->post('kuota');
            
            if($this->mod_penilaian->penilaian_edit($penilaianid,$judul,$ket,$tahun,$kuota)==TRUE)
            {
                set_header_message('success','Ubah penilaian','Berhasil mengubah penilaian');
                redirect(base_url(akses()).'/penilaian/penilaian');
            }else{
                set_header_message('danger','Ubah penilaian','Gagal mengubah penilaian');
                redirect(base_url(akses()).'/penilaian/penilaian');
            }
        }else{
            $id=$this->input->get('id');
            $meta['judul']="Ubah Penilaian";
            $this->load->view('tema/header',$meta);
            $d['data']=$this->mod_penilaian->penilaian_data(array('penilaian_id'=>$id));
            $this->load->view(akses().'/penilaian/penilaian/penilaianedit',$d);
            $this->load->view('tema/footer');
        }
    }
    
    function delete()
    {
        $id=$this->input->get('id');
        if($this->mod_penilaian->penilaian_delete($id)==TRUE)
        {
            set_header_message('success','Hapus penilaian','Berhasil menghapus penilaian');
            redirect(base_url(akses()).'/penilaian/penilaian');
        }else{
            set_header_message('danger','Hapus penilaian','Gagal menghapus penilaian');
            redirect(base_url(akses()).'/penilaian/penilaian');
        }
    }
    
    function proses()
    {
        $id=$this->input->get('id');
        $nama=$this->mod_penilaian->penilaian_info($id,'judul');
        $meta['judul']="Daftar Penilaian ".$nama;
        $this->load->view('tema/header',$meta);
        $d['data']=$this->mod_penilaian->penilaian_data(array('penilaian_id'=>$id));
        $this->load->view(akses().'/penilaian/penilaian/prosesview',$d);
        $this->load->view('tema/footer');
    }
    
    function proseshitung()
    {
        $id=$this->input->get('id');
        $this->mod_penilaian->proseshitung($id);
        if($this->mod_penilaian->proseshitung($id)==TRUE)
        {
            //set_header_message('success','Proses penilaian','penilaian telah diproses');
            //redirect(base_url(akses().'/penilaian/penilaian').'?id='.$id);
            echo json_encode(array('status'=>'ok'));
        }else{
            //set_header_message('danger','Proses penilaian','penilaian gagal diproses');
            //redirect(base_url(akses().'/penilaian/penilaian'));
            echo json_encode(array('status'=>'no'));
        }       
    }
    
}
