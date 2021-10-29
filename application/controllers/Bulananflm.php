<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bulananflm extends MY_Controller
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
        $this->header('Hybrid PM');
        $this->load->view('CHM/list_Bulananflm', $data);
        $this->footer();
    }

    public function listBulananflm()
    {
    	$list = $this->General->fetch_CoustomQuery("SELECT Bulan_Periode_PM,Kanwil,Target_PM,Done_PM,OnProgress,Performance,user,tanggal_update, ROUND(Performance*100 ,2) as data1  from Div_CHM.tbl_hybrid_pm_new");
        // $list = $this->Serverside->_serverSide(
        //     'tbl_hybrid_pm_new',
        //     ['no', 'Bulan_Periode_PM', 'Kanwil', 'Target_PM', 'Done_PM', 'OnProgress', 'OnProgress', 'Performance', 'user', 'tanggal_update'],
        //     ['Bulan_Periode_PM', 'Kanwil', 'Target_PM', 'Done_PM', 'OnProgress', 'OnProgress', 'Performance','user', 'tanggal_update'],
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
            $row[] = $results->Bulan_Periode_PM;
            $row[] = $results->Kanwil;
            $row[] = $results->Target_PM;
            $row[] = $results->Done_PM;
            $row[] = $results->OnProgress;
            $row[] = $results->data1;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_CHM.tbl_hybrid_pm_new'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_CHM.tbl_hybrid_pm_new'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
