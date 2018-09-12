<?php
//tuwa.ga - file fungsi.php -  versi 0.0.0.3 - 23 Desember 2013 - Sandy Rachmat Wicaksono
require "fungsi.php";
require "halaman.php";
if(!isset($_SESSION)) 
	session_start();	
if(isset($_SESSION['singkat'])) 
hapus_sesi($_SESSION['singkat']);

$_SESSION['izin']= "boleh";
?>

<!DOCTYPE html>
<html>
<head>
	<?= kepala(); ?>
	<script type="text/javascript" src="jquery-2.0.3.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
		var sisa= 255
		$('#sisa').text(sisa + ' karakter yang tersisa');
			$('#url').keyup(function(){
			sisa= 255-$(this).val().length;
			if(sisa<0){
				$('#sisa').addClass("overlimit");
				$('#url').attr("disabled", false);
			} else {
				$('#sisa').removeClass("overlimit");
				$('#url').attr("disabled", false);
			}
			$('#sisa').text(sisa + ' karakter yang tersisa');
		});
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
			<form action="./+" method="post">
				<span class="instruksi">Ketik atau rekatkan (<i>paste</i>) alamat situs pada kotak di bawah ini</span>
				<input name="url" type="url" id="url" placeholder="ketik atau rekatkan di sini"  pattern=".{0,255}" autofocus required title="Masukan dengan http:// atau protokol yang lainnya atau kurangi panjang URL anda, batas URL yang kami terima hingga 255 karakter."  />
				<span id="sisa"></span><br />
				<input type="submit" name="submit" value="SINGKAT!" id="submit" /><br />
			</form>
		</div>
		<footer><?= kaki(); ?></footer>
	</div>
</body>
</html>