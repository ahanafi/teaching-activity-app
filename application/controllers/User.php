<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
		provideAccessTo('SUPER_USER');
		$users = $this->User->all();
		$data = [
			'users' => $users,
			'nomor' => 1
		];
		$this->main_lib->getTemplate("user/index", $data);
	}

	public function create()
	{
		provideAccessTo('SUPER_USER');
		$data = [
			'user_level' => showUserLevel()
		];

		if (isset($_POST['submit'])) {
			$rules = $this->_rules('insert');
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

			if ($this->form_validation->run() === FALSE) {
				$this->main_lib->getTemplate('user/form-create', $data);
			} else {
				//get user submit form data
				$userPostData = $this->getPostUserData();

				//encrypt submitted password
				$encryptPassword = password_hash($this->main_lib->getPost('password'), PASSWORD_DEFAULT);

				//assign to user data
				$userPostData['password'] = $encryptPassword;

				$insert = $this->User->insert($userPostData);
				if ($insert) {
					$messages = setArrayMessage('success', 'insert', 'pengguna');
				} else {
					$messages = setArrayMessage('error', 'insert', 'pengguna');
				}

				$this->session->set_flashdata('message', $messages);
				redirect(base_url('user'), 'refresh');
			}
		} else {
			$this->main_lib->getTemplate("user/form-create", $data);
		}
	}

	public function edit($id_pengguna)
	{
		$data = [
			'user' => $this->User->findById(['id_pengguna' => $id_pengguna]),
			'user_level' => showUserLevel()
		];

		if (isset($_POST['update'])) {
			$rules = $this->_rules('update');
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

			if ($this->form_validation->run() === FALSE) {
				$this->main_lib->getTemplate('user/form-update', $data);
			} else {
				$userPostData = $this->getPostUserData();

				$update = $this->User->update($userPostData, [
					'id_pengguna' => $id_pengguna
				]);

				if ($update) {
					$messages = setArrayMessage('success', 'update', 'pengguna');
				} else {
					$messages = setArrayMessage('error', 'update', 'pengguna');
				}

				$this->session->set_flashdata('message', $messages);
				redirect(base_url('user'), 'refresh');
			}
		} else {
			$this->main_lib->getTemplate("user/form-update", $data);
		}
	}

	public function delete($id_pengguna)
	{
		provideAccessTo('SUPER_USER');
		if (isset($_POST['_method']) && $_POST['_method'] == "DELETE") {
			$data_id = $this->main_lib->getPost('data_id');
			$data_type = $this->main_lib->getPost('data_type');

			if ($data_id === $id_pengguna && $data_type === 'user') {
				$delete = $this->User->delete(['id_pengguna' => $data_id]);
				if ($delete) {
					$messages = setArrayMessage('success', 'delete', 'pengguna');
				} else {
					$messages = setArrayMessage('error', 'delete', 'pengguna');
				}

				$this->session->set_flashdata('message', $messages);
			} else {
				$messages = setArrayMessage('error', 'delete', 'pengguna');
				$this->session->set_flashdata('message', $messages);
			}
			redirect(base_url('user'), 'refresh');
		} else {
			redirect('dashboard');
		}
	}

	private function getPostUserData()
	{
		return [
			'nama_lengkap' => $this->main_lib->getPost('nama_lengkap'),
			'username' => $this->main_lib->getPost('username'),
			'level' => $this->main_lib->getPost('level'),
		];
	}

	private function _rules($type)
	{
		if ($type === "insert") {
			//Rule when create new user
			$rules = [
				[
					'field' => 'nama_lengkap',
					'label' => 'Nama Lengkap',
					'rules' => 'required|alpha_numeric_spaces'
				],
				[
					'field' => 'username',
					'label' => 'Username',
					'rules' => 'required|is_unique[pengguna.username]|min_length[6]|max_length[30]'
				],
				[
					'field' => 'password',
					'label' => 'password',
					'rules' => 'required|min_length[6]'
				],
				[
					'field' => 'konfirmasi_password',
					'label' => 'Konfirmasi password',
					'rules' => 'required|matches[password]|trim'
				],
				[
					'field' => 'level',
					'label' => 'level',
					'rules' => 'required|trim'
				],
			];

		} else if ($type === "update") {
			//Rule when update user
			$rules = [
				[
					'field' => 'nama_lengkap',
					'label' => 'Nama Lengkap',
					'rules' => 'required|alpha_numeric_spaces'
				],
				[
					'field' => 'username',
					'label' => 'Username',
					'rules' => 'required|min_length[6]|max_length[30]'
				],
				[
					'field' => 'email',
					'label' => 'email',
					'rules' => 'required|valid_email'
				],
				[
					'field' => 'level',
					'label' => 'level',
					'rules' => 'required|trim'
				],
			];
		} else if ($type === "password") {
			//Rule when update password user
			$rules = [
				[
					'field' => 'old_password',
					'label' => 'Password lama',
					'rules' => 'required|min_length[6]|validate_old_password'
				],
				[
					'field' => 'new_password',
					'label' => 'Password baru',
					'rules' => 'required|min_length[6]'
				],
				[
					'field' => 'konfirmasi_password',
					'label' => 'Konfirmasi password',
					'rules' => 'required|matches[new_password]|trim'
				]
			];
		}

		return $rules;
	}

	public function profile()
	{
		$userId = getUser('id_pengguna');
		$user = $this->User->findById(['id_pengguna' => $userId]);
		if (!$user) {
			redirect(base_url('error'));
		}
		$data['user'] = $user;
		$this->main_lib->getTemplate("user/profile", $data);
	}

	public function change_password()
	{
		$id_pengguna = getUser('id_pengguna');

		if (isset($_POST['update-password'])) {
			$rules = $this->_rules('password');
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

			if ($this->form_validation->run() === FALSE) {
				$this->main_lib->getTemplate("user/form-password");
			} else {

				$newPassword = $this->main_lib->getPost('new_password');
				$encryptPassword = password_hash($newPassword, PASSWORD_DEFAULT);

				$update = $this->User->update([
					'password' => $encryptPassword
				], [
					'id_pengguna' => $id_pengguna
				]);

				if ($update) {
					$messages = [
						'type' => 'success',
						'text' => 'Password berhasil diubah.'
					];
				} else {
					$messages = [
						'type' => 'error',
						'text' => 'Password gagal diubah.'
					];
				}

				$this->session->set_flashdata('message', $messages);
				redirect('user/profile', 'refresh');
			}
		} else {
			$this->main_lib->getTemplate("user/form-password");
		}
	}

	public function validate_old_password()
	{
		$password = $this->main_lib->getPost('old_password');
		$userId = getUser('id_pengguna');
		$user = $this->User->findById(['id_pengguna' => $userId]);
		$userHashedPassword = $user->password;

		$validate = password_verify($password, $userHashedPassword);
		if ($validate) {
			return true;
		} else {
			$this->form_validation->set_message('validate_old_password', 'Password lama yang Anda masukan salah!');
			return false;
		}
	}

	public function upload_signature()
	{
		if (isset($_POST['upload'])) {
			$this->form_validation->set_rules('signature', 'Tanda tangan', 'required');
			$config = [
				'upload_path' => './uploads/signature/',
				'allowed_types' => 'jpeg|jpg|png',
				'max_size' => '1024',
				'max_width' => '512',
				'max_height' => '512',
				'file_ext_tolower' => TRUE,
				'encrypt_name' => TRUE
			];

			$this->load->library('upload');
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('signature')) {
				$error = $this->upload->display_errors('', '');

				$this->main_lib->getTemplate("signature/form", ['error' => $error]);

			} else {
				$uploadData = $this->upload->data();
				$fileName = 'uploads/signature/' . $uploadData['file_name'];

				$updateSignature = null;

				if (getUser('level') === 'MAHASISWA') {
					$nim = getUser('username');
					$mahasiswa = $this->Mahasiswa->getBy('nim', $nim);

					if ($mahasiswa && $mahasiswa->paraf !== null) {
						if (file_exists(FCPATH . $mahasiswa->paraf)) {
							unlink(FCPATH . $mahasiswa->paraf);
						}
					}

					$updateSignature = $this->Mahasiswa->update(['paraf' => $fileName], ['id_mahasiswa' => $mahasiswa->id_mahasiswa]);
				}

				if (getUser('level') === 'KAPRODI' || getUser('level') === 'DOSEN') {
					$nidn = getUser('username');
					$dosen = $this->Dosen->getBy('nidn', $nidn);

					if ($dosen && $dosen->paraf !== null) {
						if (file_exists(FCPATH . $dosen->paraf)) {
							unlink(FCPATH . $dosen->paraf);
						}
					}

					$updateSignature = $this->Dosen->update(['paraf' => $fileName], ['id_dosen' => $dosen->id_dosen]);
				}

				if ($updateSignature) {
					$messages = [
						'type' => 'success',
						'text' => 'Tanda tangan digital Anda berhasil disimpan.',
					];
				} else {
					$messages = [
						'type' => 'error',
						'text' => 'Gagal menyimpan tanda tangan digital.'
					];
				}

				$this->session->set_flashdata('message', $messages);
				redirect(base_url('user/upload-signature'));
			}

		} else {
			$this->main_lib->getTemplate("signature/form");
		}
	}
}

/* End of file User.php */
