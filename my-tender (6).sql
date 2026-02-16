-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 15, 2026 at 09:55 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my-tender`
--

-- --------------------------------------------------------

--
-- Table structure for table `application_transactions`
--

CREATE TABLE `application_transactions` (
  `transaction_id` int NOT NULL,
  `application_id` int NOT NULL,
  `tender_id` int NOT NULL,
  `vendor_id` int NOT NULL,
  `action` varchar(50) NOT NULL,
  `performed_by` int NOT NULL,
  `performed_role` tinyint NOT NULL,
  `remarks` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `application_transactions`
--

INSERT INTO `application_transactions` (`transaction_id`, `application_id`, `tender_id`, `vendor_id`, `action`, `performed_by`, `performed_role`, `remarks`, `created_at`) VALUES
(1, 7, 1, 2, 'approved', 9, 1, NULL, '2026-02-09 12:39:50'),
(2, 7, 1, 2, 'approved', 9, 1, NULL, '2026-02-09 12:39:51'),
(3, 6, 1, 2, 'approved', 10, 2, NULL, '2026-02-10 09:47:11'),
(4, 8, 2, 3, 'approved', 9, 1, NULL, '2026-02-10 20:54:28'),
(5, 12, 9, 3, 'rejected', 10, 2, NULL, '2026-02-13 03:31:22'),
(6, 13, 5, 3, 'rejected', 9, 1, NULL, '2026-02-13 04:55:00'),
(7, 11, 3, 3, 'approved', 10, 2, NULL, '2026-02-13 22:10:11');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `created_at`) VALUES
(1, 'Makanan-Berat', '2026-02-06 02:13:26'),
(2, 'IT', '2026-02-06 02:13:26'),
(3, 'Pembangunan ', '2026-02-06 02:15:50'),
(5, 'Pembekalan Pokok', '2026-02-09 13:25:17'),
(6, 'keselamatan awam', '2026-02-09 13:25:36'),
(7, 'IT , Reasearch And Development', '2026-02-10 20:57:31'),
(8, 'Perdagangan Borong dan Runcit (makanan)', '2026-02-13 05:37:39');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `tender_id` int DEFAULT NULL,
  `status` tinyint DEFAULT '1',
  `created_by` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `title`, `description`, `image`, `tender_id`, `status`, `created_by`, `created_at`) VALUES
(1, 'Hebahan Pembekalan Makanan uitm', '	\r\nTawaran Menjalankan Perkhidmatan Perniagaan Mesin Niaga Layan Diri di Plaza Satelit B dan Kompleks Kemudahan Pelajar Rafflesia UiTM Cawangan Selangor Kampus Puncak Alam Untuk Tempoh 3 Tahun ', '1770708480_cafeuitm.jpeg', 3, 1, 9, '2026-02-10 07:28:00'),
(2, 'Pembangunan Aplikasi My siswa', 'Pembangunan aplikasi akademik ,maklumat akademik, jadual kuliah dan peperiksaaan, iStar, eMerit dan maklumat ePrihatin di dalam satu aplikasi. Terdapat juga bantuan dan panduan untuk memudahkan pelajar mendapat maklumat.', '1770744079_appdevelopment.jpeg', 1, 1, 9, '2026-02-10 17:21:19'),
(3, 'Pembukaan Tender Baharu', 'Tender Menaik Taraf Infrastruktur Jaringan Internet di Universiti Teknologi MARA (UiTM)\r\n\r\nUniversiti Teknologi MARA (UiTM) dengan ini mempelawa syarikat-syarikat yang berkelayakan dan berpengalaman untuk menyertai Tender Terbuka bagi Projek Menaik Taraf Infrastruktur Jaringan Internet UiTM.\r\n\r\n', '1770959882_tenet.jpeg', 11, 1, 9, '2026-02-13 05:18:02');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int NOT NULL,
  `user_id` int NOT NULL,
  `role` tinyint NOT NULL,
  `type` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL,
  `reference_type` varchar(50) DEFAULT NULL,
  `reference_id` int DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `role`, `type`, `message`, `reference_type`, `reference_id`, `is_read`, `created_at`) VALUES
(1, 3, 3, 'tender_status_update', 'Your tender application has been approved.', 'tender_application', 7, 0, '2026-02-09 12:39:50'),
(2, 3, 3, 'tender_status_update', 'Your tender application has been approved.', 'tender_application', 7, 0, '2026-02-09 12:39:51'),
(3, 3, 3, 'vendor_status_update', 'Your vendor account has been approved. You may now apply for tenders.', 'vendor', 2, 0, '2026-02-09 13:11:36'),
(4, 3, 3, 'tender_status_update', 'Your tender application has been approved.', 'tender_application', 6, 0, '2026-02-10 09:47:11'),
(5, 12, 3, 'vendor_status_update', 'Your vendor account has been approved. You may now apply for tenders.', 'vendor', 3, 1, '2026-02-10 17:13:39'),
(6, 12, 3, 'tender_status_update', 'Your tender application has been approved.', 'tender_application', 8, 1, '2026-02-10 20:54:28'),
(7, 5, 2, 'tender_applied', 'New tender application submitted by vendor.', 'tender_application', 12, 1, '2026-02-12 20:25:50'),
(8, 6, 2, 'tender_applied', 'New tender application submitted by vendor.', 'tender_application', 12, 0, '2026-02-12 20:25:50'),
(9, 9, 1, 'tender_applied', 'New tender application submitted by vendor.', 'tender_application', 12, 1, '2026-02-12 20:25:50'),
(10, 10, 2, 'tender_applied', 'New tender application submitted by vendor.', 'tender_application', 12, 0, '2026-02-12 20:25:50'),
(11, 12, 0, 'tender_status_update', 'Your tender application has been rejected.', 'tender_application', 12, 0, '2026-02-13 03:31:22'),
(12, 5, 2, 'tender_applied', 'New tender application submitted by vendor.', 'tender_application', 13, 0, '2026-02-13 04:54:17'),
(13, 6, 2, 'tender_applied', 'New tender application submitted by vendor.', 'tender_application', 13, 0, '2026-02-13 04:54:17'),
(14, 9, 1, 'tender_applied', 'New tender application submitted by vendor.', 'tender_application', 13, 1, '2026-02-13 04:54:17'),
(15, 10, 2, 'tender_applied', 'New tender application submitted by vendor.', 'tender_application', 13, 0, '2026-02-13 04:54:17'),
(16, 13, 2, 'tender_applied', 'New tender application submitted by vendor.', 'tender_application', 13, 0, '2026-02-13 04:54:17'),
(17, 12, 3, 'tender_status_update', 'Your tender application for \"Pembinaan Masjid Di Uitm Remmbau\" (RM 20,000,000.00) has been REJECTED.', 'tender_application', 13, 1, '2026-02-13 04:55:00'),
(18, 14, 3, 'vendor_status_update', 'Your vendor account has been approved. You may now apply for tenders.', 'vendor', 4, 0, '2026-02-13 19:37:03'),
(19, 12, 3, 'tender_status_update', 'Your tender \"Tender Pembekalan makanan UITM\" (RM 20,000.00) has been APPROVED.', 'tender_application', 11, 0, '2026-02-13 22:10:11');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int NOT NULL,
  `user_id` int NOT NULL,
  `staff_name` varchar(150) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `user_id`, `staff_name`, `department`, `position`, `phone`, `created_at`) VALUES
(1, 9, 'Ahmad Afiq Bin Abdul Rahman', 'Integrated Department', 'Software Engineer', '01155006917', '2026-02-15 17:34:44'),
(2, 5, 'Ahmad bin Muhammad', 'Procurement Department ', 'Procurement Executive', '01233864095', '2026-02-15 18:27:27'),
(3, 10, 'Hazim Khalid bin Hamran', 'Procurement Department', 'Procurement Executive / Officer', '019377849', '2026-02-15 18:28:49'),
(4, 6, 'Halim Ahmad bin Rijal', 'Procurement Department', 'Procurement Executive / Officer', '0146894678', '2026-02-15 18:30:51'),
(5, 13, 'Safuan bin Jamal', 'Procurement Department', 'Procurement Executive / Officer', '0168963948', '2026-02-15 18:32:02');

-- --------------------------------------------------------

--
-- Table structure for table `tenders`
--

CREATE TABLE `tenders` (
  `tender_id` int NOT NULL,
  `category_id` int NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `budget` decimal(12,2) NOT NULL,
  `closing_date` date NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tenders`
