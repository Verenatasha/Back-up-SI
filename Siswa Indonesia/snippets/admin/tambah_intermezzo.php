<?php
session_start();
if ( !isset($_SESSION["login"]) ) {
	header("Location: ../../index.php");
	exit;
}

require 'koneksi.php';

	if (isset($_POST['tambah'])) {
		$kelas = $_POST['kelas'];
		$mapel = $_POST['mapel'];
		$materi = htmlspecialchars($_POST['materi']);
		$isi = ($_POST['isi']);
		$imgDesk = $_POST['imgDesk'];
		$file = upload();
		if ( !$file ) {
			echo "
			<script>
				alert('Data gagal ditambahkan!');
				document.location.href = 'tambah_intermezzo.php';
			</script>
			";
			return false;
		}

		$tambah = mysqli_query($conn, "INSERT INTO intermezzo (id_intermezzo, kelas, mapel, materi, file,imgDesk, isi) values ('', '$kelas', '$mapel', '$materi', '$file','$imgDesk', '$isi')");
		
		if ($tambah) { 
			echo "
			<script>
				alert('Data berhasil ditambahkan!');
				document.location.href = 'tambah_intermezzo.php';
			</script>";
		} else {
			echo "
			<script>
				alert('Data gagal ditambahkan!');
				document.location.href = 'tambah_intermezzo.php';
			</script>
			";
		}
	} 

	$result = mysqli_query($conn, "SELECT * FROM intermezzo");

	$resultOptionsKelas = mysqli_query($conn, "SELECT * FROM kelas");
?>
<!DOCTYPE html>
<html lang="in">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Siswa Indonesia | Kelola Intermezzo</title>

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
					<div class="card-header bg-danger text-white">Tambah Intermezzo</div>
					<div class="card-body">
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="container">
								<div class="row">
									<input type="hidden" name="id_intermezzo">
									<div class="col col-12 mb-2">
										<div class="input-group">
											<select class="form-select" name="kelas" id="kelas">
												<option selected disabled>Pilih Kelas</option>
												<?php while ( $rowOptionsKelas = mysqli_fetch_assoc($resultOptionsKelas)) : ?>
												<option value="<?php echo $rowOptionsKelas ["kelas"]; ?>"><?php echo $rowOptionsKelas["kelas"]; ?></option>
												<?php endwhile; ?>
											</select>
										</div>
									</div>
									<div class="col col-12 mb-2">
										<div class="input-group">
											<select class="form-select" name="mapel" id="mapel">
												<option selected disabled>Pilih Mata Pelajaran</option>

											</select>
										</div>
									</div>
									<div class="col col-12 mb-2">
										<div class="input-group">
											<select class="form-select" name="materi" id="materi">
												<option selected disabled>Pilih Materi</option>
													
											</select>
										</div>
									</div>									
									<div class="col mb-5">
										<input type="file" id="file" class="form-control" name="file">
										<input type="text" class="form-control mb-3" name="imgDesk" placeholder="Keterangan gambar" maxlength="121">
										<label for="deskripsi" class="form-label">Deskripsi</label>
										<textarea type="text" id="deskripsi" class="form-control mb-1" name="isi" id="deskripsi" rows="5" maxlength="1000"></textarea>
										<p id="char-show">Jumlah karakter: <span id="char-numb"></span></p>
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
					<div class="card-header bg-danger text-white" id="tabelIntermezzo">Data Tersimpan</div>
					<div class="card-body">
						<table class="table table-bordered table-striped table-hover border-secondary" id="tabel">
							<thead>
								<tr class="table-dark">
									<th>No.</th>
									<th>Kelas</th>
									<th>Mata Pelajaran</th>
									<th>Materi</th>
									<th>Gambar</th>
									<th>Deskripsi</th>
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
									<td><?php echo $row["isi"]; ?></td>
									<td class="text-center">
										<button class="btn btn-warning mb-1"><a href="ubah-intermezzo.php?id_intermezzo=<?php echo $row["id_intermezzo"]; ?>"><i class="bi bi-pencil-fill"></i></a></button><br>
										<button  class="btn btn-danger mb-1" onclick="return confirm('Yakin menghapus data?'); "><a href="hapus-intermezzo.php?id_intermezzo=<?php echo $row["id_intermezzo"]; ?>"><i class="bi bi-trash-fill"></i></a></button>
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

		<a href="logout.php" onclick="return confirm('Yakin keluar dari halaman admin?'); ">
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
		<script src="../../assets/js/lib-max.js"></script>
	</body>
</html>