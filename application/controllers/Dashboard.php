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
		$data = [
			'total_dosen' => $totalDosen
		];
		$this->main_lib->getTemplate('dashboard', $data);
	}

}

/* End of file Dashboard.php */
