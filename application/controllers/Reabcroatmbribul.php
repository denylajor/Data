<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Reabcroatmbribul extends MY_Controller
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
        $this->header('Pencapaian Reability CRO ATM BRI Bulanan');
        $this->load->view('CHM/list_Reabcroatmbribul', $data);
        $this->footer();
    }

    public function listReabcroatmbribul()
    {
    	$list = $this->General->fetch_CoustomQuery("SELECT KANTOR_CABANG,JUMLAH_ATM,RELIABILITY_SEBELUM_SANGGAHAN,TAGIHAN_INVOICE_SEBELUM_SANGGAHAN,user,tanggal_update, ROUND(RELIABILITY_SEBELUM_SANGGAHAN*100,2) as reab, ROUND(TAGIHAN_INVOICE_SEBELUM_SANGGAHAN*100,2) as tag from Div_CHM.tbl_pencapaian_reliability_cro_atm_bri_periode_bulanan ");

        // $list = $this->Serverside->_serverSide(
        //     'tbl_pencapaian_reliability_cro_atm_bri_periode_harian',
        //     ['no', 'KANTOR_CABANG', 'JUMLAH_ATM', 'RELIABILITY_SEBELUM_SANGGAHAN', 'TAGIHAN_INVOICE_SEBELUM_SANGGAHAN','user', 'tanggal_update'],
        //     ['KANTOR_CABANG', 'JUMLAH_ATM', 'RELIABILITY_SEBELUM_SANGGAHAN', 'TAGIHAN_INVOICE_SEBELUM_SANGGAHAN','user', 'tanggal_update'],
        //     ['NO' => 'DESC'],
        //     null,
        //     'data'
        // );

        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->KANTOR_CABANG;
            $row[] = $results->JUMLAH_ATM;
            $row[] = $results->reab;
            $row[] = $results->tag;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('tbl_pencapaian_reliability_cro_atm_bri_periode_bulanan'),
            "recordsFiltered" => $this->Serverside->_serverSide('tbl_pencapaian_reliability_cro_atm_bri_periode_bulanan'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
