const inputKarakter = document.getElementById('deskripsi');
const maxKarakter = inputKarakter.maxLength;
const jumlahKarakter = inputKarakter.value.length;
const tampilkanJumlahKarakter = document.getElementById('char-numb').innerText = jumlahKarakter + '/' + maxKarakter ;
inputKarakter.addEventListener('input', function() {
	const jumlahKarakter = inputKarakter.value.length;
	const tampilkanJumlahKarakter = document.getElementById('char-numb').innerText = jumlahKarakter + '/' + maxKarakter ;
	tampilkanJumlahKarakter;
});

inputKarakter.addEventListener('blur', function() {
	const teksKarakter = document.getElementById('char-show');
	teksKarakter.style.visibility = 'hidden';
});

inputKarakter.addEventListener('focus', function() {
	const teksKarakter = document.getElementById('char-show');
	teksKarakter.style.visibility = 'visible';
});