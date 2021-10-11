<?php

defined('BASEPATH') or exit('No direct script access allowed');

class TechnicalReportCC extends MY_Controller
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
        $this->header('Technical Report(CC)');
        $this->load->view('CHM/list_TechnicalReport', $data);
        $this->footer();
    }

    public function listTechnicalReportCC()
    {
        $list = $this->Serverside->_serverSide(
            'tbl_technical_report_cc',
            ['no', 'Name', 'Id_Term', 'Location', 'Project', 'Problem', 'Date_Close', 'Ticket_Number', 'Note', 'user', 'tanggal_update'],
            ['Name', 'Id_Term', 'Location', 'Project', 'Problem', 'Date_Close', 'Ticket_Number', 'Note', 'user', 'tanggal_update'],
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
            $row[] = $results->Name;
            $row[] = $results->Id_Term;
            $row[] = $results->Location;
            $row[] = $results->Project;
            $row[] = $results->Problem;
            $row[] = $results->Date_Close;
            $row[] = $results->Ticket_Number;
            $row[] = $results->Note;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('tbl_technical_report_cc'),
            "recordsFiltered" => $this->Serverside->_serverSide('tbl_technical_report_cc'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
