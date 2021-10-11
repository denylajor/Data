<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Detailpart extends MY_Controller
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

            'inserttable' => $this->General->fetch_CoustomQuery("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='db_chm'"),
        );

        cekPergroup();
        $this->header('Tabel Detail Part');
        $this->load->view('CHM/list_detailpart', $data);
        $this->footer();
    }

    public function listDetailpart()
    {
        $list = $this->Serverside->_serverSide(
            'tbl_detailpart',
            ['no', 'tiket_ma', 'part_problem', 'description', 'tindak_lanjut', 'user', 'tanggal_update'],
            ['tiket_ma', 'part_problem', 'description', 'tindak_lanjut', 'user', 'tanggal_update'],
            ['no' => 'desc'],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->tiket_ma;
            $row[] = $results->part_problem;
            $row[] = $results->description;
            $row[] = $results->tindak_lanjut;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;
            // $row[] = $results->teknisi_vendor;
            // $row[] = $results->no_tiketvendor;
            // $row[] = $results->pet_bri;
            // $row[] = $results->open_tiket_date;
            // $row[] = $results->arrive_date;
            // $row[] = $results->start_working;
            // $row[] = $results->finish_working;
            // $row[] = $results->problem_description;
            // $row[] = $results->user;
            // $row[] = $results->tanggal_update;
            // $row[] = $results->keterangan;
            // $row[] = $results->user;


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('tbl_detailpart'),
            "recordsFiltered" => $this->Serverside->_serverSide('tbl_detailpart'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
