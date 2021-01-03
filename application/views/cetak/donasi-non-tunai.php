<!doctype html>
<html lang="en">
<head>
	<title>Cetak Kwitansi Donasi</title>
</head>
<style type="text/css">
	body {
		margin: 0;
		padding: 0;
		font-family: DejaVu Sans;
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
		margin-left: 150px;
	}

	h1, h2, h3, h4, h5, h6, p {
		margin: 0;
	}

	.sub-header {
		margin-bottom: 20px !important;
	}

	.sub-header > h3 {
		text-align: center;
		margin-bottom: 20px;
	}

	.box-ket table tr td:nth-child(1) {
		width: 120px;
	}

	.box-ket table tr td:nth-child(2) {
		width: 40px;
	}

	.text-center {
		text-align: center;
		vertical-align: middle;
	}

	.font-weight-bold {
		font-weight: bold !important;
	}

	table {
		width: 100%;
		border: none;
	}

	.table > tr > td {
		border-collapse: collapse;
		border: none;
		height: 30px;
		vertical-align: bottom;
	}

	.table > tr > td:first-child {
		width: 150px;
	}

	.table > tr > td:nth-child(2) {
		width: 10px;
	}

	.table tr td:last-child {
		border-bottom: 2px solid #333;
	}
</style>
<body>
<div id="header">
	<div class="logo">
		<img src="<?php echo 'assets/img/logo-gray.png'; ?>" alt="">
	</div>
	<div class="kop-text">
		<h2>GRAHA YATIM &amp; DHU'AFA</h2>
		<p>
			No. Telpon : (0231) 236999 <br>
			www.grahayatimdhuafa.or.id -- E-mail : Grahayatimdhuafa@Outlook.Com <br>
			Jl. Gelatik Raya No. 3 Kelurahan Larangan Kec. Harjamukti, Kota Cirebon - Jawa Barat
		</p>
	</div>
</div>
<div id="content" style="margin-bottom: 13px;">
	<h3 class="text-center">TANDA TERIMA DONASI</h3>
	<br>
	<table class="table">
		<tr>
			<td style="width: 180px;">Nomor</td>
			<td style="width: 10px;">:</td>
			<td><?php echo $donasi->nomor_kwitansi; ?></td>
		</tr>
		<tr>
			<td style="width: 180px;">Telah diterima dari</td>
			<td style="width: 10px;">:</td>
			<td><?php echo ($donasi->is_anonim == 0) ? $donatur->nama : "Hamba Allah"; ?></td>
		</tr>
		<tr>
			<td colspan="3" style="border:none;height: 30px;">Donasi non-tunai dengan rincian sebagai berikut:</td>
		</tr>
		<tr>
			<td colspan="3" style="border:none;">
				<table border="1" cellpadding="5" cellspacing="0">
					<thead>
					<tr>
						<th width="10px;">No.</th>
						<th>Nama Barang</th>
						<th width="50px">Jumlah</th>
						<th width="70px">Satuan</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($detail_donasi as $detail): ?>
						<tr>
							<td style="border-bottom: 1px;" class="text-center"><?php echo $nomor++; ?></td>
							<td style="border-bottom: 1px;"><?php echo $detail->nama_barang; ?></td>
							<td style="border-bottom: 1px;"><?php echo $detail->jumlah; ?></td>
							<td style="border-bottom: 1px;"><?php echo $detail->satuan; ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td style="border:0px;text-align: right;">
				____________________________, <?php echo date('d / m / Y'); ?>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td style="border:0px;text-align: right;height: 120px;padding-right: 70px;">
				( <?php echo getUser('nama_lengkap'); ?> )
			</td>
		</tr>
	</table>
	<p style="border-bottom: 1px dashed;margin-top: 10px;text-align: center;font-style: italic;">Gunting disini</p>
</div>
<div id="header">
	<div class="logo">
		<img src="<?php echo 'assets/img/logo-gray.png'; ?>" alt="">
	</div>
	<div class="kop-text">
		<h2>GRAHA YATIM &amp; DHU'AFA</h2>
		<p>
			No. Telpon : (0231) 236999 <br>
			www.grahayatimdhuafa.or.id -- E-mail : Grahayatimdhuafa@Outlook.Com <br>
			Jl. Gelatik Raya No. 3 Kelurahan Larangan Kec. Harjamukti, Kota Cirebon - Jawa Barat
		</p>
	</div>
</div>
<div id="content">
	<h3 class="text-center">TANDA TERIMA DONASI</h3>
	<br>
	<table class="table">
		<tr>
			<td style="width: 180px;">Nomor</td>
			<td style="width: 10px;">:</td>
			<td><?php echo $donasi->nomor_kwitansi; ?></td>
		</tr>
		<tr>
			<td style="width: 180px;">Telah diterima dari</td>
			<td style="width: 10px;">:</td>
			<td><?php echo ($donasi->is_anonim == 0) ? $donatur->nama : "Hamba Allah"; ?></td>
		</tr>
		<tr>
			<td colspan="3" style="border:none;height: 30px;">Donasi non-tunai dengan rincian sebagai berikut:</td>
		</tr>
		<tr>
			<td colspan="3" style="border:none;">
				<table border="1" cellpadding="5" cellspacing="0">
					<thead>
					<tr>
						<th width="10px;">No.</th>
						<th>Nama Barang</th>
						<th width="50px">Jumlah</th>
						<th width="70px">Satuan</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($detail_donasi as $detail): ?>
						<tr>
							<td style="border-bottom: 1px;" class="text-center"><?php echo $nomor++; ?></td>
							<td style="border-bottom: 1px;"><?php echo $detail->nama_barang; ?></td>
							<td style="border-bottom: 1px;"><?php echo $detail->jumlah; ?></td>
							<td style="border-bottom: 1px;"><?php echo $detail->satuan; ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td style="border:0px;text-align: right;">
				____________________________, <?php echo date('d / m / Y'); ?>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td style="border:0px;text-align: right;height: 120px;padding-right: 70px;">
				( <?php echo getUser('nama_lengkap'); ?> )
			</td>
		</tr>
	</table>

</div>
</body>
</html>
