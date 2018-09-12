<?php require "halaman.php"; ?>
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
		<span id="nyasar">Nyasar bos?<br />Halaman yang Anda minta tidak ada  :)</span>
		<?= kaki(); ?>
	</div>
</body>
</html>
