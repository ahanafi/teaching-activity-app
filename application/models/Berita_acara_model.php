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
			$_VERIFIKASI = 'verifikasi',
			$_MAHASISWA = 'mahasiswa',
			$_BUKTI_KEGIATAN = 'bukti_kegiatan';

	//FOREIGN KEY
	private $_ID_JADWAL = 'id_jadwal',
			$_ID_MATA_KULIAH = 'id_mata_kuliah',
			$_ID_KELAS = 'id_kelas',
			$_ID_DOSEN = 'id_dosen',
			$_ID_VERIFIKASI = 'id_verifikasi',
			$_ID_MAHASISWA = 'id_mahasiswa',
			$_ID_BERITA_ACARA = 'id_berita_acara';

	private function getColumns()
    {
		$columnsInJadwal = "$this->_JADWAL.*, ";
		$columnsInMataKuliah = $this->_MATA_KULIAH.".nama_mata_kuliah AS mata_kuliah, ";
		$columnsInMataKuliah .= $this->_MATA_KULIAH.".sks, ";
		$columnsInKelas = $this->_KELAS.".nama_kelas AS kelas, $this->_KELAS.semester, ";
		$columnsInDosen = $this->_DOSEN.".nama_lengkap AS dosen, $this->_DOSEN.gelar, ";
		$columnsInVerifikasi = $this->_VERIFIKASI.'.*, ';
		$columnsInMahasiswa = "$this->_MAHASISWA.nim, $this->_MAHASISWA.nama_lengkap AS nama_mahasiswa, $this->_MAHASISWA.paraf";

		$columns = $this->table.".*, $this->table.jam_mulai AS jam_mulai_pelaksanaan, $this->table.jam_selesai AS jam_selesai_pelaksanaan, ";
		$columns .= $columnsInJadwal . $columnsInMataKuliah . $columnsInKelas . $columnsInDosen . $columnsInVerifikasi . $columnsInMahasiswa;

        return $columns;
    }

    private function getJoinQueries($where = [])
    {
        $joinTo = " JOIN $this->_JADWAL USING ($this->_ID_JADWAL) ";
        $joinTo .= " JOIN $this->_MATA_KULIAH USING ($this->_ID_MATA_KULIAH) ";
        $joinTo .= " JOIN $this->_KELAS USING ($this->_ID_KELAS) ";
        $joinTo .= " JOIN $this->_DOSEN USING ($this->_ID_DOSEN) ";
        $joinTo .= " JOIN $this->_VERIFIKASI USING ($this->_ID_BERITA_ACARA)";
        $joinTo .= " JOIN $this->_MAHASISWA ON $this->_VERIFIKASI.nim_verifikator = $this->_MAHASISWA.nim";

        $columns = $this->getColumns();
        $query = "SELECT " . $columns . " FROM " . $this->table . " " . $joinTo;

        if (!empty($where)) {
        	if(count($where) === 1) {
				$column = array_keys($where)[0];
				$value = array_values($where)[0];

				$query .= " WHERE $column = '$value' ";
			} else if(count($where) > 1) {
        		$query .= " WHERE ";
        		$index = 0;
				foreach ($where as $col => $val) {
					$query .= "{$col} = '$val'";
					if($index < count($where) - 1) {
						$query .= " AND ";
					}
					$index++;
        		}
			}
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
}

/* End of file Berita_acara_model.php */
