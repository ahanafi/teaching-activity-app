<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Nim4n\SimpleDate;

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if (!isAuthenticated()) {
			redirect('login');
		}
	}

	public function index()
	{
		if (getUser('level') === 'MAHASISWA') {
			$nim = getUser('username');
			$mahasiswa = $this->Mahasiswa->getBy('nim', $nim);

			$isDigitalSignatureExist = false;
			if($mahasiswa && $mahasiswa->paraf !== null && file_exists(FCPATH . $mahasiswa->paraf)) {
				$isDigitalSignatureExist = true;
			}

			$this->main_lib->getTemplate('dashboard/mahasiswa', [
				'exist_paraf' => $isDigitalSignatureExist,
				'total_dosen' => 0
			]);
		} else {
			$totalDosen = $this->Dosen->count();

			$arrLabelApps = [];
			$arrValueApps = [];
			$arrColorApps = [];

			//Grafik Penggunaan Aplikasi
			foreach (daringApps() as $appCode => $appName) {
				$arrLabelApps[] = $appName;
				$appCode = strtolower($appCode);
				$arrValueApps[] = $this->BeritaAcara->getCount('jenis_aplikasi LIKE', "%$appCode%");
				$arrColorApps[] = randomHexColor();
			}

			$materialLabel = [];
			$materialValue = [];
			$materialColors = [];

			//Grafik jenis file materi yang sering dipakai (diberikan kepada mhs)
			foreach (materialType() as $materialCode => $materialName) {
				$materialLabel[] = $materialName;
				$code = strtolower($materialCode);
				$materialValue[] = $this->BeritaAcara->getCount('bentuk_materi LIKE', "%$code%");
				$materialColors[] = randomHexColor();
			}

			//Grafik kesesuaian antara jadwal dan pelaksanaan perkuliahan
			/*
			 * Logic
			 * Jika hari-nya (dan jam kuliahnya) sama dengan hari yg di jadwal => Tepat (sesuai dengan jadwal)
			 * Jika tidak, maka tidak sesuai
			 *
			 *
			 * Data jadwal groupping by Dosen
			 * Nama Dosen
			 * 	- Nama MK - Kelas
			 * */

			$arrJadwalDosen = [];

			$dosenInJadwal = $this->Jadwal->customQuery("
				SELECT DISTINCT(jadwal.id_dosen), nama_lengkap, gelar FROM jadwal
				JOIN dosen USING (id_dosen)
				ORDER BY nama_lengkap ASC
			");

			$selectedJadwal = [];
			$index = 0;
			foreach ($dosenInJadwal as $dosen) {
				$dosenId = $dosen->id_dosen;
				if ($index === 0) {
					$selectedJadwal = $this->Jadwal->findById(['id_dosen' => $dosenId]);
				}

				$index++;

				$arrJadwalDosen[] = [
					'id_dosen' => $dosenId,
					'nama_dosen' => $dosen->nama_lengkap,
					'gelar' => $dosen->gelar,
					'jadwal' => $this->Jadwal->findById(['id_dosen' => $dosenId], true)
				];
			}

			$akurasiJadwalLabel = ['TEPAT', 'TIDAK TEPAT'];
			$tepat = 0;
			$tidakTepat = 0;

			//Get BAP
			$hariBySelectedJadwal = $selectedJadwal->hari;

			$beritaAcaraBySelectedJadwal = $this->BeritaAcara->findById(['id_jadwal' => $selectedJadwal->id_jadwal], true);

			foreach ($beritaAcaraBySelectedJadwal as $bap) {

				$tanggalRealisasi = $bap->tanggal_realisasi;

				$hari = SimpleDate::createFormat("dddd", $tanggalRealisasi);
				if (strtolower($hari) === strtolower($hariBySelectedJadwal)) {
					$tepat++;
				} else {
					$tidakTepat++;
				}
			}

			$akurasiJadwalValue = [$tepat, $tidakTepat];
			$akurasiJadwalColors = [randomHexColor(), randomHexColor()];

			$data = [
				'total_dosen' => $totalDosen,
				'app_label' => $arrLabelApps,
				'app_value' => $arrValueApps,
				'app_colors' => $arrColorApps,

				'material_label' => $materialLabel,
				'material_value' => $materialValue,
				'material_colors' => $materialColors,

				'jadwal' => $selectedJadwal,
				'jadwal_per_dosen' => $arrJadwalDosen,
				'akurasi_jadwal_label' => $akurasiJadwalLabel,
				'akurasi_jadwal_value' => $akurasiJadwalValue,
				'akurasi_jadwal_colors' => $akurasiJadwalColors
			];

			$this->main_lib->getTemplate('dashboard/main', $data);
		}
	}

	public function akurasi_jadwal($jadwalId)
	{
		if ($this->input->is_ajax_request()) {
			$jadwal = $this->Jadwal->findById(['id_jadwal' => $jadwalId]);

			//Rewrite
			$jadwal->dosen = namaDosen($jadwal->dosen, $jadwal->gelar);
			$jadwal->jadwal = ucfirst(strtolower($jadwal->hari)) . ", " . showJamKuliah($jadwal->jam_mulai, $jadwal->jam_selesai);

			$hariByJadwal = $jadwal->hari;
			$tepat = 0;
			$tidakTepat = 0;

			$beritaAcara = $this->BeritaAcara->findById(['id_jadwal' => $jadwalId], true);
			foreach ($beritaAcara as $bap) {

				$tanggalRealisasi = $bap->tanggal_realisasi;

				$hari = SimpleDate::createFormat("dddd", $tanggalRealisasi);
				if (strtolower($hari) === strtolower($hariByJadwal)) {
					$tepat++;
				} else {
					$tidakTepat++;
				}
			}

			$akurasiJadwalValue = [$tepat, $tidakTepat];
			$accurasiJadwalLabel = ['TEPAT', 'TIDAK TEPAT'];

			$response = [
				'status' => 'success',
				'jadwal' => $jadwal,
				'data' => $akurasiJadwalValue,
				'label' => $accurasiJadwalLabel,
				'colors' => [randomHexColor(), randomHexColor()],
			];
		} else {
			$response = [
				'status' => 'error',
				'message' => 'Unable to proccess the request.'

			];
		}

		echo json_encode($response);
	}

}

/* End of file Dashboard.php */
