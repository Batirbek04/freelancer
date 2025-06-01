<?php
require_once '../config.php';

$success = $error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $role     = $_POST['role'];

    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        $error = "Bul elektron pochta álleqashan dizimnen ótken!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $hashed_password, $role]);

        header("Location: login.php?registered=1");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Tizimnen ótiw | Freelancer Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e0f7fa, #e1bee7);
            transition: background 0.4s ease-in-out;
        }

        .register-form {
            max-width: 500px;
            margin: 100px auto;
            background: white;
            padding: 35px;
            border-radius: 25px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
            animation: slideFadeIn 0.6s ease;
        }

        .register-form:hover {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        h3 {
            font-weight: 600;
            color: #333;
            animation: fadeInDown 0.5s ease-in-out;
        }

        .form-control,
        .form-select {
            transition: all 0.3s ease;
            border-radius: 12px;
        }

        .form-control:focus,
        .form-select:focus {
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
            box-shadow: 0 8px 20px rgba(101, 31, 255, 0.3);
        }

        a {
            color: #7c4dff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #4a148c;
        }

        @keyframes slideFadeIn {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<div class="register-form">
    <h3 class="text-center mb-4">Tizimnen ótiw</h3>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Atıńız</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email poshtańız</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Parol</label>
            <input type="password" name="password" class="form-control" minlength="6" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jónelisti tańlań</label>
            <select name="role" class="form-select" required>
                <option value=""> Jónelisti tańlań </option>
                <option value="freelancer">Freelancer</option>
                <option value="employer">Jumıs beriwshi</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">Tizimnen ótiw</button>
        <p class="mt-3 text-center">Tizimnen óttińizbe? <a href="login.php">Tizimge kiriw</a></p>
    </form>
</div>

</body>
</html>
