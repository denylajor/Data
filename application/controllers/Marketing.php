<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Marketing extends MY_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->load->library(array('excel', 'session'));
        $this->marketing = $this->load->database('db7', TRUE);
        if (!$this->session->userdata("user_login")) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data = array(

            // 'inserttable' => $this->General->fetch_CoustomQuery("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='db_chm'"),
        );
        $this->header('Marketing');
        $this->load->view('Marketing/marketing', $data);
        $this->footer();
    }

    public function import_excel()
    {
    	$marketing = input('marketing');
    	// cetak_die($marketing);

    	if($marketing == 'inisiasi_proyek'){
    		if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Deskripsi = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $Segmentasi = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Tahap_Perkenalan = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Tahap_Rekanan = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Keterangan = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Target_Kerjasama_Bisnis = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $Keterangan_Tambahan = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        
                        $temp_data[] = array(
                            'No'    => $No,
                            'Deskripsi'    => $Deskripsi,
                            'Segmentasi'    => $Segmentasi,
                            'Tahap_Perkenalan'    => $Tahap_Perkenalan,
                            'Tahap_Rekanan'    => $Tahap_Rekanan,
                            'Keterangan' => $Keterangan,
                            'Target_Kerjasama_Bisnis' => $Target_Kerjasama_Bisnis,
                            'Keterangan_Tambahan' => $Keterangan_Tambahan,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                        //delete data
                        $this->marketing->truncate($marketing);
                        // $this->db->query("DELETE FROM Div_marketing.control_masa_STNK_kendaraan WHERE NOPOL = '".$NOPOL."'");
                    }
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->marketing->insert_batch($marketing, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Inisiasiproyek');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Inisiasiproyek');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }
//Laporan Vaksin ----------------------------------------------------------------------------------------------------------            
        } else if($marketing == 'laporan_vaksin'){
    		if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Unit_Kerja = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $ID_Personil = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $ID_Pegawai = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Nama = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Jabatan = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Sudah_Vaksin_I_row = $worksheet->getCellByColumnAndRow(6, $row);
                        $Sudah_Vaksin_I = $Sudah_Vaksin_I_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($Sudah_Vaksin_I_row)) {
                            $Sudah_Vaksin_I = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Sudah_Vaksin_I));
                        }
                        $Sudah_Vaksin_II_row = $worksheet->getCellByColumnAndRow(7, $row);
                        $Sudah_Vaksin_II = $Sudah_Vaksin_II_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($Sudah_Vaksin_II_row)) {
                            $Sudah_Vaksin_II = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Sudah_Vaksin_II));
                        }
                        $Keterangan = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        
                        $temp_data[] = array(
                            'No'    => $No,
                            'Unit_Kerja'    => $Unit_Kerja,
                            'ID_Personil'    => $ID_Personil,
                            'ID_Pegawai'    => $ID_Pegawai,
                            'Nama'    => $Nama,
                            'Jabatan' => $Jabatan,
                            'Sudah_Vaksin_I' => $Sudah_Vaksin_I,
                            'Sudah_Vaksin_II' => $Sudah_Vaksin_II,
                            'Keterangan' => $Keterangan,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                        // delete data
                        // $this->marketing->truncate($marketing);
                        $this->db->query("DELETE FROM Div_Marketing.laporan_vaksin WHERE ID_Personil = '".$ID_Personil."'");
                    }
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->marketing->insert_batch($marketing, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Laporanvaksin');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Laporanvaksin');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }
//surat_penawaran ------------------------------------------------------------------------------------------------------------       
        }else if($marketing == 'surat_penawaran'){
    		if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Projek = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $Deskripsi = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Keterangan = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Penawaran = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        
                        $temp_data[] = array(
                            'No'    => $No,
                            'Projek'    => $Projek,
                            'Deskripsi'    => $Deskripsi,
                            'Keterangan'    => $Keterangan,
                            'Penawaran'    => $Penawaran,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                        // delete data
                        $this->marketing->truncate($marketing);
                        // $this->db->query("DELETE FROM Div_Marketing.laporan_vaksin WHERE ID_Personil = '".$ID_Personil."'");
                    }
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->marketing->insert_batch($marketing, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Laporanvaksin');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Laporanvaksin');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }
        }   
    }	
}    