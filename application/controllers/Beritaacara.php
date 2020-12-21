<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beritaacara extends CI_Controller
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
		$beritaAcara = $this->BeritaAcara->all();

		$currentUserLevel = getUser('level');

		if($currentUserLevel === "DOSEN") {
			$id_dosen = getUser('id_dosen');
			$beritaAcara = $this->BeritaAcara->findById([
				'id_jadwal' => $id_dosen
			], true);
		}

		$data = [
			'berita_acara' => $beritaAcara,
			'nomor' => 1
		];
		$this->main_lib->getTemplate("berita-acara/index", $data);
	}

	public function create()
	{
		$data = [];

		if (isset($_POST['submit'])) {
			$rules = $this->_rules('insert');
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

			if ($this->form_validation->run() === FALSE) {
				$this->main_lib->getTemplate('berita-acara/form-create', $data);
			} else {
				//get user submit form data
				$getPostData = $this->getPostData();

				$insert = $this->BeritaAcara->insert($getPostData);
				if ($insert) {
					$messages = setArrayMessage('success', 'insert', 'berita acara');
				} else {
					$messages = setArrayMessage('error', 'insert', 'berita acara');
				}

				$this->session->set_flashdata('message', $messages);
				redirect(base_url('berita-acara'), 'refresh');
			}
		} else {
			$this->main_lib->getTemplate("berita-acara/form-create", $data);
		}
	}

	public function edit($id_mata_kuliah)
	{
		$data = [
			'berita_acara' => $this->BeritaAcara->findById(['id_mata_kuliah' => $id_mata_kuliah]),
		];

		if (isset($_POST['update'])) {
			$rules = $this->_rules('update');
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

			if ($this->form_validation->run() === FALSE) {
				$this->main_lib->getTemplate('berita-acara/form-update', $data);
			} else {
				$getPostData = $this->getPostData();

				$update = $this->BeritaAcara->update($getPostData, [
					'id_mata_kuliah' => $id_mata_kuliah
				]);

				if ($update) {
					$messages = setArrayMessage('success', 'update', 'berita acara');
				} else {
					$messages = setArrayMessage('error', 'update', 'berita acara');
				}

				$this->session->set_flashdata('message', $messages);
				redirect(base_url('berita-acara'), 'refresh');
			}
		} else {
			$this->main_lib->getTemplate("berita-acara/form-update", $data);
		}
	}

	public function delete($id_mata_kuliah)
	{
		if (isset($_POST['_method']) && $_POST['_method'] == "DELETE") {
			$data_id = $this->main_lib->getPost('data_id');
			$data_type = $this->main_lib->getPost('data_type');

			if ($data_id === $id_mata_kuliah && $data_type === 'berita-acara') {
				$delete = $this->BeritaAcara->delete(['id_mata_kuliah' => $data_id]);
				if ($delete) {
					$messages = setArrayMessage('success', 'delete', 'berita acara');
				} else {
					$messages = setArrayMessage('error', 'delete', 'berita acara');
				}

				$this->session->set_flashdata('message', $messages);
			} else {
				$messages = setArrayMessage('error', 'delete', 'berita acara');
				$this->session->set_flashdata('message', $messages);
			}
			redirect(base_url('berita-acara'), 'refresh');
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
					'label' => 'Kode berita acara',
					'rules' => 'required|is_unique[mata_kuliah.kode_mata_kuliah]'
				],
				[
					'field' => 'nama_mata_kuliah',
					'label' => 'Nama berita acara',
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
					'label' => 'Kode berita acara',
					'rules' => 'required'
				],
				[
					'field' => 'nama_mata_kuliah',
					'label' => 'Nama berita acara',
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

/* End of file Beritaacara.php */
