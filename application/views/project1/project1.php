<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
            <small>Control panel</small>
        </h1>
    </section>
    <section class="content">
        <h2>MOLD</h2>
        <p></p>
        <div class="row">
            <?php
            // Ambil jumlah data dengan status "Complete" dari database untuk neck
            $completeCountNeck = $this->db->where('status', 'Complete')->count_all_results('neck');
            // Ambil jumlah data dengan status "Pending" dari database untuk neck
            $pendingCountNeck = $this->db->where('status', 'Pending')->count_all_results('neck');
            // Hitung jumlah total data dari database untuk neck (tidak termasuk yang memiliki status "Pending")
            $totalCountNeck = $completeCountNeck + $pendingCountNeck;
            // Hitung persentase hanya jika total count lebih dari 0 untuk neck
            $percentageNeck = ($totalCountNeck > 0) ? ($completeCountNeck / $totalCountNeck) * 100 : 0;

            // Ambil jumlah data dengan status "Complete" dari database untuk body
            $completeCountBody = $this->db->where('status', 'Complete')->count_all_results('body');
            // Ambil jumlah data dengan status "Pending" dari database untuk body
            $pendingCountBody = $this->db->where('status', 'Pending')->count_all_results('body');
            // Hitung jumlah total data dari database untuk body (tidak termasuk yang memiliki status "Pending")
            $totalCountBody = $completeCountBody + $pendingCountBody;
            // Hitung persentase hanya jika total count lebih dari 0 untuk body
            $percentageBody = ($totalCountBody > 0) ? ($completeCountBody / $totalCountBody) * 100 : 0;

            // Ambil jumlah data dengan status "Complete" dari database untuk bottom
            $completeCountBottom = $this->db->where('status', 'Complete')->count_all_results('bottom');
            // Ambil jumlah data dengan status "Pending" dari database untuk bottom
            $pendingCountBottom = $this->db->where('status', 'Pending')->count_all_results('bottom');
            // Hitung jumlah total data dari database untuk bottom (tidak termasuk yang memiliki status "Pending")
            $totalCountBottom = $completeCountBottom + $pendingCountBottom;
            // Hitung persentase hanya jika total count lebih dari 0 untuk bottom
            $percentageBottom = ($totalCountBottom > 0) ? ($completeCountBottom / $totalCountBottom) * 100 : 0;

            // Hitung total persentase dari keseluruhan data
            $totalCompleteCount = $completeCountNeck + $completeCountBody + $completeCountBottom;
            $totalPendingCount = $pendingCountNeck + $pendingCountBody + $pendingCountBottom;
            $totalCount = $totalCountNeck + $totalCountBody + $totalCountBottom;
            $totalPercentage = ($totalCount > 0) ? ($totalCompleteCount / $totalCount) * 100 : 0;
            ?>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <a class="small-box-footer"> Neck</a>
                    <div class="inner">
                        <h3>
                            <?php echo $completeCountNeck . ' dari ' . $totalCountNeck; ?>
                        </h3>
                        <p>Neck Complete (
                            <?php echo number_format($percentageNeck, 2); ?>%)
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-analytics-outline"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>Neck/neckListing" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <a class="small-box-footer"> Body</a>
                    <div class="inner">
                        <h3>
                            <?php echo $completeCountBody . ' dari ' . $totalCountBody; ?>
                        </h3>
                        <p>Body Complete (
                            <?php echo number_format($percentageBody, 2); ?>%)
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-analytics-outline"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>Body/bodyListing" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <a class="small-box-footer"> Bottom </a>
                    <div class="inner">
                        <h3>
                            <?php echo $completeCountBottom . ' dari ' . $totalCountBottom; ?>
                        </h3>
                        <p>Bottom Complete (
                            <?php echo number_format($percentageBottom, 2); ?>%)
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-analytics-outline"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>Bottom/bottomListing" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner text-center">
                        <h3>
                            Selesai
                            <?php echo $totalCompleteCount; ?>
                        </h3>
                        <h4>Total Complete
                            <h2>
                                <?php echo number_format($totalPercentage, 2); ?>%
                            </h2>
                        </h4>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-analytics-outline"></i>
                    </div>
                </div>
            </div><!-- ./col -->

        </div><!-- /.row -->


    </section><!-- /.content -->
</div><!-- /.content-wrapper -->