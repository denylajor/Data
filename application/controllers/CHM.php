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

        // cekPergroup();
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
                        //delete data
                        $this->db->query("DELETE FROM Div_CHM.tbl_data_aset WHERE term_id = '".$term_id."'");
                        // lastq();
                    }
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('DataAset');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
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
                        //delete data
                        $this->db->query("DELETE FROM Div_CHM.tbl_cm WHERE terminal_id = '".$terminal_id."' ");
                    }
                }

                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('CM');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
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
                            'no'    => $no,
                            'tiket_ma'    => $tiket_ma,
                            'part_problem'    => $part_problem,
                            'part_problem'    => $part_problem,
                            'description'    => $description,
                            'tindak_lanjut'    => $tindak_lanjut,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                    }
                    //delete data
                    // $this->db->query("DELETE FROM Div_CHM.tbl_detailpart WHERE ");
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Detailpart');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
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
                    // delete data
                    $this->db->query("DELETE FROM Div_CHM.tbl_pm WHERE terminal_id = '".$terminal_id."'");
                    }
                }
                // $this->load->model('ImportModel');
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('PM');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
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
                        // delete data
                        $this->db->query("DELETE FROM Div_CHM.tbl_off_in_flm WHERE tid = '".$tid."'");
                    }
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Offinflm');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
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
                        //delete data
                        $this->db->query("DELETE FROM Div_CHM.tbl_opname WHERE jenis_barang = '".$jenis_barang."'");
                    }

                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Opname');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Opname');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }

            //Opname Part------------------------------------------------------------------------------------------------------------
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
                        // $update = $this->db->query("SELECT * FROM Div_CHM.tbl_opnamepart WHERE kode_barang = '" . $kode_barang . "'");
                        $this->db->query("DELETE FROM Div_CHM.tbl_opnamepart WHERE kode_barang = '".$kode_barang."'");
                        // lastq();
                    }
                           // $insert = $this->chm->update_batch($chm,$temp_data,'kode_barang');
                           $insert = $this->chm->insert_batch($chm, $temp_data);
                }
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Opnamepart');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
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
                        //delete data
                        // $this->db->query("DELETE FROM Div_CHM.tbl_reability WHERE TID = '".$TID."'");
                    }
                    cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Reabilityperform');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
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
                        //delete data
                        $this->db->query("DELETE FROM Div_CHM.tbl_problem_report_cc WHERE ID_Term = '".$ID_Term."'");
                    }
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('ProblemReportCC');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
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
                        //delete data
                        $this->db->query("DELETE FROM Div_CHM.tbl_report_portal_BRI_MA_cc WHERE TID = '".$TID."'");
                    }
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('ReportPortalBRIMACC');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
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
                        //delete data
                        $this->db->query("DELETE FROM Div_CHM.tbl_report_ssb_hybrid_cc WHERE ID_Term = '".$ID_Term."' ");
                    }
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('ReportSSBHybridCC');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
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
                        //delete data
                        $$this->db->query("DELETE FROM Div_CHM.tbl_technical_report_cc WHERE Id_Term = '".$Id_Term."'");
                    }
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('TechnicalReportCC');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('TechnicalReportCC');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }
            // Kendaraan Logistik----------------------------------------------------------------------------------------------------------
        } else if ($chm == 'tbl_kendaraan_logistik') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $codeuker = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $cabang = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $tnbk_kend = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $tahun_kend = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $type_kend = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $rangka_kend = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $no_mesin_kend = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $status_kend = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $project = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $unit_layanan = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $gsm_gps = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $imei_gps = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $status_gps = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $vendor_kend = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $awal_berlaku_kend = $worksheet->getCellByColumnAndRow(15, $row);
                        $AwalBerlakuKend = $awal_berlaku_kend->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($awal_berlaku_kend)) {
                            $AwalBerlakuKend = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($AwalBerlakuKend));
                        }
                        $akhir_berlaku_kend = $worksheet->getCellByColumnAndRow(16, $row);
                        $AkhirBerlakuKend = $akhir_berlaku_kend->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($akhir_berlaku_kend)) {
                            $AkhirBerlakuKend = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($AkhirBerlakuKend));
                        }
                        $masa_berlaku_stnk = $worksheet->getCellByColumnAndRow(17, $row);
                        $MasaBerlakuSTNK = $masa_berlaku_stnk->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($masa_berlaku_stnk)) {
                            $MasaBerlakuSTNK = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($MasaBerlakuSTNK));
                        }
                        $masa_berlaku_tnbk = $worksheet->getCellByColumnAndRow(18, $row);
                        $MasaBerlakuTNBK = $masa_berlaku_tnbk->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($masa_berlaku_tnbk)) {
                            $MasaBerlakuTNBK = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($MasaBerlakuTNBK));
                        }
                        $masa_berlaku_kir = $worksheet->getCellByColumnAndRow(19, $row);
                        $MasaBerlakuKir = $masa_berlaku_kir->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($masa_berlaku_kir)) {
                            $MasaBerlakuKir = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($MasaBerlakuKir));
                        }
                        $safety_box = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                        $jenis_kend = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                        $keterangan = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
                        $cek_data = $worksheet->getCellByColumnAndRow(23, $row)->getValue();

                        $temp_data[] = array(
                            'id'                    => $id,
                            'codeuker'              => $codeuker,
                            'cabang'                => $cabang,
                            'tnbk_kend'             => $tnbk_kend,
                            'tahun_kend'            => $tahun_kend,
                            'type_kend'             => $type_kend,

                            'rangka_kend'           => $rangka_kend,
                            'no_mesin_kend'         => $no_mesin_kend,
                            'status_kend'           => $status_kend,
                            'project'               => $project,
                            'unit_layanan'          => $unit_layanan,
                            'gsm_gps'               => $gsm_gps,

                            'imei_gps'              => $imei_gps,
                            'status_gps'            => $status_gps,
                            'vendor_kend'           => $vendor_kend,
                            'awal_berlaku_kend'     => $AwalBerlakuKend,
                            'akhir_berlaku_kend'    => $AkhirBerlakuKend,

                            'masa_berlaku_stnk'     => $MasaBerlakuSTNK,
                            'masa_berlaku_tnbk'     => $MasaBerlakuTNBK,
                            'masa_berlaku_kir'      => $MasaBerlakuKir,
                            'safety_box'            => $safety_box,
                            'jenis_kend'            => $jenis_kend,

                            'keterangan'            => $keterangan,
                            'cek_data'              => $cek_data,
                            'user'                  => $this->session->userdata("user_login")['username']
                        );
                        //delete data
                        $this->db->query("DELETE FROM Div_CHM.tbl_kendaraan_logistik WHERE tnbk_kend = '".$tnbk_kend."'");
                    }
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('KendaraanLogistik');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failer..!');
                    redirect('KendaraanLogistik');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }

