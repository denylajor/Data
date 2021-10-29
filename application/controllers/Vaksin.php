<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Vaksin extends MY_Controller
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
        $this->header('Vaksin');
        $this->load->view('CHM/list_Vaksin', $data);
        $this->footer();
    }

    public function listVaksin()
    {
        $list = $this->Serverside->_serverSide(
            'tbl_vaksin',
            ['no', 'id_personal', 'nama', 'jabatan', 'kanca','unit_kerja','lokasi','bertugas','project','status_vaksin','status_detail','user','tanggal_update'],
            ['id_personal', 'nama', 'jabatan', 'kanca','unit_kerja','lokasi','bertugas','project','status_vaksin','status_detail','user','tanggal_update'],
            ['NO' => 'ASC'],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->id_personal;
            $row[] = $results->nama;
            $row[] = $results->jabatan;
            $row[] = $results->kanca;
            $row[] = $results->unit_kerja;
            $row[] = $results->lokasi;
            $row[] = $results->bertugas;
            $row[] = $results->project;
            $row[] = $results->status_vaksin;
            $row[] = $results->status_detail;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('tbl_vaksin'),
            "recordsFiltered" => $this->Serverside->_serverSide('tbl_vaksin'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
