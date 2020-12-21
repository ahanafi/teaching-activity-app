<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
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
		$jadwal = $this->Jadwal->all();
		$currentUserLevel = getUser('level');
		if($currentUserLevel === "DOSEN") {
			$id_dosen = getUser('id_dosen');
			$jadwal = $this->Jadwal->findById([
				'id_dosen' => $id_dosen
			], true);
		}


		$data = [
			'jadwal' => $jadwal,
			'nomor' => 1
		];
		$this->main_lib->getTemplate("jadwal/index", $data);
	}

	public function create()
	{
		$mataKuliah = $this->MataKuliah->all();
		$dosen = $this->Dosen->all();
		$hari = listHari();
		$ruangKelas = $this->Ruangan->all();
		$kelas = $this->Kelas->all();

		$data = [
			'mata_kuliah' => $mataKuliah,
			'dosen' => $dosen,
			'hari' => $hari,
			'ruangan' => $ruangKelas,
			'kelas' => $kelas
		];

		if (isset($_POST['submit'])) {
			$rules = $this->_rules();
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

			if ($this->form_validation->run() === FALSE) {
				$this->main_lib->getTemplate('jadwal/form-create', $data);
			} else {
				//get user submit form data
				$postData = $this->getPostData();

				$insert = $this->Jadwal->insert($postData);
				if ($insert) {
					$messages = setArrayMessage('success', 'insert', 'jadwal kuliah');
				} else {
					$messages = setArrayMessage('error', 'insert', 'jadwal kuliah');
				}

				$this->session->set_flashdata('message', $messages);
				redirect(base_url('jadwal'), 'refresh');
			}
		} else {
			$this->main_lib->getTemplate("jadwal/form-create", $data);
		}
	}

	public function edit($id_jadwal)
	{
		$mataKuliah = $this->MataKuliah->all();
		$dosen = $this->Dosen->all();
		$hari = listHari();
		$ruangKelas = $this->Ruangan->all();
		$kelas = $this->Kelas->all();
		$jadwal = $this->Jadwal->findById(['id_jadwal' => $id_jadwal]);

		$data = [
			'mata_kuliah' => $mataKuliah,
			'dosen' => $dosen,
			'hari' => $hari,
			'ruangan' => $ruangKelas,
			'kelas' => $kelas,
			'jadwal' => $jadwal
		];

		if (isset($_POST['update'])) {
			$rules = $this->_rules();
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

			if ($this->form_validation->run() === FALSE) {
				$this->main_lib->getTemplate('jadwal/form-update', $data);
			} else {
				$postData = $this->getPostData();

				$update = $this->Jadwal->update($postData, [
					'id_jadwal' => $id_jadwal
				]);

				if ($update) {
					$messages = setArrayMessage('success', 'update', 'jadwal kuliah');
				} else {
					$messages = setArrayMessage('error', 'update', 'jadwal kuliah');
				}

				$this->session->set_flashdata('message', $messages);
				redirect(base_url('jadwal'), 'refresh');
			}
		} else {
			$this->main_lib->getTemplate("jadwal/form-update", $data);
		}
	}

	public function delete($id_jadwal)
	{
		if (isset($_POST['_method']) && $_POST['_method'] == "DELETE") {
			$data_id = $this->main_lib->getPost('data_id');
			$data_type = $this->main_lib->getPost('data_type');

			if ($data_id === $id_jadwal && $data_type === 'jadwal') {
				$delete = $this->Jadwal->delete(['id_jadwal' => $data_id]);
				if ($delete) {
					$messages = setArrayMessage('success', 'delete', 'jadwal kuliah');
				} else {
					$messages = setArrayMessage('error', 'delete', 'jadwal kuliah');
				}

				$this->session->set_flashdata('message', $messages);
			} else {
				$messages = setArrayMessage('error', 'delete', 'jadwal kuliah');
				$this->session->set_flashdata('message', $messages);
			}
			redirect(base_url('jadwal'), 'refresh');
		} else {
			redirect('dashboard');
		}
	}

	private function getPostData()
	{
		return [
			'hari' => $this->main_lib->getPost('hari'),
			'jam_mulai' => $this->main_lib->getPost('jam_mulai'),
			'jam_selesai' => $this->main_lib->getPost('jam_selesai'),
			'id_kelas' => $this->main_lib->getPost('kelas'),
			'id_mata_kuliah' => $this->main_lib->getPost('mata_kuliah'),
			'id_dosen' => $this->main_lib->getPost('dosen'),
			'id_ruangan' => $this->main_lib->getPost('ruangan'),
		];
	}

	private function _rules()
	{
		return [
			[
				'field' => 'hari',
				'label' => 'Hari',
				'rules' => 'required'
			],
			[
				'field' => 'jam_mulai',
				'label' => 'Jam mulai',
				'rules' => 'required'
			],
			[
				'field' => 'jam_selesai',
				'label' => 'Jam selesai',
				'rules' => 'required'
			],
			[
				'field' => 'kelas',
				'label' => 'Kelas',
				'rules' => 'required'
			],
			[
				'field' => 'mata_kuliah',
				'label' => 'Mata kuliah',
				'rules' => 'required'
			],
			[
				'field' => 'dosen',
				'label' => 'Dosen',
				'rules' => 'required'
			],
			[
				'field' => 'ruangan',
				'label' => 'Ruang kelas',
				'rules' => 'required'
			],
		];

	}

}

/* End of file Jadwal.php */
