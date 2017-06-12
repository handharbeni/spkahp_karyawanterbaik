<?php

$irdata=array(
1=>0.00,
2=>0.00,
3=>0.58,
4=>0.90,
5=>1.12,
6=>1.24,
7=>1.32,
8=>1.41,
9=>1.45,
10=>1.49,
11=>1.51,
12=>1.48,
13=>1.56,
14=>1.57,
15=>1.59,
);

$jumlah=count($arr);
$nilaistatis=array(
0=>3,
1=>3,
2=>4,
3=>5,
4=>1,
5=>2,
6=>3,
7=>1,
8=>2,
9=>2,
);
$ir=0.00;
foreach($irdata as $irk=>$irv)
{
	if($irk==$jumlah)
	{
		$ir=$irv;
	}
}
?>
<script type="text/javascript">
$(document).ready(function () {

hitung();


});


function hitung()
{

	
	$(".inputnumber").each(function(){

			var dtarget=$(this).attr('data-target');
			var dkolom=$(this).attr('data-kolom');
			var jumlah=$(this).val();
			var rumus=1/parseFloat(jumlah);
			var fx=rumus.toFixed(2);
			$("#"+dtarget).val(fx);
			total();			
			mnk();
			mptb();
			rk();

	});	
}



function total()
{
	for(i=1;i<=<?=$jumlah;?>;i++)
	{
		var sum=0;
		$(".kolom"+i).each(function(){
			sum+=parseFloat($(this).val());
		});
		var fx=sum.toFixed(2);
		$("#total"+i).val(fx);
	}	
}

function mnk()
{	
	for(i=1;i<=<?=$jumlah;?>;i++)
	{
		var jml=0;
		for(x=1;x<=<?=$jumlah;?>;x++)
		{			
			var vtarget=$("#k"+i+"b"+x).val();
			var vkolom=$("#total"+x).val();
			var rumus=parseFloat(vtarget)/parseFloat(vkolom);
			var fx=rumus.toFixed(2);			
			jml+=parseFloat(rumus);
			$("#mn-k"+i+"b"+x).val(fx);
			//$("#mn-k"+i+"b"+x).val(i+" "+x);						
		}
		var jumlahmnk=jml.toFixed(2);
		var prio=parseFloat(jml)/parseFloat(<?=$jumlah;?>);
		var totprio=prio.toFixed(2);
		$("#jml-b"+i).val(jumlahmnk);
		$("#pri-b"+i).val(totprio);		
		
	}
}

function mptb()
{	
	for(i=1;i<=<?=$jumlah;?>;i++)
	{
		var jml=0;
		for(x=1;x<=<?=$jumlah;?>;x++)
		{			
			var prio=$("#pri-b"+x).val();
			var nilai=$("#k"+i+"b"+x).val();
			var rumus=parseFloat(nilai)*parseFloat(prio);
			var fx=rumus.toFixed(2);
			jml+=parseFloat(rumus);
			//$("#mptb-k"+i+"b"+x).val(prio+"*"+nilai);
			$("#mptb-k"+i+"b"+x).val(fx);
		}
		var jumlahmnk=jml.toFixed(2);
		$("#jmlmptb-b"+i).val(jumlahmnk);
	}
}

function rk()
{
	var total=0;	
	for(i=1;i<=<?=$jumlah;?>;i++)
	{
		var prio=$("#pri-b"+i).val();
		var jml=$("#jmlmptb-b"+i).val();
		var hasil=parseFloat(prio)+parseFloat(jml);
		var fx=hasil.toFixed(2);
		total+=hasil;
		$("#jmlrk-b"+i).val(jml);
		$("#priork-b"+i).val(prio);
		$("#hasilrk-b"+i).val(fx);
	}
	var fx2=total.toFixed(2);
	$("#totalrk").val(fx2);
	$("#sumrk").val(fx2);
	var summaks=parseFloat(total)/parseFloat(<?=$jumlah;?>);
	var fx_summaks=summaks.toFixed(2);
	$("#summaks").val(fx_summaks);
	
	var ci_r_1=parseFloat(summaks)-parseFloat(<?=$jumlah;?>);
	var ci=parseFloat(ci_r_1)/parseFloat(<?=$jumlah;?>);
	var fx_ci=ci.toFixed(2);
	$("#sumci").val(fx_ci);
	var cr=parseFloat(ci)/parseFloat(<?=$ir;?>);
	var fx_cr=cr.toFixed(2);
	$("#sumcr").val(fx_cr);
	$("#crvalue").val(fx_cr);
}

