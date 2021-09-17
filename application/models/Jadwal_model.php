<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal_model extends Main_model
{
	protected $table = 'jadwal';
	protected $childTable = 'detail_jadwal';

	//Related tables
	private $_MATA_KULIAH = 'mata_kuliah',
		$_KELAS = 'kelas',
		$_DOSEN = 'dosen',
		$_RUANGAN = 'ruangan';

	//PRIMARY KEY
	private $_PRIMARY_KEY = 'id_jadwal';

	//FOREIGN KEY
	private $_ID_MATA_KULIAH = 'id_mata_kuliah',
		$_ID_KELAS = 'id_kelas',
		$_ID_DOSEN = 'id_dosen',
		$_ID_RUANGAN = 'id_ruangan';

	private function getColumns()
	{
		$columnInJadwal = $this->table . ".id_jadwal, $this->table.hari, jam_mulai, jam_selesai, ";
		$columnInMataKuliah = $this->_MATA_KULIAH . ".nama_mata_kuliah, ";
		$columnInDosen = $this->_DOSEN . ".nama_lengkap, $this->_DOSEN.gelar, ";
		$columnInRuangan = $this->_RUANGAN . '.kode_ruangan, ';
		$columnInKelas = "GROUP_CONCAT(CONCAT(' ', $this->_KELAS.nama_kelas, '/', $this->_KELAS.semester)) AS kelas ";

		return $columnInJadwal . $columnInMataKuliah . $columnInDosen . $columnInRuangan . $columnInKelas;
	}

	private function getJoinQueries($where = [], $operator = '=')
	{
		$joinTo = "JOIN $this->childTable USING ($this->_PRIMARY_KEY) ";
		$joinTo .= " JOIN $this->_MATA_KULIAH USING ($this->_ID_MATA_KULIAH) ";
		$joinTo .= " JOIN $this->_KELAS USING ($this->_ID_KELAS) ";
		$joinTo .= " JOIN $this->_DOSEN USING ($this->_ID_DOSEN) ";
		$joinTo .= " JOIN $this->_RUANGAN USING ($this->_ID_RUANGAN) ";

		$columns = self::getColumns();
		$query = "SELECT " . $columns . " FROM " . $this->table . " " . $joinTo;

		if (!empty($where)) {
			$column = array_keys($where)[0];
			$value = array_values($where)[0];

			$query = "SELECT " . $columns . " FROM " . $this->table . " " . $joinTo;

			$query .= " WHERE $column $operator $value ";
		}

		$query .= " GROUP BY $this->table.$this->_PRIMARY_KEY";

		if ($operator === '=') {
			$query .= " ORDER BY $this->table.id_jadwal ASC";
		}

		return $query;
	}

	public function all()
	{
		$query = $this->getJoinQueries();
		return $this->db->query($query)->result();
	}

	public function insertDetail($dataKelas = array(), $id_jadwal)
	{
		$kelasId = [];
		$index = 0;
		foreach ($dataKelas as $kelas) {
			$kelasId[$index] = [
				'id_kelas' => $kelas,
				'id_jadwal' => $id_jadwal
			];
			$index++;
		}

		return $this->db->insert_batch($this->childTable, $kelasId);
	}

	public function findById($where = [], $all = false)
	{
		$query = $this->getJoinQueries($where);
		if ($all) {
			return $this->db->query($query)->result();
		}
		return $this->db->query($query)->row();
	}

	public function getByIdProgramStudi($id_program_studi, $getIdDosenOnly = false)
	{
		$dosenId = $this->db->select('GROUP_CONCAT(id_dosen) AS id_dosen')
			->from('dosen')
			->where('id_program_studi', $id_program_studi)
			->get()
			->row();

		$selectedDosenId = "($dosenId->id_dosen)";

		$query = $this->getJoinQueries([
			'id_dosen' => $selectedDosenId
		], 'IN');
		$query .= " ORDER BY $this->table.id_jadwal ASC";

		if ($getIdDosenOnly) {
			return $selectedDosenId;
		}

		return $this->db->query($query)->result();
	}

	public function validate($where = [])
	{
		if (array_key_exists('id_kelas', $where)) {
			$kelasId = count((array)$where['id_kelas']) > 1 ? implode(',', $where['id_kelas']) : $where['id_kelas'][0];
			$jamMulai = $where['jam_mulai'];
			$hari = $where['hari'];

			return $this->db->query("
				SELECT * FROM $this->table
				JOIN $this->childTable USING ($this->_PRIMARY_KEY)
				WHERE jam_mulai = '$jamMulai' AND hari = '$hari'
				AND id_kelas IN ($kelasId)
			")->num_rows();
		}

		return $this->db->where($where)
			->get($this->table)
			->num_rows();
	}
}

/* End of file Jadwal_model.php */
