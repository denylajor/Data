<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ReportPortalBRIMACC extends MY_Controller
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
        $this->header('Report Portal BRIMACC');
        $this->load->view('CHM/list_ReportPortalBRIMACC', $data);
        $this->footer();
    }

    public function listReportPortalBRIMACC()
    {
        $list = $this->Serverside->_serverSide(
            'tbl_report_portal_BRI_MA_cc',
            ['No', 'TID', 'Ticket_MA', 'Part_Problem', 'Description', 'Tidak_Lanjut', 'user', 'tanggal_update'],
            ['TID', 'Ticket_MA', 'Part_Problem', 'Description', 'Tidak_Lanjut', 'user', 'tanggal_update'],
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
            $row[] = $results->TID;
            $row[] = $results->Ticket_MA;
            $row[] = $results->Part_Problem;
            $row[] = $results->Description;
            $row[] = $results->Tidak_Lanjut;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('tbl_report_portal_BRI_MA_cc'),
            "recordsFiltered" => $this->Serverside->_serverSide('tbl_report_portal_BRI_MA_cc'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