</script>

<div id="respon"></div>

<input type="hidden" name="crvalue" id="crvalue"/>
<div class="table-responsive">
<table class="table table-bordered">
<thead>
	<th colspan="<?=$jumlah+1;?>" class="text-center">Matrik Perbandingan Berpasangan</th>
</thead>
<thead>
	<th>Kriteria</th>
	<?php
	foreach($arr as $k=>$v)
	{
	?>
	<th><?=$v;?></th>
	<?php
	}
	?>	
</thead>
<tbody>
	<?php
	$noUtama=0;
	$entri=-1;
	foreach($arr as $k2=>$v2)
	{		
		$noUtama+=1;				
		//array_shift($xxx);
		echo '<tr>';
		echo '<td>'.$v2.'</td>';
		$noSub=0;						
		for($i=1;$i<=$jumlah;$i++)
		{			
			$noSub+=1;
			if($noSub==$noUtama)
			{
				echo '<td><input type="number" id="k'.$noUtama.'b'.$noSub.'" class="form-control kolom'.$noSub.'" value="1" readonly="" title="kolom'.$noSub.'"/></td>';
			}else{
				
				if($noUtama > $noSub)
				{									
					echo '<td><input type="text" id="k'.$noUtama.'b'.$noSub.'" class="form-control kolom'.$noSub.'" value="0" readonly="" title="kolom'.$noSub.'"/></td>';
				}else{
					$entri+=1;
					echo '<td>';
					$nilai=0;
					foreach($nilaistatis as $nsk=>$nsv)
					{
						if($nsk==$entri)
						{
							$nilai=$nsv;
						}						
					}					
					echo '<input type="text" id="k'.$noUtama.'b'.$noSub.'" data-target="k'.$noSub.'b'.$noUtama.'" data-kolom="'.$noSub.'" class="form-control inputnumber kolom'.$noSub.'" title="kolom'.$noSub.'" value="'.$nilai.'" readonly="">';					
					echo '</td>';
				}				
			}
		}
		echo '</tr>';
	}
	?>	
</tbody>
<tfoot>
	<tr>
		<td>Jumlah</td>
		<?php
		for($h=1;$h<=$jumlah;$h++)
		{
		?>
		<td><input type="text" id="total<?=$h;?>" class="form-control" value="0" title="total<?=$h;?>"  readonly=""/></td>
		<?php
		}
		?>
	</tr>
</tfoot>
</table>
</div>

<div id="matrikdiv" class="col-md-12">

<div class="table-responsive">
<table class="table table-bordered">
<thead>
	<th colspan="<?=$jumlah+1;?>" class="text-center">Matrik Nilai Kriteria</th>
</thead>
<thead>
	<th>Kriteria</th>
	<?php
	foreach($arr as $k=>$v)
	{
	?>
	<th><?=$v;?></th>
	<?php
	}
	?>
	<th>Jumlah</th>
	<th>Prioritas</th>
</thead>
<tbody>
	<?php
	$noUtama2=0;	
	foreach($arr as $k2=>$v2)
	{
		$noUtama2+=1;
		echo '<tr>';
		echo '<td>'.$v2.'</td>';
		$noSub2=0;
		for($i=1;$i<=$jumlah;$i++)
		{
			$noSub2+=1;
			echo '<td><input type="text" id="mn-k'.$noUtama2.'b'.$noSub2.'" class="form-control" value="0" readonly=""/></td>';
		}
		echo '<td><input type="text" class="form-control" id="jml-b'.$noUtama2.'" value="0" readonly=""/></td>';
		echo '<td><input type="text" class="form-control" id="pri-b'.$noUtama2.'" value="0" readonly=""/></td>';
		echo '</tr>';
	}
	?>	
