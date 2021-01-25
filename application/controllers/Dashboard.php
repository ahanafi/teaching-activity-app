<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if(!isAuthenticated()) {
			redirect('login');
		}
	}

	public function index()
	{
		$totalDosen = $this->Dosen->count();

		$arrLabelApps = [];
		$arrValueApps = [];

		foreach (daringApps() as $appCode => $appName) {
			$arrLabelApps[] = $appName;
			$appCode = strtolower($appCode);
			$arrValueApps[] = $this->BeritaAcara->getCount('jenis_aplikasi LIKE', "%$appCode%");
		}

		$materialLabel = [];
		$materialValue = [];
		$materialColors = [];

		foreach (materialType() as $materialCode => $materialName) {
			$materialLabel[] = $materialName;
			$code = strtolower($materialCode);
			$materialValue[] = $this->BeritaAcara->getCount('bentuk_materi LIKE', "%$code%");
			$materialColors[] = randomHexColor();
		}

		$data = [
			'total_dosen' => $totalDosen,
			'app_label' => $arrLabelApps,
			'app_value' => $arrValueApps,

			'material_label' => $materialLabel,
			'material_value' => $materialValue,
			'material_colors'=> $materialColors
		];


		$this->main_lib->getTemplate('dashboard', $data);
	}

}

/* End of file Dashboard.php */
