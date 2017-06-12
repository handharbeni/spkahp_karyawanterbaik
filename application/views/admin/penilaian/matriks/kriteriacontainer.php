<script type="text/javascript">
$(document).ready(function () {
	$("#formcari").submit(function(e){
		e.preventDefault();
		$.ajax({
			type:'get',
			dataType:'html',
			url:"<?=base_url(akses().'/penilaian/kriteria/gethtml');?>",
			data:$(this).serialize(),
			error:function(){
				$("#matrik").html('Gagal mengambil data matrik');
			},
			beforeSend:function(){
				$("#matrik").html('Mengambil data matrik. Tunggu sebentar');
			},
			success:function(x){
				$("#matrik").html(x);
			},
		});
	});
});

function showsubdata(kriteria,penilaian)
{
	$.ajax({
			type:'get',
			dataType:'html',
			url:"<?=base_url(akses().'/penilaian/kriteria/getsub');?>",
			data:"kriteria="+kriteria+"&penilaian="+penilaian,
			error:function(){
				$("#matriksub").html('Gagal mengambil data matrik');
			},
			beforeSend:function(){
				$("#matriksub").html('Mengambil data matrik. Tunggu sebentar');
			},
			success:function(x){
				$("#matriksub").html(x);
			},
		});
}

</script>
<?php
echo validation_errors();
echo form_open('#',array('class'=>'form-horizontal','id'=>'formcari'));
?>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Pilih penilaian</label>
	<div class="col-md-10">
		<select name="penilaian" class="form-control" required="">
			<?php
			if(!empty($penilaian))
			{				
				foreach($penilaian as $rb)
				{
					echo '<option value="'.$rb->penilaian_id.'">'.$rb->penilaian_id.'-'.$rb->judul.'</option>';
				}
			}
			?>
		</select>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">&nbsp;</label>
	<div class="col-md-5">
		<button type="submit" class="btn btn-primary btn-flat">Cari</button>		
	</div>
</div>
<?php
echo form_close();
?>
<div id="matrik"></div>