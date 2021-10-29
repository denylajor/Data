<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pektervak extends MY_Controller
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
        $this->header('Daftar Pekerja Tedaftar Vaksin dan Sudah Vaksin');
        $this->load->view('PSD/list_Pektervak', $data);
        $this->footer();
    }

    public function listPektervak()
    {
        $list = $this->General->fetch_CoustomQuery("SELECT Unit_Kerja,Total_Pekerja,Belum_Boleh_Vaksin,Persentase_Belum_Boleh_Vaksin,Terdaftar_Vaksin,Persentase_Terdaftar_Vaksin,Belum_Terdaftar_Vaksin,Persentase_Belum_Terdaftar_Vaksin,Sudah_Vaksin,Persentase_Sudah_Vaksin,user,tanggal_update, ROUND(Persentase_Belum_Boleh_Vaksin*100,2) as blmboleh, ROUND(Persentase_Terdaftar_Vaksin*100,2) as sdhboleh, ROUND(Persentase_Belum_Terdaftar_Vaksin*100,2) as blm, ROUND(Persentase_Sudah_Vaksin*100,2) as sdh from Div_PSD.daftar_pekerja_terdaftar_vaksin_dan_sudah_di_vaksin ORDER BY tanggal_update ");

        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->Unit_Kerja;
            $row[] = $results->Total_Pekerja;
            $row[] = $results->Belum_Boleh_Vaksin;
            $row[] = $results->blmboleh;
            $row[] = $results->Terdaftar_Vaksin;
            $row[] = $results->sdhboleh;
            $row[] = $results->Belum_Terdaftar_Vaksin;
            $row[] = $results->blm;
            $row[] = $results->Sudah_Vaksin;
            $row[] = $results->sdh;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_PSD.daftar_pekerja_terdaftar_vaksin_dan_sudah_di_vaksin'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_PSD.daftar_pekerja_terdaftar_vaksin_dan_sudah_di_vaksin'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
