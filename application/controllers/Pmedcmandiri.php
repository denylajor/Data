<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pmedcmandiri extends MY_Controller
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
        $this->header('PM EDC MANDIRI');
        $this->load->view('CHM/list_Pmedcmandiri', $data);
        $this->footer();
    }

    public function listPmedcmandiri()
    {
        $list = $this->Serverside->_serverSide(
            'tbl_pm_edc_mandiri_fix',
            ['no', 'edc_tid_baru', 'status_kunjungan', 'sp', 'status_kunjungan_en','user','tanggal_update'],
            ['edc_tid_baru', 'status_kunjungan', 'sp', 'status_kunjungan_en','user','tanggal_update'],
            ['tanggal_update' => 'ASC'],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->edc_tid_baru;
            $row[] = $results->status_kunjungan;
            $row[] = $results->sp;
            $row[] = $results->status_kunjungan_en;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('tbl_pm_edc_mandiri_fix'),
            "recordsFiltered" => $this->Serverside->_serverSide('tbl_pm_edc_mandiri_fix'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
