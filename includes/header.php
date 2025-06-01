<?php
session_start(); // Sessiyani ishga tushurish
?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancer Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
        }
        .navbar {
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        .navbar-brand {
            font-weight: 600;
            color: #0d6efd;
        }
        .nav-link {
            color: #333;
            transition: color 0.2s ease;
        }
        .nav-link:hover {
            color: #0d6efd;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg px-4">
    <a class="navbar-brand" href="/index.php">Freelancer Market</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navContent">
        <ul class="navbar-nav ms-auto">
            <?php if (isset($_SESSION['user_id'])): ?>
                <?php if ($_SESSION['user_role'] === 'freelancer'): ?>
                    <li class="nav-item"><a class="nav-link" href="/jobs.php">Jumıslar</a></li>
                    <li class="nav-item"><a class="nav-link" href="/my-applications.php">Meniń Arzalarım</a></li>
                <?php elseif ($_SESSION['user_role'] === 'employer'): ?>
                    <li class="nav-item"><a class="nav-link" href="/post-job.php">Jumıs járiyalaw</a></li>
                    <li class="nav-item"><a class="nav-link" href="/view-applications.php">Arzalar</a></li>
                <?php endif; ?>
                <li class="nav-item"><a class="nav-link" href="/logout.php">Shıǵıw</a></li>
            <?php else: ?>
                <li class="nav-item"><a class="nav-link" href="/pages/login.php">Kiriw</a></li>
                <li class="nav-item"><a class="nav-link" href="/pages/register.php">Tizimnen ótiw</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<div class="container mt-4">
    <!-- Bosh sahifa mazmuni shu yerda bo'ladi -->
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
