<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PM extends MY_Controller
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
        $this->header('Tabel PM');
        $this->load->view('CHM/list_pm', $data);
        $this->footer();
    }

    public function listPM()
    {
        $list = $this->Serverside->_serverSide(
            'tbl_pm',
            ['no', 'terminal_id', 'project', 'sn', 'start_warranty', 'end_warranty', 'kanwil', 'kanca', 'lokasi', 'teknisi_vendor', 'no_tiket', 'open_tiket_date', 'kunjungan', 'keterangan_lain', 'bulan','user','tanggal_update'],
            ['terminal_id', 'project', 'sn', 'start_warranty', 'end_warranty', 'kanwil', 'kanca',  'lokasi', 'teknisi_vendor', 'no_tiket', 'open_tiket_date', 'kunjungan', 'keterangan_lain', 'bulan','user','tanggal_update'],
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
            $row[] = $results->project;
            $row[] = $results->sn;
            $row[] = $results->start_warranty;
            $row[] = $results->end_warranty;
            $row[] = $results->kanwil;
            $row[] = $results->kanca;
            $row[] = $results->lokasi;
            $row[] = $results->teknisi_vendor;
            $row[] = $results->no_tiket;
            $row[] = $results->open_tiket_date;
            $row[] = $results->kunjungan;
            $row[] = $results->keterangan_lain;
            $row[] = $results->bulan;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;
            // $row[] = $results->tanggal_update;
            // $row[] = $results->keterangan;
            // $row[] = $results->user;


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('tbl_pm'),
            "recordsFiltered" => $this->Serverside->_serverSide('tbl_pm'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
