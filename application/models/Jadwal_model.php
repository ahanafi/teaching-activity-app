<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal_model extends Main_model
{
	protected $table = 'jadwal';

	//Related tables
	private $_MATA_KULIAH = 'mata_kuliah',
			$_KELAS = 'kelas',
			$_DOSEN = 'dosen',
			$_RUANGAN = 'ruangan';

	//FOREIGN KEY
	private $_ID_MATA_KULIAH = 'id_mata_kuliah',
			$_ID_KELAS = 'id_kelas',
			$_ID_DOSEN = 'id_dosen',
			$_ID_RUANGAN = 'id_ruangan';

	private function getColumns()
    {
        $columns = $this->table . ".*, $this->_MATA_KULIAH.nama_mata_kuliah, $this->_KELAS.nama_kelas, $this->_KELAS.semester, ";
        $columns .= $this->_DOSEN . ".nama_lengkap, $this->_RUANGAN.kode_ruangan ";

        return $columns;
    }

    private function getJoinQueries($where = [])
    {
        $joinTo = " JOIN $this->_MATA_KULIAH USING ($this->_ID_MATA_KULIAH) ";
        $joinTo .= " JOIN $this->_KELAS USING ($this->_ID_KELAS) ";
        $joinTo .= " JOIN $this->_DOSEN USING ($this->_ID_DOSEN) ";
        $joinTo .= " JOIN $this->_RUANGAN USING ($this->_ID_RUANGAN) ";

        $columns = self::getColumns();
        $query = "SELECT " . $columns . " FROM " . $this->table . " " . $joinTo;


        if (!empty($where)) {
            $column = array_keys($where)[0];
            $value = array_values($where)[0];

            $query = "SELECT " . $columns . " FROM " . $this->table . " " . $joinTo;
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

    public function getByIdProgramStudi($id_program_studi)
	{
		$dosenId = $this->db->select('GROUP_CONCAT(id_dosen) AS id_dosen')
			->from('dosen')
			->where('id_program_studi', $id_program_studi)
			->get()
			->row();

		$selectedDosenId = "($dosenId->id_dosen)";

		$query = $this->getJoinQueries();
		$query .= " WHERE id_dosen IN " . $selectedDosenId;
		return $this->db->query($query)->result();
	}
}

/* End of file Jadwal_model.php */
