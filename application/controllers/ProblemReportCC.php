<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ProblemReportCC extends MY_Controller
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
        $this->header('Problem ReportCC');
        $this->load->view('CHM/list_problemReportCC', $data);
        $this->footer();
    }

    public function listProblemReportCC()
    {
        $list = $this->Serverside->_serverSide(
            'tbl_problem_report_cc',
            ['no', 'Name', 'ID_Term', 'Lokasi', 'Project', 'Serial_Number', 'Problem_Description', 'Date_Report', 'Date_Close', 'Ticket_Number', 'Status', 'Note', 'user', 'tanggal_update'],
            ['Name', 'ID_Term', 'Lokasi', 'Project', 'Serial_Number', 'Problem_Description', 'Date_Report', 'Date_Close', 'Ticket_Number', 'Status', 'Note', 'user', 'tanggal_update'],
            ['no' => 'asc'],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->Name;
            $row[] = $results->ID_Term;
            $row[] = $results->Lokasi;
            $row[] = $results->Project;
            $row[] = $results->Serial_Number;
            $row[] = $results->Problem_Description;
            $row[] = $results->Date_Report;
            $row[] = $results->Date_Close;
            $row[] = $results->Ticket_Number;
            $row[] = $results->Status;
            $row[] = $results->Note;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('tbl_problem_report_cc'),
            "recordsFiltered" => $this->Serverside->_serverSide('tbl_problem_report_cc'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
