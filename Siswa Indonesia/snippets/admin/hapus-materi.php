<?php 
session_start();
if ( !isset($_SESSION ["login"]) ) {
	header("Location: ../../index.php");
	exit;
}

require 'koneksi.php';

if ( isset($_GET["id_mapel"])) {
	$id_mapel = $_GET["id_mapel"];
	$hapus = mysqli_query($conn, "DELETE FROM mapel WHERE id_mapel = '$id_mapel'");

	if ( $hapus ) {
		echo "
		<script>
			alert('Data berhasil dihapus!');
			document.location.href='tambah_materi.php';
		</script>
		";
	} else {
		echo "
		<script>
			alert('Data gagal dihapus!');
			document.location.href='tambah_materi.php';
		</script>
		";
	}
}
?>