// Pengadaan & Distribusi PO----------------------------------------------------------------------------------------------------------
        }else if ($chm == 'tbl_pengadaan_dan_distribusi_PO') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $Ijin_Prinsip_Direksi = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $NO_PO = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $TANGGAL_PO = $worksheet->getCellByColumnAndRow(2, $row);
                        $TglPO = $TANGGAL_PO->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($TANGGAL_PO)) {
                            $TglPO = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($TglPO));
                        }
                        $VENDOR = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $NAMA_BARANG = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $JUMLAH_BARANG = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $HARGA = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $TOTAL_HARGA = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $PPN_atau_Non_PPN = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $Kebutuhan_Cabang_atau_Divisi = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $Keterangan = $worksheet->getCellByColumnAndRow(10, $row)->getValue();

                        $temp_data[] = array(
                            'Ijin_Prinsip_Direksi'          => $Ijin_Prinsip_Direksi,
                            'NO_PO'                         => $NO_PO,
                            'TANGGAL_PO'                    => $TglPO,
                            'VENDOR'                        => $VENDOR,
                            'NAMA_BARANG'                   => $NAMA_BARANG,
                            'JUMLAH_BARANG'                 => $JUMLAH_BARANG,
                            'HARGA'                         => $HARGA,
                            'TOTAL_HARGA'                   => $TOTAL_HARGA,
                            'PPN_atau_Non_PPN'              => $PPN_atau_Non_PPN,
                            'Kebutuhan_Cabang_atau_Divisi'  => $Kebutuhan_Cabang_atau_Divisi,
                            'Keterangan'                    => $Keterangan,
                            'user'                          => $this->session->userdata("user_login")['username']
                        );
                        //delete data
                        $this->db->query("DELETE FROM Div_CHM.tbl_pengadaan_dan_distribusi_PO WHERE ");
                    }


                    // cetak_die($temp_data);
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('PengadaanDanDistribusiPO');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('PengadaanDanDistribusiPO');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }
// tbl_timeline_ho_atm_bri_kolaborasi---------------------------------------------------------------------------------------------------
        }else if ($chm == 'tbl_timeline_ho_atm_bri_kolaborasi') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        // $NO = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $tid = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $sn = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $db = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $kanwil = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $pengelola_vendor = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $kc_spv = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $kc_spv_kode = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $pengelola = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $pengelola_cpc = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $pengelola_kode = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $pengelola_jenis = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $lokasi = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $merk_atm = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $garansi = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $ops_days = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $ops_hour = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        // $TANGGAL_PO = $worksheet->getCellByColumnAndRow(15, $row);
                        // $TglPO = $TANGGAL_PO->getValue();
                        // if (PHPExcel_Shared_Date::isDateTime($TANGGAL_PO)) {
                        //     $TglPO = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($TglPO));
                        // }
                        $ops_time = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                        $lokasi_jenis = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                        $lokasi_kategori = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                        $lokasi_kategori_group = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                        $ticket_ojk = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                        $jarkom_jen = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                        $jarkom_pro = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
                        $waktu_insert = $worksheet->getCellByColumnAndRow(23, $row)->getValue();
                        $ip_addr = $worksheet->getCellByColumnAndRow(24, $row)->getValue();
                        $denom = $worksheet->getCellByColumnAndRow(25, $row)->getValue();
                        $latitude = $worksheet->getCellByColumnAndRow(26, $row)->getValue();
                        $longitude = $worksheet->getCellByColumnAndRow(27, $row)->getValue();
                        $kc_bricash = $worksheet->getCellByColumnAndRow(28, $row)->getValue();
                        $Project = $worksheet->getCellByColumnAndRow(29, $row)->getValue();
                        $Jenis = $worksheet->getCellByColumnAndRow(30, $row)->getValue();
                        $tanggal = $worksheet->getCellByColumnAndRow(31, $row)->getValue();
                        $Leader_tgl = $worksheet->getCellByColumnAndRow(32, $row)->getValue();
                        $Leader_tot = $worksheet->getCellByColumnAndRow(33, $row)->getValue();
                        $Kendaraan_tgl = $worksheet->getCellByColumnAndRow(34, $row)->getValue();
                        $Mobil_tot = $worksheet->getCellByColumnAndRow(35, $row)->getValue();
                        $Motor_tot = $worksheet->getCellByColumnAndRow(36, $row)->getValue();
                        $Sarpras_tgl = $worksheet->getCellByColumnAndRow(37, $row)->getValue();
                        $msu = $worksheet->getCellByColumnAndRow(38, $row)->getValue();
                        $Pekerja_tgl = $worksheet->getCellByColumnAndRow(39, $row)->getValue();
                        $Pekerja_tot = $worksheet->getCellByColumnAndRow(40, $row)->getValue();
                        $Pengosongan_tgl_row = $worksheet->getCellByColumnAndRow(41, $row);
                        $Pengosongan_tgl = $Pengosongan_tgl_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($Pengosongan_tgl_row)) {
                            $Pengosongan_tgl = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Pengosongan_tgl));
                        }
                        $Pengosongan = $worksheet->getCellByColumnAndRow(42, $row)->getValue();
                        $Penihilan = $worksheet->getCellByColumnAndRow(43, $row)->getValue();
                        $Status_HO_BC = $worksheet->getCellByColumnAndRow(44, $row)->getValue();
                        $Status_RPL_Perdana = $worksheet->getCellByColumnAndRow(45, $row)->getValue();
                        $Keterangan_Pending = $worksheet->getCellByColumnAndRow(46, $row)->getValue();
                        $Tgl_Perdana_row= $worksheet->getCellByColumnAndRow(47, $row);
                        $Tgl_Perdana = $Tgl_Perdana_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($Tgl_Perdana_row)) {
                            $Tgl_Perdana = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Tgl_Perdana));
                        }
                        $keterangan= $worksheet->getCellByColumnAndRow(48, $row)->getValue();
                        $kategori= $worksheet->getCellByColumnAndRow(49, $row)->getValue();
                        $target_penyelesaian_perdana= $worksheet->getCellByColumnAndRow(50, $row)->getValue();

                        $temp_data[] = array(
                            // 'NO'                             => $NO,
                            'tid'                            => $tid,
                            'sn'                             => $sn,
                            'db'                             => $db,
                            'kanwil'                         => $kanwil,
                            'pengelola_vendor'               => $pengelola_vendor,
                            'kc_spv'                         => $kc_spv,
                            'kc_spv_kode'                    => $kc_spv_kode,
                            'pengelola'                      => $pengelola,
                            'pengelola_cpc'                  => $pengelola_cpc,
                            'pengelola_kode'  => $pengelola_kode,
                            'pengelola_jenis'                    => $pengelola_jenis,
                            'lokasi'                            => $lokasi,
                            'merk_atm'                    => $merk_atm,
                            'garansi'                        => $garansi,
                            'ops_days'                   => $ops_days,
                            'ops_hour'                 => $ops_hour,
                            'ops_time'                         => $ops_time,
                            'lokasi_jenis'                   => $lokasi_jenis,
                            'lokasi_kategori'              => $lokasi_kategori,
                            'lokasi_kategori_group'              => $lokasi_kategori_group,
                            'ticket_ojk'  => $ticket_ojk,
                            'jarkom_jen'                    => $jarkom_jen,
                            'jarkom_pro'              => $jarkom_pro,
                            'ip_addr'  => $ip_addr,
                            'denom'                    => $denom,
                            'latitude'              => $latitude,
                            'longitude'  => $longitude,
                            'kc_bricash'                    => $kc_bricash,
                            'Project'              => $Project,
                            'Jenis'  => $Jenis,
                            'tanggal'                    => $tanggal,
                            'Leader_tgl'              => $Leader_tgl,
                            'Leader_tot'  => $Leader_tot,
                            'Kendaraan_tgl'                    => $Kendaraan_tgl,
                            'Mobil_tot'  => $Mobil_tot,
                            'Motor_tot'  => $Motor_tot,
                            'Sarpras_tgl'                    => $Sarpras_tgl,
                            'msu'  => $msu,
                            'Pekerja_tgl'                    => $Pekerja_tgl,
                            'Pekerja_tot'  => $Pekerja_tot,
                            'Pengosongan_tgl'                    => $Pengosongan_tgl,
                            'Pengosongan'  => $Pengosongan,
                            'Penihilan'                    => $Penihilan,
                            'Status_HO_BC'                    => $Status_HO_BC,
                            'Status_RPL_Perdana'                    => $Status_RPL_Perdana,
                            'Keterangan_Pending'                    => $Keterangan_Pending,
                            'Tgl_Perdana'                    => $Tgl_Perdana,
                            'keterangan'                    => $keterangan,
                            'kategori'                    => $kategori,
                            'target_penyelesaian_perdana'                    => $target_penyelesaian_perdana,
                            'user'                          => $this->session->userdata("user_login")['username']
                        );
                        
                    }
                    // cetak_die($temp_data);
                   
                }
                // $test = $this->db->query("SELECT * FROM tbl_timeline_ho_atm_bri_kolaborasi_copy1 WHERE tid = '".$tid."' ");
                $insert = $this->db->insert_batch('tbl_timeline_ho_atm_bri_kolaborasi_copy1', $temp_data);
                // lastq();
                $update = $this->db->query("UPDATE tbl_timeline_ho_atm_bri_kolaborasi,
                    tbl_timeline_ho_atm_bri_kolaborasi_copy1 
                    SET tbl_timeline_ho_atm_bri_kolaborasi.Pengosongan = tbl_timeline_ho_atm_bri_kolaborasi_copy1.Pengosongan,
                    tbl_timeline_ho_atm_bri_kolaborasi.Penihilan = tbl_timeline_ho_atm_bri_kolaborasi_copy1.Penihilan,
                    tbl_timeline_ho_atm_bri_kolaborasi.Status_HO_BC = tbl_timeline_ho_atm_bri_kolaborasi_copy1.Status_HO_BC,
                    tbl_timeline_ho_atm_bri_kolaborasi.Status_RPL_Perdana = tbl_timeline_ho_atm_bri_kolaborasi_copy1.Status_RPL_Perdana,
                    tbl_timeline_ho_atm_bri_kolaborasi.Keterangan_Pending = tbl_timeline_ho_atm_bri_kolaborasi_copy1.Keterangan_Pending,
                    tbl_timeline_ho_atm_bri_kolaborasi.Tgl_Perdana = tbl_timeline_ho_atm_bri_kolaborasi_copy1.Tgl_Perdana,
                    tbl_timeline_ho_atm_bri_kolaborasi.keterangan = tbl_timeline_ho_atm_bri_kolaborasi_copy1.keterangan,
                    tbl_timeline_ho_atm_bri_kolaborasi.kategori = tbl_timeline_ho_atm_bri_kolaborasi_copy1.kategori,
                    tbl_timeline_ho_atm_bri_kolaborasi.target_penyelesaian_perdana = tbl_timeline_ho_atm_bri_kolaborasi_copy1.target_penyelesaian_perdana 
                    WHERE tbl_timeline_ho_atm_bri_kolaborasi.tid = tbl_timeline_ho_atm_bri_kolaborasi_copy1.tid"); 
                //insert data
                // lastq();

                $insertdb2 = $this->db->query("INSERT IGNORE INTO tbl_timeline_ho_atm_bri_kolaborasi SELECT * FROM tbl_timeline_ho_atm_bri_kolaborasi_copy1 ");
                // lastq();
                    $this->db->truncate('tbl_timeline_ho_atm_bri_kolaborasi_copy1');

                $updatedbfix = $this->db->query("INSERT IGNORE INTO tbl_timeline_ho_atm_bri_kolaborasi SELECT * FROM tbl_timeline_ho_atm_bri_kolaborasi_copy1 ");   
                // lastq();
                if ($update || $insertdb2 || $updatedbfix) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Tlatmbrikolab');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Tlatmbrikolab');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }   
