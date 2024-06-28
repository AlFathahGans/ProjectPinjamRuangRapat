<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kartu Tanda Penduduk</title>
    <style>
        /* CSS styling untuk tampilan PDF */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .detail {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Kartu Tanda Penduduk</h1>
        <div class="detail">
            <strong>Nama:</strong> {{ $masyarakat->nama }}
        </div>
        <div class="detail">
            <strong>Alamat:</strong> {{ $masyarakat->alamat }}
        </div>
        <div class="detail">
            <strong>Nomor KTP:</strong> {{ $masyarakat->nomor_ktp }}
        </div>
        <!-- Tambahkan informasi lain sesuai kebutuhan -->
    </div>
</body>
</html>
