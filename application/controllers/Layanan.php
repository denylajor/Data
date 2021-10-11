<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Layanan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('excel', 'session'));
        $this->layanan = $this->load->database('db2', TRUE);
        if (!$this->session->userdata("user_login")) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data = array(
            // 'inserttable' => $this->General->fetch_CoustomQuery("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='db_layanan'"),
        );

        // cekPergroup();
        $this->header('Layanan');
        $this->load->view('Layanan/layanan', $data);
        $this->footer();
    }


    public function import_excel()
    {
        $layanan = input('layanan');
        // cetak_die($layanan);

        //Tabel GPS Kendaraan ------------------------------------------------------------------------------------------------------------
        if ($layanan == 'gps_kendaraan') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $NO = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $CABANG = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $KODE = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $NO_POLISI = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $JENIS_KENDARAAN = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $UKER = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $TAHUN = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $NO_GSM = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $IMEI = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $STATUS_KENDARAAN = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $PEMBAYARAN_GSM = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $Keterangan = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        // $ups_tidak_ada = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        // $latitude = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        // $longitude = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        // $pagu = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        // $denom = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                        // $Keterangan = $worksheet->getCellByColumnAndRow(17, $row)->getValue();

                        $temp_data[] = array(
                            'NO'    => $NO,
                            'CABANG'    => $CABANG,
                            'KODE'    => $KODE,
                            'NO_POLISI'    => $NO_POLISI,
                            'JENIS_KENDARAAN'    => $JENIS_KENDARAAN,
                            'UKER'    => $UKER,
                            'TAHUN'    => $TAHUN,
                            'NO_GSM'    => $NO_GSM,
                            'IMEI'    => $IMEI,
                            'STATUS_KENDARAAN'    => $STATUS_KENDARAAN,
                            'PEMBAYARAN_GSM'    => $PEMBAYARAN_GSM,
                            'Keterangan'    => $Keterangan,
                            // 'ups_tidak_ada'    => $ups_tidak_ada,
                            // 'latitude'    => $latitude,
                            // 'longitude'    => $longitude,
                            // 'pagu'    => $pagu,
                            // 'denom'    => $denom,
                            // 'keterangan'    => $keterangan,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                    }
                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->layanan->insert_batch($layanan, $temp_data);
                // lastq();
                if ($insert) {
                    if ($layanan) {
                        $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Berhasil');
                        redirect('Gpskendaraan');
                    }
                } else {
                    $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('Gpskendaraan');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }


            //Tabel Data Segel Tas ------------------------------------------------------------------------------------------------------------
        } else if ($layanan == 'data_segel_tas') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $Tahun = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Bulan = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $Kode = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Kantor_Cabang = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Nama_Barang = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Awal = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Masuk = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $Keluar = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $Sisa = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $Permintaan = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $Kode_Barang = $worksheet->getCellByColumnAndRow(10, $row)->getValue();


                        $temp_data[] = array(
                            'Tahun'    => $Tahun,
                            'Bulan'    => $Bulan,
                            'Kode'    => $Kode,
                            'Kantor_Cabang'    => $Kantor_Cabang,
                            'Nama_Barang'    => $Nama_Barang,
                            'Awal'    => $Awal,
                            'Masuk'    => $Masuk,
                            'Keluar'    => $Keluar,
                            'Sisa'    => $Sisa,
                            'Permintaan'    => $Permintaan,
                            'Kode_Barang'    => $Kode_Barang,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                    }
                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->layanan->insert_batch($layanan, $temp_data);
                // lastq();
                if ($insert) {
                    if ($layanan) {
                        $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Berhasil');
                        redirect('Datasegeltas');
                    }
                } else {
                    $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('Datasegeltas');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }


            //Tabel Kendaraan ------------------------------------------------------------------------------------------------------------
        } else if ($layanan == 'kendaraan') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $Kode = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Kanca = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $No = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Kendaraan_TNBK = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Tahun_Kend = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Type_Kend = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Rangka_Kend = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $Mesin_Kend = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $Status_Kend = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $Project = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $Uker = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $gsm = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $imei = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $Sataus_gps = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $Vendor = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $Awal_sewa = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        $Akhir_sewa = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                        // $stnk = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                        $stnk_row = $worksheet->getCellByColumnAndRow(17, $row);
                        $stnk = $stnk_row->getValue();
                        if(PHPExcel_Shared_Date::isDateTime($stnk_row)) {
                             $stnk = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($stnk)); 
                        }
                        // $tnbk = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                        $tnbk_row = $worksheet->getCellByColumnAndRow(18, $row);
                        $tnbk = $tnbk_row->getValue();
                        if(PHPExcel_Shared_Date::isDateTime($tnbk_row)) {
                             $tnbk = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($tnbk)); 
                        }
                        // $Masa_kir = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                        $Masa_kir_row = $worksheet->getCellByColumnAndRow(19, $row);
                        $Masa_kir = $Masa_kir_row->getValue();
                        if(PHPExcel_Shared_Date::isDateTime($Masa_kir_row)) {
                             $Masa_kir = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Masa_kir)); 
                        }
                        $safety_box = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                        $jenis_kend = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                        $keterangan = $worksheet->getCellByColumnAndRow(22, $row)->getValue();


                        $temp_data[] = array(
                            'Kode'    => $Kode,
                            'Kanca'    => $Kanca,
                            'No'    => $No,
                            'Kendaraan_TNBK'    => $Kendaraan_TNBK,
                            'Tahun_Kend'    => $Tahun_Kend,
                            'Type_Kend'    => $Type_Kend,
                            'Rangka_Kend'    => $Rangka_Kend,
                            'Mesin_Kend'    => $Mesin_Kend,
                            'Status_Kend'    => $Status_Kend,
                            'Project'    => $Project,
                            'Uker'    => $Uker,
                            'gsm'    => $gsm,
                            'imei'    => $imei,
                            'Sataus_gps'    => $Sataus_gps,
                            'Vendor'    => $Vendor,
                            'Awal_sewa'    => $Awal_sewa,
                            'Akhir_sewa'    => $Akhir_sewa,
                            'stnk'    => $stnk,
                            'tnbk'    => $tnbk,
                            'Masa_kir'    => $Masa_kir,
                            'safety_box'    => $safety_box,
                            'jenis_kend'    => $jenis_kend,
                            'keterangan'    => $keterangan,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                    }
                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->layanan->insert_batch($layanan, $temp_data);
                // lastq();
                if ($insert) {
                    if ($layanan) {
                        $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Berhasil');
                        redirect('Kendaraan');
                    }
                } else {
                    $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('Kendaraan');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }

            //Tabel Data Kas ------------------------------------------------------------------------------------------------------------
        } else if ($layanan == 'tbl_data_kas') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $no = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $kantor_cabang = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $tk_replenish = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $__return = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $atm_replenish = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $average_tk = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $average_return = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $average_rpl = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        

                        $temp_data[] = array(
                            'no'    => $no,
                            'kantor_cabang'    => $kantor_cabang,
                            'tk_replenish'    => $tk_replenish,
                            '__return'    => $__return,
                            'atm_replenish'    => $atm_replenish,
                            'average_tk'    => $average_tk,
                            'average_return'    => $average_return,
                            'average_rpl'    => $average_rpl,
                          'user' => $this->session->userdata("user_login")['username']

                        );
                    }
                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->layanan->insert_batch($layanan, $temp_data);
                // lastq();
                if ($insert) {
                    if ($layanan) {
                        $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Berhasil');
                        redirect('Datakas');
                    }
                } else {
                    $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('Datakas');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }
        

        //Tabel Master Kas ------------------------------------------------------------------------------------------------------------
        } else if ($layanan == 'tbl_masterkas'){
            // cetak_die($layanan);
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $no = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        // $tanggal = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $tanggal_row = $worksheet->getCellByColumnAndRow(1, $row);
                        $tanggal = $tanggal_row->getValue();
                        if(PHPExcel_Shared_Date::isDateTime($tanggal_row)) {
                             $tanggal = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($tanggal)); 
                        }
                        $codebranch = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $saldo_awal_bri = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $uang_layak = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $uang_meragukan = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $uang_tidak_layak = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $total_saldo_awal_penambahan = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $tambahan_kas = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $penukaran_uang_tidak_layak = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $kas_atm_return = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $sub_total = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $total_saldo_awal_pengurangan = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $shortage = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $atm_replenish = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $sub_total_pengurangan = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        $saldo_akhir = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                        $cabang = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                        // $total_saldo_awal_penambahan = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                        

                        $temp_data[] = array(
                            'no'    => $no,
                            'tanggal'    => $tanggal,
                            'codebranch'    => $codebranch,
                            'saldo_awal_bri'    => $saldo_awal_bri,
                            'uang_layak'    => $uang_layak,
                            'uang_meragukan'    => $uang_meragukan,
                            'uang_tidak_layak'    => $uang_tidak_layak,
                            'total_saldo_awal_penambahan'    => $total_saldo_awal_penambahan,
                            'tambahan_kas'    => $tambahan_kas,
                            'penukaran_uang_tidak_layak'    => $penukaran_uang_tidak_layak,
                            'kas_atm_return'    => $kas_atm_return,
                            'sub_total'    => $sub_total,
                            'total_saldo_awal_pengurangan'    => $total_saldo_awal_pengurangan,
                            'shortage'    => $shortage,
                            'atm_replenish'    => $atm_replenish,
                            'sub_total_pengurangan'    => $sub_total_pengurangan,
                            'saldo_akhir'    => $saldo_akhir,
                            'cabang'    => $cabang,
                            // 'total_saldo_awal_penambahan'    => $total_saldo_awal_penambahan,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                    }
                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->layanan->insert_batch($layanan, $temp_data);
                // lastq();
                if ($insert) {
                    if ($layanan) {
                        $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Berhasil');
                        redirect('Masterkas');
                    }
                } else {
                    $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('Masterkas');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }
        

        //Tabel MHU & MSU ------------------------------------------------------------------------------------------------------------
        }else if ($layanan == 'tbl_mhu_dan_msu'){
            // cetak_die($layanan);
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $kode = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $kanca = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $project = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $type_mesin = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $serial_number = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $versi_software = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $tahun_produksi = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $tahun_pengadaan = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $jumlah_pocket = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $jenis_mesin = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $aktivitas_mesin = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $kepemilikan = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $kondisi = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $keterangan = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        // $atm_replenish = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        // $sub_total_pengurangan = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        // $saldo_akhir = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                        // $cabang = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                        // $total_saldo_awal_penambahan = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                        

                        $temp_data[] = array(
                            'kode'    => $kode,
                            'kanca'    => $kanca,
                            'project'    => $project,
                            'type_mesin'    => $type_mesin,
                            'serial_number'    => $serial_number,
                            'versi_software'    => $versi_software,
                            'tahun_produksi'    => $tahun_produksi,
                            'tahun_pengadaan'    => $tahun_pengadaan,
                            'jumlah_pocket'    => $jumlah_pocket,
                            'jenis_mesin'    => $jenis_mesin,
                            'aktivitas_mesin'    => $aktivitas_mesin,
                            'kepemilikan'    => $kepemilikan,
                            'kondisi'    => $kondisi,
                            'keterangan'    => $keterangan,
                            // 'atm_replenish'    => $atm_replenish,
                            // 'sub_total_pengurangan'    => $sub_total_pengurangan,
                            // 'saldo_akhir'    => $saldo_akhir,
                            // 'cabang'    => $cabang,
                            // // 'total_saldo_awal_penambahan'    => $total_saldo_awal_penambahan,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                    }
                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->layanan->insert_batch($layanan, $temp_data);
                // lastq();
                if ($insert) {
                    if ($layanan) {
                        $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Berhasil');
                        redirect('Mhumsu');
                    }
                } else {
                    $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('Mhumsu');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }


        //Tabel Rekap Shortage ------------------------------------------------------------------------------------------------------------
        }else if ($layanan == 'tbl_rekap_shortage'){
            // cetak_die($layanan);
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        // $Tgl_Selisih = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        //untuk convert tanggal excel to db
                        $Tgl_Selisih_raw = $worksheet->getCellByColumnAndRow(1, $row);
                        $tgl_selisih_final = $Tgl_Selisih_raw->getValue();
                        if(PHPExcel_Shared_Date::isDateTime($Tgl_Selisih_raw)) {
                             $tgl_selisih_final = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($tgl_selisih_final)); 
                        }
                        $Kantor_Cabang = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $TID = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $BC = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Lokasi = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Mesin = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $Denom = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $Supervisi = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $Shortage = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        // $Tgl_Instruksi = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $tgl_intruksi_row = $worksheet->getCellByColumnAndRow(10, $row);
                        $tgl_intruksi = $tgl_intruksi_row->getValue();
                        if(PHPExcel_Shared_Date::isDateTime($tgl_intruksi_row)) {
                             $tgl_intruksi = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($tgl_intruksi)); 
                        }
                        $Surat_Investigasi = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $PIC_Investigasi = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $Keterangan_H3 = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        // $Reminder_H3 = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $reminder_row = $worksheet->getCellByColumnAndRow(14, $row);
                        $Reminder_H3 = $reminder_row->getValue();
                        if(PHPExcel_Shared_Date::isDateTime($reminder_row)) {
                             $Reminder_H3 = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Reminder_H3)); 
                        }
                        $Tindak_lanjut = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        $Kesimpulan = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                        $New = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                        $Open = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                        $Close = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                        $Case_ID = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                        // $total_saldo_awal_penambahan = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                        // $total_saldo_awal_penambahan = $worksheet->getCellByColumnAndRow(18, $row)->getValue();

                        

                        $temp_data[] = array(
                            'No'    => $No,
                            'Tgl_Selisih'    => $tgl_selisih_final,
                            'Kantor_Cabang'    => $Kantor_Cabang,
                            'TID'    => $TID,
                            'BC'    => $BC,
                            'Lokasi'    => $Lokasi,
                            'Mesin'    => $Mesin,
                            'Denom'    => $Denom,
                            'Supervisi'    => $Supervisi,
                            'Shortage'    => $Shortage,
                            'Tgl_Instruksi'    => $tgl_intruksi,
                            'Surat_Investigasi'    => $Surat_Investigasi,
                            'PIC_Investigasi'    => $PIC_Investigasi,
                            'Keterangan_H3'    => $Keterangan_H3,
                            'Reminder_H3'    => $Reminder_H3,
                            'Tindak_lanjut'    => $Tindak_lanjut,
                            'Kesimpulan'    => $Kesimpulan,
                            'New'    => $New,
                            'Open'    => $Open,
                            'Close'    => $Close,
                            'Case_ID'    => $Case_ID,
                            // 'total_saldo_awal_penambahan'    => $total_saldo_awal_penambahan,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                    }
                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->layanan->insert_batch($layanan, $temp_data);
                // lastq();
                if ($insert) {
                    // if ($layanan) {
                        $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Berhasil');
                        redirect('Rekapshortage');
                    // }
                } else {
                    $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('Rekapshortage');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }


            //Tabel Rekap Bank BJB ------------------------------------------------------------------------------------------------------------
        } else if ($layanan == 'rekap_bank_bjb'){
            // cetak_die($layanan);
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $cabang = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $id_atm = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $lokasi_atm = $worksheet->getCellByColumnAndRow(3, $row)->getValue();

                        //untuk convert tanggal excel to db
                        $tanggal_efektif = $worksheet->getCellByColumnAndRow(4, $row);
                        $tgl_efektif_final = $tanggal_efektif->getValue();
                        if(PHPExcel_Shared_Date::isDateTime($tanggal_efektif)) {
                             $tgl_efektif_final = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($tgl_efektif_final)); 
                        }


                        $jam_pengisian = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $denom = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $nominal_pengisian = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $vendor = $worksheet->getCellByColumnAndRow(8, $row)->getValue();  

                        $temp_data[] = array(
                            'No'               => $No,
                            'cabang'           => $cabang,
                            'id_atm'           => $id_atm,
                            'lokasi_atm'       => $lokasi_atm,
                            'tanggal_efektif'  => $tgl_efektif_final,
                            'jam_pengisian'    => $jam_pengisian,
                            'denom'            => $denom,
                            'nominal_pengisian' => $nominal_pengisian,
                            'vendor'            => $vendor,
                            'user'              => $this->session->userdata("user_login")['username']

                        );
                    }
                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->layanan->insert_batch($layanan, $temp_data);
                // lastq();
                if ($insert) {
                    // if ($layanan) {
                        $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Berhasil');
                        redirect('Rekapbankbjb');
                    // }
                } else {
                    $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('Rekapbankbjb');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }


            //Tabel Rekap CR Bank BJB ------------------------------------------------------------------------------------------------------------
        } else if ($layanan == 'rekap_cr_bank_bjb'){
            // cetak_die($layanan);
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $NO = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        
                        //untuk convert tanggal excel to db
                        $Tgl_Rep = $worksheet->getCellByColumnAndRow(1, $row);
                        $tgl_Rep_final = $Tgl_Rep->getValue();
                        if(PHPExcel_Shared_Date::isDateTime($Tgl_Rep)) {
                             $tgl_Rep_final = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($tgl_Rep_final)); 
                        }

                        $ID_ATM = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $BG = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Lokasi = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Time = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Denom = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $Tot_Replenish = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    

                        $temp_data[] = array(
                            'NO'            => $NO,
                            'Tgl_Rep'       => $tgl_Rep_final,
                            'ID_ATM'        => $ID_ATM,
                            'BG'            => $BG,
                            'Lokasi'        => $Lokasi,
                            'Time'          => $Time,
                            'Denom'         => $Denom,
                            'Tot_Replenish' => $Tot_Replenish,
                            'user'          => $this->session->userdata("user_login")['username']

                        );
                    }
                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->layanan->insert_batch($layanan, $temp_data);
                // lastq();
                if ($insert) {
                    // if ($layanan) {
                        $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Berhasil');
                        redirect('Rekapcrbankbjb');
                    // }
                } else {
                    $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('Rekapcrbankbjb');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }


            //Tabel Rekap FLM Bank BJB ------------------------------------------------------------------------------------------------------------
        } else if ($layanan == 'rekap_flm_bank_bjb'){
            // cetak_die($layanan);
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        // $Tanggal = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $Tanggal = $worksheet->getCellByColumnAndRow(1, $row);
                        $tgl_final = $Tanggal->getValue();
                        if(PHPExcel_Shared_Date::isDateTime($Tanggal)) {
                             $tgl_final = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($tgl_final)); 
                        }
                        $Kantor_Cabang = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $ID_ATM = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Nama_ATM = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Problem = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $No_Tiket_Catatan_BG = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    

                        $temp_data[] = array(
                            'No'                  => $No,
                            'Tanggal'             => $tgl_final,
                            'Kantor_Cabang'       => $Kantor_Cabang,
                            'ID_ATM'              => $ID_ATM,
                            'Nama_ATM'            => $Nama_ATM,
                            'Problem'             => $Problem,
                            'No_Tiket_Catatan_BG' => $No_Tiket_Catatan_BG,
                            'user'                => $this->session->userdata("user_login")['username']

                        );
                    }
                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->layanan->insert_batch($layanan, $temp_data);
                // lastq();
                if ($insert) {
                    // if ($layanan) {
                        $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Berhasil');
                        redirect('Rekapflmbankbjb');
                    // }
                } else {
                    $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('Rekapflmbankbjb');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }


            //Tabel Rekap Biaya CR FLM Bank BJB ------------------------------------------------------------------------------------------------------------
        } else if ($layanan == 'rekap_biaya_cr_flm_bank_bjb'){
            // cetak_die($layanan);
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $NO = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $ID = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        // $TANGGAL_PERDANA_PENGISIAN_ATM = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $tgl_perdana_pengisianatm = $worksheet->getCellByColumnAndRow(2, $row);
                        $TANGGAL_PERDANA_PENGISIAN_ATM = $tgl_perdana_pengisianatm->getValue();
                        if(PHPExcel_Shared_Date::isDateTime($tgl_perdana_pengisianatm)) {
                             $TANGGAL_PERDANA_PENGISIAN_ATM = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($TANGGAL_PERDANA_PENGISIAN_ATM)); 
                        }
                        $HARI = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $CABANG = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $ATM = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $BG = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $BIAYA_CR_DAN_FLM = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $PPN = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $VERSI_BJB_CR = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $VERSI_BJB_FLM = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $VERSI_BJB_CR_DAN_FLM = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $VERSI_BJB_CR_DAN_FLM1 = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $VERSI_BG_FLM = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $VERSI_BG_CR_DAN_FLM = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $BIAYA = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        $KETERANGAN = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                        $TOTAL_BIAYA = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                        $TRUE_FALSE = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                    

                        $temp_data[] = array(
                            'NO'                              => $NO,
                            'ID'                              => $ID,
                            'TANGGAL_PERDANA_PENGISIAN_ATM'   => $TANGGAL_PERDANA_PENGISIAN_ATM,
                            'HARI'                  => $HARI,
                            'CABANG'                => $CABANG,
                            'ATM'                   => $ATM,
                            'BG'                    => $BG,
                            'BIAYA_CR_DAN_FLM'      => $BIAYA_CR_DAN_FLM,
                            'PPN'                   => $PPN,
                            'VERSI_BJB_CR'          => $VERSI_BJB_CR,
                            'VERSI_BJB_FLM'         => $VERSI_BJB_FLM,
                            'VERSI_BJB_CR_DAN_FLM'  => $VERSI_BJB_CR_DAN_FLM,
                            'VERSI_BJB_CR_DAN_FLM1' => $VERSI_BJB_CR_DAN_FLM1,
                            'VERSI_BG_FLM'          => $VERSI_BG_FLM,
                            'VERSI_BG_CR_DAN_FLM'   => $VERSI_BG_CR_DAN_FLM,
                            'BIAYA'                 => $BIAYA,
                            'KETERANGAN'            => $KETERANGAN,
                            'TOTAL_BIAYA'           => $TOTAL_BIAYA,
                            'TRUE_FALSE'            => $TRUE_FALSE,
                            'user'                  => $this->session->userdata("user_login")['username']

                        );
                    }
                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->layanan->insert_batch($layanan, $temp_data);
                // lastq();
                if ($insert) {
                    // if ($layanan) {
                        $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Berhasil');
                        redirect('Rekapbiayacrflmbjb');
                    // }
                } else {
                    $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('Rekapbiayacrflmbjb');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }

