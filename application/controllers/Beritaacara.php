<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beritaacara extends CI_Controller
{

	private $uploadConfig;

	public function __construct()
	{
		parent::__construct();

		if (!isAuthenticated()) {
			redirect('login');
		}

		$this->uploadConfig = [
			'allowed_types' => 'gif|jpg|png',
			'max_size' => 2048, // 2MB
			'max_width' => 1280,
			'max_height' => 768,
			'encrypt_name' => true
		];

		$this->load->library(['upload', 'clouds']);
	}

	public function index()
	{
		$beritaAcara = $this->BeritaAcara->all();

		if (getUser('level') === "DOSEN") {
			$id_dosen = getUser('id_dosen');
			$beritaAcara = $this->BeritaAcara
				->setWherePosition('jadwal')
				->findById([
				'id_dosen' => $id_dosen
			], true);
		}

		$data = [
			'berita_acara' => $beritaAcara,
			'nomor' => 1
		];

		$this->main_lib->getTemplate("berita-acara/index", $data);
	}

	public function create()
	{
		$jadwal = $this->Jadwal->all();
		$currentUserLevel = getUser('level');

		if ($currentUserLevel === "DOSEN" || $currentUserLevel === "KAPRODI") {
			$id_dosen = getUser('id_dosen');
			$jadwal = $this->Jadwal->findById([
				'id_dosen' => $id_dosen
			], true);
		}

		$data = [
			'jadwal' => $jadwal
		];

		if (isset($_POST['submit'])) {
			$rules = $this->_rules();
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

			if ($this->form_validation->run() === FALSE) {
				$this->main_lib->getTemplate('berita-acara/form-create', $data);
			} else {
				//get user submit form data
				$getPostData = $this->getPostData();

				$uploadBuktiKegiatan = $this->uploadBuktiKegiatan('bukti_kegiatan');

				if (is_string($uploadBuktiKegiatan)) {
					$data['error'] = $uploadBuktiKegiatan;
					$this->main_lib->getTemplate("berita-acara/form-create", $data);
				} else if (is_array($uploadBuktiKegiatan)) {
					//Insert parent table
					$insert = $this->BeritaAcara->insert($getPostData);

					$IdBeritaAcara = $this->BeritaAcara->getLastInsertId('id_berita_acara');

					$fotoBuktiKegiatan = [];

					foreach ($uploadBuktiKegiatan as $bukti) {
						$fotoBuktiKegiatan[] = [
							'id_berita_acara' => $IdBeritaAcara,
							'nama_file' => $bukti['nama_file'],
							'jenis_file' => $bukti['jenis_file'],
							'lokasi' => $bukti['lokasi'],
						];
					}

					$this->BuktiKegiatan->insert($fotoBuktiKegiatan, true);

					if ($insert) {
						$messages = setArrayMessage('success', 'insert', 'berita acara');
					} else {
						$messages = setArrayMessage('error', 'insert', 'berita acara');
					}

					$this->session->set_flashdata('message', $messages);
					redirect(base_url('berita-acara'), 'refresh');
				}
			}
		} else {
			$this->main_lib->getTemplate("berita-acara/form-create", $data);
		}
	}

	public function edit($id_berita_acara = null)
	{
		$jadwal = $this->Jadwal->all();
		$currentUserLevel = getUser('level');
		$beritaAcara = $this->BeritaAcara->findById([
			'id_berita_acara' => $id_berita_acara
		]);
		$buktiKegiatan = $this->BuktiKegiatan->findById(['id_berita_acara' => $beritaAcara->id_berita_acara], true);

		if (!$beritaAcara || $id_berita_acara === '') {
			redirect(base_url('error'));
		}

		if ($currentUserLevel === "DOSEN" || $currentUserLevel === "KAPRODI") {
			$id_dosen = getUser('id_dosen');
			$jadwal = $this->Jadwal->findById([
				'id_dosen' => $id_dosen
			], true);
		}

		$data = [
			'jadwal' => $jadwal,
			'bap' => $beritaAcara,
			'bukti_kegiatan' => $buktiKegiatan
		];

		if (isset($_POST['update'])) {
			$rules = $this->_rules();
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

			if ($this->form_validation->run() === FALSE) {
				$this->main_lib->getTemplate('berita-acara/form-update', $data);
			} else {
				$getPostData = $this->getPostData();

				$uploadBuktiKegiatan = $this->uploadBuktiKegiatan('bukti_kegiatan');

				if (is_string($uploadBuktiKegiatan) && $uploadBuktiKegiatan !== '') {
					$data['error'] = $uploadBuktiKegiatan;
					$this->main_lib->getTemplate("berita-acara/form-update", $data);
				} else if (is_array($uploadBuktiKegiatan)) {

					$update = $this->BeritaAcara->update($getPostData, [
						'id_berita_acara' => $id_berita_acara
					]);

					if(count((array) $uploadBuktiKegiatan) > 0) {
						$fotoBuktiKegiatan = [];
						foreach ($uploadBuktiKegiatan as $bukti) {
							$fotoBuktiKegiatan[] = [
								'id_berita_acara' => $id_berita_acara,
								'nama_file' => $bukti['nama_file'],
								'jenis_file' => $bukti['jenis_file'],
								'lokasi' => $bukti['lokasi'],
							];
						}
						$this->BuktiKegiatan->insert($fotoBuktiKegiatan, true);
					}


					if ($update) {
						$messages = setArrayMessage('success', 'update', 'berita acara');
					} else {
						$messages = setArrayMessage('error', 'update', 'berita acara');
					}

					$this->session->set_flashdata('message', $messages);
					redirect(base_url('berita-acara'), 'refresh');
				}
			}
		} else {
			$this->main_lib->getTemplate("berita-acara/form-update", $data);
		}
	}

	public function delete($id_berita_acara = null)
	{
		if (isset($_POST['_method']) && $_POST['_method'] === "DELETE" && $id_berita_acara !== '') {
			$data_id = $this->main_lib->getPost('data_id');
			$data_type = $this->main_lib->getPost('data_type');

			if ($data_id === $id_berita_acara && $data_type === 'berita-acara') {
				$buktiKegiatan = $this->BuktiKegiatan->findById([
					'id_berita_acara' => $data_id
				], true);

				foreach ($buktiKegiatan as $bukti) {
					$buktiKegiatanPath = FCPATH . $bukti->lokasi;
					if (file_exists($buktiKegiatanPath)) {
						unlink($buktiKegiatanPath);
					}
				}

				$delete = $this->BeritaAcara->delete(['id_berita_acara' => $data_id]);
				if ($delete) {
					$messages = setArrayMessage('success', 'delete', 'berita acara');
				} else {
					$messages = setArrayMessage('error', 'delete', 'berita acara');
				}

				$this->session->set_flashdata('message', $messages);
			} else {
				$messages = setArrayMessage('error', 'delete', 'berita acara');
				$this->session->set_flashdata('message', $messages);
			}
			redirect(base_url('berita-acara'), 'refresh');
		} else {
			redirect('dashboard');
		}
	}

	public function detail($idBeritaAcara = null)
	{
		$beritaAcara = $this->BeritaAcara->findById([
			'id_berita_acara' => $idBeritaAcara
		]);

		if (!$beritaAcara || $idBeritaAcara === '') {
			redirect(base_url('error'));
		}

		$buktiKegiatan = $this->BuktiKegiatan->findById([
			'id_berita_acara' => $idBeritaAcara
		], true);

		$verifikasi = $this->Verifikasi->findById(['id_berita_acara' => $idBeritaAcara]);

		$data = [
			'bap' => $beritaAcara,
			'dokumentasi' => $buktiKegiatan,
			'verifikasi' => $verifikasi
		];

		$this->main_lib->getTemplate("berita-acara/detail", $data);
	}

	private function getPostData($type = 'berita-acara')
	{
		$jenisAplikasi = $this->main_lib->getPost('jenis_aplikasi');
		$jenisAplikasi = implode(",", $jenisAplikasi);

		$bentukMateri = $this->main_lib->getPost('bentuk_materi');
		$bentukMateri = implode(",", $bentukMateri);

		$postData = [];
		if ($type === 'berita-acara') {
			$postData = [
				'id_jadwal' => $this->main_lib->getPost('id_jadwal'),
				'pertemuan_ke' => $this->main_lib->getPost('pertemuan_ke'),
				'jumlah_hadir' => $this->main_lib->getPost('jumlah_hadir'),
				'total_mahasiswa' => $this->main_lib->getPost('total_mahasiswa'),

				'jenis_aplikasi' => $jenisAplikasi,
				'bentuk_materi' => $bentukMateri,

				'uraian_materi' => $this->main_lib->getPost('uraian_materi'),
				'ada_tugas' => $this->main_lib->getPost('penugasan'),
				'pokok_bahasan' => $this->main_lib->getPost('pokok_bahasan'),

				'tanggal_realisasi' => $this->main_lib->getPost('tanggal'),
				'jam_mulai' => $this->main_lib->getPost('jam_mulai'),
				'jam_selesai' => $this->main_lib->getPost('jam_selesai'),
			];
		}

		if ($type === 'verifikasi') {
			$postData = [
				'nim' => $this->main_lib->getPost('nim'),
			];
		}

		return $postData;
	}

	/*
	 *  If return is as array value, it means there are error while upload the image
	 *  But, if return is string value, it means successfully upload image
	 * */
	private function _doUpload($inputName)
	{

		if (isset($_FILES[$inputName]) && $_FILES[$inputName]['name'] !== '') {
			$file_type = str_replace("_", "-", $inputName);

			$config = $this->uploadConfig;
			$config['upload_path'] = './uploads/' . $file_type;


			$this->upload->initialize($config);
			if ($this->upload->do_upload($inputName)) {
				$fileName = $this->upload->data('file_name');
				return "uploads/" . $file_type . "/" . $fileName;

			} else {
				$error = $this->upload->display_errors("<p class='error-text'>", "<p>");
				return ['error' => $error];
			}
		}
	}

	private function _rules()
	{
		return [
			[
				'field' => 'id_jadwal',
				'label' => 'Jadwal',
				'rules' => 'required|callback_validate_jadwal'
			],
			[
				'field' => 'tanggal',
				'label' => 'Tanggal',
				'rules' => 'required'
			],
			[
				'field' => 'jam_mulai',
				'label' => 'Jam mulai',
				'rules' => 'required'
			],
			[
				'field' => 'jam_selesai',
				'label' => 'Jam selesai',
				'rules' => 'required'
			],
			[
				'field' => 'jumlah_hadir',
				'label' => 'Jumlah hadir',
				'rules' => 'required'
			],
			[
				'field' => 'total_mahasiswa',
				'label' => 'Total mahasiswa',
				'rules' => 'required'
			],
			[
				'field' => 'pertemuan_ke',
				'label' => 'Pertemuan ke',
				'rules' => 'required'
			],
			[
				'field' => 'jenis_aplikasi[]',
				'label' => 'Aplikasi daring',
				'rules' => 'required'
			],
			[
				'field' => 'bentuk_materi[]',
				'label' => 'Bentuk materi',
				'rules' => 'required'
			],
			[
				'field' => 'penugasan',
				'label' => 'Penugasan',
				'rules' => 'required'
			],
			[
				'field' => 'pokok_bahasan',
				'label' => 'Pokok bahasan',
				'rules' => 'required'
			],
			[
				'field' => 'uraian_materi',
				'label' => 'Uraian materi',
				'rules' => 'required'
			]
		];
	}

	public function validate_jadwal()
	{
		$id_jadwal = $this->main_lib->getPost('id_jadwal');

		if (!empty(trim($id_jadwal))) {
			$jadwal = $this->Jadwal->findById(['id_jadwal' => $id_jadwal]);
			if (!$jadwal) {
				$this->form_validation->set_message('validate_jadwal', 'Jadwal tidak ditemukan!');
				return false;
			}

			return true;
		}

		return false;
	}

	/*
	 * If return is string, it means there are errors while uploading images
	 * if return is array, it means image was successfully uploaded to the server
	 * */
	private function uploadBuktiKegiatan($inputName)
	{
		$uploadedFileName = [];
		$isError = false;
		$errorMessage = "xxx";

		if (isset($_FILES[$inputName]) && count($_FILES[$inputName]['name']) > 0) {
			$fileCount = count($_FILES[$inputName]['name']);

			for ($i = 0; $i < $fileCount; $i++) {

				$_FILES['file']['name'] = $_FILES[$inputName]['name'][$i];
				$_FILES['file']['type'] = $_FILES[$inputName]['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES[$inputName]['tmp_name'][$i];
				$_FILES['file']['error'] = $_FILES[$inputName]['error'][$i];
				$_FILES['file']['size'] = $_FILES[$inputName]['size'][$i];

				if($_FILES['file']['name'] !== '') {
					$myConfig = $this->uploadConfig;
					$myConfig['upload_path'] = './uploads/bukti-kegiatan/';
					$this->upload->initialize($myConfig);

					if ($this->upload->do_upload('file')) {
						$uploadData = $this->upload->data();
						$fileName = $uploadData['file_name'];
						$fileType = $uploadData['file_type'];
						$fileLocation = 'uploads/bukti-kegiatan/' . $fileName;

						$uploadedFileName[] = [
							'nama_file' => $fileName,
							'jenis_file' => $fileType,
							'lokasi' => $fileLocation
						];
					} else {
						$isError = true;
						$errorMessage = $this->upload->display_errors('', '');
						break;
					}
				}
			}
		}

		if ($isError) {
			foreach ($uploadedFileName as $file) {
				$path = FCPATH . $file['lokasi'];
				if (file_exists($path)) {
					unlink($path);
				}
			}
			return $errorMessage;
		}

		return $uploadedFileName;
	}

	public function delete_bukti_kegiatan($idBuktiKegiatan)
	{
		if (isset($_POST['_method']) && $_POST['_method'] === "DELETE" && $idBuktiKegiatan !== '') {
			$data_id = $this->main_lib->getPost('data_id');
			$data_type = $this->main_lib->getPost('data_type');

			$idBeritaAcara = null;

			if ($data_id === $idBuktiKegiatan && $data_type === 'bukti-kegiatan') {
				$buktiKegiatan = $this->BuktiKegiatan->findById(['id_bukti_kegiatan' => $data_id]);
				$idBeritaAcara = $buktiKegiatan->id_berita_acara;

				$buktiKegiatanPath = FCPATH . $buktiKegiatan->lokasi;
				if (file_exists($buktiKegiatanPath)) {
					unlink($buktiKegiatanPath);
				}

				$delete = $this->BuktiKegiatan->delete(['id_bukti_kegiatan' => $data_id]);
				if ($delete) {
					$messages = setArrayMessage('success', 'delete', 'bukti kegiatan');
				} else {
					$messages = setArrayMessage('error', 'delete', 'bukti kegiatan');
				}

				$this->session->set_flashdata('message', $messages);
			} else {
				$messages = setArrayMessage('error', 'delete', 'bukti kegiatan');
				$this->session->set_flashdata('message', $messages);
			}
			redirect(base_url('berita-acara/detail/' . $idBeritaAcara), 'refresh');
		} else {
			redirect('dashboard');
		}
	}

}

/* End of file Beritaacara.php */
