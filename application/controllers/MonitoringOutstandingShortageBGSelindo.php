<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MonitoringOutstandingShortageBGSelindo extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->layanan = $this->load->database('db2', TRUE);
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
        $this->header('Monitoring Outstanding Shortage BG Selindo');
        $this->load->view('Layanan/list_monitoringOutstandingShortageBGSelindo', $data);
        $this->footer();
    }

    public function listMonitoringOutstandingShortageBGSelindo()
    {
        // $list = $this->General->fetch_CoustomQuery("SELECT * FROM db_layanan.gps_kendaraan ORDER BY gps_kendaraan.TAHUN ASC");
        // cetak_die($list);

        $list = $this->Serverside->_serverSide(
            'Div_Layanan.Monitoring_Outstanding_Shortage_BG_Selindo',
            ['no', 'Kantor_Cabang', 'Frekuensi', 'Nominal', 'Frekuensi_Kasus_New', 'Frekuensi_Kasus_Open', 'Frekuensi_Kasus_Close', 'Frekuensi_Kasus', 'Progress_Mingguan', 'Closed_Case_Done', 'Closed_Case_Progress', 'Pending_Jan_Sept', 'Pending_Oktober', 'All Pending', 'user', 'tanggal_update'],
            ['Kantor_Cabang', 'Frekuensi', 'Nominal', 'Frekuensi_Kasus_New', 'Frekuensi_Kasus_Open', 'Frekuensi_Kasus_Close', 'Frekuensi_Kasus', 'Progress_Mingguan', 'Closed_Case_Done', 'Closed_Case_Progress', 'Pending_Jan_Sept', 'Pending_Oktober', 'All Pending', 'user', 'tanggal_update'],
            ['tanggal_update' => 'DESC'],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->Kantor_Cabang;
            $row[] = $results->Frekuensi;
            $row[] = rupiah($results->Nominal);
            $row[] = $results->Frekuensi_Kasus_New;
            $row[] = $results->Frekuensi_Kasus_Open;
            $row[] = $results->Frekuensi_Kasus_Close;
            $row[] = $results->Frekuensi_Kasus;
            $row[] = $results->Progress_Mingguan;
            $row[] = rupiah($results->Closed_Case_Done);
            $row[] = rupiah($results->Closed_Case_Progress);
            $row[] = $results->Pending_Jan_Sept;
            $row[] = $results->Pending_Oktober;
            $row[] = $results->All_Pending;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }
        // lastq();

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.Monitoring_Outstanding_Shortage_BG_Selindo'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.Monitoring_Outstanding_Shortage_BG_Selindo'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