//tabel SSB Hybric new --------------------------------------------------------------------------------------------------------             
        }else if ($chm == 'tbl_ssb_hybrid_new') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $tid = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $WSID = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $NO_TIKET = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $SN = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $LOKASI = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $IP_Host = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $Port = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $IP_Address = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $SN_CARD_e_ktp_READER = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $JENIS_E_KTP_READER = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $KANWIL = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $KC_Supervisi = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $TITIK_KOORDINAT = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $SERVICE_POINT = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $JARAK = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        $KETERANGAN = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                        $BULANPM1 = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                        $TANGGALPM1_row = $worksheet->getCellByColumnAndRow(18, $row);
                        $TANGGALPM1 = $TANGGALPM1_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($TANGGALPM1_row)) {
                            $TANGGALPM1 = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($TANGGALPM1));
                        }
                        $TEKNISIPM1 = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                        $BULANPM2 = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                        $TANGGALPM2_row = $worksheet->getCellByColumnAndRow(21, $row);
                        $TANGGALPM2 = $TANGGALPM2_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($TANGGALPM2_row)) {
                            $TANGGALPM2 = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($TANGGALPM2));
                        }
                        $TEKNISIPM2 = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
                        $BULANPM3 = $worksheet->getCellByColumnAndRow(23, $row)->getValue();
                        $TANGGALPM3_row = $worksheet->getCellByColumnAndRow(24, $row);
                        $TANGGALPM3 = $TANGGALPM3_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($TANGGALPM3_row)) {
                            $TANGGALPM3 = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($TANGGALPM3));
                        }
                        $TEKNISIPM3 = $worksheet->getCellByColumnAndRow(25, $row)->getValue();
                        $Status1 = $worksheet->getCellByColumnAndRow(26, $row)->getValue();
                        $Teknisi1 = $worksheet->getCellByColumnAndRow(27, $row)->getValue();
                        $Tanggal1_row = $worksheet->getCellByColumnAndRow(28, $row);
                        $Tanggal1 = $Tanggal1_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($Tanggal1_row)) {
                            $Tanggal1 = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Tanggal1));
                        }
                        $Keterangan1 = $worksheet->getCellByColumnAndRow(29, $row)->getValue();
                        $Status2 = $worksheet->getCellByColumnAndRow(30, $row)->getValue();
                        $Teknisi2 = $worksheet->getCellByColumnAndRow(31, $row)->getValue();
                        $Tanggal2_row = $worksheet->getCellByColumnAndRow(32, $row);
                        $Tanggal2 = $Tanggal2_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($Tanggal2_row)) {
                            $Tanggal2 = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Tanggal2));
                        }
                        $Keterangan2 = $worksheet->getCellByColumnAndRow(33, $row)->getValue();
                        $Status3 = $worksheet->getCellByColumnAndRow(34, $row)->getValue();
                        $Teknisi3 = $worksheet->getCellByColumnAndRow(35, $row)->getValue();
                        $Tanggal3_row = $worksheet->getCellByColumnAndRow(36, $row);
                        $Tanggal3 = $Tanggal3_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($Tanggal3_row)) {
                            $Tanggal3 = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Tanggal3));
                        }
                        $Keterangan3 = $worksheet->getCellByColumnAndRow(37, $row)->getValue();


                        $temp_data[] = array(
                            'No'          => $No,
                            'tid'                         => $tid,
                            // 'TANGGAL_PO'                    => $TglPO,
                            'WSID'                        => $WSID,
                            'NO_TIKET'                   => $NO_TIKET,
                            'SN'                 => $SN,
                            'LOKASI'                         => $LOKASI,
                            'IP_Host'                   => $IP_Host,
                            'Port'              => $Port,
                            'IP_Address'  => $IP_Address,
                            'SN_CARD_e_ktp_READER'                    => $SN_CARD_e_ktp_READER,
                            'JENIS_E_KTP_READER'                        => $JENIS_E_KTP_READER,
                            'KANWIL'                   => $KANWIL,
                            'KC_Supervisi'                 => $KC_Supervisi,
                            'TITIK_KOORDINAT'                         => $TITIK_KOORDINAT,
                            'SERVICE_POINT'                   => $SERVICE_POINT,
                            'JARAK'              => $JARAK,
                            'KETERANGAN'  => $KETERANGAN,
                            'BULANPM1'                    => $BULANPM1,
                            'TANGGALPM1'                   => $TANGGALPM1,
                            'TEKNISIPM1'                 => $TEKNISIPM1,
                            'BULANPM2'                         => $BULANPM2,
                            'TANGGALPM2'                   => $TANGGALPM2,
                            'TEKNISIPM2'              => $TEKNISIPM2,
                            'BULANPM3'                         => $BULANPM3,
                            'TANGGALPM3'                   => $TANGGALPM3,
                            'TEKNISIPM3'              => $TEKNISIPM3,
                            'STATUS_25_JUL_21_sd_24_AGS_21'  => $Status1,
                            'TEKNISI_25_JUL_21_sd_24_AGS_21'                    => $Teknisi1,
                            'TANGGAL_25_JUL_21_sd_24_AGS_21'  => $Tanggal1,
                            'KETERANGAN_25_JUL_21_sd_24_AGS_21'                    => $Keterangan1,
                            'STATUS_25_AGS_21_sd_24_SEP_21'  => $Status2,
                            'TEKNISI_25_AGS_21_sd_24_SEP_21'                    => $Teknisi2,
                            'TANGGAL_25_AGS_21_sd_24_SEP_21'  => $Tanggal2,
                            'KETERANGAN_25_AGS_21_sd_24_SEP_21'                    => $Keterangan2,
                            'STATUS_25_SEP_21_sd_24_OKT_21'  => $Status3,
                            'TEKNISI_25_SEP_21_sd_24_OKT_21'                    => $Teknisi3,
                            'TANGGAL_25_SEP_21_sd_24_OKT_21'  => $Tanggal3,
                            'KETERANGAN_25_SEP_21_sd_24_OKT_21'                    => $Keterangan3,
                            'user'                          => $this->session->userdata("user_login")['username']
                        );
                        //delete data
                        $this->db->query("DELETE FROM Div_CHM.tbl_ssb_hybrid_new WHERE tid = '".$tid."' ");
                        // cetak_die($temp_data);
                    }
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Ssbhybrid');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Ssbhybrid');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }
// Tabel CRM PM ---------------------------------------------------------------------------------------------------           
        } else if ($chm == 'tbl_crm_pm_new') {
            // cetak_die($chm);
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $Bulan = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Kanwil = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $Target_PM = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Done_PM = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Dismantel = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $OnProgress = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Performance = $worksheet->getCellByColumnAndRow(6, $row)->getValue();

                        $temp_data[] = array(
                            'Bulan'              => $Bulan,
                            'Kanwil'             => $Kanwil,
                            'Target_PM'       => $Target_PM,
                            'Done_PM'    => $Done_PM,
                            'Dismantel'     => $Dismantel,
                            'OnProgress'    => $OnProgress,
                            'Performance'    => $Performance,
                            'user'            => $this->session->userdata("user_login")['username']

                        );
                        //delete data
                        // cetak_die($temp_data);
                        $this->db->truncate($chm);
                        // lastq();
                    }
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // c
                $insert = $this->chm->insert_batch('tbl_crm_pm_his', $temp_data);
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Crmpm');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Crmpm');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }    
// tabel hybrid pm new -------------------------------------------------------------------------------------------------------------
        }else if ($chm == 'tbl_hybrid_pm_new') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $Bulan = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Kanwil = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $Target_PM = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Done_PM = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        // $Dismantel = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $OnProgress = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Performance = $worksheet->getCellByColumnAndRow(5, $row)->getValue();

                        $temp_data[] = array(
                            'Bulan_Periode_PM'              => $Bulan,
                            'Kanwil'             => $Kanwil,
                            'Target_PM'       => $Target_PM,
                            'Done_PM'    => $Done_PM,
                            // 'Dismantel'     => $Dismantel,
                            'OnProgress'    => $OnProgress,
                            'Performance'    => $Performance,
                            'user'            => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                        //delete data
                        $this->db->truncate($chm);
                    }
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                $insert = $this->chm->insert_batch('tbl_hybrid_pm_his', $temp_data);
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Hybridpm');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Hybridpm');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }    
// tabel SSB PM --------------------------------------------------------------------------------------------------------            
        }else if ($chm == 'tbl_ssb_pm_new') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $Bulan = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Kanwil = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $Target_PM = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Done_PM = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        // $Dismantel = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $OnProgress = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Performance = $worksheet->getCellByColumnAndRow(5, $row)->getValue();

                        $temp_data[] = array(
                            'Bulan'              => $Bulan,
                            'Kanwil'             => $Kanwil,
                            'Target_PM'       => $Target_PM,
                            'Done_PM'    => $Done_PM,
                            // 'Dismantel'     => $Dismantel,
                            'OnProgress'    => $OnProgress,
                            'Performance'    => $Performance,
                            'user'            => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                        $this->db->truncate($chm);
                        // lastq();
                        //delete data
                        // $this->db->query("DELETE FROM Div_CHM.tbl_ssb_pm_new");
                    }
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                $insert = $this->chm->insert_batch('tbl_ssb_pm_his', $temp_data);
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Ssbpm');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Ssbpm');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }  
// tbl_pm_edc_mandiri_fix ---------------------------------------------------------------------------------------------              
        } else if ($chm == 'tbl_pm_edc_mandiri_fix') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $edc_tid_baru = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $status_kunjungan = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $sp = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $status_kunjungan_en = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                        // $OnProgress = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        // $Performance = $worksheet->getCellByColumnAndRow(5, $row)->getValue();

                        $temp_data[] = array(
                            'edc_tid_baru'              => $edc_tid_baru,
                            'status_kunjungan'             => $status_kunjungan,
                            'sp'       => $sp,
                            'status_kunjungan_en'    => $status_kunjungan_en,
                            // 'Dismantel'     => $Dismantel,
                            // 'OnProgress'    => $OnProgress,
                            // 'Performance'    => $Performance,
                            'user'            => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                        $this->db->truncate($chm);
                        // lastq();
                        //delete data
                        // $this->db->query("DELETE FROM Div_CHM.tbl_ssb_pm_new");
                    }
                }
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // $insert = $this->chm->insert_batch('tbl_ssb_pm_his', $temp_data);
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Pmedcmandiri');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Pmedcmandiri');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }    
// tbl_vaksin ---------------------------------------------------------------------------------------------            
        } else if ($chm == 'tbl_vaksin') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $NO = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $id_personal = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $nama = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $jabatan = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $kanca = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $unit_kerja = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $lokasi = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $bertugas = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $project = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $status_vaksin = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $status_detail = $worksheet->getCellByColumnAndRow(10, $row)->getValue();

                        $temp_data[] = array(
                            'NO'              => $NO,
                            'id_personal'             => $id_personal,
                            'nama'       => $nama,
                            'jabatan'    => $jabatan,
                            'kanca'    => $kanca,
                            'unit_kerja'    => $unit_kerja,
                            'lokasi'     => $lokasi,
                            'bertugas'       => $nama,
                            'project'    => $project,
                            'status_vaksin'    => $kanca,
                            'status_detail'    => $status_detail,
                            'user'            => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                        $this->db->truncate($chm);
                        // lastq();
                        //delete data
                        // $this->db->query("DELETE FROM Div_CHM.tbl_ssb_pm_new");
                    }
                }
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // $insert = $this->chm->insert_batch('tbl_ssb_pm_his', $temp_data);
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Vaksin');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Vaksin');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }    
// tbl_pengiriman_logistik---------------------------------------------------------------------------------------------              
        } else if ($chm == 'tbl_pengiriman_logistik') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Tanggal = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $Tujuan = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Qty = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Sparepart = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Status = $worksheet->getCellByColumnAndRow(5, $row)->getValue();

                        $temp_data[] = array(
                            'No'              => $No,
                            'Tanggal'             => $Tanggal,
                            'Tujuan'       => $Tujuan,
                            'Qty'    => $Qty,
                            'Sparepart'    => $Sparepart,
                            'Status'    => $Status,
                            'user'            => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                        $this->db->truncate($chm);
                        // lastq();
                        //delete data
                        // $this->db->query("DELETE FROM Div_CHM.tbl_ssb_pm_new");
                    }
                }
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // $insert = $this->chm->insert_batch('tbl_ssb_pm_his', $temp_data);
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Logistikpeng');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Logistikpeng');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }    
// tbl_bulanan_flm_700_crm---------------------------------------------------------------------------------------------             
        } else if ($chm == 'tbl_bulanan_flm_700_crm') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $KANCA = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $tgl_1 = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $tgl_2 = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $tgl_3 = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $tgl_4 = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $tgl_5 = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $tgl_6 = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $tgl_7 = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $tgl_8 = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $tgl_9 = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $tgl_10 = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $tgl_11 = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $tgl_12 = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $tgl_13 = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $tgl_14 = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $tgl_15 = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        $tgl_16 = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                        $tgl_17 = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                        $tgl_18 = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                        $tgl_19 = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                        $tgl_20 = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                        $tgl_21 = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                        $tgl_22 = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
                        $tgl_23 = $worksheet->getCellByColumnAndRow(23, $row)->getValue();
                        $tgl_24 = $worksheet->getCellByColumnAndRow(24, $row)->getValue();
                        $tgl_25 = $worksheet->getCellByColumnAndRow(25, $row)->getValue();
                        $tgl_26 = $worksheet->getCellByColumnAndRow(26, $row)->getValue();
                        $tgl_27 = $worksheet->getCellByColumnAndRow(27, $row)->getValue();
                        $tgl_28 = $worksheet->getCellByColumnAndRow(28, $row)->getValue();
                        $tgl_29 = $worksheet->getCellByColumnAndRow(29, $row)->getValue();
                        $tgl_30 = $worksheet->getCellByColumnAndRow(30, $row)->getValue();
                        $tgl_31 = $worksheet->getCellByColumnAndRow(31, $row)->getValue();
                        $AVG_FLM = $worksheet->getCellByColumnAndRow(32, $row)->getValue();

                        $temp_data[] = array(
                            'KANCA'    => $KANCA,
                            'tgl_1'    => $tgl_1,
                            'tgl_2'    => $tgl_2,
                            'tgl_3'    => $tgl_3,
                            'tgl_4'    => $tgl_4,
                            'tgl_5'    => $tgl_5,
                            'tgl_6'    => $tgl_6,
                            'tgl_7'    => $tgl_7,
                            'tgl_8'    => $tgl_8,
                            'tgl_9'    => $tgl_9,
                            'tgl_10'    => $tgl_10,
                            'tgl_11'    => $tgl_11,
                            'tgl_12'    => $tgl_12,
                            'tgl_13'    => $tgl_13,
                            'tgl_14'    => $tgl_14,
                            'tgl_15'    => $tgl_15,
                            'tgl_16'    => $tgl_16,
                            'tgl_17'    => $tgl_17,
                            'tgl_18'    => $tgl_18,
                            'tgl_19'    => $tgl_19,
                            'tgl_20'    => $tgl_20,
                            'tgl_21'    => $tgl_21,
                            'tgl_22'    => $tgl_22,
                            'tgl_23'    => $tgl_23,
                            'tgl_24'    => $tgl_24,
                            'tgl_25'    => $tgl_25,
                            'tgl_26'    => $tgl_26,
                            'tgl_27'    => $tgl_27,
                            'tgl_28'    => $tgl_28,
                            'tgl_29'    => $tgl_29,
                            'tgl_30'    => $tgl_30,
                            'tgl_31'    => $tgl_31,
                            'AVG_FLM'    => $AVG_FLM,
                            'user'            => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                        $this->db->truncate($chm);
                        // lastq();
                        //delete data
                        // $this->db->query("DELETE FROM Div_CHM.tbl_ssb_pm_new");
                    }
                }
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // $insert = $this->chm->insert_batch('tbl_ssb_pm_his', $temp_data);
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Flm700');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Flm700');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }    
// tbl_bulanan_premises_700_crm---------------------------------------------------------------------------------------------              
        } else if ($chm == 'tbl_bulanan_premises_700_crm') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $kanca = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $tgl_1 = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $tgl_2 = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $tgl_3 = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $tgl_4 = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $tgl_5 = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $tgl_6 = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $tgl_7 = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $tgl_8 = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $tgl_9 = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $tgl_10 = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $tgl_11 = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $tgl_12 = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $tgl_13 = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $tgl_14 = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $tgl_15 = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        $tgl_16 = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                        $tgl_17 = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                        $tgl_18 = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                        $tgl_19 = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                        $tgl_20 = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                        $tgl_21 = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                        $tgl_22 = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
                        $tgl_23 = $worksheet->getCellByColumnAndRow(23, $row)->getValue();
                        $tgl_24 = $worksheet->getCellByColumnAndRow(24, $row)->getValue();
                        $tgl_25 = $worksheet->getCellByColumnAndRow(25, $row)->getValue();
                        $tgl_26 = $worksheet->getCellByColumnAndRow(26, $row)->getValue();
                        $tgl_27 = $worksheet->getCellByColumnAndRow(27, $row)->getValue();
                        $tgl_28 = $worksheet->getCellByColumnAndRow(28, $row)->getValue();
                        $tgl_29 = $worksheet->getCellByColumnAndRow(29, $row)->getValue();
                        $tgl_30 = $worksheet->getCellByColumnAndRow(30, $row)->getValue();
                        $tgl_31 = $worksheet->getCellByColumnAndRow(31, $row)->getValue();
                        $AVG_PREMISIS = $worksheet->getCellByColumnAndRow(32, $row)->getValue();

                        $temp_data[] = array(
                            'kanca'    => $kanca,
                            'tgl_1'    => $tgl_1,
                            'tgl_2'    => $tgl_2,
                            'tgl_3'    => $tgl_3,
                            'tgl_4'    => $tgl_4,
                            'tgl_5'    => $tgl_5,
                            'tgl_6'    => $tgl_6,
                            'tgl_7'    => $tgl_7,
                            'tgl_8'    => $tgl_8,
                            'tgl_9'    => $tgl_9,
                            'tgl_10'    => $tgl_10,
                            'tgl_11'    => $tgl_11,
                            'tgl_12'    => $tgl_12,
                            'tgl_13'    => $tgl_13,
                            'tgl_14'    => $tgl_14,
                            'tgl_15'    => $tgl_15,
                            'tgl_16'    => $tgl_16,
                            'tgl_17'    => $tgl_17,
                            'tgl_18'    => $tgl_18,
                            'tgl_19'    => $tgl_19,
                            'tgl_20'    => $tgl_20,
                            'tgl_21'    => $tgl_21,
                            'tgl_22'    => $tgl_22,
                            'tgl_23'    => $tgl_23,
                            'tgl_24'    => $tgl_24,
                            'tgl_25'    => $tgl_25,
                            'tgl_26'    => $tgl_26,
                            'tgl_27'    => $tgl_27,
                            'tgl_28'    => $tgl_28,
                            'tgl_29'    => $tgl_29,
                            'tgl_30'    => $tgl_30,
                            'tgl_31'    => $tgl_31,
                            'AVG_PREMISIS'    => $AVG_PREMISIS,
                            'user'            => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                        $this->db->truncate($chm);
                        // lastq();
                        //delete data
                        // $this->db->query("DELETE FROM Div_CHM.tbl_ssb_pm_new");
                    }
                }
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // $insert = $this->chm->insert_batch('tbl_ssb_pm_his', $temp_data);
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Premises700');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Premises700');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }    
// tbl_bulanan_premises_700_crm---------------------------------------------------------------------------------------------
        } else if ($chm == 'tbl_perfomance_rpl_atm_bank_bjb') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $NO = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $KANTOR_CABANG = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $Total_Kelolaan_ATM = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $RPL_In_SLA = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $RPL_Out_SLA = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Total_RPL = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Performance = $worksheet->getCellByColumnAndRow(6, $row)->getValue();

                        $temp_data[] = array(
                            'NO'              => $NO,
                            'KANTOR_CABANG'             => $KANTOR_CABANG,
                            'Total_Kelolaan_ATM'       => $Total_Kelolaan_ATM,
                            'RPL_In_SLA'    => $RPL_In_SLA,
                            'RPL_Out_SLA'    => $RPL_Out_SLA,
                            'Total_RPL'    => $Total_RPL,
                            'Performance'    => $Performance,
                            'user'            => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                        $this->db->truncate($chm);
                        // lastq();
                        //delete data
                        // $this->db->query("DELETE FROM Div_CHM.tbl_ssb_pm_new");
                    }
                }
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // $insert = $this->chm->insert_batch('tbl_ssb_pm_his', $temp_data);
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Perrplbankbjb');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Perrplbankbjb');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }    
// tbl_timeline_ho_atm_bri_562---------------------------------------------------------------------------------------------------
        }else if ($chm == 'tbl_timeline_ho_atm_bri_562') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        // $NO = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $tid = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $sn = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $db = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $kanwil = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $pengelola_vendor = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $kc_spv = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $kc_spv_kode = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $pengelola = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $pengelola_cpc = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $pengelola_kode = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $pengelola_jenis = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $lokasi = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $merk_atm = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $garansi = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $ops_days = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $ops_hour = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        // $TANGGAL_PO = $worksheet->getCellByColumnAndRow(15, $row);
                        // $TglPO = $TANGGAL_PO->getValue();
                        // if (PHPExcel_Shared_Date::isDateTime($TANGGAL_PO)) {
                        //     $TglPO = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($TglPO));
                        // }
                        $ops_time = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                        $lokasi_jenis = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                        $lokasi_kategori = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                        $lokasi_kategori_group = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                        $ticket_ojk = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                        $jarkom_jen = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                        $jarkom_pro = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
                        $waktu_insert = $worksheet->getCellByColumnAndRow(23, $row)->getValue();
                        $ip_addr = $worksheet->getCellByColumnAndRow(24, $row)->getValue();
                        $denom = $worksheet->getCellByColumnAndRow(25, $row)->getValue();
                        $latitude = $worksheet->getCellByColumnAndRow(26, $row)->getValue();
                        $longitude = $worksheet->getCellByColumnAndRow(27, $row)->getValue();
                        $kc_bricash = $worksheet->getCellByColumnAndRow(28, $row)->getValue();
                        $Project = $worksheet->getCellByColumnAndRow(29, $row)->getValue();
                        $Jenis = $worksheet->getCellByColumnAndRow(30, $row)->getValue();
                        $tanggal = $worksheet->getCellByColumnAndRow(31, $row)->getValue();
                        $Leader_tgl = $worksheet->getCellByColumnAndRow(32, $row)->getValue();
                        $Leader_tot = $worksheet->getCellByColumnAndRow(33, $row)->getValue();
                        $Kendaraan_tgl = $worksheet->getCellByColumnAndRow(34, $row)->getValue();
                        $Mobil_tot = $worksheet->getCellByColumnAndRow(35, $row)->getValue();
                        $Motor_tot = $worksheet->getCellByColumnAndRow(36, $row)->getValue();
                        $Sarpras_tgl = $worksheet->getCellByColumnAndRow(37, $row)->getValue();
                        $msu = $worksheet->getCellByColumnAndRow(38, $row)->getValue();
                        $Pekerja_tgl = $worksheet->getCellByColumnAndRow(39, $row)->getValue();
                        $Pekerja_tot = $worksheet->getCellByColumnAndRow(40, $row)->getValue();
                        $Pengosongan_tgl_row = $worksheet->getCellByColumnAndRow(41, $row);
                        $Pengosongan_tgl = $Pengosongan_tgl_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($Pengosongan_tgl_row)) {
                            $Pengosongan_tgl = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Pengosongan_tgl));
                        }
                        $Pengosongan = $worksheet->getCellByColumnAndRow(42, $row)->getValue();
                        $Penihilan = $worksheet->getCellByColumnAndRow(43, $row)->getValue();
                        $Status_HO_BC = $worksheet->getCellByColumnAndRow(44, $row)->getValue();
                        $Status_RPL_Perdana = $worksheet->getCellByColumnAndRow(45, $row)->getValue();
                        $Keterangan_Pending = $worksheet->getCellByColumnAndRow(46, $row)->getValue();
                        $Tgl_Perdana_row= $worksheet->getCellByColumnAndRow(47, $row);
                        $Tgl_Perdana = $Tgl_Perdana_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($Tgl_Perdana_row)) {
                            $Tgl_Perdana = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Tgl_Perdana));
                        }
                        $keterangan= $worksheet->getCellByColumnAndRow(48, $row)->getValue();
                        $kategori= $worksheet->getCellByColumnAndRow(49, $row)->getValue();
                        $target_penyelesaian_perdana= $worksheet->getCellByColumnAndRow(50, $row)->getValue();

                        $temp_data[] = array(
                            // 'NO'                             => $NO,
                            'tid'                            => $tid,
                            'sn'                             => $sn,
                            'db'                             => $db,
                            'kanwil'                         => $kanwil,
                            'pengelola_vendor'               => $pengelola_vendor,
                            'kc_spv'                         => $kc_spv,
                            'kc_spv_kode'                    => $kc_spv_kode,
                            'pengelola'                      => $pengelola,
                            'pengelola_cpc'                  => $pengelola_cpc,
                            'pengelola_kode'  => $pengelola_kode,
                            'pengelola_jenis'                    => $pengelola_jenis,
                            'lokasi'                            => $lokasi,
                            'merk_atm'                    => $merk_atm,
                            'garansi'                        => $garansi,
                            'ops_days'                   => $ops_days,
                            'ops_hour'                 => $ops_hour,
                            'ops_time'                         => $ops_time,
                            'lokasi_jenis'                   => $lokasi_jenis,
                            'lokasi_kategori'              => $lokasi_kategori,
                            'lokasi_kategori_group'              => $lokasi_kategori_group,
                            'ticket_ojk'  => $ticket_ojk,
                            'jarkom_jen'                    => $jarkom_jen,
                            'jarkom_pro'              => $jarkom_pro,
                            'ip_addr'  => $ip_addr,
                            'denom'                    => $denom,
                            'latitude'              => $latitude,
                            'longitude'  => $longitude,
                            'kc_bricash'                    => $kc_bricash,
                            'Project'              => $Project,
                            'Jenis'  => $Jenis,
                            'tanggal'                    => $tanggal,
                            'Leader_tgl'              => $Leader_tgl,
                            'Leader_tot'  => $Leader_tot,
                            'Kendaraan_tgl'                    => $Kendaraan_tgl,
                            'Mobil_tot'  => $Mobil_tot,
                            'Motor_tot'  => $Motor_tot,
                            'Sarpras_tgl'                    => $Sarpras_tgl,
                            'msu'  => $msu,
                            'Pekerja_tgl'                    => $Pekerja_tgl,
                            'Pekerja_tot'  => $Pekerja_tot,
                            'Pengosongan_tgl'                    => $Pengosongan_tgl,
                            'Pengosongan'  => $Pengosongan,
                            'Penihilan'                    => $Penihilan,
                            'Status_HO_BC'                    => $Status_HO_BC,
                            'Status_RPL_Perdana'                    => $Status_RPL_Perdana,
                            'Keterangan_Pending'                    => $Keterangan_Pending,
                            'Tgl_Perdana'                    => $Tgl_Perdana,
                            'keterangan'                    => $keterangan,
                            'kategori'                    => $kategori,
                            'target_penyelesaian_perdana'                    => $target_penyelesaian_perdana,

                            'user'                          => $this->session->userdata("user_login")['username']
                        );
                        
                    }
                    // cetak_die($temp_data);
                   
                }
                // $test = $this->db->query("SELECT * FROM tbl_timeline_ho_atm_bri_kolaborasi_copy1 WHERE tid = '".$tid."' ");
                $insert = $this->db->insert_batch('tbl_timeline_ho_atm_bri_562_copy1', $temp_data);
                // lastq();
                $update = $this->db->query("UPDATE tbl_timeline_ho_atm_bri_562,
                    tbl_timeline_ho_atm_bri_562_copy1 
                    SET tbl_timeline_ho_atm_bri_562.Pengosongan_tgl = tbl_timeline_ho_atm_bri_562_copy1.Pengosongan_tgl, 
                    tbl_timeline_ho_atm_bri_562.Pengosongan = tbl_timeline_ho_atm_bri_562_copy1.Pengosongan,
                    tbl_timeline_ho_atm_bri_562.Penihilan = tbl_timeline_ho_atm_bri_562_copy1.Penihilan,
                    tbl_timeline_ho_atm_bri_562.Status_HO_BC = tbl_timeline_ho_atm_bri_562_copy1.Status_HO_BC,
                    tbl_timeline_ho_atm_bri_562.Status_RPL_Perdana = tbl_timeline_ho_atm_bri_562_copy1.Status_RPL_Perdana,
                    tbl_timeline_ho_atm_bri_562.Keterangan_Pending = tbl_timeline_ho_atm_bri_562_copy1.Keterangan_Pending,
                    tbl_timeline_ho_atm_bri_562.Tgl_Perdana = tbl_timeline_ho_atm_bri_562_copy1.Tgl_Perdana,
                    tbl_timeline_ho_atm_bri_562.keterangan = tbl_timeline_ho_atm_bri_562_copy1.keterangan,
                    tbl_timeline_ho_atm_bri_562.kategori = tbl_timeline_ho_atm_bri_562_copy1.kategori,
                    tbl_timeline_ho_atm_bri_562.target_penyelesaian_perdana = tbl_timeline_ho_atm_bri_562_copy1.target_penyelesaian_perdana 
                    WHERE tbl_timeline_ho_atm_bri_562.tid = tbl_timeline_ho_atm_bri_562_copy1.tid"); 
                //insert data
                // lastq();

                $insertdb2 = $this->db->query("INSERT IGNORE INTO tbl_timeline_ho_atm_bri_562 SELECT * FROM tbl_timeline_ho_atm_bri_562_copy1 ");
                // lastq();
                    $this->db->truncate('tbl_timeline_ho_atm_bri_562_copy1');
                // lastq();

                $updatedbfix = $this->db->query("INSERT IGNORE INTO tbl_timeline_ho_atm_bri_562 SELECT * FROM tbl_timeline_ho_atm_bri_562_copy1 ");   
                // lastq();
                if ($update || $insertdb2 || $updatedbfix) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Tlatmbri562');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Tlatmbri562');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }          
