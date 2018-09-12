<?php
//tuwa.ga - file buat.php -  versi 0.0.0.4 - 25 Desember 2013 - Sandy Rachmat Wicaksono
//inti: cengkraman_garuda v.0.0.2
if(!isset($_SESSION)) 
	session_start();	
	
require "fungsi.php";
require "halaman.php";
sambung();


if(!isset($_GET['aksi']))
	$_GET['aksi']= 'hasil';
$aksi= $_GET['aksi'];
$aksi= bersih($aksi);


$html='';

$singkat= singkat();

switch($aksi)
{
	case 'hasil':
	$url= bersih($_POST['url']); 
	$_SESSION['url']=$url;
	$urls=$_SESSION['url'];
	$datum=mysql_fetch_array(mysql_query("select * from vQp2BvqG where asli='$url'"));
	$kueri_s= mysql_query("SELECT * FROM vQp2BvqG WHERE pendek= '$singkat' ");
	$kuerir =  mysql_query("SELECT * FROM vQp2BvqG WHERE asli= '$url' ");
	if(isset($_POST['url'])){
		 if(!preg_match("/^[a-zA-Z]+[:\/\/]+[A-Za-z0-9\-_]+\\.+[A-Za-z0-9\.\/%&=\?\+\-_]+$/i", $url)) {
			$html  = "Kesalahan: URL yang Anda masukan tidak sesuai"; 
			}else if (mysql_num_rows($kuerir) != 0){
					$singkat= $datum['pendek'];
					$_SESSION['singkat']=$singkat;
					$html = "URL singkatnya adalah<br /><a href='http://tuwa.ga/".$singkat."'><span  id='urlsingkat'>http://tuwa.ga/".$singkat."</span></a><br /><br /><a href='#ubah' id='tombol_ubah'>Ubah?</a> - <a href='#' id='salin'>Salin!</a>";
			}else if (mysql_num_rows($kueri_s) != 0){
					$_SESSION['singkat']= singkat();
					$_SESSION['singkat']=$singkat;
					if(mysql_query("INSERT INTO vQp2BvqG (pendek, asli, kali, tidak_boleh) VALUES ('$singkat', '$url', '0', '0')"))
					{
						$html = "URL singkatnya adalah<br /><a href=http://tuwa.ga/".$singkat."'><span  id='urlsingkat'>http://tuwa.ga/".$singkat."</span></a><br /><br /><a href='#ubah' id='tombol_ubah'>Ubah?</a> - <a href='#' id='salin'>Salin!</a>";
					} else {  
						$html = "Kesalahan: Tidak bisa menemukan database 1";  
					} 
				}else	{
					$_SESSION['singkat']=$singkat;
					if(mysql_query("INSERT INTO vQp2BvqG (pendek, asli, kali, tidak_boleh) VALUES ('$singkat', '$url', '0', '0')"))
					{
						$html= "URL singkatnya adalah<br /><a href=http://tuwa.ga/".$singkat."'><span  id='urlsingkat'>http://tuwa.ga/".$singkat."</span></a><br /><br /><a href='#ubah' id='tombol_ubah'>Ubah?</a> - <a href='#' id='salin'>Salin!</a>";
					} else {  
						$html = "Kesalahan: Tidak bisa menemukan database 2";  
						}
				}
			}else{
				header ('location: ./');
			}
			mysql_close();
	break;
	
	case 'ubah':
	if(isset($_POST['url_baru'])){	
		$url_baru=bersih($_POST['url_baru']);
		$url_baru = str_replace(' ','',$url_baru);
		$kueri_b= mysql_query("SELECT * FROM vQp2BvqG WHERE pendek= '$url_baru'");
		 if(!preg_match('/[a-zA-Z0-9]/i', $url_baru)){
			$html  = "Kesalahan: URL yang kamu masukan tidak sesuai - <a href='#ubah' id='tombol_ubah'>Ulangi?</a>"; 
			} else if(strlen($url_baru)>5){
				if (mysql_num_rows($kueri_b) != 0){
					$html="Kesalahan: http://tuwa.ga/".$url_baru." tidak dapat digunakan. <br /><br /><a href='#ubah' id='tombol_ubah'>Ulangi</a>";
				}else{
					$sesi_url=$_SESSION['singkat'];
					$cek_izin=mysql_query("SELECT * FROM vQp2BvqG WHERE pendek= '$sesi_url' AND tidak_boleh='0' ");
					$mau_proses="INSERT INTO vQp2BvqG (pendek, asli, kali, tidak_boleh) VALUES ('$url_baru', '$_SESSION[url]', '0', '0')";
					if(mysql_num_rows($cek_izin) == 0){
						$html="Kesalahan: http://tuwa.ga/".$sesi_url." tidak dapat dirubah, URL ini diproteksi";
						}else{
					if(mysql_query($mau_proses)){
						$html= "URL berhasil dirubah menjadi <a href='http://tuwa.ga/".$url_baru."'><span  id='urlsingkat'>http://tuwa.ga/".$url_baru."</span></a> <br /> <a href='#' id='salin'>Salin!</a>";
					}else{
						$html= "Kesalahan: Gagal Rubah 1";
					}
				}}
			}else{
				$html= "Kesalahan: Kami menerima 6 hingga 12 karakter  - <a href='#ubah' id='tombol_ubah'>Ulangi?</a>";
			}
			}else{
				header ('location: ./');
			}
		break;
}
?>

<!DOCTYPE html>
<html>
<head>
	<?= kepala(); ?>
	<script type="text/javascript" src="jquery-2.0.3.js"></script>
	<script type="text/javascript" src="jquery.zclip.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){ 
			$('a#salin').zclip({ 
				path:'ZeroClipboard.swf', 
				copy:$('span#urlsingkat').text() }); 
		});
	</script>
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
		<footer><?= kaki()?></footer>
	</div>
	<div id="ubah">
			<div class="jendela_ubah">
				<a href="#" class="tutup" title="Tutup">X</a>
				<h1 id="jendela">Mengubah URL</h1>
				<p id="ket">Anda dapat mengubah URL singkat ini dengan yang Anda kehendaki, tetapi jumlah karakternya minimal 6 hingga 12 karakter</p>
				<form action="+u" method="post">
				<span id="urlbaru">URL baru: http://tuwa.ga/</span><input name="url_baru" type="text" id="url" placeholder="<?=$_SESSION['singkat']?>"  pattern=".{6,12}" autofocus required title="Mohon kurangi panjang URL anda, batas URL ubahan yang kami terima mulai 6 hingga 12 karakter."  /><input type="submit" name="submit" value="UBAH!" id="submit" />
				</form>
			</div>
</body>
</html>

	

		