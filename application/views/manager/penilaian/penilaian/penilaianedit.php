<?php
foreach($data as $row){	
}
echo validation_errors();
echo form_open(base_url(akses().'/penilaian/penilaian/edit'),array('class'=>'form-horizontal'));
?>
<input type="hidden" name="penilaianid" value="<?=$row->penilaian_id;?>"/>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Judul</label>
	<div class="col-md-9">
		<input type="text" name="judul" id="" class="form-control " autocomplete="" placeholder="Judul penilaian" required="" value="<?php echo set_value('judul',$row->judul); ?>"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Keterangan</label>
	<div class="col-md-9">
		<textarea name="keterangan" class="form-control"><?=set_value('keterangan',$row->keterangan);?></textarea>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Tahun</label>
	<div class="col-md-3">
		<input type="number" name="tahun" id="" class="form-control " autocomplete="" placeholder="Tahun penilaian" required="" value="<?php echo set_value('tahun',$row->tahun); ?>"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Kuota</label>
	<div class="col-md-3">
		<input type="number" name="kuota" id="" class="form-control " autocomplete="" placeholder="Kuota penilaian" required="" value="<?php echo set_value('kuota',$row->kuota); ?>"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">&nbsp;</label>
	<div class="col-md-6">
		<button type="submit" class="btn btn-primary btn-flat">Update</button>
		<a href="javascript:history.back(-1);" class="btn btn-default btn-flat">Batal</a>
	</div>
</div>
<?php
echo form_close();
?>