//Tabel Harga Kegiatan Bank BJB ------------------------------------------------------------------------------------------------------------
        } else if ($layanan == 'harga_kegiatan_bank_bjb'){
            // cetak_die($layanan);
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $NO = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $wilayah = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $kantor_cabang = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $total_atm = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $kegiatan_cr = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $kegiatan_flm = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $total_biaya = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        
                        $temp_data[] = array(
                            'NO'                         => $NO,
                            'wilayah'                    => $wilayah,
                            'kantor_cabang'              => $kantor_cabang,
                            'total_atm'                  => $total_atm,
                            'kegiatan_cr'                => $kegiatan_cr,
                            'kegiatan_flm'               => $kegiatan_flm,
                            'total_biaya'                => $total_biaya,
                            'user'                       => $this->session->userdata("user_login")['username']

                        );
                    }
                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->layanan->insert_batch($layanan, $temp_data);
                // lastq();
                if ($insert) {
                    // if ($layanan) {
                        $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Berhasil');
                        redirect('Hargakegiatanbankbjb');
                    // }
                } else {
                    $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('Hargakegiatanbankbjb');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }

//Tabel Rekap analisa kc non cro cit ------------------------------------------------------------------------------------------------------------
        }else if ($layanan == 'rekap_analisa_kc_non_cro_cit'){
            // cetak_die($layanan);
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $Laba_Rugi = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Status_Pencapaian_VS_RKA_Pendapatan = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $Status_Pencapaian_VS_RKA_Biaya = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Status_Pencapaian_VS_RKA_Laba_Rugi = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Nama_Kanca = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Nama_Pembina = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $RKA_Pendapatan = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $RKA_Biaya = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $RKA_Laba_Rugi = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $Pencapaian_VS_RKA_Pendapatan = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $Pencapaian_VS_RKA_Biaya = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $Pencapaian_VS_RKA_Laba_Rugi = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $Total_Pencapaian_Pendapatan = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $Total_Pencapaian_Biaya = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $Total_Pencapaian_Laba_Rugi = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $Total_Pencapaian_BOPO = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        $Prognosa_sd_Desember_Pendapatan = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                        $Prognosa_sd_Desember_Biaya = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                        $Prognosa_sd_Desember_Laba_Rugi = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                                                
                        $temp_data[] = array(
                            'Laba_Rugi'                     => $Laba_Rugi,
                            'Status_Pencapaian_VS_RKA_Pendapatan'                => $Status_Pencapaian_VS_RKA_Pendapatan,
                            'Status_Pencapaian_VS_RKA_Biaya'          => $Status_Pencapaian_VS_RKA_Biaya,
                            'Status_Pencapaian_VS_RKA_Laba_Rugi'              => $Status_Pencapaian_VS_RKA_Laba_Rugi,
                            'Nama_Kanca'            => $Nama_Kanca,
                            'Nama_Pembina'           => $Nama_Pembina,
                            'RKA_Pendapatan'            => $RKA_Pendapatan,
                            'RKA_Biaya'            => $RKA_Biaya,
                            'RKA_Laba_Rugi'            => $RKA_Laba_Rugi,
                            'Pencapaian_VS_RKA_Pendapatan'            => $Pencapaian_VS_RKA_Pendapatan,
                            'Pencapaian_VS_RKA_Biaya'            => $Pencapaian_VS_RKA_Biaya,
                            'Pencapaian_VS_RKA_Laba_Rugi'            => $Pencapaian_VS_RKA_Laba_Rugi,
                            'Total_Pencapaian_Pendapatan'            => $Total_Pencapaian_Pendapatan,
                            'Total_Pencapaian_Biaya'            => $Total_Pencapaian_Biaya,
                            'Total_Pencapaian_Laba_Rugi'            => $Total_Pencapaian_Laba_Rugi,
                            'Total_Pencapaian_BOPO'            => $Total_Pencapaian_BOPO,
                            'Prognosa_sd_Desember_Pendapatan'            => $Prognosa_sd_Desember_Pendapatan,
                            'Prognosa_sd_Desember_Biaya'            => $Prognosa_sd_Desember_Biaya,
                            'Prognosa_sd_Desember_Laba_Rugi'            => $Prognosa_sd_Desember_Laba_Rugi,
                            'user'                   => $this->session->userdata("user_login")['username']

                        );
                    }
                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->layanan->insert_batch($layanan, $temp_data);
                // lastq();
                if ($insert) {
                    // if ($layanan) {
                        $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Berhasil');
                        redirect('Rekanalisakcnoncrocit');
                    // }
                } else {
                    $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('Rekanalisakcnoncrocit');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }

