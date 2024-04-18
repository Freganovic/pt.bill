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

<?php
// Ambil jumlah data dengan status "Complete" dari database untuk neck2
$completeCountNeck2 = $this->db->where('status', 'Complete')->count_all_results('neck2');
// Ambil jumlah data dengan status "Pending" dari database untuk neck2
$pendingCountNeck2 = $this->db->where('status', 'Pending')->count_all_results('neck2');
// Hitung jumlah total data dari database untuk neck2 (tidak termasuk yang memiliki status "Pending")
$totalCountNeck2 = $completeCountNeck2 + $pendingCountNeck2;
// Hitung persentase hanya jika total count lebih dari 0 untuk neck2
$percentageNeck2 = ($totalCountNeck2 > 0) ? ($completeCountNeck2 / $totalCountNeck2) * 100 : 0;

// Ambil jumlah data dengan status "Complete" dari database untuk body2
$completeCountBody2 = $this->db->where('status', 'Complete')->count_all_results('body2');
// Ambil jumlah data dengan status "Pending" dari database untuk body2
$pendingCountBody2 = $this->db->where('status', 'Pending')->count_all_results('body2');
// Hitung jumlah total data dari database untuk body2 (tidak termasuk yang memiliki status "Pending")
$totalCountBody2 = $completeCountBody2 + $pendingCountBody2;
// Hitung persentase hanya jika total count lebih dari 0 untuk body2
$percentageBody2 = ($totalCountBody2 > 0) ? ($completeCountBody2 / $totalCountBody2) * 100 : 0;

// Ambil jumlah data dengan status "Complete" dari database untuk bottom2
$completeCountBottom2 = $this->db->where('status', 'Complete')->count_all_results('bottom2');
// Ambil jumlah data dengan status "Pending" dari database untuk bottom2
$pendingCountBottom2 = $this->db->where('status', 'Pending')->count_all_results('bottom2');
// Hitung jumlah total data dari database untuk bottom2 (tidak termasuk yang memiliki status "Pending")
$totalCountBottom2 = $completeCountBottom2 + $pendingCountBottom2;
// Hitung persentase hanya jika total count lebih dari 0 untuk bottom2
$percentageBottom2 = ($totalCountBottom2 > 0) ? ($completeCountBottom2 / $totalCountBottom2) * 100 : 0;

// Hitung total persentase dari keseluruhan data
$totalCompleteCount2 = $completeCountNeck2 + $completeCountBody2 + $completeCountBottom2;
$totalPendingCount2 = $pendingCountNeck2 + $pendingCountBody2 + $pendingCountBottom2;
$totalCount2 = $totalCountNeck2 + $totalCountBody2 + $totalCountBottom2;
$totalPercentage2 = ($totalCount2 > 0) ? ($totalCompleteCount2 / $totalCount2) * 100 : 0;
?>

<?php
// Ambil jumlah data dengan status "Complete" dari database untuk neck3
$completeCountNeck3 = $this->db->where('status', 'Complete')->count_all_results('neck3');
// Ambil jumlah data dengan status "Pending" dari database untuk neck3
$pendingCountNeck3 = $this->db->where('status', 'Pending')->count_all_results('neck3');
// Hitung jumlah total data dari database untuk neck3 (tidak termasuk yang memiliki status "Pending")
$totalCountNeck3 = $completeCountNeck3 + $pendingCountNeck3;
// Hitung persentase hanya jika total count lebih dari 0 untuk neck3
$percentageNeck3 = ($totalCountNeck3 > 0) ? ($completeCountNeck3 / $totalCountNeck3) * 100 : 0;

