<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends Main_model
{

	protected $table = "pengguna";

	public function login($credentials)
	{
		$sql = $this->db->where([
			'email' => $credentials['username']
		])->or_where([
			'username' => $credentials['username']
		])->get($this->table);
		$check = $sql->num_rows();

		if ($check > 0) {
			$data = $sql->row();
			$validate = password_verify($credentials['password'], $data->password);

			if ($validate === TRUE) {
				$kantorCabang = $this->db->select("kode")
					->from('kantor_cabang')
					->where('id_kantor_cabang', $data->id_kantor_cabang)
					->get()->row();

				$data->kode_kantor = $kantorCabang->kode;

				$this->session->set_userdata("user", $data);
				$this->session->set_userdata("is_logged_in", TRUE);
				unset($_SESSION['user']->password);
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function register($data)
	{
		$register = $this->db->insert($this->table, $data);
		return ($register) ? TRUE : FALSE;
	}
}

/* End of file Auth_model.php */
