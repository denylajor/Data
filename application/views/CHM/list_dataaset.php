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
                            </div>
                        </div>
                    </div>
                </header>
                <div class="panel-body">
                    <table id="tableBarang" class="table table-bordered" style="width: 100%;">
                        <thead>
                            <tr role="row">
                                <th>No</th>
                                <th>Terminal ID</th>
                                <th>Lokasi</th>
                                <th>Alamat</th>
                                <th>Kantor Layanan</th>
                                <th>Uker Induk</th>
                                <th>Cluster</th>
                                <th>Jam Operasional</th>
                                <th>Garansi</th>
                                <th>CCTV Ada</th>
                                <th>CCTV Tdk Ada</th>
                                <th>UPS Ada</th>
                                <th>UPS Tdk Ada</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Pagu</th>
                                <th>Denom</th>
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
    const urlCHM = '<?= site_url("DataAset/") ?>';
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
                    url: urlCHM + "listDataAset",
                    type: "POST"
                },
                columnDefs: [{
                    targets: [0, -1],
                    orderable: false,
                }, ],
            });
        }

        // $('#addBarang').on('click', function(e) {
        //     e.preventDefault();

        //     $('#form')[0].reset();
        //     $('#no_urut').val("");
        //     $('#id_uker').val("").trigger('change');
        //     $('#id_gbarang').val("").trigger('change');
        //     $('#id_sgbarang').val("").trigger('change');
        //     $('#id_merek').val("").trigger('change');
        //     $('#id_tipe_barang').val("").trigger('change');
        //     $('#formBarang').modal('show');
        // });

    });

    // $('body').on('shown.bs.modal', '.modal', function() {
    //     $(this).find('select').each(function() {
    //         var dropdownParent = $(document.body);
    //         if ($(this).parents('.modal.in:first').length !== 0)
    //             dropdownParent = $(this).parents('.modal.in:first');
    //         $(this).select2({
    //             dropdownParent: dropdownParent
    //         });
    //     });
    // });

    // function activeBarang(no_urut) {
    //     Swal.fire({
    //         title: "Are you sure?",
    //         text: "You won't be able to revert this!",
    //         icon: "warning",
    //         showCancelButton: true,
    //         confirmButtonColor: "#3085d6",
    //         cancelButtonColor: "#d33",
    //         confirmButtonText: "Yes!",
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $.ajax({
    //                 type: "POST",
    //                 data: {
    //                     no_urut: no_urut
    //                 },
    //                 url: urlBarang + "activeBarang",
    //                 dataType: 'JSON',
    //                 success: function(response) {
    //                     if (response) {
    //                         Swal.fire(response, "", "success").then((result) => {
    //                             table.ajax.reload(null, false);
    //                         });
    //                     } else {
    //                         Swal.fire("Data gagal di delete!", "", "error");
    //                     }
    //                 },
    //             });
    //         }
    //     });
    // }

    // $("#form").on("submit", function(event) {
    //     event.preventDefault();

    //     $.ajax({
    //         type: "POST",
    //         url: urlBarang + 'formBarang',
    //         data: $(this).serialize(),
    //         dataType: 'JSON',
    //         success: function(data) {
    //             Swal.fire(data.pesan, "", data.tipe).then((result) => {
    //                 location.reload();
    //                 $('#form')[0].reset();
    //                 $('#id_uker').val("").trigger('change');
    //                 $('#id_tipe_barang').val("").trigger('change');
    //                 $('#formBarang').modal('hide');
    //             });
    //         },
    //     });
    // });

    // function ChainedBarang(url, id_tujuan, tipe, no_urut = null) {
    //     $.ajax({
    //         type: "POST",
    //         url: url,
    //         dataType: "JSON",
    //         beforeSend: function(e) {
    //             if (e && e.overrideMimeType) {
    //                 e.overrideMimeType("application/json;charset=UTF-8");
    //             }
    //         },
    //         success: function(response) {
    //             if (tipe == 'id_gbarang' || tipe == 'id_gbarang' + no_urut) {
    //                 if (no_urut) {
    //                     $('#id_sgbarang' + no_urut).val(null).trigger('change');
    //                     $('#id_merek' + no_urut).val(null).trigger('change');
    //                     $('#id_tipe_barang' + no_urut).val(null).trigger('change');
    //                 } else {
    //                     $('#id_sgbarang').val(null).trigger('change');
    //                     $('#id_merek').val(null).trigger('change');
    //                     $('#id_tipe_barang').val(null).trigger('change');
    //                 }
    //             } else if (tipe == 'id_sgbarang') {
    //                 if (no_urut) {
    //                     $('#id_merek' + no_urut).val(null).trigger('change');
    //                     $('#id_tipe_barang' + no_urut).val(null).trigger('change');
    //                 } else {
    //                     $('#id_merek').val(null).trigger('change');
    //                     $('#id_tipe_barang').val(null).trigger('change');
    //                 }
    //             } else if (tipe == 'id_merek') {
    //                 if (no_urut) {
    //                     $('#id_tipe_barang' + no_urut).val(null).trigger('change');
    //                 } else {
    //                     $('#id_tipe_barang').val(null).trigger('change');
    //                 }
    //             }
    //             $(id_tujuan).html(response).show();
    //         },
    //     });
    // }
</script>