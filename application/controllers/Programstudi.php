<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Programstudi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if (!isAuthenticated()) {
			redirect('login');
		}
		provideAccessTo('SUPER_USER');
	}

	public function index()
	{
		$programStudi = $this->ProgramStudi->all();
		$data = [
			'program_studi' => $programStudi,
			'nomor' => 1
		];
		$this->main_lib->getTemplate("program-studi/index", $data);
	}

	public function create()
	{
		$fakultas = $this->Fakultas->all();
		$dosen = $this->Dosen->all();
		$jenjang = listJenjang();
		$data = [
			'fakultas' => $fakultas,
			'jenjang' => $jenjang,
			'dosen' => $dosen
		];

		if (isset($_POST['submit'])) {
			$rules = $this->_rules('insert');
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

			if ($this->form_validation->run() === FALSE) {
				$this->main_lib->getTemplate('program-studi/form-create', $data);
			} else {
				//get user submit form data
				$getPostData = $this->getPostData();

				$insert = $this->ProgramStudi->insert($getPostData);
				if ($insert) {
					$dosenId = $this->main_lib->getPost('id_dosen');

					if (!empty(trim($dosenId))) {

						//Update user level as Kaprodi
						$this->User->update(['level' => 'KAPRODI'], [
							'id_dosen' => $dosenId
						]);
					}

					$messages = setArrayMessage('success', 'insert', 'program studi');
				} else {
					$messages = setArrayMessage('error', 'insert', 'program studi');
				}

				$this->session->set_flashdata('message', $messages);
				redirect(base_url('program-studi'), 'refresh');
			}
		} else {
			$this->main_lib->getTemplate("program-studi/form-create", $data);
		}
	}

	public function edit($id_program_studi)
	{
		$fakultas = $this->Fakultas->all();
		$jenjang = listJenjang();
		$programStudi = $this->ProgramStudi->findById(['program_studi.id_program_studi' => $id_program_studi]);
		$dosen = $this->Dosen->all();

		$data = [
			'prodi' => $programStudi,
			'fakultas' => $fakultas,
			'dosen' => $dosen,
			'jenjang' => $jenjang
		];

		if (isset($_POST['update'])) {
			$rules = $this->_rules('update');
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

			if ($this->form_validation->run() === FALSE) {
				$this->main_lib->getTemplate('program-studi/form-update', $data);
			} else {
				$getPostData = $this->getPostData();

				$update = $this->ProgramStudi->update($getPostData, [
					'program_studi.id_program_studi' => $id_program_studi
				]);

				if ($update) {
					$dosenId = $this->main_lib->getPost('id_dosen');

					if (!empty(trim($dosenId))) {

						//Update user level as Kaprodi
						$this->User->update(['level' => 'KAPRODI'], [
							'id_dosen' => $dosenId
						]);
					}

					$messages = setArrayMessage('success', 'update', 'program studi');
				} else {
					$messages = setArrayMessage('error', 'update', 'program studi');
				}

				$this->session->set_flashdata('message', $messages);
				redirect(base_url('program-studi'), 'refresh');
			}
		} else {
			$this->main_lib->getTemplate("program-studi/form-update", $data);
		}
	}

	public function delete($id_program_studi)
	{
		if (isset($_POST['_method']) && $_POST['_method'] == "DELETE") {
			$data_id = $this->main_lib->getPost('data_id');
			$data_type = $this->main_lib->getPost('data_type');

			if ($data_id === $id_program_studi && $data_type === 'program-studi') {
				$delete = $this->ProgramStudi->delete(['program_studi.id_program_studi' => $data_id]);
				if ($delete) {
					$messages = setArrayMessage('success', 'delete', 'program studi');
				} else {
					$messages = setArrayMessage('error', 'delete', 'program studi');
				}

				$this->session->set_flashdata('message', $messages);
			} else {
				$messages = setArrayMessage('error', 'delete', 'program studi');
				$this->session->set_flashdata('message', $messages);
			}
			redirect(base_url('program-studi'), 'refresh');
		} else {
			redirect('dashboard');
		}
	}

	private function getPostData()
	{
		return [
			'kode_program_studi' => $this->main_lib->getPost('kode_program_studi'),
			'nama_program_studi' => $this->main_lib->getPost('nama_program_studi'),
			'id_fakultas' => $this->main_lib->getPost('id_fakultas'),
			'jenjang' => $this->main_lib->getPost('jenjang'),
			'id_dosen' => $this->main_lib->getPost('id_dosen')
		];
	}

	private function _rules($type)
	{
		$rules = [
			[
				'field' => 'nama_program_studi',
				'label' => 'Nama program studi',
				'rules' => 'required'
			],
			[
				'field' => 'id_fakultas',
				'label' => 'Fakultas',
				'rules' => 'required'
			],
			[
				'field' => 'jenjang',
				'label' => 'Jenjang',
				'rules' => 'required'
			],
		];

		if ($type === "insert" || $type === 'create') {
			//Rule when create new user
			$rules[] = [
				[
					'field' => 'kode_program_studi',
					'label' => 'Kode Program Studi',
					'rules' => 'required|is_unique[program_studi.kode_program_studi]'
				]
			];

		}

		return $rules;
	}

	public function export()
	{
		$spreadsheet = new Spreadsheet();
		$dateTime = date('Y_m_d_H_i_s');
		$filename = "Data_Program_Studi_exported_at_" . $dateTime;
		$sheet = $spreadsheet->getActiveSheet();

		/* Header */
		//Merge cells
		try {
			$sheet->mergeCells('B2:G2');
			$sheet->mergeCells('B3:G3');
			$sheet->mergeCells('B5:G5');
		} catch (Exception $e) {
		}

		$sheet->setCellValue('B2', "UNIVERSITAS CATUR INSAN CENDEKIA");
		$sheet->setCellValue('B3', "Jl. Kesambi No. 12 Kesambi Kota Cirebon");
		$sheet->setCellValue('B5', "Data Program Studi");

		$firstHeader = ['No', 'Kode', 'Nama Program Studi', 'Jenjang', 'Fakultas', 'Kaprodi'];

		$i = 0;
		foreach (range('B', 'G') as $col) {
			$sheet->setCellValue($col . "7", strtoupper($firstHeader[$i]));
			$i++;
		}

		//Styling font
		$sheet->getStyle('B2:B4')->getFont()
			->setSize('16')
			->setBold(true)
			->setName('Arial');

		//Alignment
		$sheet->getStyle('B2:B5')
			->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle('B2:B5')
			->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

		//DATA
		$nomor = 1;
		$cellIndex = 8;

		$programStudi = $this->ProgramStudi->all();

		foreach ($programStudi as $prodi) {
			$kaprodi = "";
			if($prodi->id_dosen !== null) {
				$kaprodi = namaDosen($prodi->kaprodi, $prodi->gelar);
			}

			$sheet->setCellValue('B' . $cellIndex, $nomor);
			$sheet->setCellValue('C' . $cellIndex, $prodi->kode_program_studi);
			$sheet->setCellValue('D' . $cellIndex, $prodi->nama_program_studi);
			$sheet->setCellValue('E' . $cellIndex, $prodi->jenjang);
			$sheet->setCellValue('F' . $cellIndex, $prodi->kode_fakultas);
			$sheet->setCellValue('G' . $cellIndex, $kaprodi);

			$nomor++;
			$cellIndex++;
		}

		$sheet->getColumnDimension("A")->setWidth(2);
		$sheet->getColumnDimension("B")->setWidth(5);
		$sheet->getColumnDimension("D")->setAutoSize(true);
		$sheet->getColumnDimension("E")->setAutoSize(true);
		$sheet->getColumnDimension("G")->setAutoSize(true);

		$lastIndex = $cellIndex - 1;
		//Border
		try {
			$sheet->getStyle('B7:G' . $lastIndex)->getBorders()
				->getAllBorders()
				->setBorderStyle(Border::BORDER_THIN);
		} catch (Exception $e) {
		}

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
}

/* End of file Programstudi.php */
