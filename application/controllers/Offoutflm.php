<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Offinflm extends MY_Controller
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
        $this->header('Off In FLM');
        $this->load->view('CHM/list_offoutflm', $data);
        $this->footer();
    }

    public function listOffoutflm()
    {
        $list = $this->Serverside->_serverSide(
            'tbl_off_out_flm',
            ['no', 'tid', 'db', 'ip_addr', 'kanwil', 'kc_supervisi', 'pengelola', 'lokasi', 'status', 'problem', 'ticket', 'waktu_insert', 'downtime_system', 'est_tgl_problem', 'last_tunai', 'downtime_tunai', 'ticket_ojk', 'rtl_ticket', 'rtl_update', 'rtl_problem', 'rtl_group', 'rtl_sla', 'keterangan', 'rtl_keterangan'],
            ['tid', 'db', 'ip_addr', 'kanwil', 'kc_supervisi', 'pengelola', 'lokasi', 'status', 'problem', 'ticket', 'waktu_insert', 'downtime_system', 'est_tgl_problem', 'last_tunai', 'downtime_tunai', 'ticket_ojk', 'rtl_ticket', 'rtl_update', 'rtl_problem', 'rtl_group', 'rtl_sla', 'keterangan', 'rtl_keterangan'],
            ['no_off_in_flm' => 'desc'],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->tid;
            $row[] = $results->db;
            $row[] = $results->ip_addr;
            $row[] = $results->kanwil;
            $row[] = $results->kc_supervisi;
            $row[] = $results->pengelola;
            $row[] = $results->lokasi;
            $row[] = $results->status;
            $row[] = $results->problem;
            $row[] = $results->ticket;
            $row[] = $results->waktu_insert;
            $row[] = $results->downtime_system;
            $row[] = $results->est_tgl_problem;
            $row[] = $results->last_tunai;
            $row[] = $results->downtime_tunai;
            $row[] = $results->ticket_ojk;
            $row[] = $results->rtl_ticket;
            $row[] = $results->rtl_update;
            $row[] = $results->rtl_problem;
            $row[] = $results->rtl_group;
            $row[] = $results->rtl_sla;
            $row[] = $results->keterangan;
            $row[] = $results->rtl_keterangan;


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('tbl_off_in_flm'),
            "recordsFiltered" => $this->Serverside->_serverSide('tbl_off_in_flm'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
