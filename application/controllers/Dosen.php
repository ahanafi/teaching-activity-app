<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen extends CI_Controller
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
		$dosen = $this->Dosen->all();
		$data = [
			'dosen' => $dosen,
			'nomor' => 1
		];
		$this->main_lib->getTemplate("dosen/index", $data);
	}

	public function create()
	{
		$data = [
		];

		if (isset($_POST['submit'])) {
			$rules = $this->_rules();
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

			if ($this->form_validation->run() === FALSE) {
				$this->main_lib->getTemplate('dosen/form-create', $data);
			} else {
				//get user submit form data
				$postData = $this->getPostData();

				$insert = $this->Dosen->insert($postData);
				if ($insert) {
					$messages = setArrayMessage('success', 'insert', 'dosen');
				} else {
					$messages = setArrayMessage('error', 'insert', 'dosen');
				}

				$this->session->set_flashdata('message', $messages);
				redirect(base_url('dosen'), 'refresh');
			}
		} else {
			$this->main_lib->getTemplate("dosen/form-create", $data);
		}
	}

	public function edit($id_dosen)
	{
		$data = [
			'dosen' => $this->Dosen->findById(['id_dosen' => $id_dosen]),
		];

		if (isset($_POST['update'])) {
			$rules = $this->_rules();
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

			if ($this->form_validation->run() === FALSE) {
				$this->main_lib->getTemplate('dosen/form-update', $data);
			} else {
				$postData = $this->getPostData();

				$update = $this->Dosen->update($postData, [
					'id_dosen' => $id_dosen
				]);

				if ($update) {
					$messages = setArrayMessage('success', 'update', 'dosen');
				} else {
					$messages = setArrayMessage('error', 'update', 'dosen');
				}

				$this->session->set_flashdata('message', $messages);
				redirect(base_url('dosen'), 'refresh');
			}
		} else {
			$this->main_lib->getTemplate("dosen/form-update", $data);
		}
	}

	public function delete($id_dosen)
	{
		if (isset($_POST['_method']) && $_POST['_method'] == "DELETE") {
			$data_id = $this->main_lib->getPost('data_id');
			$data_type = $this->main_lib->getPost('data_type');

			if ($data_id === $id_dosen && $data_type === 'dosen') {
				$delete = $this->Dosen->delete(['id_dosen' => $data_id]);
				if ($delete) {
					$messages = setArrayMessage('success', 'delete', 'dosen');
				} else {
					$messages = setArrayMessage('error', 'delete', 'dosen');
				}

				$this->session->set_flashdata('message', $messages);
			} else {
				$messages = setArrayMessage('error', 'delete', 'dosen');
				$this->session->set_flashdata('message', $messages);
			}
			redirect(base_url('dosen'), 'refresh');
		} else {
			redirect('dashboard');
		}
	}

	private function getPostData()
	{
		return [
			'nidn' => $this->main_lib->getPost('nidn'),
			'nama_lengkap' => $this->main_lib->getPost('nama_lengkap'),
			'jenis_kelamin' => $this->main_lib->getPost('jenis_kelamin'),
			'tempat_lahir' => $this->main_lib->getPost('tempat_lahir'),
			'tanggal_lahir' => $this->main_lib->getPost('tanggal_lahir'),
			'alamat' => $this->main_lib->getPost('alamat'),
		];
	}

	private function _rules()
	{
		return [
			[
				'field' => 'nidn',
				'label' => 'NIDN',
				'rules' => 'required'
			],
			[
				'field' => 'nama_lengkap',
				'label' => 'Nama lengkap',
				'rules' => 'required'
			],
			[
				'field' => 'tempat_lahir',
				'label' => 'Tempat lahir',
				'rules' => 'required'
			],
			[
				'field' => 'tanggal_lahir',
				'label' => 'Tanggal lahir',
				'rules' => 'required'
			],
		];

	}

}

/* End of file Dosen.php */
