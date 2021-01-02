<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Program_studi_model extends Main_model
{
	protected $table = 'program_studi';

	private function getQuery($where = [])
	{
		$columns = "$this->table.*,";
		$columns .= "fakultas.nama_fakultas AS fakultas,
					fakultas.kode_fakultas,
					dosen.nama_lengkap AS kaprodi";

		$query = $this->db->select($columns)
			->from($this->table)
			->join('fakultas', 'id_fakultas')
			->join('dosen', 'id_dosen', 'left');

		if (!empty($where)) {
		    return $query->where($where)->get();
		}
		return $query->get();
	}

	public function all()
	{
		return $this->getQuery()->result();
	}

	public function findById($where = [], $all = FALSE)
	{
		$query = $this->getQuery($where);
		if($all == true) {
			return $query->result();
		}

		return $query->row();
	}
}

/* End of file Program_studi_model.php */