//tbl_timeline_ho_atm_bri_831---------------------------------------------------------------------------------------------------       
        } else if ($chm == 'tbl_timeline_ho_atm_bri_831') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        // $NO = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $tid = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $sn = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $db = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $kanwil = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $pengelola_vendor = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $kc_spv = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $kc_spv_kode = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $pengelola = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $pengelola_cpc = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $pengelola_kode = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $pengelola_jenis = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $lokasi = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $merk_atm = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $garansi = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $ops_days = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $ops_hour = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        // $TANGGAL_PO = $worksheet->getCellByColumnAndRow(15, $row);
                        // $TglPO = $TANGGAL_PO->getValue();
                        // if (PHPExcel_Shared_Date::isDateTime($TANGGAL_PO)) {
                        //     $TglPO = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($TglPO));
                        // }
                        $ops_time = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                        $lokasi_jenis = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                        $lokasi_kategori = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                        $lokasi_kategori_group = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                        $ticket_ojk = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                        $jarkom_jen = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                        $jarkom_pro = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
                        $waktu_insert = $worksheet->getCellByColumnAndRow(23, $row)->getValue();
                        $ip_addr = $worksheet->getCellByColumnAndRow(24, $row)->getValue();
                        $denom = $worksheet->getCellByColumnAndRow(25, $row)->getValue();
                        $latitude = $worksheet->getCellByColumnAndRow(26, $row)->getValue();
                        $longitude = $worksheet->getCellByColumnAndRow(27, $row)->getValue();
                        $kc_bricash = $worksheet->getCellByColumnAndRow(28, $row)->getValue();
                        $Project = $worksheet->getCellByColumnAndRow(29, $row)->getValue();
                        $Jenis = $worksheet->getCellByColumnAndRow(30, $row)->getValue();
                        $tanggal = $worksheet->getCellByColumnAndRow(31, $row)->getValue();
                        $Leader_tgl = $worksheet->getCellByColumnAndRow(32, $row)->getValue();
                        $Leader_tot = $worksheet->getCellByColumnAndRow(33, $row)->getValue();
                        $Kendaraan_tgl = $worksheet->getCellByColumnAndRow(34, $row)->getValue();
                        $Mobil_tot = $worksheet->getCellByColumnAndRow(35, $row)->getValue();
                        $Motor_tot = $worksheet->getCellByColumnAndRow(36, $row)->getValue();
                        $Sarpras_tgl = $worksheet->getCellByColumnAndRow(37, $row)->getValue();
                        $msu = $worksheet->getCellByColumnAndRow(38, $row)->getValue();
                        $Pekerja_tgl = $worksheet->getCellByColumnAndRow(39, $row)->getValue();
                        $Pekerja_tot = $worksheet->getCellByColumnAndRow(40, $row)->getValue();
                        $Pengosongan_tgl_row = $worksheet->getCellByColumnAndRow(41, $row);
                        $Pengosongan_tgl = $Pengosongan_tgl_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($Pengosongan_tgl_row)) {
                            $Pengosongan_tgl = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Pengosongan_tgl));
                        }
                        $Pengosongan = $worksheet->getCellByColumnAndRow(42, $row)->getValue();
                        $Penihilan = $worksheet->getCellByColumnAndRow(43, $row)->getValue();
                        $Status_HO_BC = $worksheet->getCellByColumnAndRow(44, $row)->getValue();
                        $Status_RPL_Perdana = $worksheet->getCellByColumnAndRow(45, $row)->getValue();
                        $Keterangan_Pending = $worksheet->getCellByColumnAndRow(46, $row)->getValue();
                        $Tgl_Perdana_row= $worksheet->getCellByColumnAndRow(47, $row);
                        $Tgl_Perdana = $Tgl_Perdana_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($Tgl_Perdana_row)) {
                            $Tgl_Perdana = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Tgl_Perdana));
                        }
                        $keterangan= $worksheet->getCellByColumnAndRow(48, $row)->getValue();
                        $kategori= $worksheet->getCellByColumnAndRow(49, $row)->getValue();
                        $target_penyelesaian_perdana= $worksheet->getCellByColumnAndRow(50, $row)->getValue();

                        $temp_data[] = array(
                            // 'NO'                             => $NO,
                            'tid'                            => $tid,
                            'sn'                             => $sn,
                            'db'                             => $db,
                            'kanwil'                         => $kanwil,
                            'pengelola_vendor'               => $pengelola_vendor,
                            'kc_spv'                         => $kc_spv,
                            'kc_spv_kode'                    => $kc_spv_kode,
                            'pengelola'                      => $pengelola,
                            'pengelola_cpc'                  => $pengelola_cpc,
                            'pengelola_kode'  => $pengelola_kode,
                            'pengelola_jenis'                    => $pengelola_jenis,
                            'lokasi'                            => $lokasi,
                            'merk_atm'                    => $merk_atm,
                            'garansi'                        => $garansi,
                            'ops_days'                   => $ops_days,
                            'ops_hour'                 => $ops_hour,
                            'ops_time'                         => $ops_time,
                            'lokasi_jenis'                   => $lokasi_jenis,
                            'lokasi_kategori'              => $lokasi_kategori,
                            'lokasi_kategori_group'              => $lokasi_kategori_group,
                            'ticket_ojk'  => $ticket_ojk,
                            'jarkom_jen'                    => $jarkom_jen,
                            'jarkom_pro'              => $jarkom_pro,
                            'ip_addr'  => $ip_addr,
                            'denom'                    => $denom,
                            'latitude'              => $latitude,
                            'longitude'  => $longitude,
                            'kc_bricash'                    => $kc_bricash,
                            'Project'              => $Project,
                            'Jenis'  => $Jenis,
                            'tanggal'                    => $tanggal,
                            'Leader_tgl'              => $Leader_tgl,
                            'Leader_tot'  => $Leader_tot,
                            'Kendaraan_tgl'                    => $Kendaraan_tgl,
                            'Mobil_tot'  => $Mobil_tot,
                            'Motor_tot'  => $Motor_tot,
                            'Sarpras_tgl'                    => $Sarpras_tgl,
                            'msu'  => $msu,
                            'Pekerja_tgl'                    => $Pekerja_tgl,
                            'Pekerja_tot'  => $Pekerja_tot,
                            'Pengosongan_tgl'                    => $Pengosongan_tgl,
                            'Pengosongan'  => $Pengosongan,
                            'Penihilan'                    => $Penihilan,
                            'Status_HO_BC'                    => $Status_HO_BC,
                            'Status_RPL_Perdana'                    => $Status_RPL_Perdana,
                            'Keterangan_Pending'                    => $Keterangan_Pending,
                            'Tgl_Perdana'                    => $Tgl_Perdana,
                            'keterangan'                    => $keterangan,
                            'kategori'                    => $kategori,
                            'target_penyelesaian_perdana'                    => $target_penyelesaian_perdana,
                        );
                        
                    }
                    // cetak_die($temp_data);
                   
                }
                // $test = $this->db->query("SELECT * FROM tbl_timeline_ho_atm_bri_kolaborasi_copy1 WHERE tid = '".$tid."' ");
                $insert = $this->db->insert_batch('tbl_timeline_ho_atm_bri_831_copy1', $temp_data);
                // lastq();
                $update = $this->db->query("UPDATE tbl_timeline_ho_atm_bri_831,
                    tbl_timeline_ho_atm_bri_831_copy1 
                    SET tbl_timeline_ho_atm_bri_831.Pengosongan = tbl_timeline_ho_atm_bri_831_copy1.Pengosongan,
                    tbl_timeline_ho_atm_bri_831.Penihilan = tbl_timeline_ho_atm_bri_831_copy1.Penihilan,
                    tbl_timeline_ho_atm_bri_831.Status_HO_BC = tbl_timeline_ho_atm_bri_831_copy1.Status_HO_BC,
                    tbl_timeline_ho_atm_bri_831.Status_RPL_Perdana = tbl_timeline_ho_atm_bri_831_copy1.Status_RPL_Perdana,
                    tbl_timeline_ho_atm_bri_831.Keterangan_Pending = tbl_timeline_ho_atm_bri_831_copy1.Keterangan_Pending,
                    tbl_timeline_ho_atm_bri_831.Tgl_Perdana = tbl_timeline_ho_atm_bri_831_copy1.Tgl_Perdana,
                    tbl_timeline_ho_atm_bri_831.keterangan = tbl_timeline_ho_atm_bri_831_copy1.keterangan,
                    tbl_timeline_ho_atm_bri_831.kategori = tbl_timeline_ho_atm_bri_831_copy1.kategori,
                    tbl_timeline_ho_atm_bri_831.target_penyelesaian_perdana = tbl_timeline_ho_atm_bri_831_copy1.target_penyelesaian_perdana 
                    WHERE tbl_timeline_ho_atm_bri_831.tid = tbl_timeline_ho_atm_bri_831_copy1.tid"); 
                //insert data
                // lastq();

                $insertdb2 = $this->db->query("INSERT IGNORE INTO tbl_timeline_ho_atm_bri_831 SELECT * FROM tbl_timeline_ho_atm_bri_831_copy1 ");
                // lastq();
                    $this->db->truncate('tbl_timeline_ho_atm_bri_831_copy1');
                // lastq();

                $updatedbfix = $this->db->query("INSERT IGNORE INTO tbl_timeline_ho_atm_bri_831 SELECT * FROM tbl_timeline_ho_atm_bri_831_copy1 ");   
                // lastq();
                if ($update || $insertdb2 || $updatedbfix) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Tlatmbri831');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Tlatmbri831');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }
        // tbl_pertumbuhan_atm-------------------------------------------------------------------------------              
        }else if ($chm == 'tbl_pertumbuhan_atm') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $NO = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $rpl_harian = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $kelolaan_atm = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $kelolaan = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $tanggal_row = $worksheet->getCellByColumnAndRow(4, $row);
                        $tanggal = $tanggal_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($tanggal_row)) {
                            $tanggal = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($tanggal));
                        }
                       
                        $temp_data[] = array(
                            'NO'              => $NO,
                            'rpl_harian'             => $rpl_harian,
                            'kelolaan_atm'       => $kelolaan_atm,
                            'kelolaan'    => $kelolaan,
                            'tanggal'    => $tanggal,
                            'user'            => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                        $this->db->truncate($chm);
                        // lastq();
                        //delete data
                        // $this->db->query("DELETE FROM Div_CHM.tbl_ssb_pm_new");
                    }
                }
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // $insert = $this->chm->insert_batch('tbl_ssb_pm_his', $temp_data);
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('PertumbuhanATM');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('PertumbuhanATM');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }
 // tbl_pencapaian_reliability_cro_atm_bri_periode_harian---------------------------------------------------------------           
        } else if ($chm == 'tbl_pencapaian_reliability_cro_atm_bri_periode_harian') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $NO = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $KANTOR_CABANG = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $JUMLAH_ATM = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $RELIABILITY_SEBELUM_SANGGAHAN = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $TAGIHAN_INVOICE_SEBELUM_SANGGAHAN = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        
                       
                        $temp_data[] = array(
                            'NO'              => $NO,
                            'KANTOR_CABANG'             => $KANTOR_CABANG,
                            'JUMLAH_ATM'       => $JUMLAH_ATM,
                            'RELIABILITY_SEBELUM_SANGGAHAN'    => $RELIABILITY_SEBELUM_SANGGAHAN,
                            // 'tanggal'    => $tanggal,
                            'TAGIHAN_INVOICE_SEBELUM_SANGGAHAN'    => $TAGIHAN_INVOICE_SEBELUM_SANGGAHAN,
                            'user'            => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                        $this->db->truncate($chm);
                        // lastq();
                        //delete data
                        // $this->db->query("DELETE FROM Div_CHM.tbl_ssb_pm_new");
                    }
                }
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // $insert = $this->chm->insert_batch('tbl_ssb_pm_his', $temp_data);
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Reabcroatmbri');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Reabcroatmbri');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }
// tbl_pencapaian_reliability_cro_atm_bri_periode_bulanan -------------------------------------------------------------------            
        } else if ($chm == 'tbl_pencapaian_reliability_cro_atm_bri_periode_bulanan') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $NO = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $KANTOR_CABANG = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $JUMLAH_ATM = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $RELIABILITY_SEBELUM_SANGGAHAN = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $TAGIHAN_INVOICE_SEBELUM_SANGGAHAN = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        
                       
                        $temp_data[] = array(
                            'NO'              => $NO,
                            'KANTOR_CABANG'             => $KANTOR_CABANG,
                            'JUMLAH_ATM'       => $JUMLAH_ATM,
                            'RELIABILITY_SEBELUM_SANGGAHAN'    => $RELIABILITY_SEBELUM_SANGGAHAN,
                            // 'tanggal'    => $tanggal,
                            'TAGIHAN_INVOICE_SEBELUM_SANGGAHAN'    => $TAGIHAN_INVOICE_SEBELUM_SANGGAHAN,
                            'user'            => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                        $this->db->truncate($chm);
                        // lastq();
                        //delete data
                        // $this->db->query("DELETE FROM Div_CHM.tbl_ssb_pm_new");
                    }
                }
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // $insert = $this->chm->insert_batch('tbl_ssb_pm_his', $temp_data);
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Reabcroatmbribul');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Reabcroatmbribul');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }
// tbl_perfomance_rpl_atm_bank_bjb_bulanan--------------------------------------------------------------------------------            
        }else if ($chm == 'tbl_perfomance_rpl_atm_bank_bjb_periode_bulanan') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $NO = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $KANTOR_CABANG = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $Total_Kelolaan_ATM = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $RPL_In_SLA = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $RPL_Out_SLA = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Total_RPL = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Performance = $worksheet->getCellByColumnAndRow(6, $row)->getValue();

                        $temp_data[] = array(
                            'NO'              => $NO,
                            'KANTOR_CABANG'             => $KANTOR_CABANG,
                            'Total_Kelolaan_ATM'       => $Total_Kelolaan_ATM,
                            'RPL_In_SLA'    => $RPL_In_SLA,
                            'RPL_Out_SLA'    => $RPL_Out_SLA,
                            'Total_RPL'    => $Total_RPL,
                            'Performance'    => $Performance,
                            'user'            => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                        $this->db->truncate($chm);
                        // lastq();
                        //delete data
                        // $this->db->query("DELETE FROM Div_CHM.tbl_ssb_pm_new");
                    }
                }
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // $insert = $this->chm->insert_batch('tbl_ssb_pm_his', $temp_data);
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Perrplbankbjbbul');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Perrplbankbjbbul');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }
// tbl_perfomance_rpl_atm_bank_bjb_periode_harian--------------------------------------------------------------------            
        } else if ($chm == 'tbl_proyeksi_pencapaian_reliability_cro_atm_bri_periode_harian') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $NO = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $KANTOR_CABANG = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $JUMLAH_ATM = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $RELIABILITY_SEBELUM_SANGGAHAN = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $TAGIHAN_INVOICE_SEBELUM_SANGGAHAN = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        
                       
                        $temp_data[] = array(
                            'NO'              => $NO,
                            'KANTOR_CABANG'             => $KANTOR_CABANG,
                            'JUMLAH_ATM'       => $JUMLAH_ATM,
                            'RELIABILITY_SEBELUM_SANGGAHAN'    => $RELIABILITY_SEBELUM_SANGGAHAN,
                            // 'tanggal'    => $tanggal,
                            'TAGIHAN_INVOICE_SEBELUM_SANGGAHAN'    => $TAGIHAN_INVOICE_SEBELUM_SANGGAHAN,
                            'user'            => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                        $this->db->truncate($chm);
                        // lastq();
                        //delete data
                        // $this->db->query("DELETE FROM Div_CHM.tbl_ssb_pm_new");
                    }
                }
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // $insert = $this->chm->insert_batch('tbl_ssb_pm_his', $temp_data);
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Propenreabbrihar');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Propenreabbrihar');
                }
            } else {
                echo "Tidak ada file yang masuk";
            } 
