<?php  
//tuwa.ga - file menuju.php -  versi 0.0.0.3 - 23 Desember 2013 - Sandy Rachmat Wicaksono
require"fungsi.php";
require "halaman.php";
sambung();

$ke = bersih($_REQUEST['ke']);  
$datum = mysql_fetch_array(mysql_query("select * from vQp2BvqG where pendek='$ke' limit 1"));  

if(!isset($_REQUEST['ke']))
{
	header ('location: ./');
}else if(!empty($datum)) {  
		$kali= $datum['kali'];
		$kalis= $kali+1;
		$html= $kalis;
		mysql_query("update vQp2BvqG set kali= '$kalis' where pendek='$ke'");
		Header("HTTP/1.1 301 Moved Permanently");  
		header("Location: ".$datum['asli'].""); 
	} else {  
	  $html = "Kesalahan:  URL singkat yang diminta tidak ada dalam database kami.";  
}  

mysql_close();  
?>  
<!DOCTYPE html>
<html>
<head>
	<?= kepala(); ?>
</head>

<body>
	<div id="bungkus">
	<?= judul(); ?>
		<div id='menu'>
		<?= menu(); ?>
		</div>
		<div class="tubuh">
			<span id="hasil"><?= $html?></span>
			<br /><br />
			<span class="kembali"><a href="./">X</a></span>
		</div>
		<?= kaki(); ?>
	</div>
</body>
</html>