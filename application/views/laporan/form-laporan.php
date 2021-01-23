<div class="main-panel">
    <div class="content-wrapper">
        <!-- Page Title Header Starts-->
        <?php echo showPageHeader('Cetak Laporan'); ?>
        <!-- Page Title Header Ends-->
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header header-sm d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Form Laporan</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url('laporan/generate'); ?>" class="form-sample" method="POST"
                              enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-8 offset-2">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Filter Hari</label>
                                        <div class="col-sm-8">
                                            <select name="hari" required class="form-control select2">
                                                <option value="all_days">Semua Hari</option>
                                                <?php foreach ($list_hari as $hari): ?>
                                                    <option <?php echo (set_value('hari') == $hari) ? "selected" : ""; ?>
                                                        value="<?php echo $hari; ?>"><?php echo $hari; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Filter Dosen</label>
                                        <div class="col-sm-8">
                                            <select name="id_dosen" required class="form-control select2">
                                                <option value="all_dosen">Semua Dosen</option>
                                                <?php foreach ($dosen as $dosen): ?>
                                                    <option <?php echo (set_value('id_dosen') == $dosen->id_dosen) ? "selected" : ""; ?>
                                                        value="<?php echo $dosen->id_dosen; ?>"><?php echo namaDosen($dosen->nama_lengkap, $dosen->gelar); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
									<?php if(getUser("level") == 'SUPER_USER'): ?>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Filter Program Studi</label>
                                        <div class="col-sm-8">
                                            <select name="id_program_studi" id="" class="form-control select2">
                                                <option value="all_prodi">Semua Program Studi</option>
                                                <?php foreach ($program_studi as $prodi): ?>
                                                    <option <?php echo (set_value('id_program_studi') === $prodi->id_program_studi) ? "selected" : ""; ?>
                                                        value="<?php echo $prodi->id_program_studi; ?>"><?php echo $prodi->jenjang . " - " . $prodi->nama_program_studi; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
									<?php elseif(getUser('level') == 'KAPRODI'):?>
										<input type="hidden" name="id_program_studi" value="<?php echo getUser('id_program_studi'); ?>">
									<?php endif; ?>
									<div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Filter Temu Kuliah</label>
                                        <div class="col-sm-8">
                                            <select name="pertemuan" class="form-control select2">
                                                <option value="all">Semua Pertemuan</option>
                                                <?php for($mggu = 1; $mggu<=14; $mggu++): ?>
                                                    <option <?php echo (set_value('pertemuan') === $mggu) ? "selected" : ""; ?>
                                                        value="<?php echo $mggu; ?>"><?php echo "Temu ke - " . $mggu; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row text-right">
                                        <div class="col-sm-8 offset-3">
                                            <button class="btn btn-fw btn-success" type="submit" name="submit">
                                                <i class="fa fa-print"></i>
                                                <span>CETAK</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php if (isset($_POST['submit'], $berita_acara)): ?>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header header-sm d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Daftar Berita Acara Perkuliahan</h4>
                            <form method="POST" action="<?php echo base_url('laporan/berita-acara/excel'); ?>" target="_blank">
                                <input type="hidden" name="hari" value="<?php echo $selected_hari; ?>" />
                                <input type="hidden" name="id_dosen" value="<?php echo $id_dosen; ?>" />
                                <input type="hidden" name="id_program_studi" value="<?php echo $id_program_studi; ?>" />
								<input type="hidden" name="pertemuan" value="<?php echo $temu_kuliah; ?>" />
                                <button type="submit" name="export" class="ml-auto btn btn-outline-success btn-fw">
                                    <i class="fa fa-file-excel-o"></i>
                                    <span>Export Excel</span>
                                </button>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr class="enable-border">
                                        <th class="align-middle text-center" rowspan="2">No.</th>
                                        <th class="align-middle text-center" rowspan="2">Hari</th>
                                        <th class="align-middle text-center" rowspan="2">Nama Dosen</th>
                                        <th class="align-middle text-center" rowspan="2">Mata Kuliah</th>
                                        <th class="align-middle text-center" rowspan="2">SKS</th>
                                        <th class="align-middle text-center" rowspan="2">Waktu</th>
                                        <th class="align-middle text-center" rowspan="2">SMT</th>
                                        <th class="align-middle text-center" rowspan="2">Temu Ke</th>
                                        <th class="align-middle text-center" rowspan="2">Jumlah Mhs</th>
                                        <th class="align-middle text-center" rowspan="2">Jumlah Hadir</th>
                                        <th class="align-middle text-center" colspan="4">Aplikasi</th>
                                        <th class="align-middle text-center" colspan="5">Materi</th>
                                        <th class="align-middle text-center" colspan="2">Bukti Kehadiran</th>
                                        <th class="align-middle text-center" rowspan="2">Keterangan</th>
                                    </tr>
                                    <tr class="enable-border">
                                        <th class="align-middle text-center">Edmodo</th>
                                        <th class="align-middle text-center">ZOOM</th>
                                        <th class="align-middle text-center">YouTube</th>
                                        <th class="align-middle text-center">WAG</th>

                                        <th class="align-middle text-center">DOC</th>
                                        <th class="align-middle text-center">PPT</th>
                                        <th class="align-middle text-center">PDF</th>
                                        <th class="align-middle text-center">Video</th>
                                        <th class="align-middle text-center">Lainnya</th>

                                        <th class="align-middle text-center">Screenshoot</th>
                                        <th class="align-middle text-center">Tugas</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (count($berita_acara) > 0) : ?>
                                        <?php foreach ($berita_acara as $bap): ?>
                                            <tr>
                                                <td><?php echo $nomor++; ?></td>
                                                <td><?php echo $bap->hari; ?></td>
                                                <td>
                                                    <?php echo namaDosen($bap->dosen, $bap->gelar); ?>
                                                </td>
                                                <td><?php echo $bap->mata_kuliah; ?></td>
                                                <td><?php echo $bap->sks; ?></td>
                                                <td>
                                                    <?php echo showJamKuliah($bap->jam_mulai, $bap->jam_selesai); ?>
                                                </td>
                                                <td><?php echo $bap->semester; ?></td>
                                                <td><?php echo $bap->pertemuan_ke; ?></td>
                                                <td><?php echo $bap->total_mahasiswa; ?></td>
                                                <td><?php echo $bap->jumlah_hadir; ?></td>

                                                <td class="text-center">
                                                    <?php echo (in_array("EDMODO", explode(",", strtoupper($bap->jenis_aplikasi)))) ? "V" : "-"; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo (in_array("ZOOM", explode(",", strtoupper($bap->jenis_aplikasi)))) ? "V" : "-"; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo (in_array("YOUTUBE", explode(",", strtoupper($bap->jenis_aplikasi)))) ? "V" : "-"; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo (in_array("WA_GROUP", explode(",", strtoupper($bap->jenis_aplikasi)))) ? "V" : "-"; ?>
                                                </td>

                                                <td class="text-center">
                                                    <?php echo (in_array("DOC", explode(",", strtoupper($bap->jenis_aplikasi)))) ? "V" : "-"; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo (in_array("PPT", explode(",", strtoupper($bap->jenis_aplikasi)))) ? "V" : "-"; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo (in_array("PDF", explode(",", strtoupper($bap->jenis_aplikasi)))) ? "V" : "-"; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo (in_array("WA_GROUP", explode(",", strtoupper($bap->jenis_aplikasi)))) ? "V" : "-"; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo (in_array("WA_GROUP", explode(",", strtoupper($bap->jenis_aplikasi)))) ? "V" : "-"; ?>
                                                </td>

                                                <td><?php echo $bap->ada_bukti; ?></td>
                                                <td><?php echo ($bap->ada_tugas == 1) ? "V" : ""; ?></td>
                                                <td><?php echo $bap->tanggal_realisasi; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="22" class="text-center font-weight-light">
                                                <span class="font-italic">Data tidak ditemukan.</span>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <!-- content-wrapper ends -->
