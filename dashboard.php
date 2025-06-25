<?php
require_once 'includes/auth.php';
if (!is_logged_in()) {
    header('Location: login.php');
    exit;
}
require_once 'includes/db.php';
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare('SELECT username, credits, real_money FROM users WHERE id = ?');
$stmt->execute([$user_id]);
$user = $stmt->fetch();
$matches = $pdo->query("SELECT * FROM matches WHERE status IN ('upcoming', 'live') ORDER BY match_date ASC")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Cricket Betting</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>
    <p>Credits: <?php echo $user['credits']; ?> | Real Money: $<?php echo $user['real_money']; ?></p>
    <a href="bet.php">Place a Bet</a> | <a href="results.php">Results</a> | <a href="logout.php">Logout</a>
    <h3>Upcoming/Live Matches</h3>
    <table border="1">
        <tr><th>Teams</th><th>Date</th><th>Status</th></tr>
        <?php foreach ($matches as $match): ?>
        <tr>
            <td><?php echo htmlspecialchars($match['team_a']) . ' vs ' . htmlspecialchars($match['team_b']); ?></td>
            <td><?php echo $match['match_date']; ?></td>
            <td><?php echo $match['status']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html> 