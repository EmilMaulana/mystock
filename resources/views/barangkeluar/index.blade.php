<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang Keluar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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

        .header {
            background: linear-gradient(to right, #588A46, #68BE49);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header {
            background: linear-gradient(to right, #588A46, #68BE49);
        }

        .table-responsive {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
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
                        <li><a href="{{ route('transactions.index') }}" class="nav-link"><i class="bi bi-cash"></i> Kasir</a></li>
                        <li><a href="{{ route('produks.index') }}" class="nav-link"><i class="bi bi-basket3"></i> Barang</a></li>
                    </ul>
                </li>
                <li class="nav-item mb-2">
                    <span class="nav-link">
                        <i class="bi bi-clipboard"></i> Inventori
                    </span>
                    <ul class="list-unstyled ps-3">
                        <li><a href="{{ route('stocks.index') }}" class="nav-link"><i class="bi bi-archive"></i> Stok</a></li>
                        <li><a href="{{ route('barangmasuk.index') }}" class="nav-link"><i class="bi bi-arrow-down-square"></i> Barang Masuk</a></li>
                        <li><a href="{{ route('barangkeluar.index') }}" class="nav-link"><i class="bi bi-arrow-up-square"></i> Barang Keluar</a></li>
                    </ul>
                </li>
                <li class="nav-item mb-2">
                    <span class="nav-link">
                        <i class="bi bi-journal-text"></i> Laporan
                    </span>
                    <ul class="list-unstyled ps-3">
                        <li><span class="nav-link"><i class="bi bi-file-earmark-arrow-down"></i> Laporan Barang Masuk</span></li>
                        <li><span class="nav-link"><i class="bi bi-file-earmark-arrow-up"></i> Laporan Barang Keluar</span></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                        <i class="bi bi-gear-fill"></i> Pengaturan
                    </span>
                </li>
            </ul>
        </div>

        <!-- Content -->
        <div class="col-md-10 p-4">

            <div class="header p-3 rounded mb-4" style="background-color: #68BE49; color: white;">
                <h2><i class="bi bi-box-arrow-out"></i> Barang Keluar</h2>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h3>Daftar Barang Keluar</h3>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kode Barang</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Tanggal</th>
                                <th>Satuan</th>
                                <th>Stock Terpakai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stockHistories as $history)
                                <tr>
                                    <td>{{ $history->id }}</td>
                                    <td>{{ $history->stock->kode_barang }}</td>
                                    <td>{{ $history->nama_bahan }}</td>
                                    <td>{{ $history->stock->category->name }}</td>
                                    <td>{{ $history->tanggal }}</td>
                                    <td>{{ $history->satuan }}</td>
                                    <td>{{ $history->banyak_bahan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
