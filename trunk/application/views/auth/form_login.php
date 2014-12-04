<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Login ke Aplikasi</title>
        <link rel="shortcut icon" href="<?php echo base_url();?>asset/images/favicon.png"> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/login/css/style.css" />
		<script src="<?php echo base_url();?>asset/login/js/modernizr.custom.63321.js"></script>
		<!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
    </head>
    <body>
        <div class="container">
		
			<!-- Codrops top bar -->
			<header>
			
				<h1>Selamat Datang</h1>
				<h2><strong>Sistem Informasi Purchasing Logistic PT. Cipaganti Citra Graha</strong></h2>
				
				</br></br><img src='<?php echo base_url();?>asset/login/images/logo.png' alt=' '/>
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
				<form class="form-1" action="<?=base_url()?>auth/login_proses" method="post">
					<p class="field">
						<input type="text" name="username" value="<?=$username?>" placeholder="Username">
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
        </div>
    </body>
</html>
