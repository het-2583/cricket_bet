<?php
require_once 'includes/auth.php';
if (!is_logged_in()) {
    header('Location: login.php');
    exit;
}
require_once 'includes/db.php';
$user_id = $_SESSION['user_id'];
$matches = $pdo->query("SELECT * FROM matches WHERE status = 'completed' ORDER BY match_date DESC")->fetchAll();
$bets = $pdo->prepare('SELECT b.*, m.team_a, m.team_b FROM bets b JOIN matches m ON b.match_id = m.id WHERE b.user_id = ? ORDER BY b.created_at DESC');
$bets->execute([$user_id]);
$user_bets = $bets->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Results - Cricket Betting</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Completed Matches</h2>
    <table border="1">
        <tr><th>Teams</th><th>Date</th><th>Winner</th><th>Highest Wicket-Taker</th></tr>
        <?php foreach ($matches as $match): ?>
        <tr>
            <td><?php echo htmlspecialchars($match['team_a']) . ' vs ' . htmlspecialchars($match['team_b']); ?></td>
            <td><?php echo $match['match_date']; ?></td>
            <td><?php echo $match['winner']; ?></td>
            <td><?php echo $match['highest_wicket_taker']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <h2>Your Bets</h2>
    <table border="1">
        <tr><th>Match</th><th>Type</th><th>Option</th><th>Amount</th><th>Currency</th><th>Over Mark</th><th>Result</th></tr>
        <?php foreach ($user_bets as $bet): ?>
        <tr>
            <td><?php echo htmlspecialchars($bet['team_a']) . ' vs ' . htmlspecialchars($bet['team_b']); ?></td>
            <td><?php echo $bet['bet_type']; ?></td>
            <td><?php echo $bet['bet_option']; ?></td>
            <td><?php echo $bet['amount']; ?></td>
            <td><?php echo $bet['currency']; ?></td>
            <td><?php echo $bet['over_mark'] ? $bet['over_mark'] : '-'; ?></td>
            <td><?php echo $bet['result']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html> 