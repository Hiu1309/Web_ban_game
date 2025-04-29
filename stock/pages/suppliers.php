<!-- suppliers.php -->
<div id="supplierContainer">
    <h2>Quản lý nhà cung cấp</h2>
    <div style="margin-bottom: 10px;">
        <button id="showAddForm">➕ Thêm nhà cung cấp</button>
    </div>

    <!-- Overlay form popup -->
    <div id="supplierFormSection" class="supplier-form-overlay">
        <div class="form-box">
            <h2>Nhà cung cấp mới</h2>
            <form id="supplierForm">
                <div class="form-row">
                    <div class="form-icon"><i class="fa-solid fa-code"></i></div>
                    <input type="text" name="SupplierID" placeholder="Mã NCC" required />
                </div>
                <div class="form-row">
                    <div class="form-icon"><i class="fa-solid fa-user"></i></div>
                    <input type="text" name="SupplierName" placeholder="Tên nhà cung cấp" required />
                </div>
                <div class="form-row">
                    <div class="form-icon"><i class="fa-solid fa-location-dot"></i></div>
                    <input type="text" name="Address" placeholder="Địa chỉ" required />
                </div>
                <div class="form-row double-input">
                    <div class="form-icon"><i class="fa-solid fa-phone"></i></div>
                    <input type="text" name="Phone" placeholder="SDT" class="only-number" required />
                    <input type="email" name="Email" placeholder="Email" required />
                </div>
                <div class="form-row double-input">
                    <div class="form-icon"></div>
                    <button type="button" class="btn-outline" id="cancelAddForm">Quay lại</button>
                    <button type="submit" class="btn-primary">Xác nhận</button>
                </div>
            </form>
        </div>
    </div>

    <div id="supplierTable">Đang tải dữ liệu...</div>
</div>

<!-- Load jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Script xử lý -->
<script>
$(document).on('input', '.only-number', function () {
    this.value = this.value.replace(/[^0-9]/g, '');
});

function loadSuppliers(page = 1) {
    $.get("pages/supplier_load.php", { page }, function (data) {
        $("#supplierTable").html(data);
    });
}

$(document).ready(function () {
    loadSuppliers();

    // Hiển thị form thêm mới khi nhấn nút
    $('#showAddForm').on('click', function () {
        $('#supplierFormSection').addClass('show'); // dùng class để bật display:flex
        $('#showAddForm').hide();
    });

    // Hủy thêm nhà cung cấp (quay lại)
    $('#cancelAddForm').on('click', function () {
        $('#supplierForm')[0].reset();
        $('#supplierFormSection').removeClass('show');
        $('#showAddForm').show();
    });

    // Lưu nhà cung cấp
    $('#supplierForm').on('submit', function (e) {
        e.preventDefault();
        const data = {
            action: 'add',
            SupplierID: $('input[name="SupplierID"]').val(),
            SupplierName: $('input[name="SupplierName"]').val(),
            Address: $('input[name="Address"]').val(),
            Phone: $('input[name="Phone"]').val(),
            Email: $('input[name="Email"]').val()
        };
        $.post('pages/supplier_load.php', data, function () {
            loadSuppliers();
            $('#supplierForm')[0].reset();
            $('#supplierFormSection').removeClass('show');
            $('#showAddForm').show();
        });
    });

    // Xóa nhà cung cấp
    $('#supplierContainer').on('click', '.delete-btn', function () {
        if (!confirm('Xóa nhà cung cấp này?')) return;
        const id = $(this).data('id');
        $.post('pages/supplier_load.php', { action: 'delete', SupplierID: id }, function () {
            loadSuppliers();
        });
    });

    // Sửa nhà cung cấp
    $('#supplierContainer').on('click', '.edit-btn', function () {
        const row = $(this).closest('tr');
        const tds = row.find('td');

        row.data('originalHTML', row.html());

        const data = {
            SupplierID: tds.eq(0).text().trim(),
            SupplierName: tds.eq(1).text().trim(),
            Address: tds.eq(2).text().trim(),
            Phone: tds.eq(3).text().trim(),
            Email: tds.eq(4).text().trim()
        };

        row.html(`
            <td>${data.SupplierID}</td>
            <td><input type="text" name="SupplierName" value="${data.SupplierName}"></td>
            <td><input type="text" name="Address" value="${data.Address}"></td>
            <td><input type="text" name="Phone" value="${data.Phone}" class="only-number"></td>
            <td><input type="text" name="Email" value="${data.Email}"></td>
            <td>
                <button class="save-edit">💾</button>
                <button class="cancel-edit">❌</button>
            </td>
        `);
    });

    // Hủy sửa
    $('#supplierContainer').on('click', '.cancel-edit', function () {
        const row = $(this).closest('tr');
        row.html(row.data('originalHTML'));
    });

    // Lưu sửa
    $('#supplierContainer').on('click', '.save-edit', function () {
        const row = $(this).closest('tr');
        const data = {
            action: 'edit',
            SupplierID: row.find('td').eq(0).text().trim(),
            SupplierName: row.find('input[name="SupplierName"]').val(),
            Address: row.find('input[name="Address"]').val(),
            Phone: row.find('input[name="Phone"]').val(),
            Email: row.find('input[name="Email"]').val()
        };
        $.post('pages/supplier_load.php', data, function () {
            loadSuppliers();
        });
    });

    // Phân trang
    $('#supplierContainer').on('click', '.page-link', function () {
        const page = $(this).data('page');
        loadSuppliers(page);
    });
});
</script>
