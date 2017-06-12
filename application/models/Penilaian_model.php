<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Penilaian_model extends CI_Model
{	
    function __construct()
    {
         $this->load->library('m_db');
    }
    
    function penilaian_data($where=array(),$order="judul ASC")
    {
		$d=$this->m_db->get_data('penilaian',$where,$order);
		return $d;
	}
	
	function penilaian_info($beaID,$output)
	{
		$s=array(
			'penilaian_id'=>$beaID,
		);
		$item=$this->m_db->get_row('penilaian',$s,$output);
		return $item;
	}
	
	function penilaian_add($judul,$keterangan,$tahun,$kuota)
	{
		$d=array(
			'judul'=>$judul,
			'keterangan'=>$keterangan,
			'tahun'=>$tahun,
			'kuota'=>$kuota,
		);
		if($this->m_db->add_row('penilaian',$d)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function penilaian_edit($beaID,$judul,$keterangan,$tahun,$kuota)
	{
		$s=array(
		'penilaian_id'=>$beaID,
		);
		$d=array(
		'judul'=>$judul,
		'keterangan'=>$keterangan,
		'tahun'=>$tahun,
		'kuota'=>$kuota,
		);
		if($this->m_db->edit_row('penilaian',$d,$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function penilaian_delete($beaID)
	{
		$s=array(
		'penilaian_id'=>$beaID,
		);		
		if($this->m_db->delete_row('penilaian',$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function penilaian_open($beaID)
	{
		$s=array(
		'penilaian_id'=>$beaID,
		);
		$d=array(		
		'status'=>'buka',
		);
		if($this->m_db->edit_row('penilaian',$d,$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	function penilaian_close($beaID)
	{
		$s=array(
		'penilaian_id'=>$beaID,
		);
		$d=array(		
		'status'=>'tutup',
		);
		if($this->m_db->edit_row('penilaian',$d,$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function peserta_add($karyawanID,$kelas,$jurusan,$wali,$penilaianID,$kriteriaData=array())
	{
		$s=array(
        // 'kelas'=>$kelas,
        // 'jurusan'=>$jurusan,
        // 'walikelas_id'=>$wali,
        'karyawan_id'=>$karyawanID,
        );
        if($this->m_db->is_bof('karyawan',$s)==FALSE)
        {
        	if(!empty($kriteriaData))
        	{
				$d=array(
				'penilaian_id'=>$penilaianID,
				'karyawan_id'=>$karyawanID,
				);
				if($this->m_db->add_row('peserta',$d)==TRUE)
				{
					$pesertaID=$this->m_db->last_insert_id();
					foreach($kriteriaData as $rK=>$rV)
					{
						$d2=array(
						'peserta_id'=>$pesertaID,
						'kriteria_id'=>$rK,
						'nilai_id'=>$rV,
						);
						$this->m_db->add_row('peserta_nilai',$d2);
					}
					return true;
				}else{
					//echo "GAGAL TAMBAH PESERTA";
					return false;
				}
			}else{
				//echo "DATA KRITERIA TAK ADA";
				return false;
			}		
		}else{
			//echo "karyawan TIDAK ADA";
			return false;
		}
	}
	
	function peserta_edit($pesertaID,$karyawanID,$kelas,$jurusan,$wali,$penilaianID,$kriteriaData=array())
	{
		$s=array(
        // 'kelas'=>$kelas,
        // 'jurusan'=>$jurusan,
        // 'walikelas_id'=>$wali,
        'karyawan_id'=>$karyawanID,
        );
        if($this->m_db->is_bof('karyawan',$s)==FALSE)
        {
        	$speserta=array(
        	'peserta_id'=>$pesertaID,
        	);
        	
        	if($this->m_db->is_bof('peserta',$speserta)==FALSE)
        	{
							
        	if(!empty($kriteriaData))
        	{
				$d=array(
				'penilaian_id'=>$penilaianID,
				'karyawan_id'=>$karyawanID,
				);
				if($this->m_db->edit_row('peserta',$d,$speserta)==TRUE)
				{
					//$pesertaID=$this->m_db->last_insert_id();
					foreach($kriteriaData as $rK=>$rV)
					{
						$s2=array(
						'peserta_id'=>$pesertaID,
						'kriteria_id'=>$rK,
						);
						if($this->m_db->is_bof('peserta_nilai',$s2)==TRUE)
						{
							$d2=array(
							'peserta_id'=>$pesertaID,
							'kriteria_id'=>$rK,
							'nilai_id'=>$rV,
							);
							$this->m_db->add_row('peserta_nilai',$d2);
						}else{
							$d2=array(												
							'nilai_id'=>$rV,
							);
							$this->m_db->edit_row('peserta_nilai',$d2,$s2);
						}						
					}
					return true;
				}else{
					//echo "GAGAL UBAH PESERTA";
					return false;
				}
			}else{
				//echo "DATA KRITERIA TAK ADA";
				return false;
			}	
			
			}else{
				return false;
			}	
		}else{
			//echo "karyawan TIDAK ADA";
			return false;
		}
	}
	
	function peserta_delete($pesertaID,$kelas,$jurusan,$wali)
	{
		$karyawanID=field_value('peserta','peserta_id',$pesertaID,'karyawan_id');
		$s=array(
        // 'kelas'=>$kelas,
        // 'jurusan'=>$jurusan,
        // 'walikelas_id'=>$wali,
        'karyawan_id'=>$karyawanID,
        );
        if($this->m_db->is_bof('karyawan',$s)==FALSE)
        {
        	$speserta=array(
        	'peserta_id'=>$pesertaID,
        	);
        	
        	if($this->m_db->is_bof('peserta',$speserta)==FALSE)
        	{
        		if($this->m_db->delete_row('peserta',$speserta)==TRUE)
        		{
        			$this->m_db->delete_row('peserta_nilai',$speserta);
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
	
	function peserta_delete_admin($pesertaID)
	{
		$karyawanID=field_value('peserta','peserta_id',$pesertaID,'karyawan_id');		
    	$speserta=array(
    	'peserta_id'=>$pesertaID,
    	);
    	
    	if($this->m_db->is_bof('peserta',$speserta)==FALSE)
    	{
    		if($this->m_db->delete_row('peserta',$speserta)==TRUE)
    		{
    			$this->m_db->delete_row('peserta_nilai',$speserta);
				return true;
			}else{
				return false;
			}
    		
    	}else{
			return false;
		}
	}
	
	function proseshitung($penilaianID)
	{
		$s=array(
			'penilaian_id'=>$penilaianID,
		);
		$dKriteria=$this->mod_kriteria->kriteria_data();
		if($this->m_db->is_bof('penilaian',$s)==FALSE)
		{
			$dPeserta=$this->m_db->get_data('peserta',$s);
			if(!empty($dPeserta))
			{
				foreach($dPeserta as $rPeserta)
				{
					$pesertaID=$rPeserta->peserta_id;
					$karyawanID=$rPeserta->karyawan_id;
					$NISN=field_value('karyawan','karyawan_id',$karyawanID,'nisn');
					$nama=field_value('karyawan','karyawan_id',$karyawanID,'nama');			
					$total=0;
					if(!empty($dKriteria))
					{
						foreach($dKriteria as $rKriteria)
						{						
							$kriteriaid=$rKriteria->kriteria_id;
							$subkriteria=peserta_nilai($pesertaID,$kriteriaid);
							$nilaiID=field_value('subkriteria','subkriteria_id',$subkriteria,'nilai_id');
							$nilai=field_value('nilai_kategori','nilai_id',$nilaiID,'nama_nilai');
							$prioritas=ambil_prioritas($penilaianID,$subkriteria);
							$prioritaskriteria = get_prioritas_kriteria($penilaianID, $kriteriaid);
							$prioritas = $prioritas * $prioritaskriteria;
							$total+=$prioritas;
						}						
					}
					
					$shasil=array(
						'peserta_id'=>$pesertaID,
						'penilaian_id'=>$penilaianID,
					);
					$dhasil=array(
						'total'=>$total,
					);
					$this->m_db->edit_row('peserta',$dhasil,$shasil);
					$kuota=$this->penilaian_info($penilaianID,'kuota');
			
					$dPH=$this->m_db->get_data('peserta',$s,'total DESC');
					$rank=0;
					foreach($dPH as $rPH)
					{
						$rank+=1;
						$d=array();
						if($rank <= $kuota)
						{
							$d=array(
							'status'=>'terpilih',
							);
						}else{
							$d=array(
							'status'=>'tidak terpilih',
							);
						}
						$this->m_db->edit_row('peserta',$d,array('peserta_id'=>$rPH->peserta_id));
					}
				}
				return true;
			}else{
				return false;
			}
			
		}else{
			return false;
		}
	}
}