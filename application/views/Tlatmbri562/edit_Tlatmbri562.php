<form action="<?= base_url('Tlatmbri562/updateTlatmbri562/' . $NO_TL->NO) ?>" method="post">
    <section class="panel">
        <header class="panel-heading" style="background-color: black; color: white;">
            EDIT TL ATM BRI 562
        </header>
        <?php
        $NO = $this->General->fetch_records("tbl_timeline_ho_atm_bri_kolaborasi", ['NO' => $NO_TL->NO]);
        
        foreach ($NO as $result) { ?>
        <div class="box-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group" style="display: flex;">
                            <label class="col-lg-6 for="stock">Pengosongan</label>
                            <select name="pengosongan" id="pengosongan" class="form-control select2" required>
                                <!-- <option <?= $result->kondisi_barang == 2 ? 'selected' : '' ?> value="2">--Kondisi Barang--</option> -->
                                <option <?= $result->Pengosongan == '' ? 'selected' : '' ?> value="">--Status--</option>
                                <option <?= $result->Pengosongan == 'DONE' ? 'selected' : '' ?> value="DONE">DONE</option>
                                <option <?= $result->Pengosongan == 'NOT DONE' ? 'selected' : '' ?> value="NOT DONE">NOT DONE</option>
                            </select>
                        </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group" style="display: flex;">
                            <label class="col-lg-6 for="stock">Penihinal</label>
                            <select name="penihilan" id="penihilan" class="form-control select2" required>
                                <option <?= $result->Penihilan == '' ? 'selected' : '' ?> value="">--Status--</option>
                                <option <?= $result->Penihilan == 'DONE' ? 'selected' : '' ?> value="DONE">DONE</option>
                                <option <?= $result->Penihilan == 'NOT DONE' ? 'selected' : '' ?> value="NOT DONE">NOT DONE</option>
                            </select>
                    </div>
                </div>
                <hr>
                <div class="col-lg-6">
                    <div class="form-group" style="display: flex;">
                            <label class="col-lg-6 for="stock">Status HO BC</label>
                            <select name="status_bc" id="status_bc" class="form-control select2" required>
                                <option <?= $result->Status_HO_BC == '' ? 'selected' : '' ?> value="">--Status--</option>
                                <option <?= $result->Status_HO_BC == 'DONE' ? 'selected' : '' ?> value="DONE">DONE</option>
                                <option <?= $result->Status_HO_BC == 'NOT DONE' ? 'selected' : '' ?> value="NOT DONE">NOT DONE</option>
                            </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group" style="display: flex;">
                            <label class="col-lg-6 for="stock">Status RPL Perdana</label>
                            <select name="status_rpl" id="status_rpl" class="form-control select2" required>
                                <option <?= $result->Status_RPL_Perdana == '' ? 'selected' : '' ?> value="">--Status--</option>
                                <option <?= $result->Status_RPL_Perdana == 'DONE' ? 'selected' : '' ?> value="DONE">DONE</option>
                                <option <?= $result->Status_RPL_Perdana == 'NOT DONE' ? 'selected' : '' ?> value="NOT DONE">NOT DONE</option>
                            </select>
                    </div>
                </div>
            </div>
            <hr>
            <!-- <div class="col-lg-6"> -->
                <div class="col-md-6">
                    <div class="form-group" style="display: flex;">
                        <label for="ket_pending">Keterangan Pending</label>
                        <input  type="textbox" name="ket_pending" value="<?= $result->Keterangan_Pending ?>" id="ket_pending" class="form-control" placeholder="Keterangan Harap Di isi" required></input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" style="display: flex;">
                        <label for="tgl_perdana">Tanggal Perdana</label>
                        <input type="date" name="tgl_perdana" value="<?= $result->Tgl_Perdana ?>" id="tgl_perdana" class="form-control" required>
                    </div>
                </div>

            <!-- </div> -->
        </div>
        	<div class="row text-center" style="margin-bottom:">
                <div>
                    <button type="submit" id="filterpemenuhan" name="filterpemenuhan" class="btn btn-primary btn-sm">Save</button>
                </div>
            </div> 
        <br>    
    </section>
    <?php } ?>
</form>