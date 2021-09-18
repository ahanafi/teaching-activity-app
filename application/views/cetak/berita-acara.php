<!doctype html>
<html lang="en">
<head>
	<title>Cetak Berita Acara Perkuliahan</title>
</head>
<style type="text/css">
	* {
		box-sizing: border-box;
	}

	body {
		margin: 0;
		padding: 0;
		font-family: Arial, Helvetica, sans-serif;
		font-size: 12px;
	}

	.align-middle {
		text-align: center;
		vertical-align: middle;
	}

	#header {
		margin-bottom: 30px;
		padding-bottom: 10px;
		font-size: 11px !important;
		border-bottom: 1px solid #333;
	}

	.text-center {
		text-align: center;
		vertical-align: middle;
	}

	.logo > img {
		width: 20%;
		position: absolute;
	}

	.kop-text {
		text-align: center;
		margin-bottom: 20px;
	}

	.kop-text > h2 {
		font-size: 13px !important;
	}

	h1, h2, h3, h4, h5, h6, p {
		margin: 0;
	}

	.text-center {
		text-align: center;
		vertical-align: middle;
	}

	.font-weight-bold {
		font-weight: bold !important;
	}

	table {
		border-spacing: 0 !important;
		width: 100%;
	}

	table tr td {
		border-spacing: 0 !important;
		border: 0.1px solid #777;
		vertical-align: bottom;
		padding: 10px;
	}

	table tr td:first-child{
		width: 130px !important;
	}

	.col-12 {
		width: 100%;
		margin-bottom: 10px;
	}

	.col-6 {
		width: 50%;
		float: left;
		margin-bottom: 10px;
	}

	.col-6 table {
		display: inline-table;
	}

	.bg-gray {
		background-color: #eaeaea;
	}

	.clear {
		float: none;
		clear: both;
	}
	#bukti-kegiatan{
	}
	#foto{
		border:1px solid #333;
		padding: 15px;
	}
	#foto img{
		position: relative;
		width: 100%;
		margin-bottom: 20px;
		max-height: 360px;
	}
</style>
<body>
<div id="header">
	<div class="logo">
		<img src="<?php echo 'assets/images/ucic.png'; ?>" alt="Logo UCIC">
	</div>
	<div class="kop-text">
		<h2>
			BERITA ACARA DAN MONITORING PERKULIAHAN/PRAKTIKUM <br>
			SEMESTER GANJIL TA. 2020/2021 <br>
			PROGRAM STUDI MANAJEMEN BISNIS
		</h2>
	</div>
