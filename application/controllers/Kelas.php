<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
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
		$kelas = $this->Kelas->all();
		$data = [
			'kelas' => $kelas,
			'nomor' => 1
		];
		$this->main_lib->getTemplate("kelas/index", $data);
	}

	public function create()
	{
		$programStudi = $this->ProgramStudi->all();
		$data = [
			'program_studi' => $programStudi,
		];

		if (isset($_POST['submit'])) {
			$rules = $this->_rules('insert');
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

			if ($this->form_validation->run() === FALSE) {
				$this->main_lib->getTemplate('kelas/form-create', $data);
			} else {
				//get user submit form data
				$getPostData = $this->getPostData();

				$insert = $this->Kelas->insert($getPostData);
				if ($insert) {
					$messages = setArrayMessage('success', 'insert', 'kelas');
				} else {
					$messages = setArrayMessage('error', 'insert', 'kelas');
				}

				$this->session->set_flashdata('message', $messages);
				redirect(base_url('kelas'), 'refresh');
			}
		} else {
			$this->main_lib->getTemplate("kelas/form-create", $data);
		}
	}

	public function edit($id_kelas)
	{
		$programStudi = $this->ProgramStudi->all();
		$kelas = $this->Kelas->findById(['id_kelas' => $id_kelas]);

		$data = [
			'program_studi' => $programStudi,
			'kelas' => $kelas,
		];

		if (isset($_POST['update'])) {
			$rules = $this->_rules('update');
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

			if ($this->form_validation->run() === FALSE) {
				$this->main_lib->getTemplate('kelas/form-update', $data);
			} else {
				$getPostData = $this->getPostData();

				$update = $this->Kelas->update($getPostData, [
					'id_kelas' => $id_kelas
				]);

				if ($update) {
					$messages = setArrayMessage('success', 'update', 'kelas');
				} else {
					$messages = setArrayMessage('error', 'update', 'kelas');
				}

				$this->session->set_flashdata('message', $messages);
				redirect(base_url('kelas'), 'refresh');
			}
		} else {
			$this->main_lib->getTemplate("kelas/form-update", $data);
		}
	}

	public function delete($id_kelas)
	{
		if (isset($_POST['_method']) && $_POST['_method'] == "DELETE") {
			$data_id = $this->main_lib->getPost('data_id');
			$data_type = $this->main_lib->getPost('data_type');

			if ($data_id === $id_kelas && $data_type === 'kelas') {
				$delete = $this->Kelas->delete(['id_kelas' => $data_id]);
				if ($delete) {
					$messages = setArrayMessage('success', 'delete', 'kelas');
				} else {
					$messages = setArrayMessage('error', 'delete', 'kelas');
				}

				$this->session->set_flashdata('message', $messages);
			} else {
				$messages = setArrayMessage('error', 'delete', 'kelas');
				$this->session->set_flashdata('message', $messages);
			}
			redirect(base_url('kelas'), 'refresh');
		} else {
			redirect('dashboard');
		}
	}

	private function getPostData()
	{
		return [
			'nama_kelas' => $this->main_lib->getPost('nama_kelas'),
			'id_program_studi' => $this->main_lib->getPost('id_program_studi'),
			'semester' => $this->main_lib->getPost('semester'),
		];
	}

	private function _rules($type)
	{
		if ($type == "insert") {
			//Rule when create new user
			$rules = [
				[
					'field' => 'nama_kelas',
					'label' => 'Nama kelas',
					'rules' => 'required'
				],
				[
					'field' => 'id_program_studi',
					'label' => 'Program studi',
					'rules' => 'required'
				],
				[
					'field' => 'semester',
					'label' => 'Semester',
					'rules' => 'required'
				],
			];

		} else if ($type == "update") {
			//Rule when update user
			$rules = [
				[
					'field' => 'nama_kelas',
					'label' => 'Nama program studi',
					'rules' => 'required'
				],
				[
					'field' => 'id_program_studi',
					'label' => 'Fakultas',
					'rules' => 'required'
				],
				[
					'field' => 'semester',
					'label' => 'Semester',
					'rules' => 'required'
				],
			];
		}

		return $rules;
	}

}

/* End of file Kelas.php */
