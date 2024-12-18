<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitur Kasir - My Stock</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <style>
        /* Sidebar Style */
        .bg-gradient {
            background: linear-gradient(to right, #588A46, #68BE49);
        }

        .sidebar {
            font-size: 14px;
            border-right: 2px solid #ddd;
            padding-right: 10px;
        }

        .sidebar .nav-link {
            color: #305822;
        }

        .sidebar .nav-link i {
            color: #305822;
            margin-right: 8px;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(48, 88, 34, 0.1);
        }

        /* Header Style */
        .header {
            background: linear-gradient(to right, #588A46, #68BE49);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border-radius: 5px;
        }

        /* Product Cards */
        .card img {
            max-height: 150px;
            object-fit: cover;
            width: 100%;
        }

        .card-title {
            font-size: 1rem;
            font-weight: bold;
        }

        .card-price {
            font-size: 0.9rem;
            color: #28a745;
        }

        .menu-title {
            position: relative;
            padding-bottom: 10px;
        }

        .menu-label {
            display: inline-block;
            background-color: #f5f5f5;
            color: #305822;
            font-weight: bold;
            font-size: 1.2rem;
            padding: 8px 20px;
            border-radius: 20px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar vh-100 p-3">
                <div class="text-center mb-4">
                    <a href="/profile">
                        <img src="{{ asset('img/logo3.png') }}" alt="Logo" class="img-fluid rounded-circle mb-2"
                            style="width: 100px;">
                    </a>
                    <h4>My Stock</h4>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="{{ route('auth.dashboard') }}" class="nav-link">
                            <i class="bi bi-house-door-fill"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <span class="nav-link">
                            <i class="bi bi-box2"></i> Master
                        </span>
                        <ul class="list-unstyled ps-3">
                            <li><a href="{{ route('transactions.index') }}" class="nav-link">
                                <i class="bi bi-cash"></i> Kasir
                            </a>
                            <li><a href="{{ route('produks.index') }}" class="nav-link"><i class="bi bi-basket3"></i>
                                    Barang</a></li>
                        </ul>
                    </li>
                    <li class="nav-item mb-2">
                        <span class="nav-link">
                            <i class="bi bi-clipboard"></i> Inventori
                        </span>
                        <ul class="list-unstyled ps-3">
                        <li class="nav-item mb-2">
                                <a href="{{ route('stocks.index') }}" class="nav-link">
                                    <i class="bi bi-archive"></i> Stok
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="{{ route('barangmasuk.index') }}" class="nav-link">
                                    <i class="bi bi-arrow-down-square"></i> Barang Masuk
                                </a>
                            </li>
                            <li><span class="nav-link"><i class="bi bi-arrow-up-square"></i> Barang Keluar</span></li>
                        </ul>
                    </li>
                    <li class="nav-item mb-2">
                        <span class="nav-link">
                            <i class="bi bi-journal-text"></i> Laporan
                        </span>
                        <ul class="list-unstyled ps-3">
                            <li><span class="nav-link"><i class="bi bi-file-earmark-arrow-down"></i> Laporan Barang
                                    Masuk</span></li>
                            <li><span class="nav-link"><i class="bi bi-file-earmark-arrow-up"></i> Laporan Barang
                                    Keluar</span></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link">
                            <i class="bi bi-gear-fill"></i> Pengaturan
                        </span>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-4">
                <!-- Header -->
                <div class="header mb-4">
                    <h2><i class="bi bi-cash"></i> Fitur Kasir</h2>
                </div>

                <!-- Menu Section -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="menu-title text-center my-3">
                            <div class="menu-label mx-auto shadow-sm">Menu</div>
                        </div>

                        <div class="row">
                            @foreach ($items as $item)
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <img src="{{ asset('storage/' . $item->foto) }}" class="card-img-top"
                                            alt="{{ $item->nama }}"
                                            onerror="this.onerror=null;this.src='{{ asset('img/default-product.jpg') }}';">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">{{ $item->nama }}</h5>
                                            <p class="card-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                                            <button class="btn btn-success btn-sm" onclick="addItem('{{ $item->id }}', '{{ $item->nama }}', {{ $item->harga }})">
                                                <i class="bi bi-plus-circle"></i> Tambah
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Transaction Form -->
                    <div class="col-md-4 mt-4">
                        <div class="card">
                            <div class="card-header bg-gradient text-white">Item yang Dipilih</div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="selected-items">
                                        <!-- Item rows will be dynamically added here -->
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-between">
                                    <h5>Total: <span id="total-price">Rp 0</span></h5>
                                </div>
                                <button class="btn btn-success w-100 mt-3" onclick="submitTransaction()">Lakukan Transaksi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedItems = {};

        function addItem(id, name, price) {
            if (!selectedItems[id]) {
                selectedItems[id] = { id, name, price, quantity: 1 };
            } else {
                selectedItems[id].quantity += 1;
            }
            updateSelectedItemsTable();
        }

        function removeItem(id) {
            if (selectedItems[id]) {
                selectedItems[id].quantity -= 1;
                if (selectedItems[id].quantity <= 0) {
                    delete selectedItems[id];
                }
            }
            updateSelectedItemsTable();
        }

        function updateSelectedItemsTable() {
            const tableBody = document.getElementById('selected-items');
            tableBody.innerHTML = '';

            let total_price = 0;

            Object.values(selectedItems).forEach(item => {
                const row = `
                    <tr>
                        <td>${item.name}</td>
                        <td>${item.quantity}</td>
                        <td>
                            <button class="btn btn-sm btn-danger" onclick="removeItem('${item.id}')">
                                <i class="bi bi-dash-circle"></i>
                            </button>
                            <button class="btn btn-sm btn-success" onclick="addItem('${item.id}', '${item.name}', ${item.price})">
                                <i class="bi bi-plus-circle"></i>
                            </button>
                        </td>
                    </tr>
                `;
                tableBody.insertAdjacentHTML('beforeend', row);
                total_price += item.price * item.quantity;
            });

            document.getElementById('total-price').innerText = 'Rp ' + total_price.toLocaleString('id-ID');
        }

                function submitTransaction() {
            const transactionData = Object.values(selectedItems);
            if (transactionData.length === 0) {
                alert('Silakan tambahkan item sebelum melakukan transaksi.');
                return;
            }

            // Kirim data transaksi ke server
            fetch('/api/transactions', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Jika Anda menggunakan Laravel
                },
                body: JSON.stringify({
                    items: transactionData
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    alert(data.message);
                    // Reset selected items
                    selectedItems = {};
                    updateSelectedItemsTable();
                    
                    // Arahkan ke halaman summary
                    window.location.href = '/transactions/summary'; // Ganti dengan URL halaman summary Anda
                } else {
                    alert('Terjadi kesalahan saat menyimpan transaksi.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghubungi server.');
            });
        }

    </script>
</body>

</html>