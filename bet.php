<?php
require_once 'includes/auth.php';
if (!is_logged_in()) {
    header('Location: login.php');
    exit;
}
require_once 'includes/db.php';
$user_id = $_SESSION['user_id'];
$matches = $pdo->query("SELECT * FROM matches WHERE status IN ('upcoming', 'live') ORDER BY match_date ASC")->fetchAll();
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $match_id = $_POST['match_id'];
    $bet_type = $_POST['bet_type'];
    $bet_option = $_POST['bet_option'];
    $amount = floatval($_POST['amount']);
    $currency = $_POST['currency'];
    $over_mark = isset($_POST['over_mark']) ? intval($_POST['over_mark']) : null;
    $stmt = $pdo->prepare('INSERT INTO bets (user_id, match_id, bet_type, bet_option, amount, currency, over_mark) VALUES (?, ?, ?, ?, ?, ?, ?)');
    if ($stmt->execute([$user_id, $match_id, $bet_type, $bet_option, $amount, $currency, $over_mark])) {
        $message = 'Bet placed successfully!';
    } else {
        $message = 'Failed to place bet.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Place a Bet - Cricket Betting</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Place a Bet</h2>
    <form method="post">
        <label>Match:</label>
        <select name="match_id" required>
            <?php foreach ($matches as $match): ?>
                <option value="<?php echo $match['id']; ?>">
                    <?php echo htmlspecialchars($match['team_a']) . ' vs ' . htmlspecialchars($match['team_b']) . ' (' . $match['match_date'] . ')'; ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        <label>Bet Type:</label>
        <select name="bet_type" id="bet_type" required onchange="showOptions()">
            <option value="match_winner">Match Winner</option>
            <option value="highest_wicket_taker">Highest Wicket-Taker</option>
            <option value="over_runs">Over Runs</option>
        </select><br>
        <div id="bet_option_container">
            <input type="text" name="bet_option" placeholder="Enter your option (team/player/runs)" required>
        </div>
        <div id="over_mark_container" style="display:none;">
            <label>Over Mark:</label>
            <select name="over_mark">
                <option value="6">6</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
            </select><br>
        </div>
        <label>Amount:</label>
        <input type="number" name="amount" min="1" step="0.01" required><br>
        <label>Currency:</label>
        <select name="currency">
            <option value="credits">Credits</option>
            <option value="real_money">Real Money</option>
        </select><br>
        <button type="submit">Place Bet</button>
    </form>
    <p><?php echo $message; ?></p>
    <a href="dashboard.php">Back to Dashboard</a>
    <script>
    function showOptions() {
        var betType = document.getElementById('bet_type').value;
        var overMark = document.getElementById('over_mark_container');
        if (betType === 'over_runs') {
            overMark.style.display = 'block';
        } else {
            overMark.style.display = 'none';
        }
    }
    </script>
</body>
</html> 