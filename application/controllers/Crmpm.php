<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Crmpm extends MY_Controller
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

        );

        // cekPergroup();
        $this->header('CRM PM');
        $this->load->view('CHM/list_Crmpm', $data);
        $this->footer();
    }

    public function listCrmpm()
    {
    	$list = $this->General->fetch_CoustomQuery("SELECT Bulan,Kanwil,Target_PM,Done_PM,Dismantel,OnProgress,Performance,user,tanggal_update, ROUND(Performance*100 ,2) as data1  from Div_CHM.tbl_crm_pm_new ORDER BY tanggal_update ASC ");
        // $list = $this->Serverside->_serverSide(
        //     'Div_CHM.tbl_crm_pm_new',
        //     ['no', 'Bulan', 'Kanwil', 'Target_PM', 'Done_PM', 'Dismantel', 'OnProgress', 'Performance', 'user', 'tanggal_update'],
        //     ['Bulan', 'Kanwil', 'Target_PM', 'Done_PM', 'Dismantel', 'OnProgress', 'Performance','user', 'tanggal_update'],
        //     ['tanggal_update' => 'asc'],
        //     null,
        //     'data'
        // );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->Bulan;
            $row[] = $results->Kanwil;
            $row[] = $results->Target_PM;
            $row[] = $results->Done_PM;
            $row[] = $results->Dismantel;
            $row[] = $results->OnProgress;
            $row[] = $results->data1;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_CHM.tbl_crm_pm_new'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_CHM.tbl_crm_pm_new'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
