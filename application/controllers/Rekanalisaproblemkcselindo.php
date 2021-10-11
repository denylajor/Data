<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rekanalisaproblemkcselindo extends MY_Controller
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
        $this->header('Rekap Analisa Problem KC Selindo');
        $this->load->view('Layanan/list_rekanalisaproblemkcselindo', $data);
        $this->footer();
    }

    public function listRekanalisaproblemkcselindo()
    {
        $list = $this->Serverside->_serverSide(
            'Div_Layanan.rekap_analisa_problem_kc_selindo',
            ['no', 'KANTOR_CABANG', 'RATAS_ATM', 'AVG_RELIABILITY', 'OFF_OUT_FLM', 'CO_OUT_FLM', 'CODF_OUT_FLM', 'DF_OUT_FLM', 'NT1D_OUT_FLM','JUMLAH','RPL','FLM','RPL_ATM_BLN', 'user', 'tanggal_update', ],
            ['KANTOR_CABANG', 'RATAS_ATM', 'AVG_RELIABILITY', 'OFF_OUT_FLM', 'CO_OUT_FLM', 'CODF_OUT_FLM', 'DF_OUT_FLM', 'NT1D_OUT_FLM','JUMLAH','RPL','FLM','RPL_ATM_BLN', 'user', 'tanggal_update', ],
            ['NO' => 'ASC '],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->KANTOR_CABANG;
            $row[] = $results->RATAS_ATM;
            $row[] = $results->AVG_RELIABILITY;
            $row[] = $results->OFF_OUT_FLM;
            $row[] = $results->CO_OUT_FLM;
            $row[] = $results->CODF_OUT_FLM;
            $row[] = $results->DF_OUT_FLM;
            $row[] = $results->NT1D_OUT_FLM;
            $row[] = $results->JUMLAH;
            $row[] = $results->RPL;
            $row[] = $results->FLM;
            $row[] = $results->RPL_ATM_BLN;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.rekap_analisa_problem_kc_selindo'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.rekap_analisa_problem_kc_selindo'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
