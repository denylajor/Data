<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PertumbuhanATM extends MY_Controller
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
        $data = array();

        // cekPergroup();
        $this->header('Pertumbuhan ATM');
        $this->load->view('CHM/list_pertumbuhanATM', $data);
        $this->footer();
    }

    public function listPertumbuhanATM()
    {
        $list = $this->General->fetch_CoustomQuery("SELECT rpl_harian,kelolaan_atm,kelolaan,tanggal,user,tanggal_update, ROUND(kelolaan*100,2) as kel from Div_CHM.tbl_pertumbuhan_atm");

        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->rpl_harian;
            $row[] = $results->kelolaan_atm;
            $row[] = $results->kel;
            $row[] = $results->tanggal;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('tbl_pertumbuhan_atm'),
            "recordsFiltered" => $this->Serverside->_serverSide('tbl_pertumbuhan_atm'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
