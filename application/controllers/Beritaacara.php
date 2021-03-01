<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beritaacara extends CI_Controller
{

	private $uploadConfig = [];

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
		$currentUserLevel = getUser('level');

		if ($currentUserLevel === "DOSEN") {
			$id_dosen = getUser('id_dosen');
			$beritaAcara = $this->BeritaAcara->findById([
				'jadwal.id_dosen' => $id_dosen
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

				//Proccess upload
				if (isset($_FILES['paraf_mhs']) && $_FILES['paraf_mhs']['name'] !== '') {
					$parafMhs = $this->_doUpload('paraf_mhs');

					if (is_array($parafMhs)) {
						$data['err_upload'] = $parafMhs;
						$this->main_lib->getTemplate('berita-acara/form-create', $data);
						return false;
					} else {
						$uploads = $this->clouds->save($parafMhs, 'paraf-mhs');
						$getPostData['paraf_mhs'] = $uploads;
					}

				}

				//Insert parent table
				$insert = $this->BeritaAcara->insert($getPostData);

				$IdBeritaAcara = $this->BeritaAcara->getLastInsertId('id_berita_acara');
				if (isset($_FILES['bukti_kegiatan']) && count($_FILES['bukti_kegiatan']['name']) > 0) {
					$fileCount = count($_FILES['bukti_kegiatan']['name']);

					for ($i = 0; $i < $fileCount; $i++) {

						//Define new $_FILES array - $_FILES['file']
						$_FILES['file']['name'] = $_FILES['bukti_kegiatan']['name'][$i];
						$_FILES['file']['type'] = $_FILES['bukti_kegiatan']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['bukti_kegiatan']['tmp_name'][$i];
						$_FILES['file']['error'] = $_FILES['bukti_kegiatan']['error'][$i];
						$_FILES['file']['size'] = $_FILES['bukti_kegiatan']['size'][$i];

						$myConfig = $this->uploadConfig;
						$myConfig['upload_path'] = './uploads/bukti-kegiatan/';
						$this->upload->initialize($myConfig);

						if ($this->upload->do_upload('file')) {
							$uploadData = $this->upload->data();

							$fileName = $uploadData['file_name'];
							$fileType = $uploadData['file_type'];
							$fileLocation = 'uploads/bukti-kegiatan/' . $fileName;

							$uploads = $this->clouds->save($fileLocation, 'foto-kegiatan');

							$buktiKegiatanData = [
								'id_berita_acara' => $IdBeritaAcara,
								'nama_file' => $fileName,
								'jenis_file' => $fileType,
								'lokasi' => $uploads
							];

							$this->BuktiKegiatan->insert($buktiKegiatanData);
						}

					}
				}

				if ($insert) {
					$messages = setArrayMessage('success', 'insert', 'berita acara');
				} else {
					$messages = setArrayMessage('error', 'insert', 'berita acara');
				}

				$this->session->set_flashdata('message', $messages);
				redirect(base_url('berita-acara'), 'refresh');
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

		if(!$beritaAcara || $id_berita_acara == '') {
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
		];

		if (isset($_POST['update'])) {
			$rules = $this->_rules();
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_error_delimiters("<small class='form-text text-danger'>", "</small>");

			if ($this->form_validation->run() === FALSE) {
				$this->main_lib->getTemplate('berita-acara/form-update', $data);
			} else {
				$getPostData = $this->getPostData();

				//Proccess upload
				if (isset($_FILES['paraf_mhs']) && $_FILES['paraf_mhs']['name'] !== '') {
					$parafMhs = $this->_doUpload('paraf_mhs');

					if (is_array($parafMhs)) {
						$data['err_upload'] = $parafMhs;
						$this->main_lib->getTemplate('berita-acara/form-create', $data);
						return false;
					} elseif(is_string($parafMhs)) {
						$getPostData['paraf_mhs'] = $parafMhs;

						unlink(FCPATH . $beritaAcara->paraf_mhs);
					}
				}

				$update = $this->BeritaAcara->update($getPostData, [
					'id_berita_acara' => $id_berita_acara
				]);

				if (isset($_FILES['bukti_kegiatan']) && count($_FILES['bukti_kegiatan']['name']) > 0) {
					$fileCount = count($_FILES['bukti_kegiatan']['name']);

					//Get all bukti kegiatan
//					$buktiKegiatan = $this->BuktiKegiatan->findById([
//						'id_berita_acara' => $id_berita_acara
//					], true);
//
//					foreach ($buktiKegiatan as $bukti) {
//						if(file_exists(FCPATH . $bukti->lokasi)) {
//							//Delte uploaded file
//							unlink(FCPATH . $bukti->lokasi);
//						}
//					}
//
//					//Delete old bukti kegiatan
//					$this->BuktiKegiatan->delete([
//						'id_berita_acara' => $id_berita_acara
//					]);

					for ($i = 0; $i < $fileCount; $i++) {
						//Define new $_FILES array - $_FILES['file']
						$_FILES['file']['name'] = $_FILES['bukti_kegiatan']['name'][$i];
						$_FILES['file']['type'] = $_FILES['bukti_kegiatan']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['bukti_kegiatan']['tmp_name'][$i];
						$_FILES['file']['error'] = $_FILES['bukti_kegiatan']['error'][$i];
						$_FILES['file']['size'] = $_FILES['bukti_kegiatan']['size'][$i];

						$myConfig = $this->uploadConfig;
						$myConfig['upload_path'] = './uploads/bukti-kegiatan/';
						$this->upload->initialize($myConfig);

						if ($this->upload->do_upload('file')) {
							$uploadData = $this->upload->data();

							$fileName = $uploadData['file_name'];
							$fileType = $uploadData['file_type'];
							$fileLocation = 'uploads/bukti-kegiatan/' . $fileName;

							$buktiKegiatanData = [
								'id_berita_acara' => $id_berita_acara,
								'nama_file' => $fileName,
								'jenis_file' => $fileType,
								'lokasi' => $fileLocation
							];

							//Insert new bukti kegiatan
							$this->BuktiKegiatan->insert($buktiKegiatanData);
						}
					}
				}

				if ($update) {
					$messages = setArrayMessage('success', 'update', 'berita acara');
				} else {
					$messages = setArrayMessage('error', 'update', 'berita acara');
				}

				$this->session->set_flashdata('message', $messages);
				redirect(base_url('berita-acara'), 'refresh');
			}
		} else {
			$this->main_lib->getTemplate("berita-acara/form-update", $data);
		}
	}

	public function delete($id_berita_acara = null)
	{
		if (isset($_POST['_method']) && $_POST['_method'] == "DELETE" && $id_berita_acara != '') {
			$data_id = $this->main_lib->getPost('data_id');
			$data_type = $this->main_lib->getPost('data_type');

			if ($data_id === $id_berita_acara && $data_type === 'berita-acara') {
				$beritaAcara = $this->BeritaAcara->findById([
					'id_berita_acara' => $data_id
				]);

				//Delete uplaoded file
				$parafMhsPath = FCPATH . $beritaAcara->paraf_mhs;
				if(file_exists($parafMhsPath)) {
					unlink($parafMhsPath);
				}

				$buktiKegiatan = $this->BuktiKegiatan->findById([
					'id_berita_acara' => $data_id
				], true);

				foreach ($buktiKegiatan as $bukti) {
					$buktiKegiatanPath = FCPATH . $bukti->lokasi;
					if(file_exists($buktiKegiatanPath)) {
						unlink($buktiKegiatanPath);
					}
				}

				//Delete children table
				$this->BuktiKegiatan->delete([
					'id_berita_acara' => $data_id
				]);

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

	public function detail($id_berita_acara = null)
	{
		$beritaAcara = $this->BeritaAcara->findById([
			'id_berita_acara' => $id_berita_acara
		]);

		if(!$beritaAcara || $id_berita_acara == '') {
			redirect(base_url('error'));
		}

		$buktiKegiatan = $this->BuktiKegiatan->findById([
			'id_berita_acara' => $id_berita_acara
		], true);

		$data = [
			'bap' => $beritaAcara,
			'dokumentasi' => $buktiKegiatan
		];

		$this->main_lib->getTemplate("berita-acara/detail", $data);
	}

	private function getPostData()
	{
		$jenisAplikasi = $this->main_lib->getPost('jenis_aplikasi');
		$jenisAplikasi = implode(",", $jenisAplikasi);

		$bentukMateri = $this->main_lib->getPost('bentuk_materi');
		$bentukMateri = implode(",", $bentukMateri);

		return [
			'id_jadwal' => $this->main_lib->getPost('id_jadwal'),
			'pertemuan_ke' => $this->main_lib->getPost('pertemuan_ke'),
			'jumlah_hadir' => $this->main_lib->getPost('jumlah_hadir'),
			'total_mahasiswa' => $this->main_lib->getPost('total_mahasiswa'),

			'jenis_aplikasi' => $jenisAplikasi,
			'bentuk_materi' => $bentukMateri,

			'file_materi' => $this->main_lib->getPost('file_materi'),
			'uraian_materi' => $this->main_lib->getPost('uraian_materi'),
			'ada_tugas' => $this->main_lib->getPost('penugasan'),
			'pokok_bahasan' => $this->main_lib->getPost('pokok_bahasan'),
			'nim' => $this->main_lib->getPost('nim'),
			'nama_mahasiswa' => $this->main_lib->getPost('nama_mahasiswa'),

			'paraf_dosen' => 'xx',
			'tanggal_realisasi' => $this->main_lib->getPost('tanggal'),
			'jam_mulai' => $this->main_lib->getPost('jam_mulai'),
			'jam_selesai' => $this->main_lib->getPost('jam_selesai'),
		];
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
//			[
//				'field' => 'jenis_aplikasi',
//				'label' => 'Aplikasi daring',
//				'rules' => 'required'
//			],
//			[
//				'field' => 'bentuk_materi',
//				'label' => 'Bentuk materi',
//				'rules' => 'required'
//			],
			[
				'field' => 'file_materi',
				'label' => 'File materi',
				'rules' => 'required'
			],
			[
				'field' => 'penugasan',
				'label' => 'Penugasan',
				'rules' => 'required'
			],
			[
				'field' => 'nim',
				'label' => 'NIM',
				'rules' => 'required'
			],
			[
				'field' => 'nama_mahasiswa',
				'label' => 'Nama mahasiswa',
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
			} else {
				return true;
			}
		} else {
			return false;
		}
	}

}

/* End of file Beritaacara.php */
