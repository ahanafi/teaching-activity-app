<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends Main_model
{
	protected $table = "pengguna";

	public function createStudentAccount($data = array())
	{
		$data['level'] = 'MAHASISWA';
		$data['password'] = password_hash($data['nim'], PASSWORD_DEFAULT);

		$this->insert($data);
	}
}

/* End of file User_model.php */
