<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
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
		$mahasiswa = $this->Mahasiswa->all();
		$data = [
			'mahasiswa' => $mahasiswa,
			'nomor' => 1
		];
		$this->main_lib->getTemplate("mahasiswa/index", $data);
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
				$this->main_lib->getTemplate('mahasiswa/form-create', $data);
			} else {
				//get user submit form data
				$postData = $this->getPostData();

				$insert = $this->Mahasiswa->insert($postData);

				if ($insert) {
					$nim = $this->input->post('nim');
					$namaLengkap = $this->input->post('nama_lengkap');

					$mahasiswaId = $this->Mahasiswa->getLastInsertId('id_mahasiswa');

					//user mahasiswa
					$userDosen = [
						'username' => $nim,
						'nama_lengkap' => strtoupper($namaLengkap),
						'password' => password_hash($nim, PASSWORD_DEFAULT),
						'level' => 'MAHASISWA',
						'id_dosen' => $mahasiswaId
					];

					//insert to user table
					$this->User->insert($userDosen);

					$messages = setArrayMessage('success', 'insert', 'mahasiswa');
				} else {
					$messages = setArrayMessage('error', 'insert', 'mahasiswa');
				}

				$this->session->set_flashdata('message', $messages);
				redirect(base_url('mahasiswa'), 'refresh');
			}
		} else {
			$this->main_lib->getTemplate("mahasiswa/form-create", $data);
		}
	}

	public function edit($id_mahasiswa)
	{
		$prodi = $this->ProgramStudi->all();
		$data = [
			'program_studi' => $prodi,
			'mahasiswa' => $this->Mahasiswa->findById(['mahasiswa.id_mahasiswa' => $id_mahasiswa]),
		];

		if (isset($_POST['update'])) {
			$rules = $this->_rules('update');
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

			if ($this->form_validation->run() === FALSE) {
				$this->main_lib->getTemplate('mahasiswa/form-update', $data);
			} else {
				$postData = $this->getPostData();

				$update = $this->Mahasiswa->update($postData, [
					'id_mahasiswa' => $id_mahasiswa
				]);

				if ($update) {
					$messages = setArrayMessage('success', 'update', 'mahasiswa');
				} else {
					$messages = setArrayMessage('error', 'update', 'mahasiswa');
				}

				$this->session->set_flashdata('message', $messages);
				redirect(base_url('mahasiswa'), 'refresh');
			}
		} else {
			$this->main_lib->getTemplate("mahasiswa/form-update", $data);
		}
	}

	public function delete($id_mahasiswa)
	{
		if (isset($_POST['_method']) && $_POST['_method'] == "DELETE") {
			$data_id = $this->main_lib->getPost('data_id');
			$data_type = $this->main_lib->getPost('data_type');

			if ($data_id === $id_mahasiswa && $data_type === 'mahasiswa') {
				$delete = $this->Mahasiswa->delete(['dosen.id_mahasiswa' => $data_id]);
				if ($delete) {
					$messages = setArrayMessage('success', 'delete', 'mahasiswa');
				} else {
					$messages = setArrayMessage('error', 'delete', 'mahasiswa');
				}

				$this->session->set_flashdata('message', $messages);
			} else {
				$messages = setArrayMessage('error', 'delete', 'mahasiswa');
				$this->session->set_flashdata('message', $messages);
			}
			redirect(base_url('mahasiswa'), 'refresh');
		} else {
			redirect('dashboard');
		}
	}

	public function detail($id_mahasiswa = null)
	{
		$mahasiswa = $this->Mahasiswa->findById(['dosen.id_mahasiswa' => $id_mahasiswa]);
		if(!$mahasiswa || $id_mahasiswa == '') {
			redirect(base_url('error'));
		}

		$jadwal = $this->Jadwal->findById([
			'id_mahasiswa' => $id_mahasiswa
		], true);

		$data = [
			'mahasiswa' => $mahasiswa,
			'jadwal' => $jadwal,
			'nomor' => 1,
		];

		$this->main_lib->getTemplate("mahasiswa/detail", $data);
	}

	private function getPostData()
	{
		return [
			'nim' => trim($this->main_lib->getPost('nim')),
			'nama_lengkap' => strtoupper($this->main_lib->getPost('nama_lengkap')),
			'jenis_kelamin' => $this->main_lib->getPost('jenis_kelamin'),
			'id_kelas' => $this->main_lib->getPost('id_kelas'),
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
				'field' => 'id_kelas',
				'label' => 'Kelas',
				'rules' => 'required'
			],
			[
				'field' => 'jenis_kelamin',
				'label' => 'Jenis kelamin',
				'rules' => 'required'
			],
		];

		if($type === 'create') {
			$rules[] = [
				'field' => 'nim',
				'label' => 'NIM',
				'rules' => 'required|is_unique[mahasiswa.nim]'
			];
		}

		return $rules;

	}

}

/* End of file Dosen.php */
