<form action="<?= base_url('Layanan/import_excel'); ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    <span <?php echo $My_Controller->savePermission; ?>> </span>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Pilih Table</label>
                        <select class="form-control select2" style="width: 50%;" name="layanan" id="layanan">
                            <option value="">--Select Tabel--</option>
                            <option value="data_segel_tas">Data Segel Tas (DSP)</option>
                            <option value="gps_kendaraan">GPS Kendaraan (DSP)</option>
                            <option value="kendaraan">Kendaraan (DSP)</option>
                            <option value="tbl_mhu_dan_msu">MHU & MSU (DSP)</option>
                            <option value="rekap_analisa_kc_non_cro_cit">Rekap Analisa KC Non CRO CIT (DSP)</option>
                            <option value="rekap_analisa_kc_total">Rekap Analisa KC Total (DSP)</option>
                            <option value="rekap_kinerja_kc_cit">Rekap Kinerja KC CIT (DSP)</option>
                            <option value="rekap_kinerja_kc_cro">Rekap Kinerja KC CRO (DSP)</option>
                            <option value="rekap_persedian_log_kc">Rekap Persediaan Log KC (DSP)</option>
                            <option value="tb_vaksin">Data Vaksin (DSP)</option>
                            <!-- <option value="tb_vaksin">Data Laporan Vaksin (DSP)</option> -->

                            <option value="tbl_data_kas">Data Kas (ANEV)</option>
                            <option value="tbl_masterkas">Master Kas (ANEV)</option>
                            <option value="rekap_bank_bjb">Rekap Bank BJB (ANEV)</option>
                            <option value="rekap_cr_bank_bjb">Rekap CR Bank BJB (ANEV)</option>
                            <option value="rekap_flm_bank_bjb">Rekap FLM Bank BJB (ANEV)</option>
                            <option value="rekap_biaya_cr_flm_bank_bjb">Rekap Biaya CR FLM Bank BJB (ANEV)</option>
                            <option value="harga_kegiatan_bank_bjb">Harga Kegiatan Bank BJB (ANEV)</option>
                            <option value="rekap_analisa_problem_kc_selindo">Rekap Analisa Problem KC Selindo (ANEV)</option>
                            <option value="rekap_flm_bg_selindo">Rekap FLM BG Selindo (ANEV)</option>
                            <option value="rekap_rpl_bg_selindo">Rekap RPL BG Selindo (ANEV)</option>
                            <option value="rekon_atm_bank_bjb">Rekon ATM Bank BJB (ANEV)</option>
                            <option value="rekon_flm_bank_bjb">Rekon FLM Bank BJB (ANEV)</option>
                            <option value="data_sm">Data SM (ANEV)</option>
                            <option value="reliability_harian_bg">Reability Harian BG (ANEV)</option>
                            <option value="rekap_presentase_return_rpl_kl_selindo">Rekap Presentase Return RPL KL Selindo (ANEV)</option>

                            <option value="tbl_rekap_shortage">Rekap Shortage (RDI)</option>
                            <option value="Closed_Case_shortage_Januari_Oktober_berdasarkan_kategori_kasus">Closed Case Shortage Januari-Oktober Berdasarkan Kategori Kasus (RDI)</option>
                            <option value="Closed_Case_shortage_September_berdasarkan_kategori_kasus">Closed Case Shortage September Berdasarkan Kategori Kasus (RDI)</option>
                            <option value="Update_Kategori_kasus_Closed_Case_Frekuensi">Update Kategori Kasus Closed Case Frekuensi (RDI)</option>
                            <option value="Update_Kategori_kasus_Closed_Case_Nominal">Update Kategori Kasus Closed Case Nominal (RDI)</option>
                            <option value="Monitoring_Instruksi_Investigasi_Shortage_BG_Selindo">Monitoring Instruksi Investigasi Shortage BG Selindo (RDI)</option>
                            <option value="Monitoring_Outstanding_Shortage_BG_Selindo">Monitoring Outstanding Shortage BG Selindo (RDI)</option>
                            <option value="Grafik_Progress_dan_Pending_CaseCabang">Grafik Progress & Pending Case Cabang (RDI)</option>
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
                    <hr style="border: 1px solid #013a63;">
                    <div class="form-group">
                        <div class="col-sm" style="width: 100%;">
                            <div>
                                <a class="col-sm-" href="Gpskendaraan" style="color: #013a63;"><b style="color:orange;">|</b> GPS Kendaraaan <b style="color:orange;"> (DSP) |</b> </a>
                                <a class="col-sm-" href="Datasegeltas" style="color: #013a63;">Data Segel Tas <b style="color:orange;"> (DSP) |</b> </a>
                                <a class="col-sm-" href="Kendaraan" style="color: #013a63;">Kendaraan <b style="color:orange;"> (DSP) |</b> </a>
                                <a class="col-sm-" href="Mhumsu" style="color: #013a63;">MHU & MSU <b style="color:orange;"> (DSP) |</b> </a>
                                <a class="col-sm-" href="Rekanalisakcnoncrocit" style="color: #013a63;">Rekap Analisa KC Non CRO CIT <b style="color:orange;"> (DSP) |</b> </a>
                                <a class="col-sm-" href="Rekapanalisakctotal" style="color: #013a63;">Rekap Analisa KC Total <b style="color:orange;"> (DSP) |</b> </a>
                                <a class="col-sm-" href="Rekkinerjakccit" style="color: #013a63;">Rekap Kinerja KC CIT <b style="color:orange;"> (DSP) |</b> </a>
                                <a class="col-sm-" href="Rekkinerjakccro" style="color: #013a63;">Rekap Kinerja KC CRO <b style="color:orange;"> (DSP) |</b> </a>
                                <a class="col-sm-" href="Rekpersedianlogkc" style="color: #013a63;">Rekap Persediaan Log KC <b style="color:orange;"> (DSP) |</b> </a>
                                <a class="col-sm-" href="DataVaksin" style="color: #013a63;">Data Vaksin <b style="color:orange;"> (DSP) |</b> </a>

                                <br> <hr style="border: 1px solid #013a63;">
                                
                                <a class="col-sm-" href="Datakas" style="color: #013a63;">Data Kas <b style="color:orange;"> (ANEV) |</b> </a>
                                <a class="col-sm-" href="Masterkas" style="color: #013a63;">Master Kas <b style="color:orange;"> (ANEV) |</b> </a>
                                <a class="col-sm-" href="Rekapbankbjb" style="color: #013a63;">Rekap Bank BJB <b style="color:orange;"> (ANEV) |</b> </a>
                                <a class="col-sm-" href="Rekapcrbankbjb" style="color: #013a63;">Rekap CR Bank BJB <b style="color:orange;"> (ANEV) |</b> </a>
                                <a class="col-sm-" href="Rekapflmbankbjb" style="color: #013a63;">Rekap FLM Bank BJB <b style="color:orange;"> (ANEV) |</b> </a>
                                <a class="col-sm-" href="Rekapbiayacrflmbjb" style="color: #013a63;">Rekap Biaya CR FLM Bank BJB <b style="color:orange;"> (ANEV) |</b> </a>
                                <a class="col-sm-" href="Hargakegiatanbankbjb" style="color: #013a63;">Harga Kegiatan Bank BJB <b style="color:orange;"> (ANEV) |</b> </a>
                                <a class="col-sm-" href="Rekanalisaproblemkcselindo" style="color: #013a63;">Rekap Analisa Problem KC Selindo <b style="color:orange;"> (ANEV) |</b> </a>
                                <a class="col-sm-" href="Rekflmbgselindo" style="color: #013a63;">Rekap FLM BG Selindo <b style="color:orange;"> (ANEV) |</b> </a>
                                <a class="col-sm-" href="Rekrplbgselindo" style="color: #013a63;">Rekap RPL BG Selindo <b style="color:orange;"> (ANEV) |</b> </a>
                                <a class="col-sm-" href="Rekatmbankbjb" style="color: #013a63;">Rekon ATM Bank BJB <b style="color:orange;"> (ANEV) |</b> </a>
                                <a class="col-sm-" href="Rekflmbankbjb" style="color: #013a63;">Rekon FLM Bank BJB <b style="color:orange;"> (ANEV) |</b> </a>
                                <a class="col-sm-" href="Datasm" style="color: #013a63;">Data SM <b style="color:orange;"> (ANEV) |</b> </a>
                                <a class="col-sm-" href="ReliabilityHarianBG" style="color: #013a63;">Reliability Harian BG <b style="color:orange;"> (ANEV) |</b> </a>
                                <a class="col-sm-" href="RekapPresentaseReturnRPL" style="color: #013a63;">Rekap Presentase Return RPL KL Selindo <b style="color:orange;"> (ANEV) |</b> </a>

                                <br> <hr style="border: 1px solid #013a63;">

                                <a class="col-sm-" href="Rekapshortage" style="color: #013a63;">Rekap Shortage <b style="color:orange;"> (RDI) |</b> </a>
                                <a class="col-sm-" href="ClosedCaseShortageJanuariOktober" style="color: #013a63;">Closed Case Shortage Januari-Oktober Berdasarkan Kategori Kasus <b style="color:orange;"> (RDI) |</b> </a>
                                <a class="col-sm-" href="ClosedCaseShortageSeptember" style="color: #013a63;">Closed Case Shortage September Berdasarkan Kategori Kasus <b style="color:orange;"> (RDI) |</b> </a>
                                <a class="col-sm-" href="UpdateKategoriKasusClosedCaseFrekuensi" style="color: #013a63;">Update Kategori Kasus Closed Case Frekuensi <b style="color:orange;"> (RDI) |</b> </a>
                                <a class="col-sm-" href="UpdateKategoriKasusClosedCaseNominal" style="color: #013a63;">Update Kategori Kasus Closed Case Nominal <b style="color:orange;"> (RDI) |</b> </a>
                                <a class="col-sm-" href="MonitoringInstruksiInvestigasiShortageBGSelindo" style="color: #013a63;">Monitoring Instruksi Investigasi Shortage BG Selindo <b style="color:orange;"> (RDI) |</b> </a>
                                <a class="col-sm-" href="MonitoringOutstandingShortageBGSelindo" style="color: #013a63;">Monitoring Outstanding Shortage BG Selindo <b style="color:orange;"> (RDI) |</b> </a>
                                <a class="col-sm-" href="GrafikProgressdanPendingCaseCabang" style="color: #013a63;">Grafik Progress & Pending Case Cabang <b style="color:orange;"> (RDI) |</b> </a>
                            
                                <br> <hr style="border: 1px solid #013a63;">
                            </div>
                        </div>
                    </div>
                </header>
                <div class="panel-body">
                    <table id="tableBarang" class="table table-bordered table-striped" style="width: 100%;">
                        <thead style="background-color: #012a4a; color: white;">
                            <tr role="row">
                                <th>No</th>
                                <th>Wilayah</th>
                                <th>Kantor Cabang</th>
                                <th>Total ATM</th>
                                <th>Kegiatan CR</th>
                                <th>Kegiatan FLm</th>
                                <th>Total Biaya</th>
                                <!-- <th>Total RPL</th> -->
                                <th>User</th>
                                <th>Tanggal Update</th>
                            </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all" style="background-color: rgba(1, 42, 74, 0.3);"></tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</form>

<script>
    const urlHargakegiatanbankbjb = '<?= site_url("Hargakegiatanbankbjb/") ?>';
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
                    url: urlHargakegiatanbankbjb + "listHargakegiatanbankbjb",
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