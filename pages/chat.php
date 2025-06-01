<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$sender_id = $_SESSION['user_id'];
$receiver_id = $_GET['to'] ?? null;

if (!$receiver_id || !is_numeric($receiver_id)) {
    die("Qáte: Kimge jazılıp atırǵanlıǵı anıqlanbadı.");
}

// Foydalanuvchilar ismlarini olish
$stmtUser = $pdo->prepare("SELECT id, name FROM users WHERE id IN (?, ?)");
$stmtUser->execute([$sender_id, $receiver_id]);
$users = $stmtUser->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_UNIQUE);
$sender_name = $users[$sender_id]['name'] ?? 'Siz';
$receiver_name = $users[$receiver_id]['name'] ?? 'Paydalanıwshı';

// Yangi xabar yozish
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['message'])) {
    $message = trim($_POST['message']);
    $stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
    $stmt->execute([$sender_id, $receiver_id, $message]);
    header("Location: chat.php?to=$receiver_id");
    exit;
}

// Chatni olish
$stmt = $pdo->prepare("
    SELECT m.*, u.name FROM messages m
    JOIN users u ON m.sender_id = u.id
    WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?)
    ORDER BY m.sent_at ASC
");
$stmt->execute([$sender_id, $receiver_id, $receiver_id, $sender_id]);
$messages = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Chat - <?= htmlspecialchars($receiver_name) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f2f6fa;
            font-family: 'Poppins', sans-serif;
        }

        .chat-box {
            max-width: 800px;
            margin: 60px auto;
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }

        .chat-log {
            max-height: 400px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 20px;
        }

        .message {
            padding: 12px 18px;
            border-radius: 20px;
            max-width: 70%;
            position: relative;
            transition: all 0.3s ease;
            word-wrap: break-word;
        }

        .sent {
            background: #d1e7dd;
            align-self: flex-end;
            text-align: right;
        }

        .received {
            background: #f8d7da;
            align-self: flex-start;
            text-align: left;
        }

        .message:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }

        .meta {
            font-size: 0.75rem;
            color: #6c757d;
            margin-top: 5px;
        }

        .chat-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .input-group input:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
    </style>
</head>
<body>

<div class="chat-box">
    <div class="chat-header">
        <h4>Chat: <?= htmlspecialchars($receiver_name) ?></h4>
        <small class="text-muted">Jazılıwlar</small>
    </div>

    <div class="chat-log">
        <?php foreach ($messages as $msg): ?>
            <div class="message <?= $msg['sender_id'] == $sender_id ? 'sent' : 'received' ?>">
                <?= nl2br(htmlspecialchars($msg['message'])) ?>
                <div class="meta">
                    <?= htmlspecialchars($msg['name']) ?> | <?= date('d.m.Y H:i', strtotime($msg['sent_at'])) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <form method="post">
        <div class="input-group">
            <input type="text" name="message" class="form-control" placeholder="Xabar jazıń..." required>
            <button class="btn btn-primary">Jiberiw</button>
        </div>
    </form>
</div>

</body>
</html>
