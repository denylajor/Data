<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auditinternal extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('excel', 'session'));
        $this->audit = $this->load->database('db5', TRUE);
        if (!$this->session->userdata("user_login")) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data = array(

        );

        // cekPergroup();
        $this->header('Audit Internal');
        $this->load->view('Audit/audit', $data);
        $this->footer();
    }

    public function import_excel()
    {
        $audit = input('audit');

    //Tabel profile_risk_matrisk_resiko ----------------------------------------------------------------------------------
        if ($audit == 'profile_risk_matrisk_resiko') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $TAHUN_AUDIT = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $KC = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $NO_TEMUAN = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $AKTIVITAS = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $AKTIVITAS1 = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $SUB_AKTIVITAS = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $JUDUL = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $KODE_RISIKO = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $ISSUE_RISIKO = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $TIPE_TEMUAN = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $KATEGORI_TEMUAN = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $PENYEBAB_Level_1 = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $PENYEBAB_Level_2 = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $Tingkat_Penyelesaian = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $TOTAL_LOSS = $worksheet->getCellByColumnAndRow(15, $row)->getValue();

                        $temp_data[] = array(
                            'No'    => $No,
                            'TAHUN_AUDIT'    => $TAHUN_AUDIT,
                            'KC'    => $KC,
                            'NO_TEMUAN'    => $NO_TEMUAN,
                            'AKTIVITAS'    => $AKTIVITAS,
                            'AKTIVITAS1'    => $AKTIVITAS1,
                            'SUB_AKTIVITAS'    => $SUB_AKTIVITAS,
                            'JUDUL'    => $JUDUL,
                            'KODE_RISIKO'    => $KODE_RISIKO,
                            'ISSUE_RISIKO'    => $ISSUE_RISIKO,
                            'TIPE_TEMUAN'    => $TIPE_TEMUAN,
                            'KATEGORI_TEMUAN'    => $KATEGORI_TEMUAN,
                            'PENYEBAB_Level_1'    => $PENYEBAB_Level_1,
                            'PENYEBAB_Level_2'    => $PENYEBAB_Level_2,
                            'Tingkat_Penyelesaian'    => $Tingkat_Penyelesaian,
                            'TOTAL_LOSS'    => $TOTAL_LOSS,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                        //delete data
                        $this->audit->truncate($audit);
                    }
                }
                // $this->load->model('ImportModel');
                //insert data
                $insert = $this->audit->insert_batch($audit, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Profriskmatres');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Profriskmatres');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }

//Tabel monitoring_rpm ------------------------------------------------------------------------------------------------------------
        }else if ($audit == 'monitoring_rpm') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $NO = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $AUDITEE = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $TIM = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $TANGGAL_AUDIT_DARI = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $TANGGAL_AUDIT_SAMPAI = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Tanggal_Exit_Meeting = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Pengiriman_Rincian_Temuan_Audit_EO_No_Surat = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $Pengiriman_Rincian_Temuan_Audit_EO_Tanggal = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $JUMLAH_TEMUAN = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $JUMLAH_MAJOR_FRAUD = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $JUMLAH_MAJOR_NON_FRAUD = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $JUMLAH_MODERATE = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $LAPORAN_HASIL_AUDIT_NO_LAPORAN = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $LAPORAN_HASIL_AUDIT_TGL_LAPORAN = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $LAPORAN_HASIL_AUDIT_BATAS_WAKTU_RPM = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                        $Tanggal_Terima_Jawaban_RPM = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        $JUMLAH_RISK_ISSUE_MAPA = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                        $Laporan_Monitoring_RPM_NO_LAPORAN = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                        $Laporan_Monitoring_RPM_TGL_LAPORAN = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                        $Status_Tindak_Lanjut_Memadai_Jml = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                        $Status_Tindak_Lanjut_Memadai = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                        $Status_Tindak_Lanjut_Tidak_Memadai_Jml = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                        $Status_Tindak_Lanjut_Tidak_Memadai = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
                        $Status_Tindak_Lanjut_Dalam_Pemantauan_Jml = $worksheet->getCellByColumnAndRow(23, $row)->getValue();
                        $Status_Tindak_Lanjut_Dalam_Pemantauan = $worksheet->getCellByColumnAndRow(24, $row)->getValue();
                        $Status_Tindak_Lanjut_Total_Jml = $worksheet->getCellByColumnAndRow(25, $row)->getValue();
                        $Status_Tindak_Lanjut_Total = $worksheet->getCellByColumnAndRow(26, $row)->getValue();

                        $temp_data[] = array(
                            'NO'    => $NO,
                            'AUDITEE'    => $AUDITEE,
                            'TIM'    => $TIM,
                            'TANGGAL_AUDIT_DARI'    => $TANGGAL_AUDIT_DARI,
                            'TANGGAL_AUDIT_SAMPAI'    => $TANGGAL_AUDIT_SAMPAI,
                            'Tanggal_Exit_Meeting'    => $Tanggal_Exit_Meeting,
                            'Pengiriman_Rincian_Temuan_Audit_EO_No_Surat'    => $Pengiriman_Rincian_Temuan_Audit_EO_No_Surat,
                            'Pengiriman_Rincian_Temuan_Audit_EO_Tanggal'    => $Pengiriman_Rincian_Temuan_Audit_EO_Tanggal,
                            'JUMLAH_TEMUAN'    => $JUMLAH_TEMUAN,
                            'JUMLAH_MAJOR_FRAUD'    => $JUMLAH_MAJOR_FRAUD,
                            'JUMLAH_MAJOR_NON_FRAUD'    => $JUMLAH_MAJOR_NON_FRAUD,
                            'JUMLAH_MODERATE'    => $JUMLAH_MODERATE,
                            'LAPORAN_HASIL_AUDIT_NO_LAPORAN'    => $LAPORAN_HASIL_AUDIT_NO_LAPORAN,
                            'LAPORAN_HASIL_AUDIT_TGL_LAPORAN'    => $LAPORAN_HASIL_AUDIT_TGL_LAPORAN,
                            'LAPORAN_HASIL_AUDIT_BATAS_WAKTU_RPM'    => $LAPORAN_HASIL_AUDIT_BATAS_WAKTU_RPM,
                            'Tanggal_Terima_Jawaban_RPM'    => $Tanggal_Terima_Jawaban_RPM,
                            'JUMLAH_RISK_ISSUE_MAPA'    => $JUMLAH_RISK_ISSUE_MAPA,
                            'Laporan_Monitoring_RPM_NO_LAPORAN'    => $Laporan_Monitoring_RPM_NO_LAPORAN,
                            'Laporan_Monitoring_RPM_TGL_LAPORAN'    => $Laporan_Monitoring_RPM_TGL_LAPORAN,
                            'Status_Tindak_Lanjut_Memadai_Jml'    => $Status_Tindak_Lanjut_Memadai_Jml,
                            'Status_Tindak_Lanjut_Memadai'    => $Status_Tindak_Lanjut_Memadai,
                            'Status_Tindak_Lanjut_Tidak_Memadai_Jml'    => $Status_Tindak_Lanjut_Tidak_Memadai_Jml,
                            'Status_Tindak_Lanjut_Tidak_Memadai'    => $Status_Tindak_Lanjut_Tidak_Memadai,
                            'Status_Tindak_Lanjut_Dalam_Pemantauan_Jml'    => $Status_Tindak_Lanjut_Dalam_Pemantauan_Jml,
                            'Status_Tindak_Lanjut_Dalam_Pemantauan'    => $Status_Tindak_Lanjut_Dalam_Pemantauan,
                            'Status_Tindak_Lanjut_Total_Jml'    => $Status_Tindak_Lanjut_Total_Jml,
                            'Status_Tindak_Lanjut_Total'    => $Status_Tindak_Lanjut_Total,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                        //delete data
                        $this->audit->truncate($audit);
                    }
                }
                //insert data
                $insert = $this->audit->insert_batch($audit, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Monitorrpm');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Monitorrpm');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }
