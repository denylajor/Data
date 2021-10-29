<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Logistikpeng extends MY_Controller
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
        $this->header('Logistik Pengiriman');
        $this->load->view('CHM/list_Logistikpeng', $data);
        $this->footer();
    }

    public function listLogistikpeng()
    {
        $list = $this->Serverside->_serverSide(
            'tbl_pengiriman_logistik',
            ['no', 'Tanggal', 'Tujuan', 'Qty', 'Sparepart','Status','user','tanggal_update'],
            ['Tanggal', 'Tujuan', 'Qty', 'Sparepart','Status','user','tanggal_update'],
            ['No' => 'ASC'],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->Tanggal;
            $row[] = $results->Tujuan;
            $row[] = $results->Qty;
            $row[] = $results->Sparepart;
            $row[] = $results->Status;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('tbl_pengiriman_logistik'),
            "recordsFiltered" => $this->Serverside->_serverSide('tbl_pengiriman_logistik'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
