<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CM extends MY_Controller
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
        $this->header('Tabel CM');
        $this->load->view('CHM/list_cm', $data);
        $this->footer();
    }

    public function listCM()
    {
        $list = $this->Serverside->_serverSide(
            'tbl_cm',
            ['no', 'terminal_id', 'sn', 'echannel', 'kanwil', 'kanca', 'lokasi', 'teknisi_vendor', 'no_tiketvendor', 'pet_bri', 'open_tiket_date', 'arrive_date', 'start_working', 'finish_working', 'problem_description', 'user', 'tanggal_update'],
            ['terminal_id', 'sn', 'echannel', 'kanwil', 'kanca', 'lokasi', 'teknisi_vendor', 'no_tiketvendor', 'pet_bri', 'open_tiket_date', 'arrive_date', 'start_working', 'finish_working', 'problem_description', 'user', 'tanggal_update'],
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
            $row[] = $results->terminal_id;
            $row[] = $results->sn;
            $row[] = $results->kanwil;
            $row[] = $results->kanca;
            $row[] = $results->lokasi;
            $row[] = $results->echannel;
            $row[] = $results->teknisi_vendor;
            $row[] = $results->no_tiketvendor;
            $row[] = $results->pet_bri;
            $row[] = $results->open_tiket_date;
            $row[] = $results->arrive_date;
            $row[] = $results->start_working;
            $row[] = $results->finish_working;
            $row[] = $results->problem_description;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;
            // $row[] = $results->keterangan;
            // $row[] = $results->user;


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('tbl_cm'),
            "recordsFiltered" => $this->Serverside->_serverSide('tbl_cm'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
