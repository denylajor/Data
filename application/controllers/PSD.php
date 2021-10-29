<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PSD extends MY_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->load->library(array('excel', 'session'));
        $this->psd = $this->load->database('db4', TRUE);
        if (!$this->session->userdata("user_login")) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data = array(

            // 'inserttable' => $this->General->fetch_CoustomQuery("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='db_chm'"),
        );
        $this->header('PSD');
        $this->load->view('PSD/psd', $data);
        $this->footer();
    }

    public function import_excel()
    {
    	$psd = input('psd');

    	if($psd == 'control_masa_STNK_kendaraan'){
    		if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $NO = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $NOPOL = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $KENDARAAN = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $PAJAK_TAHUNAN_Tanggal = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $PAJAK_TAHUNAN_Sisa_Hari = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $LIMA_TAHUNAN_Tanggal = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $LIMA_TAHUNAN_Sisa_Hari = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $KETERANGAN = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        
                        $temp_data[] = array(
                            'NO'    => $NO,
                            'NOPOL'    => $NOPOL,
                            'KENDARAAN'    => $KENDARAAN,
                            'PAJAK_TAHUNAN_Tanggal'    => $PAJAK_TAHUNAN_Tanggal,
                            'PAJAK_TAHUNAN_Sisa_Hari'    => $PAJAK_TAHUNAN_Sisa_Hari,
                            'LIMA_TAHUNAN_Tanggal' => $LIMA_TAHUNAN_Tanggal,
                            'LIMA_TAHUNAN_Sisa_Hari' => $LIMA_TAHUNAN_Sisa_Hari,
                            'KETERANGAN' => $KETERANGAN,
                            'user' => $this->session->userdata("user_login")['username']

                        );

                        //delete data
                        $this->db->query("DELETE FROM Div_PSD.control_masa_STNK_kendaraan WHERE NOPOL = '".$NOPOL."'");
                    }
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->psd->insert_batch($psd, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Contstnkkend');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Contstnkkend');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }
//Tabel rekap_SDM_karyawan_cro--------------------------------------------------------------------------------------------------            
    	} else if($psd == 'rekap_SDM_karyawan_cro'){
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Kantor_Layanan = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $KKC = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Verifikatur = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Wakil_KKL = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $SPV = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Assup_Rutang = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $Assup_CRO = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $Accounting = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $Rutang = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $Marketing = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $Admin = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $CPC = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $Custody = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $Driver = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $Teknisi_Kaset = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        $Teknisi_SLM = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                        $Pramubakti = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                        $Messenger = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                        $Training = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                        $Jumlah_Pekerja = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                        $Target = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                        $Periode = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
                        
                        $temp_data[] = array(
                            'No'    => $No,
                            'Kantor_Layanan'    => $Kantor_Layanan,
                            'KKC'    => $KKC,
                            'Verifikatur'    => $Verifikatur,
                            'Wakil_KKL'    => $Wakil_KKL,
                            'SPV' => $SPV,
                            'Assup_Rutang' => $Assup_Rutang,
                            'Assup_CRO' => $Assup_CRO,
                            'Accounting'    => $Accounting,
                            'Rutang'    => $Rutang,
                            'Marketing'    => $Marketing,
                            'Admin'    => $Admin,
                            'CPC'    => $CPC,
                            'Custody' => $Custody,
                            'Driver' => $Driver,
                            'Teknisi_Kaset' => $Teknisi_Kaset,
                            'Teknisi_SLM'    => $Teknisi_SLM,
                            'Pramubakti' => $Pramubakti,
                            'Messenger' => $Messenger,
                            'Training' => $Training,
                            'Jumlah_Pekerja'    => $Jumlah_Pekerja,
                            'Target' => $Target,
                            'Periode' => $Periode,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                        //delete data
                        // $this->db->query("DELETE FROM Div_PSD.control_masa_STNK_kendaraan WHERE NOPOL = '".$NOPOL."'");
                    }
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->psd->insert_batch($psd, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Sdmkaryawancro');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Sdmkaryawancro');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }
//Tabel rekap_SDM_karyawan_cit--------------------------------------------------------------------------------------------------            
        }else if($psd == 'rekap_SDM_karyawan_cit'){
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Kantor_Layanan = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $KKL = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Verifikatur = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Wakil_KKL = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $SPV = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Assup_Rutang = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $Assup_CIT = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $Accounting = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $Rutang = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $Marketing = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $Admin = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $CPC = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $Custody = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $Driver = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $Teknisi_Kaset = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        $Teknisi_SLM = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                        $Pramubakti = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                        $Messenger = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                        $Training = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                        $Jumlah_Pekerja = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                        $Target = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                        $Periode = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
                        
                        $temp_data[] = array(
                            'No'    => $No,
                            'Kantor_Layanan'    => $Kantor_Layanan,
                            'KKL'    => $KKL,
                            'Verifikatur'    => $Verifikatur,
                            'Wakil_KKL'    => $Wakil_KKL,
                            'SPV' => $SPV,
                            'Assup_Rutang' => $Assup_Rutang,
                            'Assup_CIT' => $Assup_CIT,
                            'Accounting'    => $Accounting,
                            'Rutang'    => $Rutang,
                            'Marketing'    => $Marketing,
                            'Admin'    => $Admin,
                            'CPC'    => $CPC,
                            'Custody' => $Custody,
                            'Driver' => $Driver,
                            'Teknisi_Kaset' => $Teknisi_Kaset,
                            'Teknisi_SLM'    => $Teknisi_SLM,
                            'Pramubakti' => $Pramubakti,
                            'Messenger' => $Messenger,
                            'Training' => $Training,
                            'Jumlah_Pekerja'    => $Jumlah_Pekerja,
                            'Target' => $Target,
                            'Periode' => $Periode,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                        //delete data
                        // $this->db->query("DELETE FROM Div_PSD.control_masa_STNK_kendaraan WHERE NOPOL = '".$NOPOL."'");
                    }
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->psd->insert_batch($psd, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Sdmkaryawancit');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Sdmkaryawancit');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }  
//Tabel rekap_SDM_satpam_bg ------------------------------------------------------------------------------------------------              
        } else if($psd == 'rekap_SDM_satpam_bg'){
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Kantor_Layanan = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $Jumlah = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Periode = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        
                        $temp_data[] = array(
                            'No'    => $No,
                            'Kantor_Layanan'    => $Kantor_Layanan,
                            'Jumlah'    => $Jumlah,
                            'Periode'    => $Periode,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                        //delete data
                        // $this->db->query("DELETE FROM Div_PSD.control_masa_STNK_kendaraan WHERE NOPOL = '".$NOPOL."'");
                    }
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->psd->insert_batch($psd, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Reksatpambg');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Reksatpambg');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }  
//Tabel rekap_SDM_pertumbuhan_atm----------------------------------------------------------------------------------------              
        } else if($psd == 'rekap_SDM_pertumbuhan_atm'){
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Kantor_Layanan = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $ATM_BRI = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $ATM_Bukopin = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $ATM_Artagraha = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $ATM_BJB = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Jumlah_ATM = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $Target = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $Kolaborasi = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $Jalin = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $Periode = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        
                        $temp_data[] = array(
                            'No'    => $No,
                            'Kantor_Layanan'    => $Kantor_Layanan,
                            'ATM_BRI'    => $ATM_BRI,
                            'ATM_Bukopin'    => $ATM_Bukopin,
                            'ATM_Artagraha'    => $ATM_Artagraha,
                            'ATM_BJB' => $ATM_BJB,
                            'Jumlah_ATM' => $Jumlah_ATM,
                            'Target' => $Target,
                            'Kolaborasi'    => $Kolaborasi,
                            'Jalin'    => $Jalin,
                            'Periode'    => $Periode,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                        //delete data
                        // $this->db->query("DELETE FROM Div_PSD.control_masa_STNK_kendaraan WHERE NOPOL = '".$NOPOL."'");
                    }
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->psd->insert_batch($psd, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Reksdmperatm');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Reksdmperatm');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }  
//Tabel register_penugasan_2021 ---------------------------------------------------------------------------------------------            
        }else if($psd == 'register_penugasan_2021'){
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Nama = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $Jabatan = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Penugasan = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Lokasi_Penugasan = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $No_SK_Penugasan = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Tanggal_SK_Penugasan = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $Penugasan_Dari = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $Penugasan_Sampai = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $Periode = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        
                        $temp_data[] = array(
                            'No'    => $No,
                            'Nama'    => $Nama,
                            'Jabatan'    => $Jabatan,
                            'Penugasan'    => $Penugasan,
                            'Lokasi_Penugasan'    => $Lokasi_Penugasan,
                            'No_SK_Penugasan' => $No_SK_Penugasan,
                            'Tanggal_SK_Penugasan' => $Tanggal_SK_Penugasan,
                            'Penugasan_Dari' => $Penugasan_Dari,
                            'Penugasan_Sampai'    => $Penugasan_Sampai,
                            'Periode'    => $Periode,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                        //delete data
                        // $this->db->query("DELETE FROM Div_PSD.control_masa_STNK_kendaraan WHERE NOPOL = '".$NOPOL."'");
                    }
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->psd->insert_batch($psd, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Regpenugasan2021');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Regpenugasan2021');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }  
//vaksin -------------------------------------------------------------------------------------------------------------            
        } else if($psd == 'data_vaksin_pt_bg'){
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Timestamp_row = $worksheet->getCellByColumnAndRow(1, $row);
                        $Timestamp = $Timestamp_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($Timestamp_row)) {
                            $Timestamp = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Timestamp));
                        }
                        $ID_Personal = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Nama = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Jabatan = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Unit_Kerja = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Wilayah = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $Vaksin_1_row = $worksheet->getCellByColumnAndRow(7, $row);
                        $Vaksin_1 = $Vaksin_1_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($Vaksin_1_row)) {
                            $Vaksin_1 = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Vaksin_1));
                        }
                        $Vaksin_2_row = $worksheet->getCellByColumnAndRow(8, $row);
                        $Vaksin_2 = $Vaksin_2_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($Vaksin_2_row)) {
                            $Vaksin_2 = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Vaksin_2));
                        }
                        $Update_Vaksin_1_row = $worksheet->getCellByColumnAndRow(9, $row);
                        $Update_Vaksin_1 = $Update_Vaksin_1_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($Update_Vaksin_1_row)) {
                            $Update_Vaksin_1 = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Update_Vaksin_1));
                        }
                        $Update_Vaksin_2_row = $worksheet->getCellByColumnAndRow(10, $row);
                        $Update_Vaksin_2 = $Update_Vaksin_2_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($Update_Vaksin_2_row)) {
                            $Update_Vaksin_2 = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Update_Vaksin_2));
                        }
                        $Jenis_Vaksin_1 = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $Jenis_Vaksin_2 = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        // $Sertifikat_1 = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $Sertifikat_1 = $worksheet->getCellByColumnAndRow(13, $row)->getValue() ;
                        $Sertifikat_2 = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        
                        $temp_data[] = array(
                            'No'    => $No,
                            'Timestamp'    => $Timestamp,
                            'ID_Personal'    => $ID_Personal,
                            'Nama'    => $Nama,
                            'Jabatan'    => $Jabatan,
                            'Unit_Kerja' => $Unit_Kerja,
                            'Wilayah' => $Wilayah,
                            'Vaksin_1' => $Vaksin_1,
                            'Vaksin_2'    => $Vaksin_2,
                            'Update_Vaksin_1'    => $Update_Vaksin_1,
                            'Update_Vaksin_2'    => $Update_Vaksin_2,
                            'Jenis_Vaksin_1' => $Jenis_Vaksin_1,
                            'Jenis_Vaksin_2' => $Jenis_Vaksin_2,
                            'Sertifikat_1' => $Sertifikat_1,
                            'Sertifikat_2' => $Sertifikat_2,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                        $this->db->query("DELETE FROM Div_PSD.data_vaksin_pt_bg WHERE ID_Personal = '".$ID_Personal."'");
                        // lastq();
                    }
                        //delete data
                }
                // $this->load->model('ImportModel');
                //insert data
                 $insert = $this->psd->insert_batch($psd, $temp_data);
                // $insert = $this->db->insert_batch('Div_PSD.data_vaksin_pt_bg', $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Vaksinpsd');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Vaksinpsd');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }  
