<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Reksatpambg extends MY_Controller
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
        $this->header('Rekap Satpam BG');
        $this->load->view('PSD/list_reksatpambg', $data);
        $this->footer();
    }

    public function listReksatpambg()
    {
        $list = $this->Serverside->_serverSide(
            'Div_PSD.rekap_SDM_satpam_bg',
            ['no', 'Kantor_Layanan', 'Jumlah', 'Periode','user','tanggal_update'],
            ['Kantor_Layanan', 'Jumlah', 'Periode','user','tanggal_update'],
            ['tanggal_update' => 'ASC'],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->Kantor_Layanan;
            $row[] = $results->Jumlah;
            $row[] = $results->Periode;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_PSD.rekap_SDM_satpam_bg'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_PSD.rekap_SDM_satpam_bg'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
