<?php
function isAuthenticated()
{
	$ci =& get_instance();
	return $ci->session->is_logged_in === TRUE;
}

function assets($pathFile) {
	return base_url('assets/'. $pathFile);
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

		if ($userSession->nama_lengkap !== $user->nama_lengkap || $userSession->username !== $user->username || $userSession->email !== $user->email) {
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
	$firstUri = ($title !== '') ? $title : "Data " . $firstSegment;
	if($firstSegment == "verifikasi") {
		$firstUri = ucfirst($firstSegment) . " Donasi";
	}
	$totalSegment = $ci->uri->total_segments();
	$class = "breadcrumb-item";
	$pageTitle = ucwords(strtolower(str_replace("-", " ", $firstUri)));

	$pageHeader = "
		<div class='content-header'>
			<div class='container-fluid'>
				<div class='row mb-2'>
					<div class='col-sm-6'>
						<h1 class='m-0 text-dark'>" . $pageTitle . "</h1>
					</div>
					<div class='col-sm-6'>
						<ol class='breadcrumb float-sm-right'>
							<li class='$class'><a href='" . base_url('dashboard') . "'>Dashboard</a></li>";

	for ($i = 1; $i <= $totalSegment; $i++) {
		$uri = $ci->uri->segment($i);
		if ($uri !== 'dashboard') {

			$label = ucfirst(str_replace("-", " ", $uri));

			if ($uri == 'edit' || $uri == 'update') {
				$uri_before = $ci->uri->segment($i - 1);
				$uri_after = $ci->uri->segment($i + 1);
				$uri = $uri_before . "/edit/" . $uri_after;
			}

			if ($uri == "create") {
				$label = "Tambah";
			}

			if ($uri == "change-password") {
				$label = "Ubah Password";
			}

			if ($uri == "user") {
				$label = "Pengguna";
			}

			if ($i == $totalSegment) {
				$class .= " active";
				$pageHeader .= "<li class='$class'>$label</li>";
			} else {
				$pageHeader .= "<li class='$class'><a href='" . base_url($uri) . "'>" . $label . "</a></li>";
			}
		}
	}

	$pageHeader .= "	</ol>
					</div>
				</div>
			</div>
		</div>";

	return $pageHeader;
}

function showUserLevel($index = NULL) {
	$userLevel = [
		'SUPER_USER' => 'ADMINISTRATOR',
		'DOSEN' => 'DOSEN',
		'KAPRODI' => 'KEPALA PROGRAM STUDI'
	];

	return ($index !== null) ? $userLevel[$index] : $userLevel;
}

function listJenjang() {
	return [
		'D1', 'D2', 'D3', 'D4',
		'S1', 'S2', 'S3'
	];

}
