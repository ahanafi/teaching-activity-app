<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
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
	}

	public function index()
	{
		$dosen = $this->Dosen->all();
		$programStudi = $this->ProgramStudi->all();
		$hari = listHari();

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
		$temuKuliah =  $this->main_lib->getPost('pertemuan');

		$filter = $this->_doFilter($hari, $dosenId, $programStudiId, $temuKuliah);

		$beritaAcara = $this->BeritaAcara->all();
		if ($filter != '') {
			$beritaAcara = $this->BeritaAcara->getByFilter($filter);
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

		return $data;
	}

	private function _doFilter($hari, $dosenId, $programStudiId, $temu): array
	{
		$arrFilter = [];

		/*
		 * One filter category
		 *  */
		//Filter only days
		if ($hari != 'all_days' && $dosenId == 'all_dosen' && $programStudiId == 'all_prodi' && $temu == 'all') {
			$arrFilter = ['hari' => $hari];
		}

		//Filter only dosen Id
		if ($hari == 'all_days' && $dosenId != 'all_dosen' && $programStudiId == 'all_prodi' && $temu == 'all') {
			$arrFilter = ['id_dosen' => $dosenId];
		}

		//Filter only program studi Id
		if ($hari == 'all_days' && $dosenId == 'all_dosen' && $programStudiId != 'all_prodi'  && $temu == 'all') {
			$arrFilter = ['dosen.id_program_studi' => $programStudiId];
		}

		//Filter only pertemuan
		if ($hari == 'all_days' && $dosenId == 'all_dosen' && $programStudiId == 'all_prodi'  && $temu != 'all') {
			$arrFilter = ['pertemuan_ke' => $temu];
		}

		/*
		 * Second filter category
		 *  */
		//Filter days and dosen id
		if ($hari != 'all_days' && $dosenId != 'all_dosen' && $programStudiId == 'all_prodi' && $temu == 'all') {
			$arrFilter = [
				'hari' => $hari,
				'id_dosen' => $dosenId
			];
		}

		//Filter days and program studi id
		if ($hari != 'all_days' && $dosenId == 'all_dosen' && $programStudiId != 'all_prodi' && $temu == 'all') {
			$arrFilter = [
				'hari' => $hari,
				'dosen.id_program_studi' => $programStudiId
			];
		}

		//Filter days and temu kuliah
		if ($hari != 'all_days' && $dosenId == 'all_dosen' && $programStudiId == 'all_prodi' && $temu != 'all') {
			$arrFilter = [
				'hari' => $hari,
				'pertemuan_ke' => $temu
			];
		}

		//Filter dosen and program studi id
		if ($hari == 'all_days' && $dosenId != 'all_dosen' && $programStudiId != 'all_prodi' && $temu == 'all') {
			$arrFilter = [
				'id_dosen' => $dosenId,
				'dosen.id_program_studi' => $programStudiId
			];
		}

		//Filter dosen and temu
		if ($hari == 'all_days' && $dosenId != 'all_dosen' && $programStudiId == 'all_prodi' && $temu != 'all') {
			$arrFilter = [
				'id_dosen' => $dosenId,
				'pertemuan_ke' => $temu
			];
		}

		//Filter program studi and temu
		if ($hari == 'all_days' && $dosenId == 'all_dosen' && $programStudiId != 'all_prodi' && $temu != 'all') {
			$arrFilter = [
				'dosen.id_program_studi' => $programStudiId,
				'pertemuan_ke' => $temu,
			];
		}

		/*
		 * Three filter category
		 *  */
		//Filter days, dosen and program studi id
		if ($hari != 'all_days' && $dosenId != 'all_dosen' && $programStudiId != 'all_prodi' && $temu == 'all') {
			$arrFilter = [
				'hari' => $hari,
				'id_dosen' => $dosenId,
				'dosen.id_program_studi' => $programStudiId
			];
		}

		//Filter days, dosen and temu kuliah
		if ($hari != 'all_days' && $dosenId != 'all_dosen' && $programStudiId == 'all_prodi' && $temu != 'all') {
			$arrFilter = [
				'hari' => $hari,
				'id_dosen' => $dosenId,
				'pertemuan_ke' => $temu
			];
		}

		//Filter days, prodi and temu kuliah
		if ($hari != 'all_days' && $dosenId == 'all_dosen' && $programStudiId != 'all_prodi' && $temu != 'all') {
			$arrFilter = [
				'hari' => $hari,
				'dosen.program_studi' => $programStudiId,
				'pertemuan_ke' => $temu
			];
		}

		//Filter days, prodi and temu kuliah
		if ($hari == 'all_days' && $dosenId != 'all_dosen' && $programStudiId != 'all_prodi' && $temu != 'all') {
			$arrFilter = [
				'id_dosen' => $dosenId,
				'dosen.program_studi' => $programStudiId,
				'pertemuan_ke' => $temu
			];
		}

		/*
		 * Four categories
		 * */
		//Filter all
		if ($hari != 'all_days' && $dosenId != 'all_dosen' && $programStudiId != 'all_prodi') {
			$arrFilter = [
				'hari' => $hari,
				'id_dosen' => $dosenId,
				'dosen.id_program_studi' => $programStudiId
			];
		}

		return $arrFilter;
	}

	public function berita_acara($exportType = 'excel')
	{
		if (isset($_POST['export'])) {
			$data = $this->_grabData();
			if ($exportType == 'excel') {
				$this->exportExcel($data);
			} elseif ($exportType == 'pdf') {
				$this->exportPDF($data);
			}
		}
	}

	private function exportExcel($data)
	{
		$spreadsheet = new Spreadsheet();
		$dateTime = date('Y_m_d_H_i_s');
		$filename = "Rekap-BAP-" . $dateTime;
		$sheet = $spreadsheet->getActiveSheet();

		/* Header */
		//Merge cells
		try {
			$sheet->mergeCells('B2:T2');
			$sheet->mergeCells('B3:T3');
			$sheet->mergeCells('U2:V5');
		} catch (Exception $e) {
		}

		$sheet->setCellValue('B2', "REKAP KEGIATAN PERKULIAHAN DARING");
		$sheet->setCellValue('B3', "PROGRAM STUDI MANAJEMEN BISNIS - GANJIL 2020-2021");
		$sheet->setCellValue('B4', "TANGGAL 30 Nov - 5 Des 2020");

		$firstHeader = [
			'No', 'Hari', 'Nama Dosen', 'Mata Kuliah', 'SKS', 'Waktu', 'SMT', 'Temu Ke', 'Jml Mhs', 'Jml Mhs Hadir',
		];

		$i = 0;
		foreach (range('B', 'K') as $col) {
			try {
				$sheet->mergeCells($col . "6:" . $col . "7");
			} catch (Exception $e) {
			}
			$sheet->setCellValue($col . "6", strtoupper($firstHeader[$i]));
			$i++;
		}

		try {
			$sheet->mergeCells("L6:O6");
			$sheet->mergeCells("P6:T6");
			$sheet->mergeCells("U6:V6");
			$sheet->mergeCells("W6:W7");
		} catch (Exception $e) {
		}

		$sheet->setCellValue("L6", "APLIKASI");
		$sheet->setCellValue("P6", "MATERI");
		$sheet->setCellValue("U6", "BUKTI KEHADIRAN");
		$sheet->setCellValue("W6", "KETERANGAN");

		$sheet->setCellValue("L7", "Edmodo");
		$sheet->setCellValue("M7", "ZOOM");
		$sheet->setCellValue("N7", "YOUTUBE");
		$sheet->setCellValue("O7", "WAG");

		$sheet->setCellValue("P7", "DOC");
		$sheet->setCellValue("Q7", "PPT");
		$sheet->setCellValue("R7", "PDF");
		$sheet->setCellValue("S7", "VIDEO");
		$sheet->setCellValue("T7", "LAINNYA");

		$sheet->setCellValue("U7", "SCREENSHOOT");
		$sheet->setCellValue("V7", "TUGAS");

		//Styling font
		$sheet->getStyle('B2:B4')->getFont()
			->setSize('16')
			->setBold(true)
			->setName('Arial');
		$sheet->getStyle('B6:W6')->getFont()
			->setSize('10')
			->setBold(true)
			->setName('Arial');
		$sheet->getStyle('L7:V7')->getFont()
			->setSize('10')
			->setBold(true)
			->setName('Arial');

		//Alignment
		$sheet->getStyle('B2:B3')
			->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle('B2:B3')
			->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

		$sheet->getStyle('B6:W6')
			->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle('B6:W6')
			->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

		//DATA
		$nomor = 1;
		$cellIndex = 8;

		$beritaAcara = $data['berita_acara'];
		foreach ($beritaAcara as $bap) {
			$namaDosen = namaDosen($bap->dosen, $bap->gelar);
			$jamKuliah = showJamKuliah($bap->jam_mulai, $bap->jam_selesai);
			$penugasan = ($bap->ada_tugas == 1) ? "V" : "";

			$edmodo = (in_array("EDMODO", explode(",", strtoupper($bap->jenis_aplikasi)))) ? "V" : "-";
			$zoom = (in_array("ZOOM", explode(",", strtoupper($bap->jenis_aplikasi)))) ? "V" : "-";
			$youtube = (in_array("YOUTUBE", explode(",", strtoupper($bap->jenis_aplikasi)))) ? "V" : "-";
			$waGroup = (in_array("WA_GROUP", explode(",", strtoupper($bap->jenis_aplikasi)))) ? "V" : "-";
			$doc = (in_array("DOC", explode(",", strtoupper($bap->jenis_aplikasi)))) ? "V" : "-";
			$ppt = (in_array("PPT", explode(",", strtoupper($bap->jenis_aplikasi)))) ? "V" : "-";
			$pdf = (in_array("PDF", explode(",", strtoupper($bap->jenis_aplikasi)))) ? "V" : "-";
			$video = (in_array("VIDEO", explode(",", strtoupper($bap->jenis_aplikasi)))) ? "V" : "-";
			$lainnya = (in_array("LAINNYA", explode(",", strtoupper($bap->jenis_aplikasi)))) ? "V" : "-";

			$sheet->setCellValue('B' . $cellIndex, $nomor);
			$sheet->setCellValue('C' . $cellIndex, $bap->hari);

			$sheet->setCellValue('D' . $cellIndex, $namaDosen);

			$sheet->setCellValue('E' . $cellIndex, $bap->mata_kuliah);
			$sheet->setCellValue('F' . $cellIndex, $bap->sks);
			$sheet->setCellValue('G' . $cellIndex, $jamKuliah);
			$sheet->setCellValue('H' . $cellIndex, $bap->semester);
			$sheet->setCellValue('I' . $cellIndex, $bap->pertemuan_ke);
			$sheet->setCellValue('J' . $cellIndex, $bap->total_mahasiswa);
			$sheet->setCellValue('K' . $cellIndex, $bap->jumlah_hadir);

			//App used
			$sheet->setCellValue('L' . $cellIndex, $edmodo);
			$sheet->setCellValue('M' . $cellIndex, $zoom);
			$sheet->setCellValue('N' . $cellIndex, $youtube);
			$sheet->setCellValue('O' . $cellIndex, $waGroup);

			//Material type
			$sheet->setCellValue('P' . $cellIndex, $doc);
			$sheet->setCellValue('Q' . $cellIndex, $ppt);
			$sheet->setCellValue('R' . $cellIndex, $pdf);
			$sheet->setCellValue('S' . $cellIndex, $video);
			$sheet->setCellValue('T' . $cellIndex, $lainnya);

			$sheet->setCellValue('U' . $cellIndex, $bap->ada_bukti);
			$sheet->setCellValue('V' . $cellIndex, $penugasan);
			$sheet->setCellValue('W' . $cellIndex, $bap->tanggal_realisasi);

			$nomor++;
			$cellIndex++;
		}

		$sheet->getColumnDimension("D")->setAutoSize(true);
		$sheet->getColumnDimension("E")->setAutoSize(true);
		$sheet->getColumnDimension("G")->setAutoSize(true);
		$sheet->getColumnDimension("U")->setAutoSize(true);
		$sheet->getColumnDimension("W")->setAutoSize(true);

		$writer = new Xlsx($spreadsheet);
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT+7");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		//ubah nama file saat diunduh
		header("Content-Disposition: attachment;filename=" . $filename . ".xlsx");
		//unduh file
		$writer->save('php://output');
	}

	private function exportPDF($data)
	{

	}
}


/* End of file Laporan.php */
