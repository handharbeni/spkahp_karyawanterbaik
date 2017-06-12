<?php
echo validation_errors();
echo form_open(base_url('profil/updateadmin'),array('class'=>'form-horizontal'));
?>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Nama</label>
	<div class="col-md-6">
		<input type="text" name="nama" id="" class="form-control " autocomplete="" placeholder="Nama Administrator" required="" value="<?php echo set_value('nama',user_info('nama')); ?>"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Password Baru</label>
	<div class="col-md-6">
		<input type="password" name="password" id="" class="form-control " autocomplete="" placeholder="Password Baru" value="<?php echo set_value('password'); ?>"/>
		<small class="text-warning">Entri password baru jika ingin mengubahnya</small>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">&nbsp;</label>
	<div class="col-md-6">
		<button type="submit" class="btn btn-primary btn-flat">Update</button>
	</div>
</div>
<?php
echo form_close();
?>