</div>
<div id="content" style="margin-bottom: 13px;">
	<div class="col-6">
		<table class="table">
			<tr>
				<td class="bg-gray">Dosen pengampu</td>
				<td><?php echo namaDosen($bap->nama_dosen, $bap->gelar); ?></td>
			</tr>
			<tr>
				<td class="bg-gray">Mata kuliah</td>
				<td><?php echo $bap->nama_mata_kuliah; ?></td>
			</tr>
			<tr>
				<td class="bg-gray">Kelas / Semester</td>
				<td><?php echo $bap->kelas; ?></td>
			</tr>
			<tr>
				<td class="bg-gray">Jumlah SKS</td>
				<td><?php echo $bap->sks; ?></td>
			</tr>
			<tr>
				<td class="bg-gray">Hari / Tanggal</td>
				<td><?php echo $bap->tanggal_realisasi; ?></td>
			</tr>
			<tr>
				<td class="bg-gray">Waktu</td>
				<td><?php echo showJamKuliah($bap->jam_mulai, $bap->jam_selesai); ?></td>
			</tr>
			<tr>
				<td class="bg-gray">Jumlah mhs hadir</td>
				<td><?php echo $bap->jumlah_hadir . " dari " . $bap->total_mahasiswa; ?></td>
			</tr>
			<tr>
				<td class="bg-gray">Pertemuan ke-</td>
				<td><?php echo $bap->pertemuan_ke; ?></td>
			</tr>
			<tr>
				<td class="bg-gray">Aplikasi Daring</td>
				<td>
					<?php
					$index = 1;
					foreach (explode(", ", str_replace(" ", "", $bap->jenis_aplikasi)) as $appCode):
						echo $index . ". " . daringApps(strtoupper(trim($appCode))) . "<br>";
						$index++;
					endforeach;
					?>
				</td>
			</tr>
			<tr>
				<td class="bg-gray">Bentuk materi diberikan</td>
				<td>
					<?php
					$index = 1;
					foreach (explode(",", $bap->bentuk_materi) as $materialCode):
						echo $index . ". " . materialType(strtoupper(trim($materialCode))) . "<br>";
						$index++;
					endforeach;
					?>
				</td>
			</tr>
			<tr>
				<td class="bg-gray">Pemberian tugas</td>
				<td>
					<?php if ($bap->ada_tugas === 1): ?>
						<span>Ya</span> / <span><s>Tidak</s></span> <sup>*)</sup>
					<?php else: ?>
						<span><s>Ya</s></span> / <span>Tidak</span> <sup>*)</sup>
					<?php endif; ?>
				</td>
			</tr>
		</table>
	</div>
	<div class="col-6" style="margin-left: 10px;">
		<table class="table" style="width: 100%;">
			<tr>
				<td class="bg-gray align-middle" rowspan="3">Verifikasi Mahasiswa</td>
				<td>NIM</td>
				<td><?php echo $bap->nim ?? '-'; ?></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td><?php echo $bap->nama_mahasiswa ?? '-'; ?></td>
			</tr>
			<tr>
				<td>Tanda Tangan</td>
				<td class="text-center">
					<?php if (isset($bap->paraf_mhs) && $bap->paraf_mhs !== '' && file_exists(FCPATH . $bap->paraf_mhs)) : ?>
						<img src="<?php echo $bap->paraf_mhs; ?>" alt="" width="50px">
					<?php else: echo "-"; endif; ?>
				</td>
			</tr>
			<tr>
				<td class="bg-gray align-middle">Tanda tangan Dosen</td>
				<td colspan="2" class="text-center">
					<?php if (isset($bap->paraf_mhs) && $bap->paraf_mhs !== '' && file_exists(FCPATH . $bap->paraf_mhs)) : ?>
						<img src="<?php echo($bap->paraf_mhs); ?>" alt="" width="50px">
					<?php else: echo "-"; endif; ?>
				</td>
			</tr>
			<tr>
				<td class="bg-gray align-middle" rowspan="3">
					Monitoring perkuliahan <br>
					<i>(Disi oleh Ka. Prodi)</i>
				</td>
				<td>Tanggal Periksa</td>
				<td><?php echo $bap->tanggal_periksa ?? '-'; ?></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td><?php echo $bap->nama_pemeriksa ?? '-'; ?></td>
			</tr>
			<tr style="height: 100px !important;">
				<td>Tanda Tangan</td>
				<td>

				</td>
			</tr>
		</table>
	</div>
	<div class="clear"></div>
	<div class="col-12">
		<table class="table" style="width: 100%;">
			<tr>
				<td style="width: 150px;" class="bg-gray">Pokok Bahasan</td>
				<td><?php echo $bap->pokok_bahasan; ?></td>
			</tr>
			<tr>
				<td style="width: 120px;vertical-align: top;height: 410px;" class="bg-gray">Uraian Materi Bahasan</td>
				<td style="vertical-align: top;height: 410px;"><?php echo $bap->uraian_materi; ?></td>
			</tr>
		</table>
		<br>
		<div style="page-break-after:always;"></div>
		<div id="bukti-kegiatan">
			<table class="table" style="width: 100%;">
				<tr>
					<td class="bg-gray">
						Bukti Kegiatan (Screenshoots, Video, dll)
					</td>
				</tr>
			</table>
			<div id="foto">
				<?php foreach ($dokumentasi as $dok): ?>
					<?php if (file_exists(FCPATH . $dok->lokasi)): ?>
						<img src="<?php echo $dok->lokasi; ?>" alt="">
					<div style="page-break-after:initial;"></div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
</body>
</html>
