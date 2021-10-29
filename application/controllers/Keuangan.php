<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Keuangan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('excel', 'session'));
        $this->keuangan = $this->load->database('db6', TRUE);
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
        $this->header('Keuangan');
        $this->load->view('Keuangan/keuangan', $data);
        $this->footer();
    }

    public function import_excel()
    {
    	$keuangan = input('keuangan');
        if ($keuangan == 'tbl_summary_rekonsiliasi') {
            // cetak_die($chm);
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $branch_name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $ceklist = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $kas_fisik = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $kas_erp = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $kas_selisih = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $giro_opr_rek_koran = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $giro_opr_erp = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $giro_opr_selisih = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $giro_test_card_rkfisik = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $giro_test_card_erp = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $giro_test_card_selisih = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $persekot = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $keterangan = $worksheet->getCellByColumnAndRow(13, $row)->getValue();

                        $temp_data[] = array(
                            'id'    => $id,
                            'branch_name'    => $branch_name,
                            'ceklist'    => $ceklist,
                            'kas_fisik'    => $kas_fisik,
                            'kas_erp'    => $kas_erp,
                            'kas_selisih'    => $kas_selisih,
                            'giro_opr_rek_koran'    => $giro_opr_rek_koran,
                            'giro_opr_erp'    => $giro_opr_erp,
                            'giro_opr_selisih'    => $giro_opr_selisih,
                            'giro_test_card_rkfisik'    => $giro_test_card_rkfisik,
                            'giro_test_card_erp'    => $giro_test_card_erp,
                            'giro_test_card_selisih'    => $giro_test_card_selisih,
                            'persekot'    => $persekot,
                            'keterangan'    => $keterangan,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                        //delete data
                        $this->db->query("DELETE FROM Div_Keuangan.tbl_summary_rekonsiliasi WHERE id = '".$id."'");
                        // cetak_die($temp_data);
                        // lastq();
                    }
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->keuangan->insert_batch($keuangan, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Sumrekon');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Sumrekon');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }

//tbl_laporan_vaksin ------------------------------------------------------------------------------------------------------------
        }else if ($keuangan == 'tbl_laporan_vaksin') {
            // cetak_die($chm);
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $ID_Personal = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $Nama = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Jabatan = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Unit_Kerja = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Tanggal_Vaksin_I_row = $worksheet->getCellByColumnAndRow(5, $row);
                        $Tanggal_Vaksin_I = $Tanggal_Vaksin_I_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($Tanggal_Vaksin_I_row)) {
                            $Tanggal_Vaksin_I = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Tanggal_Vaksin_I));
                        }
                        $Tanggal_Vaksin_II_row = $worksheet->getCellByColumnAndRow(6, $row);
                        $Tanggal_Vaksin_II = $Tanggal_Vaksin_II_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($Tanggal_Vaksin_II_row)) {
                            $Tanggal_Vaksin_II = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Tanggal_Vaksin_II));
                        }
                        $Keterangan = $worksheet->getCellByColumnAndRow(7, $row)->getValue();

                        $temp_data[] = array(
                            'No'    => $No,
                            'ID_Personal'    => $ID_Personal,
                            'Nama'    => $Nama,
                            'Jabatan'    => $Jabatan,
                            'Unit_Kerja'    => $Unit_Kerja,
                            'Tanggal_Vaksin_I'    => $Tanggal_Vaksin_I,
                            'Tanggal_Vaksin_II'    => $Tanggal_Vaksin_II,
                            'Keterangan'    => $Keterangan,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                        //delete data
                        $this->db->query("DELETE FROM Div_Keuangan.tbl_laporan_vaksin WHERE ID_Personal = '".$ID_Personal."'");
                        // lastq();
                    }
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->keuangan->insert_batch($keuangan, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Lapvaksin');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Lapvaksin');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }
        }    
	}    	
}