<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                STOCK BARANG
                <span <?php echo $My_Controller->savePermission; ?>>
                    | <button type="button" id='addStock' class='btn btn-info'>
                        Add New <i class="fa fa-plus"></i>
                    </button>
                </span>
            </header>
            <div class="panel-body">
                <table id="tableBarangGlob" class="table table-bordered" style="width: 100%;">
                    <thead>
                        <tr role="row">
                            <th>No</th>
                            <th>Nama Uker</th>
                            <th>Group Barang</th>
                            <th>Subgroup Barang</th>
                            <th>Merek Barang</th>
                            <th>Tipe Barang</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Qty</th>
                        </tr>
                    </thead>
                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                        <?php
                        $no = 1;
                        foreach ($stockbarang as $bg) {
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $bg->nama_uker ?></td>
                                <td><?= $bg->nama_gbarang ?></td>
                                <td><?= $bg->nama_sgbarang ?></td>
                                <td><?= $bg->nama_merek ?></td>
                                <td><?= $bg->tipe_barang ?></td>
                                <td><?= $bg->kode_barang ?></td>
                                <td><?= $bg->nama_barang ?></td>
                                <td><?= $bg->qty ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>

<!--Modal for ADD -->
<div class="modal fade" id="formStock" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form" class="form-horizontal group-border hover-stripped" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Add/Edit Barang</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_gbarang" class="control-label">Group Barang</label>
                        <select class="form-control select2" required name="id_gbarang" onchange="ChainedBarang('<?= base_url('Chained/Listsubgroupbarang/') ?>'+this.value, '#id_sgbarang', 'id_gbarang')" id="id_gbarang" style="width: 100%;">
                            <option value="">Select Group Barang</option>
                            <?php foreach ($gbarang as $gb) : ?>
                                <option value="<?php echo $gb->id_gbarang; ?>"><?php echo $gb->nama_gbarang; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_sgbarang" class="control-label">Subgroup Barang</label>
                        <select class="form-control select2" required name="id_sgbarang" id="id_sgbarang" onchange="ChainedBarang('<?= base_url('Chained/Listmerekbarang/') ?>'+this.value, '#id_merek', 'id_sgbarang')" style="width: 100%;">
                            <option value="">Select Subgroup Barang</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_merek" class="control-label">Merek Barang</label>
                        <select class="form-control select2" required name="id_merek" id="id_merek" onchange="ChainedBarang('<?= base_url('Chained/Listtipebarang/') ?>'+this.value, '#id_tipe_barang', 'id_merek')" style="width: 100%;">
                            <option value="">Select Merek Barang</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_tipe_barang" class="control-label">Tipe Barang</label>
                        <select class="form-control select2" required name="id_tipe_barang" id="id_tipe_barang" onchange="ChainedBarang('<?= base_url('Chained/Listbarang/') ?>'+this.value, '#no_urut', 'id_tipe_barang')" style="width: 100%;">
                            <option value="">Select Tipe Barang</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="no_urut" class="control-label">Nama Barang</label>
                        <select class="form-control select2" required name="no_urut" id="no_urut" style="width: 100%;">
                            <option value="">Select Nama Barang</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Save" class="btn btn-success">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--Modal for ADD ends-->

<script>
    const urlStockbarang = '<?= site_url("Stockbarang/") ?>';

    $(function() {
        $('#tableBarangGlob').dataTable({
             dom: 'Bfrtip',
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
        });

        $('#addStock').on('click', function(e) {
            e.preventDefault();

            $('#form')[0].reset();
            $('#id_uker').val("").trigger('change');
            $('#id_gbarang').val("").trigger('change');
            $('#id_sgbarang').val("").trigger('change');
            $('#id_merek').val("").trigger('change');
            $('#id_tipe_barang').val("").trigger('change');
            $('#formStock').modal('show');
        });
    })

    $('body').on('shown.bs.modal', '.modal', function() {
        $(this).find('select').each(function() {
            var dropdownParent = $(document.body);
            if ($(this).parents('.modal.in:first').length !== 0)
                dropdownParent = $(this).parents('.modal.in:first');
            $(this).select2({
                dropdownParent: dropdownParent
            });
        });
    });

    $("#form").on("submit", function(event) {
        event.preventDefault();

        $.ajax({
            type: "POST",
            url: urlStockbarang + 'formStockbarang',
            data: $(this).serialize(),
            dataType: 'JSON',
            success: function(data) {
                Swal.fire(data.pesan, "", data.tipe).then((result) => {
                    location.reload();
                    $('#form')[0].reset();
                    $('#formStock').modal('hide');
                });
            },
        });
    });

    function ChainedBarang(url, id_tujuan, tipe, no_urut = null) {
        $.ajax({
            type: "POST",
            url: url,
            dataType: "JSON",
            beforeSend: function(e) {
                if (e && e.overrideMimeType) {
                    e.overrideMimeType("application/json;charset=UTF-8");
                }
            },
            success: function(response) {
                if (tipe == 'id_gbarang' || tipe == 'id_gbarang' + no_urut) {
                    if (no_urut) {
                        $('#id_sgbarang' + no_urut).val(null).trigger('change');
                        $('#id_merek' + no_urut).val(null).trigger('change');
                        $('#id_tipe_barang' + no_urut).val(null).trigger('change');
                    } else {
                        $('#id_sgbarang').val(null).trigger('change');
                        $('#id_merek').val(null).trigger('change');
                        $('#id_tipe_barang').val(null).trigger('change');
                    }
                } else if (tipe == 'id_sgbarang') {
                    if (no_urut) {
                        $('#id_merek' + no_urut).val(null).trigger('change');
                        $('#id_tipe_barang' + no_urut).val(null).trigger('change');
                    } else {
                        $('#id_merek').val(null).trigger('change');
                        $('#id_tipe_barang').val(null).trigger('change');
                    }
                } else if (tipe == 'id_merek') {
                    if (no_urut) {
                        $('#id_tipe_barang' + no_urut).val(null).trigger('change');
                    } else {
                        $('#id_tipe_barang').val(null).trigger('change');
                    }
                }
                $(id_tujuan).html(response).show();
            },
        });
    }
</script>