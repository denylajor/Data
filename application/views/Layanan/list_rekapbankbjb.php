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
                            <option value="data_segel_tas">Data Segel Tas</option>
                            <option value="gps_kendaraan">GPS Kendaraan</option>
                            <option value="kendaraan">Kendaraan</option>
                            <option value="tbl_data_kas">Data Kas</option>
                            <option value="tbl_masterkas">Master Kas</option>
                            <option value="tbl_mhu_dan_msu">MHU & MSU</option>
                            <option value="tbl_rekap_shortage">Rekap Shortage</option>
                            <option value="rekap_bank_bjb">Rekap Bank BJB</option>
                            <option value="rekap_cr_bank_bjb">Rekap CR Bank BJB</option>
                            <option value="rekap_flm_bank_bjb">Rekap FLM Bank BJB</option>
                            <option value="rekap_biaya_cr_flm_bank_bjb">Rekap Biaya CR FLM Bank BJB</option>
                            <option value="harga_kegiatan_bank_bjb">Harga Kegiatan Bank BJB</option>
                            <option value="rekap_analisa_kc_non_cro_cit">Rekap Analisa KC Non CRO CIT</option>
                            <option value="rekap_analisa_kc_total">Rekap Analisa KC Total</option>
                            <option value="rekap_analisa_problem_kc_selindo">Rekap Analisa Problem KC Selindo</option>
                            <option value="rekap_flm_bg_selindo">Rekap FLM BG Selindo</option>
                            <option value="rekap_kinerja_kc_cit">Rekap Kinerja KC CIT</option>
                            <option value="rekap_kinerja_kc_cro">Rekap Kinerja KC CRO</option>
                            <option value="rekap_persedian_log_kc">Rekap Persediaan Log KC</option>
                            <option value="rekap_rpl_bg_selindo">Rekap RPL BG Selindo</option>
                            <option value="rekon_atm_bank_bjb">Rekon ATM Bank BJB</option>
                            <option value="rekon_flm_bank_bjb">Rekon FLM Bank BJB</option>
                            <option value="data_sm">Data SM</option>
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
                                <a class="col-sm-" href="Gpskendaraan">| GPS Kendaraaan | </a>
                                <a class="col-sm-" href="Datasegeltas">Data Segel Tas | </a>
                                <a class="col-sm-" href="Kendaraan">Kendaraan | </a>
                                <a class="col-sm-" href="Datakas">Data Kas | </a>
                                <a class="col-sm-" href="Masterkas">Master Kas | </a>
                                <a class="col-sm-" href="Mhumsu">MHU & MSU | </a>
                                <a class="col-sm-" href="Rekapshortage">Rekap Shortage | </a>
                                <a class="col-sm-" href="Rekapbankbjb">Rekap Bank BJB | </a>
                                <a class="col-sm-" href="Rekapcrbankbjb">Rekap CR Bank BJB | </a>
                                <a class="col-sm-" href="Rekapflmbankbjb">Rekap FLM Bank BJB | </a>
                                <br> <hr>
                                <a class="col-sm-" href="Rekapbiayacrflmbjb">Rekap Biaya CR FLM Bank BJB | </a>
                                <a class="col-sm-" href="Hargakegiatanbankbjb">Harga Kegiatan Bank BJB | </a>
                                <a class="col-sm-" href="Rekanalisakcnoncrocit">Rekap Analisa KC Non CRO CIT | </a>
                                <a class="col-sm-" href="Rekapanalisakctotal">Rekap Analisa KC Total | </a>
                                <a class="col-sm-" href="Rekanalisaproblemkcselindo">Rekap Analisa Problem KC Selindo | </a>
                                <br> <hr>
                                <a class="col-sm-" href="Rekflmbgselindo">Rekap FLM BG Selindo | </a>
                                <a class="col-sm-" href="Rekkinerjakccit">Rekap Kinerja KC CIT | </a>
                                <a class="col-sm-" href="Rekkinerjakccro">Rekap Kinerja KC CRO | </a>
                                <a class="col-sm-" href="Rekpersedianlogkc">Rekap Persediaan Log KC | </a>
                                <a class="col-sm-" href="Rekrplbgselindo">Rekap RPL BG Selindo | </a>
                                <a class="col-sm-" href="Rekatmbankbjb">Rekon ATM Bank BJB | </a>
                                <a class="col-sm-" href="Rekflmbankbjb">Rekon FLM Bank BJB | </a>
                                <br> <hr>
                                <a class="col-sm-" href="Datasm">Data SM | </a>
                            </div>
                        </div>
                    </div>
                </header>
               <div class="panel-body">
                    <table id="tableBarang" class="table table-bordered" style="width: 100%;">
                        <thead>
                            <tr role="row">
                                <th>No</th>
                                <th>CABANG</th>
                                <th>ID ATM</th>
                                <th>Lokasi ATM</th>
                                <th>Tanggal Efektif</th>
                                <th>Jam Pengisian</th>
                                <th>Denom</th>
                                <th>Nominal Pengisian</th>
                                <th>Vendor</th>
                               <!--  <th>STATUS_KENDARAAN</th>
                                <th>PEMBAYARAN_GSM</th>
                                <th>Keterangan</th> -->
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
    const urlRekapbankbjb = '<?= site_url("Rekapbankbjb/") ?>';
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
                    url: urlRekapbankbjb + "listRekapbankbjb",
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