--

INSERT INTO `tenders` (`tender_id`, `category_id`, `title`, `description`, `budget`, `closing_date`, `status`, `created_at`) VALUES
(1, 1, 'System Development Tender', 'Develop internal system', '50000.00', '2026-12-31', 0, '2026-02-01 09:59:02'),
(2, 2, 'Project Pembangunan Laman web my kasih', 'MyKasih ialah program bantuan kerajaan Malaysia yang membantu isi rumah B40 dan M40 yang layak untuk membeli barangan keperluan harian menggunakan MyKad di kedai terpilih.\r\n\r\nRamai penerima menghadapi kekeliruan semasa membuat semakan status MyKasih, memahami syarat kelayakan, atau berdepan masalah seperti paparan mesej “tiada rekod dijumpai” semasa pengesahan atau di kedai yang mengambil bahagian.\r\n\r\nHalaman ini menyediakan maklumat yang jelas dan terkini mengenai program MyKasih, termasuk panduan asas berkaitan semakan status dan penggunaan bantuan secara berhemah oleh penerima.', '4600000.00', '2026-02-18', 1, '2026-02-06 02:33:51'),
(3, 1, 'Tender Pembekalan makanan UITM', 'Pembukaan Cafe UITM Kampus Rembau', '300000.00', '2026-02-27', 1, '2026-02-06 02:42:31'),
(4, 1, 'Bembekalan makanan Bahan Mentah', 'Pembekalan selama tempoh 20 tahun di uitm melaka di cafe kolej melaka ', '10000000.00', '2026-02-28', 1, '2026-02-07 03:34:57'),
(5, 3, 'Pembinaan Masjid Di Uitm Remmbau', 'Pembinaan masjid di uitm rembau seluas 20000 sft yang memuatkan 3000 jemaah', '3000000.00', '2026-03-14', 1, '2026-02-07 03:54:32'),
(6, 2, 'Pembangunan web pengajian islam', 'web ini menampung pembelajaran dan pembangunan akidah islam', '20000.00', '2026-02-19', 1, '2026-02-07 04:21:49'),
(7, 1, 'pembekalan makanan mentah', 'membekalkan makanan mentah kepada cafe uitm puncak alam selama 20 Tahun', '200000.00', '2026-03-07', 1, '2026-02-07 04:36:57'),
(8, 1, 'makanan sejuk', 'testing', '200000.00', '2026-02-19', 1, '2026-02-07 04:39:15'),
(9, 1, 'bekalan bahan mentah-seafood', 'membekalkan makanan laut kepada azman cafe selama 10 bulan', '80000.00', '2026-02-27', 1, '2026-02-07 06:12:33'),
(10, 1, 'Pembekalan biji kopi', 'pembekalan biji kopi intenso selama 10 tahun', '450000.00', '2026-02-12', 1, '2026-02-07 06:16:23'),
(11, 2, 'Menaik Taraf kemudahan Internet', 'IKLAN TENDER TERBUKA\r\nTender Menaik Taraf Infrastruktur Jaringan Internet di Universiti Teknologi MARA (UiTM)\r\n\r\nUniversiti Teknologi MARA (UiTM) dengan ini mempelawa syarikat-syarikat yang berkelayakan dan berpengalaman untuk menyertai Tender Terbuka bagi Projek Menaik Taraf Infrastruktur Jaringan Internet UiTM.\r\n\r\n Objektif Projek\r\n\r\nProjek ini bertujuan untuk:\r\n\r\nMeningkatkan kelajuan dan kestabilan capaian internet di seluruh kampus.\r\n\r\nMenyokong keperluan pembelajaran digital, sistem e-learning, penyelidikan dan pentadbiran.\r\n\r\nMemastikan liputan WiFi menyeluruh termasuk di fakulti, kolej kediaman, perpustakaan dan ruang umum.\r\n\r\nMemperkukuhkan keselamatan rangkaian (network security) serta sistem pemantauan trafik data.\r\n\r\n🛠️ Skop Kerja\r\n\r\nAntara skop kerja yang terlibat adalah:\r\n\r\nNaik taraf backbone network kepada kapasiti berkelajuan tinggi (minimum 10Gbps atau mengikut keperluan teknikal).\r\n\r\nPemasangan dan konfigurasi peralatan rangkaian baharu seperti core switch, distribution switch dan access point terkini.\r\n\r\nPelaksanaan sistem keselamatan siber termasuk firewall enterprise dan intrusion detection system (IDS).\r\n\r\nPenyediaan sistem pemantauan rangkaian berpusat (Network Monitoring System).\r\n\r\nUjian prestasi, konfigurasi akhir serta latihan kepada pegawai ICT UiTM.\r\n Syarat Penyertaan\r\n\r\nBerdaftar dengan Kementerian Kewangan Malaysia (MOF) dalam bidang berkaitan ICT dan rangkaian.\r\n\r\nMempunyai pengalaman sekurang-kurangnya 3 projek berskala besar dalam tempoh 5 tahun.\r\n\r\nMempunyai kepakaran teknikal serta tenaga kerja bertauliah (contoh: CCNA/CCNP atau setaraf).\r\n\r\nMempunyai kedudukan kewangan yang kukuh dan rekod prestasi yang baik.\r\n\r\n Maklumat Tender\r\n\r\nJenis Tender: Tender Terbuka\r\n\r\nTempoh Projek: 6 – 12 bulan\r\n\r\nDokumen Tender: Boleh diperoleh melalui portal rasmi UiTM / Pejabat Pembangunan & ICT\r\n\r\nTarikh Tutup: (Akan dimaklumkan dalam notis rasmi tender)\r\n\r\n📈 Kepentingan Projek\r\n\r\nMenaik taraf infrastruktur jaringan internet ini adalah selaras dengan aspirasi UiTM dalam memperkasakan kampus digital pintar (Smart Digital Campus) serta menyokong pembelajaran hibrid, analitik data pendidikan dan transformasi digital universiti.\r\n\r\nSebarang pertanyaan lanjut boleh diajukan kepada:\r\n\r\nBahagian Teknologi Maklumat & Komunikasi (ICT)\r\nUniversiti Teknologi MARA', '15000000.00', '2026-03-13', 1, '2026-02-12 20:33:15'),
(12, 6, 'Pembekalan Peralatan Pemadam Api', 'Uitm Mencari pembekal peralatan api sebanya 200 unit. ', '31000.00', '2026-10-28', 1, '2026-02-13 11:41:17');

