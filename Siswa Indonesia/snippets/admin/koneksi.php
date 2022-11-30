<?php
	$conn = mysqli_connect("localhost", "root", "", "coba");
	
	function upload() {
		$nameFile = $_FILES["file"]["name"];
		$error = $_FILES["file"]["error"];
		$tmpName = $_FILES["file"]["tmp_name"];
		$ekstensiFileValid = ["jpg", "jpeg", "png", "gif"]; // ekstensi yg diperbolehkan
		$ekstensiFile = explode(".", $nameFile);
		$ekstensiFile = strtolower(end($ekstensiFile));
		
		// cek apakah ada gambar atau tidak
		if ( $error === 4 ) {
			echo "
				<script>
					alert('Pilih gambar terlebih dahulu!');
				</script>
			";
			return false;
			exit;
		}

		// cek apakah gambar atau bukan
		if ( !in_array($ekstensiFile, $ekstensiFileValid) ) {
			echo "
				<script>
					alert('Yang Anda pilih bukan gambar!');
				</script>
			";
			return false;
		}

		// generate nama gambar baru
		$newNameFile = uniqid();
		$newNameFile .= ".";
		$newNameFile .= $ekstensiFile;

		// memindahkan file dari penyimpanan sementara
		move_uploaded_file($tmpName, "../../assets/img/".$newNameFile);

		return $newNameFile;

	}

	function audio() {
		$nameAudio = $_FILES["audio"]["name"];
		$error = $_FILES["audio"]["error"];
		$tmpName = $_FILES["audio"]["tmp_name"];
		$ekstensiAudioValid = ["mp3", "3gp"]; // ekstensi yg diperbolehkan
		$ekstensiAudio = explode(".", $nameAudio);
		$ekstensiAudio = strtolower(end($ekstensiAudio));

		if ( $error === 4 ) {
			echo "
				<script>
					alert('Pilih audio terlebih dahulu!');
				</script>
			";
			return false;
			exit;
		}

		if ( !in_array($ekstensiAudio, $ekstensiAudioValid) ) {
			echo "
				<script>
					alert('Yang Anda pilih bukan audio!');
				</script>
			";
			return false;
		}

		// generate nama gambar baru
		$newNameAudio = uniqid();
		$newNameAudio .= ".";
		$newNameAudio .= $ekstensiAudio;

		// memindahkan file dari penyimpanan sementara
		move_uploaded_file($tmpName, "../../assets/sounds/".$newNameAudio);

		return $newNameAudio;

	}
?>