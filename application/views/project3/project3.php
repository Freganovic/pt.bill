<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
            <small>Control panel</small>
        </h1>
    </section>
    <section class="content">
        <h2>BLOWPIN</h2>
        <p>
            <?php
            // Ambil jumlah data dengan status "Complete" dari database untuk neck
            $completeCountNeck = $this->db->where('status', 'Complete')->count_all_results('neck3');
            // Ambil jumlah data dengan status "Pending" dari database untuk neck
            $pendingCountNeck = $this->db->where('status', 'Pending')->count_all_results('neck3');
            // Hitung jumlah total data dari database untuk neck (tidak termasuk yang memiliki status "Pending")
            $totalCountNeck = $completeCountNeck + $pendingCountNeck;
            // Hitung persentase hanya jika total count lebih dari 0 untuk neck
            $percentageNeck = ($totalCountNeck > 0) ? ($completeCountNeck / $totalCountNeck) * 100 : 0;
            // Ambil jumlah data dengan status "Complete" dari database untuk neck
            $completeCountBody = $this->db->where('status', 'Complete')->count_all_results('body3');
            // Ambil jumlah data dengan status "Pending" dari database untuk neck
            $pendingCountBody = $this->db->where('status', 'Pending')->count_all_results('body3');
            // Hitung jumlah total data dari database untuk neck (tidak termasuk yang memiliki status "Pending")
            $totalCountBody = $completeCountBody + $pendingCountBody;
            // Hitung persentase hanya jika total count lebih dari 0 untuk neck
            $percentageBody = ($totalCountBody > 0) ? ($completeCountBody / $totalCountBody) * 100 : 0;
            $completeCountBottom = $this->db->where('status', 'Complete')->count_all_results('bottom3');
            // Ambil jumlah data dengan status "Pending" dari database untuk neck
            $pendingCountBottom = $this->db->where('status', 'Pending')->count_all_results('bottom3');
            // Hitung jumlah total data dari database untuk neck (tidak termasuk yang memiliki status "Pending")
            $totalCountBottom = $completeCountBottom + $pendingCountBottom;
            // Hitung persentase hanya jika total count lebih dari 0 untuk neck
            $percentageBottom = ($totalCountBottom > 0) ? ($completeCountBottom / $totalCountBottom) * 100 : 0;
            $completeCountInner = $this->db->where('status', 'Complete')->count_all_results('inner');
            // Ambil jumlah data dengan status "Pending" dari database untuk inner
            $pendingCountInner = $this->db->where('status', 'Pending')->count_all_results('inner');
            // Hitung jumlah total data dari database untuk inner (tidak termasuk yang memiliki status "Pending")
            $totalCountInner = $completeCountInner + $pendingCountInner;
            // Hitung persentase hanya jika total count lebih dari 0 untuk inner
            $percentageInner = ($totalCountInner > 0) ? ($completeCountInner / $totalCountInner) * 100 : 0;
            // Hitung total persentase dari keseluruhan data
            $totalCompleteCount = $completeCountNeck + $completeCountBody + $completeCountBottom + $completeCountInner;
            $totalPendingCount = $pendingCountNeck + $pendingCountBody + $pendingCountBottom + $pendingCountInner;
            $totalCount = $totalCountNeck + $totalCountBody + $totalCountBottom + $totalCountInner;
            $totalPercentage = ($totalCount > 0) ? ($totalCompleteCount / $totalCount) * 100 : 0;
            ?>
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <a class="small-box-footer"> Blowpin Tip</a>
                    <div class="inner">
                        <h3>
                            <?php echo $completeCountNeck . ' dari ' . $totalCountNeck; ?>
                        </h3>
                        <p>Cutting Slip Complete (
                            <?php echo number_format($percentageNeck, 2); ?>%)
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-analytics-outline"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>Neck3/neck3Listing" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <a class="small-box-footer"> Cutting Slip</a>
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
                    <a href="<?php echo base_url(); ?>Body3/body3Listing" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <a class="small-box-footer"> Blowpin Holder </a>
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
                    <a href="<?php echo base_url(); ?>Bottom3/bottom3Listing" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <a class="small-box-footer"> Inner path</a>
                    <div class="inner">
                        <h3>
                            <?php echo $completeCountInner . ' dari ' . $totalCountInner; ?>
                        </h3>
                        <p>Inner Complete (
                            <?php echo number_format($percentageInner, 2); ?>%)
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-analytics-outline"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>Inner/innerListing" class="small-box-footer">More info <i
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
                                <?php echo number_format($totalPercentage, ); ?>%
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
</div>