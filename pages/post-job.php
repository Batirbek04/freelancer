<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'employer') {
    header("Location: login.php");
    exit;
}

$success = $error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title       = trim($_POST['title']);
    $description = trim($_POST['description']);
    $budget      = floatval($_POST['budget']);
    $category    = trim($_POST['category']);
    $employer_id = $_SESSION['user_id'];

    if ($title && $description && $budget > 0 && $category) {
        $stmt = $pdo->prepare("INSERT INTO jobs (employer_id, title, description, budget, category) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$employer_id, $title, $description, $budget, $category]);
        $success = "Jańa jumıs tabıslı jaylastırıldı!";
    } else {
        $error = "Barlıq maydanlardı duris toltırın.";
    }
}
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Jumıs jaylastırıw | Freelancer Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f8f9fa, #e3f2fd);
            transition: background 0.4s ease;
        }

        .form-box {
            max-width: 600px;
            margin: 80px auto;
            background: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            animation: fadeInSlide 0.6s ease-in-out;
            transition: box-shadow 0.3s ease;
        }

        .form-box:hover {
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.15);
        }

        h3 {
            font-weight: 600;
            text-align: center;
            margin-bottom: 25px;
            color: #333;
            animation: fadeDown 0.5s ease-in-out;
        }

        .form-label {
            font-weight: 500;
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #4caf50;
            box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
        }

        .btn-success {
            background: #4caf50;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background: #43a047;
            transform: scale(1.03);
            box-shadow: 0 8px 18px rgba(76, 175, 80, 0.3);
        }

        .alert {
            animation: fadeIn 0.4s ease-in-out;
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

        @keyframes fadeIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
    </style>
</head>
<body>

<div class="form-box">
    <h3>Jańa jumıs jaylastırıw</h3>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php elseif ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Atama</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">sıpatlama</label>
            <textarea name="description" class="form-control" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Budjet (USD)</label>
            <input type="number" name="budget" step="0.01" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kategoriya</label>
            <select name="category" class="form-select" required>
                <option value="">-- Tanlang --</option>
                <option value="web">Web programmalastırıw</option>
                <option value="mobil">Mobil qosımshalar</option>
                <option value="dizayn">Grafik dizayn</option>
                <option value="marketing">Marketing</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success w-100">Reklama qılıw</button>
    </form>
</div>

</body>
</html>
