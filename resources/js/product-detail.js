
let selectedColor = null;
let selectedStorage = null;

// Đổi ảnh chính khi chọn màu
document.querySelectorAll('.color-option').forEach(btn => {
    btn.addEventListener('click', function () {
        document.querySelectorAll('.color-option').forEach(b => {
            b.classList.remove('ring-2', 'ring-blue-500', 'bg-blue-50', 'text-blue-700', 'border-blue-500');
        });

        this.classList.add('ring-2', 'ring-blue-500', 'bg-blue-50', 'text-blue-700', 'border-blue-500');

        selectedColor = this.dataset.color;
        const newImage = this.dataset.image;
        document.getElementById('main-image').src = newImage;

        updatePrice();
    });
});

// Đổi ảnh chính khi bấm ảnh nhỏ
document.querySelectorAll('.variant-thumb').forEach(img => {
    img.addEventListener('click', function () {
        const newImage = this.dataset.image;
        if (newImage) {
            document.getElementById('main-image').src = newImage;
        } else {
            console.error('Không tìm thấy data-image');
        }
    });
});

// Cập nhật giá khi chọn dung lượng
document.querySelectorAll('.storage-option').forEach(btn => {
    btn.addEventListener('click', function () {
        document.querySelectorAll('.storage-option').forEach(b => {
            b.classList.remove('ring-2', 'ring-blue-500', 'bg-blue-50', 'text-blue-700', 'border-blue-500');
        });

        this.classList.add('ring-2', 'ring-blue-500', 'bg-blue-50', 'text-blue-700', 'border-blue-500');

        selectedStorage = this.dataset.storage;
        updatePrice();
    });
    // Chọn mặc định nút dung lượng đầu tiên
    const firstStorageBtn = document.querySelector('.storage-option');
    if (firstStorageBtn) {
        firstStorageBtn.click(); // Kích hoạt sự kiện click để gán selectedStorage và cập nhật giá
    }

});

function updatePrice() {
    const productData = document.getElementById('product-data');
    const variants = JSON.parse(productData.dataset.variants);

    let variant = null;

    if (selectedColor && selectedStorage) {
        variant = variants.find(v => v.color.id == selectedColor && v.storage.id == selectedStorage);
    } else if (selectedColor) {
        variant = variants.find(v => v.color.id == selectedColor);
    } else if (selectedStorage) {
        variant = variants.find(v => v.storage.id == selectedStorage);
    }

    if (variant) {
        const price = parseFloat(variant.price);
        const discount = parseFloat(variant.discount);
        const finalPrice = price * (1 - discount / 100);

        document.getElementById('price-final').innerText = finalPrice.toLocaleString('vi-VN') + '₫';
        if (discount > 0) {
            document.getElementById('price-original').innerText = price.toLocaleString('vi-VN') + '₫';
            document.getElementById('discount-percent').innerText = `-${discount}%`;
        } else {
            document.getElementById('price-original').innerText = '';
            document.getElementById('discount-percent').innerText = '';
        }
    } else {
        // Nếu không tìm thấy variant phù hợp, có thể xóa giá hoặc hiển thị mặc định
        document.getElementById('price-final').innerText = 'Không có giá';
        document.getElementById('price-original').innerText = '';
        document.getElementById('discount-percent').innerText = '';
    }
}

// Xử lý tab chuyển đổi
document.getElementById('tab-specs').addEventListener('click', function () {
    // Toggle active class
    this.classList.add('text-blue-600', 'border-blue-600');
    this.classList.remove('text-gray-600');
    document.getElementById('tab-reviews').classList.remove('text-blue-600', 'border-blue-600');
    document.getElementById('tab-reviews').classList.add('text-gray-600');

    // Hiện thông số kỹ thuật, ẩn đánh giá
    document.getElementById('tab-content-specs').classList.remove('hidden');
    document.getElementById('tab-content-reviews').classList.add('hidden');
});

document.getElementById('tab-reviews').addEventListener('click', function () {
    // Toggle active class
    this.classList.add('text-blue-600', 'border-blue-600');
    this.classList.remove('text-gray-600');
    document.getElementById('tab-specs').classList.remove('text-blue-600', 'border-blue-600');
    document.getElementById('tab-specs').classList.add('text-gray-600');

    // Hiện bài đánh giá, ẩn thông số
    document.getElementById('tab-content-specs').classList.add('hidden');
    document.getElementById('tab-content-reviews').classList.remove('hidden');
});

