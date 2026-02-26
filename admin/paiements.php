<?php
$title = "Gestion des paiements";
$addLink = "add-paiement.php";
$editLink = "edit-paiement.php";
$deleteLink = "delete-paiement.php";
$primaryKey = "num_recu";

$columns = ["Date", "N° de contrat", "N° de recu", "Montant", "Mode de paiement", "Agence", "Mois", "N° de facture", "Montant de la facture"];

include '../db.php';

$search = $_GET['search'] ?? "";

$limit = 5;
$page = $_GET['page'] ?? 1;
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM paiement 
        WHERE num_recu LIKE :search OR num_contrat LIKE :search
        LIMIT :limit OFFSET :offset";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$countSql = "SELECT COUNT(*) FROM paiement 
             WHERE num_recu LIKE :search OR num_contrat LIKE :search";

$countStmt = $pdo->prepare($countSql);
$countStmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
$countStmt->execute();
$totalRows = $countStmt->fetchColumn();

$totalPages = ceil($totalRows / $limit);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Paiements</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'sidebar.php'; ?>

    <form method="GET" class="search-bar">
        <input 
            type="text" 
            name="search" 
            placeholder="Rechercher par reçu ou contrat..."
            value="<?php echo htmlspecialchars($search); ?>"
        >
        <button type="submit">Rechercher</button>
    </form>

<?php include 'table-template.php'; ?>

    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a 
                href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"
                class="<?php if ($i == $page) echo 'active'; ?>">
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>
    </div>

</body>
</html>
