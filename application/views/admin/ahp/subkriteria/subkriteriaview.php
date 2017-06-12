<link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/plugins/datatables/dataTables.bootstrap.css"/>
<script src="<?=base_url();?>konten/tema/lte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>konten/tema/lte/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	$('#datatable').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
      "order": [[ 1, "asc" ]],
        "oLanguage": {
            "sProcessing": '<i class="fa fa-spinner fa-pulse fa-3x"></i>'
      },
    });
});
</script>
<div>
	<a href="<?=base_url(akses().'/ahp/subkriteria/add').$kriteria;?>" class="btn btn-primary btn-md">Tambah Parameter</a>
</div>
<p>&nbsp;</p>
<table class="table table-border table-hover" id="datatable">
	<thead>
		<th>Sub Kriteria</th>
		<th>Nilai</th>
		<th></th>
	</thead>
	<tbody>
		<?php
		if(!empty($data))
		{
			foreach($data as $row)
			{
				$link=str_replace("?","&",$kriteria);
				$id=$row->subkriteria_id;
				$namaUtama=field_value('kriteria','kriteria_id',$row->kriteria_id,'nama_kriteria');
				$nilainama="(".$row->nilai_id.") ".field_value('nilai_kategori','nilai_id',$row->nilai_id,'nama_nilai');
			?>
			<tr>
				<td><?=$namaUtama." ".$row->nama_subkriteria;?></td>
				<td><?=$nilainama;?></td>
				<td>
					<a href="<?=base_url(akses().'/ahp/subkriteria/edit').'?id='.$id.$link;?>" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
							<a onclick="return confirm('Yakin ingin menghapus data ini?');" href="<?=base_url(akses().'/ahp/subkriteria/delete');?>?id=<?=$id.$link;?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
				</td>
			</tr>
			<?php
			}
		}
		?>
	</tbody>
</table>