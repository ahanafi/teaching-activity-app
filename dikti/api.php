<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
<form action="" method="POST">
	<label for="">UUDI DOSEN</label>:
	<textarea name="uuid" ></textarea>
	<br>
	<input type="submit" name="submit">
</form>
</body>
</html>

<?php
if(isset($_POST['submit'])) {
	$id = $_POST['uuid'];

	$link = mysqli_connect("localhost", "root", "password", "cic_teaching_activity") or die("Error database connection");


	$id = explode(",", $id);
	foreach ($id as $dosenId) {
		$api = file_get_contents('https://api-frontend.kemdikbud.go.id/detail_dosen/' . $dosenId);
		$api = json_decode($api);

		$insertQuery = "INSERT INTO mata_kuliah ";
		$columns = "(kode_mata_kuliah, nama_mata_kuliah, sks) ";
		foreach ($api->datamengajar as $mengajar) {
			$tahunAjar = $mengajar->id_smt;

			if((int) $tahunAjar > 20182) {
				$kodeMk = $mengajar->kode_mk;
				$namaMk = ucwords(strtolower($mengajar->nm_mk));
				$sks = 2;

				$values = "('$kodeMk', '$namaMk', '$sks')";
				$cek = mysqli_query($link, "SELECT * FROM mata_kuliah WHERE kode_mata_kuliah = '$kodeMk'");
				if(mysqli_num_rows($cek) <= 0) {
					$query = $insertQuery . $columns . " VALUES " . $values;
					$insert = mysqli_query($link, $query);
					if(!$insert) {
						echo mysqli_error($link) . " <br>";
					} else {
						echo $namaMk . " berhasil diinsert! <br>";
					}
				} else {
					echo $namaMk . " sudah ada di database! <br>";
				}
			}
		}

	}


}
