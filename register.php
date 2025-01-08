<?php
include 'config.php';
session_start();

// Initialize variables to avoid undefined variable errors
$username = $email = "";

if (isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($mysqli, $_POST['username']); // Escape input to prevent SQL injection
    $email = mysqli_real_escape_string($mysqli, $_POST['email']); // Escape input to prevent SQL injection
    $password = hash('sha256', $_POST['password']); // Hash the input password using SHA-256
    $cpassword = hash('sha256', $_POST['cpassword']); // Hash the input confirm password using SHA-256

    if ($password == $cpassword) {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($mysqli, $sql);
    
        if (!$result) {
            die("Query failed: " . mysqli_error($mysqli)); // Menampilkan pesan error jika query gagal
        }
    
        if (mysqli_num_rows($result) == 0) {
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
            $result = mysqli_query($mysqli, $sql);
    
            if ($result) {
                echo "<script>alert('Selamat, registrasi berhasil!')</script>";
                $username = "";
                $email = "";
            } else {
                die("Insert failed: " . mysqli_error($mysqli)); // Menampilkan pesan error jika insert gagal
            }
        } else {
            echo "<script>alert('Woops! Email Sudah Terdaftar.')</script>";
        }
    } else {
        echo "<script>alert('Password Tidak Sesuai')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Perpustakaan</title>
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
            background-color: #f4f4f4;
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
            max-width: 400px;
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
            padding: 12px;
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
        <h1>Registrasi</h1>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="cpassword">Confirm Password</label>
                <input type="password" id="cpassword" name="cpassword" value="<?php echo isset($_POST['cpassword']) ? htmlspecialchars($_POST['cpassword']) : ''; ?>" required>
            </div>

            <button type="submit" name="submit" class="btn-submit">Register</button>
        </form>

        <div class="back-link">
            <p>Sudah punya akun? <a href="index.php">Login</a></p>
        </div>
    </div>

</body>
</html>