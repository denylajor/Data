<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CHM extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('excel', 'session'));
        $this->chm = $this->load->database('default', TRUE);
        if (!$this->session->userdata("user_login")) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data = array(

            // 'inserttable' => $this->General->fetch_CoustomQuery("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='db_chm'"),
        );

        cekPergroup();
        $this->header('CHM');
        $this->load->view('CHM/chm', $data);
        $this->footer();
    }



    public function import_excel()
    {
        $chm = input('chm');
        if ($chm == 'tbl_data_aset') {
            // cetak_die($chm);
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $no = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $term_id = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $lokasi = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $alamat = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $kantor_layanan = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $uker_induk = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $cluster = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $jam_operational = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $garansi = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $cctv_ada = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $cctv_tidak_ada = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $ups_ada = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $ups_tidak_ada = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $latitude = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $longitude = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $pagu = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        $denom = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                        $keterangan = $worksheet->getCellByColumnAndRow(17, $row)->getValue();

                        // for ($x = 2; $x <= $highestRow; $x++) {
                        $temp_data[] = array(
                            'no'    => $no,
                            'term_id'    => $term_id,
                            'lokasi'    => $lokasi,
                            'alamat'    => $alamat,
                            'kantor_layanan'    => $kantor_layanan,
                            'uker_induk'    => $uker_induk,
                            'cluster'    => $cluster,
                            'jam_operational'    => $jam_operational,
                            'garansi'    => $garansi,
                            'cctv_ada'    => $cctv_ada,
                            'cctv_tidak_ada'    => $cctv_tidak_ada,
                            'ups_ada'    => $ups_ada,
                            'ups_tidak_ada'    => $ups_tidak_ada,
                            'latitude'    => $latitude,
                            'longitude'    => $longitude,
                            'pagu'    => $pagu,
                            'denom'    => $denom,
                            'keterangan'    => $keterangan,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                        // }
                        // cetak_die($temp_data);
                    }
                }
                // $this->load->model('ImportModel');
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', '<span class="glyphicon glyphicon-ok">Berhasil</span> ');
                    redirect('DataAset');
                } else {
                    $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('DataAset');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }

            //Tabel CM ------------------------------------------------------------------------------------------------------------
        } else if ($chm == 'tbl_cm') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $no = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $terminal_id = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $sn = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $echannel = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $kanwil = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $kanca = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $lokasi = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $teknisi_vendor = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $no_tiketvendor = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $pet_bri = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        // $open_tiket_date = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $open_tiket_row = $worksheet->getCellByColumnAndRow(10, $row);
                        $open_tiket_date = $open_tiket_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($open_tiket_row)) {
                            $open_tiket_date = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($open_tiket_date));
                        }
                        // $arrive_date = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $arrive_date_row = $worksheet->getCellByColumnAndRow(11, $row);
                        $arrive_date = $arrive_date_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($arrive_date_row)) {
                            $arrive_date = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($arrive_date));
                        }
                        // $start_working = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $start_working_row = $worksheet->getCellByColumnAndRow(10, $row);
                        $start_working = $start_working_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($start_working_row)) {
                            $start_working = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($start_working));
                        }
                        // $finish_working = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $finish_working_row = $worksheet->getCellByColumnAndRow(10, $row);
                        $finish_working = $finish_working_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($finish_working_row)) {
                            $finish_working = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($finish_working));
                        }
                        $problem_description = $worksheet->getCellByColumnAndRow(14, $row)->getValue();

                        $temp_data[] = array(
                            'no'    => $no,
                            'terminal_id'    => $terminal_id,
                            'sn'    => $sn,
                            'echannel'    => $echannel,
                            'kanwil'    => $kanwil,
                            'kanca'    => $kanca,
                            'lokasi'    => $lokasi,
                            'teknisi_vendor'    => $teknisi_vendor,
                            'no_tiketvendor'    => $no_tiketvendor,
                            'pet_bri'    => $pet_bri,
                            'open_tiket_date'    => $open_tiket_date,
                            'arrive_date'    => $arrive_date,
                            'start_working'    => $start_working,
                            'finish_working'    => $finish_working,
                            'problem_description'    => $problem_description,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                    }
                }

                // $this->load->model('ImportModel');

                $insert = $this->chm->insert_batch($chm, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', '<span class="glyphicon glyphicon-ok">Berhasil</span> ');
                    redirect('CM');
                } else {
                    $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('CM');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }

            //Tabel Detail Part ------------------------------------------------------------------------------------------------------------
        } else if ($chm == 'tbl_detailpart') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $no = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $tiket_ma = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $part_problem = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $description = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $tindak_lanjut = $worksheet->getCellByColumnAndRow(4, $row)->getValue();

                        $temp_data[] = array(
                            'tiket_ma'    => $tiket_ma,
                            'part_problem'    => $part_problem,
                            'part_problem'    => $part_problem,
                            'description'    => $description,
                            'tindak_lanjut'    => $tindak_lanjut,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                    }
                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', '<span class="glyphicon glyphicon-ok">Berhasil</span> ');
                    redirect('Detailpart');
                } else {
                    $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('Detailpart');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }

            //Tabel PM ------------------------------------------------------------------------------------------------------------
        } else if ($chm == 'tbl_pm') {
            // cetak_die($chm);
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $no = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $terminal_id = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $project = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $sn = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        // $start_warranty = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $start_warranty_row = $worksheet->getCellByColumnAndRow(4, $row);
                        $start_warranty = $start_warranty_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($start_warranty_row)) {
                            $start_warranty = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($start_warranty));
                        }
                        // $end_warranty = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $end_warranty_row = $worksheet->getCellByColumnAndRow(5, $row);
                        $end_warranty = $end_warranty_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($end_warranty_row)) {
                            $end_warranty = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($end_warranty));
                        }
                        $kanwil = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $kanca = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $lokasi = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $teknisi_vendor = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $no_tiket = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        // $open_tiket_date = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $open_tiket_date_row = $worksheet->getCellByColumnAndRow(11, $row);
                        $open_tiket_date = $open_tiket_date_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($open_tiket_date_row)) {
                            $open_tiket_date = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($open_tiket_date));
                        }
                        $kunjungan = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $keterangan_lain = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        // $bulan = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $bulan_row = $worksheet->getCellByColumnAndRow(14, $row);
                        $bulan = $bulan_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($bulan_row)) {
                            $bulan = date($format = "m-d", PHPExcel_Shared_Date::ExcelToPHP($bulan));
                        }


                        $temp_data[] = array(
                            'no'    => $no,
                            'terminal_id'    => $terminal_id,
                            'project'    => $project,
                            'sn'    => $sn,
                            'start_warranty'    => $start_warranty,
                            'end_warranty' => $end_warranty,
                            'kanwil' => $kanwil,
                            'kanca' => $kanca,
                            'lokasi' => $lokasi,
                            'teknisi_vendor' => $teknisi_vendor,
                            'no_tiket'    => $no_tiket,
                            'open_tiket_date'    => $open_tiket_date,
                            'kunjungan'    => $kunjungan,
                            'keterangan_lain'    => $keterangan_lain,
                            'bulan'    => $bulan,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                    }
                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', '<span class="glyphicon glyphicon-ok">Berhasil</span> ');
                    redirect('PM');
                } else {
                    $this->session->set_flashdata('warning', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('PM');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }

            //Off In FLM ----------------------------------------------------------------------------------------------------------
        } else if ($chm == 'tbl_off_in_flm') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $no_off_in_flm = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $tid = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $db = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $region = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $branch = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $ip_addr = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $kanwil = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $kc_supervisi = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $pengelola = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $lokasi = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $status = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $problem = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $ticket = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        // $waktu_insert = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $waktu_insert_row = $worksheet->getCellByColumnAndRow(13, $row);
                        $waktu_insert = $waktu_insert_row->getValue();
                        if(PHPExcel_Shared_Date::isDateTime($waktu_insert_row)) {
                             $waktu_insert = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($waktu_insert)); 
                        }
                        $downtime_system = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        // $est_tgl_problem = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        $est_tgl_problem_row = $worksheet->getCellByColumnAndRow(15, $row);
                        $est_tgl_problem = $est_tgl_problem_row->getValue();
                        if(PHPExcel_Shared_Date::isDateTime($est_tgl_problem_row)) {
                             $est_tgl_problem = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($est_tgl_problem)); 
                        }
                        // $last_tunai = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                        $last_tunai_row = $worksheet->getCellByColumnAndRow(16, $row);
                        $last_tunai = $last_tunai_row->getValue();
                        if(PHPExcel_Shared_Date::isDateTime($last_tunai_row)) {
                             $last_tunai = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($last_tunai)); 
                        }
                        $downtime_tunai = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                        $ticket_ojk = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                        $rtl_ticket = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                        // $rtl_update = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                        $rtl_update_row = $worksheet->getCellByColumnAndRow(16, $row);
                        $rtl_update = $rtl_update_row->getValue();
                        if(PHPExcel_Shared_Date::isDateTime($rtl_update_row)) {
                             $rtl_update = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($rtl_update)); 
                        }
                        $rtl_problem = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                        $rtl_group = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
                        $rtl_sla = $worksheet->getCellByColumnAndRow(23, $row)->getValue();
                        $keterangan = $worksheet->getCellByColumnAndRow(24, $row)->getValue();
                        $rtl_keterangan = $worksheet->getCellByColumnAndRow(25, $row)->getValue();
                        $rjt_ticket = $worksheet->getCellByColumnAndRow(26, $row)->getValue();
                        $rjt_keterangan = $worksheet->getCellByColumnAndRow(27, $row)->getValue();


                        $temp_data[] = array(
                            'no_off_in_flm'    => $no_off_in_flm,
                            'tid'    => $tid,
                            'db'    => $db,
                            'region' => $region,
                            'branch' => $branch,
                            'ip_addr'    => $ip_addr,
                            'kanwil' => $kanwil,
                            'kc_supervisi' => $kc_supervisi,
                            'pengelola' => $pengelola,
                            'lokasi' => $lokasi,
                            'status'    => $status,
                            'problem'    => $problem,
                            'ticket'    => $ticket,
                            'waktu_insert'    => $waktu_insert,
                            'downtime_system'    => $downtime_system,
                            'est_tgl_problem'    => $est_tgl_problem,
                            'last_tunai'    => $last_tunai,
                            'downtime_tunai'    => $downtime_tunai,
                            'ticket_ojk'    => $ticket_ojk,
                            'rtl_ticket'    => $rtl_ticket,
                            'rtl_update'    => $rtl_update,
                            'rtl_problem'    => $rtl_problem,
                            'rtl_group'    => $rtl_group,
                            'rtl_sla'    => $rtl_sla,
                            'keterangan'    => $keterangan,
                            'rtl_keterangan'    => $rtl_keterangan,
                            'rjt_ticket'    => $rjt_ticket,
                            'rjt_keterangan'    => $rjt_keterangan,
                            'user' => $this->session->userdata("user_login")['username']

                        );

                        // cetak_die($temp_data);
                    }


                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', '<span class="glyphicon glyphicon-ok">Berhasil</span> ');
                    redirect('Offinflm');
                } else {
                    $this->session->set_flashdata('warning', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('Offinflm');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }

            //Opname ----------------------------------------------------------------------------------------------------------
        } else if ($chm == 'tbl_opname') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $no = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $jenis_barang = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $day_warehouse = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $harga_beli = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $jumlah_item = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $total_harga = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $doi = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $usulan_jumlah_dijual = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $total_harga_usulan = $worksheet->getCellByColumnAndRow(8, $row)->getValue();



                        $temp_data[] = array(
                            'no'    => $no,
                            'jenis_barang'    => $jenis_barang,
                            'day_warehouse'    => $day_warehouse,
                            'harga_beli'    => $harga_beli,
                            'jumlah_item'    => $jumlah_item,
                            'total_harga' => $total_harga,
                            'doi' => $doi,
                            'usulan_jumlah_dijual' => $usulan_jumlah_dijual,
                            'total_harga_usulan' => $total_harga_usulan,
                            'user' => $this->session->userdata("user_login")['username']

                        );

                        // cetak_die($temp_data);
                    }


                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', '<span class="glyphicon glyphicon-ok">Berhasil</span> ');
                    redirect('Opname');
                } else {
                    $this->session->set_flashdata('warning', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('Opname');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }

            //Opname Part----------------------------------------------------------------------------------------------------------
        } else if ($chm == 'tbl_opnamepart') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $no = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $nama_barang = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $kode_barang = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $stok_awal = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $part_masuk = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $part_keluar = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $stok_akhir = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $total = $worksheet->getCellByColumnAndRow(7, $row)->getValue();


                        $temp_data[] = array(
                            'no'    => $no,
                            'nama_barang'    => $nama_barang,
                            'kode_barang'    => $kode_barang,
                            'stok_awal'    => $stok_awal,
                            'part_masuk'    => $part_masuk,
                            'part_keluar' => $part_keluar,
                            'stok_akhir' => $stok_akhir,
                            'total' => $total,
                            'user' => $this->session->userdata("user_login")['username']

                        );

                        // cetak_die($temp_data);
                    }


                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', '<span class="glyphicon glyphicon-ok">Berhasil</span> ');
                    redirect('Opnamepart');
                } else {
                    $this->session->set_flashdata('warning', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
                    redirect('Opnamepart');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }

            //Reability Perform----------------------------------------------------------------------------------------------------------
        } else if ($chm == 'tbl_reability') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $NO = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $TID = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $SN_Mesin = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Tiket_MA = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Tiket_ECH = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Jenis = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Vendor = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $Kanwil = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $Kanca = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $Lokasi = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        // $Tgl = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $tgl_row = $worksheet->getCellByColumnAndRow(10, $row);
                        $Tgl = $tgl_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($tgl_row)) {
                            $Tgl = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Tgl));
                        }
                        $Downtime = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $In_Out_SLA = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $Problem = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $Engineer = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $Status = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        $Part = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                        $Action = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                        $Kondisi_Part = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                        $Keterangan = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                        $KOMITMEN_PENYELESAIAN = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                        // $Tgl_Close = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                        $tgl_close_row = $worksheet->getCellByColumnAndRow(21, $row);
                        $Tgl_Close = $tgl_close_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($tgl_close_row)) {
                            $Tgl_Close = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Tgl_Close));
                        }
                        $SLA = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
                        $Penyelesaian = $worksheet->getCellByColumnAndRow(23, $row)->getValue();
                        // $Tgl_req = $worksheet->getCellByColumnAndRow(24, $row)->getValue();
                        $tgl_req_row = $worksheet->getCellByColumnAndRow(24, $row);
                        $Tgl_req = $tgl_req_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($tgl_req_row)) {
                            $Tgl_req = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Tgl_req));
                        }
                        // $Tgl_Kirim = $worksheet->getCellByColumnAndRow(25, $row)->getValue();
                        $tgl_kirim_row = $worksheet->getCellByColumnAndRow(25, $row);
                        $Tgl_Kirim = $tgl_kirim_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($tgl_kirim_row)) {
                            $Tgl_Kirim = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Tgl_Kirim));
                        }
                        // $Tgl_Terima = $worksheet->getCellByColumnAndRow(26, $row)->getValue();
                        $tgl_terima_row = $worksheet->getCellByColumnAndRow(26, $row);
                        $Tgl_Terima = $tgl_terima_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($tgl_terima_row)) {
                            $Tgl_Terima = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Tgl_Terima));
                        }

                        $temp_data[] = array(
                            'NO'    => $NO,
                            'TID'    => $TID,
                            'SN_Mesin'    => $SN_Mesin,
                            'Tiket_MA'    => $Tiket_MA,
                            'Tiket_ECH'    => $Tiket_ECH,
                            'Jenis' => $Jenis,
                            'Vendor' => $Vendor,
                            'Kanwil' => $Kanwil,
                            'Kanca' => $Kanca,
                            'Lokasi' => $Lokasi,
                            'Tgl' => $Tgl,
                            'Downtime' => $Downtime,
                            'In_Out_SLA' => $In_Out_SLA,
                            'Problem' => $Problem,
                            'Engineer' => $Engineer,
                            'Status' => $Status,
                            'Part' => $Part,
                            'Action' => $Action,
                            'Kondisi_Part' => $Kondisi_Part,
                            'Keterangan' => $Keterangan,
                            'KOMITMEN_PENYELESAIAN' => $KOMITMEN_PENYELESAIAN,
                            'Tgl_Close' => $Tgl_Close,
                            'SLA' => $SLA,
                            'Penyelesaian' => $Penyelesaian,
                            'Tgl_req' => $Tgl_req,
                            'Tgl_Kirim' => $Tgl_Kirim,
                            'Tgl_Terima' => $Tgl_Terima,
                            'user' => $this->session->userdata("user_login")['username']

                        );

                        // cetak_die($temp_data);
                    }


                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', '<span class="glyphicon glyphicon-ok">Berhasil</span> ');
                    redirect('Reabilityperform');
                } else {
                    $this->session->set_flashdata('warning', '<span class="glyphicon glyphicon-remove">Terjadi Kesalahan</span> ');
                    redirect('Reabilityperform');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }

            // Problem Report (CC)----------------------------------------------------------------------------------------------------------
        } else if ($chm == 'tbl_problem_report_cc') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $ID_Term = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Lokasi = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Project = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Serial_Number = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Problem_Description = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        // $Date_Report = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $Date_Report = $worksheet->getCellByColumnAndRow(7, $row);
                        $DR = $Date_Report->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($Date_Report)) {
                            $DR = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($DR));
                        }

                        // $Date_Close = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $Date_Close = $worksheet->getCellByColumnAndRow(8, $row);
                        $DC = $Date_Close->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($Date_Close)) {
                            $DC = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($DC));
                        }

                        $Ticket_Number = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $Status = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $Note = $worksheet->getCellByColumnAndRow(11, $row)->getValue();


                        $temp_data[] = array(
                            'No'                     => $No,
                            'Name'                   => $Name,
                            'ID_Term'                => $ID_Term,
                            'Lokasi'                 => $Lokasi,
                            'Project'                => $Project,
                            'Serial_Number'          => $Serial_Number,
                            'Problem_Description'    => $Problem_Description,
                            'Date_Report'            => $DR,
                            'Date_Close'             => $DC,
                            'Ticket_Number'          => $Ticket_Number,
                            'Status'                 => $Status,
                            'Note'                   => $Note,
                            'user'                   => $this->session->userdata("user_login")['username']

                        );

                        // cetak_die($temp_data);
                    }


                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', '<span class="glyphicon glyphicon-ok">Berhasil</span> ');
                    redirect('ProblemReportCC');
                } else {
                    $this->session->set_flashdata('warning', '<span class="glyphicon glyphicon-remove">Terjadi Kesalahan</span> ');
                    redirect('ProblemReportCC');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }


            // Report Portal BRI Maintenace Agreement (CC)----------------------------------------------------------------------------------------------------------
        } else if ($chm == 'tbl_report_portal_BRI_MA_cc') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $TID = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $Ticket_MA = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Part_Problem = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Description = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Tidak_Lanjut = $worksheet->getCellByColumnAndRow(5, $row)->getValue();

                        $temp_data[] = array(
                            'No'              => $No,
                            'TID'             => $TID,
                            'Ticket_MA'       => $Ticket_MA,
                            'Part_Problem'    => $Part_Problem,
                            'Description'     => $Description,
                            'Tidak_Lanjut'    => $Tidak_Lanjut,
                            'user'            => $this->session->userdata("user_login")['username']

                        );

                        // cetak_die($temp_data);
                    }


                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', '<span class="glyphicon glyphicon-ok">Berhasil</span> ');
                    redirect('ReportPortalBRIMACC');
                } else {
                    $this->session->set_flashdata('warning', '<span class="glyphicon glyphicon-remove">Terjadi Kesalahan</span> ');
                    redirect('ReportPortalBRIMACC');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }

            // Report SSB & Hybrid (CC)----------------------------------------------------------------------------------------------------------
        } else if ($chm == 'tbl_report_ssb_hybrid_cc') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Kanwil = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $Kanca = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Lokasi = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $ID_Term = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Mesin = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Problem = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $Nama_Part = $worksheet->getCellByColumnAndRow(7, $row)->getValue();

                        // $Date_Report = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $Date_Report_row = $worksheet->getCellByColumnAndRow(8, $row);
                        $Date_Report = $Date_Report_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($Date_Report_row)) {
                            $Date_Report = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Date_Report));
                        }

                        $Downtime_Ticket = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $In_Out_SLA = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $Ticket_Number = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $Status = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $Keterangan = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $SLA = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $SLA_1 = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        $Penyelesaian = $worksheet->getCellByColumnAndRow(16, $row)->getValue();

                        $temp_data[] = array(
                            'No'                 => $No,
                            'Kanwil'             => $Kanwil,
                            'Kanca'              => $Kanca,
                            'Lokasi'             => $Lokasi,
                            'ID_Term'            => $ID_Term,
                            'Mesin'              => $Mesin,
                            'Problem'            => $Problem,
                            'Nama_Part'          => $Nama_Part,
                            'Date_Report'        => $Date_Report,
                            'Downtime_Ticket'    => $Downtime_Ticket,
                            'In_Out_SLA'         => $In_Out_SLA,
                            'Ticket_Number'      => $Ticket_Number,
                            'Status'             => $Status,
                            'Keterangan'         => $Keterangan,
                            'SLA'                => $SLA,
                            'SLA_1'              => $SLA_1,
                            'Penyelesaian'       => $Penyelesaian,
                            'user'               => $this->session->userdata("user_login")['username']
                        );

                        // cetak_die($temp_data);
                    }


                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', '<span class="glyphicon glyphicon-ok">Berhasil</span> ');
                    redirect('ReportSSBHybridCC');
                } else {
                    $this->session->set_flashdata('warning', '<span class="glyphicon glyphicon-remove">Terjadi Kesalahan</span> ');
                    redirect('ReportSSBHybridCC');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }


            // Technical Report (CC)----------------------------------------------------------------------------------------------------------
        } else if ($chm == 'tbl_technical_report_cc') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $Id_Term = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Location = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Project = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Problem = $worksheet->getCellByColumnAndRow(5, $row)->getValue();

                        // $Date_Close = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $Date_Close_row = $worksheet->getCellByColumnAndRow(6, $row);
                        $Date_Close = $Date_Close_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($Date_Close_row)) {
                            $Date_Close = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Date_Close));
                        }

                        $Ticket_Number = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $Note = $worksheet->getCellByColumnAndRow(8, $row)->getValue();

                        $temp_data[] = array(
                            'No'             => $No,
                            'Name'           => $Name,
                            'Id_Term'        => $Id_Term,
                            'Location'       => $Location,
                            'Project'        => $Project,
                            'Problem'        => $Problem,
                            'Date_Close'     => $Date_Close,
                            'Ticket_Number'  => $Ticket_Number,
                            'Note'           => $Note,
                            'user'           => $this->session->userdata("user_login")['username']
                        );

                        // cetak_die($temp_data);
                    }


                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', '<span class="glyphicon glyphicon-ok">Berhasil</span> ');
                    redirect('TechnicalReportCC');
                } else {
                    $this->session->set_flashdata('warning', '<span class="glyphicon glyphicon-remove">Terjadi Kesalahan</span> ');
                    redirect('TechnicalReportCC');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }
        }
    }
}

/* End of file Barang.php */