-- --------------------------------------------------------

--
-- Table structure for table `tender_applications`
--

CREATE TABLE `tender_applications` (
  `application_id` int NOT NULL,
  `tender_id` int NOT NULL,
  `vendor_id` int NOT NULL,
  `proposed_price` int NOT NULL,
  `proposal_description` text,
  `quotation_file` varchar(255) DEFAULT NULL,
  `status` int NOT NULL,
  `applied_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tender_applications`
--

INSERT INTO `tender_applications` (`application_id`, `tender_id`, `vendor_id`, `proposed_price`, `proposal_description`, `quotation_file`, `status`, `applied_at`) VALUES
(1, 1, 1, 10000, 'test', 'quotation_697f23f40f97c.pdf', 0, '2026-02-01 09:59:16'),
(2, 1, 1, 10000, 'test', 'quotation_697f2402c1eb4.pdf', 0, '2026-02-01 09:59:30'),
(3, 1, 1, 2000, 'test', 'quotation_697f247352489.pdf', 1, '2026-02-01 10:01:23'),
(4, 1, 1, 15000000, 'Allah sayang kita', 'quotation_697f24a34710c.pdf', 1, '2026-02-01 10:02:11'),
(5, 1, 1, 25000000, 'perangi buli', 'quotation_697f2a39e25d5.pdf', 2, '2026-02-01 10:26:01'),
(6, 1, 2, 8888, NULL, NULL, 1, '2026-02-05 02:54:37'),
(7, 1, 2, 8888, NULL, NULL, 1, '2026-02-05 02:54:37'),
(8, 2, 3, 3500000, '**CADANGAN PROJEK\r\n\r\n(PROJECT PROPOSAL)**\r\n\r\nTAJUK PROJEK\r\n\r\nPembangunan Laman Web MyKasih – Platform Maklumat, Semakan & Panduan Bantuan Kerajaan\r\n\r\n1. LATAR BELAKANG PROJEK\r\n\r\nMyKasih merupakan program bantuan kerajaan Malaysia yang bertujuan membantu isi rumah B40 dan M40 yang layak dalam mendapatkan barangan keperluan harian melalui penggunaan MyKad di kedai terpilih.\r\n\r\nNamun begitu, maklum balas daripada penerima menunjukkan beberapa isu utama, antaranya:\r\n\r\nKekeliruan semasa membuat semakan status MyKasih\r\n\r\nKekurangan maklumat yang jelas berkaitan syarat kelayakan\r\n\r\nMasalah paparan seperti “tiada rekod dijumpai” semasa pengesahan status atau ketika transaksi di kedai terlibat\r\n\r\nKetiadaan satu pusat rujukan rasmi yang mudah difahami oleh orang awam\r\n\r\nOleh itu, pembangunan sebuah laman web MyKasih yang berstruktur, mesra pengguna dan komprehensif adalah sangat diperlukan bagi menyokong penyampaian maklumat yang tepat dan konsisten kepada penerima bantuan.\r\n\r\n2. OBJEKTIF PROJEK\r\n\r\nObjektif utama projek ini adalah untuk:\r\n\r\nMenyediakan platform rasmi sebagai pusat rujukan maklumat MyKasih\r\n\r\nMembantu penerima membuat semakan status dan kefahaman kelayakan dengan lebih jelas\r\n\r\nMengurangkan kekeliruan, salah faham dan aduan berkaitan program MyKasih\r\n\r\nMenyokong usaha pendigitalan perkhidmatan kerajaan\r\n\r\nMenggalakkan penggunaan bantuan secara berhemah, telus dan berkesan\r\n\r\n3. SKOP KERJA (SCOPE OF WORK)\r\n\r\nPembangunan projek ini merangkumi skop berikut:\r\n\r\n3.1 Pembangunan Laman Web\r\n\r\nReka bentuk UI/UX mesra pengguna (mobile & desktop responsive)\r\n\r\nStruktur maklumat yang mudah difahami oleh semua peringkat umur\r\n\r\nSokongan pelbagai peranti dan pelayar web\r\n\r\n3.2 Modul & Kandungan Utama\r\n\r\nPengenalan & maklumat rasmi program MyKasih\r\n\r\nPanduan semakan status penerima\r\n\r\nPenerangan syarat kelayakan & kategori bantuan\r\n\r\nSoalan Lazim (FAQ)\r\n\r\nPanduan penggunaan bantuan di kedai terpilih\r\n\r\nMaklumat ralat biasa (contoh: “tiada rekod dijumpai”) & penyelesaian\r\n\r\n3.3 Pengurusan & Keselamatan\r\n\r\nSistem pengurusan kandungan (CMS) untuk kemas kini maklumat\r\n\r\nCiri keselamatan data & kawalan akses\r\n\r\nPematuhan kepada standard keselamatan sistem kerajaan\r\n\r\n3.4 Pengujian & Pelaksanaan\r\n\r\nUjian fungsi & prestasi sistem\r\n\r\nUjian kebolehgunaan (User Acceptance Test – UAT)\r\n\r\nPelaksanaan (deployment) ke persekitaran produksi\r\n\r\n4. HASIL PROJEK (DELIVERABLES)\r\n\r\nAntara hasil utama projek ini ialah:\r\n\r\nLaman web MyKasih yang lengkap dan berfungsi sepenuhnya\r\n\r\nDokumentasi sistem dan manual pengguna\r\n\r\nLatihan asas pentadbiran sistem (admin)\r\n\r\nSokongan teknikal selepas pelaksanaan (post-implementation support)\r\n\r\n5. TEMPOH PELAKSANAAN PROJEK\r\n\r\nTempoh pelaksanaan projek dicadangkan selama:\r\n\r\n12 bulan, merangkumi:\r\n\r\nAnalisis keperluan & reka bentuk sistem\r\n\r\nPembangunan & integrasi\r\n\r\nUjian, pelaksanaan dan sokongan awal\r\n\r\n6. KOS PROJEK\r\nAnggaran Kos Keseluruhan Projek\r\n\r\nRM 3,500,000.00\r\n(Ringgit Malaysia: Tiga Juta Lima Ratus Ribu Sahaja)\r\n\r\nKos ini merangkumi:\r\n\r\nReka bentuk dan pembangunan sistem\r\n\r\nInfrastruktur dan konfigurasi teknikal\r\n\r\nPengujian, pelaksanaan & dokumentasi\r\n\r\nLatihan pengguna dan sokongan teknikal\r\n\r\n7. PENUTUP\r\n\r\nCadangan projek ini diyakini mampu membantu meningkatkan kefahaman, kecekapan serta pengalaman pengguna dalam kalangan penerima bantuan MyKasih. Pembangunan laman web ini bukan sahaja menyokong penyampaian maklumat yang telus dan berkesan, malah sejajar dengan aspirasi kerajaan ke arah pendigitalan perkhidmatan awam yang inklusif dan berimpak tinggi.', 'quotation_698b6b5a15180.pdf', 1, '2026-02-10 17:31:06'),
(9, 6, 3, 400000, 'PROPOSAL TENDER: PORTAL PEMBELAJARAN ISLAM (MODUL AKIDAH)\r\n1. Objektif Projek\r\nMembangunkan platform pembelajaran digital (LMS) yang interaktif bagi membolehkan akses kepada ilmu akidah yang sahih secara 24/7.\r\nMenyediakan repositori kandungan digital (e-book, video, audio) yang telah disahkan oleh pihak berkuasa agama (JAKIM/JAIS).\r\nMeningkatkan kefahaman akidah Ahli Sunnah Wal Jamaah bagi membendung penularan ajaran sesat dalam talian.\r\n2. Skop Kerja & Komponen Teknikal\r\nBajet RM400,000 membolehkan pembangunan sistem gred korporat yang merangkumi:\r\nSistem Pengurusan Pembelajaran (LMS): Pendaftaran pelajar, pengurusan kursus berperingkat (Tahap 1-3), kuiz interaktif, dan penjanaan sijil digital.\r\nPerpustakaan Digital (E-Resource): Sistem carian pintar untuk rujukan kitab akidah, fatwa, dan artikel ilmiah.\r\nModul Interaktif & Gamifikasi: Video animasi 2D/3D untuk kanak-kanak dan modul kuiz berasaskan mata untuk menarik minat golongan muda.\r\nSistem Konsultasi Akidah: Ruang sembang langsung (Live Chat) atau sistem tiket untuk soal jawab agama secara peribadi.\r\nAplikasi Mudah Alih (Hybrid): Versi iOS dan Android untuk akses mudah di mana-mana sahaja.\r\n3. Anggaran Pecahan Bajet (RM 400,000.00)\r\nPerkara	Perincian	Anggaran (RM)\r\nFasa Analisis & Rekabentuk	Kajian pengguna (UI/UX), penyediaan skrip modul & kurikulum.	50,000\r\nPembangunan Sistem & Apps	Coding LMS, Integrasi API, pembangunan aplikasi mobile.	180,000\r\nPembangunan Kandungan	Penerbitan video animasi, e-book interaktif, & multimedia dakwah.	100,000\r\nInfrastruktur & Keselamatan	Cloud Hosting (Setahun), SSL, Firewall, & Ujian Penembusan (VAPT).	40,000\r\nLatihan & Penyelenggaraan	Latihan admin/pengajar & sokongan teknikal pasca-pelancaran (1 tahun).	30,000\r\n4. Garis Masa Projek (10 - 12 Bulan)\r\nBulan 1-2: Kajian keperluan dan pengesahan kurikulum akidah dengan panel pakar.\r\nBulan 3-7: Pembangunan prototaip, pangkalan data, dan modul pembelajaran.\r\nBulan 8-9: Pengisian kandungan multimedia dan User Acceptance Test (UAT).\r\nBulan 10: Pelancaran rasmi dan latihan pengguna.\r\n5. Kriteria Keselamatan & Kepatuhan\r\nSistem mesti mematuhi Pekeliling Pendigitalan Sektor Awam bagi memastikan integriti data dan keselamatan maklumat pengguna.\r\nIntegrasi dengan Sistem Validasi Aplikasi Islamik JAKIM untuk pengesahan kandungan.', 'quotation_698e2a0bb4048.pdf', 0, '2026-02-12 19:29:15'),
(10, 8, 3, 20000, 'test', 'quotation_698e329892f07.pdf', 0, '2026-02-12 20:05:44'),
(11, 3, 3, 20000, 'testing makanan (luar bidang)', 'quotation_698e35390507e.pdf', 1, '2026-02-12 20:16:57'),
(12, 9, 3, 60000, 'Testing makanan laut', 'quotation_698e374e2d684.pdf', 2, '2026-02-12 20:25:50'),
(13, 5, 3, 20000000, 'pembinaan testing', 'quotation_698eae7924348.pdf', 2, '2026-02-13 04:54:17');

-- --------------------------------------------------------

--
-- Table structure for table `tender_requirements`
--

CREATE TABLE `tender_requirements` (
  `requirement_id` int NOT NULL,
  `tender_id` int NOT NULL,
  `requirement_type` int NOT NULL,
  `requirement_value` decimal(12,2) DEFAULT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tender_requirements`
--

INSERT INTO `tender_requirements` (`requirement_id`, `tender_id`, `requirement_type`, `requirement_value`, `description`) VALUES
(1, 1, 2, '3.00', 'testtt'),
(2, 1, 1, '200000.00', 'testing lahhh'),
(4, 6, 3, '500000.00', 'testing budget kene 5k '),
(5, 10, 2, '200000.00', 'testtt'),
(6, 10, 1, '5.00', 'sekurang kurangnya 5 tahun pengalaman'),
(7, 10, 5, NULL, 'mempunyai 10 project'),
(8, 9, 1, '2.00', 'Mempunyai pengalaman dalam membekalkan makanan dan bahan mentah sekurang kurangnya 2 tahun dan pernah berurusan dengan sektor kerajaan'),
(9, 9, 12, '15.00', 'mempunyi sekurang kurangnya 15 orang perkerja tidak termasuk pemilik perniagaaan'),
(10, 9, 3, '200000.00', 'maksimum peruntukkan yang perlu digunakan adalah seperti yang dinyatakan'),
(11, 2, 1, '6.00', 'Mempunyai pengalaman dalam pembangunan laman web melebihi 5 tahun. selain itu mjempunyai tenaga yang mahir dan pakar melebihi 6 tahun'),
(12, 2, 6, NULL, 'Mematuhi ISO yang terkini sewaktu membangun dan memguruskan laman web '),
(13, 2, 10, NULL, 'Syarikat perlulah berstatus Bumiputra'),
(14, 2, 12, '20.00', 'Syarikat perlulah mempunyai tenaga yang mahir sekurang kurangnya total 20 orang'),
(15, 2, 9, NULL, 'Syarikat perlu berdaftar dengan MOF'),
(16, 2, 5, NULL, 'Perlulah mempunyai pengalaman dalam membangun dan membina aplikasi kerajaan dan swasta sekurang kurangnya 6 project'),
(17, 5, 6, NULL, 'kene ada iso'),
(18, 5, 1, '5.00', 'kene lebih 5 tahun'),
(19, 11, 3, '200000000.00', 'maximum yang boleh diperuntukkan adalah RM 20,000,000.00 bergantung kepada budi bicara dan yang manfaatnya'),
(20, 12, 10, NULL, 'perlulah berstatus bumiputra'),
(21, 12, 9, NULL, 'Anda Perlulah Berdaftar dengan Dengan MOF ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int NOT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '0=Inactive,1=Active,2=Suspended',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`, `status`, `created_at`) VALUES
(1, 'Ahmad Azman Bin Ramli', 'azman1@gmail.com', '$2y$10$jK.bF.nMuXUDGKBHMLoY2OXwnpVmo7uPJwylUk9iF/LTXo5Z9V3VG', 3, 1, '2026-02-08 00:46:48'),
(3, 'Muhamad Ali bin Hasyim', 'muhamadali1@gmail.com', '123456', 3, 1, '2026-02-08 01:25:18'),
(4, 'Abu Seman bin Jumaat', 'abuseman1@gmail.com', '$2y$10$aIN18Wdowxwf57sLGrFvVujfOye2tpF2oJ3CmD8lb8oHGQO1JTuEK', 3, 1, '2026-02-08 08:36:36'),
(5, 'Ahmad', 'ahmad@uitm.com', '123456', 2, 1, '2026-02-08 08:36:36'),
(6, 'Halim Ahmad bin Rijal', 'halim@uitm.com', '$2y$10$HysSuG/yQ6Yk0K0EXP6gruf1JyrJYM1058q203pfLSy8CsoBa0uQG', 2, 1, '2026-02-08 12:28:41'),
(7, 'Kamal', 'kamal@uitm.com', '$2y$10$5cgPCZZKr5OGMULjtW.OFuUdf5cJ7g05Y37NPtsLKeYuoEF6fLx8a', 3, 1, '2026-02-08 12:38:00'),
(9, 'Ahmad Afiq', 'admin@uitm.com', '$2y$10$NomE43c05yxqg/cSBc.KWuOmei1Vb6i3er9LRIit0zCcTXu2NPpjS', 1, 1, '2026-02-09 10:31:07'),
(10, 'Hazim Khalid bin Hamran', 'Hazim1@uitm.com', '$2y$10$ZKqntGVh5ECflHBVmT83feWnI5hWdxJK0fmNWTLsSwTCelNWwG3fK', 2, 1, '2026-02-10 05:10:57'),
(12, 'Hanafi bin Jalil', 'hanafi@gmail.com', '$2y$10$A8bEuX5hUttTEQPlsWsWM.MjfL4q4OLKUjUIveeTGSen/pnersnl6', 3, 1, '2026-02-10 09:48:16'),
(13, 'Safuan bin Jamal', 'safuan@uitm.com', '12345', 2, 1, '2026-02-13 02:32:35'),
(14, 'Hamdan Mahmood Bin Muhammad Hassan', 'hamdan@gmail.com', '$2y$10$jGMDSDtMMrPYCka6/i1LNe/ThIVcRv3qR8pDrSlnZ.Beg5Bross.m', 3, 1, '2026-02-13 11:44:48');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendor_id` int NOT NULL,
  `user_id` int NOT NULL,
  `company_name` varchar(150) NOT NULL,
  `description` text,
  `ssm_number` varchar(50) NOT NULL,
  `ssm_file` varchar(255) NOT NULL,
  `tcc_file` varchar(255) NOT NULL,
  `years_experience` int NOT NULL,
  `category_id` int NOT NULL,
  `address_line1` varchar(255) NOT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `postcode` varchar(10) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paid_up_capital` decimal(12,2) DEFAULT '0.00',
  `vendor_status` int NOT NULL DEFAULT '0' COMMENT '0=Pending,1=Approved,2=Rejected,3=Suspended'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `user_id`, `company_name`, `description`, `ssm_number`, `ssm_file`, `tcc_file`, `years_experience`, `category_id`, `address_line1`, `address_line2`, `postcode`, `city`, `state`, `country`, `created_at`, `paid_up_capital`, `vendor_status`) VALUES