//Tabel Rekap Analisa KC Total ------------------------------------------------------------------------------------------------------------
        }else if ($layanan == 'rekap_analisa_kc_total'){
            // cetak_die($layanan);
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $Laba_Rugi = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Status_Pencapaian_VS_RKA_Pendapatan = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $Status_Pencapaian_VS_RKA_Biaya = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Status_Pencapaian_VS_RKA_Laba_Rugi = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Nama_Kanca = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Nama_Pembina = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $RKA_Pendapatan = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $RKA_Biaya = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $RKA_Laba_Rugi = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $Pencapaian_VS_RKA_Pendapatan = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $Pencapaian_VS_RKA_Biaya = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $Pencapaian_VS_RKA_Laba_Rugi = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $Total_Pencapaian_Pendapatan = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $Total_Pencapaian_Biaya = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $Total_Pencapaian_Laba_Rugi = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $Total_Pencapaian_BOPO = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        $Prognosa_sd_Desember_Pendapatan = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                        $Prognosa_sd_Desember_Biaya = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                        $Prognosa_sd_Desember_Laba_Rugi = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                                                
                        $temp_data[] = array(
                            'Laba_Rugi'                     => $Laba_Rugi,
                            'Status_Pencapaian_VS_RKA_Pendapatan'                => $Status_Pencapaian_VS_RKA_Pendapatan,
                            'Status_Pencapaian_VS_RKA_Biaya'          => $Status_Pencapaian_VS_RKA_Biaya,
                            'Status_Pencapaian_VS_RKA_Laba_Rugi'              => $Status_Pencapaian_VS_RKA_Laba_Rugi,
                            'Nama_Kanca'            => $Nama_Kanca,
                            'Nama_Pembina'           => $Nama_Pembina,
                            'RKA_Pendapatan'            => $RKA_Pendapatan,
                            'RKA_Biaya'            => $RKA_Biaya,
                            'RKA_Laba_Rugi'            => $RKA_Laba_Rugi,
                            'Pencapaian_VS_RKA_Pendapatan'            => $Pencapaian_VS_RKA_Pendapatan,
                            'Pencapaian_VS_RKA_Biaya'            => $Pencapaian_VS_RKA_Biaya,
                            'Pencapaian_VS_RKA_Laba_Rugi'            => $Pencapaian_VS_RKA_Laba_Rugi,
                            'Total_Pencapaian_Pendapatan'            => $Total_Pencapaian_Pendapatan,
                            'Total_Pencapaian_Biaya'            => $Total_Pencapaian_Biaya,
                            'Total_Pencapaian_Laba_Rugi'            => $Total_Pencapaian_Laba_Rugi,
                            'Total_Pencapaian_BOPO'            => $Total_Pencapaian_BOPO,
                            'Prognosa_sd_Desember_Pendapatan'            => $Prognosa_sd_Desember_Pendapatan,
                            'Prognosa_sd_Desember_Biaya'            => $Prognosa_sd_Desember_Biaya,
                            'Prognosa_sd_Desember_Laba_Rugi'            => $Prognosa_sd_Desember_Laba_Rugi,
                            'user'                   => $this->session->userdata("user_login")['username']

                        );
                    }
                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->layanan->insert_batch($layanan, $temp_data);
                // lastq();
                if ($insert) {
                    // if ($layanan) {
                        $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Berhasil');
                        redirect('Rekapanalisakctotal');
                    // }
                } else {
                    $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('Rekapanalisakctotal');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }

