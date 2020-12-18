<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends Main_model
{
	protected $table = "pengguna";

	public function all()
	{
		return parent::all();
	}
}

/* End of file User_model.php */
