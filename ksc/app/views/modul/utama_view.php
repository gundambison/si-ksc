<?php 
//BUAT HEADnya
//	$s=form_open('rumah/insert');
//DISARANKAN!!
	$attributes = array('class' => 'frmBuku', 'id' => 'myform');
	$s=form_open('rumah/insert', $attributes);
	  
	$a=array();
	//TEXT	 
	$data = array(
        'name'        => 'buku',
        'id'          => 'bukuInput',
        'value'       => '',
        'maxlength'   => '100',
        'size'        => '20',
        'style'       => 'width:50%',
    );
	$a['JUDUL']=form_input($data);	
	 
	foreach($a as $n=>$v)
	{
		$s.=form_fieldset($n);
		$s.=form_label($v,$n);
		$s.=form_fieldset_close();
	} 
	 
	$s.= form_submit('mysubmit', 'Input data!');
	$s.= form_close();
	print $s;$s='';
?>