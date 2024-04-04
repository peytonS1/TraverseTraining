<?php
require 'db.php'; // Include your database connection

// Fetch available jobs
try {
    $stmt = $db->query("SELECT * FROM jobs WHERE status = 'open'");
    $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not fetch jobs: " . $e->getMessage());
}

// Handle bid submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assume bid is submitted with job_id, bidder_name, and bid_amount
    $jobId = $_POST['job_id'];
    $bidderName = $_POST['bidder_name'];
    $bidAmount = $_POST['bid_amount'];

    try {
        $stmt = $db->prepare("INSERT INTO bids (job_id, bidder_name, bid_amount) VALUES (?, ?, ?)");
        $stmt->execute([$jobId, $bidderName, $bidAmount]);

        echo "<p>Bid successfully submitted.</p>";
    } catch (PDOException $e) {
        echo "<p>Error submitting bid: " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bidding Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body>
    <h2>Available Jobs for Bidding</h2>
    <ul>
        <?php foreach ($jobs as $job): ?>
            <li>
                <h3><?= htmlspecialchars($job['title']) ?></h3>
                <p><?= htmlspecialchars($job['description']) ?></p>
                <!-- Simple form for bidding -->
                <form action="bidding.php" method="post">
                    <input type="hidden" name="job_id" value="<?= $job['job_id'] ?>">
                    <input type="text" name="bidder_name" placeholder="Your Name" required>
                    <input type="number" name="bid_amount" placeholder="Bid Amount" step="0.01" required>
                    <button type="submit">Submit Bid</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>