</tbody>
</table>
</div>

<div class="table-responsive">
<table class="table table-bordered">
<thead>
	<th colspan="<?=$jumlah+1;?>" class="text-center">Matrik Penjumlahan Tiap Baris</th>
</thead>
<thead>
	<th>Kriteria</th>
	<?php
	foreach($arr as $k=>$v)
	{
	?>
	<th><?=$v;?></th>
	<?php
	}
	?>
	<th>Jumlah</th>
</thead>
<tbody>
	<?php
	$noUtama3=0;	
	foreach($arr as $k3=>$v3)
	{
		$noUtama3+=1;
		echo '<tr>';
		echo '<td>'.$v3.'</td>';
		$noSub3=0;
		for($i=1;$i<=$jumlah;$i++)
		{
			$noSub3+=1;
			echo '<td><input type="text" id="mptb-k'.$noUtama3.'b'.$noSub3.'" class="form-control" value="0" readonly=""/></td>';
		}
		echo '<td><input type="text" class="form-control" id="jmlmptb-b'.$noUtama3.'" value="0" readonly=""/></td>';
		echo '</tr>';
	}
	?>	
</tbody>
</table>
</div>

<div class="table-responsive">
<table class="table table-bordered">
<thead>
	<th colspan="<?=$jumlah+1;?>" class="text-center">Rasio Konsistensi</th>
</thead>
<thead>
	<th>Kriteria</th>	
	<th>Jumlah Per Baris</th>
	<th>Prioritas</th>
	<th>Hasil</th>
</thead>
<tbody>
	<?php
	$noUtama4=0;	
	foreach($arr as $k4=>$v4)
	{
		$noUtama4+=1;
		echo '<tr>';
		echo '<td>'.$v4.'</td>';		
		echo '<td><input type="text" class="form-control" id="jmlrk-b'.$noUtama4.'" value="0" readonly=""/></td>';
		echo '<td><input type="text" class="form-control" id="priork-b'.$noUtama4.'" value="0" readonly=""/></td>';
		echo '<td><input type="text" class="form-control" id="hasilrk-b'.$noUtama4.'" value="0" readonly=""/></td>';
		echo '</tr>';
	}
	?>	
</tbody>
<tfoot>
	<tr>
		<td colspan="3" align="center"><b>TOTAL</b></td>
		<td>
			<input type="text" class="form-control" id="totalrk" value="0" readonly=""/>
		</td>
	</tr>
</tfoot>
</table>
</div>

<div class="table-responsive">
<table class="table table-bordered">
<thead>
	<th colspan="<?=$jumlah+1;?>" class="text-center">Hasil Perhitungan</th>
</thead>
<thead>
	<th>Keterangan</th>
	<th>Nilai</th>
</thead>
<tbody>
	<tr>
		<td>Jumlah</td>
		<td>
			<input type="text" class="form-control" id="sumrk" value="0" readonly=""/>
		</td>
	</tr>
	<tr>
		<td>n(Jumlah Kriteria)</td>
		<td>
			<input type="text" class="form-control" id="sumkriteria" value="<?=$jumlah;?>"  readonly=""/>
		</td>
	</tr>
	<tr>
		<td>Maks(Jumlah/n)</td>
		<td>
			<input type="text" class="form-control" id="summaks" value="0"  readonly=""/>
		</td>
	</tr>
	<tr>
		<td>CI((Maks-n)/n)</td>
		<td>
			<input type="text" class="form-control" id="sumci" value="0"  readonly=""/>
		</td>
	</tr>
	<tr>
		<td>CR(CI/IR)</td>
		<td>
			<input type="text" class="form-control" id="sumcr" value="0" readonly=""/>
		</td>
	</tr>
</tbody>
</table>
</div>

</div>