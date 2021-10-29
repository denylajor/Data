<?php

defined('BASEPATH') or exit('No direct script access allowed');

class RekapPresentaseReturnRPL extends MY_Controller
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
        $this->header('Rekap Presentase Return RPL');
        $this->load->view('Layanan/list_rekapPresentaseReturnRPL', $data);
        $this->footer();
    }

    public function listRekapPresentaseReturnRPL()
    {
        // $list = $this->General->fetch_CoustomQuery("SELECT * FROM db_layanan.gps_kendaraan ORDER BY gps_kendaraan.TAHUN ASC");
        // cetak_die($list);

        $list = $this->Serverside->_serverSide(
            'Div_Layanan.rekap_presentase_return_rpl_kl_selindo',
            ['no', 'Kantor_Layanan', 'Tgl_1', 'Tgl_2', 'Tgl_3', 'Tgl_4', 'Tgl_5', 'Tgl_6', 'Tgl_7', 'Tgl_8', 'Tgl_9', 'Tgl_10', 'Tgl_11', 'Tgl_12', 'Tgl_13', 'Tgl_14', 'Tgl_15', 'Tgl_16', 'Tgl_17', 'Tgl_18', 'Tgl_19', 'Tgl_20', 'Tgl_21', 'Tgl_22', 'Tgl_23', 'Tgl_24', 'Tgl_25', 'Tgl_26', 'Tgl_27', 'Tgl_28', 'Tgl_29', 'Tgl_30', 'Tgl_31', 'user', 'tanggal_update'],
            ['Kantor_Layanan', 'Tgl_1', 'Tgl_2', 'Tgl_3', 'Tgl_4', 'Tgl_5', 'Tgl_6', 'Tgl_7', 'Tgl_8', 'Tgl_9', 'Tgl_10', 'Tgl_11', 'Tgl_12', 'Tgl_13', 'Tgl_14', 'Tgl_15', 'Tgl_16', 'Tgl_17', 'Tgl_18', 'Tgl_19', 'Tgl_20', 'Tgl_21', 'Tgl_22', 'Tgl_23', 'Tgl_24', 'Tgl_25', 'Tgl_26', 'Tgl_27', 'Tgl_28', 'Tgl_29', 'Tgl_30', 'Tgl_31', 'user', 'tanggal_update'],
            ['user' => 'ASC'],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->Kantor_Layanan;
            $row[] = $results->Tgl_1;
            $row[] = $results->Tgl_2;
            $row[] = $results->Tgl_3;
            $row[] = $results->Tgl_4;
            $row[] = $results->Tgl_5;
            $row[] = $results->Tgl_6;
            $row[] = $results->Tgl_7;
            $row[] = $results->Tgl_8;
            $row[] = $results->Tgl_9;
            $row[] = $results->Tgl_10;
            $row[] = $results->Tgl_11;
            $row[] = $results->Tgl_12;
            $row[] = $results->Tgl_13;
            $row[] = $results->Tgl_14;
            $row[] = $results->Tgl_15;
            $row[] = $results->Tgl_16;
            $row[] = $results->Tgl_17;
            $row[] = $results->Tgl_18;
            $row[] = $results->Tgl_19;
            $row[] = $results->Tgl_20;
            $row[] = $results->Tgl_21;
            $row[] = $results->Tgl_22;
            $row[] = $results->Tgl_23;
            $row[] = $results->Tgl_24;
            $row[] = $results->Tgl_25;
            $row[] = $results->Tgl_26;
            $row[] = $results->Tgl_27;
            $row[] = $results->Tgl_28;
            $row[] = $results->Tgl_29;
            $row[] = $results->Tgl_30;
            $row[] = $results->Tgl_31;
            $row[] = $results->Average;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.rekap_presentase_return_rpl_kl_selindo'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.rekap_presentase_return_rpl_kl_selindo'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
