<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ReportSSBHybridCC extends MY_Controller
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
        $this->header('Report SSB & Hybrid(CC)');
        $this->load->view('CHM/list_ReportSBBHybridCC', $data);
        $this->footer();
    }

    public function listReportSSBHybridCC()
    {
        $list = $this->Serverside->_serverSide(
            'tbl_report_ssb_hybrid_cc',
            ['No', 'Kanwil', 'Kanca', 'Lokasi', 'ID_Term', 'Mesin', 'Problem', 'Nama_Part', 'Date_Report', 'Downtime_Ticket', 'In_Out_SLA', 'Ticket_Number', 'Status', 'Keterangan', 'SLA', 'SLA_1', 'Penyelesaian', 'user', 'tanggal_update'],
            ['Kanwil', 'Kanca', 'Lokasi', 'ID_Term', 'Mesin', 'Problem', 'Nama_Part', 'Date_Report', 'Downtime_Ticket', 'In_Out_SLA', 'Ticket_Number', 'Status', 'Keterangan', 'SLA', 'SLA_1', 'Penyelesaian', 'user', 'tanggal_update'],
            ['No' => 'asc'],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->Kanwil;
            $row[] = $results->Kanca;
            $row[] = $results->Lokasi;
            $row[] = $results->ID_Term;
            $row[] = $results->Mesin;
            $row[] = $results->Problem;
            $row[] = $results->Nama_Part;
            $row[] = $results->Date_Report;
            $row[] = $results->Downtime_Ticket;
            $row[] = $results->In_Out_SLA;
            $row[] = $results->Ticket_Number;
            $row[] = $results->Status;
            $row[] = $results->Keterangan;
            $row[] = $results->SLA;
            $row[] = $results->SLA_1;
            $row[] = $results->Penyelesaian;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('tbl_report_ssb_hybrid_cc'),
            "recordsFiltered" => $this->Serverside->_serverSide('tbl_report_ssb_hybrid_cc'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
