<?php 
session_start();
if ( isset($_SESSION["login"]) ) {
	header("Location: snippets/admin/admin_page.php");
}
	require_once 'snippets/admin/koneksi.php';

	if (isset($_POST['login'])) {
		$nama = $_POST['nama'];
		$password = $_POST['password'];


		$result = mysqli_query($conn, "SELECT * FROM admin WHERE nama = '$nama' ");
		$num = mysqli_num_rows($result);
		
		if ($num === 1) {
			$row = mysqli_fetch_assoc($result);
			 if ( $password === $row["password"]) {
			 	$_SESSION["login"] = true;
			 	header("Location: snippets/admin/admin_page.php");
			 }
			
			}else{
			
				echo "<script>alert('Nama atau Password yang Anda masukkan salah! Silahkan coba lagi!'); </script>";
			}
}

	$result = mysqli_query($conn, "SELECT * FROM kelas");
?>
<!DOCTYPE html>
<html lang="in">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Siswa Indonesia | Beranda</title>

		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/font/bootstrap-icons.css">
		<style>
			<?php include 'assets/css/style.css';?>
		</style>
	</head>
	<body>
		<!--Modal login-->
			<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<p class="modal-title">Halaman Login</p>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="p-4" id="form-login">
								<h2>Halo, Admin!</h2>
								<h4>Yuk, masuk ke akun dulu</h4>
								<form action="" method="POST" class="row mt-4">
									<div class="col-4">
										<label for="nama" class="form-label">
											Nama
										</label>
									</div>
									<div class="col-8 mb-2">
										<input type="text" name="nama" class="form-control" placeholder="Masukkan nama" aria-describedby="namaHelp" id="nama" autocomplete="off" autofocus required>
									</div>
									<div class="col-4">
										<label for="password" class="form-label">
											Kata Sandi
										</label>
									</div>
									<div class="col-8 mb-2">
										<input type="password" name="password" class="form-control" placeholder="Masukkan kata sandi" aria-describedby="passwordHelp" id="password" autocomplete="off" required>
									</div>
									<div class="d-flex justify-content-end mb-3">
										<button type="submit" class="btn btn-danger" id="button-start" name="login">Masuk <i class="bi bi-box-arrow-in-right"></i></button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- 	Modal login close -->

		<header class="nav position-sticky top-0 py-3" id="header">
			<nav  class="container-fluid">
				<div class="row">
					<div class="col col-md-4 col-sm-5 col-xs-5 my-auto text-center" id="logo">
						<a href="">
							<h2>Siswa<span> Indonesia</span></h2>
						</a>
					</div>
					<div class="col col-md-7 col-sm-7 col-xs-7 text-center">
						<ul class="nav">
							<li class="nav-item">
								<a href="" class="nav-link">Beranda</a>
							</li>
							<li class="nav-item">
								<a href="#kelas" class="nav-link">Kelas</a>
							</li>
						</ul>
					</div>
					<div class="col col-md-1" id="login-button">
						<div data-bs-toggle="modal" data-bs-target="#staticBackdrop">
						<button class="bi bi-person-circle"></button>
					</div>
				</div>
			</nav>
		</header>

		<section class="mt-5" id="home">
			<div class="text-center my-5 py-5">
				<h1 id="">Selamat Datang Generasi Muda Indonesia</h1>
				<h4>Mari Menjadi Siswa Indonesia yang Bijak Dan Cerdas</h4>
				<div class="d-flex justify-content-center">
					<a href="#kelas" class="btn btn-danger" id="button-start">
					Mulai
					<i class="bi bi-caret-right-fill"></i>
					</a>
				</div>	
			</div>	
		</section>

		<section id="newsletter" class="newsletter text-center wow fadeInUp">
	    	<div class="overlay padd-section">
	    		<div class="container">

	        
	     	 	</div>
	    	</div>
		</section>

		<section class="container mt-5 pt-5 mb-5" id="kelas">
			<header class="mt-5 py-5">
				<div class="text-center">
					<h2>Pilih Kelas</h2>
				</div>
			</header>
			<div id="portfolio-grid" class="row no-gutter" data-aos="fade-up" data-aos-delay="200">
	      		<?php while ( $row = mysqli_fetch_assoc($result) ) : ?>
	       	 	<div class="item web text-center col-xs-12 col-sm-12 col-md-6 col-lg-4 mb-4 px-xs-5">
	        		<a href="snippets/mapel.php?kelas=<?php echo $row["kelas"]; ?>" class="item-wrap fancybox">
		         		<div class="work-info">
		            		<h4><?php echo $row["imgDesk"]; ?></h4>
		            	</div>
		          	 	<img class="img-fluid" src="assets/img/<?php echo $row["file"]; ?>" id="class-img" alt="<?php echo $row["imgDesk"]; ?>" class="w-100 mw-100 mh-100">
		          		<h4 class="text-center my-3" id="class-text">Kelas <?php echo $row["kelas"]; ?></h4>		          	 	
		       		</a>
		   		</div>
         		<?php endwhile; ?>
      		</div>
 		</section>

 		<a href="" class="cursor-default" ;>
			<button class="bi bi-arrow-left-circle-fill invisible"></button>
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
 		
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/javascript.js"></script>	
	</body>
</html>