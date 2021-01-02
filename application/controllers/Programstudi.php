<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Programstudi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if(!isAuthenticated()) {
			redirect('login');
		}
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
		$jenjang = listJenjang();
		$data = [
			'fakultas' => $fakultas,
			'jenjang' => $jenjang
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
		$programStudi = $this->ProgramStudi->findById(['id_program_studi' => $id_program_studi]);

		$data = [
			'prodi' => $programStudi,
			'fakultas' => $fakultas,
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
					'id_program_studi' => $id_program_studi
				]);

				if ($update) {
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
				$delete = $this->ProgramStudi->delete(['id_program_studi' => $data_id]);
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

		if ($type == "insert" || $type == 'create') {
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

}

/* End of file Programstudi.php */
