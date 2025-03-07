<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>

    <!-- Card Total Produk -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Produk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalProduk; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kategori iOS -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Kategori iOS</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $kategoriIos; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-apple-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kategori Android -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Kategori Android</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $kategoriAndroid; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-android fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row for Charts -->
    <div class="row">
        <!-- Kategori Chart (Bar) -->
        <div class="col-xl-8 col-lg-7 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <h5 class="text-xs font-weight-bold text-gray-800">Kategori Produk</h5>
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <h5 class="text-xs font-weight-bold text-gray-800">Distribusi Kategori</h5>
                    <canvas id="myPieChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Bar Chart
var ctx = document.getElementById('categoryChart').getContext('2d');
var categoryChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['iOS', 'Android'],
        datasets: [{
            label: 'Jumlah Produk',
            data: [<?= $kategoriIos; ?>, <?= $kategoriAndroid; ?>],
            backgroundColor: ['#00ff00','#f6c23e'],
            borderColor: ['#4e73df', '#f6c23e'],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true, // Set to true
        scales: {
            x: {
                beginAtZero: true
            },
            y: {
                beginAtZero: true
            }
        }
    }
});

// Pie Chart
var ctxPie = document.getElementById("myPieChart").getContext('2d');
var myPieChart = new Chart(ctxPie, {
    type: 'doughnut',
    data: {
        labels: ["iOS", "Android"],
        datasets: [{
            data: [<?= $kategoriIos; ?>, <?= $kategoriAndroid; ?>],
            backgroundColor: ['#00ff00', '#f6c23e'],
            hoverBackgroundColor: ['#2e59d9', '#f6b400'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true, // Set to true
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});

</script>

<?= $this->endSection() ?>
