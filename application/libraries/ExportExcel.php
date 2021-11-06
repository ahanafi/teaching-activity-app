<?php

use Nim4n\SimpleDate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

defined('BASEPATH') or exit('No direct script access allowed');

class ExportExcel
{
	private $spreadSheet = null;
	private $activeSheet = null;
	private $indexCell = 8;

	public $programStudi = null;
	public $date = null;
	public $tahunAjar = null;

	public function setSpreadsheet($spredsheet)
	{
		$this->spreadSheet = $spredsheet;
		$this->activeSheet = $this->spreadSheet->getActiveSheet();
	}

	public function setProgramStudi($prodi)
	{
		$this->programStudi = strtoupper($prodi);
	}

	public function setDate($date)
	{
		$this->date = $date;
	}

	public function setTahunAjar($tahun)
	{
		$this->tahunAjar = $tahun;
	}

	private function getTitle()
	{
		try {
			$this->activeSheet->mergeCells('B2:T2');
			$this->activeSheet->mergeCells('B3:T3');
			$this->activeSheet->mergeCells('U2:V5');
		} catch (Exception $e) {
		}

		$this->activeSheet->setCellValue('B2', "REKAP KEGIATAN PERKULIAHAN DARING");
		$namaProgramStudi = $this->programStudi !== 'SEMUA' ? "PROGRAM STUDI $this->programStudi" : 'SEMUA PROGRAM STUDI';
		$this->activeSheet->setCellValue('B3', "$namaProgramStudi  - $this->tahunAjar");
		if($this->date !== null) {
			$this->activeSheet->setCellValue('B4', "TANGGAL " . $this->date);

		}
	}

	private function firstHeaderSection()
	{
		$firstHeader = [
			'No', 'Hari', 'Nama Dosen', 'Mata Kuliah', 'SKS', 'Waktu', 'SMT', 'Temu Ke', 'Jml Mhs', 'Jml Mhs Hadir',
		];

		$i = 0;
		foreach (range('B', 'K') as $col) {
			try {
				$this->activeSheet->mergeCells($col . "6:" . $col . "7");
			} catch (Exception $e) {
			}
			$this->activeSheet->setCellValue($col . "6", strtoupper($firstHeader[$i]));
			$i++;
		}

		try {
			$this->activeSheet->mergeCells("L6:O6");
			$this->activeSheet->mergeCells("P6:T6");
			$this->activeSheet->mergeCells("U6:V6");
			$this->activeSheet->mergeCells("W6:Y6");
		} catch (Exception $e) {
		}

		$this->activeSheet->setCellValue("L6", "APLIKASI");
		$this->activeSheet->setCellValue("P6", "MATERI");
		$this->activeSheet->setCellValue("U6", "BUKTI KEHADIRAN");
		$this->activeSheet->setCellValue("W6", "PELAKSANAAN");
	}

	private function secondHeaderSection()
	{
		$this->activeSheet->setCellValue("L6", "APLIKASI");
		$this->activeSheet->setCellValue("P6", "MATERI");
		$this->activeSheet->setCellValue("U6", "BUKTI KEHADIRAN");
		$this->activeSheet->setCellValue("W6", "PELAKSANAAN");

		$headerText = [
			"Edmodo", "ZOOM", "YOUTUBE", "WAG", "DOC", "PPT", "PDF", "VIDEO",
			"LAINNYA", "SCREENSHOOT", "TUGAS", "HARI", "TANGGAL", "JAM"
		];

		$index = 0;
		foreach (range('L', 'Y') as $col) {
			$this->activeSheet->setCellValue($col . '7', $headerText[$index]);
			$index++;
		}
	}

	private function styledAlignment()
	{
		$this->activeSheet->getStyle('B2:B3')
			->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		$this->activeSheet->getStyle('B2:B3')
			->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

		$this->activeSheet->getStyle('B6:W6')
			->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		$this->activeSheet->getStyle('B6:W6')
			->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
	}

	private function styledFont()
	{
		$this->activeSheet->getStyle('B2:B4')->getFont()
			->setSize('16')
			->setBold(true)
			->setName('Arial');
		$this->activeSheet->getStyle('B6:Y6')->getFont()
			->setSize('10')
			->setBold(true)
			->setName('Arial');
		$this->activeSheet->getStyle('L7:V7')->getFont()
			->setSize('10')
			->setBold(true)
			->setName('Arial');
	}

	private function columnWidth()
	{
		$this->activeSheet->getColumnDimension("A")->setWidth(2);
		$this->activeSheet->getColumnDimension("B")->setWidth(5);
		$this->activeSheet->getColumnDimension("D")->setAutoSize(true);
		$this->activeSheet->getColumnDimension("E")->setAutoSize(true);
		$this->activeSheet->getColumnDimension("G")->setAutoSize(true);
		$this->activeSheet->getColumnDimension("U")->setAutoSize(true);
		$this->activeSheet->getColumnDimension("W")->setAutoSize(true);
	}

