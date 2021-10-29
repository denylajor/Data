<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Monitorrpm extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->audit = $this->load->database('db5', TRUE);
        $this->load->library(array('excel', 'session'));
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
        $this->header('Monitor RPM');
        $this->load->view('Audit/list_Monitorrpm', $data);
        $this->footer();
    }

    public function listMonitorrpm()
    {
        $list = $this->Serverside->_serverSide(
            'Div_Audit_Internal.monitoring_rpm',
            ['no', 'AUDITEE','Kelas_KC', 'TIM', 'TANGGAL_AUDIT_DARI', 'TANGGAL_AUDIT_SAMPAI', 'Tanggal_Exit_Meeting', 'Pengiriman_Rincian_Temuan_Audit_EO_No_Surat', 'Pengiriman_Rincian_Temuan_Audit_EO_Tanggal','JUMLAH_TEMUAN','JUMLAH_MAJOR_FRAUD','JUMLAH_MAJOR_NON_FRAUD','JUMLAH_MODERATE','LAPORAN_HASIL_AUDIT_NO_LAPORAN','LAPORAN_HASIL_AUDIT_TGL_LAPORAN','LAPORAN_HASIL_AUDIT_BATAS_WAKTU_RPM','Tanggal_Terima_Jawaban_RPM','JUMLAH_RISK_ISSUE_MAPA','Laporan_Monitoring_RPM_NO_LAPORAN','Laporan_Monitoring_RPM_TGL_LAPORAN','Status_Tindak_Lanjut_Memadai_Jml','Status_Tindak_Lanjut_Memadai','Status_Tindak_Lanjut_Tidak_Memadai_Jml','Status_Tindak_Lanjut_Tidak_Memadai','Status_Tindak_Lanjut_Dalam_Pemantauan_Jml','Status_Tindak_Lanjut_Dalam_Pemantauan','Status_Tindak_Lanjut_Total_Jml','Status_Tindak_Lanjut_Total','user','tanggal_update'],
            ['AUDITEE','Kelas_KC', 'TIM', 'TANGGAL_AUDIT_DARI', 'TANGGAL_AUDIT_SAMPAI', 'Tanggal_Exit_Meeting', 'Pengiriman_Rincian_Temuan_Audit_EO_No_Surat', 'Pengiriman_Rincian_Temuan_Audit_EO_Tanggal','JUMLAH_TEMUAN','JUMLAH_MAJOR_FRAUD','JUMLAH_MAJOR_NON_FRAUD','JUMLAH_MODERATE','LAPORAN_HASIL_AUDIT_NO_LAPORAN','LAPORAN_HASIL_AUDIT_TGL_LAPORAN','LAPORAN_HASIL_AUDIT_BATAS_WAKTU_RPM','Tanggal_Terima_Jawaban_RPM','JUMLAH_RISK_ISSUE_MAPA','Laporan_Monitoring_RPM_NO_LAPORAN','Laporan_Monitoring_RPM_TGL_LAPORAN','Status_Tindak_Lanjut_Memadai_Jml','Status_Tindak_Lanjut_Memadai','Status_Tindak_Lanjut_Tidak_Memadai_Jml','Status_Tindak_Lanjut_Tidak_Memadai','Status_Tindak_Lanjut_Dalam_Pemantauan_Jml','Status_Tindak_Lanjut_Dalam_Pemantauan','Status_Tindak_Lanjut_Total_Jml','Status_Tindak_Lanjut_Total','user','tanggal_update'],
            ['tanggal_update' => 'ASC '],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->AUDITEE;
            $row[] = $results->Kelas_KC;
            $row[] = $results->TIM;
            $row[] = $results->TANGGAL_AUDIT_DARI;
            $row[] = $results->TANGGAL_AUDIT_SAMPAI;
            $row[] = $results->Tanggal_Exit_Meeting;
            $row[] = $results->Pengiriman_Rincian_Temuan_Audit_EO_No_Surat;
            $row[] = $results->Pengiriman_Rincian_Temuan_Audit_EO_Tanggal;
            $row[] = $results->JUMLAH_TEMUAN;
            $row[] = $results->JUMLAH_MAJOR_FRAUD;
            $row[] = $results->JUMLAH_MAJOR_NON_FRAUD;
            $row[] = $results->JUMLAH_MODERATE;
            $row[] = $results->LAPORAN_HASIL_AUDIT_NO_LAPORAN;
            $row[] = $results->LAPORAN_HASIL_AUDIT_TGL_LAPORAN;
            $row[] = $results->LAPORAN_HASIL_AUDIT_BATAS_WAKTU_RPM;
            $row[] = $results->Tanggal_Terima_Jawaban_RPM;
            $row[] = $results->JUMLAH_RISK_ISSUE_MAPA;
            $row[] = $results->Laporan_Monitoring_RPM_NO_LAPORAN;
            $row[] = $results->Laporan_Monitoring_RPM_TGL_LAPORAN;
            $row[] = $results->Status_Tindak_Lanjut_Memadai_Jml;
            $row[] = $results->Status_Tindak_Lanjut_Memadai;
            $row[] = $results->Status_Tindak_Lanjut_Tidak_Memadai_Jml;
            $row[] = $results->Status_Tindak_Lanjut_Tidak_Memadai;
            $row[] = $results->Status_Tindak_Lanjut_Dalam_Pemantauan_Jml;
            $row[] = $results->Status_Tindak_Lanjut_Dalam_Pemantauan;
            $row[] = $results->Status_Tindak_Lanjut_Total_Jml;
            $row[] = $results->Status_Tindak_Lanjut_Total;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Audit_Internal.monitoring_rpm'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Audit_Internal.monitoring_rpm'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
