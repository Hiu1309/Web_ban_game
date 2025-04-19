const accountInfo = document.getElementById('accountInfo');
const accountModal = document.getElementById('accountModal');
const closeModal = document.getElementById('closeModal');
const changePasswordBtn = document.getElementById('changePasswordBtn');

accountInfo.addEventListener('click', () => {
    accountModal.classList.remove('hidden');
});

closeModal.addEventListener('click', () => {
    accountModal.classList.add('hidden');
});

changePasswordBtn.addEventListener('click', () => {
    alert('Chức năng đổi mật khẩu đang phát triển.');
    //  thêm ajax ở đây
});

const menuToggle = document.getElementById('menuToggle');
const sideMenu = document.getElementById('sideMenu');

menuToggle.addEventListener('click', function () {
    sideMenu.classList.toggle('hidden');
});

document.addEventListener('click', function (e) {
    if (!menuToggle.contains(e.target) && !sideMenu.contains(e.target)) {
        sideMenu.classList.add('hidden');
    }
});