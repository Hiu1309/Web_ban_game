    <!-- Header + Nút thêm -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; min-width: 1200px;">
        <div style="display: flex; align-items: center; gap: 20px;">
            <h2 style="margin: 0;">Quản lý sản phẩm</h2>
            <form id="searchForm" method="GET" style="margin: 0;">
                <input type="text" name="keyword" placeholder=" Tìm theo mã sản phẩm..."
                       value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>"
                       style="padding: 8px; border-radius: 4px; border: 1px solid #ccc; width: 200px;">
                <button type="submit" style="padding: 8px 12px; margin-left: 5px;">Tìm</button>
            </form>
        </div>
    </div>
    <div style=" gap: 8px;">
            <button id="showAddRow">Thêm Sản Phẩm</button>
        </div>
    <!-- Bảng sản phẩm -->
    <div id="productTable">Đang tải dữ liệu...</div>
    


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).on('input', '.only-number', function () {
    this.value = this.value.replace(/[^0-9]/g, '');
});    
let currentPage      = 1;    
let currentSortField = '';
let currentSortOrder = '';
function loadProducts(page = 1, sortField = '', sortOrder = '') {
  // 1) cập nhật biến JS
  currentPage      = page;
  currentSortField = sortField;
  currentSortOrder = sortOrder;

  const keyword = $('input[name="keyword"]').val();
  return $.get("pages/load_products.php", {
      page, keyword, sortField, sortOrder
    })
    .done(function(data) {
      // 2) chèn HTML mới
      $("#productTable").html(data);

      // 3) cập nhật lại hidden totalPages (vừa AJAX-inject xong)
      const tp = $("#productTable").find("#totalPages").val();
      if (tp) {
        $("#totalPages").val(tp);
      }
    });
}
function getImageName(fullPath) {
    const parts = fullPath.split('/');
    let fileName = parts[parts.length - 1]; // lấy cyberpunk.jpg
    return fileName.replace('.jpg', ''); // bỏ .jpg
}


function fetchSuppliers(callback) {
    $.get("pages/get_suppliers.php", function (data) {
        callback(JSON.parse(data));
    });
}

function appendAddRow() {
    if ($('#addRow').length) return;
    fetchSuppliers(function (suppliers) {
      const supplierOptions = suppliers
        .map(s => `<option value="${s.SupplierID}">${s.SupplierID} - ${s.SupplierName}</option>`)
        .join('');
      const newRow = `
        <tr id="addRow">
          <td><input type="text" name="ProductID" placeholder="Mã SP" required></td>
          <td><input type="text" name="TypeID" placeholder="Mã loại"></td>
          <td><input type="text" name="ProductName" placeholder="Tên SP" required></td>
          <td><input type="text" name="ProductImg" placeholder="Tên ảnh"></td>
          <td><input type="text" name="Author" placeholder="Tác giả"></td>
          <td><input type="text" name="Publisher" placeholder="NXB"></td>
          <td><input type="text" name="Quantity" placeholder="SL" class="only-number"></td>
          <td><input type="text" name="Price" placeholder="Giá" required class="only-number"></td>
          <td><input type="text" name="Description" placeholder="Mô tả"></td>
          <td>
            <select name="SupplierID" required style="width: 120px;">
              <option value="">-- Chọn NCC --</option>
              ${supplierOptions}
            </select>
          </td>
          <td>
            <select name="Status">
              <option value="1">Hoạt động</option>
              <option value="0">Ngừng</option>
            </select>
          </td>
          <td>
            <button id="saveProduct">💾</button>
            <button id="cancelAdd">❌</button>
          </td>
        </tr>`;
      $("#productTable table tbody").append(newRow);
      $('#showAddRow').hide();
      $('#actionButtons').show();
      $('html, body').animate({
        scrollTop: $("#addRow").offset().top
      }, 300);
    });
  }

