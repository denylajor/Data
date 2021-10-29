<form action="<?= base_url('Layanan/import_excel'); ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel" style="color: #012a4a;">
                <header class="panel-heading">
                    <span <?php echo $My_Controller->savePermission; ?>> </span>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Pilih Table</label>
                        <select class="form-control select2" style="width: 50%;" name="layanan" id="layanan">
                            <option value="">--Select Tabel--</option>
                            <option value="data_segel_tas">Data Segel Tas (DSP)</option>
                            <option value="gps_kendaraan">GPS Kendaraan (DSP)</option>
                            <option value="kendaraan">Kendaraan (DSP)</option>
                            <option value="tbl_data_kas">Data Kas (ANEV)</option>
                            <option value="tbl_masterkas">Master Kas</option>
                            <option value="tbl_mhu_dan_msu">MHU & MSU (DSP)</option>
                            <option value="tbl_rekap_shortage">Rekap Shortage (RDI)</option>
                            <option value="rekap_bank_bjb">Rekap Bank BJB (ANEV)</option>
                            <option value="rekap_cr_bank_bjb">Rekap CR Bank BJB (ANEV)</option>
                            <option value="rekap_flm_bank_bjb">Rekap FLM Bank BJB (ANEV)</option>
                            <option value="rekap_biaya_cr_flm_bank_bjb">Rekap Biaya CR FLM Bank BJB (ANEV)</option>
                            <option value="harga_kegiatan_bank_bjb">Harga Kegiatan Bank BJB (ANEV)</option>
                            <option value="rekap_analisa_kc_non_cro_cit">Rekap Analisa KC Non CRO CIT (DSP)</option>
                            <option value="rekap_analisa_kc_total">Rekap Analisa KC Total (DSP)</option>
                            <option value="rekap_analisa_problem_kc_selindo">Rekap Analisa Problem KC Selindo (ANEV)</option>
                            <option value="rekap_flm_bg_selindo">Rekap FLM BG Selindo (ANEV)</option>
                            <option value="rekap_kinerja_kc_cit">Rekap Kinerja KC CIT (DSP)</option>
                            <option value="rekap_kinerja_kc_cro">Rekap Kinerja KC CRO (DSP)</option>
                            <option value="rekap_persedian_log_kc">Rekap Persediaan Log KC (DSP)</option>
                            <option value="rekap_rpl_bg_selindo">Rekap RPL BG Selindo (ANEV)</option>
                            <option value="rekon_atm_bank_bjb">Rekon ATM Bank BJB (ANEV)</option>
                            <option value="rekon_flm_bank_bjb">Rekon FLM Bank BJB (ANEV)</option>
                            <option value="data_sm">Data SM (Bagian ANEV)</option>
                            <option value="reliability_harian_bg">Reability Harian BG (Bagian ANEV)</option>
                            <option value="rekap_presentase_return_rpl_kl_selindo">Rekap Presentase Return RPL KL Selindo (ANEV)</option>
                            <option value="data_vaksin_div_layanan_jadwal_vaksin">Data Vaksin-Jadwal Vaksin (DSP)</option>
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
                        <div class="col-sm" style="width: 100%;">
                            <div>
                                <a class="col-sm-" href="Gpskendaraan" >| GPS Kendaraaan (DSP) | </a>
                                <a class="col-sm-" href="Datasegeltas" >Data Segel Tas (DSP) | </a>
                                <a class="col-sm-" href="Kendaraan" >Kendaraan (DSP) | </a>
                                <a class="col-sm-" href="Datakas" >Data Kas (ANEV) | </a>
                                <a class="col-sm-" href="Masterkas" >Master Kas | </a>
                                <a class="col-sm-" href="Mhumsu" >MHU & MSU (DSP) | </a>
                                <a class="col-sm-" href="Rekapshortage" >Rekap Shortage (RDI) | </a>
                                <a class="col-sm-" href="Rekapbankbjb" >Rekap Bank BJB (ANEV) | </a>
                                <a class="col-sm-" href="Rekapcrbankbjb" >Rekap CR Bank BJB (ANEV) | </a>
                                <br> <hr>
                                <a class="col-sm-" href="Rekapflmbankbjb" >Rekap FLM Bank BJB (ANEV) | </a>
                                <a class="col-sm-" href="Rekapbiayacrflmbjb" >Rekap Biaya CR FLM Bank BJB (ANEV) | </a>
                                <a class="col-sm-" href="Hargakegiatanbankbjb" >Harga Kegiatan Bank BJB (ANEV) | </a>
                                <a class="col-sm-" href="Rekanalisakcnoncrocit" >Rekap Analisa KC Non CRO CIT (DSP) | </a>
                                <a class="col-sm-" href="Rekapanalisakctotal" >Rekap Analisa KC Total (DSP) | </a>
                                <a class="col-sm-" href="Rekanalisaproblemkcselindo" >Rekap Analisa Problem KC Selindo (ANEV) | </a>
                                <br> <hr>
                                <a class="col-sm-" href="Rekflmbgselindo" >Rekap FLM BG Selindo (ANEV) | </a>
                                <a class="col-sm-" href="Rekkinerjakccit" >Rekap Kinerja KC CIT (DSP) | </a>
                                <a class="col-sm-" href="Rekkinerjakccro" >Rekap Kinerja KC CRO (DSP) | </a>
                                <a class="col-sm-" href="Rekpersedianlogkc" >Rekap Persediaan Log KC (DSP) | </a>
                                <a class="col-sm-" href="Rekrplbgselindo" >Rekap RPL BG Selindo (ANEV) | </a>
                                <a class="col-sm-" href="Rekatmbankbjb" >Rekon ATM Bank BJB (ANEV) | </a>
                                <a class="col-sm-" href="Rekflmbankbjb" >Rekon FLM Bank BJB (ANEV) | </a>
                                <br> <hr>
                                <a class="col-sm-" href="Datasm" >Data SM (ANEV) | </a>
                                <a class="col-sm-" href="ReliabilityHarianBG" >Reliability Harian BG (ANEV) | </a>
                                <a class="col-sm-" href="RekapPresentaseReturnRPL" >Rekap Presentase Return RPL KL Selindo (Bagian ANEV) | </a>
                                <a class="col-sm-" href="DataVaksinJadwalVaksin" >Data Vaksin Jadwal Vaksin (DSP) | </a>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="panel-body">
                    <table id="tableBarang" class="table table-bordered" style="width: 100%;">
                        <thead>
                            <tr role="row">
                                <th>No</th>
                                <th>Bagian</th>
                                <th>ID Personal</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Unit Kerja Divisi</th>
                                <th>Unit Kerja Bagian</th>
                                <th>Tanggal Vaksin I</th>
                                <th>Tanggal Vaksin II</th>
                                <th>Lokasi Vaksin</th>
                                <th>Keterangan</th>
                                <th>User</th>
                                <th>Tanggal Update</th>
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
    const urlDataVaksinJadwalVaksin = '<?= site_url("DataVaksinJadwalVaksin/") ?>';
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
                    url: urlDataVaksinJadwalVaksin + "listDataVaksinJadwalVaksin",
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