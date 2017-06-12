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
	<a href="<?=base_url(akses().'/penilaian/peserta/add'.$link);?>" class="btn btn-primary btn-md">Tambah Peserta</a>
</div>
<table class="table table-border table-hover" id="datatable">
	<thead>
		<th>NIP</th>
		<th>Nama</th>
		<th>Divisi</th>
		<!-- <th>Semester</th> -->
		<th>Tahun Masuk</th>
		<th>Penilaian</th>
		<th>Status</th>
		<th></th>
	</thead>
	<tbody>
		<?php
		if(!empty($data))
		{
			foreach($data as $row)
			{
				$id=$row->karyawan_id;
				$pid=$row->peserta_id;
			?>
			<tr>
				<td><?=$row->nisn;?></td>				
				<td><?=$row->nama;?></td>
				<td><?=$row->divisi;?></td>				
				<!-- <td><?=$row->semester;?></td> -->
				<td><?=$row->tahun;?></td>
				<td><?=$row->judul;?></td>
				<td><?=ucwords($row->status);?></td>
				<td>
					<?php
					$s=array(
			        );
			        if($this->m_db->is_bof('karyawan',$s)==FALSE)
			        {
					?>
					<a href="<?=base_url(akses().'/penilaian/peserta/edit');?>?peserta=<?=$pid;?>" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
					<a onclick="return confirm('Yakin ingin menghapus karyawan ini?');" href="<?=base_url(akses().'/penilaian/peserta/delete');?>?peserta=<?=$pid;?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
					<?php	
					}
					?>					
				</td>
			</tr>
			<?php
			}
		}
		?>
	</tbody>
</table>