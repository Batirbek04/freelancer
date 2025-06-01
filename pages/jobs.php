<?php
require_once '../config.php';

$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';

$sql = "SELECT * FROM jobs WHERE 1";
$params = [];

if (!empty($search)) {
    $sql .= " AND (title LIKE ? OR description LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if (!empty($category)) {
    $sql .= " AND category = ?";
    $params[] = $category;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$jobs = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Jumıslar dizimi | Freelancer Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #eef2f7;
            font-family: 'Poppins', sans-serif;
        }
        .search-box {
            margin: 40px auto;
            max-width: 900px;
        }
        .job-card {
            background: #fff;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border-left: 5px solid #0d6efd;
        }
        .job-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
        }
        .badge-category {
            font-size: 14px;
            background: #e0e7ff;
            color: #4f46e5;
            padding: 5px 12px;
            border-radius: 20px;
        }
        .btn-view {
            background-color: #0d6efd;
            color: #fff;
            border-radius: 30px;
            padding: 6px 16px;
            text-decoration: none;
            transition: background-color 0.2s ease;
        }
        .btn-view:hover {
            background-color: #084fc7;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="search-box">
        <form method="GET" class="row g-2">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="Jumıs atı yamasa sıpatlaması..." value="<?= htmlspecialchars($search) ?>">
            </div>
            <div class="col-md-4">
                <select name="category" class="form-select">
                    <option value="">Barlıq kategoriyalar</option>
                    <option value="dizayn" <?= $category == 'dizayn' ? 'selected' : '' ?>>Dizayn</option>
                    <option value="web" <?= $category == 'web' ? 'selected' : '' ?>>Web programmalastırıw</option>
                    <option value="mobil" <?= $category == 'mobil' ? 'selected' : '' ?>>Mobil qosımshalar</option>

                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100">Izlew</button>
            </div>
            
        </form>
    </div>

    <?php if (count($jobs) > 0): ?>
        <div class="row g-4">
            <?php foreach ($jobs as $job): ?>
                <div class="col-md-6">
                    <div class="job-card">
                        <h5><?= htmlspecialchars($job['title']) ?></h5>
                        <p><?= htmlspecialchars(mb_substr($job['description'], 0, 100)) ?>...</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge-category"><?= htmlspecialchars($job['category']) ?></span>
                            <a class="btn-view" href="job-details.php?id=<?= $job['id'] ?>">Tolıqıraq</a>
                            
    
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center text-muted mt-5">Eshqanday jumıs tawılmadı.</p>
    <?php endif; ?>
</div>

</body>
</html>
