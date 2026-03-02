<!DOCTYPE html>
<html>
<head>
    <title>Kas Kelas - Fintech</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f4f6f9;
        }
        .sidebar {
            height: 100vh;
            background: linear-gradient(180deg, #0d1b4c, #1f3c88);
            color: white;
            padding: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            margin: 15px 0;
        }
        .card-balance {
            background: linear-gradient(90deg, #00c6a7, #1e90ff);
            color: white;
            border-radius: 15px;
        }
        .btn-income {
            background-color: #1e90ff;
            color: white;
        }
        .btn-expense {
            background-color: #ff4d4d;
            color: white;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
            <h4>💰 Kas Kelas</h4>
            <hr>
            <a href="#">Dashboard</a>
            <a href="#">Transaksi</a>
            <a href="#">Pemasukan</a>
            <a href="#">Pengeluaran</a>
            <a href="#">Anggota</a>
            <a href="#">Pengaturan</a>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-4">

            <h3>Hi, Welcome Back 👋</h3>
            <p>Kelola keuangan kelas dengan sistem fintech modern</p>

            <!-- Saldo -->
            <div class="card card-balance p-4 mb-4">
                <h5>Saldo Kas Saat Ini</h5>
                <h1>Rp 2.350.000</h1>
                <small>Bulan ini: +1.050.000 pemasukan | -750.000 pengeluaran</small>
            </div>

            <!-- Tabel Transaksi -->
            <div class="card p-4 mb-4">
                <h5>Transaksi Terbaru</h5>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>24 April 2024</td>
                            <td>Ahmad</td>
                            <td>Iuran Bulanan</td>
                            <td><span class="badge bg-success">Pemasukan</span></td>
                            <td>Rp 250.000</td>
                        </tr>
                        <tr>
                            <td>23 April 2024</td>
                            <td>Fadilah</td>
                            <td>Beli ATK</td>
                            <td><span class="badge bg-danger">Pengeluaran</span></td>
                            <td>Rp 75.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Form -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card p-3">
                        <h5>Tambah Pemasukan</h5>
                        <form>
                            <input type="text" class="form-control mb-2" placeholder="Nama">
                            <input type="number" class="form-control mb-2" placeholder="Jumlah">
                            <input type="text" class="form-control mb-2" placeholder="Keterangan">
                            <button class="btn btn-income w-100">Tambah Pemasukan</button>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card p-3">
                        <h5>Tambah Pengeluaran</h5>
                        <form>
                            <input type="text" class="form-control mb-2" placeholder="Nama">
                            <input type="number" class="form-control mb-2" placeholder="Jumlah">
                            <input type="text" class="form-control mb-2" placeholder="Keterangan">
                            <button class="btn btn-expense w-100">Tambah Pengeluaran</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>