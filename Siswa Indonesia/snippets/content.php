<?php
require 'admin/koneksi.php';

$kelas = $_GET ["kelas"];
$mapel = $_GET ["mapel"];
$materi = $_GET ["materi"];
$result = mysqli_query($conn, "SELECT * FROM materi WHERE kelas = '$kelas' AND mapel = '$mapel' AND materi = '$materi' ");

$resultMateri = mysqli_query($conn, "SELECT * FROM materi WHERE kelas = '$kelas' AND mapel = '$mapel' AND materi = '$materi' ");
$rowMateri = mysqli_fetch_assoc($resultMateri);

//intermezzo
$resultIntermezzo = mysqli_query($conn, "SELECT * FROM intermezzo WHERE kelas = '$kelas' AND materi = '$materi' ");

// back
$resultBack = mysqli_query($conn,"SELECT * FROM mapel WHERE mapel = '$mapel' AND kelas = '$kelas' ");
$rowBack = mysqli_fetch_assoc($resultBack);
?>
<!DOCTYPE html>
<html lang="in">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Siswa Indonesia | <?php 	echo $rowMateri["materi"]; ?></title>

		<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/css/style.css">
		<link rel="stylesheet" href="../assets/font/bootstrap-icons.css">
		<link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
		<link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">
		<style>
			<?php include '../../assets/css/style.css';?>
		</style>
	</head>
	
	<body>
		<header class="nav position-sticky top-0 py-3" id="header">
			<nav  class="container-fluid">
				<div class="row">
					<div class="col col-md-4 col-sm-5 col-xs-5 my-auto text-center logo" id="logo">
						<a href="../index.php">
							<h2>Siswa<span> Indonesia</span></h2>
						</a>
					</div>
					<div class="col col-md-7 col-sm-7 col-sm-7 col-xs-7 my-auto" id="desc-content">
						<h4 class="d-inline">Kelas <?php echo $rowMateri["kelas"]; ?></h4>
						<div class=" d-inline">
							<i class="bi bi-chevron-double-right display-sm d-xs-none"></i>
						</div>
						<h5 class="d-md-inline"><?php echo $rowMateri["mapel"]; ?></h5>
					</div>
					<div class="col col-md-1" id="login-button">
						<a href="../index.php" class="bi bi-house-fill"></a>
					</div>
				</div>
			</nav>
		</header>
		<main class="container">
			<section class="text-center my-5">
				<h2><?php echo $rowMateri["materi"]; ?></h2>
			</section>

			<section class="container">
				<?php while ($row = mysqli_fetch_assoc($result) ) : ?>
				<div class="card mb-3">
					<div class="container m-2">
						<input type="hidden" name="materi" value="<?php echo $row["materi"];?>">
						<h3 class="text-center h3-xs m-3"><?php echo $row["sub"]; ?></h3>
							<div class="m-3 text-center">
								<div class="d-flex justify-content-center m-3">
									<img src="../assets/img/<?php echo $row["file"]; ?>" class="w-md img-fluid" alt="<?php echo $row["imgDesk"]; ?>">
								</div>
								<p class="text-center" id="img-desc"><?php echo $row["imgDesk"]; ?></p>
								<?php if ($row["audio"] !== '' ) :?>
								<audio controls>
									<source src="../assets/sounds/<?php echo $row["audio"]; ?>">
								</audio>
								<?php endif; ?>
								
							</div>
						<p class="mx-3 p-xs"><?php echo $row["isi"]; ?></p>
					</div>
				</div>
				<?php endwhile; ?>
			</section>

			<section class="container-fluid">
			    <div class="owl-carousel owl-theme">
			     	<?php while ( $rowIntermezzo = mysqli_fetch_assoc($resultIntermezzo)) : ?>
					<div class="item p-4 d-block my-auto">
						<img src="../assets/img/<?php echo $rowIntermezzo["file"]; ?>" alt="<?php echo $rowIntermezzo["imgDesk"]; ?>" class="w-auto h-auto mw-100 d-block mx-auto" id="intermezzo">
						 <p class="p-xs m-2 text-center"  id="text-intermezzo"><?php echo $rowIntermezzo["isi"]; ?></p>
					</div>
					<?php endwhile; ?>
				</div>
			</section>
		</main>
		
		<a href="submateri.php?kelas=<?php echo $rowBack["kelas"]; ?>&mapel=<?php echo $rowBack["mapel"]; ?>">
			<button class="bi bi-arrow-left-circle-fill"></button>
		</a>
		
		<button class="bi bi-arrow-up-circle-fill float-end" onclick="topFunction();" id="upButton"></button>

		<section>
			<footer class="text-center p-3">
				<a href="https://www.vecteezy.com/free-vector/nature" target="blank">Nature Vectors by Vecteezy</a>
				<div class="py-3">
					Copyright&copy;2022 | Siswa Indonesia
				</div>
			</footer>
		</section>
		
		<script src="../assets/js/jquery-3.6.0.min.js"></script>
		<script src="../assets/js/bootstrap.min.js"></script>
		<script src="../assets/js/javascript.js"></script>
		<script src="../assets/js/owl.carousel.min.js"></script>
		<script>
			// carousel
			$(document).ready(function() {
				$('.owl-carousel').owlCarousel({
						loop:true,
						margin:10,
					 	nav:true,
						responsive:{
							0:{
								items:1
							},
							1000:{
								items:3
							}
						}
					});
			});
		</script>
	</body>
</html>