<?php 
session_start();
require_once '../config.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() === 1) {
        $user = $stmt->fetch();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];

            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Parol qáte.";
        }
    } else {
        $error = "Bunday elektron pochta menen paydalanıwshı tabılmadı.";
    }
}
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Tizimge kiriw | Freelancer Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f3e5f5, #e1f5fe);
            transition: background 0.4s ease-in-out;
        }

        .login-box {
            max-width: 420px;
            margin: 100px auto;
            background: #fff;
            padding: 35px;
            border-radius: 25px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
            animation: fadeInSlide 0.6s ease-in-out;
        }

        .login-box:hover {
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.15);
        }

        h3 {
            font-weight: 600;
            text-align: center;
            color: #333;
            margin-bottom: 25px;
            animation: fadeDown 0.5s ease-in-out;
        }

        .form-label {
            font-weight: 500;
        }

        .form-control {
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #7c4dff;
            box-shadow: 0 0 0 0.2rem rgba(124, 77, 255, 0.25);
        }

        .btn-primary {
            background: #7c4dff;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #651fff;
            transform: scale(1.03);
            box-shadow: 0 8px 18px rgba(101, 31, 255, 0.3);
        }

        a {
            color: #7c4dff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #4a148c;
        }

        @keyframes fadeInSlide {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeDown {
            0% {
                opacity: 0;
                transform: translateY(-15px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<div class="login-box">
    <h3>Tizimge kiriw</h3>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Email poshtańız</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Parol</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Kiriw</button>
    </form>

    <p class="mt-3 text-center">
        Tizimnen ótpedińizbe? 
        <a href="register.php">Tizimnen ótiw</a>
    </p>
</div>

</body>
</html>
