<?php
include_once 'data.php';
$data = new Data();

$games = $data->getAllGame();
$users = $data->getAllUser();
$allHoaDon = $data->getAllHoaDon();
$daban = $data->getAllChiTietHoaDon();
$top5User = $data->getTop5Customers();
$last6MonthSales = $data->getOrderStatsLast6Months();
$last6MonthImports = $data->getImportStatsLast6Months();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thống kê - Quản lí doanh nghiệp</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Header -->
    <header class="bg-blue-600 text-white p-6 shadow-md mb-8">
        <h1 class="text-3xl font-bold text-center">Quản lí doanh nghiệp</h1>
    </header>

    <!-- Main content -->
    <div class="max-w-7xl mx-auto px-4" style="margin-bottom: 100px;">
        <!-- Thống kê tổng quan -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                <h3 class="text-lg font-semibold text-gray-700">Game</h3>
                <div class="text-4xl font-bold text-blue-500 mt-2"><?= count($games) ?></div>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                <h3 class="text-lg font-semibold text-gray-700">Đơn hàng</h3>
                <div class="text-4xl font-bold text-blue-500 mt-2"><?= count($allHoaDon) ?></div>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                <h3 class="text-lg font-semibold text-gray-700">Khách hàng</h3>
                <div class="text-4xl font-bold text-blue-500 mt-2"><?= count($users) ?></div>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                <h3 class="text-lg font-semibold text-gray-700">Đã bán</h3>
                <div class="text-4xl font-bold text-blue-500 mt-2"><?= count($daban) ?></div>
            </div>
        </div>

        <!-- Chọn loại biểu đồ -->
        <div class="mb-4">
            <label for="ChartSelect" class="block text-gray-700 font-medium mb-2">Chọn biểu đồ</label>
            <select id="ChartSelect" class="border border-gray-300 rounded-md p-2 w-full sm:w-1/2"  style="width: 250px;">
                <option value="salesCount">Số đơn hàng 6 tháng qua</option>
                <option value="topCustomer">Top khách hàng</option>
                <option value="salesTotal">Giá trị bán theo tháng</option>
                <option value="importTotal">Giá trị nhập kho theo tháng</option>
            </select>
        </div>

        <!-- Biểu đồ -->
        <div class="bg-white p-6 rounded shadow">
            <canvas id="salesCountChart"></canvas>
            <canvas id="topCustomerChart" style="display: none;"></canvas>
            <canvas id="salesTotalChart" style="display: none;"></canvas>
            <canvas id="importTotalChart" style="display: none;"></canvas>
        </div>
    </div>

    <!-- Script -->
    <script>
        const chartSelect = document.getElementById('ChartSelect');
        const charts = {
            salesCount: document.getElementById('salesCountChart'),
            topCustomer: document.getElementById('topCustomerChart'),
            salesTotal: document.getElementById('salesTotalChart'),
            importTotal: document.getElementById('importTotalChart'),
        };

        function hideAllCharts() {
            Object.values(charts).forEach(chart => chart.style.display = 'none');
        }

        chartSelect.addEventListener('change', function () {
            hideAllCharts();
            charts[this.value].style.display = 'block';
        });

        document.addEventListener('DOMContentLoaded', function () {
            hideAllCharts();
            charts.salesCount.style.display = 'block';

            new Chart(charts.salesCount, {
                type: 'line',
                data: {
                    labels: <?= json_encode(array_column($last6MonthSales, 'month')) ?>,
                    datasets: [{
                        label: 'Số đơn hàng 6 tháng qua',
                        data: <?= json_encode(array_column($last6MonthSales, 'total_sales')) ?>,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderWidth: 2,
                        tension: 0.4
                    }]
                }
            });

            new Chart(charts.topCustomer, {
                type: 'bar',
                data: {
                    labels: <?= json_encode(array_column($top5User, 'Fullname')) ?>,
                    datasets: [{
                        label: 'Top khách hàng (Chi tiêu nhiều nhất)',
                        data: <?= json_encode(array_column($top5User, 'totalSpent')) ?>,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                }
            });

            new Chart(charts.salesTotal, {
                type: 'line',
                data: {
                    labels: <?= json_encode(array_column($last6MonthSales, 'month')) ?>,
                    datasets: [{
                        label: 'Giá trị đơn hàng theo tháng',
                        data: <?= json_encode(array_column($last6MonthSales, 'total_sales')) ?>,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 2,
                        tension: 0.4
                    }]
                }
            });

            new Chart(charts.importTotal, {
                type: 'line',
                data: {
                    labels: <?= json_encode(array_column($last6MonthImports, 'month')) ?>,
                    datasets: [{
                        label: 'Giá trị nhập kho theo tháng',
                        data: <?= json_encode(array_column($last6MonthImports, 'total_import')) ?>,
                        borderColor: 'rgba(255, 206, 86, 1)',
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        borderWidth: 2,
                        tension: 0.4
                    }]
                }
            });
        });
    </script>
</body>
</html>
