<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
            <small>Control panel</small>
        </h1>
    </section>
    <section class="content">
        <h2>DIEPIN</h2>
        <?php
        // Ambil jumlah data dengan status "Complete" dari database untuk neck
        $completeCountHead = $this->db->where('status', 'Complete')->count_all_results('head');
        // Ambil jumlah data dengan status "Pending" dari database untuk neck
        $pendingCountHead = $this->db->where('status', 'Pending')->count_all_results('head');
        // Hitung jumlah total data dari database untuk neck (tidak termasuk yang memiliki status "Pending")
        $totalCountHead = $completeCountHead + $pendingCountHead;
        // Hitung persentase hanya jika total count lebih dari 0 untuk neck
        $percentageHead = ($totalCountHead > 0) ? ($completeCountHead / $totalCountHead) * 100 : 0;
        // Ambil jumlah data dengan status "Complete" dari database untuk neck
        $completeCountPin = $this->db->where('status', 'Complete')->count_all_results('pin');
        // Ambil jumlah data dengan status "Pending" dari database untuk neck
        $pendingCountPin = $this->db->where('status', 'Pending')->count_all_results('pin');
        // Hitung jumlah total data dari database untuk neck (tidak termasuk yang memiliki status "Pending")
        $totalCountPin = $completeCountPin + $pendingCountPin;         // Hitung persentase hanya jika total count lebih dari 0 untuk neck
        $percentagePin = ($totalCountPin > 0) ? ($completeCountPin / $totalCountPin) * 100 : 0;

        $totalCompleteCount = $completeCountHead + $completeCountPin;
        $totalPendingCount = $pendingCountHead + $pendingCountPin;
        $totalCount = $totalCountHead + $totalCountPin;
        $totalPercentage = ($totalCount > 0) ? ($totalCompleteCount / $totalCount) * 100 : 0;
        ?>
        <p>
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <a class="small-box-footer"> DIE </a>
                    <div class="inner">
                        <h3>
                            <?php echo $completeCountHead . ' dari ' . $totalCountHead; ?>
                        </h3>
                        <p>DIE Complete (
                            <?php echo number_format($percentageHead, 2); ?>%)
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-analytics-outline"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>Head/headListing" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <a class="small-box-footer"> PIN </a>
                    <div class="inner">
                        <h3>
                            <?php echo $completeCountPin . ' dari ' . $totalCountPin; ?>
                        </h3>
                        <p>PIN Complete (
                            <?php echo number_format($percentagePin, 2); ?>%)
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-analytics-outline"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>Pin/pinListing" class="small-box-footer">More info <i
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