(1, 1, 'Test Vendor Sdn Bhd', NULL, '', '', '', 5, 1, '', NULL, '', '', '', '', '2026-02-01 09:58:44', '1000000.00', 0),
(2, 3, 'Rembayung Bena snd Bhd', 'company pembekal makanan ', '123451365', 'ssm_6987f12485087.pdf', 'tcc_6987f124855d0.pdf', 5, 1, 'no 99 jalan angrek', 'taman angrek 1', '71629', 'serdang', 'selangor', 'Malaysia', '2026-02-08 02:12:52', '200000.00', 1),
(3, 12, 'MIMOS BERHAD', 'MIMOS is Malaysia’s national Applied Research and Development Centre that contributes to socio-economic growth through innovative technology platforms, products and solutions.As the national R&D centre, MIMOS manages national technology facilities providing technical and consultancy services to the industry.\r\n\r\nMalaysian industry players enhance their industry knowledge and expertise by leveraging MIMOS’ domain experts, a strong network of local and international strategic collaborators and global market insights.', '937380023', 'ssm_698b66f389257.pdf', 'tcc_698b66f389875.pdf', 46, 2, 'Technology Park Malaysia,', 'Bukit Jalil', '57000', ' Kuala Lumpur', 'Wilayah Persekutuan', 'Malaysia', '2026-02-10 17:12:19', '50000000.00', 1),
(4, 14, 'LAGAYA Snd Bhd', 'membekal makanan - makanan berat dan bahan mentah di seluruh negara', '64467489933', 'ssm_698f0fbf2d682.pdf', 'tcc_698f0fbf2da73.pdf', 8, 1, 'no 80 jalan maran', 'taman meranti capital park', '721000', 'kuala lumpur', 'wilayah persekutuan', 'Malaysia', '2026-02-13 11:49:19', '20000000.00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application_transactions`
--
ALTER TABLE `application_transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `fk_at_application` (`application_id`),
  ADD KEY `fk_at_tender` (`tender_id`),
  ADD KEY `fk_at_vendor` (`vendor_id`),
  ADD KEY `fk_at_user` (`performed_by`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `fk_news_user` (`created_by`),
  ADD KEY `fk_news_tender` (`tender_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `fk_notifications_users` (`user_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `fk_staff_user` (`user_id`);

--
-- Indexes for table `tenders`
--
ALTER TABLE `tenders`
  ADD PRIMARY KEY (`tender_id`),
  ADD KEY `fk_tenders_categories` (`category_id`);

--
-- Indexes for table `tender_applications`
--
ALTER TABLE `tender_applications`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `fk_applications_tenders` (`tender_id`),
  ADD KEY `fk_applications_vendors` (`vendor_id`);

--
-- Indexes for table `tender_requirements`
--
ALTER TABLE `tender_requirements`
  ADD PRIMARY KEY (`requirement_id`),
  ADD KEY `fk_requirements_tenders` (`tender_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_id`),
  ADD KEY `fk_vendors_users` (`user_id`),
  ADD KEY `fk_vendors_categories` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application_transactions`
--
ALTER TABLE `application_transactions`
  MODIFY `transaction_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tenders`
--
ALTER TABLE `tenders`
  MODIFY `tender_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tender_applications`
--
ALTER TABLE `tender_applications`
  MODIFY `application_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tender_requirements`
--
ALTER TABLE `tender_requirements`
  MODIFY `requirement_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vendor_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application_transactions`
--
ALTER TABLE `application_transactions`
  ADD CONSTRAINT `fk_at_application` FOREIGN KEY (`application_id`) REFERENCES `tender_applications` (`application_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_at_tender` FOREIGN KEY (`tender_id`) REFERENCES `tenders` (`tender_id`),
  ADD CONSTRAINT `fk_at_user` FOREIGN KEY (`performed_by`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_at_vendor` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `fk_news_tender` FOREIGN KEY (`tender_id`) REFERENCES `tenders` (`tender_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_news_user` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_notifications_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `fk_staff_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `tenders`
--
ALTER TABLE `tenders`
  ADD CONSTRAINT `fk_tenders_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `tender_applications`
--
ALTER TABLE `tender_applications`
  ADD CONSTRAINT `fk_applications_tenders` FOREIGN KEY (`tender_id`) REFERENCES `tenders` (`tender_id`),
  ADD CONSTRAINT `fk_applications_vendors` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`);

--
-- Constraints for table `tender_requirements`
--
ALTER TABLE `tender_requirements`
  ADD CONSTRAINT `fk_requirements_tenders` FOREIGN KEY (`tender_id`) REFERENCES `tenders` (`tender_id`) ON DELETE CASCADE;

--
-- Constraints for table `vendors`
--
ALTER TABLE `vendors`
  ADD CONSTRAINT `fk_vendors_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `fk_vendors_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
