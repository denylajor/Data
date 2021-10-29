<form action="<?= base_url('PSD/import_excel'); ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    <span <?php echo $My_Controller->savePermission; ?>> </span>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Pilih Table</label>
                        <select class="form-control select2" style="width: 50%;" name="psd" id="psd">
                            <option value="">--Select Tabel--</option>
                            <option value="control_masa_STNK_kendaraan">Control Masa STNK Kendaraan</option>
                            <option value="rekap_SDM_karyawan_cro">SDM Karyawan CRO</option>
                            <option value="rekap_SDM_karyawan_cit">SDM Karyawan CIT</option>
                            <option value="rekap_SDM_satpam_bg">Rekap SDM Satpam BG</option>
                            <option value="rekap_SDM_pertumbuhan_atm">Rekap SDM Pertumbuhan ATM</option>
                            <option value="register_penugasan_2021">Register Penugasan 2021</option>
                            <option value="data_vaksin_pt_bg">Laporan Vaksin</option>
                            <option value="data_non_vaksin_pt_bg">Laporan Non Vaksin</option>
                            <option value="daftar_pekerja_terdaftar_vaksin_dan_sudah_di_vaksin">Pekerja Terdaftar Vaksin dan Sudah di Vaksin</option>
                            <option value="rekap_pekerja_tdk_masuk_bg">Pekerja Tidak Masuk BG</option>
                            <option value="data_pembina">Data Pembina</option>
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
                                <a class="col-sm-" href="Contstnkkend">Control Masa STNK Kendaraan | </a>
                                <a class="col-sm-" href="Sdmkaryawancro">SDM Karyawan CRO | </a>
                                <a class="col-sm-" href="Sdmkaryawancit">SDM Karyawan CIT | </a>
                                <a class="col-sm-" href="Reksatpambg">Rekap SDM Satpam BG | </a>
                                <a class="col-sm-" href="Reksdmperatm">Rekap SDM Pertumbuhan ATM | </a>
                                <a class="col-sm-" href="Regpenugasan2021">Register Penugasan 2021 | </a>
                                <br><hr>
                                <a class="col-sm-" href="Vaksinpsd">Laporan Vaksin | </a>
                                <a class="col-sm-" href="Nonvaksinpsd">Laporan Non Vaksin | </a>
                                <a class="col-sm-" href="Pektervak">Pekerja Terdaftar Vaksin dan Sudah di Vaksin | </a>
                                <a class="col-sm-" href="Rekpektdkmsk">Pekerja Tidak Masuk BG | </a>
                                <a class="col-sm-" href="Datapembina">Data Pembina | </a>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="panel-body">
                    <table id="tableBarang" class="table table-bordered table-striped" style="width: 100%;">
                        <thead style="background-color: #282828; color: white;">
                            <tr role="row">
                                <th>No</th>
                                <th>Timestamp</th>
                                <th>ID Personal</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Unit Kerja</th>
                                <th>Wilayah</th>
                                <th>Vaksin 1</th>
                                <th>Vaksin 2</th>
                                <th>Update Vaksin 1</th>
                                <th>Update Vaksin 2</th>
                                <th>Jenis Vaksin 1</th>
                                <th>Jenis Vaksin 2</th>
                                <th>Sertifikat 1</th>
                                <th>Sertifikat 2</th>
                                <th>User</th>
                                <th>Tanggal Update</th>
                            </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all" style="background-color: #aaaba9;"></tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</form>



<script>
    const urlVaksinpsd = '<?= site_url("Vaksinpsd/") ?>';
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
                    url: urlVaksinpsd + "listVaksinpsd",
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