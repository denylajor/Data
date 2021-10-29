<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sumrekon extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('excel', 'session'));
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
        $this->header('Summary Rekonsiliasi');
        $this->load->view('Keuangan/list_Sumrekon', $data);
        $this->footer();
    }

    public function listSumrekon()
    {
        $list = $this->Serverside->_serverSide(
            'Div_Keuangan.tbl_summary_rekonsiliasi',
            ['no', 'id', 'branch_name', 'ceklist', 'kas_fisik', 'kas_erp', 'kas_selisih', 'giro_opr_rek_koran', 'giro_opr_erp', 'giro_opr_selisih', 'giro_test_card_rkfisik','giro_test_card_erp','giro_test_card_selisih','persekot','keterangan', 'user', 'tanggal_update'],
            ['id', 'branch_name', 'ceklist', 'kas_fisik', 'kas_erp', 'kas_selisih', 'giro_opr_rek_koran', 'giro_opr_erp', 'giro_opr_selisih', 'giro_test_card_rkfisik','giro_test_card_erp','giro_test_card_selisih','persekot','keterangan', 'user', 'tanggal_update'],
            ['id' => 'ASC'],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->id;
            $row[] = $results->branch_name;
            $row[] = $results->ceklist;
            $row[] = rupiah($results->kas_fisik);
            $row[] = rupiah($results->kas_erp);
            $row[] = rupiah($results->kas_selisih);
            $row[] = rupiah($results->giro_opr_rek_koran);
            $row[] = rupiah($results->giro_opr_erp);
            $row[] = rupiah($results->giro_opr_selisih);
            $row[] = rupiah($results->giro_test_card_rkfisik);
            $row[] = rupiah($results->giro_test_card_erp);
            $row[] = rupiah($results->giro_test_card_selisih);
            $row[] = rupiah($results->persekot);
            $row[] = $results->keterangan;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Keuangan.tbl_summary_rekonsiliasi'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Keuangan.tbl_summary_rekonsiliasi'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
