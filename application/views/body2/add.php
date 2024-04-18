<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-user-circle-o" aria-hidden="true"></i> Body2 Management
            <small>Add / Edit Body</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Body2 Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addBody2" action="<?php echo base_url() ?>body2/addNewBody2" method="post"
                        role="form">
                        <div class="box-body <?php echo isset($status) && $status == "Pending" ? 'bg-yellow' : ''; ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="text" class="form-control required"
                                            value="<?php echo date('Y-m-d H:i'); ?>" id="tanggal" name="tanggal"
                                            maxlength="256" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control required"
                                            value="<?php echo set_value('nama'); ?>" id="nama" name="nama"
                                            maxlength="256" />
                                    </div>
                                    <div class="form-group">
                                        <label for="mars">Mars</label>
                                        <input type="text" class="form-control required"
                                            value="<?php echo set_value('mars'); ?>" id="mars" name="mars"
                                            maxlength="256" />
                                    </div>
                                    <div class="form-group">
                                        <label for="bom">Bom</label>
                                        <input type="text" class="form-control required"
                                            value="<?php echo set_value('bom'); ?>" id="bom" name="bom"
                                            maxlength="256" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="qty">Qty</label>
                                        <input type="text" class="form-control required" id="qty" name="qty" />
                                    </div>
                                    <div class="form-group">
                                        <label for="mesin">Mesin</label>
                                        <input type="text" class="form-control required" id="mesin" name="mesin" />
                                    </div>
                                    <div class="form-group">
                                        <label for="wo">WO</label>
                                        <input type="text" class="form-control required" id="wo" name="wo" />
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
                                            <option value="pending" <?php echo isset($body2['status']) && $body2['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                            <option value="complete" <?php echo isset($body2['status']) && $body2['status'] == 'complete' ? 'selected' : ''; ?>>Complete</option>
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