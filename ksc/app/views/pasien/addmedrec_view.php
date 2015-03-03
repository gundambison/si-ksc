<form role="form" class='form-horizontal' method="post" id='pasienForm' 
action="<?php echo base_url();?>pasien/saveMedrec">
  <div class="form-group">
    <label for="tipeMR" class="col-lg-3 control-label">Type</label>
	<div class="col-lg-5">
<?php 
	echo form_hidden('pasien_id',$pasien_id);
$js='class="form-control" id="tipeMR"';
				echo form_dropdown('types', $types, 2, $js); ?>* Khusus Gigi
	</div>
 
  </div>
  <div class="form-group">
    <label for="bagianGigi" class="col-lg-3 control-label">Type (GIGI)</label>
	<div class="col-lg-4">
<?php $js='class="form-control col-lg-5" id="bagianGigi"';
				echo form_dropdown('diagnosa[gigiBagian]', $gigiBagian, 0, $js); ?>
	<input type="text" class="form-control col-lg-5" id="gigi" placeholder="Masukkan Gigi Yang dimaksud" name='diagnosa[gigi]' />* Khusus Gigi	
	</div>
	<div class="col-lg-2">
		<div class='gigiBox' id='exampleGigi'>&nbsp; 	</div>
	</div>
  </div>
<div class="form-group">
    <label for="detail" class="col-lg-3 control-label">Detail <i class="fa fa-camera-retro"></i> </label>
	<div class="col-lg-5">
	<textarea class="form-control" id="detail" placeholder="Masukkan Detail" name='diagnosa[detail]'></textarea>
	</div>
  </div>
  <div class="form-group">
    <label for="tindakan" class="col-lg-3 control-label">Tindakan</label>
	<div class="col-lg-5">
	<textarea class="form-control" id="tindakan" placeholder="Masukkan Tindakan" name='action'></textarea>
	</div>
  </div>
  <div class="form-group">
    <label for="tindakan" class="col-lg-3 control-label">Obat</label>
	<div class="col-lg-5">
	<textarea class="form-control" id="obatText" placeholder="Masukkan Obat Bila Ada" name='medic'></textarea>
	</div>
  </div>
  
  <div class="form-group">
    <label for="username" class="col-lg-3 control-label">Login</label>
	<div class="col-lg-4">
		<input class="form-control col-lg-5" id="username" placeholder="username" name='username' />
		<input class="form-control col-lg-5" id="password" placeholder="password" name='password' type='password'  /> 	
	</div>
	
  </div>
  <div class="form-group">
	<label for="submit" class="col-lg-3 control-label">&nbsp;</label>
	<div class="col-lg-4">
	<button class="btn btn-primary" type="button" data-loading-text="Send Data..." class="btn btn-primary" onclick='saveMedrec()'>
	  Save 
	</button>
	</div>
  </div>
</form>
<div class='row'>
<?php $this->load->view('pasien/medrec_view'); ?>	
</div>