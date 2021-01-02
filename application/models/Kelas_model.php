<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas_model extends Main_model
{
	protected $table = 'kelas';

	private function getQuery($where = [])
	{
		$columns = "$this->table.*,";
		$columns .= "program_studi.nama_program_studi AS prodi,
					program_studi.jenjang,
					program_studi.kode_program_studi AS kode_prodi";

		$query = $this->db->select($columns)
			->from($this->table)->join('program_studi', 'id_program_studi');
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

/* End of file Kelas_model.php */
