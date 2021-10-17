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
		$whereJadwal = [];
		$whereBeritaAcara = [];

		if(array_key_exists('pertemuan_ke', $where)) {
			$whereBeritaAcara['pertemuan_ke'] = $where['pertemuan_ke'];
			unset($where['pertemuan_ke']);
		}

		if(count($where) > 0) {
			if($this->wherePosition !== $this->table) {
				$whereJadwal = $where;
			} else {
				$whereBeritaAcara = $where;
			}
		}

		$queryJadwal = $this->wherePosition === $this->table ? $this->queryJadwal() : $this->queryJadwal($whereJadwal);
		$joinTo = " JOIN (" . $queryJadwal . ") AS jadwal USING ($this->_ID_JADWAL) ";
		$joinTo .= " LEFT JOIN $this->_VERIFIKASI USING ($this->_ID_BERITA_ACARA) ";

		$columns = $this->getColumns();
		$query = "SELECT " . $columns . " FROM " . $this->table . " " . $joinTo;

		if (!empty($whereBeritaAcara)) {
			if (count($whereBeritaAcara) === 1) {
				$column = array_keys($whereBeritaAcara)[0];
				$value = array_values($whereBeritaAcara)[0];

				$query .= " WHERE $column = '$value' ";
			} else if (count($whereBeritaAcara) > 1) {
				$query .= " WHERE ";
				$index = 0;
				foreach ($whereBeritaAcara as $col => $val) {
					$query .= "{$col} = '$val'";
					if ($index < count($whereBeritaAcara) - 1) {
						$query .= " AND ";
					}
					$index++;
				}
			}
		}

		//$query .= " GROUP BY $this->table.$this->_ID_BERITA_ACARA";

		return $query;
	}

	private function queryJadwal($where = [])
	{
		$jadwalModel = new Jadwal_model();
		return $jadwalModel->getJoinQueries($where);
	}

	private function getColumns()
	{
		$columnInBeritaAcara =  "$this->table.*, $this->table.jam_mulai AS jam_mulai_pelaksanaan, $this->table.jam_selesai AS jam_selesai_pelaksanaan, ";
		$columnInJadwal = "$this->_JADWAL.*, ";
		$columnInVerifikasi = "$this->_VERIFIKASI.nim_verifikator, $this->_VERIFIKASI.nidn_verifikator";
		return $columnInBeritaAcara . $columnInJadwal . $columnInVerifikasi;

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

	public function updateStatus($idBeritaAcara)
	{
		return $this->update(['status_periksa' => 1], [$this->_ID_BERITA_ACARA => $idBeritaAcara]);
	}
}

/* End of file Berita_acara_model.php */
