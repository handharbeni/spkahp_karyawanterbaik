<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kriteria_model extends CI_Model
{	
	private $tb_kriteria='kriteria';	
	private $tb_kriteria_nilai='kriteria_nilai';
	private $tb_subkriteria='subkriteria';
    function __construct()
    {
         $this->load->library('m_db');
    }
    
    function kriteria_data($where=array(),$order="kriteria_id ASC")
    {
		$d=$this->m_db->get_data($this->tb_kriteria,$where,$order);
		return $d;
	}
	
	function kriteria_info($kriteriaID,$output)
	{
		$s=array(
		'kriteria_id'=>$kriteriaID,
		);
		$item=$this->m_db->get_row($this->tb_kriteria,$s,$output);
		return $item;
	}
	
	function kriteria_add($nama)
	{
		$d=array(
		'nama_kriteria'=>$nama,
		);
		if($this->m_db->add_row($this->tb_kriteria,$d)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function kriteria_edit($kriteriaID,$nama)
	{
		$s=array(
		'kriteria_id'=>$kriteriaID,
		);
		$d=array(
		'nama_kriteria'=>$nama,
		);
		if($this->m_db->edit_row($this->tb_kriteria,$d,$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function kriteria_delete($kriteriaID)
	{
		$s=array(
		'kriteria_id'=>$kriteriaID,
		);
		if($this->m_db->delete_row($this->tb_kriteria,$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function subkriteria_data($where=array(),$order="nama_subkriteria ASC")
	{
		$d=$this->m_db->get_data($this->tb_subkriteria,$where,$order);
		return $d;
	}
	
	function subkriteria_child($kriteriaID,$order="nama_subkriteria")
	{
		$s=array(
		'kriteria_id'=>$kriteriaID,
		);
		$d=$this->subkriteria_data($s,$order);
		return $d;
	}
	
	function subkriteria_add($tipe,$kriteria,$opmax=NULL,$max,$opmin=NULL,$min,$nilai)
	{
		$d=array();
		if($tipe=="teks")
		{
			$d=array(
			'nama_subkriteria'=>$max,
			'kriteria_id'=>$kriteria,
			'tipe'=>$tipe,
			'nilai_id'=>$nilai,
			);
		}else{
			$d=array(
			'nama_subkriteria'=>$opmin." ".$min." ".$opmax." ".$max,
			'kriteria_id'=>$kriteria,
			'tipe'=>$tipe,
			'nilai_minimum'=>$min,
			'nilai_maksimum'=>$max,
			'op_min'=>$opmin,
			'op_max'=>$opmax,
			'nilai_id'=>$nilai,
			);
		}
		
		if($this->m_db->add_row($this->tb_subkriteria,$d)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function subkriteria_edit($subkriteriaID,$tipe,$kriteria,$opmax=NULL,$max,$opmin=NULL,$min,$nilai)
	{
		$s=array(
		'subkriteria_id'=>$subkriteriaID,
		);
		$d=array();
		if($tipe=="teks")
		{
			$d=array(
			'nama_subkriteria'=>$max,
			'kriteria_id'=>$kriteria,
			'tipe'=>$tipe,
			'nilai_id'=>$nilai,
			);
		}else{
			$d=array(
			'nama_subkriteria'=>$opmin." ".$min." ".$opmax." ".$max,
			'kriteria_id'=>$kriteria,
			'tipe'=>$tipe,
			'nilai_minimum'=>$min,
			'nilai_maksimum'=>$max,
			'op_min'=>$opmin,
			'op_max'=>$opmax,
			'nilai_id'=>$nilai,
			);
		}
		
		if($this->m_db->edit_row($this->tb_subkriteria,$d,$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function subkriteria_delete($subKriteriaID)
	{
		$s=array(
		'subkriteria_id'=>$subKriteriaID,
		);
		if($this->m_db->delete_row($this->tb_subkriteria,$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
}