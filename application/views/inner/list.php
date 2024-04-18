<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-user-circle-o" aria-hidden="true"></i> Mold Inner
            <small>Add, Edit, Delete</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>inner/add"><i class="fa fa-plus"></i> Add
                        New Inner</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                $this->load->helper('form');
                $error = $this->session->flashdata('error');
                if ($error) {
                    ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $error; ?>
                    </div>
                <?php }

                $success = $this->session->flashdata('success');
                if ($success) {
                    ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $success; ?>
                    </div>
                <?php }

                echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Inner List</h3>
                        <div class="box-tools">
                            <form action="<?php echo base_url() ?>inner/innerListing" method="POST" id="searchList">
                                <div class="input-group">
                                    <input type="text" name="searchText" value="<?php echo $searchText; ?>"
                                        class="form-control input-sm pull-right" style="width: 150px;"
                                        placeholder="Search" />
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-default searchList"><i
                                                class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.box-header -->

                    <div class="box-body table-responsive no-padding">
                        <style>
                            /* Warna untuk status 'complete' */
                            .table .success {
                                background-color: #DFF0D8;
                            }

                            /* Warna untuk status 'pending' */
                            .table .warning {
                                background-color: #FCF8E3;
                            }
                        </style>

                        <table class="table table-hover">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>No Mars</th>
                                <th>No BOM</th>
                                <th>Quantity</th>
                                <th>Mesin</th>
                                <th>No WO</th>
                                <th>In/Out</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            <?php
                            if (!empty($records)) {
                                $no = 1;
                                foreach ($records as $record) {
                                    $row_class = $record->status == 'complete' ? 'success' : ($record->status == 'pending' ? 'warning' : '');
                                    echo '<tr class="' . $row_class . '">';
                                    echo '<td>' . $no++ . '</td>';
                                    echo '<td>' . $record->tanggal . '</td>';
                                    echo '<td>' . $record->nama . '</td>';
                                    echo '<td>' . $record->mars . '</td>';
                                    echo '<td>' . $record->bom . '</td>';
                                    echo '<td>' . $record->qty . '</td>';
                                    echo '<td>' . $record->mesin . '</td>';
                                    echo '<td>' . $record->wo . '</td>';
                                    echo '<td>' . $record->io . '</td>';
                                    echo '<td>' . $record->status . '</td>';
                                    echo '<td class="text-center">
                                            <a class="btn btn-sm btn-info" href="' . base_url() . 'inner/edit/' . $record->id . '" title="Edit"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-sm btn-danger deleteInner" href="#" data-innerid="' . $record->id . '" title="Delete"><i class="fa fa-trash"></i></a>
                                        </td>';
                                    echo '</tr>';
                                }
                            }
                            ?>
                        </table>
                    </div><!-- /.box-body -->

                    <div class="box-footer clearfix">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
        </div>
    </section>
</div>

<!-- Script jQuery -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Script JavaScript untuk fungsi deleteInner dan penanganan paginasi -->
<script>
    $(document).ready(function () {
        $('.deleteInner').click(function (e) {
            e.preventDefault();
            var innerId = $(this).data('innerid');
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                // Lanjutkan proses penghapusan dengan mengarahkan ke URL deleteInner
                window.location.href = '<?php echo base_url('inner/deleteInner/') ?>' + innerId;
            }
        });
    });
</script>