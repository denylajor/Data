<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sdmkaryawancit extends MY_Controller
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
        $this->header('SDM Karyawan CIT');
        $this->load->view('PSD/list_sdmkaryawancit', $data);
        $this->footer();
    }

    public function listSdmkaryawancit()
    {
        $list = $this->Serverside->_serverSide(
            'Div_PSD.rekap_SDM_karyawan_cit',
            ['no', 'Kantor_Layanan', 'KKL', 'Verifikatur', 'Wakil_KKL', 'SPV', 'Assup_Rutang','Assup_CIT','Accounting','Rutang','Marketing','Admin','CPC','Custody','Driver','Teknisi_Kaset','Teknisi_SLM','Pramubakti','Messenger','Training','Jumlah_Pekerja','Target','Periode','user','tanggal_update'],
            ['Kantor_Layanan', 'KKL', 'Verifikatur', 'Wakil_KKL', 'SPV', 'Assup_Rutang','Assup_CIT','Accounting','Rutang','Marketing','Admin','CPC','Custody','Driver','Teknisi_Kaset','Teknisi_SLM','Pramubakti','Messenger','Training','Jumlah_Pekerja','Target','Periode','user','tanggal_update'],
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
            $row[] = $results->KKL;
            $row[] = $results->Verifikatur;
            $row[] = $results->Wakil_KKL;
            $row[] = $results->SPV;
            $row[] = $results->Assup_Rutang;
            $row[] = $results->Assup_CIT;
            $row[] = $results->Accounting;
            $row[] = $results->Rutang;
            $row[] = $results->Marketing;
            $row[] = $results->Admin;
            $row[] = $results->CPC;
            $row[] = $results->Custody;
            $row[] = $results->Driver;
            $row[] = $results->Teknisi_Kaset;
            $row[] = $results->Teknisi_SLM;
            $row[] = $results->Pramubakti;
            $row[] = $results->Messenger;
            $row[] = $results->Training;
            $row[] = $results->Jumlah_Pekerja;
            $row[] = $results->Target;
            $row[] = $results->Periode;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_PSD.rekap_SDM_karyawan_cit'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_PSD.rekap_SDM_karyawan_cit'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
