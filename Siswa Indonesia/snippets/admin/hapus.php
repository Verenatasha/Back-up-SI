<?php 
session_start();
if ( !isset($_SESSION ["login"]) ) {
	header("Location: ../../index.php");
	exit;
}

require 'koneksi.php';

if ( isset($_GET["id_materi"])) {
	$id_materi = $_GET["id_materi"];
	$hapus = mysqli_query($conn, "DELETE FROM materi WHERE id_materi = '$id_materi'");

	if ( $hapus ) {
		echo "
		<script>
			alert('Data berhasil dihapus!');
			document.location.href='tambah.php';
		</script>
		";
	} else {
		echo "
		<script>
			alert('Data gagal dihapus!');
			document.location.href='tambah.php';
		</script>
		";
	}
}
?>