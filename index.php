<?php
// Koneksi ke database
$mysqli = new mysqli("localhost", "root", "", "perpustakaan");

// Cek koneksi
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

// Ambil data dari tabel buku
$result = $mysqli->query("SELECT * FROM buku ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku - Perpustakaan</title>
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
            background-color: #f4f4f9;
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .add-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .add-btn:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .actions a {
            text-decoration: none;
            color: #007BFF;
            margin-right: 10px;
        }

        .actions a:hover {
            color: #0056b3;
        }

        .actions {
            display: flex;
            justify-content: space-between;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            table, th, td {
                font-size: 14px;
            }

            .add-btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Data Buku</h1>
        <a href="add.php" class="add-btn">Tambah Buku</a>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Tahun Terbit</th>
                    <th>Penerbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$i."</td>";
                    echo "<td>".$row['judul_buku']."</td>";
                    echo "<td>".$row['pengarang']."</td>";
                    echo "<td>".$row['tahun_terbit']."</td>";
                    echo "<td>".$row['penerbit']."</td>";
                    echo "<td class='actions'>
                            <a href='edit.php?id=".$row['id']."'>Edit</a> |
                            <a href='delete.php?id=".$row['id']."'>Delete</a>
                          </td>";
                    echo "</tr>";
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>