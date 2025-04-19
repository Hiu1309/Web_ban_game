<?php
include_once 'data.php';
$data = new Data();

// AJAX xử lý top khách hàng
if (isset($_GET['month'])) {
    $month = $_GET['month'];
    $top5User = $data->getTop5CustomersByMonth($month);
    echo json_encode($top5User);
    exit();
}

// AJAX xử lý top nhân viên
if (isset($_GET['topStaffMonth'])) {
    $month = $_GET['topStaffMonth'];
    $topStaff = $data->getTop5StaffByMonth($month);
    echo json_encode($topStaff);
    exit();
}

// Mặc định khi không có AJAX
$currentMonth = date('Y-m');
$top5User = $data->getTop5CustomersByMonth($currentMonth);
$top5Staff = $data->getTop5StaffByMonth($currentMonth);

$games = $data->getAllGame();
$users = $data->getAllUser();
$allHoaDon = $data->getAllHoaDon();
$daban = $data->getAllChiTietHoaDon();
$last6MonthSales = $data->getOrderStatsLast6Months();
$last6MonthImports = $data->getImportStatsLast6Months();
$last6MonthCount = $data->getLast6MonthsTotal();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thống kê - Quản lí doanh nghiệp</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen">
    <header class="bg-blue-600 text-white p-6 shadow-md mb-8">
        <h1 class="text-3xl font-bold text-center">Quản lí doanh nghiệp</h1>
        <div class="flex items-center gap-4 relative">
            <div id="menuToggle" class="cursor-pointer text-3xl">
                <i class="fa-solid fa-bolt"></i>
            </div>
            <div id="accountInfo" class="cursor-pointer text-3xl">
                <i class="fa-solid fa-user"></i>
            </div>
            <div id="sideMenu" class="absolute top-10 left-0 bg-white shadow-lg rounded-lg border border-gray-200 w-40 p-3 hidden z-50 font-[Cambria] hover:block">
                <ul class="flex flex-col space-y-3">
                    <li>
                        <button class="w-full text-left px-3 py-2 text-gray-800 hover:bg-blue-100 hover:text-blue-700 rounded transition">
                            Nhân viên
                        </button>
                    </li>
                    <li>
                        <button class="w-full text-left px-3 py-2 text-gray-800 hover:bg-blue-100 hover:text-blue-700 rounded transition">
                            Kho
                        </button>
                    </li>
                    <li>
                        <button class="w-full text-left px-3 py-2 text-gray-800 hover:bg-blue-100 hover:text-blue-700 rounded transition">
                            Cửa hàng
                        </button>
                    </li>
                </ul>
                <hr class="my-3 opacity-50">
                <button class="w-full text-left px-3 py-2 text-red-600 hover:text-white hover:bg-red-500 rounded transition font-semibold">
                    Đăng xuất
                </button>
            </div>
        </div>
    </header>

<div id="accountModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white px-14 py-10 rounded-lg shadow-lg w-full max-w-md relative">
        <h2 class="text-2xl font-semibold mb-6">Thông tin người quản lí</h2>

        <div class="mb-6">
            <label for="username" class="font-bold block mb-1">Tên đăng nhập:</label>
            <input type="text" id="username" value="Nguyễn Văn A" readonly class="w-full border border-gray-300 rounded-md p-2">
        </div>

        <hr class="mb-6">
        <div class="mb-6">
            <p class="font-bold mb-3">Đổi mật khẩu</p>
            <div class="flex flex-col items-center gap-4">
                <input type="password" placeholder="Mật khẩu cũ" class="w-full border border-gray-300 rounded-md p-2">
                <input type="password" placeholder="Mật khẩu mới" class="w-full border border-gray-300 rounded-md p-2">
                <input type="password" placeholder="Nhập lại mật khẩu" class="w-full border border-gray-300 rounded-md p-2">
            </div>
        </div>

        <hr class="mb-4">

        <div class="flex justify-between items-center">
            <button id="closeModal" class="w-2/5 p-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">Thoát</button>
            <button id="changePasswordBtn" class="w-2/5 p-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Đổi mật khẩu</button>
        </div>
    </div>