// Ambil jumlah data dengan status "Complete" dari database untuk body3
$completeCountBody3 = $this->db->where('status', 'Complete')->count_all_results('body3');
// Ambil jumlah data dengan status "Pending" dari database untuk body3
$pendingCountBody3 = $this->db->where('status', 'Pending')->count_all_results('body3');
// Hitung jumlah total data dari database untuk body3 (tidak termasuk yang memiliki status "Pending")
$totalCountBody3 = $completeCountBody3 + $pendingCountBody3;
// Hitung persentase hanya jika total count lebih dari 0 untuk body3
$percentageBody3 = ($totalCountBody3 > 0) ? ($completeCountBody3 / $totalCountBody3) * 100 : 0;

// Ambil jumlah data dengan status "Complete" dari database untuk bottom3
$completeCountBottom3 = $this->db->where('status', 'Complete')->count_all_results('bottom3');
// Ambil jumlah data dengan status "Pending" dari database untuk bottom3
$pendingCountBottom3 = $this->db->where('status', 'Pending')->count_all_results('bottom3');
// Hitung jumlah total data dari database untuk bottom3 (tidak termasuk yang memiliki status "Pending")
$totalCountBottom3 = $completeCountBottom3 + $pendingCountBottom3;
// Hitung persentase hanya jika total count lebih dari 0 untuk bottom3
$percentageBottom3 = ($totalCountBottom3 > 0) ? ($completeCountBottom3 / $totalCountBottom3) * 100 : 0;

// Ambil jumlah data dengan status "Complete" dari database untuk inner
$completeCountInner = $this->db->where('status', 'Complete')->count_all_results('inner');
// Ambil jumlah data dengan status "Pending" dari database untuk inner
$pendingCountInner = $this->db->where('status', 'Pending')->count_all_results('inner');
// Hitung jumlah total data dari database untuk inner (tidak termasuk yang memiliki status "Pending")
$totalCountInner = $completeCountInner + $pendingCountInner;
// Hitung persentase hanya jika total count lebih dari 0 untuk inner
$percentageInner = ($totalCountInner > 0) ? ($completeCountInner / $totalCountInner) * 100 : 0;
// Hitung total persentase dari keseluruhan data
$totalCompleteCount3 = $completeCountNeck3 + $completeCountBody3 + $completeCountBottom3 + $completeCountInner;
$totalPendingCount3 = $pendingCountNeck3 + $pendingCountBody3 + $pendingCountBottom3 + $pendingCountInner;
$totalCount3 = $totalCountNeck3 + $totalCountBody3 + $totalCountBottom3 + $totalCountInner;
$totalPercentage3 = ($totalCount3 > 0) ? ($totalCompleteCount3 / $totalCount3) * 100 : 0;
?>

<?php
// Ambil jumlah data dengan status "Complete" dari database untuk head
$completeCountHead = $this->db->where('status', 'Complete')->count_all_results('head');
// Ambil jumlah data dengan status "Pending" dari database untuk head
$pendingCountHead = $this->db->where('status', 'Pending')->count_all_results('head');
// Hitung jumlah total data dari database untuk head (tidak termasuk yang memiliki status "Pending")
$totalCountHead = $completeCountHead + $pendingCountHead;
// Hitung persentase hanya jika total count lebih dari 0 untuk head
$percentageHead = ($totalCountHead > 0) ? ($completeCountHead / $totalCountHead) * 100 : 0;
// Ambil jumlah data dengan status "Complete" dari database untuk pin
$completeCountPin = $this->db->where('status', 'Complete')->count_all_results('pin');
// Ambil jumlah data dengan status "Pending" dari database untuk pin
$pendingCountPin = $this->db->where('status', 'Pending')->count_all_results('pin');
// Hitung jumlah total data dari database untuk pin (tidak termasuk yang memiliki status "Pending")
$totalCountPin = $completeCountPin + $pendingCountPin;
// Hitung persentase hanya jika total count lebih dari 0 untuk pin
$percentagePin = ($totalCountPin > 0) ? ($completeCountPin / $totalCountPin) * 100 : 0;

