<?php
if (isset($_POST['submit'])) {
    $mysqli = new mysqli("localhost", "root", "", "perpustakaan");

    // Pastikan data yang diterima aman dengan menggunakan real_escape_string
    $judul_buku = $mysqli->real_escape_string($_POST['judul_buku']);
    $pengarang = $mysqli->real_escape_string($_POST['pengarang']);
    $tahun_terbit = $mysqli->real_escape_string($_POST['tahun_terbit']);
    $penerbit = $mysqli->real_escape_string($_POST['penerbit']);

    // Menambahkan data buku ke database
    $mysqli->query("INSERT INTO buku (judul_buku, pengarang, tahun_terbit, penerbit) VALUES ('$judul_buku', '$pengarang', '$tahun_terbit', '$penerbit')");

    // Redirect ke halaman utama setelah berhasil menambahkan buku
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku - Perpustakaan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* Reset default margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-group input:focus {
            border-color: #4CAF50;
            outline: none;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #45a049;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
        }

        .back-link a {
            color: #007BFF;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .btn-submit {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Tambah Buku</h1>
        <form action="add.php" method="post">
            <div class="form-group">
                <label for="judul_buku">Judul Buku</label>
                <input type="text" id="judul_buku" name="judul_buku" required>
            </div>

            <div class="form-group">
                <label for="pengarang">Pengarang</label>
                <input type="text" id="pengarang" name="pengarang" required>
            </div>

            <div class="form-group">
                <label for="tahun_terbit">Tahun Terbit</label>
                <input type="text" id="tahun_terbit" name="tahun_terbit" required>
            </div>

            <div class="form-group">
                <label for="penerbit">Penerbit</label>
                <input type="text" id="penerbit" name="penerbit" required>
            </div>

            <button type="submit" name="submit" class="btn-submit">Tambah Buku</button>
        </form>

        <div class="back-link">
            <a href="index.php">Kembali ke Daftar Buku</a>
        </div>
    </div>

</body>
</html>