<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Matakuliah extends CI_Controller
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
		$mataKuliah = $this->MataKuliah->all();
		$data = [
			'mata_kuliah' => $mataKuliah,
			'nomor' => 1
		];
		$this->main_lib->getTemplate("mata-kuliah/index", $data);
	}

	public function create()
	{
		$data = [];

		if (isset($_POST['submit'])) {
			$rules = $this->_rules('insert');
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

			if ($this->form_validation->run() === FALSE) {
				$this->main_lib->getTemplate('mata-kuliah/form-create', $data);
			} else {
				//get user submit form data
				$getPostData = $this->getPostData();

				$insert = $this->MataKuliah->insert($getPostData);
				if ($insert) {
					$messages = setArrayMessage('success', 'insert', 'mata kuliah');
				} else {
					$messages = setArrayMessage('error', 'insert', 'mata kuliah');
				}

				$this->session->set_flashdata('message', $messages);
				redirect(base_url('mata-kuliah'), 'refresh');
			}
		} else {
			$this->main_lib->getTemplate("mata-kuliah/form-create", $data);
		}
	}

	public function edit($id_mata_kuliah)
	{
		$data = [
			'mata_kuliah' => $this->MataKuliah->findById(['id_mata_kuliah' => $id_mata_kuliah]),
		];

		if (isset($_POST['update'])) {
			$rules = $this->_rules('update');
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

			if ($this->form_validation->run() === FALSE) {
				$this->main_lib->getTemplate('mata-kuliah/form-update', $data);
			} else {
				$getPostData = $this->getPostData();

				$update = $this->MataKuliah->update($getPostData, [
					'id_mata_kuliah' => $id_mata_kuliah
				]);

				if ($update) {
					$messages = setArrayMessage('success', 'update', 'mata kuliah');
				} else {
					$messages = setArrayMessage('error', 'update', 'mata kuliah');
				}

				$this->session->set_flashdata('message', $messages);
				redirect(base_url('mata-kuliah'), 'refresh');
			}
		} else {
			$this->main_lib->getTemplate("mata-kuliah/form-update", $data);
		}
	}

	public function delete($id_mata_kuliah)
	{
		if (isset($_POST['_method']) && $_POST['_method'] == "DELETE") {
			$data_id = $this->main_lib->getPost('data_id');
			$data_type = $this->main_lib->getPost('data_type');

			if ($data_id === $id_mata_kuliah && $data_type === 'mata-kuliah') {
				$delete = $this->MataKuliah->delete(['id_mata_kuliah' => $data_id]);
				if ($delete) {
					$messages = setArrayMessage('success', 'delete', 'mata kuliah');
				} else {
					$messages = setArrayMessage('error', 'delete', 'mata kuliah');
				}

				$this->session->set_flashdata('message', $messages);
			} else {
				$messages = setArrayMessage('error', 'delete', 'mata kuliah');
				$this->session->set_flashdata('message', $messages);
			}
			redirect(base_url('mata-kuliah'), 'refresh');
		} else {
			redirect('dashboard');
		}
	}

	private function getPostData()
	{
		return [
			'kode_mata_kuliah' => $this->main_lib->getPost('kode_mata_kuliah'),
			'nama_mata_kuliah' => $this->main_lib->getPost('nama_mata_kuliah'),
			'sks' => $this->main_lib->getPost('sks'),
		];
	}

	private function _rules($type)
	{
		if ($type == "insert") {
			//Rule when create new user
			$rules = [
				[
					'field' => 'kode_mata_kuliah',
					'label' => 'Kode mata kuliah',
					'rules' => 'required|is_unique[mata_kuliah.kode_mata_kuliah]'
				],
				[
					'field' => 'nama_mata_kuliah',
					'label' => 'Nama mata kuliah',
					'rules' => 'required'
				],
				[
					'field' => 'sks',
					'label' => 'Jumlah SKS',
					'rules' => 'required'
				],
			];

		} else if ($type == "update") {
			//Rule when update user
			$rules = [
				[
					'field' => 'kode_mata_kuliah',
					'label' => 'Kode mata kuliah',
					'rules' => 'required'
				],
				[
					'field' => 'nama_mata_kuliah',
					'label' => 'Nama mata kuliah',
					'rules' => 'required'
				],
				[
					'field' => 'sks',
					'label' => 'Jumlah SKS',
					'rules' => 'required'
				],
			];
		}

		return $rules;
	}

}

/* End of file Matakuliah.php */
