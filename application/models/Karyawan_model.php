<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Karyawan_model extends CI_Model
{
	private $tb_karyawan='karyawan';
    function __construct()
    {
         $this->load->library('m_db');
    }
    
    function karyawan_data($where=array(),$order="nama ASC")
    {
		$d=$this->m_db->get_data($this->tb_karyawan,$where,$order);
		return $d;
	}
	
	function karyawan_info($karyawanID,$output)
	{
		$s=array(
		'karyawan_id'=>$karyawanID,
		);
		$item=$this->m_db->get_row($this->tb_karyawan,$s,$output);
		return $item;
	}
	
	function karyawan_add($nisn,$nama,$divisi,$jk,$tahun,$tmp_lahir,$tgl_lahir,$alamat='',$anak_ke='',$saudara='',$nama_ayah='',$kerja_ayah='',$nama_ibu='',$kerja_ibu='')
	{
		$s=array(
			'nisn'=>$nisn,
		);
		if($this->m_db->is_bof($this->tb_karyawan,$s)==TRUE)
		{
				$user_id=$this->m_db->last_insert_id();
				$d=array(
				'nisn'=>$nisn,
				'nama'=>$nama,
				'divisi'=>$divisi,
				'jenkel'=>$jk,
				'tahun'=>$tahun,
				'user_id'=>$user_id,
				'tempat_lahir'=>$tmp_lahir,
				'tgl_lahir'=>$tgl_lahir,
				'alamat'=>$alamat,
				);
				if($this->m_db->add_row($this->tb_karyawan,$d)==TRUE)
				{
					return true;
				}else{
					$this->m_db->delete_row('pengguna',array('user_id'=>$user_id));
					return $this->db->_error_message();
				}
		}else{
			return false;
		}
	}
	
	function karyawan_edit($karyawanID,$nisn,$nama,$divisi,$jk,$tahun,$tmp_lahir,$tgl_lahir,$alamat='',$anak_ke='',$saudara='',$nama_ayah='',$kerja_ayah='',$nama_ibu='',$kerja_ibu='')
	{
		$s=array(
			'nisn'=>$nisn,
		);
		$skaryawan=array(
			'karyawan_id'=>$karyawanID,
		);
		$c=$this->m_db->count_data($this->tb_karyawan,$s);
		if($c < 2)
		{
			if($this->m_db->is_bof('karyawan',$skaryawan)==FALSE)
			{
				$d=array(
					'nisn'=>$nisn,
					'nama'=>$nama,
					'divisi'=>$divisi,
					'jenkel'=>$jk,
					'tahun'=>$tahun,
					'tempat_lahir'=>$tmp_lahir,
					'tgl_lahir'=>$tgl_lahir,
					'alamat'=>$alamat,
				);
				if($this->m_db->edit_row($this->tb_karyawan,$d,$skaryawan)==TRUE)
				{
					return true;
				}else{					
					return false;
				}			
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	function karyawan_edit_karyawan($karyawanID,$nisn,$nama,$jk,$tahun,$tmp_lahir,$tgl_lahir,$alamat='',$anak_ke='',$saudara='',$nama_ayah='',$kerja_ayah='',$nama_ibu='',$kerja_ibu='')
	{		
		$skaryawan=array(
		'karyawan_id'=>$karyawanID,
		);
					
		$d=array(
		'nisn'=>$nisn,
		'nama'=>$nama,
		'jenkel'=>$jk,
		'tahun'=>$tahun,
		'tempat_lahir'=>$tmp_lahir,
		'tgl_lahir'=>$tgl_lahir,
		'alamat'=>$alamat,
		'anak_ke'=>$anak_ke,
		'saudara'=>$saudara,
		'nama_ayah'=>$nama_ayah,
		'pekerjaan_ayah'=>$kerja_ayah,
		'nama_ibu'=>$nama_ibu,
		'pekerjaan_ibu'=>$kerja_ibu,
		);
		if($this->m_db->edit_row($this->tb_karyawan,$d,$skaryawan)==TRUE)
		{
			return true;
		}else{					
			return false;
		}
	}
	
	function karyawan_delete($karyawanID)
	{
		$s=array(
        'karyawan_id'=>$karyawanID,
        );
        $userid=$this->m_db->get_row('karyawan',$s,'user_id');
        if($this->m_db->delete_row('karyawan',$s)==TRUE)
        {
        	// $this->m_db->delete_row('pengguna',array('user_id'=>$userid));
			return true;
		}else{
			return false;
		}
	}
}