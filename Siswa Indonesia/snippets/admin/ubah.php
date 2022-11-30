<?php
session_start();
if ( !isset($_SESSION["login"]) ) {
	header("Location: ../../index.php");
	exit;
}

require 'koneksi.php';

$id_materi = $_GET["id_materi"];
$result = mysqli_query($conn, "SELECT * FROM materi WHERE id_materi = '$id_materi' ");

if ( isset($_POST["ubah"]) ) {
	$id_materi = htmlspecialchars($_POST["id_materi"]);
	$kelas = htmlspecialchars($_POST["kelas"]);
	$mapel = htmlspecialchars($_POST["mapel"]);
	$materi = htmlspecialchars($_POST["materi"]);
	$sub = htmlspecialchars($_POST["sub"]);
	$isi = ($_POST["isi"]);
	$fileOld = htmlspecialchars($_POST["fileOld"]);
	$audioOld = htmlspecialchars($_POST["audioOld"]);
	$imgDesk = ($_POST['imgDesk']);

	if ( $_FILES["file"]["error"] === 4 ) {
		$file = $fileOld;
	} else {
		$file = upload();
	}

	if ( $_FILES["audio"]["error"] === 4 ) {
		$audio = $audioOld;
	} else {
		$audio = audio();
	}

	$result = mysqli_query($conn, "UPDATE materi SET materi = '$materi', kelas = '$kelas', mapel = '$mapel', sub = '$sub', file = '$file', imgDesk = '$imgDesk', audio = '$audio', isi = '$isi' WHERE id_materi = '$id_materi' ");
	
	if ( $result ) {
		echo "
			<script>
				alert('Data berhasil diubah!');
				document.location.href='tambah.php#tabelKonten';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data gagal diubah!');
				document.location.href='tambah.php#tabelKonten';
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
		<title>Siswa Indonesia | Kelola Konten</title>

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
								<a href="" class="nav-link" id="active">Konten</a>
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
			<h3>Kelola Konten</h3>
		</section>

		<article>
			<div class="container mb-5">
				<div class="card">
					<div class="card-header bg-danger text-white">Edit Konten</div>
					<div class="card-body">
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="container">
								<div class="row">
									<?php while ($row = mysqli_fetch_assoc($result) ): ?>
									<input type="hidden" name="id_materi" value="<?php echo $row["id_materi"]; ?>">
									<input type="hidden" name="fileOld" value="<?php echo $row["file"]; ?>">
									<input type="hidden" name="audioOld" value="<?php echo $row["audio"]; ?>">

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
									<div class="col col-12">
										<input type="text" class="form-control" name="sub" placeholder="Submateri" value="<?php echo $row["sub"]; ?>" maxlength="252">
									</div>
									<div class="col col-12 m-2">
										<img src="../../assets/img/<?= $row["file"]; ?>" id="image">
										<input type="file" id="file" class="form-control" name="file">
										<input type="text" class="form-control" name="imgDesk" placeholder="Keterangan gambar" value="<?php echo $row["imgDesk"]; ?>" maxlength="252">
									</div>
									<div class="col mb-5">
										<audio controls>
											<source src="../../assets/sounds/<?php echo $row["audio"]; ?>">
										</audio>
										<input type="file" id="audio" class="form-control mb-3" name="audio">
										<label for="deskripsi" class="form-label">Deskripsi</label>
										<textarea type="text" id="deskripsi" class="form-control mb-1" name="isi" rows="10" maxlength="50000"><?php echo $row["isi"]; ?></textarea>
										<p id="char-show">Jumlah karakter: <span id="char-numb"></span></p>
									</div>
								</div>
								<?php endwhile; ?>
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

		<a href="tambah.php">
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

		<script src="../../assets/js/jquery-3.6.0.min.js"></script>
		<script src="../../assets/js/bootstrap.min.js"></script>
		<script src="../../assets/js/javascript.js"></script>
		<script src="../../assets/js/lib.js"></script>
		<script src="../../assets/js/lib-max.js"></script>
	</body>
</html>