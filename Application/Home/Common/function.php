<?php 

function convert($size) { 
    $unit=array('b','kb','mb','gb','tb','pb'); 
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).$unit[$i]; 
} 

function getDiskMenu()
{
	return array(
		'trash'		=> 0,
		'photo' 	=> 1,
		'music' 	=> 2,
		'video' 	=> 3,
		'document'  => 4,
	);
}	

function createShareCode()
{	
	$code = uniqid('',true);
	$code = $code.mt_rand(1,1000000);
	$code = substr(str_shuffle(md5($code)), 0,10);
	return $code;
}

function createSharePassword()
{
	return substr(createShareCode(),0,4);
}




?>