</div>
    <div class="max-w-7xl mx-auto px-4" style="margin-bottom: 100px;" >
        <!-- Tổng quan -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <?php
            $stats = [
                'Game' => count($games),
                'Đơn hàng' => count($allHoaDon),
                'Khách hàng' => count($users),
                'Đã bán' => count($daban),
            ];
            foreach ($stats as $title => $count) {
                echo "
                <div class='bg-white shadow-md rounded-lg p-6 text-center'>
                    <h3 class='text-lg font-semibold text-gray-700'>{$title}</h3>
                    <div class='text-4xl font-bold text-blue-500 mt-2'>{$count}</div>
                </div>";
            }
            ?>
        </div>
        <!-- Chọn biểu đồ -->
        <div class="mb-4">
            <label for="ChartSelect" class="block text-gray-700 font-medium mb-2">Chọn bảng</label>
            <select id="ChartSelect" class="border border-gray-300 rounded-md p-2 w-full sm:w-1/2" style="width: 250px;">
                <option value="salesCount">Đơn hàng 6 tháng qua</option>
                <option value="salesTotal">Doanh thu 6 tháng qua</option>
                <option value="importTotal">Chi phí nhập kho 6 tháng qua</option>
                <option value="topCustomer">Top khách hàng</option>
                <option value="topStaff">Top nhân viên duyệt đơn</option>
            </select>
            <div id="monthPickerWrapper" class="mb-4" style="display:none">
                <label for="TimeSelect" class="block text-gray-700 font-medium mb-2">Chọn tháng/năm</label>
                <input type="month" id="TimeSelect" class="border border-gray-300 rounded-md p-2 w-full sm:w-1/2" style="width: 250px;">
            </div>
        </div>
        <!-- Vùng hiển thị biểu đồ -->
        <div class="bg-white p-6 rounded shadow">
            <canvas id="salesCountChart"></canvas>
            <canvas id="topCustomerChart" style="display: none;"></canvas>
            <canvas id="salesTotalChart" style="display: none;"></canvas>
            <canvas id="importTotalChart" style="display: none;"></canvas>
            <canvas id="topStaffChart" style="display: none;"></canvas>
        </div>
    </div>
    <script>
        const chartSelect = document.getElementById('ChartSelect');
        const charts = {
            salesCount: document.getElementById('salesCountChart'),
            topCustomer: document.getElementById('topCustomerChart'),
            salesTotal: document.getElementById('salesTotalChart'),
            importTotal: document.getElementById('importTotalChart'),
            topStaff: document.getElementById('topStaffChart'),
        };
        const monthPickerWrapper = document.getElementById('monthPickerWrapper');
        const timeSelect = document.getElementById('TimeSelect');
        function hideAllCharts() {
            Object.values(charts).forEach(chart => chart.style.display = 'none');
        }
        chartSelect.addEventListener('change', function () {
            hideAllCharts();
            const selected = this.value;
            charts[selected].style.display = 'block';
            monthPickerWrapper.style.display = (selected === 'topCustomer' || selected === 'topStaff') ? 'block' : 'none';
        });
        // Biến toàn cục lưu biểu đồ
        let topCustomerChart, topStaffChart;
        document.addEventListener('DOMContentLoaded', function () {
            // Mặc định
            const currentMonth = new Date().toISOString().slice(0, 7);
            timeSelect.value = currentMonth;
            hideAllCharts();
            charts.salesCount.style.display = 'block';
            // Biểu đồ số đơn hàng
            new Chart(charts.salesCount, {
                type: 'bar',
                data: {
                    labels: <?= json_encode(array_column($last6MonthCount, 'month')) ?>,
                    datasets: [{
                        label: 'Số lượng đơn hàng theo tháng',
                        data: <?= json_encode(array_column($last6MonthCount, 'total_bill')) ?>,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                }
            });
            // Biểu đồ khách hàng
            topCustomerChart = new Chart(charts.topCustomer, {
                type: 'bar',
                data: {
                    labels: <?= json_encode(array_column($top5User, 'Fullname')) ?>,
                    datasets: [{
                        label: 'Top khách hàng',
                        data: <?= json_encode(array_column($top5User, 'totalSpent')) ?>,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                }
            });
            // Biểu đồ nhân viên
            topStaffChart = new Chart(charts.topStaff, {
                type: 'bar',
                data: {
                    labels: <?= json_encode(array_column($top5Staff, 'Fullname')) ?>,
                    datasets: [{
                        label: 'Top nhân viên duyệt đơn',
                        data: <?= json_encode(array_column($top5Staff, 'totalApproved')) ?>,
                        backgroundColor: 'rgba(153, 102, 255, 0.5)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }]
                }
            });
            // Biểu đồ doanh thu
            new Chart(charts.salesTotal, {
                type: 'line',
                data: {
                    labels: <?= json_encode(array_column($last6MonthSales, 'month')) ?>,
                    datasets: [{
                        label: 'Doanh thu theo tháng',
                        data: <?= json_encode(array_column($last6MonthSales, 'total_sales')) ?>,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 2,
                        tension: 0.4
                    }]
                }
            });
            // Biểu đồ nhập kho
            new Chart(charts.importTotal, {
                type: 'line',
                data: {
                    labels: <?= json_encode(array_column($last6MonthImports, 'month')) ?>,
                    datasets: [{
                        label: 'Chi phí nhập kho theo tháng',
                        data: <?= json_encode(array_column($last6MonthImports, 'total_import')) ?>,
                        borderColor: 'rgba(255, 206, 86, 1)',
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        borderWidth: 2,
                        tension: 0.4
                    }]
                }
            });
        });
        // Cập nhật khi đổi tháng
        timeSelect.addEventListener('change', function () {
            const selectedMonth = this.value;
            if (chartSelect.value === 'topCustomer') {
                fetch(`DN.php?month=${selectedMonth}`)
                    .then(res => res.json())
                    .then(data => {
                        topCustomerChart.data.labels = data.map(item => item.Fullname);
                        topCustomerChart.data.datasets[0].data = data.map(item => item.totalSpent);
                        topCustomerChart.update();
                    });
            } else if (chartSelect.value === 'topStaff') {
                fetch(`DN.php?topStaffMonth=${selectedMonth}`)
                    .then(res => res.json())
                    .then(data => {
                        topStaffChart.data.labels = data.map(item => item.Fullname);
                        topStaffChart.data.datasets[0].data = data.map(item => item.totalApproved);
                        topStaffChart.update();
                    });
            }
        });

    </script>
</body>
</html>


<style>
    body {
        font-family: Georgia, serif;
    }

    hr {
        border-color: rgba(0, 0, 0, 0.1);
    }

    input[readonly] {
        background-color: #f9f9f9;
    }
</style>

    <script src="dn.js"></script>
