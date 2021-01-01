<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita_acara_model extends Main_model
{
	protected $table = 'berita_acara';

	//Related tables
	private $_JADWAL = 'jadwal',
			$_MATA_KULIAH = 'mata_kuliah',
			$_KELAS = 'kelas',
			$_DOSEN = 'dosen',
			$_RUANGAN = 'ruangan';

	//FOREIGN KEY
	private $_ID_JADWAL = 'id_jadwal',
			$_ID_MATA_KULIAH = 'id_mata_kuliah',
			$_ID_KELAS = 'id_kelas',
			$_ID_DOSEN = 'id_dosen',
			$_ID_RUANGAN = 'id_ruangan';

	private function getColumns()
    {
//        $columns = $this->table . ".*, $this->_MATA_KULIAH.nama_mata_kuliah, $this->_KELAS.nama_kelas, ";
//        $columns .= $this->_DOSEN . ".nama_lengkap,  $this->_RUANGAN.kode_ruangan ";
		$columnsInJadwal = "$this->_JADWAL.*, ";
		$columnsInMataKuliah = $this->_MATA_KULIAH.".nama_mata_kuliah AS mata_kuliah, ";
		$columnsInMataKuliah .= $this->_MATA_KULIAH.".sks, ";
		$columnsInKelas = $this->_KELAS.".nama_kelas AS kelas, ";
		$columnsInDosen = $this->_DOSEN.".nama_lengkap AS dosen";

		$columns = $this->table.".*, ";
		$columns .= $columnsInJadwal . $columnsInMataKuliah . $columnsInKelas . $columnsInDosen;

        return $columns;
    }

    private function getJoinQueries($where = [])
    {
        $joinTo = " JOIN $this->_JADWAL USING ($this->_ID_JADWAL) ";
        $joinTo .= " JOIN $this->_MATA_KULIAH USING ($this->_ID_MATA_KULIAH) ";
        $joinTo .= " JOIN $this->_KELAS USING ($this->_ID_KELAS) ";
        $joinTo .= " JOIN $this->_DOSEN USING ($this->_ID_DOSEN) ";

        $columns = $this->getColumns();
        $query = "SELECT " . $columns . " FROM " . $this->table . " " . $joinTo;

        if (!empty($where)) {
            $column = array_keys($where)[0];
            $value = array_values($where)[0];

            $query .= " WHERE $column = '$value' ";
        }

        return $query;
    }

    public function all()
    {
        $query = $this->getJoinQueries();
        return $this->db->query($query)->result();
    }

    public function findById($where = [], $all = false)
    {
        $query = $this->getJoinQueries($where);

        if ($all == true) {
            return $this->db->query($query)->result();
        }
        return $this->db->query($query)->row();
    }
}

/* End of file Berita_acara_model.php */
