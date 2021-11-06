<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Nim4n\SimpleDate;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class Laporan extends CI_Controller
{
	private $data = [];

	public function __construct()
	{
		parent::__construct();

		if (!isAuthenticated()) {
			redirect('login');
		}
		provideAccessTo("SUPER_USER|KAPRODI");
		$this->load->library('ExportExcel');
	}

	public function index()
	{
		$dosen = $this->Dosen->all();
		$programStudi = $this->ProgramStudi->all();
		$hari = listHari();

		$userLevel = getUser('level');
		if ($userLevel === 'KAPRODI') {
			$programStudiId = getUser('id_program_studi');
			$dosen = [];

			//Get Id Dosen from jadwal
			$selectedIdDosen = $this->Jadwal->getByIdProgramStudi($programStudiId, true);
			$selectedIdDosen = str_replace(["(", ")"], "", $selectedIdDosen);
			$arrSelectedIdDosen = explode(",", $selectedIdDosen);
			foreach ($arrSelectedIdDosen as $dosenId) {
				$dosen[] = $this->Dosen->findById(['dosen.id_dosen' => $dosenId]);
			}
		}

		$this->data = [
			'dosen' => $dosen,
			'program_studi' => $programStudi,
			'list_hari' => $hari
		];

		if (isset($_POST['submit'])) {
			$this->data = $this->_grabData();
		}

		$this->main_lib->getTemplate("laporan/form-laporan", $this->data);
	}

	private function _grabData()
	{
		$data = $this->data;

		$hari = $this->main_lib->getPost('hari');
		$dosenId = $this->main_lib->getPost('id_dosen');
		$programStudiId = $this->main_lib->getPost('id_program_studi');
		$temuKuliah = $this->main_lib->getPost('pertemuan');

		$filter = $this->_doFilter($hari, $dosenId, $programStudiId, $temuKuliah);

		$beritaAcara = $this->BeritaAcara->all();

		if ($filter !== null) {
			$beritaAcara = $this->BeritaAcara
				->setWherePosition('jadwal')
				->getByFilter($filter);
		}

		$arrBeritaAcara = [];
		foreach ($beritaAcara as $bap) {
			$beritaAcaraId = $bap->id_berita_acara;

			$buktiKegiatan = $this->BuktiKegiatan->findById([
				'id_berita_acara' => $beritaAcaraId
			]);
			$bap->ada_bukti = ($buktiKegiatan) ? "V" : "";
			$arrBeritaAcara[] = $bap;
		}

		//Assign to the data
		$data['berita_acara'] = $arrBeritaAcara;
		$data['nomor'] = 1;
		$data['selected_hari'] = $hari;
		$data['id_dosen'] = $dosenId;
		$data['id_program_studi'] = $programStudiId;
		$data['temu_kuliah'] = $temuKuliah;

		$data['selected_program_studi'] = $this->ProgramStudi->findById(['program_studi.id_program_studi' => $programStudiId]);
		$data['tanggal'] = date('d-m-Y');
		$data['tahun_akademik'] = $this->TahunAkademik->first();

		return $data;
	}

	private function _doFilter($hari, $dosenId, $programStudiId, $temu)
	{
		$arrFilter = [];

		/*
		 * One filter category
		 *  */
		//Filter only days
		if ($hari !== 'all_days' && $dosenId === 'all_dosen' && $programStudiId === 'all_prodi' && $temu === 'all') {
			$arrFilter = ['hari' => $hari];
		}

		//Filter only dosen Id
		if ($hari === 'all_days' && $dosenId !== 'all_dosen' && $programStudiId === 'all_prodi' && $temu === 'all') {
			$arrFilter = ['id_dosen' => $dosenId];
		}

		//Filter only program studi Id
		if ($hari === 'all_days' && $dosenId === 'all_dosen' && $programStudiId !== 'all_prodi' && $temu === 'all') {
			$arrFilter = ['dosen.id_program_studi' => $programStudiId];
		}

		//Filter only pertemuan
		if ($hari === 'all_days' && $dosenId === 'all_dosen' && $programStudiId === 'all_prodi' && $temu !== 'all') {
			$arrFilter = ['pertemuan_ke' => $temu];
		}

		/*
		 * Second filter category
		 *  */
		//Filter days and dosen id
		if ($hari !== 'all_days' && $dosenId !== 'all_dosen' && $programStudiId === 'all_prodi' && $temu === 'all') {
			$arrFilter = [
				'hari' => $hari,
				'id_dosen' => $dosenId
			];
		}

		//Filter days and program studi id
		if ($hari !== 'all_days' && $dosenId === 'all_dosen' && $programStudiId !== 'all_prodi' && $temu === 'all') {
			$arrFilter = [
				'hari' => $hari,
				'dosen.id_program_studi' => $programStudiId
			];
		}

		//Filter days and temu kuliah
		if ($hari !== 'all_days' && $dosenId === 'all_dosen' && $programStudiId === 'all_prodi' && $temu !== 'all') {
			$arrFilter = [
				'hari' => $hari,
				'pertemuan_ke' => $temu
			];
		}

		//Filter dosen and program studi id
		if ($hari === 'all_days' && $dosenId !== 'all_dosen' && $programStudiId !== 'all_prodi' && $temu === 'all') {
			$arrFilter = [
				'id_dosen' => $dosenId,
				'dosen.id_program_studi' => $programStudiId
			];
		}

		//Filter dosen and temu
		if ($hari === 'all_days' && $dosenId !== 'all_dosen' && $programStudiId === 'all_prodi' && $temu !== 'all') {
			$arrFilter = [
				'id_dosen' => $dosenId,
				'pertemuan_ke' => $temu
			];
		}

		//Filter program studi and temu
		if ($hari === 'all_days' && $dosenId === 'all_dosen' && $programStudiId !== 'all_prodi' && $temu !== 'all') {
			$arrFilter = [
				'dosen.id_program_studi' => $programStudiId,
				'pertemuan_ke' => $temu,
			];
		}

		/*
		 * Three filter category
		 *  */
		//Filter days, dosen and program studi id
		if ($hari !== 'all_days' && $dosenId !== 'all_dosen' && $programStudiId !== 'all_prodi' && $temu === 'all') {
			$arrFilter = [
				'hari' => $hari,
				'id_dosen' => $dosenId,
				'dosen.id_program_studi' => $programStudiId
			];
		}

		//Filter days, dosen and temu kuliah
		if ($hari !== 'all_days' && $dosenId !== 'all_dosen' && $programStudiId === 'all_prodi' && $temu !== 'all') {
			$arrFilter = [
				'hari' => $hari,
				'id_dosen' => $dosenId,
				'pertemuan_ke' => $temu
			];
		}

		//Filter days, prodi and temu kuliah
		if ($hari !== 'all_days' && $dosenId === 'all_dosen' && $programStudiId !== 'all_prodi' && $temu !== 'all') {
			$arrFilter = [
				'hari' => $hari,
				'dosen.id_program_studi' => $programStudiId,
				'pertemuan_ke' => $temu
			];
		}

		//Filter days, prodi and temu kuliah
		if ($hari === 'all_days' && $dosenId !== 'all_dosen' && $programStudiId !== 'all_prodi' && $temu !== 'all') {
			$arrFilter = [
				'id_dosen' => $dosenId,
				'dosen.id_program_studi' => $programStudiId,
				'pertemuan_ke' => $temu
			];
		}

		/*
		 * Four categories
		 * */
		//Filter all
		if ($hari !== 'all_days' && $dosenId !== 'all_dosen' && $programStudiId !== 'all_prodi' && $temu !== 'all') {
			$arrFilter = [
				'hari' => $hari,
				'id_dosen' => $dosenId,
				'dosen.id_program_studi' => $programStudiId,
				'pertemuan_ke' => $temu
			];
		}

		return $arrFilter;
	}

	public function berita_acara($exportType = 'excel')
	{
		if (isset($_POST['export'])) {
			$data = $this->_grabData();

			if ($exportType === 'excel') {
				$this->exportExcel($data);
			} elseif ($exportType === 'pdf') {
				$this->exportPDF($data);
			}
		}
	}

	private function exportExcel($data)
	{
		$spreadsheet = new Spreadsheet();
		$this->exportexcel->setSpreadsheet($spreadsheet);
		$data['program_studi'] = $data['selected_program_studi'];
		unset($data['selected_program_studi']);

		$namaProgramStudi = $data['program_studi'] !== null ? $data['program_studi']->nama_program_studi : 'Semua';
		$this->exportexcel->setProgramStudi($namaProgramStudi);

		$tahunAkademik = $data['tahun_akademik']->semester_akademik . ' ' . $data['tahun_akademik']->tahun;
		$this->exportexcel->setTahunAjar($tahunAkademik);
		$this->exportexcel->setDate($data['tanggal']);

		$dateTime = date('Y_m_d_H_i_s');
		$filename = "Rekap-BAP-" . $dateTime;

		$this->exportexcel->export($filename, $data['berita_acara']);
	}

	private function exportPDF($data)
	{

	}
}


/* End of file Laporan.php */
