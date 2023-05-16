<!--footer-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <!-- Data Tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- Own CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title>Data Mahasiswa</title>
</head>
	<footer>
		<div class="container" style="color:rgba(175, 175, 175, 0.5);">
			<div class="row">
				<div class="col-lg-4 footer-grid-agileits-w3ls text-left">
					<h3>About US</h3>
					<p><?php getdetaileddescription("titles"); ?></p>

				</div>
				<div class="col-lg-4 footer-grid-agileits-w3ls text-left">

					<div class="tech-btm">
						<h3>Address</h3>
						<p> Jalan Bathin Alam , Sungai Alam, Bengkalis, Riau 28711 Bengkalis Riau<a href="rules.php" class="text-muted"><u class="text-muted">+62 812-7545-1551</u></a></p>
					</div>
				</div>
				<!-- subscribe -->
				<div class="col-lg-4 subscribe-main footer-grid-agileits-w3ls text-left">
					<h2>Informasi</h2>
					<div class="subscribe-main text-left">
					<p>Seluruh Mahasiswa dapat dilihat di <a href="member.php" class="text-muted"><u class="text-muted">Mahasiswa. </u></a>Pembukaan Mahasiswa baru<a href="daftar.php" class="text-muted"><u class="text-muted">DAFTAR DISINI.</u></a></p>
						   </div>
					</div>
					<!-- //subscribe -->
				</div>
			</div>
			<!-- footer -->
			<div class="footer-cpy text-center">
				<div class="footer-social">
					<div class="copyrighttop">
						<ul>
							<li class="mx-3">
								<a class="facebook" href="<?php getlinks("links","facebook");?>">
									<i class="fab fa-facebook-f"></i>
									<span>Facebook</span>
								</a>
							</li>
							<li>
								<a class="facebook" href="<?php getlinks("links","twitter");?>">
									<i class="fab fa-twitter"></i>
									<span>Twitter</span>
								</a>
							</li>
							<li class="mx-3">
								<a class="facebook" href="<?php getlinks("links","googleplus");?>">
									<i class="fab fa-google-plus-g"></i>
									<span>Google+</span>
								</a>
							</li>
							<li>
								<a class="facebook" href="<?php getlinks("links","pinterest");?>">
									<i class="fab fa-pinterest-p"></i>
									<span>Pinterest</span>
								</a>
							</li>
						</ul>

					</div>
				</div>
				<div class="w3layouts-agile-copyrightbottom">
					<p> Create With  <i class="bi bi-suit-heart-fill" style="color: red; "></i> by <u style="color: #ffff;">Alan Kamesta Ginting</u></p>
</div><div class="mt-3">
					<?php $current=date("Y"); print_r($current);?> 
					

				</div>
			</div>
			<!-- //footer -->
		</div>
	</footer>