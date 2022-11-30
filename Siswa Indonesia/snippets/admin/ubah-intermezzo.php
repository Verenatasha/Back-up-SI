<?php
session_start();
if ( !isset($_SESSION["login"]) ) {
	header("Location: ../../index.php");
	exit;
}

require 'koneksi.php';

$id_intermezzo = $_GET["id_intermezzo"];
$result = mysqli_query($conn, "SELECT * FROM intermezzo WHERE id_intermezzo = '$id_intermezzo' ");

if ( isset($_POST["ubah"]) ) {
	$id_intermezzo = htmlspecialchars($_POST["id_intermezzo"]);
	$kelas = $_POST["kelas"];
	$mapel = $_POST["mapel"];
	$materi = htmlspecialchars($_POST["materi"]);
	$isi = $_POST["isi"];
	$imgDesk = $_POST["imgDesk"];
	$fileOld = htmlspecialchars($_POST["fileOld"]);

	if ( $_FILES["file"]["error"] === 4 ) {
		$file = $fileOld;
	} else {
		$file = upload();
	}

	$result = mysqli_query($conn, "UPDATE intermezzo SET kelas = '$kelas', mapel = '$mapel
		', materi = '$materi', file = '$file', imgDesk = '$imgDesk', isi = '$isi' WHERE id_intermezzo = '$id_intermezzo' ");
	
	if ( $result ) {
		echo "
			<script>
				alert('Data berhasil diubah!');
				document.location.href='tambah_intermezzo.php#tabelIntermezzo';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data gagal diubah!');
				document.location.href='tambah_intermezzo.php#tabelIntermezzo';
			</script>
		";
	}
}

$resultKelas = mysqli_query($conn, "SELECT * FROM kelas");
?>
<!DOCTYPE html>
<html lang="in">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Siswa Indonesia | Edit Intermezzo</title>

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
								<a href="admin_page.php" class="nav-link">Beranda</a>
							</li>
							<li class="nav-item">
								<a href="tambah_materi.php" class="nav-link">Materi</a>
							</li>
							<li class="nav-item">
								<a href="tambah.php" class="nav-link">Konten</a>
							</li>
							<li class="nav-item">
								<a href="" class="nav-link" id="active">Intermezzo</a>
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
			<h3>Kelola Intermezzo</h3>
		</section>

		<article>
			<div class="container mb-5">
				<div class="card">
					<div class="card-header bg-danger text-white">Edit Intermezzo</div>
					<div class="card-body">
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="container">
								<div class="row">
									<?php while ($row = mysqli_fetch_assoc($result) ): ?>
									<input type="hidden" name="id_intermezzo" value="<?php echo $row["id_intermezzo"]; ?>">
									<input type="hidden" name="fileOld" value="<?php echo $row["file"]; ?>">
									<div class="col col-12 mb-2">
										<div class="input-group">
											<select class="form-select" name="kelas" id="kelas">
												<option selected><?php echo $row["kelas"]; ?></option>
												<?php while ( $rowKelas = mysqli_fetch_assoc($resultKelas)) : ?>
												<option value="<?php echo $rowKelas["kelas"]; ?>"><?php echo $rowKelas["kelas"]; ?></option>
												<?php endwhile; ?>
											</select>
										</div>
									</div>
									<div class="col col-12 mb-2">
										<div class="input-group">
											<select class="form-select" name="mapel" id="mapel">
												<option selected  value="<?php echo $row["mapel"]; ?>"><?php echo $row["mapel"]; ?></option>
											
											</select>
										</div>
									</div>
									<div class="col col-12 mb-2">
										<div class="input-group">
											<select class="form-select" name="materi" id="materi">
												<option selected value="<?php echo $row["materi"]; ?>"><?php echo $row["materi"]; ?></option>

											</select>
										</div>
									</div>
									<div class="col col-12 m-2">
										<img src="../../assets/img/<?= $row["file"]; ?>" id="image">
										<input type="file" id="file" class="form-control" name="file">
										<input type="text" class="form-control" name="imgDesk" value="<?php echo $row["imgDesk"]; ?>" placeholder="Keterangan gambar" maxlength="121">
									</div>
									<div class="col mb-5">
										<label for="deskripsi" class="form-label">Deskripsi</label>
										<textarea type="text" id="deskripsi" class="form-control mb-1" name="isi" rows="5" maxlength="1000"><?php echo $row["isi"]; ?></textarea>
										<p id="char-show">Jumlah karakter: <span id="char-numb"></span></p>
									</div>
								</div>
								<div class="button-group text-center mb-3 display-xs" role="group" aria-label="Basic mixed styles example">
									<button type="submit" name="ubah" class="btn btn-success" onclick="return confirm('Yakin mengubah?'); ">Simpan <i class="bi bi-file-earmark-check"></i></button>
									<button type="reset" name="batal" class="btn btn-secondary">Batal <i class="bi bi-x-circle"></i></button>
								</div>					
							</div>
						</form>
					<?php endwhile; ?>
					</div>
				</div>
			</div>
		</article>

		<a href="tambah_intermezzo.php">
			<button class="bi bi-arrow-left-circle-fill"></button>
		</a>

		<button class="bi bi-arrow-up-circle-fill float-end" onclick="topFunction()" id="upButton"></button>
		
		<section>
			<footer class="text-center p-3">
				<a href="https://www.vecteezy.com/free-vector/nature" target="blank">Nature Vectors by Vecteezy</a>
				<div class="py-3">
					Copyright&copy;2022 | Siswa Indonesia
				</div>
			</footer>
		</section>

		<script src="../../assets/js/jquery-3.6.0.min.js"></script>
		<script src="../../assets/js/bootstrap.min.js"></script>
		<script src="../../assets/js/javascript.js"></script>
		<script src="../../assets/js/lib.js"></script>
		<script src="../../assets/js/lib-max.js"></script>
	</body>
</html>