//Tabel profile_risk_resiko -----------------------------------------------------------------------------------------------------
        } else if ($audit == 'profile_risk_resiko') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $No = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $Aktivitas = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $No_SOP = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $Sub_Aktivitas = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $Kode_Resiko = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $Issue_Resiko = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $Tipe_Resiko = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $Jumlah = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        
                        $temp_data[] = array(
                            'No'    => $No,
                            'Aktivitas'    => $Aktivitas,
                            'No_SOP'    => $No_SOP,
                            'Sub_Aktivitas'    => $Sub_Aktivitas,
                            'Kode_Resiko'    => $Kode_Resiko,
                            'Issue_Resiko'    => $Issue_Resiko,
                            'Tipe_Resiko'    => $Tipe_Resiko,
                            'Jumlah'    => $Jumlah,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                        //delete data
                        $this->audit->truncate($audit);
                    }
                    // $this->db->query("DELETE FROM Div_CHM.tbl_detailpart WHERE ");
                }
                //insert data
                $insert = $this->audit->insert_batch($audit, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Profriskresiko');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Profriskresiko');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }
//profile_risk_temuan_kc -------------------------------------------------------------------------------------------            
        }else if ($audit == 'profile_risk_temuan_kc') {

            if (isset($_FILES["fileExcel"]["name"])) {
                $path = $_FILES["fileExcel"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // cetak_die($object);
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $NO = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $AKTIVITAS = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $SUB_AKTIVITAS = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $JUDUL = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $KODE_RISIKO = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $ISU_RISIKO = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $TIPE_TEMUAN = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $KATEGORI_TEMUAN = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $ASPEK_PENYEBAB_Level_I = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $ASPEK_PENYEBAB_Level_2 = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $BG_KC = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $Periode = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        
                        $temp_data[] = array(
                            'NO'    => $NO,
                            'AKTIVITAS'    => $AKTIVITAS,
                            'SUB_AKTIVITAS'    => $SUB_AKTIVITAS,
                            'JUDUL'    => $JUDUL,
                            'KODE_RISIKO'    => $KODE_RISIKO,
                            'ISU_RISIKO'    => $ISU_RISIKO,
                            'TIPE_TEMUAN'    => $TIPE_TEMUAN,
                            'KATEGORI_TEMUAN'    => $KATEGORI_TEMUAN,
                            'ASPEK_PENYEBAB_Level_I'    => $ASPEK_PENYEBAB_Level_I,
                            'ASPEK_PENYEBAB_Level_2'    => $ASPEK_PENYEBAB_Level_2,
                            'BG_KC'    => $BG_KC,
                            'Periode'    => $Periode,
                            'user' => $this->session->userdata("user_login")['username']

                        );
                        //delete data
                        $this->audit->truncate($audit);
                        //lastq();
                    }
                }
                //insert data
                $insert = $this->audit->insert_batch($audit, $temp_data);
                // lastq();
                if ($insert) {
                    $this->session->set_flashdata('success', 'Updated Successfully..!');
                    redirect('Profrisktemkc');
                } else {
                    $this->session->set_flashdata('error', 'Updated Failed..!');
                    redirect('Profrisktemkc');
                }
            } else {
                echo "Tidak ada file yang masuk";
            }
        }   
    }
}    