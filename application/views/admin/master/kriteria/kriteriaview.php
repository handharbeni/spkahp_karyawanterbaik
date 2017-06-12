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
    });
});
</script>
<div>
	<a href="<?=base_url(akses().'/master/kriteria/add');?>" class="btn btn-primary btn-md">Tambah Kriteria</a>
</div>
<table class="table table-border table-hover" id="datatable">
	<thead>
		<th>No</th>
		<th>Nama Kriteria</th>		
		<th></th>
	</thead>
	<tbody>
		<?php
		$no=0;
		if(!empty($data))
		{
			foreach($data as $row)
			{
				$no+=1;
				$id=$row->kriteria_id;
			?>
			<tr>
				<td width="10%"><?=$no;?></td>
				<td width="70%"><?=$row->nama_kriteria;?></td>
				<td>
					<a title="Parameter Kriteria" href="<?=base_url(akses().'/master/kriteria/subkriteria');?>?kriteria=<?=$id;?>" class="btn btn-xs btn-success"><i class="fa fa-level-down"></i> Parameter</a>
					<a title="Edit Kriteria" href="<?=base_url(akses().'/master/kriteria/edit');?>?id=<?=$id;?>" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> Edit</a>
					<a title="Hapus Kriteria" onclick="return confirm('Yakin ingin menghapus kriteria ini?');" href="<?=base_url(akses().'/master/kriteria/delete');?>?id=<?=$id;?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
				</td>
			</tr>
			<?php
			}
		}
		?>
	</tbody>
</table>