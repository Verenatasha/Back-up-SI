<?php 
session_start();
if (!isset($_SESSION["login"]) ) {
	header("Location: ../../index.php");
	exit;
}

require 'koneksi.php';
$id_matpel = $_GET["id_matpel"];
$result = mysqli_query($conn, "SELECT * FROM matpel WHERE id_matpel = '$id_matpel' ");

if ( isset ($_POST["ubah"])) {
	$id_matpel = $_POST["id_matpel"];
	$kelas = $_POST["kelas"];
	$matpel = $_POST["matpel"];
	$imgDesk = $_POST["imgDesk"];
	$fileOld = htmlspecialchars($_POST["fileOld"]);

	if ( $_FILES["file"]["error"] === 4 ) {
		$file = $fileOld;
	} else {
		$file = upload();
	}

	$ubah = mysqli_query($conn, "UPDATE matpel SET kelas = '$kelas', matpel = '$matpel' , file = '$file', imgDesk = '$imgDesk' WHERE id_matpel = '$id_matpel' ");
	if ($ubah) {
		echo "
			<script>
				alert('Data berhasil diubah!');
				document.location.href = 'admin_page.php#matpel';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data gagal diubah!');
				document.location.href = 'admin_page.php#matpel';
			</script>
		";
	}
}
?>
<!DOCTYPE html>
<html lang="in">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Siswa Indonesia | Kelola Tampilan</title>

		<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="../../assets/css/style.css">
		<link rel="stylesheet" href="../../assets/font/bootstrap-icons.css">
		<style>
			<?php include '../../assets/css/style.css';?>
		</style>
	</head>
	<body>
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
								<a href="" class="nav-link" id="active">Beranda</a>
							</li>
							<li class="nav-item">
								<a href="tambah_materi.php" class="nav-link">Materi</a>
							</li>
							<li class="nav-item">
								<a href="tambah.php" class="nav-link">Konten</a>
							</li>
							<li class="nav-item">
								<a href="tambah_intermezzo.php" class="nav-link">Intermezzo</a>
							</li>
						</ul>
					</div>
					<div class="col col-md-1" id="login-button">
						<a href="logout.php" class="bi bi-box-arrow-right" onclick="return confirm('Yakin keluar dari halaman admin?');"></a>
					</div>
				</div>
			</nav>
		</header>

		<section class="text-center my-5">
			<h3>Kelola Beranda</h3>
		</section>

		<article>
			<div class="container mb-5">
				<div class="card">
					<div class="card-header bg-danger text-white">Ubah Mata Pelajaran</div>
					<div class="card-body">
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="container">
								<div class="row">
									<?php while ( $row = mysqli_fetch_assoc($result)) : ?>
									<input type="hidden" name="id_matpel" value="<?php echo $row["id_matpel"]; ?>">
									<input type="hidden" name="fileOld" value="<?php echo $row["file"]; ?>">
									<div class="col col-12 mb-2">
										<input type="text" class="form-control" name="kelas" value="<?php echo $row["kelas"];?>">
									</div>
									<div class="col col-12 mb-2">
										<input type="text" class="form-control" name="matpel" value="<?php echo $row["matpel"];?>">
									</div>
									<div class="col mb-5">
										<img src="../../assets/img/<?php echo $row["file"]; ?>" id="image">
										<input type="file" id="file" class="form-control" name="file">
										<input type="text" class="form-control mb-3" name="imgDesk" placeholder="Keterangan gambar" value="<?php echo $row["imgDesk"]; ?>" maxlength="252">
									</div>
									<?php endwhile; ?>
								</div>
								<div class="button-group text-center mb-3 display-xs" role="group" aria-label="Basic mixed styles example">
									<button type="submit" name="ubah" class="btn btn-success" onclick="return confirm('Yakin mengubah?'); ">Simpan <i class="bi bi-file-earmark-check"></i></button>
									<button type="reset" name="batal" class="btn btn-secondary">Batal <i class="bi bi-x-circle"></i></button>
								</div>					
							</div>
						</form>
					</div>
				</div>
			</div>
		</article>

		<a href="admin_page.php" class="container-fluid bi bi-arrow-left-circle-fill" id="back">
		</a>

		<section>
			<footer class="text-center p-3">
				<a href="https://www.vecteezy.com/free-vector/nature" target="blank">Nature Vectors by Vecteezy</a>
				<div class="py-3">
					Copyright&copy;2022 | Siswa Indonesia
				</div>
			</footer>
		</section>

		<script src="../../assets/js/bootstrap.min.js"></script>
	</body>
</html>