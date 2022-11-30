// option
$(document).ready(function(){
	$("#kelas").change(function(){
		var kelas = $("#kelas").val();
		$.ajax({
			url: "getMapel.php",
			data: "kelas="+kelas,
			cache: false,
			success: function(msg){
				$("#mapel").html(msg);
			}
		});
	});

	$("#mapel").change(function() {
		var mapel = $("#mapel").val();
		var kelas = $("#kelas").val();
		$.ajax({
			url: "getMateri.php",
			data: {mapel:mapel,
				kelas:kelas},
			cache: false,
			success: function(msg) {
				$("#materi").html(msg);
			}
		});
	});

	$('#tabel').DataTable();
});