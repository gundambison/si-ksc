<?php
	 @is_null($error1)?$s='':$s=$error1;
	$attributes = array('class' => 'frmBuku', 'id' => 'myform');
	$s.=form_open('', $attributes);
	$a['NAMA']=form_input('name');
	$a['PASSWORD']=form_password('pass');
		
	$s.=form_fieldset( );
	foreach($a as $n=>$v)
	{
		$s.=form_fieldset($n);
		$s.=form_label($v,$n);
		$s.=form_fieldset_close();
	} 
	$s.=form_fieldset_close();
	$s.=form_hidden('act','login');
	$s.= form_submit('mysubmit', 'Login!');
	$s.= form_close();
	print $s;$s='';
/*
CREATE TABLE IF NOT EXISTS `user` (
  `name` varchar(12) NOT NULL,
  `pass` char(30) NOT NULL
);
INSERT INTO  `my_work`.`user` (
`name` ,
`pass`
)
VALUES (
'admin',  '123123'
), (
'gunawan',  '111'
);

CREATE TABLE  `my_work`.`role` (
`r_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`r_role` VARCHAR( 12 ) NOT NULL ,
UNIQUE (
`r_role`
)
)
INSERT INTO  `my_work`.`role` (
`r_id` ,
`r_role`
)
VALUES (
NULL ,  'insert'
), (
NULL ,  'update'
);


*/	