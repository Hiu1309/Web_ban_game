<?php
include_once 'data.php';
$data = new Data();

$currentMonth = date('Y-m');
$last6MonthImports = $data->getImportStatsLast6Months();
$topProducts = $data->getTop5ProductsByMonth($currentMonth);
$games = $data->getAllGame();
$daban = $data->getAllChiTietHoaDon();
?>

<div class="chart-container">
    <div class="stat-container">
        <div class="select-container">
            <label for="ChartSelect" class="select-label">Chọn biểu đồ</label>
            <select id="ChartSelect" class="chart-select">
                <option value="importTotal">Chi phí nhập kho 6 tháng qua</option>
                <option value="topProduct">Top sản phẩm bán chạy</option>
            </select>
            <div class="select-container" id="monthWrapper" style="display: none;">
            <label for="MonthSelect" class="select-label">Chọn tháng</label>
            <input type="month" id="MonthSelect" class="chart-select" value="<?= $currentMonth ?>">
        </div>
        </div>
        
        <div class="stat-item">
            <h3 class="stat-title">Game</h3>
            <div class="stat-value"><?= count($games) ?></div>
        </div>
        <div class="stat-item">
            <h3 class="stat-title">Đã bán</h3>
            <div class="stat-value"><?= count($daban) ?></div>
        </div>
    </div>

    <div class="chart-wrapper">
        <canvas id="importTotalChart"></canvas>
        <canvas id="topProductChart" style="display: none;"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const chartSelect = document.getElementById('ChartSelect');
    const monthInput = document.getElementById('MonthSelect');
    const monthWrapper = document.getElementById('monthWrapper');

    const charts = {
        importTotal: document.getElementById('importTotalChart'),
        topProduct: document.getElementById('topProductChart')
    };

    function hideAllCharts() {
        Object.values(charts).forEach(chart => chart.style.display = 'none');
    }

    chartSelect.addEventListener('change', () => {
        const selected = chartSelect.value;
        hideAllCharts();
        charts[selected].style.display = 'block';
        monthWrapper.style.display = (selected === 'topProduct') ? 'flex' : 'none';
    });

    let topProductChart;

    document.addEventListener('DOMContentLoaded', function () {
        monthWrapper.style.display = 'none';

        new Chart(charts.importTotal, {
            type: 'line',
            data: {
                labels: <?= json_encode(array_column($last6MonthImports, 'month')) ?>,
                datasets: [{
                    label: 'Chi phí nhập kho theo tháng',
                    data: <?= json_encode(array_column($last6MonthImports, 'total_import')) ?>,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderWidth: 2,
                    tension: 0.4
                }]
            }
        });

        topProductChart = new Chart(charts.topProduct, {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_column($topProducts, 'ProductName')) ?>,
                datasets: [{
                    label: 'Top sản phẩm bán chạy',
                    data: <?= json_encode(array_column($topProducts, 'totalSold')) ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            }
        });
    });

    monthInput.addEventListener('change', () => {
        const selectedMonth = monthInput.value;
        fetch(`../../doanhnghiep/DN.php?topProductMonth=${selectedMonth}`)
            .then(res => res.json())
            .then(data => {
                topProductChart.data.labels = data.map(item => item.ProductName);
                topProductChart.data.datasets[0].data = data.map(item => item.totalSold);
                topProductChart.update();
            });
    });
</script>

<style>
.chart-container {
    padding: 60px 10%;
}
.stat-container {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 20px;
    margin-bottom: 20px;
}
.select-container {
    display: flex;
    flex-direction: column;
    width: 50%;
}
.select-label {
    font-size: 14px;
    color: #4A4A4A;
    margin-bottom: 6px;
}
.chart-select {
    border: 1px solid #D1D5DB;
    border-radius: 8px;
    padding: 8px 16px;
    width: 290px;
    font-size: 16px;
}
.chart-wrapper {
    background-color: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
.stat-item {
    background-color: white;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    flex: 1; 
    margin: 0 10px;
}
.stat-title {
    font-size: 18px;
    font-weight: 600;
    color: #4A4A4A;
}
.stat-value {
    font-size: 36px;
    font-weight: 700;
    color: #1E40AF; 
    margin-top: 10px;
}
</style>
