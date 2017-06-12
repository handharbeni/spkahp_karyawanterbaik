<link rel="stylesheet" href="<?=base_url();?>konten/jqueryui/jquery-ui.min.css"/>
<link rel="stylesheet" href="<?=base_url();?>konten/jqueryui/themes/overcast/jquery-ui.min.css"/>
<script src="<?=base_url();?>konten/jqueryui/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	if($(".tanggal").length)
	{
		$(".tanggal").datepicker({
			dateFormat: "yy-mm-dd",
			showAnim:"slide",
			changeMonth: true,
			changeYear: true,
			yearRange:'c-70:c+10',
		});
	}
});
</script>
<?php
if(empty($data))
{
	redirect(base_url(akses().'/karyawan'));
}
foreach($data as $row){	
}
echo validation_errors();
echo form_open(base_url(akses().'/karyawan/edit'),array('class'=>'form-horizontal'));
?>
<input type="hidden" name="karyawanid" value="<?=$row->karyawan_id;?>"/>
<div class="col-md-6">
<h3 class="heading-c">Data Karyawan</h3>
<div class="form-group required">
	<label class="col-sm-3 control-label" for="">NIP</label>
	<div class="col-md-5">
		<input type="text" name="nisn" id="" class="form-control " autocomplete="" placeholder="NIP Karyawan" required="" value="<?php echo set_value('nisn',$row->nisn); ?>"/>
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-3 control-label" for="">Nama Karyawan</label>
	<div class="col-md-9">
		<input type="text" name="nama" id="" class="form-control " autocomplete="" placeholder="Nama karyawan" required="" value="<?php echo set_value('nama',$row->nama); ?>"/>
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-3 control-label" for="">Gender</label>
	<div class="col-md-7">
		<?php
		$arr=array('pria','wanita');
		foreach($arr as $r)
		{
			$jj='';
			if($r==$row->jenkel)
			{
				$jj='checked="checked"';
			}
		?>
		<div class="radio">
			<label>
				<input type="radio" name="jk" value="<?=$r;?>" <?=$jj;?>/> <?=ucfirst($r);?>
			</label>
		</div>		
		<?php
		}
		?>
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-3 control-label" for="">Tahun Masuk</label>
	<div class="col-md-4">
		<input type="number" name="tahun" id="" class="form-control " autocomplete="" placeholder="Tahun Masuk" required="" value="<?php echo set_value('tahun',$row->tahun); ?>"/>
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-3 control-label" for="">Divisi</label>
	<div class="col-md-4">
		<select name="divisi">
			<option value="photo" <?=$row->divisi=='Photo'?'selected':''?>>Photo</option>
			<option value="video" <?=$row->divisi=='Video'?'selected':''?>>Video</option>
		</select>
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-3 control-label">Tempat Lahir</label>
	<div class="col-md-8">
		<input type="text" name="tempat" class="form-control" required="" placeholder="Tempat Lahir" value="<?=set_value('tempat',$row->tempat_lahir);?>"/>		
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-3 control-label">Tanggal Lahir</label>
	<div class="col-md-8">
		<input type="text" name="tanggal" class="form-control tanggal" required="" placeholder="Tanggal Lahir" value="<?=set_value('tanggal',$row->tgl_lahir);?>"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label" for="">Alamat</label>
	<div class="col-md-9">
		<textarea name="alamat" class="form-control"><?=set_value('alamat',$row->alamat);?></textarea>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label">&nbsp;</label>
	<div class="col-md-6">
		<button type="submit" class="btn btn-primary btn-flat">Ubah</button>
		<a href="javascript:history.back(-1);" class="btn btn-default btn-flat">Batal</a>
	</div>
</div>
</div>
<?php
echo form_close();
?>