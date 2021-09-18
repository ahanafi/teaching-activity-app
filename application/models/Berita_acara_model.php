<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita_acara_model extends Main_model
{
	protected $table = 'berita_acara';

	//Related tables
	private $_JADWAL = 'jadwal',
		$_VERIFIKASI = 'verifikasi';

	//FOREIGN KEY
	private $_ID_JADWAL = 'id_jadwal', $_ID_BERITA_ACARA = 'id_berita_acara';

	public $wherePosition = null;

	public function __construct()
	{
		parent::__construct();
		$this->wherePosition = $this->table;
	}

	public function all()
	{
		$query = $this->getJoinQueries();
		return $this->db->query($query)->result();
	}

	private function getJoinQueries($where = [])
	{
		$queryJadwal = $this->wherePosition === $this->table ? $this->queryJadwal() : $this->queryJadwal($where);
		$joinTo = " JOIN (" . $queryJadwal . ") AS jadwal USING ($this->_ID_JADWAL) ";
		$joinTo .= " LEFT JOIN $this->_VERIFIKASI USING ($this->_ID_BERITA_ACARA) ";

		$columns = $this->getColumns();
		$query = "SELECT " . $columns . " FROM " . $this->table . " " . $joinTo;

		if (!empty($where) && $this->wherePosition === $this->table) {
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

		$query .= " GROUP BY $this->table.$this->_ID_BERITA_ACARA";

		return $query;
	}

	private function queryJadwal($where = [])
	{
		$jadwalModel = new Jadwal_model();
		return $jadwalModel->getJoinQueries($where);
	}

	private function getColumns()
	{
		return "$this->table.*, $this->_JADWAL.* ";
	}

	public function findById($where = [], $all = false)
	{
		$query = $this->getJoinQueries($where);

		if ($all) {
			return $this->db->query($query)->result();
		}
		return $this->db->query($query)->row();
	}

	public function getByFilter($where = [])
	{
		$query = $this->getJoinQueries($where);

		return $this->db->query($query)->result();
	}

	public function getCount($key, $value)
	{
		return $this->db->where($key, $value)
			->get($this->table)
			->num_rows();
	}

	public function setWherePosition($position)
	{
		$this->wherePosition = $position;
		return $this;
	}
}

/* End of file Berita_acara_model.php */
