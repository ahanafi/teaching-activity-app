<?php
function isAuthenticated()
{
	$ci =& get_instance();
	return $ci->session->is_logged_in === TRUE;
}

function assets($pathFile)
{
	return base_url('assets/' . $pathFile);
}

function getData($tableName, $columns = '*', $where = [])
{
	$ci =& get_instance();
	$sql = "SELECT $columns FROM $tableName";

	if (count($where) !== 0) {
		$key = array_keys($where)[0];
		$val = array_values($where)[0];
		$sql .= " WHERE $key = '$val'";
	}

	return $ci->db->query($sql)->result();
}

/*
 * $type => success OR error
 * $actionType => insert, update, delete
 * $dataType => type of data
 *
 * Example message:
 * success => Data XYZ berhasil di.... [SIMPAN, PERBARUI, HAPUS]
 * error   => Data XYZ gagal di.... [SIMPAN, PERBARUI, HAPUS]
 * */
function setArrayMessage($type, $actionType, $dataType)
{
	$messageText = "";
	$messageType = "";
	$messageStatus = ($type == 'success') ? " berhasil " : " gagal ";

	if ($actionType === 'insert') {
		$messageType = " disimpan!";
	} else if ($actionType === 'update') {
		$messageType = " diperbarui!";
	} else if ($actionType === 'delete') {
		$messageType = " dihapus!";
	}
	$messageText = "Data " . $dataType . $messageStatus . $messageType;

	return [
		'type' => $type,
		'text' => $messageText,
	];
}

function getStatus($status, $type = 'status')
{
	$badge = "";
	if ($type == 'status') {
		if ($status == 1) {
			$badge = "<label class='badge badge-success'>AKTIF</label>";
		} else {
			$badge = "<label class='badge badge-danger'>NON-AKTIF</label>";
		}
	} elseif ($type == 'level') {
		if ($status == "ADMIN") {
			$badge = "<label class='badge badge-info'>ADMIN</label>";
		} else {
			$badge = "<label class='badge badge-warning'>CSO</label>";
		}
	}
	return $badge;
}

function getUser($index = null)
{
	if (isset($_SESSION['user'])) {
		$userSession = $_SESSION['user'];

		$userData = getData('pengguna', '*', [
			'id_pengguna' => $userSession->id_pengguna
		]);
		$user = $userData[0];

		if ($userSession->nama_lengkap !== $user->nama_lengkap || $userSession->username !== $user->username) {
			//Change session value
			$_SESSION['user'] = $user;
		}
		return $_SESSION['user']->$index;
	} else {
		return null;
	}
}

function showPageHeader($title = '')
{
	$ci =& get_instance();
	$firstSegment = $ci->uri->segment(1);
	$firstUri = ($title !== '') ? $title : $firstSegment;

	if($firstUri != 'dashboard') {
		$firstUri = "Data " . $firstUri;
	}

	$pageTitle = ucwords(strtolower(str_replace("-", " ", $firstUri)));

	return "<div class='row page-title-header'>
				<div class='col-12'>
					<div class='page-header'>
						<h4 class='page-title'>" . $pageTitle . "</h4>
					</div>
				</div>
			</div>";
}

function showUserLevel($index = NULL)
{
	$userLevel = [
		'SUPER_USER' => 'ADMINISTRATOR',
		'DOSEN' => 'DOSEN',
		'KAPRODI' => 'KEPALA PROGRAM STUDI'
	];

	return ($index !== null) ? $userLevel[$index] : $userLevel;
}

function listJenjang()
{
	return [
		'D1', 'D2', 'D3', 'D4',
		'S1', 'S2', 'S3'
	];
}

function listHari()
{
	return [
		'SENIN', 'SELASA', 'RABU', 'KAMIS', "JUM'AT", "SABTU"
	];
}

function showJamKuliah($jamMulai, $jamSelesai)
{
	$startTime = date_create($jamMulai);
	$startTime = date_format($startTime, "H:i");

	$endTime = date_create($jamSelesai);
	$endTime = date_format($endTime, "H:i");

	return $startTime . " ~ " . $endTime;
}

function showJam($jam)
{
	$jam = explode(":", $jam);
	return $jam[0] . ":" . $jam[1];
}

function daringApps($key = null)
{
	$apps = [
		'ZOOM' => 'Zoom',
		'WA_GROUP' => 'WA Group',
		'EDMODO' => 'Edmodo',
		'GOOGLE_CLASS' => 'Google Class',
		'QUIZIZZ' => 'Quizizz',
		'LAINNYA' => 'Lainnya',
	];

	if ($key != null) {
		if(!key_exists($key, $apps)) {
			return $apps['LAINNYA'];
		}
		return $apps[$key];
	}
	return $apps;
}

function materialType($key = null)
{
	$types = [
		'VIDEO' => 'Video',
		'PPT' => 'Powerpoint',
		'DOC' => 'Doc/Docx',
		'XLS' => 'Spreadsheet',
		'PDF' => 'PDF',
	];

	if ($key != null) {
		return $types[$key];
	}
	return $types;
}

function namaDosen($nama, $gelar) {
	$arrNama = explode(" ", ucwords(strtolower($nama)));

	if(count($arrNama) == 2 || count($arrNama) == 0) {
		$namaDosen = $nama;
	} else if(count($arrNama) == 3) {
		$namaDosen = $arrNama[0] . " " . $arrNama[1] . " " . $arrNama[2][0].". ";
	} else if(count($arrNama) == 4) {
		$namaDosen = $arrNama[0] . " " . $arrNama[1];
		$namaDosen .= " " . $arrNama[2][0].".". $arrNama[3][0] . "." ;
	}

	return $namaDosen . " " . $gelar;
}
