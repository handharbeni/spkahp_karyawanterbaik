<table class="table table-border">
<thead>
	<th>Nama Kriteria</th>
	<th></th>
</thead>
<tbody>
	<?php
	if(!empty($data))
	{
			foreach($data as $row)
			{
				$id=$row->kriteria_id;
			?>
			<tr>
				<td>
				<?=$row->nama_kriteria;?>
				</td>
				<td>
					<a href="<?=base_url(akses().'/ahp/nilaisub/nilai');?>?kriteria=<?=$id;?>" class="btn btn-xs btn-info">Matriks</a>
				</td>
			</tr>
			<?php
			}
		}
	?>
</tbody>
</table>