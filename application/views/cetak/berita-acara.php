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

	table tr td:first-child {
		width: 130px !important;
		text-align: left !important;
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

	#bukti-kegiatan {
	}

	#foto {
		border: 1px solid #333;
		padding: 15px;
	}

	#foto img {
		position: relative;
		width: 100%;
		margin-bottom: 20px;
		max-height: 360px;
	}
	.table-verifikasi tr td[rowspan='5'] {
		width: 80px !important;
		text-align: center !important;
	}
	.table-verifikasi tr td:nth-child(1) {
		width: 90px !important;
		text-align: left !important;
		vertical-align: middle !important;
	}
	table tr td img{
		max-width: 100px !important;
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
			SEMESTER <?php echo $tahun_akademik->semester_akademik ?> TA. <?php echo $tahun_akademik->tahun ?> <br>
			PROGRAM STUDI <?php echo strtoupper($program_studi->nama_program_studi) ?>
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
				<td><?php echo $bap->jumlah_hadir . " dari " . $bap->total_mahasiswa; ?> Mahasiswa</td>
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
					foreach (explode(",", str_replace(" ", "", $bap->jenis_aplikasi)) as $appCode):
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
			<tr>
				<td class="bg-gray">Tanda tangan dosen</td>
				<td>
					<?php if ($paraf_dosen !== null && file_exists(FCPATH . $paraf_dosen)): ?>
						<img src="<?php echo $paraf_dosen; ?>" alt="Paraf Dosen">
					<?php else: echo '-'; endif; ?>
				</td>
			</tr>
		</table>
	</div>
	<div class="col-6" style="margin-left: 10px;">
		<table class="table table-verifikasi" style="width: 100%;">
			<tr>
				<td class="bg-gray align-middle" rowspan="5">Verifikasi Mahasiswa</td>
				<td>NIM</td>
				<td><?php echo $verifikasi->nim ?? '-'; ?></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td><?php echo $verifikasi->nama_mahasiswa ?? '-'; ?></td>
			</tr>
			<tr>
				<td>Tanda Tangan</td>
				<td>
					<?php if (isset($verifikasi->nim) && $verifikasi->paraf_mahasiswa !== '' && file_exists(FCPATH . $verifikasi->paraf_mahasiswa)): ?>
						<img src="<?php echo $verifikasi->paraf_mahasiswa; ?>"
							 alt="Paraf Mahasiswa">
					<?php else: echo "-"; endif; ?>
				</td>
			</tr>
			<tr>
				<td>Kesesuaian RPS</td>
				<td class="text-center">
					<?php echo isset($verifikasi) && $verifikasi->sesuai_rps_mahasiswa !== 0 ? 'Sesuai' : 'Tidak'; ?>
				</td>
			</tr>
			<tr>
				<td>Catatan</td>
				<td class="text-center">
					<?php echo $verifikasi->catatan_mahasiswa ?? ''; ?>
				</td>
			</tr>
			<tr>
				<td class="bg-gray align-middle" rowspan="5">
					Monitoring perkuliahan <br>
					<i>(Disi oleh Ka. Prodi)</i>
				</td>
				<td>Tanggal Periksa</td>
				<td><?php echo $verifikasi->tanggal_periksa ?? '-'; ?></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td><?php echo isset($verifikasi) && $verifikasi->nidn_verifikator !== null ? namaDosen($verifikasi->nama_dosen, $verifikasi->gelar) : '-'; ?></td>
			</tr>
			<tr>
				<td>Tanda Tangan</td>
				<td>
					<?php if (isset($verifikasi->nidn_verifikator) && $verifikasi->paraf_dosen !== '' && file_exists(FCPATH . $verifikasi->paraf_dosen)): ?>
						<img src="<?php echo $verifikasi->paraf_dosen; ?>"
							 alt="Paraf Pemeriksa">
					<?php else: echo "-"; endif; ?>
				</td>
			</tr>
			<tr>
				<td>Kesesuaian RPS</td>
				<td>
					<?php echo isset($verifikasi) ? ($verifikasi->sesuai_rps_kaprodi !== 0 ? 'Sesuai' : 'Tidak') : '-'; ?>
				</td>
			</tr>
			<tr>
				<td>Catatan</td>
				<td>
					<?php echo isset($verifikasi) ? $verifikasi->catatan_kaprodi : '-'; ?>
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
				<td style="width: 120px;vertical-align: top;" class="bg-gray">Uraian Materi Bahasan</td>
				<td style="vertical-align: top;"><?php echo $bap->uraian_materi; ?></td>
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
