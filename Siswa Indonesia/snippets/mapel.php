<?php 
require 'admin/koneksi.php';
$kelas = $_GET["kelas"];
$result = mysqli_query($conn, "SELECT * FROM matpel WHERE kelas = '$kelas' ");

$resultKelas = mysqli_query($conn, "SELECT * FROM matpel WHERE kelas = '$kelas' ");
$rowKelas = mysqli_fetch_assoc($resultKelas);
?>
<!DOCTYPE html>
<html lang="in">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Siswa Indonesia | Kelas <?php echo $rowKelas["kelas"]; ?></title>

		<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/css/style.css">
		<link rel="stylesheet" href="../assets/font/bootstrap-icons.css">
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
					<div class="col col-md-7 col-sm-7 col-xs-7 my-auto" id="desc-content">
						<h4 class="d-inline">Kelas <?php echo $rowKelas["kelas"]; ?></h4>
						<div class=" d-inline">
							
						</div>
						<h5 class="d-md-inline"></h5>
					</div>
					<div class="col col-md-1" id="login-button">
						<a href="../index.php" class="bi bi-house-fill"></a>
					</div>
				</div>
			</nav>
		</header>
		<section>
			<div class="container mt-5 pt-5">
				<div id="portfolio-grid" class="row no-gutter" data-aos="fade-up" data-aos-delay="200">
					<?php while ( $row = mysqli_fetch_assoc($result) ) : ?>
					<div class="item web col col-md-6 col-sm-12 col-xs-12 mb-5 px-xs-5">
						<a href="submateri.php?kelas=<?php echo $row["kelas"]; ?>&mapel=<?php echo $row["matpel"]; ?>" class="item-wrap fancybox">
							<div class="work-info">
				            	<h4><?php echo $row["imgDesk"]; ?></h4>
				            </div>
							<img src="../assets/img/<?php echo $row["file"]; ?>" alt="<?php echo $row["imgDesk"]; ?>" height="180" class="w-100 mw-100 mh-100">
							<div class="card-body text-center">
						 		<h3 class="card-title" id="title-materi"><?php echo $row["matpel"]; ?></h3>
						 	</div>
							
						</a>
					</div>
					<?php endwhile; ?>
				</div>
			</div>
		</section>

		<a href="../index.php#kelas">
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

		<script src="../assets/js/bootstrap.min.js"></script>
		<script src="../assets/js/javascript.js"></script>
	</body>
</html>