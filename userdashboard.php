<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit;
}

$page = $_GET['page'] ?? 'dashboard';
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard utilisateur</title>
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="dashboard_content.css">
    <link rel="stylesheet" href="factures_content.css">
    <link rel="stylesheet" href="profil_content.css">
    <link rel="stylesheet" href="responsive.css">
</head>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('consommationChart').getContext('2d');

const consommationChart = new Chart(ctx, {
    type: 'bar', // ou 'line'
    data: {
        labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai'], // périodes
        datasets: [{
            label: 'Consommation (kWh)',
            data: [120, 150, 90, 200, 130], // valeurs fictives
            backgroundColor: 'rgba(59, 130, 246, 0.6)',
            borderColor: 'rgba(59, 130, 246, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
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
                    text: 'Période'
                }
            }
        }
    }
});
</script>

<body>

<?php include "sidebar.php"; ?>

<?php
switch ($page) {
    case 'factures':
        include "factures_content.php";
        break;

    case 'consommation':
        include "consommation_content.php";
        break;

    case 'profil':
        include "profil_content.php";
        break;

    case 'dashboard':
    default:
        include "dashboard_content.php";
        break;
}
?>

</body>
</html>
