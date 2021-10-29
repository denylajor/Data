<form action="<?= base_url('CHM/import_excel'); ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    <span <?php echo $My_Controller->savePermission; ?>> </span>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Pilih Table</label>
                        <select class="form-control select2" style="width: 50%;" name="chm" id="chm">
                            <option value="">--Select Tabel--</option>
                            <option value="tbl_data_aset">Data Aset</option>
                            <option value="tbl_cm">CM</option>
                            <option value="tbl_pm">PM</option>
                            <option value="tbl_detailpart">Detail Part</option>
                            <option value="tbl_off_in_flm">Off In Flm</option>
                            <option value="tbl_opname">Opname</option>
                            <option value="tbl_opnamepart">Opname Part</option>
                            <option value="tbl_reability">Reability Perform</option>
                            <option value="tbl_problem_report_cc">Problem Report (CC)</option>
                            <option value="tbl_report_portal_BRI_MA_cc">Report Portal BRI MA (CC)</option>
                            <option value="tbl_report_ssb_hybrid_cc">Report SSB & Hybrid (CC)</option>
                            <option value="tbl_technical_report_cc">Technical Report (CC)</option>
                            <option value="tbl_pengadaan_dan_distribusi_PO">Pengadaan & Distribusi </option>
                            <option value="tbl_kendaraan_logistik">Kendaraan Logistik</option>
                            <option value="tbl_ssb_pm_new">SSB PM New</option>
                            <option value="tbl_crm_pm_new">CRM PM New</option>
                            <option value="tbl_hybrid_pm_new">Hybrid PM New</option>
                            <!-- <option value="tbl_bulanan_flm_700_crm">Bulanan FLM CRM 700</option> -->
                            <option value="tbl_ssb_hybrid_new">SSB & Hybrid New</option>
                            <option value="tbl_pm_edc_mandiri_fix">PM EDC Mandiri</option>
                            <option value="tbl_vaksin">Vaksin</option>
                            <option value="tbl_pengiriman_logistik">Loigistik Pengiriman</option>
                            <option value="tbl_bulanan_flm_700_crm">FLM 700</option>
                            <option value="tbl_bulanan_premises_700_crm">Premises 700</option>
                            <option value="tbl_pertumbuhan_atm">Pertumbuhan ATM</option>
                            <!-- <option value="tbl_perfomance_rpl_atm_bank_bjb">Peformance RPL ATM Bank BJB</option> -->
                            <option value="tbl_timeline_ho_atm_bri_kolaborasi">Timeline HO ATM BRI Kolaborasi</option>
                            <option value="tbl_timeline_ho_atm_bri_562">Timeline HO ATM BRI 562</option>
                            <option value="tbl_timeline_ho_atm_bri_831">Timeline HO ATM BRI 831</option>
                            <option value="tbl_pencapaian_reliability_cro_atm_bri_periode_harian">Pencapaian Reability CRO ATM BRI (Harian)</option>
                            <option value="tbl_pencapaian_reliability_cro_atm_bri_periode_bulanan">Pencapaian Reability CRO ATM BRI (Bulanan)</option>
                            <option value="tbl_perfomance_rpl_atm_bank_bjb">Peformance RPL ATM Bank BJB (Harian)</option>
                            <option value="tbl_perfomance_rpl_atm_bank_bjb_periode_bulanan">Peformance RPL ATM Bank BJB (Bulanan)</option>
                            <option value="tbl_proyeksi_pencapaian_reliability_cro_atm_bri_periode_harian">Proyeksi Pencapaian Reability CRO ATM BRI (Harian)
                            <option value="tbl_proyeksi_pencapaian_reliability_cro_atm_bri_periode_bulanan">Proyeksi Pencapaian Reability CRO ATM BRI (Bulanan)
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Pilih File Excel</label>
                        <input type="file" name="fileExcel">
                    </div>
                    <div class="row text-center" style="margin-bottom: 20px;">
                    <button type="submit" id='addBarang' class="btn btn-info" >
                        Import <i class="fa fa-plus"></i>
                    </button>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="col-sm " style="width: 100%;">
                            <div>
                                <a class="col-sm-" href="DataAset">Data Aset | </a>
                                <a class="col-sm-" href="CM">CM | </a>
                                <a class="col-sm-" href="PM">PM | </a>
                                <a class="col-sm-" href="Detailpart">Detail Part | </a>
                                <a class="col-sm-" href="Offinflm">Off In FLM | </a>
                                <!-- <a class="col-sm-" href="Offoutflm">Off Out FlM | </a> -->
                                <a class="col-sm-" href="Opname">Opname | </a>
                                <a class="col-sm-" href="Opnamepart">Opname Part | </a>
                                <a class="col-sm-" href="Reabilityperform">Reability Perform | </a>
                                <a class="col-sm-" href="ProblemReportCC">Problem Report (CC)| </a>
                                <a class="col-sm-" href="ReportPortalBRIMACC">Report Portal BRI MA (CC) | </a>
                                <a class="col-sm-" href="ReportSSBHybridCC">Report SSB & Hybrid (CC) | </a>
                                <br>
                                <hr>
                                <a class="col-sm-" href="TechnicalReportCC">Technical Report (CC) | </a>
                                <a class="col-sm-" href="PengadaanDanDistribusiPO">Pengadaan & Distribusi PO | </a>
                                <a class="col-sm-" href="KendaraanLogistik">Kendaraan Logistik |</a>
                                <a class="col-sm-" href="Logistikpeng">Logistik Pengiriman |</a>
                                <a class="col-sm-" href="Ssbpm">SSB PM |</a>
                                <a class="col-sm-" href="Crmpm">CRM PM |</a>
                                <a class="col-sm-" href="Hybridpm">Hybrid PM |</a>
                                <!-- <a class="col-sm-" href="Bulananflm">Bulanan FLM CRM 700 |</a> -->
                                <a class="col-sm-" href="Ssbhybrid">SSB & Hybrid |</a>
                                <a class="col-sm-" href="Vaksin">Vaksin |</a>
                                <a class="col-sm-" href="Pmedcmandiri">PM EDC MANDIRI |</a>
                                <br> <hr>
                                <a class="col-sm-" href="Flm700">FLM 700 |</a>
                                <a class="col-sm-" href="Premises700">Premises 700 |</a>
                                <a class="col-sm-" href="PertumbuhanATM">Pertumbuhan ATM |</a>
                                <a class="col-sm-" href="Tlatmbrikolab">Timeline HO ATM BRI Kolaborasi |</a>
                                <a class="col-sm-" href="Tlatmbri562">Timeline HO ATM BRI 562 |</a>
                                <a class="col-sm-" href="Tlatmbri831">Timeline HO ATM BRI 831 |</a>
                                <br> <hr>
                                <a class="col-sm-" href="Reabcroatmbri">Pencapaian Reability CRO ATM BRI (Harian) |</a>
                                <a class="col-sm-" href="Reabcroatmbribul">Pencapaian Reability CRO ATM BRI (Bulanan) |</a>
                                <a class="col-sm-" href="Propenreabbrihar">Proyeksi Pencapaian Reability CRO ATM BRI (Harian) |</a>
                                <a class="col-sm-" href="Propenreabbribul">Proyeksi Pencapaian Reability CRO ATM BRI (Bulanan) |</a>
                                <a class="col-sm-" href="Perrplbankbjb">Peformance RPL ATM Bank BJB (Harian) |</a>
                                <a class="col-sm-" href="Perrplbankbjbbul">Peformance RPL ATM Bank BJB (Bulanan) |</a>
                                <br> <hr>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="panel-body">
                    <table id="tableBarang" class="table table-bordered table-striped" style="width: 100%;">
                        <thead style="background-color: #282828; color: white;">
                            <tr role="row">
                                <th>No</th>
                                <th>TID</th>
                                <th>SN</th>
                                <th>DB</th>
                                <th>Kanwil</th>
                                <th>Pengelola Vendor</th>
                                <th>KV SPV</th>
                                <th>KV SPV Kode</th>
                                <th>Pengelola</th>
                                <th>Pengelola CPC</th>
                                <th>Pengelola Kode</th>
                                <th>Pengelola Jenis</th>
                                <th>Lokasi</th>
                                <th>Merk Atm</th>
                                <th>Garansi</th>
                                <th>Ops Days</th>
                                <th>Ops Hour</th>
                                <th>Ops Time</th>
                                <th>Lokasi Jenis</th>
                                <th>Lokasi Kategori</th>
                                <th>Lokasi Kategori Group</th>
                                <th>Ticket Ojk</th>
                                <th>Jarkom Jen</th>
                                <th>Jarkom Pro</th>
                                <th>Waktu Insert</th>
                                <th>Ip address</th>
                                <th>Denom</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>KC BRICash</th>
                                <th>Project</th>
                                <th>Jenis</th>
                                <th>Tanggal</th>
                                <th>Leader Tgl</th>
                                <th>Leader Total</th>
                                <th>Kendaraan Tgl</th>
                                <th>Mobil Total</th>
                                <th>Motor Total</th>
                                <th>Sarpras Tgl</th>
                                <th>MSU</th>
                                <th>Pekerja Tgl</th>
                                <th>Pekerja Total</th>
                                <th>Pengosongan Tgl</th>
                                <th>Pengosongan</th>
                                <th>Penihilan</th>
                                <th>Status HO BC</th>
                                <th>Status RPL Perdana</th>
                                <th>Keterangan Pending</th>
                                <th>Tgl Perdana</th>
                                <th>User</th>
                                <th>Tanggal Update</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all"></tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</form>

<script>
    const urlTlatmbrikolab = '<?= site_url("Tlatmbrikolab/") ?>';
    let table;

     $(function() {
        $('.select2').select2();
    })

    $(function() {
        if (!$.fn.DataTable.isDataTable('#tableBarang')) {
            table = $('#tableBarang').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                order: [],
                scrollX: true,
                ajax: {
                    url: urlTlatmbrikolab + "listTlatmbrikolab",
                    type: "POST"
                },
                columnDefs: [{
                    targets: [0, -1],
                    orderable: false,
                }, ],
            });
        }

    });
</script>