<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends Main_model
{

	protected $table = "pengguna";

	public function login($credentials)
	{
		$sql = $this->db->where([
			'username' => $credentials['username']
		])->get($this->table);

		$check = $sql->num_rows();

		if ($check > 0) {
			$user = $sql->row();
			$validate = password_verify($credentials['password'], $user->password);

			if ($validate) {
				if ($user->level === 'KAPRODI' || $user->level === 'DOSEN') {
					$dosenId = $user->id_dosen;
					$dosen = $this->db->query("SELECT * FROM dosen WHERE id_dosen = '$dosenId' ")->row();
					$user->id_program_studi = $dosen->id_program_studi;
					$user->paraf = $dosen->paraf;
				}

				if($user->level === 'MAHASISWA') {
					$nim = $user->username;
					$mahasiswa = $this->Mahasiswa->findById(['nim' => $nim]);
					$user->id_program_studi = $mahasiswa->id_program_studi;
					$user->paraf = $mahasiswa->paraf;
				}

				$this->session->set_userdata("user", $user);
				$this->session->set_userdata("is_logged_in", TRUE);
				$this->session->set_userdata("logged_in_at", date('Y-m-d H:i:s'));
				unset($_SESSION['user']->password);
				return true;

			}

			return false;
		}

		return false;
	}

	public function register($data)
	{
		return $this->insert($this->table, $data);
	}
}

/* End of file Auth_model.php */
