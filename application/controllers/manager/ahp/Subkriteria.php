<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Subkriteria extends CI_Controller
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
		$this->load->model('kriteria_model','mod_kriteria');
    }
    
    function index()
    {        
        $kriteria=$this->input->get('kriteria');
        $s=array();
        $nama="";
        if(!empty($kriteria))
        {
			$s=array(
			'kriteria_id'=>$kriteria,
			);
			$exnama=field_value('kriteria','kriteria_id',$kriteria,'nama_kriteria');
			$nama=" ".$exnama;
		}
		$meta['judul']="Parameter".$nama;
        $this->load->view('tema/header',$meta);
        $d['data']=$this->mod_kriteria->subkriteria_data($s);
        $d['kriteria']=$kriteria?"?kriteria=".$kriteria:"";
        $this->load->view(akses().'/ahp/subkriteria/subkriteriaview',$d);
        $this->load->view('tema/footer');
    }
    
    function add()
    {		
		$this->form_validation->set_rules('kriteriaid','Kriteria Utama','required');
		$this->form_validation->set_rules('nilaiid','Tipe','required');
		if($this->form_validation->run()==TRUE)
		{
			$ref=$this->input->get('kriteria');
			$link=$ref?"?kriteria=".$ref:"";
			$kriteriaid=$this->input->post('kriteriaid');
			$nilaiid=$this->input->post('nilaiid');
			$tipe=$this->input->post('tipe');			
			$max=$this->input->post('max');
			$opmax=$this->input->post('opmax');
			$min=$this->input->post('min');
			$opmin=$this->input->post('opmin');
			$ket=$this->input->post('ket');
			
			$isi='';
			if($tipe=="teks")
			{
				$isi=$ket;
			}elseif($tipe=="nilai"){
				$isi=$max;
			}
			if($this->mod_kriteria->subkriteria_add($tipe,$kriteriaid,$opmax,$isi,$opmin,$min,$nilaiid)==TRUE)
			{
				set_header_message('success','Tambah Parameter','Berhasil menambah parameter');
				redirect(base_url(akses().'/ahp/subkriteria').$link);
			}else{
				set_header_message('danger','Tambah Parameter','Gagal menambah parameter');
				redirect(base_url(akses().'/ahp/subkriteria/add').$link);
			}
		}else{
			$kriteria=$this->input->get('kriteria');
			$meta['judul']="Tambah Parameter";
	        $this->load->view('tema/header',$meta);
	        $d['utama']=$this->mod_kriteria->kriteria_data();
	        $d['nilai']=$this->m_db->get_data('nilai_kategori');
	        $d['kriteria']=$kriteria?"?kriteria=".$kriteria:"";
	        $this->load->view(akses().'/ahp/subkriteria/subkriteriaadd',$d);
	        $this->load->view('tema/footer');
		}
	}
	
	function edit()
    {		
		$this->form_validation->set_rules('subkriteria','Parameter Id','required');
		$this->form_validation->set_rules('kriteriaid','Kriteria Utama','required');
		$this->form_validation->set_rules('nilaiid','Tipe','required');
		if($this->form_validation->run()==TRUE)
		{			
			$ref=$this->input->get('kriteria');
			$link=$ref?"?kriteria=".$ref:"";
			$subID=$this->input->post('subkriteria');
			$kriteriaid=$this->input->post('kriteriaid');
			$nilaiid=$this->input->post('nilaiid');
			$tipe=$this->input->post('tipe');			
			$max=$this->input->post('max');
			$opmax=$this->input->post('opmax');
			$min=$this->input->post('min');
			$opmin=$this->input->post('opmin');
			$ket=$this->input->post('ket');
			
			$isi='';
			if($tipe=="teks")
			{
				$isi=$ket;
			}elseif($tipe=="nilai"){
				$isi=$max;
			}
			if($this->mod_kriteria->subkriteria_edit($subID,$tipe,$kriteriaid,$opmax,$isi,$opmin,$min,$nilaiid)==TRUE)
			{
				set_header_message('success','Ubah Parameter','Berhasil mengubah parameter');
				redirect(base_url(akses().'/ahp/subkriteria').$link);
			}else{
				set_header_message('danger','Ubah Parameter','Gagal mengubah parameter');
				redirect(base_url(akses().'/ahp/subkriteria').$link);
			}
		}else{
			$id=$this->input->get('id');
			$kriteria=$this->input->get('kriteria');
			$meta['judul']="Ubah Parameter";
	        $this->load->view('tema/header',$meta);
	        $d['utama']=$this->mod_kriteria->kriteria_data();
	        $d['nilai']=$this->m_db->get_data('nilai_kategori');
	        $d['kriteria']=$kriteria?"?kriteria=".$kriteria:"";
	        $d['data']=$this->mod_kriteria->subkriteria_data(array('subkriteria_id'=>$id));
	        $this->load->view(akses().'/ahp/subkriteria/subkriteriaedit',$d);
	        $this->load->view('tema/footer');
		}
	}
	
	function delete()
	{
		$id=$this->input->get('id');
		$kriteria=$this->input->get('kriteria');
		$link=$kriteria?"?kriteria=".$kriteria:"";
		if($this->mod_kriteria->subkriteria_delete($id)==TRUE)
		{
			set_header_message('success','Hapus Parameter','Berhasil menghapus parameter');
			redirect(base_url(akses().'/ahp/subkriteria').$link);
		}else{
			set_header_message('danger','Hapus Parameter','Gagal menghapus parameter');
			redirect(base_url(akses().'/ahp/subkriteria').$link);
		}
	}
    
}
