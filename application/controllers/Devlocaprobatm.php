<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Devlocaprobatm extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('db2', TRUE);
        $this->load->library(array('excel', 'session'));
        if (!$this->session->userdata("user_login")) {
            redirect('Auth');
        }
    }

    public function index()
    {

        $data = array(
            'inserttable' => $this->General->fetch_CoustomQuery("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='db_layanan'"),
        );

        // cekPergroup();
        $this->header('Device Location Problem Atm');
        $this->load->view('BRI/list_devlocaprobatm', $data);
        $this->footer();
    }

    public function listDevlocaprobatm()
    {
        // $list = $this->General->fetch_CoustomQuery("SELECT * FROM db_layanan.gps_kendaraan ORDER BY gps_kendaraan.TAHUN ASC");
        // cetak_die($list);
        $list = $this->Serverside->_serverSide(
            'db_layanan.dev_loc_problem_atm',
            ['no', 'TID', 'SN', 'DB', 'Kanwil', 'Region', 'Kc_supervisi', 'Branch', 'Pengelola', 'Pengelola_kode', 'Lokasi', 'Site', 'Mesin', 'Kategori', 'Garansi', 'Hari_OPS', 'Jam_OPS', 'Waktu_OPS', 'Status', 'Problem', 'RTL_Ticket', 'Down_Time_Hari', 'Down_Time_Jam', 'Last_Tunai', 'Est_Tgl_Problem', 'Down_Tunai_Hari', 'Down_Tunai_Jam', 'Denom', 'Lembar', 'CST1', 'CST2', 'CST3', 'CST4', 'CST4', 'LMB2', 'LMB3', 'LMB4', 'SPV_ST', 'RECEIPT_ST', 'BRIZZI_SUPPORT', 'Pagu_Existing', 'Sisa_Saldo', 'Capture_RPL', 'Last_RPL', 'Jml_Lembar', 'Jml_RPL', 'Tipe_RPL'],
            ['CABANG', 'KODE', 'NO_POLISI', 'JENIS_KENDARAAN', 'UKER', 'TAHUN', 'NO_GSM', 'IMEI', 'STATUS_KENDARAAN', 'PEMBAYARAN_GSM', 'Keterangan'],
            ['TAHUN' => 'ASC '],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->CABANG;
            $row[] = $results->KODE;
            $row[] = $results->NO_POLISI;
            $row[] = $results->JENIS_KENDARAAN;
            $row[] = $results->UKER;
            $row[] = $results->TAHUN;
            $row[] = $results->NO_GSM;
            $row[] = $results->IMEI;
            $row[] = $results->STATUS_KENDARAAN;
            $row[] = $results->PEMBAYARAN_GSM;
            $row[] = $results->Keterangan;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('db_layanan.dev_loc_problem_atm'),
            "recordsFiltered" => $this->Serverside->_serverSide('db_layanan.dev_loc_problem_atm'),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
