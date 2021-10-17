<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen_model extends Main_model
{
	protected $table = "dosen";

	private function getQuery($where = [])
	{
		$columns = "$this->table.*,";
		$columns .= "program_studi.kode_program_studi AS kode_prodi,
					program_studi.jenjang,
					program_studi.nama_program_studi AS prodi";

		$query = $this->db->select($columns)
			->from($this->table)->join('program_studi', 'id_program_studi')
			->order_by('nama_lengkap', 'asc');
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
		if($all) {
			return $query->result();
		}

		return $query->row();
	}
}

/* End of file Dosen_model.php */
