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
		$prodi = $this->ProgramStudi->all();
		$data = [
			'program_studi' => $prodi
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
					$nidn = $this->input->post('nidn');
					$namaLengkap = $this->input->post('nama_lengkap');

					$dosenId = $this->Dosen->getLastInsertId('id_dosen');

					//user dosen
					$userDosen = [
						'username' => $nidn,
						'nama_lengkap' => strtoupper($namaLengkap),
						'password' => password_hash($nidn, PASSWORD_DEFAULT),
						'level' => 'DOSEN',
						'id_dosen' => $dosenId
					];

					//insert to user table
					$this->User->insert($userDosen);

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
		$prodi = $this->ProgramStudi->all();
		$data = [
			'program_studi' => $prodi,
			'dosen' => $this->Dosen->findById(['dosen.id_dosen' => $id_dosen]),
		];

		if (isset($_POST['update'])) {
			$rules = $this->_rules('update');
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
				$delete = $this->Dosen->delete(['dosen.id_dosen' => $data_id]);
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

	public function detail($id_dosen = null)
	{
		$dosen = $this->Dosen->findById(['dosen.id_dosen' => $id_dosen]);
		if(!$dosen || $id_dosen == '') {
			redirect(base_url('error'));
		}

		$jadwal = $this->Jadwal->findById([
			'id_dosen' => $id_dosen
		], true);

		$data = [
			'dosen' => $dosen,
			'jadwal' => $jadwal,
			'nomor' => 1,
		];

		$this->main_lib->getTemplate("dosen/detail", $data);
	}

	private function getPostData()
	{
		return [
			'nidn' => trim($this->main_lib->getPost('nidn')),
			'nama_lengkap' => strtoupper($this->main_lib->getPost('nama_lengkap')),
			'jenis_kelamin' => $this->main_lib->getPost('jenis_kelamin'),
			'id_program_studi' => $this->main_lib->getPost('id_program_studi'),
			'gelar' => $this->main_lib->getPost('gelar'),
		];
	}

	private function _rules($type = 'create')
	{
		$rules = [
			[
				'field' => 'nama_lengkap',
				'label' => 'Nama lengkap',
				'rules' => 'required'
			],
			[
				'field' => 'gelar',
				'label' => 'Gelar',
				'rules' => 'required'
			],
			[
				'field' => 'id_program_studi',
				'label' => 'Program Studi',
				'rules' => 'required'
			],
		];

		if($type == 'create') {
			$rules[] = [
				'field' => 'nidn',
				'label' => 'NIDN',
				'rules' => 'required|is_unique[dosen.nidn]'
			];
		}

		return $rules;

	}

}

/* End of file Dosen.php */