$totalCompleteCount4 = $completeCountHead + $completeCountPin;
$totalPendingCount4 = $pendingCountHead + $pendingCountPin;
$totalCount4 = $totalCountHead + $totalCountPin;
$totalPercentage4 = ($totalCount4 > 0) ? ($totalCompleteCount4 / $totalCount4) * 100 : 0;
?>
<?php
// Menghitung total data dari semua tabel
$totalCompleteCountAll = $totalCompleteCount + $totalCompleteCount2 + $totalCompleteCount3 + $totalCompleteCount4;
$totalPendingCountAll = $totalPendingCount + $totalPendingCount2 + $totalPendingCount3 + $totalPendingCount4;
$totalCountAll = $totalCount + $totalCount2 + $totalCount3 + $totalCount4;

// Menghitung persentase untuk total keseluruhan
$totalPercentageAll = ($totalCountAll > 0) ? ($totalCompleteCountAll / $totalCountAll) * 100 : 0;
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
      <small>Control panel</small>
    </h1>
  </section>
  <section class="content">
    <h1>Project</h1>
    <div class="row">
      <div class="col-lg-3 col-md-6">
        <div class="small-box bg-blue">
          <div class="inner">
            <h3>UNITED 1,2 L</h3>
            <h4>Total Complete (
              <?php echo number_format($totalPercentageAll, 2); ?>%)
            </h4>
          </div>
          <div class="icon">
            <i class="ion ion-ios-analytics-outline"></i>
          </div>
          <div class="chart-container">
            <canvas id="projectDonutChart1"></canvas>
          </div>
        </div>
      </div>

      <!-- Letakkan skrip Chart.js di bagian bawah -->
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script>
        // Data untuk grafik donut
        var projectDonutData1 = {
          labels: ["Complete", "Pending"],
          datasets: [{
            data: [<?php echo $totalPercentageAll; ?>, <?php echo 100 - $totalPercentageAll; ?>],
            backgroundColor: ["#00a65a", "#f39c12"],
          }]
        };
        // Konfigurasi grafik donut
        var projectDonutOptions = {
          maintainAspectRatio: false,
          responsive: true,
        };

        // Inisialisasi grafik donut
        var projectDonutChartCanvas1 = $('#projectDonutChart1').get(0).getContext('2d');
        var projectDonutChart1 = new Chart(projectDonutChartCanvas1, {
          type: 'doughnut',
          data: projectDonutData1,
          options: projectDonutOptions
        });
      </script>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <h4>
              Mold
            </h4>
            <h4>Total Complete (
              <?php echo number_format($totalPercentage, ); ?>%)
            </h4>
          </div>
          <div class="icon">
            <i class="ion ion-ios-analytics-outline"></i>
          </div>
          <a href="<?php echo base_url(); ?>Project1/project1Listing" class="small-box-footer">More info <i
              class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <h4>
              2nd Mold
            </h4>
            <h4>Total Complete (
              <?php echo number_format($totalPercentage2, ); ?>%)
            </h4>
          </div>
          <div class="icon">
            <i class="ion ion-ios-analytics-outline"></i>
          </div>
          <a href="<?php echo base_url(); ?>Project2/project2Listing" class="small-box-footer">More info <i
              class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <h4>
              Blowpin
            </h4>
            <h4>Total Complete (
              <?php echo number_format($totalPercentage3, ); ?>%)
            </h4>
          </div>
          <div class="icon">
            <i class="ion ion-ios-analytics-outline"></i>
          </div>
          <a href="<?php echo base_url(); ?>Project3/project3Listing" class="small-box-footer">More info <i
              class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <h4>
              DIEPIN
            </h4>
            <h4>Total Complete (
              <?php echo number_format($totalPercentage4, ); ?>%)
            </h4>
          </div>
          <div class="icon">
            <i class="ion ion-ios-analytics-outline"></i>
          </div>
          <a href="<?php echo base_url(); ?>Project4/project4Listing" class="small-box-footer">More info <i
              class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
    </div><!-- /.row -->
  </section><!-- /.content -->

</div><!-- /.content-wrapper -->