//data_non_vaksin_pt_bg -----------------------------------------------------------------------------------------------------------------            
        } else if($psd == 'data_non_vaksin_pt_bg'){
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Timestamp_row = $worksheet->getCellByColumnAndRow(1, $row);
                        $Timestamp = $Timestamp_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($Timestamp_row)) {
                            $Timestamp = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Timestamp));
                        }
                        $ID_Personal = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Nama = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Jabatan = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Unit_Kerja = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Wilayah = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $Keterangan = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        
                        $temp_data[] = array(
                            'No'    => $No,
                            'Timestamp'    => $Timestamp,
                            'ID_Personal'    => $ID_Personal,
                            'Nama'    => $Nama,
                            'Jabatan'    => $Jabatan,
                            'Unit_Kerja' => $Unit_Kerja,
                            'Wilayah' => $Wilayah,
                            'Keterangan' => $Keterangan,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                        //delete data
                        $this->db->query("DELETE FROM Div_PSD.data_non_vaksin_pt_bg WHERE ID_Personal = '".$ID_Personal."'");
                    }
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->psd->insert_batch($psd, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Nonvaksinpsd');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Nonvaksinpsd');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }  
//daftar_pekerja_terdaftar_vaksin_dan_sudah_di_vaksin ---------------------------------------------------------------------            
        }  else if($psd == 'daftar_pekerja_terdaftar_vaksin_dan_sudah_di_vaksin'){
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Unit_Kerja = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $Total_Pekerja = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Belum_Boleh_Vaksin = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Persentase_Belum_Boleh_Vaksin = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Terdaftar_Vaksin = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Persentase_Terdaftar_Vaksin = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $Belum_Terdaftar_Vaksin = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $Persentase_Belum_Terdaftar_Vaksin = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $Sudah_Vaksin = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $Persentase_Sudah_Vaksin = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        
                        $temp_data[] = array(
                            'No'    => $No,
                            'Unit_Kerja'    => $Unit_Kerja,
                            'Total_Pekerja'    => $Total_Pekerja,
                            'Belum_Boleh_Vaksin'    => $Belum_Boleh_Vaksin,
                            'Persentase_Belum_Boleh_Vaksin'    => $Persentase_Belum_Boleh_Vaksin,
                            'Terdaftar_Vaksin' => $Terdaftar_Vaksin,
                            'Persentase_Terdaftar_Vaksin' => $Persentase_Terdaftar_Vaksin,
                            'Belum_Terdaftar_Vaksin' => $Belum_Terdaftar_Vaksin,
                            'Persentase_Belum_Terdaftar_Vaksin'    => $Persentase_Belum_Terdaftar_Vaksin,
                            'Sudah_Vaksin' => $Sudah_Vaksin,
                            'Persentase_Sudah_Vaksin' => $Persentase_Sudah_Vaksin,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                        //delete data
                        $this->psd->truncate($psd);
                    }
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->psd->insert_batch($psd, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Pektervak');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Pektervak');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }  
//rekap_pekerja_tdk_masuk_bg -------------------------------------------------------------------------------------------------
        }  else if($psd == 'rekap_pekerja_tdk_masuk_bg'){
            // cetak_die($psd);
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Tanggal_row = $worksheet->getCellByColumnAndRow(1, $row);
                        $Tanggal = $Tanggal_row->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($Tanggal_row)) {
                            $Tanggal = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($Tanggal));
                        }
                        $Unit_kerja = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Nama = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Jabatan = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Keterangan = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Kondisi = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $Gejala = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $Kategori = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $Batas_monitoring = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $Uker = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $Isoman = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $Status = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        
                        $temp_data[] = array(
                            'No'    => $No,
                            'Tanggal'    => $Tanggal,
                            'Unit_kerja'    => $Unit_kerja,
                            'Nama'    => $Nama,
                            'Jabatan'    => $Jabatan,
                            'Keterangan' => $Keterangan,
                            'Kondisi' => $Kondisi,
                            'Gejala' => $Gejala,
                            'Kategori'    => $Kategori,
                            'Batas_monitoring' => $Batas_monitoring,
                            'Uker' => $Uker,
                            'Isoman' => $Isoman,
                            'Status' => $Status,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                        //delete data
                        $this->psd->truncate($psd);
                    }
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->psd->insert_batch($psd, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Rekpektdkmsk');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Rekpektdkmsk');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }  
//data pembina ------------------------------------------------------------------------------------------------------------------            
        }else if($psd == 'data_pembina'){
            // cetak_die($psd);
            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Unit_Kerja = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $Total_Pekerja = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Belum_Boleh_Vaksin = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Sudah_Vaksin = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Belum_Terdaftar_Vaksin = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Terdaftar_Vaksin = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $Persentase_Belum_Boleh_Vaksin = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $Persentase_Sudah_Vaksin = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $Persentase_Belum_Terdaftar_Vaksin = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $Pembina = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $Keterangan = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        
                        $temp_data[] = array(
                            'No'    => $No,
                            'Unit_Kerja'    => $Unit_Kerja,
                            'Total_Pekerja'    => $Total_Pekerja,
                            'Belum_Boleh_Vaksin'    => $Belum_Boleh_Vaksin,
                            'Sudah_Vaksin'    => $Sudah_Vaksin,
                            'Belum_Terdaftar_Vaksin' => $Belum_Terdaftar_Vaksin,
                            'Terdaftar_Vaksin' => $Terdaftar_Vaksin,
                            'Persentase_Belum_Boleh_Vaksin' => $Persentase_Belum_Boleh_Vaksin,
                            'Persentase_Sudah_Vaksin'    => $Persentase_Sudah_Vaksin,
                            'Persentase_Belum_Terdaftar_Vaksin' => $Persentase_Belum_Terdaftar_Vaksin,
                            'Pembina' => $Pembina,
                            'Keterangan' => $Keterangan,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                        // cetak_die($temp_data);
                        //delete data
                        // $this->psd->truncate($psd);
                        $this->db->query("DELETE FROM Div_PSD.data_pembina WHERE Unit_Kerja = '".$Unit_Kerja."'");
                    }
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->psd->insert_batch($psd, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Datapembina');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Datapembina');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }  
        }      
    }
}