<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Nilaisub extends CI_Controller
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
		$this->load->model('kriteria_model','mod_kriteria');
    }
    
    function index()
    {
        $meta['judul']="Nilai Sub Kriteria";
        $this->load->view('tema/header',$meta);
        $d['data']=$this->mod_kriteria->kriteria_data();
        $this->load->view(akses().'/ahp/nilaisub/nilaisubview',$d);
        $this->load->view('tema/footer');
    }
    
    function nilai()
    {
    	$id=$this->input->get('kriteria');
    	$namaKriteria=$this->mod_kriteria->kriteria_info($id,'nama_kriteria');
    	$dSub=$this->mod_kriteria->subkriteria_child($id);
    	$output=array();
		foreach($dSub as $rK)
		{
			$nama=field_value('nilai_kategori','nilai_id',$rK->nilai_id,'nama_nilai');
			$output[$rK->subkriteria_id]=$nama;
		}
		$meta['judul']="Sub Kriteria ".$namaKriteria;
    	$this->load->view('tema/header',$meta);    	
    	$d['arr']=$output;
    	$d['kriteriaid']=$id;
    	$this->load->view(akses().'/ahp/nilaisub/nilaimatrik',$d);
    	$this->load->view('tema/footer');
	}
	
	function update()
    {
    	$kriteria=$this->input->post('kriteriaid');
    	$error=FALSE;
    	$msg="";
    	$s=array(
    	'kriteria_id'=>$kriteria,
    	);
    	$this->m_db->delete_row('subkriteria_nilai',$s);
    	
    	$cr=$this->input->post('crvalue');
    	
    	if($cr > 0.01)
    	{
    		$msg="Gagal diupdate karena nilai CR kurang dari 0.01";
			$error=TRUE;
		}else{
			foreach($_POST as $k=>$v)
			{
				if($k!="crvalue" && $k!="kriteriaid")
				{									
					foreach($v as $x=>$x2)
					{
						$d=array(
						'kriteria_id'=>$kriteria,
						'subkriteria_id_dari'=>$k,
						'subkriteria_id_tujuan'=>$x,
						'nilai'=>$x2,
						);
						$this->m_db->add_row('subkriteria_nilai',$d);
					}
				}
			}
			$msg="Berhasil update nilai sub kriteria";
			$error=FALSE;
		}
    			
    	
    	if($error==FALSE)
    	{			
			echo json_encode(array('status'=>'ok','msg'=>$msg));
		}else{
			echo json_encode(array('status'=>'no','msg'=>$msg));
		}		
	}
    
}
