<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Login ke Aplikasi</title>
        <link rel="shortcut icon" href="<?php echo base_url();?>asset/images/favicon.png"> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/login_mhs/css/style.css" />
		<script src="<?php echo base_url();?>asset/login_mhs/js/modernizr.custom.63321.js"></script>
		<!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
    </head>
    <body>
        <div class="container">
		
			<!-- Codrops top bar -->
			<header>
			
				<h1>Selamat Datang</h1>
				<h2><strong>Sistem Informasi Akademik Sekolah Tinggi Manajemen dan Informatika Bandung</strong></h2>
				
				</br></br><img src='<?php echo base_url();?>asset/login_mhs/images/logo.png' alt='uog'/>
				<h5 style='margin-top:30px;'>Silahkan Login Untuk Mengakses Aplikasi</h5>
				<div class="support-note">
					<span class="note-ie">Sorry, only modern browsers.</span>
				</div>
				<?if($pesan != ''){?>
					<div class="support-note">
						<span class="note-ie"><?=$pesan?></span>
					</div>
				<?}?>
				
			</header>
			
			<section class="main">
				<form class="form-1" action="<?=base_url()?>auth_mhs/login_proses" method="post">
					<p class="field">
						<input type="text" name="nim" value="<?=$nim?>" placeholder="Username atau nim">
						<i class="icon-user icon-large"></i>
					</p>
						<p class="field">
							<input type="password" name="password" placeholder="Password">
							<i class="icon-lock icon-large"></i>
					</p>
					<p class="submit">
						<button type="submit" name="submit"><i class="icon-arrow-right icon-large"></i></button>
					</p>
				</form>
			</section>
			<center><a href="<?=base_url()?>">Kembali</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#popup">Keterangan</a></center>
        </div>
    </body>
</html>


<html>
	<head>
		<title>Keterangan Login </title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/login/popup/style.css" />		
	</head>
	<body>
		
		<div id="popup">
			<div class="window">
				<a href="#" class="close-button" title="Close">X</a>
				<h1>Keterangan !</h1>
				<br>
				<p align="justify">- &nbsp;&nbsp;User Name dan Password yang digunakan adalah Account <b>User Name dan Password</b> SIAKAD.<br/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jika &nbsp;belum &nbsp;memiliki &nbsp;Akun, &nbsp;silahkan &nbsp;mendaftar &nbsp;di &nbsp;bagian &nbsp;Akademik kampus. Registrasi dan<br/>
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;aktivasi dapat dilakukan di bagian Akademik atau Bagian TIK di Kampus.<br/>
					- &nbsp;&nbsp;Jika &nbsp;sudah &nbsp;selesai, <b>pastikan &nbsp;anda menekan tombol Logout</b>. kelalaian anda dapat merugikan<br/> 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;anda sendiri. <br/>
				<br>
				<i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Terima Kasih</i>
				<center>Untuk menutup jendela ini, klik tombol close di kanan atas</center></p>
			</div>
		</div>
	</body>
</html>
