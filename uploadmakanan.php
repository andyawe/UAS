<?php

header("Content-Type: application/json; charset=UTF-8");
include './config/koneksi.php';


	// Membuat response array
	$response = array();

	// Cek method POST
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		$namamakanan = $_POST['namamakanan'];
		$descmakanan = $_POST['descmakanan'];
		$timeinsert = $_POST['timeinsert'];

		// Membuat try and catch agar mencoba menyimpan file ke direktori dengan aman
		try {

			$query = "INSERT INTO tb_makanan (
						nama_makanan,
						desc_makanan,
						insert_time
						) 
						VALUES (
						'$namamakanan',
						'$descmakanan',
						'$timeinsert'
						)";

			// Mengeksekusi query dan langsung mengecek apakah berhasil atau tidak
			if (mysqli_query($connection, $query)) {
				// Menampilkan pesan sukses upload
				$response['result'] = 1;
				$response['message'] = "Upload berhasil";
				$response['name'] = $namamakanan;
			}else {
				// Menampilkan pesan error
				$response['result'] = 0;
				$response['message'] = "Upload gagal";
			}
			
		} catch (Exception $e) {
			$response['result'] = 0;
			$response['message'] = $e->getMessage();
		}

		// displaying the response JSON
		echo json_encode($response);

		// closing the connection
		mysqli_close($connection);

}


