<?php require("libs/fetch_data.php");?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<title><?php getwebname("titles"); echo"|"; gettagline("titles");?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<link id="browser_favicon" rel="shortcut icon" href="blogadmin/images/<?php geticon("titles"); ?>">
	<meta charset="utf-8" name="description" content="<?php getshortdescription("titles");?>">
	<meta name="keywords" content="<?php getkeywords("titles");?>" />
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="css/jquery.desoslide.css">
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href="css/fontawesome-all.css" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800"
	rel="stylesheet">
</head>

<body>
	<?php include("header.php");?>
	<?php include("banner.php");?>
	<section class="bottom-slider"  id="album">
		<div class="course_demo1" >
			<h2 style="text-align:center "><strong>ALBUM</strong></h2><br></br>
			<ul id="flexiselDemo1">
				<?php getbottomsliderposts("blogs");?>
				
			</ul>
		</div>
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="embed-responsive embed-responsive-21by9">
							<iframe allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" frameborder="0" height="315" src="https://www.youtube-nocookie.com/embed/oeLZnpJ_nv8" width="560"></iframe>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
	<!--/main-->
	<section id="mahasiswa" class="main-content-w3layouts-agileits">
		<div class="container">
			<div class="row" >
				<!--left-->
				<div class="col-lg-7 left-blog-info-w3layouts-agileits text-left">
				<h3><strong>Dosen</strong></h3>
				<p1><strong>Jumlah dosen: <?php include("jumlah.php");?>  </strong></p1>
					<!--grid blogs below--><div class="row">
							<?php include("data.php");?>
							
							<!--bloggrids-->
						</div>

					<div class="read float-right">
						<a href="member.php" class="btn btn-primary read-m">Tampilkan Semua</a>
					</div>
				</div>
				<!--//left-->
				<!--right-->
				<aside class="col-lg-4 pt-4 mx-auto agileits-w3ls-right-blog-con text-right">
					<div class="right-blog-info text-left">
						<ul class="list-group singles">
						<div class="card ml-3">
    			<div style="width:100%;height:0;padding-bottom:57%;position:relative;"><iframe src="https://giphy.com/embed/l41YouCUUcreUabHW" width="100%" height="100%" style="position:absolute" frameBorder="0" class="giphy-embed" allowFullScreen></iframe></div><p><a href="https://giphy.com/gifs/producthunt-l41YouCUUcreUabHW"></a></p>
    			<div class="card-body">
      			<a class="card-text" href="https://giphy.com/gifs/producthunt-l41YouCUUcreUabHW"><div class="read float-right">
						<a href="http://polbeng.ac.id/" class="btn btn-primary read-m">Daftar Sekarang</a>
					</div>
   				 </div>
 				 </div>
						</ul>
								
									</div>
								</aside>
								<!--//right-->
							</div>
						</div>
					</section>
					<!--//main-->
					<!--/middle-->
						<section class="bottom-slider"  id="album">
		</div>
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="embed-responsive embed-responsive-21by9">
							<iframe allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" frameborder="0" height="315" src="https://www.youtube-nocookie.com/embed/oeLZnpJ_nv8" width="560"></iframe>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
					
					<!--//middle-->
					<!---->
					<!--//main-->
					
					<?php include("footer.php");?>
					<!----><div id="about">
							</div>
					<!-- js -->
					<script src="js/jquery-2.2.3.min.js"></script>
					<!-- //js -->
					<!-- desoslide-JavaScript -->
					<script src="js/jquery.desoslide.js"></script>
					<script>
						$('#demo1_thumbs').desoSlide({
							main: {
								container: '#demo1_main_image',
								cssClass: 'img-responsive'
							},
							effect: 'sideFade',
							caption: true
						});
					</script>

					<!-- requried-jsfiles-for owl -->
					<script>
						$(window).load(function () {
							$("#flexiselDemo1").flexisel({
								visibleItems: 3,
								animationSpeed: 1000,
								autoPlay: true,
								autoPlaySpeed: 3000,
								pauseOnHover: true,
								enableResponsiveBreakpoints: true,
								responsiveBreakpoints: {
									portrait: {
										changePoint: 480,
										visibleItems: 1
									},
									landscape: {
										changePoint: 640,
										visibleItems: 2
									},
									tablet: {
										changePoint: 768,
										visibleItems: 3
									}
								}
							});

						});
					</script>
					<script>
						$(window).load(function () {
							$("#flexiselDemo2").flexisel({
								visibleItems: 3,
								animationSpeed: 1000,
								autoPlay: true,
								autoPlaySpeed: 3000,
								pauseOnHover: true,
								enableResponsiveBreakpoints: true,
								responsiveBreakpoints: {
									portrait: {
										changePoint: 480,
										visibleItems: 1
									},
									landscape: {
										changePoint: 640,
										visibleItems: 2
									},
									tablet: {
										changePoint: 768,
										visibleItems: 3
									}
								}
							});

						});
					</script>
					<script src="js/jquery.flexisel.js"></script>
					<!-- //password-script -->
					<!--/ start-smoth-scrolling -->
					<script src="js/move-top.js"></script>
					<script src="js/easing.js"></script>
					<script>
						jQuery(document).ready(function ($) {
							$(".scroll").click(function (event) {
								event.preventDefault();
								$('html,body').animate({
									scrollTop: $(this.hash).offset().top
								}, 900);
							});
						});
					</script>
					<!--// end-smoth-scrolling -->

							<a href="#home" class="scroll" id="toTop" style="display: block;">
								<span id="toTopHover" style="opacity: 1;"> </span>
							</a>

							<!-- //Custom-JavaScript-File-Links -->
							<script src="js/bootstrap.js"></script>


						</body>

						</html>