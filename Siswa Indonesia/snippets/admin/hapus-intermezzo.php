<?php 
session_start();
if ( !isset($_SESSION ["login"]) ) {
	header("Location: ../../index.php");
	exit;
}

require 'koneksi.php';

if ( isset($_GET["id_intermezzo"])) {
	$id_intermezzo = $_GET["id_intermezzo"];
	$hapus = mysqli_query($conn, "DELETE FROM intermezzo WHERE id_intermezzo = '$id_intermezzo'");

	if ( $hapus ) {
		echo "
		<script>
			alert('Data berhasil dihapus!');
			document.location.href='tambah_intermezzo.php';
		</script>
		";
	} else {
		echo "
		<script>
			alert('Data gagal dihapus!');
			document.location.href='tambah_intermezzo.php';
		</script>
		";
	}
}
?>