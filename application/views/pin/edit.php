<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <?php
        $pinId = $pinInfo->id;
        $tanggal = $pinInfo->tanggal;
        $nama = $pinInfo->nama;
        $mars = $pinInfo->mars;
        $bom = $pinInfo->bom;
        $qty = $pinInfo->qty;
        $mesin = $pinInfo->mesin;
        $wo = $pinInfo->wo;
        $io = $pinInfo->io;
        $status = $pinInfo->status;
        ?>
        <h1>
            <i class="fa fa-user-circle-o" aria-hidden="true"></i> Pin Management
            <small>Edit Pin</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->

                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Pin Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" action="<?php echo base_url() ?>pin/editPin" method="post" id="editPin"
                        role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="text" class="form-control required" value="<?php echo $tanggal; ?>"
                                            id="tanggal" name="tanggal" readonly />
                                        <input type="hidden" value="<?php echo $pinId; ?>" name="pinId" id="pinId" />
                                    </div>

                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control required" value="<?php echo $nama; ?>"
                                            id="nama" name="nama" maxlength="256" />
                                    </div>
                                    <div class="form-group">
                                        <label for="mars">No Mars</label>
                                        <input type="text" class="form-control required" value="<?php echo $mars; ?>"
                                            id="mars" name="mars" maxlength="256" />
                                    </div>
                                    <div class="form-group">
                                        <label for="bom">No BOM</label>
                                        <input type="text" class="form-control required" value="<?php echo $bom; ?>"
                                            id="bom" name="bom" maxlength="256" />
                                    </div>
                                    <div class="form-group">
                                        <label for="qty">Quantity</label>
                                        <input type="text" class="form-control required" value="<?php echo $qty; ?>"
                                            id="qty" name="qty" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mesin">Mesin</label>
                                        <input type="text" class="form-control required" value="<?php echo $mesin; ?>"
                                            id="mesin" name="mesin" />
                                    </div>
                                    <div class="form-group">
                                        <label for="wo">No WO</label>
                                        <input type="text" class="form-control required" value="<?php echo $wo; ?>"
                                            id="wo" name="wo" />
                                    </div>
                                    <div class="form-group">
                                        <label for="io">IO</label>
                                        <select class="form-control" id="io" name="io">
                                            <option value="I">IN</option>
                                            <option value="O">OUT</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="pending" <?php echo isset($pin['status']) && $pin['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                            <option value="complete" <?php echo isset($pin['status']) && $pin['status'] == 'complete' ? 'selected' : ''; ?>>Complete</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                $this->load->helper('form');
                $error = $this->session->flashdata('error');
                if ($error) {
                    ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php } ?>
                <?php
                $success = $this->session->flashdata('success');
                if ($success) {
                    ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php } ?>

                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>