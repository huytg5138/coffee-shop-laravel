let cart = [];

function normalizeText(text) {
    return (text || '')
        .toString()
        .toLowerCase()
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '');
}

function setupProductSearch() {
    const searchInput = document.getElementById('pos-search');
    const productItems = document.querySelectorAll('.product-item');

    if (!searchInput || productItems.length === 0) return;

    searchInput.addEventListener('input', function () {
        const keyword = normalizeText(this.value.trim());

        productItems.forEach(item => {
            const productName = normalizeText(item.dataset.name);
            const isMatch = productName.includes(keyword);
            item.style.display = isMatch ? '' : 'none';
        });
    });
}

function addToCart(id, name, price) {
    // Tìm xem món đã có trong giỏ hàng chưa
    let item = cart.find(i => i.id === id);
    if (item) {
        item.quantity++;
    } else {
        cart.push({ id, name, price, quantity: 1 });
    }
    renderCart();
}

function removeFromCart(id) {
    cart = cart.filter(i => i.id !== id);
    renderCart();
}

function renderCart() {
    let html = '';
    let total = 0;

    cart.forEach(item => {
        let subtotal = item.price * item.quantity;
        total += subtotal;
        html += `
            <tr>
                <td>${item.name}</td>
                <td>
                    <input type="number" class="form-control form-control-sm" value="${item.quantity}" 
                    onchange="updateQty(${item.id}, this.value)">
                </td>
                <td>${subtotal.toLocaleString()}đ</td>
                <td><button class="btn btn-sm btn-outline-danger" onclick="removeFromCart(${item.id})">×</button></td>
            </tr>
        `;
    });

    document.getElementById('cart-body').innerHTML = html;
    document.getElementById('total-amount').innerHTML = total.toLocaleString() + 'đ';
}

function updateQty(id, qty) {
    let item = cart.find(i => i.id === id);
    if (item) {
        item.quantity = parseInt(qty);
        if (item.quantity <= 0) removeFromCart(id);
    }
    renderCart();
}

function checkout() {
    if (cart.length === 0) {
        alert("Vui lòng chọn ít nhất một món đồ uống!");
        return;
    }

    let total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);

    // Gửi dữ liệu về Server bằng AJAX - Dùng đường dẫn trực tiếp
    fetch('/checkout', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            cart: cart,
            total_amount: total
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("🎉 " + data.message);
            cart = []; 
            renderCart(); 
        } else {
            alert("❌ Lỗi: " + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("Có lỗi xảy ra trong quá trình thanh toán!");
    });
}

// Expose functions to global scope (required when loaded as ES Module by Vite)
window.addToCart = addToCart;
window.removeFromCart = removeFromCart;
window.updateQty = updateQty;
window.checkout = checkout;

document.addEventListener('DOMContentLoaded', setupProductSearch);