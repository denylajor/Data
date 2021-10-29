<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tlatmbri831 extends MY_Controller
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
        $this->header('Timeline ATM BRI 831');
        $this->load->view('CHM/list_Tlatmbri831', $data);
        $this->footer();
    }

    public function listTlatmbri831()
    {
        $list = $this->Serverside->_serverSide(
            'tbl_timeline_ho_atm_bri_831',
            ['no', 'tid', 'sn', 'db', 'kanwil', 'pengelola_vendor', 'kc_spv', 'kc_spv_kode', 'pengelola', 'pengelola_cpc', 'pengelola_kode', 'pengelola_jenis', 'lokasi', 'merk_atm', 'garansi', 'ops_days', 'ops_hour', 'ops_time','lokasi_jenis','lokasi_kategori','lokasi_kategori_group','ticket_ojk','jarkom_jen','jarkom_pro','waktu_insert','ip_addr','denom','latitude','longitude','kc_bricash','Project','Jenis','tanggal','Leader_tgl','Leader_tot','Kendaraan_tgl','Mobil_tot','Motor_tot','Sarpras_tgl','msu','Pekerja_tgl','Pekerja_tot','Pengosongan_tgl','Pengosongan','Penihilan','Status_HO_BC','Status_RPL_Perdana','Keterangan_Pending','Tgl_Perdana','keterangan','kategori','target_penyelesaian_perdana','user','tanggal_update'],
            ['tid', 'sn', 'db', 'kanwil', 'pengelola_vendor', 'kc_spv', 'kc_spv_kode', 'pengelola', 'pengelola_cpc', 'pengelola_kode', 'pengelola_jenis', 'lokasi', 'merk_atm', 'garansi', 'ops_days', 'ops_hour', 'ops_time','lokasi_jenis','lokasi_kategori','lokasi_kategori_group','ticket_ojk','jarkom_jen','jarkom_pro','waktu_insert','ip_addr','denom','latitude','longitude','kc_bricash','Project','Jenis','tanggal','Leader_tgl','Leader_tot','Kendaraan_tgl','Mobil_tot','Motor_tot','Sarpras_tgl','msu','Pekerja_tgl','Pekerja_tot','Pengosongan_tgl','Pengosongan','Penihilan','Status_HO_BC','Status_RPL_Perdana','Keterangan_Pending','Tgl_Perdana','keterangan','kategori','target_penyelesaian_perdana','user','tanggal_update'],
            ['NO' => 'ASC'],
            null,
            'data'
        );
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $results) {

            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $results->tid;
            $row[] = $results->sn;
            $row[] = $results->db;
            $row[] = $results->kanwil;
            $row[] = $results->pengelola_vendor;
            $row[] = $results->kc_spv;
            $row[] = $results->kc_spv_kode;
            $row[] = $results->pengelola;
            $row[] = $results->pengelola_cpc;
            $row[] = $results->pengelola_kode;
            $row[] = $results->pengelola_jenis;
            $row[] = $results->lokasi;
            $row[] = $results->merk_atm;
            $row[] = $results->garansi;
            $row[] = $results->ops_days;
            $row[] = $results->ops_hour;
            $row[] = $results->ops_time;
            $row[] = $results->lokasi_jenis;
            $row[] = $results->lokasi_kategori;
            $row[] = $results->lokasi_kategori_group;
            $row[] = $results->ticket_ojk;
            $row[] = $results->jarkom_jen;
            $row[] = $results->jarkom_pro;
            $row[] = $results->waktu_insert;
            $row[] = $results->ip_addr;
            $row[] = $results->denom;
            $row[] = $results->latitude;
            $row[] = $results->longitude;
            $row[] = $results->kc_bricash;
            $row[] = $results->Project;
            $row[] = $results->Jenis;
            $row[] = $results->tanggal;
            $row[] = $results->Leader_tgl;
            $row[] = $results->Leader_tot;
            $row[] = $results->Kendaraan_tgl;
            $row[] = $results->Mobil_tot;
            $row[] = $results->Motor_tot;
            $row[] = $results->Sarpras_tgl;
            $row[] = $results->msu;
            $row[] = $results->Pekerja_tgl;
            $row[] = $results->Pekerja_tot;
            $row[] = $results->Pengosongan_tgl;
            $row[] = $results->Pengosongan;
            $row[] = $results->Penihilan;
            $row[] = $results->Status_HO_BC;
            $row[] = $results->Status_RPL_Perdana;
            $row[] = $results->Keterangan_Pending;
            $row[] = $results->Tgl_Perdana;
            $row[] = $results->keterangan;
            $row[] = $results->kategori;
            $row[] = $results->target_penyelesaian_perdana;
            $row[] = $results->user;
            $row[] = $results->tanggal_update;
            $row[] = "<a href='" . base_url("Tlatmbri831/editTlatmbri831/" . $results->NO) . "' class='btn-warning    
                        btn-sm' " . getEditperm() . ">
                        <i class='fa fa-pencil-square-o'></i>
                     </a>";


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Serverside->_countAll('tbl_timeline_ho_atm_bri_831'),
            "recordsFiltered" => $this->Serverside->_serverSide('tbl_timeline_ho_atm_bri_831'),
            "data" => $data,
        );

        echo json_encode($output);
    }


    public function editTlatmbri831($NO)
    {
    	$data = array (
    		'NO_TL' => $this->General->getRow('tbl_timeline_ho_atm_bri_831',['NO' => $NO])
    	);
    	// cetak_die($data);
    	$this->header('Timeline ATM BRI 831');
        $this->load->view('Tlatmbri831/edit_Tlatmbri831', $data);
        $this->footer();
    }

    public function updateTlatmbri831($NO)
    {
    	$data = array(
    		'NO' => $NO,
    		'Pengosongan'	 => input('pengosongan'),
    		'Penihilan' 	 => input('penihilan'),
    		'Status_HO_BC'	 => input('status_bc'),
    		'Status_RPL_Perdana' => input('status_rpl'),
    		'Keterangan_Pending' => input('ket_pending'),
    		'Tgl_Perdana'		 => input('tgl_perdana'),
    		'user'	=> $this->session->userdata("user_login")['username'],
    	);
    	// cetak_die($data);
    	$update = $this->General->update_record($data, ['NO' => $NO], 'tbl_timeline_ho_atm_bri_831');
    	// lastq();
    	 if ($update) {
                LogActivity($this->db->last_query());
                $this->session->set_flashdata('success', 'Record updated Successfully..!');
                redirect('Tlatmbri831');
            } else {
                $this->session->set_flashdata('error', 'Record updated Failed..!');
                redirect('Tlatmbri831');
            }
    }
}