//Tabel Rekap Analisa problem kc selindo ------------------------------------------------------------------------------------------------------------
        }else if ($layanan == 'rekap_analisa_problem_kc_selindo'){
            // cetak_die($layanan);
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $NO = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $KANTOR_CABANG = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $RATAS_ATM = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $AVG_RELIABILITY = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $OFF_OUT_FLM = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $CO_OUT_FLM = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $CODF_OUT_FLM = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $DF_OUT_FLM = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $NT1D_OUT_FLM = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $JUMLAH = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $RPL = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $FLM = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $RPL_ATM_BLN = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                                                                        
                        $temp_data[] = array(
                            'NO'                     => $NO,
                            'KANTOR_CABANG'                => $KANTOR_CABANG,
                            'RATAS_ATM'          => $RATAS_ATM,
                            'AVG_RELIABILITY'              => $AVG_RELIABILITY,
                            'OFF_OUT_FLM'            => $OFF_OUT_FLM,
                            'CO_OUT_FLM'           => $CO_OUT_FLM,
                            'CODF_OUT_FLM'            => $CODF_OUT_FLM,
                            'DF_OUT_FLM'            => $DF_OUT_FLM,
                            'NT1D_OUT_FLM'            => $NT1D_OUT_FLM,
                            'JUMLAH'            => $JUMLAH,
                            'RPL'            => $RPL,
                            'FLM'            => $FLM,
                            'RPL_ATM_BLN'            => $RPL_ATM_BLN,
                            'user'                   => $this->session->userdata("user_login")['username']

                        );
                    }
                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->layanan->insert_batch($layanan, $temp_data);
                // lastq();
                if ($insert) {
                    // if ($layanan) {
                        $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Berhasil');
                        redirect('Rekanalisaproblemkcselindo');
                    // }
                } else {
                    $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('Rekanalisaproblemkcselindo');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }

