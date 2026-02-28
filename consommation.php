<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$sql = "
    SELECT c.mois, c.conso
    FROM consommation c
    JOIN contrat ct ON c.num_contrat = ct.num_contrat
    JOIN user u ON u.num_contrat = ct.num_contrat
    WHERE u.id = ?
    ORDER BY c.mois
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['user_id']]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$mois = [];
$conso = [];

foreach ($data as $row) {
    $mois[] = $row['mois'];
    $conso[] = $row['conso'];
}
?>

<?php include 'navbar.php'; ?>

<html>
<head>
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="consommation.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="consommation.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="responsive.css">
</head>

<div class="chart-container">
    <canvas id="consoChart"></canvas>
</div>

<script>
const mois = <?php echo json_encode($mois); ?>;
const conso = <?php echo json_encode($conso); ?>;

const ctx = document.getElementById('consoChart').getContext('2d');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: mois,
        datasets: [{
            label: 'Consommation (kWh)',
            data: conso,
            borderWidth: 2,
            tension: 0.3,
            fill: false
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'kWh'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Mois'
                }
            }
        }
    }
});
</script>

</body>
</html>
