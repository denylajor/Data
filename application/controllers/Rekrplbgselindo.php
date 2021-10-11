<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rekrplbgselindo extends MY_Controller
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
        $this->header('Rekap RPL BG Selindo');
        $this->load->view('Layanan/list_rekrplbgselindo', $data);
        $this->footer();
    }

    public function listRekrplbgselindo()
    {
        $list = $this->Serverside->_serverSide(
            'Div_Layanan.rekap_rpl_bg_selindo',
            ['no', 'KANTOR_LAYANAN', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli','Agustus','September','Oktober','November','Desember','Average_ALL','AVERAGE_MONTH_ATM_Replenish', 'user', 'tanggal_update', ],
            ['KANTOR_LAYANAN', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli','Agustus','Average_ALL','AVERAGE_MONTH_ATM_Replenish', 'user', 'tanggal_update', ],
            ['No' => 'ASC '],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->KANTOR_LAYANAN;
            $row[] = $results->Januari;
            $row[] = $results->Februari;
            $row[] = $results->Maret;
            $row[] = $results->April;
            $row[] = $results->Mei;
            $row[] = $results->Juni;
            $row[] = $results->Juli;
            $row[] = $results->Agustus;
            $row[] = $results->September;
            $row[] = $results->Oktober;
            $row[] = $results->November;
            $row[] = $results->Desember;
            $row[] = $results->Average_ALL;
            $row[] = $results->AVERAGE_MONTH_ATM_Replenish;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.rekap_rpl_bg_selindo'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.rekap_rpl_bg_selindo'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
