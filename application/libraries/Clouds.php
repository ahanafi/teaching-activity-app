<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

class Clouds
{

	protected $cloudinary = null;
	protected $config = null;

	public function __construct()
	{
		$this->config = Configuration::instance([
			'cloud' => [
				'cloud_name' => 'si-dosen',
				'api_key' => '799394317817775',
				'api_secret' => '7vzHNPrwLXzvtBI8GaRQfkpog3M',
			],
			'secure' => true
		]);
		$this->cloudinary = new Cloudinary($this->config);
	}

	public function getResources()
	{
		$adminApi = $this->cloudinary->adminApi();
		$assets = $adminApi->assets();
		return $assets['resources'];
	}

	public function save($files, $folderName)
	{
		try {
			$uploadCloud = (new UploadApi())->upload($files, [
				'folder' => $folderName
			]);
			return $uploadCloud['secure_url'];
		} catch (\Cloudinary\Api\Exception\ApiError $e) {
			echo "Error: " . $e->getMessage();
		}
	}

}
