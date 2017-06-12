<script type="text/javascript">
$(document).ready(function () {
	$(".opsi input").removeAttr('required');
	$(".opsi select").removeAttr('required');
	$(".tipe").each(function(){
		$(this).change(function(){
			var did=$(this).attr('data-id');
			$(".opsi").attr('style','display:none');
			$(".opsi input").removeAttr('required');
			$(".opsi select").removeAttr('required');
			$("#div_"+did).show();
			$("#div_"+did+" input").attr('required','required');
		});
	});
	
});
</script>
<?php
if(empty($data))
{
	redirect(base_url(akses().'/master/kriteria/subkriteria').$kriteria);
}

foreach($data as $row){	
}

echo validation_errors();
echo form_open(base_url(akses().'/master/kriteria/subkriteriaedit').$kriteria,array('class'=>'form-horizontal'));
?>
<input type="hidden" name="subkriteria" value="<?=$row->subkriteria_id;?>"/>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Tipe</label>
	<div class="col-md-6">
		<?php
		$tipe=array('teks','nilai');
		echo com_choice('radio','tipe',$tipe,$row->tipe,array('class'=>'tipe'),TRUE,TRUE);
		?>
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Kriteria Utama</label>
	<div class="col-md-8">
		<select name="kriteriaid" class="form-control" required="">			
			<option>Pilih Kriteria Utama</option>
			<?php
				if(!empty($utama))
				{				
					foreach($utama as $rutama)
					{
						$jj='';												
						if($rutama->kriteria_id==$row->kriteria_id)
						{
							$jj='selected="selected"';
						}
						echo '<option value="'.$rutama->kriteria_id.'" '.$jj.'>'.$rutama->nama_kriteria.'</option>';
					}
				}
			?>
		</select>
	</div>
</div>
<?php
$max='';
if($row->tipe=="teks")
{
	$max=$row->nama_subkriteria;
}elseif($row->tipe=="nilai"){
	$max=$row->nilai_maksimum;
}
?>
<div id="div_teks" class="opsi">
	<div class="form-group required">
		<label class="col-sm-2 control-label" for="">Keterangan</label>
		<div class="col-md-7">
			<input type="text" name="ket" id="" class="form-control " autocomplete="" placeholder="keterangan" required="" value="<?php echo set_value('ket',$max); ?>"/>
		</div>
	</div>	
</div>

<div id="div_nilai" class="opsi" style="display: none;">
	<div class="form-group required">
		<label class="col-sm-2 control-label" for="">Minimum</label>
		<div class="col-md-10">
			<div class="row">
			<div class="col-sm-2" style="margin: 0;padding=0">
				<select name="opmin" class="form-control" required="">
					<?php
					$mmin=array('<','<=','>','=>','=');
					foreach($mmin as $rmm)
					{
						$jmm='';
						if($rmm==$row->op_min)
						{
							$jmm='selected="selected"';
						}
						echo '<option value="'.$rmm.'" '.$jmm.'> '.$rmm.' </option>';
					}
					?>
				</select>
			</div>
			<div class="col-sm-8" style="margin: 0;padding=0">
				<input type="number" name="min" id="" class="form-control " autocomplete="" placeholder="Nilai Minimum" required="" value="<?php echo set_value('min',$row->nilai_minimum); ?>"/>
			</div>
			</div>
		</div>
	</div>
	<div class="form-group required">
		<label class="col-sm-2 control-label" for="">Maksimum</label>
		<div class="col-md-10">
			<div class="row">
			<div class="col-sm-2" style="margin: 0;padding=0">
				<select name="opmin" class="form-control" required="">
				<?php
					$mmaks=array('<','<=','>','=>','=');
					foreach($mmaks as $rmk)
					{
						$jmk='';
						if($rmk==$row->op_max)
						{
							$jmk='selected="selected"';
						}
						echo '<option value="'.$rmk.'" '.$jmk.'> '.$rmk.' </option>';
					}
				?>
				</select>
			</div>
			<div class="col-sm-8" style="margin: 0;padding=0">
				<input type="number" name="max" id="" class="form-control " autocomplete="" placeholder="Nilai Minimum" required="" value="<?php echo set_value('max',$max); ?>"/>
			</div>
			</div>
		</div>
	</div>
</div>

<div id="nilaikategori">
	<div class="form-group required">
		<label class="col-sm-2 control-label" for="">Nilai</label>
		<div class="col-md-6">
			<?php
			if(!empty($nilai))
			{
				foreach($nilai as $rnilai)
				{
					$ch='';
					if($rnilai->nilai_id==$row->nilai_id)
					{
						$ch='checked="checked"';
					}
				?>
				<div class="radio">
					<label>
						<input type="radio" name="nilaiid" value="<?=$rnilai->nilai_id;?>" <?=$ch;?>/><?=$rnilai->nama_nilai;?>
					</label>
				</div>
				<?php
				}
			}
			?>
		</div>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">&nbsp;</label>
	<div class="col-md-6">
		<button type="submit" class="btn btn-primary btn-flat">Ubah</button>
		<a href="javascript:history.back(-1);" class="btn btn-default btn-flat">Batal</a>
	</div>
</div>
<?php
echo form_close();
?>
<script type="text/javascript">
$(document).ready(function () {
	$("#radio-<?=$row->tipe;?>").trigger('change');
});
</script>