$(document).ready(function () {
    // load trang đầu tiên khi vào
    loadProducts(1, currentSortField, currentSortOrder);

    // tìm kiếm
    $('#searchForm').on('submit', function (e) {
      e.preventDefault();
      loadProducts(1, currentSortField, currentSortOrder);
});

$(document).on('click', '#showAddRow', function () {
  const tp = parseInt($('#totalPages').val(), 10);
  if (currentPage < tp) {
    // 1) nếu chưa phải trang cuối → AJAX load trang cuối rồi append form
    loadProducts(tp, currentSortField, currentSortOrder)
      .done(appendAddRow);
  } else {
    // 2) nếu đã ở trang cuối → chỉ append form
    appendAddRow();
  }
});
    $(document).on('click', '#cancelAdd', function () {
        $('#addRow').remove();
        $('#showAddRow').show();
        $('#actionButtons').hide();
    });

    $(document).on('click', '#saveProduct', function () {
        const row = $('#addRow');
        let imgName = row.find('input[name="ProductImg"]').val().trim();
        let fullImgPath = '';
        if (imgName !== '') {
        fullImgPath = `/Assets/Images/Game/${imgName}.jpg`;
        }
        const data = {
            action: 'add',
            ProductID: row.find('input[name="ProductID"]').val(),
            TypeID: row.find('input[name="TypeID"]').val(),
            ProductName: row.find('input[name="ProductName"]').val(),
            ProductImg: fullImgPath,
            Author: row.find('input[name="Author"]').val(),
            Publisher: row.find('input[name="Publisher"]').val(),
            Quantity: row.find('input[name="Quantity"]').val(),
            Price: row.find('input[name="Price"]').val(),
            Description: row.find('input[name="Description"]').val(),
            SupplierID: row.find('select[name="SupplierID"]').val(),
            Status: row.find('select[name="Status"]').val()
        };

        if (!data.ProductID || !data.ProductName || !data.Price || !data.SupplierID) {
            alert('Vui lòng nhập đầy đủ thông tin bắt buộc.');
            return;
        }

        $.post("pages/load_products.php", data, function () {
            loadProducts();
            $('#showAddRow').show();
            $('#actionButtons').hide();
        });
    });

    $(document).on('click', '.page-link', function (e) {
    e.preventDefault();
    const page = $(this).data('page');
    const sortField = $(this).data('sortfield') || '';
    const sortOrder = $(this).data('sortorder') || '';

    loadProducts(page, sortField, sortOrder);
});


$(document).on('click', '.sort-btn', function () {
    const clickedField = $(this).data('field');

    if (currentSortField === clickedField) {
        // Nếu đã sort rồi thì xoay vòng asc -> desc -> none
        if (currentSortOrder === '') {
            currentSortOrder = 'asc';
        } else if (currentSortOrder === 'asc') {
            currentSortOrder = 'desc';
        } else {
            currentSortOrder = '';
            currentSortField = ''; // reset luôn field
        }
    } else {
        // Nếu bấm sang cột khác thì bắt đầu từ asc
        currentSortField = clickedField;
        currentSortOrder = 'asc';
    }

    loadProducts(1, currentSortField, currentSortOrder);
});



    $(document).on('click', '.delete-btn', function (e) {
        e.preventDefault();
        if (confirm('Xóa sản phẩm này?')) {
            const id = $(this).data('id');
            $.post('pages/load_products.php', { action: 'delete', ProductID: id }, function () {
                loadProducts();
            });
        }
    });
});
$(document).on('click', '.edit-btn', function (e) {
        e.preventDefault();
        const row = $(this).closest('tr');
        const tds = row.find('td');
        const productData = {
            ProductID: tds.eq(0).text().trim(),
            TypeID: tds.eq(1).text().trim(),
            ProductName: tds.eq(2).text().trim(),
            ProductImg: tds.eq(3).find('img').attr('src'),
            Author: tds.eq(4).text().trim(),
            Publisher: tds.eq(5).text().trim(),
            Quantity: tds.eq(6).text().trim(),
            Price: tds.eq(7).text().trim(),
            Description: tds.eq(8).text().trim(),
            SupplierID: tds.eq(9).data('id'), // bạn cần gán data-id trong PHP
            Status: tds.eq(10).text().trim()
        };

        // Lưu HTML gốc để có thể hoàn tác
        row.data('originalHTML', row.html());
        $('tfoot').hide();
        fetchSuppliers(function (suppliers) {
            let supplierOptions = suppliers.map(s => {
                const selected = s.SupplierID == productData.SupplierID ? 'selected' : '';
                return `<option value="${s.SupplierID}" ${selected}>${s.SupplierID} - ${s.SupplierName}</option>`;
            }).join('');

            row.html(`
                <td>${productData.ProductID}</td>
                <td><input type="text" name="TypeID" value="${productData.TypeID}"></td>
                <td><input type="text" name="ProductName" value="${productData.ProductName}"></td>
                <td><input type="text" name="ProductImg" value="${productData.ProductImg}"></td>
                <td><input type="text" name="Author" value="${productData.Author}"></td>
                <td><input type="text" name="Publisher" value="${productData.Publisher}"></td>
                <td><input type="text" name="Quantity" value="${productData.Quantity}" class="only-number"></td>
                <td><input type="text" name="Price" value="${productData.Price}" class="only-number"></td>
                <td><input type="text" name="Description" value="${productData.Description}"></td>
                <td>
                    <select name="SupplierID">${supplierOptions}</select>
                </td>
                <td>
                    <select name="Status">
                        <option value="1" ${productData.Status == "1" ? 'selected' : ''}>Hoạt động</option>
                        <option value="0" ${productData.Status == "0" ? 'selected' : ''}>Ngừng</option>
                    </select>
                </td>
                <td>
                    <button class="save-edit-btn">Lưu</button>
                    <button class="cancel-edit-btn">Hủy</button>
                </td>
            `);
        });
    });

    $(document).on('click', '.cancel-edit-btn', function () {
        const row = $(this).closest('tr');
        const originalHTML = row.data('originalHTML');
        if (originalHTML) {
            row.html(originalHTML);
        }
        $('tfoot').hide();
    });

    $(document).on('click', '.save-edit-btn', function () {
        const row = $(this).closest('tr');
        const tds = row.find('td');
        const data = {
            action: 'edit',
            ProductID: tds.eq(0).text().trim(),
            TypeID: row.find('input[name="TypeID"]').val(),
            ProductName: row.find('input[name="ProductName"]').val(),
            ProductImg: row.find('input[name="ProductImg"]').val(),
            Author: row.find('input[name="Author"]').val(),
            Publisher: row.find('input[name="Publisher"]').val(),
            Quantity: row.find('input[name="Quantity"]').val(),
            Price: row.find('input[name="Price"]').val(),
            Description: row.find('input[name="Description"]').val(),
            SupplierID: row.find('select[name="SupplierID"]').val(),
            Status: row.find('select[name="Status"]').val()
        };

        $.post("pages/load_products.php", data, function () {
            loadProducts();
        });
    });

</script>

