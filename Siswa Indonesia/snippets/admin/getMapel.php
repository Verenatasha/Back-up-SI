<?php 
require 'koneksi.php';

$kelas = $_GET["kelas"];

$resultMapel = mysqli_query($conn, "SELECT * FROM matpel WHERE kelas = '$kelas' ORDER BY kelas "); ?>
<option selected disabled>Pilih Mata Pelajaran</option>
<?php while ( $rowKelas = mysqli_fetch_assoc($resultMapel) ) :?>
<option value="<?php echo $rowKelas["matpel"]; ?>"><?php echo $rowKelas["matpel"]; ?></option>
<?php endwhile; ?>