<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_model extends Main_model
{
	protected $table = 'mahasiswa';

	private function getQuery($where = [])
	{
		$columns = "$this->table.*,";
		$columns .= "program_studi.kode_program_studi AS kode_prodi,
					program_studi.jenjang,
					program_studi.nama_program_studi AS prodi,
					kelas.nama_kelas, kelas.semester";

		$query = $this->db->select($columns)
			->from($this->table)
			->join('kelas', 'id_kelas')
			->join('program_studi', 'id_program_studi')
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
}

/* End of file Profil_kampus_model.php */
