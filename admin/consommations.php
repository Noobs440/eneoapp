<?php
$title = "Gestion des consommations";
$addLink = "add-consommation.php";
$editLink = "edit-consommation.php";
$deleteLink = "delete-consommation.php";
$primaryKey = "id";
$showCreateFacture=true;

$columns = ["id", "N° de contrat", "Mois", "Consommation"];

include '../db.php';

$search = $_GET['search'] ?? "";

$limit = 5;
$page = $_GET['page'] ?? 1;
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM consommation 
        WHERE num_contrat LIKE :search
        LIMIT :limit OFFSET :offset";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$countSql = "SELECT COUNT(*) FROM consommation 
             WHERE num_contrat LIKE :search";

$countStmt = $pdo->prepare($countSql);
$countStmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
$countStmt->execute();
$totalRows = $countStmt->fetchColumn();

$totalPages = ceil($totalRows / $limit);

// Build a map of existing invoices (factures) by num_contrat|mois to avoid duplicate creation
$factureLinked = [];
$stmtF = $pdo->query("SELECT num_contrat, mois FROM factures");
$factRows = $stmtF->fetchAll(PDO::FETCH_ASSOC);
foreach ($factRows as $fr) {
    $key = $fr['num_contrat'] . '|' . $fr['mois'];
    $factureLinked[$key] = true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Consommations</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'sidebar.php'; ?>

    <form method="GET" class="search-bar">
        <input 
            type="text" 
            name="search" 
            placeholder="Rechercher par numéro de contrat..."
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
