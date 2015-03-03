<div class="row">
        <div class="col-lg-4 col-md-8 col-xs-12" style='margin:auto'>
			<div class="docType">
				<label>Spesialis</label>
				<?php $js='class="form-control" id="docType"';
				echo form_dropdown('doc_types', $doctypes, 2, $js); ?>
			</div>
		</div>
		<div class="col-lg-4 col-md-8 col-xs-12" style='margin:auto'>
		Pilih Tipe Dokter di kiri dan list akan berubah dibawah
		</div>
	</div>
	<div class="row">
        <div class="col-lg-10 col-md-10 col-xs-12" style='margin:auto'>
		<table class="table table-striped">
			<thead><tr>
				<th>Dokter</th>
				<th>Nama</th>
				<th colspan=2>NO DAFTAR</th>				
				<th>Action</th>
			</tr></thead>
			<tbody>				 
				<?php echo $pasien; ?>
			</tbody>
		</table>
		</div>
</div>
<div id="dialog" title="<?php echo $title;?>"><div>
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p></div>
</div>
<div id='formDialog' title="<?php echo $title;?>">
	<form id='formClinic' >
	<input name='tes' /><input name='tes2' />
	</form>
</div>
</div>