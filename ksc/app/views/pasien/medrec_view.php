<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          DETAIL PASIEN 
        </a>
      </h4>
    </div>
<div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">	 
		<table class='table'>
		<thead>
		<tr><th>KETERANGAN </th><th> DETAIL</th></tr>
		</thead>
		<tbody>
		<tr><td>NAMA</TD><td><?=$pasien['name'];?></td></tr>
		<tr><td>M.R</TD><td><?=$pasien['mr'];?></td></tr>
		<tr><td>TANGGAL LAHIR</TD><td><?=$pasien['birth'];?></td></tr>
		<tr><td>GOL. DARAH</TD><td><?=$pasien['blood'];?></td></tr>
		<tr><td>KELAMIN</TD><td><?=$pasien['blood']=='F'?'PEREMPUAN':'PRIA';?></td></tr>
		<tr><td>ALAMAT</TD><td><?=$pasien['address'];?></td></tr>
		</tbody>
		</table> 
</div>
</div>

<?php 
if($medrec===false){
?>
	<div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#MR">
          Tidak Memiliki Medical Record
        </a>
      </h4>
    </div>
	<div id="MR" class="panel-collapse collapse">
      <div class="panel-body">
		<p class="text-info">Tidak Memiliki MR</p>
	  </div>
	</div>
<?php
}else{
?><div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#MR">
          MEDICAL RECORD
        </a>
      </h4>
    </div>

<div id="MR" class="panel-collapse collapse">
      <div class="panel-body"><?php 
	foreach($medrec as $row){
		$row['data']=$row;
		if($row['type']!==0){			
			$this->load->view('pasien/mrType'.$row['type'].'_view',$row);
		}
		
		
	}
 ?></div></div>
 <br class='clear' /><?php 
}

?>
</div></div>