	private function styledBorder($index)
	{
		try {
			$this->activeSheet->getStyle('B6:Y' . $index)->getBorders()
				->getAllBorders()
				->setBorderStyle(Border::BORDER_THIN);
		} catch (Exception $e) {
		}

		//Alignment
		$this->activeSheet->getStyle('F6:W' . $index)
			->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		$this->activeSheet->getStyle('F6:W' . $index)
			->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
	}

	public function export($fileName, $data = array())
	{
		$this->getTitle();
		$this->firstHeaderSection();
		$this->secondHeaderSection();
		$this->styledAlignment();
		$this->styledFont();
		$this->columnWidth();

		$this->populateData($data);

		$this->styledBorder($this->indexCell);

		$writer = new Xlsx($this->spreadSheet);
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT+7");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		//ubah nama file saat diunduh
		header("Content-Disposition: attachment;filename=" . $fileName . ".xlsx");
		//unduh file
		$writer->save('php://output');
	}

	private function populateData(array $data)
	{
		$nomor = 1;
		foreach ($data as $bap) {
			$namaHari = ucfirst(strtolower($bap->hari));
			$namaDosen = namaDosen($bap->nama_dosen, $bap->gelar);
			$jamKuliah = showJamKuliah($bap->jam_mulai, $bap->jam_selesai);
			$penugasan = ($bap->ada_tugas === 1) ? "V" : "";

			$edmodo = isExistItem("EDMODO", $bap->jenis_aplikasi);
			$zoom = isExistItem("ZOOM", $bap->jenis_aplikasi);
			$youtube = isExistItem("YOUTUBE", $bap->jenis_aplikasi);
			$waGroup = isExistItem("WA_GROUP", $bap->jenis_aplikasi);
			$doc = isExistItem("DOC", $bap->jenis_aplikasi);
			$ppt = isExistItem("PPT", $bap->jenis_aplikasi);
			$pdf = isExistItem("PDF", $bap->jenis_aplikasi);
			$video = isExistItem("VIDEO", $bap->jenis_aplikasi);
			$lainnya = isExistItem("LAINNYA", $bap->jenis_aplikasi);

			$this->activeSheet->setCellValue('B' . $this->indexCell, $nomor);
			$this->activeSheet->setCellValue('C' . $this->indexCell, $namaHari);

			$this->activeSheet->setCellValue('D' . $this->indexCell, $namaDosen);

			$this->activeSheet->setCellValue('E' . $this->indexCell, $bap->nama_mata_kuliah);
			$this->activeSheet->setCellValue('F' . $this->indexCell, $bap->sks);
			$this->activeSheet->setCellValue('G' . $this->indexCell, $jamKuliah);
			$this->activeSheet->setCellValue('H' . $this->indexCell, $bap->kelas);
			$this->activeSheet->setCellValue('I' . $this->indexCell, $bap->pertemuan_ke);
			$this->activeSheet->setCellValue('J' . $this->indexCell, $bap->total_mahasiswa);
			$this->activeSheet->setCellValue('K' . $this->indexCell, $bap->jumlah_hadir);

			//App used
			$this->activeSheet->setCellValue('L' . $this->indexCell, $edmodo);
			$this->activeSheet->setCellValue('M' . $this->indexCell, $zoom);
			$this->activeSheet->setCellValue('N' . $this->indexCell, $youtube);
			$this->activeSheet->setCellValue('O' . $this->indexCell, $waGroup);

			//Material type
			$this->activeSheet->setCellValue('P' . $this->indexCell, $doc);
			$this->activeSheet->setCellValue('Q' . $this->indexCell, $ppt);
			$this->activeSheet->setCellValue('R' . $this->indexCell, $pdf);
			$this->activeSheet->setCellValue('S' . $this->indexCell, $video);
			$this->activeSheet->setCellValue('T' . $this->indexCell, $lainnya);

			$this->activeSheet->setCellValue('U' . $this->indexCell, $bap->ada_bukti);
			$this->activeSheet->setCellValue('V' . $this->indexCell, $penugasan);

			$hariPelaksanaan = SimpleDate::createFormat("dddd", $bap->tanggal_realisasi);
			$jamPelaksanaan = showJamKuliah($bap->jam_mulai_pelaksanaan, $bap->jam_selesai_pelaksanaan);

			$this->activeSheet->setCellValue('W' . $this->indexCell, $hariPelaksanaan);
			$this->activeSheet->setCellValue('X' . $this->indexCell, $bap->tanggal_realisasi);
			$this->activeSheet->setCellValue('Y' . $this->indexCell, $jamPelaksanaan);

			$nomor++;
			$this->indexCell++;
		}
	}

}
