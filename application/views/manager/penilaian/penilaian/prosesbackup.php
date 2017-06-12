<table class="table table-bordered">
<thead>
	<th>Nama karyawan</th>
	<?php
	$dKriteria=$this->mod_kriteria->kriteria_data();
	if(!empty($dKriteria))
	{
		foreach($dKriteria as $rKriteria)
		{
			echo '<th>'.$rKriteria->nama_kriteria.'</th>';
		}
	}
	?>
	<th>Total</th>
</thead>
<?php
$s=array(
'penilaian_id'=>$penilaianID,
);
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
			
			?>
			<tr>
				<td><?=$NISN." ".$nama;?></td>
				<?php
				$total=0;
				if(!empty($dKriteria))
				{
					foreach($dKriteria as $rKriteria)
					{						
						$kriteriaid=$rKriteria->kriteria_id;
						$subkriteria=peserta_nilai($pesertaID,$kriteriaid);
						$nilaiID=field_value('subkriteria','subkriteria_id',$subkriteria,'nilai_id');
						$nilai=field_value('nilai_kategori','nilai_id',$nilaiID,'nama_nilai');
						$prioritas=ambil_prioritas($penilaianid,$subkriteria);
						$total+=$prioritas;
						echo '<td>'.number_format($prioritas,2).'</td>';
					}
				}
				?>
				<td><?=number_format($total,2);?></td>
			</tr>			
			<?php
			
		}
		
	}else{
		return false;
	}
	
}else{
	return false;
}
?>
</table>