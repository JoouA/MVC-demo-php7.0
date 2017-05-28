<?php
	$config = array
	(
		'dbconfig' => array
		(
			'dbhost' =>'localhost',
			'dbuser' =>'root',
			'dbpassword' => 'root',
			'dbcharset'=> 'utf8',
			'dbname' => 'newsreport'
		),
		'viewconfig'=>array
		( 
			'left_delimiter' => '{',
			'right_delimiter' => '}',
			'template_dir' => 'tpl',
			'compile_dir' => 'data/template_c'
		)
	); 
 ?>