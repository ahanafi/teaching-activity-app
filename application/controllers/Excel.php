<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Excel extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if (!isAuthenticated()) {
			redirect('login');
		}
	}

	public function berita_acara()
	{
		if (isset($_POST['submit'])) {
			$hari = $this->main_lib->getPost('hari');
			$dosenId = $this->main_lib->getPost('id_dosen');
			$programStudiId = $this->main_lib->getPost('id_program_studi');

			$filter = $this->_doFilter($hari, $dosenId, $programStudiId);

			$beritaAcara = $this->BeritaAcara->all();
			if($filter != '') {
				$beritaAcara = $this->BeritaAcara->getByFilter($filter);
			}

			$arrBeritaAcara = [];
			foreach ($beritaAcara as $bap) {
				$beritaAcaraId = $bap->id_berita_acara;

				$buktiKegiatan = $this->BuktiKegiatan->findById([
					'id_berita_acara' => $beritaAcaraId
				]);
				$bap->ada_bukti  = ($buktiKegiatan) ? "V" : "";
				$arrBeritaAcara[] = $bap;
			}

			$data['berita_acara'] = $arrBeritaAcara;
			$data['nomor'] = 1;
		}

		$this->main_lib->getTemplate("laporan/form-laporan", $data);
	}

	private function _doFilter($hari, $dosenId, $programStudiId): array
	{
		$arrFilter = [];

		//Filter only days
		if ($hari != 'all_days' && $dosenId == 'all_dosen' && $programStudiId == 'all_prodi') {
			$arrFilter = ['hari' => $hari];
		}

		//Filter only dosen Id
		if ($hari == 'all_days' && $dosenId != 'all_dosen' && $programStudiId == 'all_prodi') {
			$arrFilter = ['id_dosen' => $dosenId];
		}

		//Filter only program studi Id
		if ($hari == 'all_days' && $dosenId == 'all_dosen' && $programStudiId != 'all_prodi') {
			$arrFilter = ['dosen.id_program_studi' => $programStudiId];
		}

		//Filter days and dosen id
		if ($hari != 'all_days' && $dosenId != 'all_dosen' && $programStudiId == 'all_prodi') {
			$arrFilter = [
				'hari' => $hari,
				'id_dosen' => $dosenId
			];
		}

		//Filter days and program studi id
		if ($hari != 'all_days' && $dosenId == 'all_dosen' && $programStudiId != 'all_prodi') {
			$arrFilter = [
				'hari' => $hari,
				'dosen.id_program_studi' => $programStudiId
			];
		}

		//Filter dosen and program studi id
		if ($hari == 'all_days' && $dosenId != 'all_dosen' && $programStudiId != 'all_prodi') {
			$arrFilter = [
				'id_dosen' => $dosenId,
				'dosen.id_program_studi' => $programStudiId
			];
		}

		//Filter all
		if ($hari != 'all_days' && $dosenId != 'all_dosen' && $programStudiId != 'all_prodi') {
			$arrFilter = [
				'hari' => $hari,
				'id_dosen' => $dosenId,
				'dosen.id_program_studi' => $programStudiId
			];
		}

		return $arrFilter;
	}
}

/* End of file Excel.php */
