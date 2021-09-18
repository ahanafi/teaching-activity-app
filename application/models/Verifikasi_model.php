<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasi_model extends Main_model
{
	protected $table = 'verifikasi';

	private $_MAHASISWA = 'mahasiswa',
		$_DOSEN = 'dosen';

	public function all()
	{
		$query = $this->getJoinQueries();
		return $this->db->query($query)->result();
	}

	private function getColumns()
	{
		$columns = "$this->table.*, ";
		$columns .= "$this->_MAHASISWA.nim, $this->_MAHASISWA.nama_lengkap AS nama_mahasiswa, $this->_MAHASISWA.paraf AS paraf_mahasiswa, ";
		$columns .= "$this->_DOSEN.nidn, $this->_DOSEN.nama_lengkap AS nama_dosen, $this->_DOSEN.gelar, $this->_DOSEN.paraf AS paraf_dosen ";
		return $columns;
	}

	private function getJoinQueries($where = array())
	{
		$joinTable = " JOIN $this->_MAHASISWA ON $this->_MAHASISWA.nim = $this->table.nim_verifikator ";
		$joinTable .= " JOIN $this->_DOSEN ON $this->_DOSEN.nidn = $this->table.nidn_verifikator ";

		$columns = $this->getColumns();
		$query = "SELECT $columns FROM $this->table $joinTable";

		if (!empty($where)) {
			if (count($where) === 1) {
				$column = array_keys($where)[0];
				$value = array_values($where)[0];

				$query .= " WHERE $column = '$value' ";
			} else if (count($where) > 1) {
				$query .= " WHERE ";
				$index = 0;
				foreach ($where as $col => $val) {
					$query .= "{$col} = '$val'";
					if ($index < count($where) - 1) {
						$query .= " AND ";
					}
					$index++;
				}
			}
		}

		return $query;
	}

	public function findById($where = array(), $all = false)
	{
		$query = $this->getJoinQueries($where);
		if ($all) {
			return $this->db->query($query)->result();
		}
		return $this->db->query($query)->row();
	}
}


/* End of file Verifikasi_model.php */