// tbl_proyeksi_pencapaian_reliability_cro_atm_bri_periode_bulanan--------------------------------------            
        }else if ($chm == 'tbl_proyeksi_pencapaian_reliability_cro_atm_bri_periode_bulanan') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $NO = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $KANTOR_CABANG = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $JUMLAH_ATM = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $RELIABILITY_SEBELUM_SANGGAHAN = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $TAGIHAN_INVOICE_SEBELUM_SANGGAHAN = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        
                       
                        $temp_data[] = array(
                            'NO'              => $NO,
                            'KANTOR_CABANG'             => $KANTOR_CABANG,
                            'JUMLAH_ATM'       => $JUMLAH_ATM,
                            'RELIABILITY_SEBELUM_SANGGAHAN'    => $RELIABILITY_SEBELUM_SANGGAHAN,
                            // 'tanggal'    => $tanggal,
                            'TAGIHAN_INVOICE_SEBELUM_SANGGAHAN'    => $TAGIHAN_INVOICE_SEBELUM_SANGGAHAN,
                            'user'            => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                        $this->db->truncate($chm);
                        // lastq();
                        //delete data
                        // $this->db->query("DELETE FROM Div_CHM.tbl_ssb_pm_new");
                    }
                }
                //insert data
                $insert = $this->chm->insert_batch($chm, $temp_data);
                // $insert = $this->chm->insert_batch('tbl_ssb_pm_his', $temp_data);
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Propenreabbribul');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Propenreabbribul');
                }
            } else {
                echo "Tidak ada file yang masuk";
            } 
        }    
    }
}

/* End of file upload.php */
