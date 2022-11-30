<?php
session_start();
if ( !isset($_SESSION["login"]) ) {
	header("Location: ../../index.php");
	exit;
}
require 'koneksi.php';

// add data
	if (isset($_POST['tambah'])) {
		$kelas = htmlspecialchars($_POST['kelas']);
		$mapel = htmlspecialchars($_POST['mapel']);
		$materi = htmlspecialchars($_POST['materi']);
		$imgDesk = $_POST["imgDesk"];

		$file = upload();
		if ( !$file ) {
			echo "
			<script>
				alert('Data gagal ditambahkan!');
				document.location.href = 'tambah_materi.php';
			</script>
			";
			return false;
		}

		$tambah = mysqli_query($conn, "INSERT INTO mapel (id_mapel, kelas, mapel, materi, file, imgDesk) values ('', '$kelas', '$mapel', '$materi', '$file', '$imgDesk')");
		
		if ($tambah) { 
			echo "
			<script>alert
				('Data berhasil ditambahkan!');
				document.location.href = 'tambah_materi.php';
			</script>";
		} else {
			echo "
			<script>
				alert('Data gagal ditambahkan!');
				document.location.href = 'tambah_materi.php';
			</script>
			";
		}
	} 

	$result = mysqli_query($conn, "SELECT * FROM mapel");
?>
<!DOCTYPE html>
<html lang="in">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Siswa Indonesia | Kelola Materi</title>

		<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="../../assets/css/style.css">
		<link rel="stylesheet" href="../../assets/font/bootstrap-icons.css">
		<link rel="stylesheet" href="../../assets/css/datatables.min.css">
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
								<a href="" class="nav-link" id="active">Materi</a>
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
			<h3>Kelola Materi</h3>
		</section>

		<article>
			<div class="container mb-5">
				<div class="card">
					<div class="card-header bg-danger text-white">Tambah Materi</div>
					<div class="card-body">
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="container">
								<div class="row">
									<input type="hidden" name="id_mapel">
									<div class="col col-12 mb-3">
										<div class="input-group">
											<select class="form-select" name="kelas">
												<option selected disabled>Kelas</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
											</select>
										</div>
									</div>
									<div class="col col-12 mb-3">
										<div class="input-group">
											<select class="form-select" name="mapel">
												<option selected disabled>Mata Pelajaran</option>
												<option value="Pendidikan Kewarganegaraan">Pendidikan Kewarganegaraan</option>
												<option value="Ilmu Pengetahuan Sosial">Ilmu Pengetahuan Sosial</option>
											</select>
										</div>
									</div>
									<div class="col col-12 mb-3">
										<input type="text" class="form-control" name="materi" placeholder="Materi" maxlength="121">
									</div>
									<div class="col mb-5">
										<input type="file" id="file" class="form-control" name="file">
										<input type="text" class="form-control" name="imgDesk" placeholder="Keterangan gambar" maxlength="121">
									</div>
								</div>
								<div class="button-group text-center mb-3 display-xs" role="group" aria-label="Basic mixed styles example">
									<button type="submit" name="tambah" class="btn btn-success">Simpan <i class="bi bi-file-earmark-check"></i></button>
									<button type="reset" name="batal" class="btn btn-secondary">Batal <i class="bi bi-x-circle"></i></button>
								</div>					
							</div>
						</form>
					</div>
				</div>
			</div>
		</article>
		<!--Form add content close-->

		<!--Show data-->
		<article>
			<div class="container mb-5">
				<div class="card">
				<div class="card-header bg-danger text-white" id="tabelMateri">Data Tersimpan</div>
					<div class="card-body">
						<table class="table table-bordered table-striped table-hover border-secondary" id="tabel">
							<thead>
								<tr class="table-dark">
									<th>No.</th>
									<th>Kelas</th>
									<th>Mata Pelajaran</th>
									<th>Materi</th>
									<th>Gambar</th>
									<th>Pilihan</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1; ?>
								<?php while ( $row = mysqli_fetch_assoc($result) ) : ?>
								<tr>
									<td class="text-center"><?= $i; ?>.</td>
									<td class="text-center"><?php echo $row["kelas"]; ?></td>
									<td><?php echo $row["mapel"]; ?></td>
									<td><?php echo $row["materi"]; ?></td>
									<td class="text-center"><img src="../../assets/img/<?php echo $row["file"]; ?>"></td>
									<td class="text-center">
										<button class="btn btn-warning mb-1"><a href="ubah-materi.php?id_mapel=<?php echo $row["id_mapel"]; ?>"><i class="bi bi-pencil-fill"></i></a></button><br>
										<button  class="btn btn-danger" onclick="return confirm('Yakin menghapus data?'); "><a href="hapus-materi.php?id_mapel=<?php echo $row["id_mapel"]; ?>"><i class="bi bi-trash-fill"></i></a></button>
									</td>
								</tr>
								<?php $i++; ?>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</article>
		
		<a href="logout.php" onclick="return confirm('Yakin keluar dari halaman admin?');">
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
		<script src="../../assets/js/datatables.min.js"></script>
		<script src="../../assets/js/lib.js"></script>
	</body>
</html>