//Tabel Rekap FLM bg selindo ------------------------------------------------------------------------------------------------------------
        }else if ($layanan == 'rekap_flm_bg_selindo'){
            // cetak_die($layanan);
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $KANTOR_LAYANAN = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $Januari = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Februari = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Maret = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $April = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Mei = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $Juni = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $Juli = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $Agustus = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $Average_ALL = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $AVERAGE_MONTH_ATM_FLM = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                                                                                                
                        $temp_data[] = array(
                            'No'                     => $No,
                            'KANTOR_LAYANAN'         => $KANTOR_LAYANAN,
                            'Januari'                => $Januari,
                            'Februari'               => $Februari,
                            'Maret'                  => $Maret,
                            'April'                  => $April,
                            'Mei'                    => $Mei,
                            'Juni'                   => $Juni,
                            'Juli'                   => $Juli,
                            'Agustus'                => $Agustus,
                            'Average_ALL'            => $Average_ALL,
                            'AVERAGE_MONTH_ATM_FLM'  => $AVERAGE_MONTH_ATM_FLM,
                            'user'                   => $this->session->userdata("user_login")['username']

                        );
                    }
                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->layanan->insert_batch($layanan, $temp_data);
                // lastq();
                if ($insert) {
                    // if ($layanan) {
                        $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Berhasil');
                        redirect('Rekflmbgselindo');
                    // }
                } else {
                    $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('Rekflmbgselindo');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }

