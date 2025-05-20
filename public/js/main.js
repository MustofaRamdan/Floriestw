document.addEventListener('DOMContentLoaded', function () {
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');

    navbarToggler.addEventListener('click', function () {
        navbarCollapse.classList.toggle('show');
    });
});

 function updateQuantity(button, delta) {
    const input = button.parentElement.querySelector('.quantity');
    const cartRow = button.closest('tr');
    const stock = parseInt(cartRow.dataset.stock);
    const errorMessage = cartRow.querySelector('.stock-error');
    const harga = parseInt(cartRow.querySelector('.harga').innerText);

    let quantity = parseInt(input.value) + delta;
    if (quantity < 1) quantity = 1;

    // Cek stok sebelum melanjutkan
    if (quantity > stock) {
        // Tampilkan pesan error
        if (errorMessage) {
            errorMessage.classList.remove('hidden');
        }
        return; // Batalkan proses jika stok tidak mencukupi
    }

    // Sembunyikan pesan error jika stok mencukupi
    if (errorMessage) {
        errorMessage.classList.add('hidden');
    }

    // Kirim request ke server
    const cartId = cartRow.querySelector('form').getAttribute('action').split('/').pop();

    fetch(`/cart/update-quantity/${cartId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ quantity: quantity }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update quantity di UI
            input.value = quantity;

            // Update subtotal
            const subtotal = harga * quantity;
            cartRow.querySelector('.subtotal').innerText = subtotal;

            // Update total harga
            updateTotalHarga();
        } else {
            alert('Gagal mengupdate quantity.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengupdate quantity.');
    });
}

function updateTotalHarga() {
    const subtotals = document.querySelectorAll('.subtotal');
    let total = 0;
    subtotals.forEach(subtotal => {
        total += parseFloat(subtotal.innerText);
    });
    document.getElementById('total-harga').innerText = total.toLocaleString('id-ID');
}

document.addEventListener('DOMContentLoaded', function () {
    const cartRows = document.querySelectorAll('tr[data-cart-id]');
    cartRows.forEach(row => {
        const stock = parseInt(row.dataset.stock);
        const quantityInput = row.querySelector('.quantity');
        const addButton = row.querySelector('button[onclick*="updateQuantity(this, 1)"]');
        const errorMessage = row.querySelector('.stock-error');

        if (stock === 0) {
            // Nonaktifkan tombol tambah jika stok habi s
            if (addButton) {
                addButton.disabled = true;
            }
            // Tampilkan pesan error
            if (errorMessage) {
                errorMessage.classList.remove('hidden');
            }
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const checkoutButton = document.getElementById('checkout-button');
    const cartRows = document.querySelectorAll('tr[data-cart-id]');

    function checkStockAvailability() {
        let isStockUnavailable = false;
        cartRows.forEach(row => {
            const stock = parseInt(row.dataset.stock);
            if (stock === 0) {
                isStockUnavailable = true;
            }
        });

        // Nonaktifkan tombol "Buat Pesanan" jika stok habis
        if (checkoutButton) {
            checkoutButton.disabled = isStockUnavailable;
        }
    }

    // Panggil fungsi saat halaman dimuat
    checkStockAvailability();

    // Panggil fungsi saat jumlah produk diubah
    const quantityButtons = document.querySelectorAll('button[onclick*="updateQuantity"]');
    quantityButtons.forEach(button => {
        button.addEventListener('click', checkStockAvailability);
    });
});
