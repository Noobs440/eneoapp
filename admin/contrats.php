<?php
$title = "Gestion des contrats";
$addLink = "add-contrat.php";
$editLink = "edit-contrat.php";
$deleteLink = "delete-contrat.php";
$primaryKey = "num_contrat";

$columns = ["N° de contrat", "Nom de l'abonné", "Quartier"];

include '../db.php';

$showCreateUser = true;

$search = $_GET['search'] ?? "";

$limit = 5;
$page = $_GET['page'] ?? 1;
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM contrat 
        WHERE num_contrat LIKE :search OR nom_abonne LIKE :search
        LIMIT :limit OFFSET :offset";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$countSql = "SELECT COUNT(*) FROM contrat 
             WHERE num_contrat LIKE :search OR nom_abonne LIKE :search";

$countStmt = $pdo->prepare($countSql);
$countStmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
$countStmt->execute();
$totalRows = $countStmt->fetchColumn();

$totalPages = ceil($totalRows / $limit);

// Build a map of contrats already linked to a user to avoid showing create-user button
$userLinked = [];
if (!empty($rows)) {
    $contractNums = array_column($rows, 'num_contrat');
    if (!empty($contractNums)) {
        // Prepare placeholders for IN clause
        $placeholders = implode(',', array_fill(0, count($contractNums), '?'));
        $sqlUsers = "SELECT num_contrat FROM user WHERE num_contrat IN ($placeholders)";
        $stmtUsers = $pdo->prepare($sqlUsers);
        $stmtUsers->execute($contractNums);
        $linkedRows = $stmtUsers->fetchAll(PDO::FETCH_ASSOC);
        foreach ($linkedRows as $lr) {
            $userLinked[$lr['num_contrat']] = true;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contrats</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'sidebar.php'; ?>

    <form method="GET" class="search-bar">
        <input 
            type="text" 
            name="search" 
            placeholder="Rechercher par contrat ou abonné..."
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
