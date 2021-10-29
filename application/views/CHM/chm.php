<form action="<?= base_url('CHM/import_excel'); ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel" style="background-color: #012a4a; color:#FFF;">
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
                                <a class="col-sm-" href="DataAset" style="color: white;">Data Aset | </a>
                                <a class="col-sm-" href="CM" style="color: white;">CM | </a>
                                <a class="col-sm-" href="PM" style="color: white;">PM | </a>
                                <a class="col-sm-" href="Detailpart" style="color: white;">Detail Part | </a>
                                <a class="col-sm-" href="Offinflm" style="color: white;">Off In FLM | </a>
                                <!-- <a class="col-sm-" href="Offoutflm">Off Out FlM | </a> -->
                                <a class="col-sm-" href="Opname" style="color: white;">Opname | </a>
                                <a class="col-sm-" href="Opnamepart" style="color: white;">Opname Part | </a>
                                <a class="col-sm-" href="Reabilityperform" style="color: white;">Reability Perform | </a>
                                <a class="col-sm-" href="ProblemReportCC" style="color: white;">Problem Report (CC)| </a>
                                <a class="col-sm-" href="ReportPortalBRIMACC" style="color: white;">Report Portal BRI MA (CC) | </a>
                                <a class="col-sm-" href="ReportSSBHybridCC" style="color: white;">Report SSB & Hybrid (CC) | </a>
                                <br>
                                <hr>
                                <a class="col-sm-" href="TechnicalReportCC" style="color: white;">Technical Report (CC) | </a>
                                <a class="col-sm-" href="PengadaanDanDistribusiPO" style="color: white;">Pengadaan & Distribusi PO | </a>
                                <a class="col-sm-" href="KendaraanLogistik" style="color: white;">Kendaraan Logistik |</a>
                                <a class="col-sm-" href="Logistikpeng" style="color: white;">Logistik Pengiriman |</a>
                                <a class="col-sm-" href="Ssbpm" style="color: white;">SSB PM |</a>
                                <a class="col-sm-" href="Crmpm" style="color: white;">CRM PM |</a>
                                <a class="col-sm-" href="Hybridpm" style="color: white;">Hybrid PM |</a>
                                <!-- <a class="col-sm-" href="Bulananflm">Bulanan FLM CRM 700 |</a> -->
                                <a class="col-sm-" href="Ssbhybrid" style="color: white;">SSB & Hybrid |</a>
                                <a class="col-sm-" href="Vaksin" style="color: white;">Vaksin |</a>
                                <a class="col-sm-" href="Pmedcmandiri" style="color: white;">PM EDC MANDIRI |</a>
                                <br> <hr>
                                <a class="col-sm-" href="Flm700" style="color: white;">FLM 700 |</a>
                                <a class="col-sm-" href="Premises700" style="color: white;">Premises 700 |</a>
                                <a class="col-sm-" href="PertumbuhanATM" style="color: white;">Pertumbuhan ATM |</a>
                                <a class="col-sm-" href="Tlatmbrikolab" style="color: white;">Timeline HO ATM BRI Kolaborasi |</a>
                                <a class="col-sm-" href="Tlatmbri562" style="color: white;">Timeline HO ATM BRI 562 |</a>
                                <a class="col-sm-" href="Tlatmbri831" style="color: white;">Timeline HO ATM BRI 831 |</a>
                                <br> <hr>
                                <a class="col-sm-" href="Reabcroatmbri" style="color: white;">Pencapaian Reability CRO ATM BRI (Harian) |</a>
                                <a class="col-sm-" href="Reabcroatmbribul" style="color: white;">Pencapaian Reability CRO ATM BRI (Bulanan) |</a>
                                <a class="col-sm-" href="Propenreabbrihar" style="color: white;">Proyeksi Pencapaian Reability CRO ATM BRI (Harian) |</a>
                                <br><hr>
                                <a class="col-sm-" href="Propenreabbribul" style="color: white;">Proyeksi Pencapaian Reability CRO ATM BRI (Bulanan) |</a>
                                <a class="col-sm-" href="Perrplbankbjb" style="color: white;">Peformance RPL ATM Bank BJB (Harian) |</a>
                                <a class="col-sm-" href="Perrplbankbjbbul" style="color: white;">Peformance RPL ATM Bank BJB (Bulanan) |</a>
                                <br> <hr>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="panel-body">
                    <table id="tableBarang" class="table table-bordered" style="width: 100%;">
                        <thead>

                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all"></tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(function() {
        $('.select2').select2();
    })
</script>