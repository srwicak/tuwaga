<?php
//tuwa.ga - file fungsi.php -  versi 0.0.0.1 - 21 Desember 2013 - Sandy Rachmat Wicaksono
if(!isset($_SESSION))
	session_start();	
if(preg_match('/fungsi.php/i', $_SERVER['PHP_SELF']))
{
	header('location:./');
	exit;
}
function sambung($inang='mysql.idhostinger.com', $np='u818175724_adm', $ks='naUvFQeb4s', $db='u818175724_dbs')
{
	$koneksi= mysql_connect($inang, $np, $ks);
	if (!$koneksi)
		return false;
	else
	{
		mysql_select_db($db);
		return true;
	}
}

function bersih($string)
{
	$bersih= trim(strip_tags(mysql_real_escape_string($string)));
	return $bersih;
}
function bersih_teks($string)
{
	$bersih= trim(htmlentities($string));
	return $bersih;
}

function cek_field($var)
{
	foreach ($var as $field)
	{
		if ($field =='' || !isset($field))
			return false;
	}
	return true;
}

function hapus_sesi($nama_ses)
{
	if(!isset($nama_ses))
		return false;
	else
	{
		session_destroy();
		return true;
	}
}

function singkat($length = 4) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

?>