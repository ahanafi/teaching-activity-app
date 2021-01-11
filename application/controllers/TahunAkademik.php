<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TahunAkademik extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if (!isAuthenticated()) {
			redirect('login');
		}
	}

	public function index($isEdit = false)
	{
		$tahunAkademik = $this->TahunAkademik->first();

		$isEdit = isset($_GET['is_edit']) && $_GET['is_edit'] == 'true'
			? $this->main_lib->getParams('is_edit')
			: $isEdit;

		if((isset($_GET['is_edit']) && $_GET['is_edit'] != 'true')) {
			redirect(base_url('error'));
		}

		$tahunAkademikId = $tahunAkademik->id_tahun_akademik;

		$data = [
			'tahun_akademik' => $tahunAkademik,
			'is_edit' => $isEdit,
		];

		if (isset($_POST['update'])) {
			$formRules = [
				[
					'field' => 'tahun',
					'label' => 'Tahun Akademik',
					'rules' => 'required'
				],
				[
					'field' => 'semester',
					'label' => 'Semester berjalan',
					'rules' => 'required'
				]
			];

			$this->form_validation->set_rules($formRules);
			$this->form_validation->set_error_delimiters("<small class='text-danger'>", "<small>");

			if ($this->form_validation->run() === FALSE) {
				$this->main_lib->getTemplate("tahun-akademik/form-tahun-akademik", $data);
			} else {
				$data = [
					'tahun' => $this->main_lib->getPost('tahun'),
					'semester_akademik' => $this->main_lib->getPost('semester'),
				];

				$update = $this->TahunAkademik->update($data, [
					'id_tahun_akademik' => $tahunAkademikId
				]);

				if ($update) {
					$messages = setArrayMessage('success', 'update', 'tahun akademik');
				} else {
					$messages = setArrayMessage('error', 'update', 'tahun akademik');
				}

				$this->session->set_flashdata('message', $messages);
				redirect(base_url('tahun-akademik'), 'refresh');
			}
		} else {
			$this->main_lib->getTemplate("tahun-akademik/form-tahun-akademik", $data);
		}
	}

}

/* End of file TahunAkademik.php */
