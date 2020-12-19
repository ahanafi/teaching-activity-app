<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fakultas extends CI_Controller
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
		$fakultas = $this->Fakultas->all();
		$data = [
			'fakultas' => $fakultas,
			'nomor' => 1
		];
		$this->main_lib->getTemplate("fakultas/index", $data);
	}

	public function create()
	{
		$data = [];

		if (isset($_POST['submit'])) {
			$rules = $this->_rules('insert');
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

			if ($this->form_validation->run() === FALSE) {
				$this->main_lib->getTemplate('fakultas/form-create', $data);
			} else {
				//get user submit form data
				$getPostData = $this->getPostData();

				$insert = $this->Fakultas->insert($getPostData);
				if ($insert) {
					$messages = setArrayMessage('success', 'insert', 'fakultas');
				} else {
					$messages = setArrayMessage('error', 'insert', 'fakultas');
				}

				$this->session->set_flashdata('message', $messages);
				redirect(base_url('fakultas'), 'refresh');
			}
		} else {
			$this->main_lib->getTemplate("fakultas/form-create", $data);
		}
	}

	public function edit($id_fakultas)
	{
		$data = [
			'fakultas' => $this->Fakultas->findById(['id_fakultas' => $id_fakultas]),
		];

		if (isset($_POST['update'])) {
			$rules = $this->_rules('update');
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

			if ($this->form_validation->run() === FALSE) {
				$this->main_lib->getTemplate('fakultas/form-update', $data);
			} else {
				$getPostData = $this->getPostData();

				$update = $this->Fakultas->update($getPostData, [
					'id_fakultas' => $id_fakultas
				]);

				if ($update) {
					$messages = setArrayMessage('success', 'update', 'fakultas');
				} else {
					$messages = setArrayMessage('error', 'update', 'fakultas');
				}

				$this->session->set_flashdata('message', $messages);
				redirect(base_url('fakultas'), 'refresh');
			}
		} else {
			$this->main_lib->getTemplate("fakultas/form-update", $data);
		}
	}

	public function delete($id_fakultas)
	{
		if (isset($_POST['_method']) && $_POST['_method'] == "DELETE") {
			$data_id = $this->main_lib->getPost('data_id');
			$data_type = $this->main_lib->getPost('data_type');

			if ($data_id === $id_fakultas && $data_type === 'fakultas') {
				$delete = $this->Fakultas->delete(['id_fakultas' => $data_id]);
				if ($delete) {
					$messages = setArrayMessage('success', 'delete', 'fakultas');
				} else {
					$messages = setArrayMessage('error', 'delete', 'fakultas');
				}

				$this->session->set_flashdata('message', $messages);
			} else {
				$messages = setArrayMessage('error', 'delete', 'fakultas');
				$this->session->set_flashdata('message', $messages);
			}
			redirect(base_url('fakultas'), 'refresh');
		} else {
			redirect('dashboard');
		}
	}

	private function getPostData()
	{
		return [
			'kode_fakultas' => $this->main_lib->getPost('kode_fakultas'),
			'nama_fakultas' => $this->main_lib->getPost('nama_fakultas'),
		];
	}

	private function _rules($type)
	{
		if ($type == "insert") {
			//Rule when create new user
			$rules = [
				[
					'field' => 'kode_fakultas',
					'label' => 'Kode fakultas',
					'rules' => 'required|is_unique[fakultas.kode_fakultas]'
				],
				[
					'field' => 'nama_fakultas',
					'label' => 'Nama fakultas',
					'rules' => 'required'
				],
			];

		} else if ($type == "update") {
			//Rule when update user
			$rules = [
				[
					'field' => 'kode_fakultas',
					'label' => 'Kode fakultas',
					'rules' => 'required'
				],
				[
					'field' => 'nama_fakultas',
					'label' => 'Nama fakultas',
					'rules' => 'required'
				],
			];
		}

		return $rules;
	}

}

/* End of file Fakultas.php */
