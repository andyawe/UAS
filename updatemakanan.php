<?php

header("Content-Type: application/json; charset=UTF-8");
// Memasukkan koneksi.php ke dalam file ini agar nanti bisa mengakses phpmyadmin
include './config/koneksi.php';


// Membuat penampung response array
$response = array();

// Pengecekan metode yang di request oleh user, harus method POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	// Pengecekan parameter yang dibutuhkan
	if (isset($_POST["idmakanan"]) &&
		isset($_POST["namamakanan"]) &&
		isset($_POST["descmakanan"]) &&
		isset($_POST["inserttime"])){
		
		// Memasukkan data yang sudah dikirim oleh user di dalam parameter ke variable penampung baru
		$idmakanan = $_POST["idmakanan"];
		$namamakanan = $_POST["namamakanan"];
		$descmakanan = $_POST["descmakanan"];
		$inserttime = $_POST["inserttime"];


			$sql = "UPDATE tb_makanan SET
			nama_makanan = '$namamakanan',
			desc_makanan = '$descmakanan',
			insert_time = '$inserttime'
			WHERE id_makanan = $idmakanan";

			

		// Melakukan operasi update dengan perintah yang sudah kita buat di dalam variable $sql
		// Dan langsung cek apakah eksekusinya berhasil
		if (mysqli_query($connection, $sql)) {
					// Berhasil masukkan pesan berhasil ke response
			$response["result"] = 1;
			$response["message"] = "Update berhasil";
			$response['name'] = $namamakanan;
		}else{
			// Menampilkan pesan gagal update
			$response["result"] = 0;
			$response["message"] = "Update gagal";
		}		
		// Menampilkan response dalam bentuk JSON
		
	}else{
			// Menampilkan pesan gagal update
			$response["result"] = 0;
			$response["message"] = "Update gagal, data kurang";
	}

	echo json_encode($response);
}
?>