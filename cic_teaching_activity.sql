-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 27, 2021 at 02:22 PM
-- Server version: 8.0.22-0ubuntu0.20.04.3
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cic_teaching_activity`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita_acara`
--

CREATE TABLE `berita_acara` (
  `id_berita_acara` int NOT NULL,
  `id_jadwal` int NOT NULL,
  `pertemuan_ke` int NOT NULL,
  `jumlah_hadir` int UNSIGNED NOT NULL,
  `total_mahasiswa` int UNSIGNED NOT NULL,
  `jenis_aplikasi` varchar(100) NOT NULL,
  `bentuk_materi` varchar(100) NOT NULL,
  `file_materi` varchar(100) NOT NULL,
  `uraian_materi` mediumtext NOT NULL,
  `ada_tugas` tinyint(1) NOT NULL DEFAULT '0',
  `pokok_bahasan` longtext NOT NULL,
  `nim` varchar(30) NOT NULL,
  `nama_mahasiswa` varchar(100) DEFAULT NULL,
  `paraf_mhs` varchar(100) NOT NULL,
  `paraf_dosen` varchar(100) NOT NULL,
  `sudah_diperiksa` tinyint(1) NOT NULL DEFAULT '0',
  `nama_pemeriksa` varchar(100) DEFAULT NULL,
  `tanggal_periksa` date DEFAULT NULL,
  `ttd_pemeriksa` varchar(100) DEFAULT NULL,
  `is_pindah_jadwal` tinyint(1) NOT NULL DEFAULT '0',
  `tanggal_realisasi` date DEFAULT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `berita_acara`
--

INSERT INTO `berita_acara` (`id_berita_acara`, `id_jadwal`, `pertemuan_ke`, `jumlah_hadir`, `total_mahasiswa`, `jenis_aplikasi`, `bentuk_materi`, `file_materi`, `uraian_materi`, `ada_tugas`, `pokok_bahasan`, `nim`, `nama_mahasiswa`, `paraf_mhs`, `paraf_dosen`, `sudah_diperiksa`, `nama_pemeriksa`, `tanggal_periksa`, `ttd_pemeriksa`, `is_pindah_jadwal`, `tanggal_realisasi`, `jam_mulai`, `jam_selesai`) VALUES
(6, 2, 8, 20, 32, 'zoom,wa_group,edmodo', 'ppt', 'Pengantar E-Commerce', '<p xss=removed><b>Apa itu ecommerce?</b></p><p xss=removed>Electronic commerce atau ecommerce adalah segala aktivitas jual beli yang dilakukan melalui media elektronik. Meskipun sarananya meliputi televisi dan telepon, kini ecommerce lebih sering terjadi melalui internet.</p><p xss=removed>Oleh karena pengertian tersebut, ada kesalahpahaman tentang ecommerce dan marketplace. Istilah ecommerce digunakan untuk mendeskripsikan semua transaksi yang memakai media elektronik.</p><p xss=removed><a rel=\"noreferrer noopener\" aria-label=\" (opens in a new tab)\" href=\"https://www.niagahoster.co.id/blog/marketplace-adalah/\" target=\"_blank\" xss=removed>Marketplace</a> sendiri adalah salah satu model ecommerce, di mana ia berfungsi sebagai perantara antara penjual dan pembeli. Penjual yang berdagang di marketplace hanya perlu meladeni pembelian. Semua aktivitas lain seperti pengelolaan website sudah diurus oleh platform tersebut.  Situs-situs seperti Shopee dan Lazada adalah dua contoh marketplace.</p>', 0, 'Pengertian E-Commerce, Jenis E-commerce, dll', '2018202121', 'Eka Nur Jannah', 'uploads/paraf-mhs/c5b2e000b786ec20c3fe9d4bd1efb8b0.png', 'xx', 0, NULL, NULL, NULL, 0, '2020-11-30', '07:30:00', '09:30:00'),
(7, 1, 8, 9, 11, 'zoom,wa_group,edmodo,lainnya,youtube', 'video, ppt', 'Sistem Akuntansi 01.pptx', '<p dir=\"ltr\" xss=removed><span xss=removed>Apa Itu Sistem Akuntansi</span></p><p dir=\"ltr\" xss=removed><span xss=removed>Sistem Akuntansi merupakan metode dan prosedur untuk mencatat dan melaporkan informasi keuangan perusahaan atau organisasi bisnis. Menurut Mulyadi (2013:3), sistem akuntansi adalah organisasi formulir, catatan, dan laporan yang dikoordinasi sedemikian rupa untuk menyediakan informasi keuangan yang dibutuhkan oleh manajemen dalam pengelolaan.</span></p>', 0, 'Sistem akuntansi', '2018219211', 'Andi Noerhan', 'uploads/paraf-mhs/3a5437eed01948599ff974ac096b040c.png', 'xx', 0, NULL, NULL, NULL, 0, '2020-11-30', '09:30:00', '11:30:00'),
(8, 4, 8, 28, 32, 'edmodo,', 'ppt', 'Pengantar Statistik', '<p xss=removed><font color=\"#000000\" xss=removed><b>Statistika dan bisnis </b>(tentunya pengambilan keputusan) adalah dua hal yang tidak dapat dipisahkan. Dalam bisnis, apapun bidang yang digeluti, tentu memerlukan berbagai perhitungan dan analisa dan akhirnya diperlukan untuk mengambil keputusan yang tepat dalam rangka peningkatan usaha ataupun untuk menyelesaikan berbagai permasalahan. Statistika memegang peranan yang penting dalam Bisnis, baik dalam penyusunan model, perumusan hipotesa, dalam pengembangan alat dan instrumen pengumpulan data, dalam penyusunan desain penelitian, dalam penentuan sampel dan dalam analisa data. Dalam banyak hal, pengolahan dan analisa data tidak luput dari penerapan teknik dan metode statistik tertentu, yang mana kehadirannya dapat memberikan dasar bertolak dalam menjelaskan hubungan-hubungan yang terjadi. Statistik dapat digunakan sebagai alat untuk mengetahui apakah hubungan kausalitas (sebab-akibat) antara dua atau lebih dari dua variabel benar-benar terkait secara benar dalam suatu kausalitas empiris (berdasarkan pengalaman) ataukah hubungan tersebut hanya bersifat random (acak) atau kebetulan saja.</font></p><p xss=removed><font color=\"#000000\" xss=removed>Statistika menyediakan teknik-teknik sederhana dalam mengklasifikasikan data serta dalam menyajikan data, sehingga data tersebut dapat lebih mudah dipahami. Statistika membantu pengambil keputusan dan peneliti dalam menyimpulkan apakah suatu perbedaan yang diperoleh benar-benar berbeda secara signifikan (nyata). Apakah kesimpulan yang diambil cukup representatif (dapat mewakili) untuk memberikan inferensi (yang disimpulkan) terhadap populasi tertentu. Teknik-teknik statistika juga dapat digunakan dalam pengujian hipotesa, mengingat tujuan penelitian pada umumnya adalah untuk menguji hipotesa-hipotesa yang telah dirumuskan, maka statistika membantuk manajer atau peneliti dalam mengambil keputusan untuk menerima atau menolak suatu hipotesa.</font></p>', 0, 'Pengantar Statistik', '2018219211', 'Eka Nur Jannah', 'uploads/paraf-mhs/7ef02499cb8d5dedfd703c162f3d2747.png', 'xx', 0, NULL, NULL, NULL, 0, '2020-11-30', '12:30:00', '14:30:00'),
(9, 3, 8, 23, 28, 'wa_group,edmodo,lainnya,', 'ppt', 'Pengantar TI temu 1', '<p xss=removed><span xss=removed>A.    Pengertian Teknologi Informasi</span><br xss=removed>Teknologi Informasi yaitu ilmu yang mencakup teknologi komunikasi untuk memproses, menyimpan data dan mengirimkan informasi melalui jalur komunikasi yang cepat.<br xss=removed>Adapun contoh alat teknologi informasi salah satunya yaitu komputer, peralatan yang berhubungan dengan komputer antara lain :</p><ul xss=removed><li xss=removed>Mesin serbaguna yang dapat dikontrol oleh program, gunanya untuk mengolah data menjadi informasi.</li><li xss=removed>Deretan intruksi yang digunakan untuk mengendalikan komputer.</li><li xss=removed>Bahan mentah bagi komputer.</li><li xss=removed>Bentuk data yang diolah.</li></ul><p xss=removed>Teknologi telekomunikasi yang berhubungan dengan komunikasi jarak jauh yaitu telepon, radio, dan televisi.</p>', 0, 'Pengertian Teknologi Informasi', '2018219221', 'Indra', 'uploads/paraf-mhs/57639a59715441b92930e173f99563f0.png', 'xx', 0, NULL, NULL, NULL, 0, '2020-11-30', '12:30:00', '14:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `bukti_kegiatan`
--

CREATE TABLE `bukti_kegiatan` (
  `id_bukti_kegiatan` int NOT NULL,
  `id_berita_acara` int DEFAULT NULL,
  `nama_file` varchar(100) NOT NULL,
  `jenis_file` varchar(100) NOT NULL,
  `lokasi` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bukti_kegiatan`
--

INSERT INTO `bukti_kegiatan` (`id_bukti_kegiatan`, `id_berita_acara`, `nama_file`, `jenis_file`, `lokasi`) VALUES
(9, 6, 'e93402ac62f2e96abbf7a8241996407b.jpg', 'image/jpeg', 'uploads/bukti-kegiatan/e93402ac62f2e96abbf7a8241996407b.jpg'),
(10, 6, 'ba22bc5839cab68cb63ab000518e1934.jpg', 'image/jpeg', 'uploads/bukti-kegiatan/ba22bc5839cab68cb63ab000518e1934.jpg'),
(11, 6, '179fefc060bef9e09b1aa456dc679b66.jpg', 'image/jpeg', 'uploads/bukti-kegiatan/179fefc060bef9e09b1aa456dc679b66.jpg'),
(12, 7, '155deae4454413c90ad6ac8012a5059b.jpg', 'image/jpeg', 'uploads/bukti-kegiatan/155deae4454413c90ad6ac8012a5059b.jpg'),
(13, 7, '3e6bb256e2417f41c5014d87ffa5e025.jpg', 'image/jpeg', 'uploads/bukti-kegiatan/3e6bb256e2417f41c5014d87ffa5e025.jpg'),
(14, 8, 'd841a0f4982bb837963d927ca7298b91.jpg', 'image/jpeg', 'uploads/bukti-kegiatan/d841a0f4982bb837963d927ca7298b91.jpg'),
(15, 8, 'b57b11308be7a69bde890b94cb6c032a.jpg', 'image/jpeg', 'uploads/bukti-kegiatan/b57b11308be7a69bde890b94cb6c032a.jpg'),
(16, 8, '52d0212dc494a33f42faa510828916df.jpg', 'image/jpeg', 'uploads/bukti-kegiatan/52d0212dc494a33f42faa510828916df.jpg'),
(19, 9, 'cb0c2dfdd4157e0f4070c6838ab6aa57.jpg', 'image/jpeg', 'uploads/bukti-kegiatan/cb0c2dfdd4157e0f4070c6838ab6aa57.jpg'),
(20, 9, 'c795ddf2236f1cdf4ffea34d559a04d8.jpg', 'image/jpeg', 'uploads/bukti-kegiatan/c795ddf2236f1cdf4ffea34d559a04d8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` int NOT NULL,
  `nidn` varchar(50) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT 'L',
  `id_program_studi` int NOT NULL,
  `gelar` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `paraf` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `nidn`, `nama_lengkap`, `jenis_kelamin`, `id_program_studi`, `gelar`, `paraf`) VALUES
(1, '0401037601', 'MARSANI ASFI', 'L', 2, 'M.Si', NULL),
(2, '0304098001', 'LENA MAGDALENA', 'P', 2, 'M.M.Si', NULL),
(3, '0409056401', 'CHANDRA LUKITA', 'L', 2, 'SE., MM.', NULL),
(4, '0420097705', 'MUHAMMAD HATTA', 'L', 2, 'S.Kom., M.Kom.', NULL),
(5, '0419118803', 'IVAN SUSANTO', 'L', 2, 'M.Kom', NULL),
(6, '0416089303', 'REZA ILYASA', 'L', 2, 'S.Kom., M.Kom.', NULL),
(7, '0405029203', 'RIFQI FAHRUDIN', 'L', 2, 'M.Kom', NULL),
(8, '0429037201', 'AMRONI', 'L', 7, 'SE., MM.', NULL),
(9, '0324078502', 'INGRID PANJAITAN', 'P', 7, 'SE., M.Sc., Ak., CA', NULL),
(10, '0419066401', 'SUDADI PRANATA', 'L', 7, 'SE., MSi.', NULL),
(11, '0425117406', 'SUWANDI', 'L', 8, 'SE., MM.', NULL),
(12, '0406039501', 'AAN KANIVIA', 'P', 6, 'SE., MAk.', NULL),
(13, '0429069203', 'YUNI AWALATURROHMAH SOLIHAH', 'P', 3, 'MPd.', NULL),
(14, '0412079401', 'ISTI RIANA DEWI', 'P', 5, 'SE., MM.', NULL),
(15, '0425017705', 'TAUFAN HUNEMAN', 'L', 5, 'SH., MH', NULL),
(16, '0404098405', 'GYTHA NURHANA DHEA PRAADHA GITAMA', 'P', 7, 'SE., MM.', NULL),
(17, '0410126904', 'VICTOR ASIH', 'L', 1, 'SI., MT', NULL),
(18, '0414117001', 'DEWI LAILY PURNAMASARI', 'P', 7, 'ST., MM', NULL),
(19, '0410069303', 'SITTA NUR HAJIJAH', 'P', 7, 'S.AB., MSi.,', NULL),
(20, '0427049005', 'NI WAYAN FITRIANA AYU LESTARI', 'P', 5, 'SE., MM.', NULL),
(21, '0404048407', 'WIDYA JATI LESTARI', 'P', 8, 'SE., MM.', NULL),
(22, '0412089203', 'DEWI ANGGUN PUSPITARINI', 'P', 6, 'SE., MAk.', NULL),
(23, '0421046705', 'R SULAIMAN', 'L', 7, 'S.Kom., MM', NULL),
(24, '0430087606', 'NOERROCHMANI ASWITA DIAN IRIJANTI MINTARSIH', 'P', 7, 'S.Sos., M.M', NULL),
(25, '0415108402', 'DEWI MAHARANI PURBASARI', 'P', 7, 'SE., M.Si', NULL),
(26, '0419016201', 'KOESBYANTORO', 'L', 7, 'SH', NULL),
(27, '0430127001', 'DANIEL KURNIASANTOSO', 'L', 7, 'S.E', NULL),
(28, '0427077804', 'KUSNADI', 'L', 1, 'M.Kom', NULL),
(29, '0418017301', 'RIDHO TAUFIQ SUBAGIO', 'L', 1, 'ST., M.Kom', NULL),
(30, '0425036903', 'PETRUS SOKIBI SUKANTO', 'L', 1, 'S.Kom., M.Kom.', NULL),
(31, '0427019401', 'ILWAN SYAFRINAL', 'L', 8, 'S.Kom., M.Kom.', NULL),
(32, '8847830017', 'RINALDI ADAM', 'L', 1, 'S.Si., M.Comp.', NULL),
(33, '0419089303', 'TIARA EKA PUTRI', 'P', 1, 'ST., M.Kom', NULL),
(34, '0426069401', 'WANDA ILHAM', 'L', 1, 'S.Kom., M.Kom.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id_fakultas` int NOT NULL,
  `kode_fakultas` varchar(10) NOT NULL,
  `nama_fakultas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id_fakultas`, `kode_fakultas`, `nama_fakultas`) VALUES
(1, 'FTI', 'Fakultas Teknologi dan Informasi'),
(2, 'FEB', 'Fakultas Ekonomi dan Bisnis');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int NOT NULL,
  `hari` enum('SENIN','SELASA','RABU','KAMIS','JUM''AT','SABTU','MINGGU') NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `id_mata_kuliah` int NOT NULL,
  `id_kelas` int NOT NULL,
  `id_dosen` int NOT NULL,
  `id_ruangan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `hari`, `jam_mulai`, `jam_selesai`, `id_mata_kuliah`, `id_kelas`, `id_dosen`, `id_ruangan`) VALUES
(1, 'SENIN', '09:30:00', '11:30:00', 158, 3, 8, 4),
(2, 'SENIN', '07:30:00', '09:30:00', 289, 2, 2, 7),
(3, 'SENIN', '12:30:00', '14:30:00', 183, 1, 6, 6),
(4, 'SENIN', '12:30:00', '14:30:00', 338, 2, 9, 7),
(5, 'SELASA', '07:30:00', '09:30:00', 31, 2, 16, 2),
(6, 'SELASA', '09:30:00', '11:30:00', 37, 3, 10, 5),
(7, 'SELASA', '09:30:00', '11:30:00', 133, 2, 11, 8),
(8, 'SELASA', '12:30:00', '14:30:00', 121, 1, 8, 2),
(9, 'SELASA', '12:30:00', '14:30:00', 137, 3, 12, 8),
(10, 'RABU', '07:30:00', '09:30:00', 46, 1, 14, 7),
(11, 'RABU', '09:30:00', '11:30:00', 13, 1, 10, 10),
(12, 'RABU', '12:30:00', '14:30:00', 41, 2, 13, 1),
(13, 'RABU', '12:30:00', '14:30:00', 38, 3, 14, 8),
(14, 'KAMIS', '07:30:00', '09:30:00', 36, 1, 10, 4),
(15, 'KAMIS', '07:30:00', '09:30:00', 40, 3, 16, 7),
(16, 'KAMIS', '09:30:00', '11:30:00', 220, 1, 13, 6),
(17, 'KAMIS', '09:30:00', '11:30:00', 32, 2, 10, 10),
(18, 'KAMIS', '12:30:00', '14:30:00', 1, 2, 8, 5),
(19, 'KAMIS', '12:30:00', '14:30:00', 190, 3, 13, 7),
(20, 'JUM\'AT', '09:30:00', '11:30:00', 121, 1, 8, 14),
(21, 'JUM\'AT', '13:30:00', '15:30:00', 54, 1, 19, 4),
(22, 'SABTU', '09:30:00', '11:30:00', 123, 1, 20, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int NOT NULL,
  `id_program_studi` int NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `semester` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `id_program_studi`, `nama_kelas`, `semester`) VALUES
(1, 7, 'MB-1', 1),
(2, 4, 'MB-1', 3),
(3, 7, 'MB-1', 5);

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id_mata_kuliah` int NOT NULL,
  `kode_mata_kuliah` varchar(20) NOT NULL,
  `nama_mata_kuliah` varchar(100) NOT NULL,
  `sks` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id_mata_kuliah`, `kode_mata_kuliah`, `nama_mata_kuliah`, `sks`) VALUES
(1, '271422', 'Praktikum Akuntansi (manual)', 2),
(2, '271406', 'Pengantar Akuntansi 1', 2),
(3, '271419', 'Akuntansi Biaya', 2),
(4, '271439', 'Analisa Laporan Keuangan', 2),
(5, '271432', 'Sistem Informasi Akuntansi', 2),
(6, '45186', 'Perangkat Lunak Akuntansi (zahir)', 2),
(7, '45018', 'Sistem Akuntansi 1', 2),
(8, '271435', 'Akuntansi Keuangan Menengah 2', 2),
(9, '3104', 'Aplikasi Software Akuntansi', 2),
(10, 'MB402', 'Promosi Dan Periklanan', 2),
(11, '271442', 'Magang Industri', 2),
(12, '271545', 'Aplikasi Software Akuntansi', 2),
(13, '271401', 'Pendidikan Agama', 2),
(14, '271414', 'Pengantar Akuntansi 2', 2),
(15, '271541', 'Tugas Akhir', 2),
(16, 'ACT 1301', 'Pengantar Akuntansi', 2),
(17, '3366', 'Aplikasi Software Akuntansi (myob)', 2),
(18, '1122', 'Pendidikan Pancasila Dan Kewarganegaraan', 2),
(19, '2202', 'Pendidikan Pancasila Dan Kewarganegaraan', 2),
(20, 'SI701', 'Praktikum Statistik Dan Analisa Bisnis', 2),
(21, 'MB501', 'Studi Kelayakan Bisnis', 2),
(22, '45058', 'Pendidikan Pancasila Dan Kewarganegaraan', 2),
(23, '271417', 'Statistik Bisnis', 2),
(24, '271416', 'E-commerce', 2),
(25, '271408', 'Pendidikan Kewarganegaraan', 2),
(26, '271434', 'Praktikum Statistik Bisnis (spss)', 2),
(27, '3120', 'Pendidikan Pancasila Dan Kewarganegaraan', 2),
(28, '4135', 'Kewirausahaan 1', 2),
(29, '46031', 'Pendidikan Pancasila Dan Kewarganegaraan', 2),
(30, '271531', 'Praktikum Statistik Bisnis', 2),
(31, '271418', 'Manajemen Keuangan 2', 2),
(32, '45126', 'Kewirausahaan 2', 2),
(33, '271431', 'Metodologi Penelitian', 2),
(34, '271410', 'Kewirausahaan 1', 2),
(35, '271413', 'Manajemen Keuangan 1', 2),
(36, 'MGB1301', 'Manajemen Ritel', 2),
(37, '271438', 'Seminar Bisnis', 2),
(38, '271437', 'Penganggaran Perusahaan', 2),
(39, '271405', 'Praktik Pengelolaan Teknologi Informasi', 2),
(40, '271436', 'Manajemen Mutu', 2),
(41, '271421', 'Bahasa Inggris Bisnis 3', 2),
(42, '271433', 'Bahasa Inggris Bisnis 5', 2),
(43, '271407', 'Bahasa Inggris Bisnis 1', 2),
(44, '271540', 'Tugas Akhir', 2),
(45, '271423', 'Kewirausahaan 2', 2),
(46, '271420', 'Manajemen Sumber Daya Manusia', 2),
(47, '45005', 'Pembangunan Karakter', 2),
(48, '271404', 'Pengantar Ilmu Ekonomi', 2),
(49, '271428', 'Manajemen Stratejik', 2),
(50, '271445', 'Praktikum Studi Kelayakan Bisnis', 2),
(51, '271446', 'Pasar Modal Dan Portofolio', 2),
(52, '271409', 'Manajemen Pemasaran', 2),
(53, '271538', 'Komunikasi Bisnis', 2),
(54, 'MGT 1302', 'Pengantar Bisnis', 2),
(55, '2209', 'Manajemen Proyek Perangkat Lunak', 2),
(56, '2243', 'Manajemen Proyek Perangkat Lunak - Tise', 2),
(57, '2145', 'Sistem Pakar', 2),
(58, '2151', 'Sistem Basis Data', 2),
(59, '2178', 'Pengantar Teknologi Informasi', 2),
(60, '2210', 'Sistem Terdistribusi', 2),
(61, '2224', 'Interaksi Manusia Dan Komputer - Se', 2),
(62, '2099', 'Struktur Data', 2),
(63, '2159', 'Perancangan Basis Data', 2),
(64, '2232', 'Interaksi Manusia Dan Komputer', 2),
(65, 'TI014004', 'Algoritma Dan Pemrograman', 2),
(66, 'TI014003', 'Arsitektur Dan Organisasi Komputer', 2),
(67, '3069', 'Kewirausahaan 2', 2),
(68, '2251', 'Komunikasi Data Dan Jaringan', 2),
(69, '2246', 'Riset Pustaka', 2),
(70, '2228', 'Jaringan Komputer 2 (konsep Routing)', 2),
(71, '2208', 'Testing Dan Implementasi Sistem', 2),
(72, '2248', 'Testing Dan Implementasi Sistem - Tise', 2),
(73, '2024', 'Rekayasa Perangkat Lunak 1', 2),
(74, '2169', 'Riset Pustaka', 2),
(75, '2231', 'Keamanan Jaringan', 2),
(76, '2029', 'Rekayasa Perangkat Lunak 2', 2),
(77, '2076', 'Arsitektur Dan Organisasi Komputer', 2),
(78, '2213', 'Sistem Keamanan Komputer', 2),
(79, '2030', 'Sistem Operasi', 2),
(80, '2081', 'Algoritma & Pemrograman 1', 2),
(81, '2242', 'Grafika Komputer Dan Pengolahan Citra', 2),
(82, '46148', 'Digital Grafis 2 (layouting)', 2),
(83, '46152', 'Visual Merchandising', 2),
(84, '2115', 'Tugas Akhir', 2),
(85, 'SI502', 'Grafis, Fotografi Dan Multimedia', 2),
(86, '2227', 'Teknologi Multimedia', 2),
(87, '2007', 'Pendidikan Agama', 2),
(88, '2207', 'Algoritma Dan Pemrograman 2', 2),
(89, '2188', 'Proyek Teknik Informatika', 2),
(90, '46010', 'Pendidikan Agama', 2),
(91, '2252', 'Kecerdasan Buatan', 2),
(92, '2002', 'Aljabar Linear Dan Matriks', 2),
(93, '45121', 'Pemrograman Visual 1', 2),
(94, '2200', 'Pemrograman Internet 1', 2),
(95, '2134', 'Tata Tulis Karya Ilmiah', 2),
(96, 'TI014001', 'Pemrograman Internet', 2),
(97, '46003', 'Pembangunan Karakter', 2),
(98, '2219', 'Rekayasa Aplikasi Internet', 2),
(99, '2042', 'Metode Penelitian', 2),
(100, '2010', 'Kalkulus 1', 2),
(101, '2245', 'Pemodelan Dan Simulasi', 2),
(102, '2125', 'Pembangunan Karakter', 2),
(103, '1077', 'Pembangunan Karakter', 2),
(104, 'SI503', 'Tata Kelola Ti', 2),
(105, '3073', 'Pembangunan Karakter', 2),
(106, '1043', 'Proyek Manajemen Informatika', 2),
(107, '2247', 'Jaringan Terdistribusi', 2),
(108, '271415', 'Pembangunan Karakter', 2),
(109, '1079', 'Sistem Informasi Manajemen', 2),
(110, '1033', 'Tugas Akhir', 2),
(111, '1001', 'Pendidikan Agama', 2),
(112, '2028', 'Logika Matematika', 2),
(113, '45160', 'Hukum Pajak', 2),
(114, '45046', 'Perpajakan', 2),
(115, 'ACP 1301', 'Pengantar Perpajakan', 2),
(116, '3343', 'Pengantar Manajemen', 2),
(117, '3082', 'Manajemen Keuangan', 2),
(118, '3372', 'Analisa Dan Laporan Keuangan', 2),
(119, '45017', 'Manajemen Keuangan', 2),
(120, '3057', 'Proyek Komputer Akuntansi', 2),
(121, '1164', 'Pengantar Akuntansi', 2),
(122, '1119', 'Pengantar Manajemen', 2),
(123, '1073', 'Pengantar Manajemen', 2),
(124, '45038', 'Akuntansi Biaya 2', 2),
(125, '3128', 'Bank Dan Lembaga-lembaga Keuangan', 2),
(126, 'MB502', 'Manajemen Sumber Daya Manusia', 2),
(127, '3133', 'Komputer Akuntansi Perbankan', 2),
(128, '3007', 'Pendidikan Agama', 2),
(129, '3059', 'Tugas Akhir', 2),
(130, '3362', 'Pasar Modal Dan Komoditi', 2),
(131, 'MB602', 'Manajemen Rantai Pasok Dan Hub. Pelanggan', 2),
(132, '45024', 'Akuntansi Biaya 1', 2),
(133, '3088', 'Akuntansi Biaya', 2),
(134, '3339', 'Praktek Akuntansi Perbankan 1', 2),
(135, '3337', 'Akuntansi Perbankan 1', 2),
(136, '3363', 'Praktek Akuntansi Perbankan 3 (mini Bank Lanjutan)', 2),
(137, '45016', 'Akuntansi Keuangan Menengah', 2),
(138, 'MB302', 'Sistem Informasi Akuntansi Dan Keuangan', 2),
(139, '45019', 'Praktek Akuntansi Keuangan 1', 2),
(140, '45003', 'Dasar Dasar Akuntansi 1', 2),
(141, '3361', 'Akuntansi Perbankan 2', 2),
(142, '3010', 'Praktek Akuntansi Manual', 2),
(143, '45026', 'Praktikum Akuntansi Keuangan 2', 2),
(144, '45084', 'Aplikasi Komputer Akuntansi (excel)', 2),
(145, 'MGT 1301', 'Pengantar Manajemen', 2),
(146, '3365', 'Manajemen Kredit Dan Resiko', 2),
(147, '3132', 'Hukum Bisnis &amp;amp; Bank', 2),
(148, '3367', 'Etika Bisnis', 2),
(149, '3369', 'Manajemen Keuangan', 2),
(150, '3071', 'Dasar Dasar Akuntansi 1', 2),
(151, '2193', 'Pemrograman Visual', 2),
(152, '2250', 'Pengembangan Aplikasi Mobile', 2),
(153, '2212', 'Pemrograman Berorientasi Objek (j2se)', 2),
(154, 'SI301', 'Manajemen & Administrasi Basis Data', 2),
(155, '3338', 'Pemrograman Akuntansi 1 (html + Css)', 2),
(156, '3368', 'Pemrograman Akuntansi 3 (php Database)', 2),
(157, '2241', 'Jaringan Komputer 1 (konsep Jaringan)', 2),
(158, '3083', 'Sistem Akuntansi 1', 2),
(159, '3089', 'Sistem Akuntansi 2', 2),
(160, '1127', 'Dasar Desain Grafis', 2),
(161, '1142', 'Storyboard', 2),
(162, '1180', 'Penulisan Ide Kreatif', 2),
(163, '46155', 'Dasar Desain', 2),
(164, '46147', 'Ilustrasi Digital', 2),
(165, '46143', 'Fotografi', 2),
(166, '46146', 'Gambar Desain', 2),
(167, '46082', 'Psikologi Persepsi', 2),
(168, '46161', 'Media Interaktif', 2),
(169, '46163', 'Advertising Copywriting', 2),
(170, '46167', 'Film Production', 2),
(171, '46168', 'Metoda  Produksi Grafika', 2),
(172, '1150', 'Sinematografi', 2),
(173, '46164', 'Manajemen Desain &amp; Creativepreneur', 2),
(174, '46020', 'Fotografi 2', 2),
(175, '1139', 'Desain Gambar Digital', 2),
(176, '1105', 'Fotografi 1', 2),
(177, '1140', 'Copywriting', 2),
(178, 'DKV013003', 'Bahasa Rupa', 2),
(179, 'DKV013001', 'Dasar Desain Grafis', 2),
(180, 'DKV012002', 'Basic Tipografi', 2),
(181, '46131', 'Etika Profesi', 2),
(182, '3044', 'Pengantar Teknologi Informasi', 2),
(183, '46008', 'Pengantar Teknologi Informasi', 2),
(184, '46166', 'Web Applied', 2),
(185, '46159', 'Digital Grafis 1 (adobe Ps+ai)', 2),
(186, '46028', 'Animasi 1 (2d Artist) - Flash', 2),
(187, '46165', 'Sosiologi Desain', 2),
(188, '46162', 'Digital Grafis 3 (desain Web)', 2),
(189, 'DKV013004', 'Computer Graphic For Graphic Design', 2),
(190, '1032', 'Bahasa Inggris 5', 2),
(191, '1021', 'Bahasa Inggris 3', 2),
(192, '2033', 'Bahasa Inggris 5', 2),
(193, '1007', 'Bahasa Inggris 1', 2),
(194, '3020', 'Bahasa Inggris 3', 2),
(195, '46118', 'Bahasa Inggris 3', 2),
(196, '3006', 'Bahasa Inggris 1', 2),
(197, '3034', 'Bahasa Inggris 5', 2),
(198, '45156', 'Bahasa Inggris 5', 2),
(199, '45006', 'Bahasa Inggris 1', 2),
(200, '46002', 'Bahasa Inggris 1', 2),
(201, '45120', 'Bahasa Inggris 3', 2),
(202, '2006', 'Bahasa Inggris 1', 2),
(203, '2080', 'Bahasa Inggris 3', 2),
(204, '45012', 'Bahasa Inggris 2', 2),
(205, '45091', 'Bahasa Inggris 4', 2),
(206, '2026', 'Bahasa Inggris 4', 2),
(207, '1026', 'Bahasa Inggris 4', 2),
(208, '46121', 'Bahasa Inggris 4', 2),
(209, '45176', 'Bahasa Inggris 6', 2),
(210, '46009', 'Bahasa Inggris 2', 2),
(211, '2039', 'Bahasa Inggris 6', 2),
(212, '2078', 'Bahasa Inggris 2', 2),
(213, '271430', 'Bahasa Inggris Bisnis 4', 2),
(214, '271412', 'Bahasa Inggris Bisnis 2', 2),
(215, '3013', 'Bahasa Inggris 2', 2),
(216, '3027', 'Bahasa Inggris 4', 2),
(217, '3040', 'Bahasa Inggris 6', 2),
(218, '1037', 'Bahasa Inggris 6', 2),
(219, '1014', 'Bahasa Inggris 2', 2),
(220, 'CIC 1102', 'General English', 2),
(221, 'UC01012002', 'Bahasa Inggris 1 (basic English)', 2),
(222, '46139', 'Audio Visual', 2),
(223, '46078', 'Sdkv 1', 2),
(224, '46005', 'Tinjauan Desain', 2),
(225, '46149', 'Semiotika Visual', 2),
(226, '1145', 'Videografi (adobe Premier)', 2),
(227, '46093', 'Kerja Profesi', 2),
(228, '46153', 'Sdkv 5', 2),
(229, '46154', 'Proposal Skripsi/ T.a', 2),
(230, '46151', 'Studio Desain Komunikasi Visual 3', 2),
(231, '46145', 'Tipografi Digital 1', 2),
(232, 'MB301', 'Inovasi Produk Dan Bisnis', 2),
(233, '46160', 'Estetika Visual Desain', 2),
(234, '46065', 'Skripsi', 2),
(235, '1157', 'Ilustrasi 1', 2),
(236, '46058', 'Sdkv 2', 2),
(237, '46158', 'Tipografi Digital 2 (kinetic)', 2),
(238, '46169', 'Sdkv 4 (imc)', 2),
(239, '46026', 'Audio Visual 1 (sinematografi)', 2),
(240, 'DKV012005', 'Estetika Visual Desain', 2),
(241, '1074', 'Kewirausahaan 2', 2),
(242, '2109', 'Kewirausahaan 1', 2),
(243, '46150', 'Entrepreneurship', 2),
(244, '3070', 'Kewirausahaan 3', 2),
(245, '3066', 'Kewirausahaan 1', 2),
(246, '2116', 'Kewirausahaan 2', 2),
(247, '46043', 'Kewirausahaan 1', 2),
(248, '1072', 'Kewirausahaan 1', 2),
(249, '1083', 'Kewirausahaan 3', 2),
(250, 'UC0103003', 'Pembangunan Karakter &amp; Etika Profesi', 2),
(251, 'UC01012003', 'Etika Dan Pengembangan Diri', 2),
(252, 'UC012003', 'Pembangunan Karakter &amp; Etika Profesi', 2),
(253, '45004', 'Matematika Bisnis', 2),
(254, '3072', 'Matematika Bisnis', 2),
(255, '271403', 'Matematika Bisnis', 2),
(256, 'SI703', 'Metodologi Penelitian', 2),
(257, '45050', 'Riset Pustaka', 2),
(258, '45051', 'Metodologi Penelitian', 2),
(259, '2223', 'Metode Numerik', 2),
(260, '45082', 'Algoritma & Pemrograman 2', 2),
(261, 'SI014004', 'Algoritma Dan Pemrograman (pascal-bahasa C)', 2),
(262, '1035', 'Manajemen Web Server', 2),
(263, '45180', 'Sistem Penunjang Keputusan', 2),
(264, 'SI702', 'Perencanaan Strategis Si/ti', 2),
(265, 'SI501', 'Infrastuktur  Teknologi Web', 2),
(266, '45131', 'Manajemen Proyek Sistem Informasi', 2),
(267, '45020', 'Sistem Basis Data', 2),
(268, '45157', 'Jaringan Komputer', 2),
(269, '2214', 'Administrasi Jaringan', 2),
(270, '2229', 'Pemrograman Jaringan', 2),
(271, '45178', 'Manajemen Keamanan Sistem Informasi', 2),
(272, '45130', 'Pemrograman Internet Lanjutan', 2),
(273, '45027', 'Perancangan Basis Data', 2),
(274, 'SI402', 'Pengembangan Aplikasi Web 2 (cms)', 2),
(275, 'SI605', 'Pengelola Sumber Daya E-goverment', 2),
(276, '45182', 'Enterprise Resource Planning', 2),
(277, '45119', 'Manajemen Sistem Informasi', 2),
(278, '45036', 'Sistem Informasi Akuntansi 1', 2),
(279, 'SI303', 'Analisis Dan Perancangan Sistem Informasi', 2),
(280, '3341', 'Tata Tulis Karya Ilmiah', 2),
(281, '4206', 'Etika Profesi', 2),
(282, '4208', 'Enterprise Resource Planning', 2),
(283, '46089', 'Metodologi Penelitian Desain', 2),
(284, '1162', 'Tata Tulis Karya Ilmiah', 2),
(285, '2164', 'Etika Profesi', 2),
(286, '45045', 'Sistem Informasi Akuntansi 2', 2),
(287, '45093', 'Proyek Sistem Informasi Akuntansi', 2),
(288, '45128', 'Analisa & Perancangan Sistem Informasi', 2),
(289, 'MB601', 'E-commerce', 2),
(290, '45071', 'Skripsi', 2),
(291, '45015', 'Pendidikan Agama', 2),
(292, '45041', 'Tata Tulis Karya Ilmiah', 2),
(293, '1062', 'Perancangan Sistem Informasi', 2),
(294, 'SI013002', 'Manajemen Dan Organisasi', 2),
(295, 'MB703', 'Sistem Pengambilan Keputusan Bisnis', 2),
(296, '3067', 'Sistem Informasi Manajemen', 2),
(297, 'LK601', 'Manajemen Perkantoran', 2),
(298, 'SI403', 'Manajemen Strategis Sistem Informasi', 2),
(299, '45090', 'Analisa Proses Bisnis', 2),
(300, '45158', 'Pemrograman Internet', 2),
(301, '45184', 'Pemrograman Web (html+css)', 2),
(302, 'SI014003', 'Sistem Dan Teknologi Informasi', 2),
(303, 'EKB 1202', 'Pengantar Teknologi Informasi Untuk Bisnis', 2),
(304, '45001', 'Pengantar Teknologi Informasi Si', 2),
(305, 'MI1089', 'Matematika Bisnis', 2),
(306, '1089', 'Matematika Bisnis', 2),
(307, '45056', 'Statistika Bisnis Lanjut', 2),
(308, '1179', 'Matematika Bisnis', 2),
(309, '1121', 'Statistik Bisnis', 2),
(310, '2035', 'Matematika Diskrit', 2),
(311, '2136', 'Statistik Probabilitas', 2),
(312, '45068', 'Statistika Bisnis', 2),
(313, 'MI013004', 'Matematika Informatika', 2),
(314, '1144', 'Prinsip Dasar Animasi', 2),
(315, '46087', 'Animasi', 2),
(316, 'MI1161', 'Komputer Grafis 5 ( Compositing + After Effect)', 2),
(317, '1141', 'Komputer Animasi 1 (m Flash)', 2),
(318, '1172', 'Multimedia 2 (3ds Max 2)', 2),
(319, '1130', 'Komputer Grafis 1 (coreldraw)', 2),
(320, '1159', 'Komputer Grafis 3 (adobe Ilustrator)', 2),
(321, '1173', 'Komputer Grafis 5 ( Compositing + After Effect)', 2),
(322, 'LK501', 'Manajemen Mutu', 2),
(323, '271411', 'Praktik Pengolahan Data', 2),
(324, '1151', 'Komputer Animasi 2 (action Script)', 2),
(325, '1147', 'Komputer Grafis 4 (layouting)', 2),
(326, '1169', 'Digital Animasi', 2),
(327, '1176', 'Komputer Grafis 6', 2),
(328, '1155', 'Multimedia 1 (3ds Max 1)', 2),
(329, '4192', 'Interaksi Manusia Dan Komputer', 2),
(330, 'MI014001', 'Algoritma Dan Pemrograman', 2),
(331, '1177', 'Keamanan Web', 2),
(332, '1163', 'Etika Bisnis', 2),
(333, '45083', 'Algoritma Dan Pemrograman 1', 2),
(334, 'MB701', 'Manajemen Proyek Bisnis', 2),
(335, '1097', 'Perancangan Basis Data', 2),
(336, '2016', 'Kalkulus 2', 2),
(337, 'SI604', 'Optimasi Web', 2),
(338, '3119', 'Statistik Bisnis', 2),
(339, 'SI013001', 'Matematika Bisnis', 2),
(340, 'TI012002', 'Aljabar Linier Dan Matrik', 2),
(341, '1080', 'Manajemen Proyek', 2),
(342, '1156', 'Analisa Sistem Informasi', 2),
(343, '1106', 'Ilmu Komunikasi', 2),
(344, '1110', 'E-bisnis', 2),
(345, '1158', 'Sistem Basis Data', 2),
(346, '45185', 'Pemrograman Internet 3', 2),
(347, 'SI302', 'Pengembangan Aplikasi Web 1', 2),
(348, '3127', 'Algoritma & Pemrograman', 2),
(349, '1087', 'Jaringan Komputer', 2),
(350, '1168', 'Web Programming 2 (php Database)', 2),
(351, '1152', 'Desain Web 2 (css)', 2),
(352, '2225', 'Pemrograman Berorientasi Objek (lanjut)', 2),
(353, '3364', 'Pemrograman Akuntansi 2 (php Dasar)', 2),
(354, 'MI013003', 'Desain Web (html+css+javascript)', 2),
(355, '1075', 'Pengantar Teknologi Informatika', 2),
(356, '1178', 'Optimasi Aplikasi Web', 2),
(357, '1136', 'Komputer Grafis 2 (photoshop)', 2),
(358, '3371', 'Pemograman Akuntansi 4 (studi Kasus)', 2),
(359, 'MI013002', 'Komputer Grafis 1', 2),
(360, 'AK202', 'Sistem Informasi Akuntansi', 2),
(361, 'AK403', 'Ketentuan Umum Dan Tata Cara Perpajakan', 2),
(362, 'MKB521S', 'Perpajakan', 2),
(363, 'MPB713A', 'Seminar Perpajakan', 2),
(364, 'AK308', 'Pajak Daerah', 2),
(365, 'MKB518A', 'Teori Akuntansi', 2),
(366, '271429', 'Dasar-dasar Perpajakan', 2),
(367, 'MKB625S', 'Perpajakan Lanjutan', 2),
(368, 'MKB415S', 'Akuntansi Sektor Publik', 2),
(369, '45010', 'Dasar Dasar Akuntansi 2', 2),
(370, '45023', 'Akuntansi Keuangan Lanjutan', 2),
(371, '3078', 'Dasar Dasar Akuntansi 2', 2),
(372, '271427', 'Akuntansi Keuangan Menengah 1', 2),
(373, 'UC01012001', 'Pendidikan Pancasila Dan Kewarganegaraan', 2),
(374, 'CIC 1101', 'Pendidikan Agama, Pancasila, Kewarganegaraan &amp; Nasionalisme', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int NOT NULL,
  `nama_lengkap` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `level` enum('KAPRODI','SUPER_USER','DOSEN') CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `id_dosen` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama_lengkap`, `username`, `password`, `level`, `id_dosen`) VALUES
(1, 'Ahmad Hanafi', 'ahanafi', '$2y$10$q9nJE3z2e28eF9zViGu7b.82M4oLoBnH0mm5O3SwGGg0L9Y50t336', 'SUPER_USER', NULL),
(3, 'MARSANI ASFI', '0401037601', '$2y$10$m/5HNequHkyhxfHtVoCRP..l6/YGAbfxjJaThidptFVXTNhFSRm7K', 'DOSEN', 1),
(4, 'LENA MAGDALENA', '0304098001', '$2y$10$SL9oTtrORXbBdnf04uhWMuFW.1HwbaVesZgpo9sDU1Ry.f43X9NMK', 'KAPRODI', 2),
(5, 'CHANDRA LUKITA', '0409056401', '$2y$10$NCMeIYN2kQ4nUMk.sElYwOwBLbRwPBli2Bj3mnRdALb2SeQPh5QFu', 'DOSEN', 3),
(6, 'MUHAMMAD HATTA', '0420097705', '$2y$10$lTHaTl5R0uBeY9ky3anK/O84MYH6YCDIEP71mw3232snwNfnScyqu', 'DOSEN', 4),
(7, 'IVAN SUSANTO', '0419118803', '$2y$10$3xfcDx4NevP6eVHW/bOs2eDyylIxgDmV9Hc1.GcAQboPpPd.DJAP2', 'DOSEN', 5),
(8, 'REZA ILYASA', '0416089303', '$2y$10$yZZ.9hGRpCjwKdcFfmt7Ru.JhGf90Z1q7/l6hoZxO8S38.sm0Pagy', 'DOSEN', 6),
(9, 'RIFQI FAHRUDIN', '0405029203', '$2y$10$Mz1h0aKXgZYK1AEFHZsSqOBFUfH3yGrWTlHRa2coumkYhv5y/xr0O', 'DOSEN', 7),
(10, 'AMRONI', '0429037201', '$2y$10$NpOpLGVUX43KhI86bTQIYONVuG9QYF4O4rnyzD.iNDei81QyylAzS', 'KAPRODI', 8),
(11, 'INGRID PANJAITAN', '0324078502', '$2y$10$qFhHOfH8PXkii4hENEan5OuZUUyq7D0mId3klnbAMi11g9g1.QyWe', 'DOSEN', 9),
(12, 'SUDADI PRANATA', '0419066401', '$2y$10$pQtnQ9TDPT1Yx6kwfi3R4Oc1WQFD7TalaX9Ic.HjMxO6JMZ60yDR.', 'DOSEN', 10),
(13, 'SUWANDI', '0425117406', '$2y$10$H9D6Qz.qQQJv27RQR2MdCe0O3FSp58gmegtz2kAwq3.OzY/Iy1Vei', 'DOSEN', 11),
(14, 'AAN KANIVIA', '0406039501', '$2y$10$vX9OJnh/Af1lhSvXZOfUOu.EghSr6TPgZ9LsqWJPpeoSHt1RVETIe', 'DOSEN', 12),
(15, 'YUNI AWALATURROHMAH SOLIHAH', '0429069203', '$2y$10$IVuhLv/CHLbhX9daqlpLE./kj5EeHR9jHW77Fy1fadOgY.ekNDh2.', 'DOSEN', 13),
(16, 'ISTI RIANA DEWI', '0412079401', '$2y$10$D.1KHmh4eei1Bj24Mr0Wbe9DkdvzEeNyT6NFIpn.gEyJ2FNhJ2H2C', 'DOSEN', 14),
(17, 'TAUFAN HUNEMAN', '0425017705', '$2y$10$0fftu3uAb8tLkKRi.KgCvOwzn21AR9.fqepXnlPOB3WsfUQd.OmEW', 'DOSEN', 15),
(18, 'GYTHA NURHANA DHEA PRAADHA GITAMA', '0404098405', '$2y$10$u8yVCMJ/8ibcDlA.e5QdVebp7BGfIWlaS3MAt5Uw8aDg5ifVSqQ..', 'DOSEN', 16),
(19, 'VICTOR ASIH', '0410126904', '$2y$10$w49GeSFiM1TyuWpwYxlgFe/X4DaDISalsY1VQ/BVs5KR20YlDaVvi', 'DOSEN', 17),
(20, 'DEWI LAILY PURNAMASARI', '0414117001', '$2y$10$b534NY.TvbMnGDUJvtkoGu5spAbJSNYet4mgBr8LbpLMJKI7BMs3K', 'DOSEN', 18),
(21, 'SITTA NUR HAJIJAH', '0410069303', '$2y$10$dnGPlHO1z1Til6ntmh2rleuT3fXmklagiRbsW89sZuf2FmUIZAwBS', 'DOSEN', 19),
(22, 'NI WAYAN FITRIANA AYU LESTARI', '0427049005', '$2y$10$NJI6MbTdqroxAx7eq1rTWOFT5pzmUtOQlNiK1mu7NASoo8OiEPQiW', 'DOSEN', 20),
(23, 'WIDYA JATI LESTARI', '0404048407', '$2y$10$MMO15We25.a9c2AmmiTdOuzTj1uZZBYk0KTWsdjolpeBulaHCadW.', 'DOSEN', 21),
(24, 'DEWI ANGGUN PUSPITARINI', '0412089203', '$2y$10$X0gVEodjVwv/15OB8qcXG.tj7dhTt//R9fadlmxyTf/k2DxYvFdWe', 'DOSEN', 22),
(25, 'R SULAIMAN', '0421046705', '$2y$10$5LKO0VVWCIMWiFYZ3fRD3OxnkG9RKsMy.lmgkG/oz4fBLVK6DlwoG', 'DOSEN', 23),
(26, 'NOERROCHMANI ASWITA DIAN IRIJANTI MINTARSIH', '0430087606', '$2y$10$qetAjkq8UotafPHUVSae0OE7ZuIH3Vxrk8m8muwkrpmK.oQqIZxwi', 'DOSEN', 24),
(27, 'DEWI MAHARANI PURBASARI', '0415108402', '$2y$10$QmyPdiI0KCzMFui2Gu9SxOmnxLPZ0fsA0IvH6cBlq5idTI/zcOWYW', 'DOSEN', 25),
(28, 'KOESBYANTORO', '0419016201', '$2y$10$e9ipKw.5oAOEUAwV.ylACebseuPXhXZpgZQip3Lh9tgCzbxBeqysG', 'DOSEN', 26),
(29, 'DANIEL KURNIASANTOSO', '0430127001', '$2y$10$iYfm0C2eBmyKr3QBN8D40eFe0eA8MQQ3s4.eqMd32/HN8TsflAB2K', 'DOSEN', 27),
(30, 'KUSNADI', '0427077804', '$2y$10$5CsmqBPYtq6rUZXG/54YGOFctpd08ZjmCNFCTYe8fp4G3nu0Dkq7.', 'KAPRODI', 28),
(31, 'RIDHO TAUFIQ SUBAGIO', '0418017301', '$2y$10$u4XZJTM.X9KCX6TSMEV0memdatQ4kYx8gWfcULI0yRVEL0JWsXsfq', 'DOSEN', 29),
(32, 'PETRUS SOKIBI SUKANTO', '0425036903', '$2y$10$bR8vsnyA/eEkLa4ce1gs..0QiNLF6soo/soAHfUhvOnMZjFBt6Kpq', 'DOSEN', 30),
(33, 'ILWAN SYAFRINAL', '0427019401', '$2y$10$RXeSYtj2qmxZnotCLPeIKujf0DRKkcjUgLr1fyBGOiN.FavI9oSg2', 'DOSEN', 31),
(34, 'RINALDI ADAM', '8847830017', '$2y$10$LZCgA7m5gSkDFvM12oDAfOBoTDa.tce33wprLOwxSeoz.4AzsuMJG', 'DOSEN', 32),
(35, 'TIARA EKA PUTRI', '0419089303', '$2y$10$h6q95WkzemYlUZ79.9.1jeCfPSviZPizsDRDYJ8SpggWonlSCeq/i', 'DOSEN', 33),
(36, 'WANDA ILHAM', '0426069401', '$2y$10$zQEKS/n4eA9ppjkcHVpFF.Ouf/xL6SffA2ZTHwrAibD5cFZ7CPkki', 'KAPRODI', 34);

-- --------------------------------------------------------

--
-- Table structure for table `profil_kampus`
--

CREATE TABLE `profil_kampus` (
  `id_profil_perusahaan` int NOT NULL,
  `nama_perusahaan` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `logo` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `telpon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `fax` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `website` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `profil_kampus`
--

INSERT INTO `profil_kampus` (`id_profil_perusahaan`, `nama_perusahaan`, `logo`, `telpon`, `fax`, `email`, `website`, `alamat`) VALUES
(3, 'CV PANCA CAHAYA SEJAHTERA', 'uploads/933dddde70b7e47a9526528ec9306ff4.png', '021-55910601', NULL, 'admin@cv-pancacahayasejahtera.com', 'cv-pancacahayasejahtera.com', 'PERGUDANGAN BANDARA BENDA PERMAI BLOK I NO 8');

-- --------------------------------------------------------

--
-- Table structure for table `program_studi`
--

CREATE TABLE `program_studi` (
  `id_program_studi` int NOT NULL,
  `kode_program_studi` varchar(10) NOT NULL,
  `id_fakultas` int NOT NULL,
  `jenjang` enum('D1','D2','D3','D4','S1','S2','S3') NOT NULL,
  `nama_program_studi` varchar(60) NOT NULL,
  `id_dosen` int DEFAULT NULL COMMENT 'Ketua Program Studi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `program_studi`
--

INSERT INTO `program_studi` (`id_program_studi`, `kode_program_studi`, `id_fakultas`, `jenjang`, `nama_program_studi`, `id_dosen`) VALUES
(1, '55201', 1, 'S1', 'Teknik Informatika', 28),
(2, '57201', 1, 'S1', 'Sistem Informasi', 2),
(3, '90241', 1, 'S1', 'Desain Komunikasi Visual', 28),
(4, '57401', 1, 'D3', 'Manajemen Informatika', 34),
(5, '61201', 2, 'S1', 'Manajemen', NULL),
(6, '62201', 2, 'S1', 'Akuntansi', NULL),
(7, '61405', 2, 'D3', 'Manajemen Bisnis', 8),
(8, '57402', 2, 'D3', 'Komputerisasi Akuntansi', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` int NOT NULL,
  `kode_ruangan` varchar(20) NOT NULL,
  `kapasitas` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id_ruangan`, `kode_ruangan`, `kapasitas`) VALUES
(1, '102', 40),
(2, '103', 35),
(3, '104', 28),
(4, '105', 30),
(5, '106', 32),
(6, '107', 32),
(7, '201', 40),
(8, '302', 40),
(9, '302-STUDIO', 10),
(10, 'AUDITORIUM', 128),
(11, 'LAB-1', 33),
(12, 'LAB-2', 20),
(13, 'LAB-3', 16),
(14, 'LAB-4', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tahun_akademik`
--

CREATE TABLE `tahun_akademik` (
  `id_tahun_akademik` int NOT NULL,
  `semester_akademik` enum('GANJIL','GENAP') DEFAULT 'GANJIL',
  `tahun` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tahun_akademik`
--

INSERT INTO `tahun_akademik` (`id_tahun_akademik`, `semester_akademik`, `tahun`) VALUES
(1, 'GANJIL', '2020/2021');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita_acara`
--
ALTER TABLE `berita_acara`
  ADD PRIMARY KEY (`id_berita_acara`),
  ADD KEY `berita_acara_ibfk_1` (`id_jadwal`);

--
-- Indexes for table `bukti_kegiatan`
--
ALTER TABLE `bukti_kegiatan`
  ADD PRIMARY KEY (`id_bukti_kegiatan`),
  ADD KEY `id_berita_acara` (`id_berita_acara`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`),
  ADD KEY `id_program_studi` (`id_program_studi`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id_fakultas`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_dosen` (`id_dosen`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `kode_mata_kuliah` (`id_mata_kuliah`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_program_studi` (`id_program_studi`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id_mata_kuliah`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_dosen` (`id_dosen`);

--
-- Indexes for table `profil_kampus`
--
ALTER TABLE `profil_kampus`
  ADD PRIMARY KEY (`id_profil_perusahaan`);

--
-- Indexes for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD PRIMARY KEY (`id_program_studi`),
  ADD KEY `id_fakultas` (`id_fakultas`),
  ADD KEY `id_dosen` (`id_dosen`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indexes for table `tahun_akademik`
--
ALTER TABLE `tahun_akademik`
  ADD PRIMARY KEY (`id_tahun_akademik`),
  ADD UNIQUE KEY `tahun_akademik_tahun_uindex` (`tahun`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita_acara`
--
ALTER TABLE `berita_acara`
  MODIFY `id_berita_acara` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bukti_kegiatan`
--
ALTER TABLE `bukti_kegiatan`
  MODIFY `id_bukti_kegiatan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id_fakultas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id_mata_kuliah` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=375;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `profil_kampus`
--
ALTER TABLE `profil_kampus`
  MODIFY `id_profil_perusahaan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `program_studi`
--
ALTER TABLE `program_studi`
  MODIFY `id_program_studi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id_ruangan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tahun_akademik`
--
ALTER TABLE `tahun_akademik`
  MODIFY `id_tahun_akademik` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berita_acara`
--
ALTER TABLE `berita_acara`
  ADD CONSTRAINT `berita_acara_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bukti_kegiatan`
--
ALTER TABLE `bukti_kegiatan`
  ADD CONSTRAINT `bukti_kegiatan_ibfk_1` FOREIGN KEY (`id_berita_acara`) REFERENCES `berita_acara` (`id_berita_acara`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`id_program_studi`) REFERENCES `program_studi` (`id_program_studi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_3` FOREIGN KEY (`id_mata_kuliah`) REFERENCES `mata_kuliah` (`id_mata_kuliah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_program_studi`) REFERENCES `program_studi` (`id_program_studi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD CONSTRAINT `program_studi_ibfk_1` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id_fakultas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `program_studi_ibfk_2` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
