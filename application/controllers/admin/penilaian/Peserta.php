<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Peserta extends CI_Controller
{
	private $x_wali;
	private $x_kelas;
	private $x_jurusan;
    function __construct()
    {
        parent::__construct();        
        $this->load->library('form_validation');
        $this->load->library('m_db');
        if(akses()!="admin")
        {
			redirect(base_url().'logout');
		}
		$this->load->model('penilaian_model','mod_penilaian');
		$this->load->model('karyawan_model','mod_karyawan');
		$this->load->model('kriteria_model','mod_kriteria');
		$s=array(
		'user_id'=>6,
		);
    }
    
    function index()
    {
    	$bearef=$this->input->get('id');
    	$ref=$bearef?"?id=".$bearef:"";
    	
    	$id=$this->input->get('id');
    	$s="";
    	$nama="";
    	if(!empty($id))
    	{
			$s=" Where penilaian.penilaian_id='$id'";
			$nama=" ".field_value('penilaian','penilaian_id',$id,'judul');
		}
    	$sql="SELECT peserta.peserta_id,karyawan.karyawan_id,karyawan.nisn,karyawan.nama,karyawan.kelas,karyawan.jurusan,karyawan.divisi,karyawan.tahun,penilaian.judul,peserta.status FROM (peserta LEFT JOIN karyawan ON peserta.karyawan_id = karyawan.karyawan_id) LEFT JOIN penilaian ON peserta.penilaian_id = penilaian.penilaian_id".$s;
        $meta['judul']="Peserta penilaian".$nama;
        $this->load->view('tema/header',$meta);
        $d['data']=$this->m_db->get_query_data($sql);
        $d['link']=$ref;
        $this->load->view(akses().'/penilaian/peserta/pesertaview',$d);
        $this->load->view('tema/footer');
    }
    
    function getpeserta()
    {
		$penilaian=$this->input->get('penilaian');
		if(!empty($penilaian))
		{
			$s=array(
			'penilaian_id'=>$penilaian,
			);
			$d=$this->m_db->get_data('peserta',$s);
			if(!empty($d))
			{
				$listkaryawan="";
				foreach($d as $r)
				{
					$listkaryawan.=$r->karyawan_id.",";
				}
				$listkaryawan=substr($listkaryawan,0,-1);
				
				$sql="Select * from karyawan Where karyawan_id NOT IN ($listkaryawan)";
				$o=$this->m_db->get_query_data($sql);
				echo json_encode($o);
			}else{
				$d=$this->mod_karyawan->karyawan_data();
				echo json_encode($d);
			}
		}else{
			echo json_encode(array());
		}
	}
    
    function add()
    {
    	$bearef=$this->input->get('id');
    	$ref=$bearef?"?id=".$bearef:"";
		$this->form_validation->set_rules('karyawanid','ID karyawan','required');
		$this->form_validation->set_rules('penilaianid','ID penilaian','required');
		if($this->form_validation->run()==TRUE)
		{			
			$karyawan=$this->input->post('karyawanid');
			$penilaian=$this->input->post('penilaianid');
			$kriteria=$this->input->post('kriteria');
			
			
			
			if($this->mod_penilaian->peserta_add($karyawan,$this->x_kelas,$this->x_jurusan,$this->x_wali,$penilaian,$kriteria)==TRUE)
			{
				set_header_message('success','Tambah Peserta','Berhasil menambah peserta penilaian');
				redirect(base_url(akses().'/penilaian/peserta'.$ref));
			}else{
				set_header_message('danger','Tambah Peserta','Gagal menambah peserta penilaian');
				redirect(base_url(akses().'/penilaian/peserta/add'.$ref));
			}
		}else{
			$meta['judul']="Tambah Peserta";
	        $this->load->view('tema/header',$meta);
	        $d['link']=$ref;
	        $d['penilaian']=$this->mod_penilaian->penilaian_data();
	        $d['penilaianid']=$bearef;
	        $s=array(

	        );
	        $d['karyawan']=$this->mod_karyawan->karyawan_data($s);
	        $d['kriteria']=$this->mod_kriteria->kriteria_data();
	        $this->load->view(akses().'/penilaian/peserta/pesertaadd',$d);
	        $this->load->view('tema/footer');
		}
	}
	
	function edit()
	{
		$bearef=$this->input->get('id');
    	$ref=$bearef?"?id=".$bearef:"";
		$this->form_validation->set_rules('pesertaid','ID karyawan','required');
		$this->form_validation->set_rules('karyawanid','ID karyawan','required');
		$this->form_validation->set_rules('penilaianid','ID penilaian','required');
		if($this->form_validation->run()==TRUE)
		{			
			$pesertaid=$this->input->post('pesertaid');
			$karyawan=$this->input->post('karyawanid');
			$penilaian=$this->input->post('penilaianid');
			$kriteria=$this->input->post('kriteria');			
			
			if($this->mod_penilaian->peserta_edit($pesertaid,$karyawan,$this->x_kelas,$this->x_jurusan,$this->x_wali,$penilaian,$kriteria)==TRUE)
			{
				set_header_message('success','Ubah Peserta','Berhasil mengubah peserta penilaian');
				redirect(base_url(akses().'/penilaian/peserta'.$ref));
			}else{
				set_header_message('danger','Ubah Peserta','Gagal mengubah peserta penilaian');
				redirect(base_url(akses().'/penilaian/peserta'.$ref));
			}
			
		}else{
			$id=$this->input->get('peserta');
			$karyawanid=field_value('peserta','peserta_id',$id,'karyawan_id');
			$s=array(
	        );
	        if($this->m_db->is_bof('karyawan',$s)==FALSE)
	        {
				$meta['judul']="Ubah Peserta";
		        $this->load->view('tema/header',$meta);
		        $d['link']=$ref;
		        $d['penilaian']=$this->mod_penilaian->penilaian_data();
		        $d['penilaianid']=$bearef;
		        $s=array(
		        'kelas'=>$this->x_kelas,
		        'jurusan'=>$this->x_jurusan,
		        'walikelas_id'=>$this->x_wali,
		        );
		        $d['karyawan']=$this->mod_karyawan->karyawan_data($s);
		        $d['kriteria']=$this->mod_kriteria->kriteria_data();
		        $d['data']=$this->m_db->get_data('peserta',array('peserta_id'=>$id));
		        $this->load->view(akses().'/penilaian/peserta/pesertaedit',$d);
		        $this->load->view('tema/footer');
		    }else{
				redirect(base_url(akses().'/penilaian/peserta'));
			}
		}
	}
	
	function delete()
	{
		$id=$this->input->get('peserta');
		if($this->mod_penilaian->peserta_delete($id,$this->x_kelas,$this->x_jurusan,$this->x_wali)==TRUE)
		{
			set_header_message('success','Hapus Peserta','Berhasil menghapus peserta');
			redirect(base_url(akses().'/penilaian/peserta'));
		}else{
			set_header_message('danger','Hapus Peserta','Gagal menghapus peserta');
			redirect(base_url(akses().'/penilaian/peserta'));
		}
	}
    
}
