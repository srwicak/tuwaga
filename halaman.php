<?php
//tuwa.ga - file halaman.php -  versi 0.0.0.1 - 26 Desember 2013 - Sandy Rachmat Wicaksono
if(!isset($_SESSION))
	session_start();	
if(preg_match('/fungsi.php/i', $_SERVER['PHP_SELF']))
{
	header('location:./');
	exit;
}

function kepala()
{
	$kepala= 
	'<meta charset= "utf-8">
	<title>tu..wa..ga.. | Situs Penyingkat URL</title>
	<meta name="description" content="Another site for shorter URL services">
	<meta name="author" content="sanrawcyber.com">
	<link rel="stylesheet" href="css/gaya.css">
	<link href="http://fonts.googleapis.com/css?family=Play" rel="stylesheet">';
	return $kepala;
}

function judul()
{
	$judul='<a href="./"><h1><span class="tu">tu</span><span class="wa">wa</span>.<span class="ga">ga</span></h1></a>
		<span id="slogan">Menyingkat alamat situs yang panjang semudah mengatakan sa<span class="tu">tu</span> du<span class="wa">wa</span>(dua) ti<span class="ga">ga</span></span>';
	return  $judul;
}

function menu()
{
	$menu=
	'<nav>
		<ul>
			<li><a href="./" class="menu">Beranda</a></li>
			<li><a href="./=" class="menu">Cek URL</a></li>
		</ul>
	</nav>';
	return $menu;
}

function kaki()
{
	$kaki= '<footer><span id="kaki">Layanan ini akan ada hingga sampai nama domain ini di ambil alih pihak pengelola.<br>Ada kesalahan? beri tahu kami dengan mengirimkan email ke <a href="mailto:kesalahan@tuwa.ga" class="kaki">kesalahan@tuwa.ga</a><br>&copy;2013 <a href="http://sanrawcyber.com" target="_blank" class="kaki">sanrawcyber RnD</a><br>Hosting by <a href="http://sanrawcyber.com/tautan/idhostinger.php" target="_blank" class="kaki">Idhostinger</a> and domain by <a href="http://freenom.com" target="_blank" class="kaki">Freenom</a></span>';
	return $kaki;
}

?>