//Tabel Rekap Kinerja KC CIT ------------------------------------------------------------------------------------------------------------
        }else if ($layanan == 'rekap_kinerja_kc_cit'){
            // cetak_die($layanan);
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $Laba_Rugi = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Status_Pencapaian_VS_RKA_Pendapatan = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $Status_Pencapaian_VS_RKA_Biaya = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Status_Pencapaian_VS_RKA_Laba_Rugi = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Nama_Kanca = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Nama_Pembina = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Jumlah_CIT = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $RKA_Pendapatan = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $RKA_Biaya = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $RKA_LabaRugi = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $Pencapaian_VS_RKA_Pendapatan = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $Pencapaian_VS_RKA_Biaya = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $Pencapaian_VS_RKA_LabaRugi = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $Laba_Rugi_Per_Bulan_Per_CIT = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $Laba_Rugi_Per_Bulan_Kontribusi_Pekerja = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $Rasio_SDM = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        $Total_Pencapaian_Pendapatan = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                        $Total_Pencapaian_Biaya = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                        $Total_Pencapaian_Laba_Rugi = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                        $Total_Pencapaian_BOPO = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                        $Prognosa_sd_Desember_Pendapatan = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                        $Prognosa_sd_Desember_Biaya = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                        $Prognosa_sd_Desember_Laba_Rugi = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
                                                                                                                        
                        $temp_data[] = array(
                            'Laba_Rugi'                                 => $Laba_Rugi,
                            'Status_Pencapaian_VS_RKA_Pendapatan'       => $Status_Pencapaian_VS_RKA_Pendapatan,
                            'Status_Pencapaian_VS_RKA_Biaya'            => $Status_Pencapaian_VS_RKA_Biaya,
                            'Status_Pencapaian_VS_RKA_Laba_Rugi'        => $Status_Pencapaian_VS_RKA_Laba_Rugi,
                            'Nama_Kanca'                                => $Nama_Kanca,
                            'Nama_Pembina'                              => $Nama_Pembina,
                            'Jumlah_CIT'                                => $Jumlah_CIT,
                            'RKA_Pendapatan'                            => $RKA_Pendapatan,
                            'RKA_Biaya'                                 => $RKA_Biaya,
                            'RKA_LabaRugi'                              => $RKA_LabaRugi,
                            'Pencapaian_VS_RKA_Pendapatan'              => $Pencapaian_VS_RKA_Pendapatan,
                            'Pencapaian_VS_RKA_Biaya'                   => $Pencapaian_VS_RKA_Biaya,
                            'Pencapaian_VS_RKA_LabaRugi'                => $Pencapaian_VS_RKA_LabaRugi,
                            'Laba_Rugi_Per_Bulan_Per_CIT'               => $Laba_Rugi_Per_Bulan_Per_CIT,
                            'Laba_Rugi_Per_Bulan_Kontribusi_Pekerja'    => $Laba_Rugi_Per_Bulan_Kontribusi_Pekerja,
                            'Rasio_SDM'                                 => $Rasio_SDM,
                            'Total_Pencapaian_Pendapatan'               => $Total_Pencapaian_Pendapatan,
                            'Total_Pencapaian_Biaya'                    => $Total_Pencapaian_Biaya,
                            'Total_Pencapaian_Laba_Rugi'                => $Total_Pencapaian_Laba_Rugi,
                            'Total_Pencapaian_BOPO'                     => $Total_Pencapaian_BOPO,
                            'Prognosa_sd_Desember_Pendapatan'           => $Prognosa_sd_Desember_Pendapatan,
                            'Prognosa_sd_Desember_Biaya'                => $Prognosa_sd_Desember_Biaya,
                            'Prognosa_sd_Desember_Laba_Rugi'            => $Prognosa_sd_Desember_Laba_Rugi,
                            'user'                                      => $this->session->userdata("user_login")['username']

                        );
                    }
                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->layanan->insert_batch($layanan, $temp_data);
                // lastq();
                if ($insert) {
                    // if ($layanan) {
                        $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Berhasil');
                        redirect('Rekkinerjakccit');
                    // }
                } else {
                    $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('Rekkinerjakccit');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }

