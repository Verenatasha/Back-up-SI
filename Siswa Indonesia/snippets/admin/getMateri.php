<?php 
require 'koneksi.php';

$mapel = $_GET["mapel"];
$kelas = $_GET["kelas"];
$resultMateri = mysqli_query($conn, "SELECT * FROM mapel WHERE mapel = '$mapel' AND kelas = '$kelas' ORDER BY mapel "); ?>
<option selected disabled>Pilih Materi</option>
<?php while ($rowMateri = mysqli_fetch_assoc($resultMateri)) : ?>
<option value="<?php echo $rowMateri["materi"]; ?>"><?php echo $rowMateri["materi"]; ?></option>
<?php endwhile; ?>