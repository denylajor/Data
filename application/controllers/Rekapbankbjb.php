<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rekapbankbjb extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->layanan = $this->load->database('db2', TRUE);
        $this->load->library(array('excel', 'session'));
        if (!$this->session->userdata("user_login")) {
            redirect('Auth');
        }
    }

    public function index()
    {

        $data = array(
            // 'inserttable' => $this->General->fetch_CoustomQuery("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='db_layanan'"),
        );

        // cekPergroup();
        $this->header('Rekap Bank BJB');
        $this->load->view('Layanan/list_rekapbankbjb', $data);
        $this->footer();
    }

    public function listRekapbankbjb()
    {
        // $list = $this->General->fetch_CoustomQuery("SELECT * FROM db_layanan.gps_kendaraan ORDER BY gps_kendaraan.TAHUN ASC");
        // cetak_die($list);
        $list = $this->Serverside->_serverSide(
            'Div_Layanan.rekap_bank_bjb',
            ['no', 'cabang', 'id_atm', 'lokasi_atm', 'tanggal_efektif', 'jam_pengisian', 'denom', 'nominal_pengisian', 'vendor', 'user', 'tanggal_update', ],
            ['cabang', 'id_atm', 'lokasi_atm', 'tanggal_efektif', 'jam_pengisian', 'denom', 'nominal_pengisian', 'vendor', 'user', 'tanggal_update', ],
            ['No' => 'ASC '],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->cabang;
            $row[] = $results->id_atm;
            $row[] = $results->lokasi_atm;
            $row[] = $results->tanggal_efektif;
            $row[] = $results->jam_pengisian;
            $row[] = $results->denom;
            $row[] = rupiah($results->nominal_pengisian);
            $row[] = $results->vendor;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('Div_Layanan.rekap_bank_bjb'),
            "recordsFiltered" => $this->Serverside->_serverSide('Div_Layanan.rekap_bank_bjb'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
