document.addEventListener("DOMContentLoaded", function () {
  const searchParams = new URLSearchParams(window.location.search);
  const searchInput = document.getElementById("search-input");
  const searchButton = document.querySelector(".search-btn");
  const filterButtons = document.querySelectorAll(".filter-btn");
  const priceFilters = document.querySelectorAll(".price-filter");
  const priceButtons = document.querySelectorAll(".price-filter");

  // Lấy giá trị từ URL
  const currentKeyword = searchParams.get("query") || "";
  const currentType = searchParams.get("type") || "";
  const currentMinPrice = searchParams.get("minPrice") || "";
  const currentMaxPrice = searchParams.get("maxPrice") || "";

  // Hiển thị từ khóa tìm kiếm nếu có
  if (searchInput) searchInput.value = currentKeyword;

  function performSearch(type = "", minPrice = "", maxPrice = "") {
    let url = "/gui/shop.php?";
    if (currentKeyword) url += `query=${encodeURIComponent(currentKeyword)}&`;
    if (type) url += `type=${encodeURIComponent(type)}&`;
    if (minPrice && maxPrice)
      url += `minPrice=${minPrice}&maxPrice=${maxPrice}`;

    window.location.href = url;
  }

  // Xử lý tìm kiếm khi nhấn Enter
  if (searchInput) {
    searchInput.addEventListener("keypress", function (event) {
      if (event.key === "Enter") {
        event.preventDefault();
        window.location.href = `/gui/shop.php?query=${encodeURIComponent(
          searchInput.value
        )}`;
      }
    });
  }

  // Xử lý khi nhấn nút tìm kiếm
  if (searchButton) {
    searchButton.addEventListener("click", function () {
      window.location.href = `/gui/shop.php?query=${encodeURIComponent(
        searchInput.value
      )}`;
    });
  }

  // Xử lý khi chọn bộ lọc thể loại
  filterButtons.forEach((button) => {
    if (button.getAttribute("data-type") === currentType) {
      button.classList.add("active");
    }

    button.addEventListener("click", function (event) {
      event.preventDefault();
      const type = this.getAttribute("data-type");
      let url = "/gui/shop.php?";
      if (searchParams.get("query"))
        url += `query=${encodeURIComponent(searchParams.get("query"))}&`;
      if (type) url += `type=${encodeURIComponent(type)}`;
      window.location.href = url;
    });
  });

  // Xử lý khi chọn bộ lọc giá tiền
  priceFilters.forEach((button) => {
    const min = button.getAttribute("data-min");
    const max = button.getAttribute("data-max");

    if (min === currentMinPrice && max === currentMaxPrice) {
      button.classList.add("active");
    }

    button.addEventListener("click", function (event) {
      event.preventDefault();
      let url = "/gui/shop.php?";
      if (searchParams.get("query"))
        url += `query=${encodeURIComponent(searchParams.get("query"))}&`;
      if (searchParams.get("type"))
        url += `type=${encodeURIComponent(searchParams.get("type"))}&`;
      url += `minPrice=${min}&maxPrice=${max}`;

      window.location.href = url;
    });
  });

  priceButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const minPrice = this.getAttribute("data-min");
      const maxPrice = this.getAttribute("data-max");

      // Cập nhật URL với các tham số lọc
      const urlParams = new URLSearchParams(window.location.search);
      urlParams.set("minPrice", minPrice);
      urlParams.set("maxPrice", maxPrice);

      // Đánh dấu nút đang được chọn
      priceButtons.forEach((btn) => btn.classList.remove("active"));
      this.classList.add("active");

      // Chuyển hướng trang với bộ lọc giá mới
      window.location.search = urlParams.toString();
    });
  });

  // Đánh dấu nút active nếu đã có bộ lọc giá trong URL
  const urlParams = new URLSearchParams(window.location.search);
  const currentMin = urlParams.get("minPrice");
  const currentMax = urlParams.get("maxPrice");

  priceButtons.forEach((button) => {
    if (
      button.getAttribute("data-min") === currentMin &&
      button.getAttribute("data-max") === currentMax
    ) {
      button.classList.add("active");
    }
  });
});