//Tabel Rekap Kinerja KC CRO ------------------------------------------------------------------------------------------------------------
        }else if ($layanan == 'rekap_kinerja_kc_cro'){
            // cetak_die($layanan);
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $Laba_Rugi = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Status_Pencapaian_VS_RKA_Pendapatan = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $Status_Pencapaian_VS_RKA_Biaya = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Status_Pencapaian_VS_RKA_Laba_Rugi = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Nama_Kanca = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Nama_Pembina = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Jumlah_ATM = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $RKA_Pendapatan_Invoice = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $RKA_Biaya = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $RKA_Laba_Rugi = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $Pencapaian_VS_RKA_Pendapatan_Invoice = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $Pencapaian_VS_RKA_Biaya = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $Pencapaian_VS_RKA_LabaRugi = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $Laba_Rugi_Per_Bulan_Per_ATM = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $Laba_Rugi_Per_Bulan_Kontribusi_Pekerja = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $Rasio_SDM = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        $Total_Pencapaian_Pendapatan_Invoice = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                        $Total_Pencapaian_Biaya = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                        $Total_Pencapaian_Laba_Rugi = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                        $Total_Pencapaian_BOPO = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                        $Prognosa_sd_Desember_Pendapatan_Invoice = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                        $Prognosa_sd_Desember_Biaya = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                        $Prognosa_sd_Desember_Laba_Rugi = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
                                                                                                                        
                        $temp_data[] = array(
                            'Laba_Rugi'                                 => $Laba_Rugi,
                            'Status_Pencapaian_VS_RKA_Pendapatan'       => $Status_Pencapaian_VS_RKA_Pendapatan,
                            'Status_Pencapaian_VS_RKA_Biaya'            => $Status_Pencapaian_VS_RKA_Biaya,
                            'Status_Pencapaian_VS_RKA_Laba_Rugi'        => $Status_Pencapaian_VS_RKA_Laba_Rugi,
                            'Nama_Kanca'                                => $Nama_Kanca,
                            'Nama_Pembina'                              => $Nama_Pembina,
                            'Jumlah_ATM'                                => $Jumlah_ATM,
                            'RKA_Pendapatan_Invoice'                    => $RKA_Pendapatan_Invoice,
                            'RKA_Biaya'                                 => $RKA_Biaya,
                            'RKA_Laba_Rugi'                             => $RKA_Laba_Rugi,
                            'Pencapaian_VS_RKA_Pendapatan_Invoice'      => $Pencapaian_VS_RKA_Pendapatan_Invoice,
                            'Pencapaian_VS_RKA_Biaya'                   => $Pencapaian_VS_RKA_Biaya,
                            'Pencapaian_VS_RKA_LabaRugi'                => $Pencapaian_VS_RKA_LabaRugi,
                            'Laba_Rugi_Per_Bulan_Per_ATM'               => $Laba_Rugi_Per_Bulan_Per_ATM,
                            'Laba_Rugi_Per_Bulan_Kontribusi_Pekerja'    => $Laba_Rugi_Per_Bulan_Kontribusi_Pekerja,
                            'Rasio_SDM'                                 => $Rasio_SDM,
                            'Total_Pencapaian_Pendapatan_Invoice'       => $Total_Pencapaian_Pendapatan_Invoice,
                            'Total_Pencapaian_Biaya'                    => $Total_Pencapaian_Biaya,
                            'Total_Pencapaian_Laba_Rugi'                => $Total_Pencapaian_Laba_Rugi,
                            'Total_Pencapaian_BOPO'                     => $Total_Pencapaian_BOPO,
                            'Prognosa_sd_Desember_Pendapatan_Invoice'   => $Prognosa_sd_Desember_Pendapatan_Invoice,
                            'Prognosa_sd_Desember_Biaya'                => $Prognosa_sd_Desember_Biaya,
                            'Prognosa_sd_Desember_Laba_Rugi'            => $Prognosa_sd_Desember_Laba_Rugi,
                            'user'                                      => $this->session->userdata("user_login")['username']

                        );
                    }
                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->layanan->insert_batch($layanan, $temp_data);
                // lastq();
                if ($insert) {
                    // if ($layanan) {
                        $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Berhasil');
                        redirect('Rekkinerjakccro');
                    // }
                } else {
                    $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('Rekkinerjakccro');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }
//Tabel Rekap Persediaan Log KC ------------------------------------------------------------------------------------------------------------
        }else if ($layanan == 'rekap_persedian_log_kc'){
            // cetak_die($layanan);
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Nama_Barang = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $Spesifikasi_Terperinci = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Jumlah = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Satuan = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Harga_per_pcs = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Subtotal = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $Keperluan_KC_BG = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $Diterima = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $Bulan = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $Kanca = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $Barang = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                                                                                                                                                
                        $temp_data[] = array(
                            'No'                                 => $No,
                            'Nama_Barang'                        => $Nama_Barang,
                            'Spesifikasi_Terperinci'             => $Spesifikasi_Terperinci,
                            'Jumlah'                             => $Jumlah,
                            'Satuan'                             => $Satuan,
                            'Harga_per_pcs'                      => $Harga_per_pcs,
                            'Subtotal'                           => $Subtotal,
                            'Keperluan_KC_BG'                    => $Keperluan_KC_BG,
                            'Diterima'                           => $Diterima,
                            'Bulan'                              => $Bulan,
                            'Kanca'                              => $Kanca,
                            'Barang'                             => $Barang,
                            'user'                               => $this->session->userdata("user_login")['username']

                        );
                    }
                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->layanan->insert_batch($layanan, $temp_data);
                // lastq();
                if ($insert) {
                    // if ($layanan) {
                        $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Berhasil');
                        redirect('Rekpersedianlogkc');
                    // }
                } else {
                    $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('Rekpersedianlogkc');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }
//Tabel Rekap RPL BG Selindo ------------------------------------------------------------------------------------------------------------
        }else if ($layanan == 'rekap_rpl_bg_selindo'){
            // cetak_die($layanan);
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $KANTOR_LAYANAN = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $Januari = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Februari = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Maret = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $April = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Mei = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $Juni = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $Juli = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $Agustus = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $September = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $Oktober = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $November = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $Desember = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $Average_ALL = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        $AVERAGE_MONTH_ATM_Replenish = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                                                                                                
                        $temp_data[] = array(
                            'No'                     => $No,
                            'KANTOR_LAYANAN'         => $KANTOR_LAYANAN,
                            'Januari'                => $Januari,
                            'Februari'               => $Februari,
                            'Maret'                  => $Maret,
                            'April'                  => $April,
                            'Mei'                    => $Mei,
                            'Juni'                   => $Juni,
                            'Juli'                   => $Juli,
                            'Agustus'                => $Agustus,
                            'September'                => $September,
                            'Oktober'                => $Oktober,
                            'November'                => $November,
                            'Desember'                => $Desember,
                            'Average_ALL'            => $Average_ALL,
                            'AVERAGE_MONTH_ATM_Replenish'  => $AVERAGE_MONTH_ATM_Replenish,
                            'user'                   => $this->session->userdata("user_login")['username']

                        );
                    }
                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->layanan->insert_batch($layanan, $temp_data);
                // lastq();
                if ($insert) {
                    // if ($layanan) {
                        $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Berhasil');
                        redirect('Rekrplbgselindo');
                    // }
                } else {
                    $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('Rekrplbgselindo');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }

