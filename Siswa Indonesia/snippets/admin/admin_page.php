<?php
session_start();
if ( !isset($_SESSION ["login"]) ) {
	header("Location: ../../index.php");
	exit;
}

require 'koneksi.php';

$resultKelas = mysqli_query ($conn, "SELECT * FROM kelas");

$resultMapel = mysqli_query($conn, "SELECT * FROM matpel");
?>
<!DOCTYPE html>
<html lang="in">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Siswa Indonesia | Kelola Beranda</title>

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

		<article id="kelas">
			<div class="container mb-5">
				<div class="card">
					<div class="card-header bg-danger text-white">Data Kelas</div>
					<div class="card-body">
						<table class="table table-bordered table-striped table-hover border-secondary">
							<thead>
								<tr class="text-center table-dark">
									<th>No.</th>
									<th>Kelas</th>
									<th>Gambar</th>
									<th>Keterangan</th>
									<th>Pilihan</th>
								</tr>
							</thead>
							<tbody>
							<?php $i = 1; ?>
							<?php while ( $rowKelas = mysqli_fetch_assoc($resultKelas) ) : ?>
								<tr>
									<td class="text-center"><?= $i; ?>.</td>
									<td class="text-center"><?php echo $rowKelas["kelas"]; ?></td>
									<td class="text-center"><img src="../../assets/img/<?php echo $rowKelas["file"]; ?>"></td>
									<td><?php echo $rowKelas["imgDesk"]; ?></td>
									<td class="text-center">
										<button class="btn btn-warning mb-1"><a href="setting.php?id_kelas=<?php echo $rowKelas["id_kelas"]; ?>"><i class="bi bi-pencil-fill"></i></a></button>
										<button  class="btn btn-danger" onclick="return confirm('Yakin menghapus data?'); "><a href="hapus.php?id_kelas=<?php echo $rowKelas["id_kelas"]; ?>"><i class="bi bi-trash-fill"></i></a></button>
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

		<article id="matpel">
			<div class="container mb-5">
				<div class="card">
					<div class="card-header bg-danger text-white">Data Mata Pelajaran</div>
					<div class="card-body">
						<table class="table table-bordered table-striped table-hover border-secondary" id="tabel">
							<thead>
								<tr class="table-dark">
									<th>No.</th>
									<th>Kelas</th>
									<th>Mata Pelajaran</th>
									<th>Gambar</th>
									<th>Keterangan</th>
									<th>Pilihan</th>
								</tr>
							</thead>
							<tbody>
							<?php $i = 1; ?>
							<?php while ( $rowMapel = mysqli_fetch_assoc($resultMapel) ) : ?>
								<tr>
									<td class="text-center"><?= $i; ?>.</td>
									<td class="text-center"><?php echo $rowMapel["kelas"]; ?></td>
									<td><?php echo $rowMapel["matpel"]; ?></td>
									<td class="text-center"><img src="../../assets/img/<?php echo $rowMapel["file"]; ?>"></td>
									<td><?php echo $rowMapel["imgDesk"]; ?></td>
									<td class="text-center">
										<button class="btn btn-warning mb-1"><a href="set-mapel.php?id_matpel=<?php echo $rowMapel["id_matpel"]; ?>"><i class="bi bi-pencil-fill"></i></a></button>
										<button  class="btn btn-danger" onclick="return confirm('Yakin menghapus data?'); "><a href="hapus.php?id_matpel=<?php echo $rowMapel["id_matpel"]; ?>"><i class="bi bi-trash-fill"></i></a></button>
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

		<a href="logout.php" onclick="return confirm('Yakin keluar dari Halaman Admin?'); ">
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
		<script src="../../assets/js/datatables.min.js"></script>
		<script src="../../assets/js/lib.js"></script>
	</body>
</html>