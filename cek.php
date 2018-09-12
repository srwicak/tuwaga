<?php  
//tuwa.ga - file cek.php -  versi 0.0.0.3 - 23 Desember 2013 - Sandy Rachmat Wicaksono
require"fungsi.php";
require "halaman.php";
sambung();

if(!isset($_GET['aksi']))
	$_GET['aksi']= 'cek';
$aksi= $_GET['aksi'];
$aksi= bersih($aksi);

$html="";
switch($aksi)
{
	case 'cek':
	$html="<span id='hcek'>Cek URL asli</span><form action='==' method='post'><span id='twg'>http://tuwa.ga/</span><input type='text' id='inputcekurl' name='cekurl' required pattern='{1,}'/><br />
			<input type='submit' name='submit' value='CEK URL' id='submit' /><br /></form>";
	break;
	case 'hasil':
	if(isset($_POST['cekurl'])){
		$tuwaga=bersih($_POST['cekurl']);
		$datum= mysql_query("select * from vQp2BvqG where pendek='$tuwaga'");
		$cek_izin=mysql_query("SELECT * FROM vQp2BvqG WHERE pendek= '$tuwaga' AND tidak_boleh='0' ");
		if(mysql_num_rows($cek_izin) == 0){
			$html="<span id='cekp'>Kesalahan: http://tuwa.ga/".$tuwaga." tidak terdaftar dalam database kami atau URL alamat aslinya terproteksi sehingga tidak dapat dilihat.</span>";
			}else if(mysql_num_rows($datum) == 0){
			$html= "<span class='cek'>Maaf http://tuwa.ga/".$tuwaga." tidak terdaftar dalam database kami.</span>";
		} else {
			$ambil= mysql_fetch_array($datum);
			$html= "<span class='cek'>http://tuwa.ga/".$tuwaga."<br > memiliki alamat asli <a href=".$ambil['asli']." id='hasilcek'>".$ambil['asli']."</a></span>";
		}
	}else{
		header ('location: ./=');
	}

	break;
}
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
			<?= $html?>
			<span class="kembali"><a href="./">X</a></span>
		</div>
		<footer><?= kaki()?></footer>
	</div>
</body>
</html>