//Tabel Rekon ATM Bank BJB ------------------------------------------------------------------------------------------------------------
        }else if ($layanan == 'rekon_atm_bank_bjb'){
            // cetak_die($layanan);
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $BJB = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $TOTAL_PENGISIAN = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $PENGOSONGAN = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $BG = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $TOTAL_PENGISIAN1 = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $SELISIH = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        // $TANGGAL_1 = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $TANGGAL_1_row = $worksheet->getCellByColumnAndRow(7, $row);
                        $TANGGAL_1 = $TANGGAL_1_row->getValue();
                        if(PHPExcel_Shared_Date::isDateTime($TANGGAL_1_row)) {
                             $TANGGAL_1 = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($TANGGAL_1)); 
                        }
                        // $TANGGAL_2 = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $TANGGAL_2_row = $worksheet->getCellByColumnAndRow(8, $row);
                        $TANGGAL_2 = $TANGGAL_2_row->getValue();
                        if(PHPExcel_Shared_Date::isDateTime($TANGGAL_2_row)) {
                             $TANGGAL_2 = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($TANGGAL_2)); 
                        }
                        // $TANGGAL_3 = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $TANGGAL_3_row = $worksheet->getCellByColumnAndRow(9, $row);
                        $TANGGAL_3 = $TANGGAL_3_row->getValue();
                        if(PHPExcel_Shared_Date::isDateTime($TANGGAL_3_row)) {
                             $TANGGAL_3 = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($TANGGAL_3)); 
                        }
                        
                                                                                                
                        $temp_data[] = array(
                            'No'                     => $No,
                            'BJB'                    => $BJB,
                            'TOTAL_PENGISIAN'        => $TOTAL_PENGISIAN,
                            'PENGOSONGAN'            => $PENGOSONGAN,
                            'BG'                     => $BG,
                            'TOTAL_PENGISIAN1'       => $TOTAL_PENGISIAN1,
                            'SELISIH'                => $SELISIH,
                            'TANGGAL_1'              => $TANGGAL_1,
                            'TANGGAL_2'              => $TANGGAL_2,
                            'TANGGAL_3'              => $TANGGAL_3,
                            'user'                   => $this->session->userdata("user_login")['username']

                        );
                    }
                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->layanan->insert_batch($layanan, $temp_data);
                // lastq();
                if ($insert) {
                    // if ($layanan) {
                        $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Berhasil');
                        redirect('Rekatmbankbjb');
                    // }
                } else {
                    $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('Rekatmbankbjb');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }

//Tabel Rekon FLM Bank BJB ------------------------------------------------------------------------------------------------------------
        }else if ($layanan == 'rekon_flm_bank_bjb'){
            // cetak_die($layanan);
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $NO = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $VERSI_MONITORING = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $ID_ATM = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $NAMA_ATM = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $PROBLEM = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        // $TANGGAL = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $TANGGAL_row = $worksheet->getCellByColumnAndRow(5, $row);
                        $TANGGAL = $TANGGAL_row->getValue();
                        if(PHPExcel_Shared_Date::isDateTime($TANGGAL_row)) {
                             $TANGGAL = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($TANGGAL)); 
                        }
                        $WAKTU_REQUEST = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $NO_TIKET = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $VERSI_BG = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $ID_ATM1 = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $NAMA_ATM1 = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $PROBLEM1 = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        // $TANGGAL1 = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $TANGGAL1_row = $worksheet->getCellByColumnAndRow(5, $row);
                        $TANGGAL1 = $TANGGAL1_row->getValue();
                        if(PHPExcel_Shared_Date::isDateTime($TANGGAL1_row)) {
                             $TANGGAL1 = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($TANGGAL1)); 
                        }
                        $WAKTU_REQUEST1 = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $NO_TIKET_CATATAN_BG = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                       
                        
                                                                                                
                        $temp_data[] = array(
                            'NO'                     => $NO,
                            'VERSI_MONITORING'       => $VERSI_MONITORING,
                            'ID_ATM'                 => $ID_ATM,
                            'NAMA_ATM'               => $NAMA_ATM,
                            'PROBLEM'                => $PROBLEM,
                            'TANGGAL'                => $TANGGAL,
                            'WAKTU_REQUEST'          => $WAKTU_REQUEST,
                            'NO_TIKET'               => $NO_TIKET,
                            'VERSI_BG'               => $VERSI_BG,
                            'ID_ATM1'                => $ID_ATM1,
                            'NAMA_ATM1'              => $NAMA_ATM1,
                            'PROBLEM1'                => $PROBLEM1,
                            'TANGGAL1'                => $TANGGAL1,
                            'WAKTU_REQUEST1'         => $WAKTU_REQUEST1,
                            'NO_TIKET_CATATAN_BG'    => $NO_TIKET_CATATAN_BG,
                            'user'                   => $this->session->userdata("user_login")['username']

                        );
                    }
                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->layanan->insert_batch($layanan, $temp_data);
                // lastq();
                if ($insert) {
                    // if ($layanan) {
                        $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Berhasil');
                        redirect('Rekflmbankbjb');
                    // }
                } else {
                    $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('Rekflmbankbjb');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }

//Tabel Data SM ---------------------------------------------------------------------------------------------------------------
        }else if ($layanan == 'data_sm'){
            // cetak_die($layanan);
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $NO = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $KANTOR_LAYANAN = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $TID = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $SN = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $LOKASI = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $KANWIL = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $GARANSI = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $DONE_SM = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $BELUM_SM = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        // $TANGGAL_SM = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $TANGGAL_SM_row = $worksheet->getCellByColumnAndRow(9, $row);
                        $TANGGAL_SM = $TANGGAL_SM_row->getValue();
                        if(PHPExcel_Shared_Date::isDateTime($TANGGAL_SM_row)) {
                             $TANGGAL_SM = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($TANGGAL_SM)); 
                        }
                        $KETERANGAN = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                                                                                                                        
                        $temp_data[] = array(
                            'NO'                     => $NO,
                            'KANTOR_LAYANAN'         => $KANTOR_LAYANAN,
                            'TID'                    => $TID,
                            'SN'                     => $SN,
                            'LOKASI'                 => $LOKASI,
                            'KANWIL'                 => $KANWIL,
                            'GARANSI'                => $GARANSI,
                            'DONE_SM'                => $DONE_SM,
                            'BELUM_SM'               => $BELUM_SM,
                            'TANGGAL_SM'             => $TANGGAL_SM,
                            'KETERANGAN'              => $KETERANGAN,
                            'user'                   => $this->session->userdata("user_login")['username']

                        );
                    }
                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->layanan->insert_batch($layanan, $temp_data);
                // lastq();
                if ($insert) {
                    // if ($layanan) {
                        $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Berhasil');
                        redirect('Datasm');
                    // }
                } else {
                    $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('Datasm');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }

        }
    }
}
