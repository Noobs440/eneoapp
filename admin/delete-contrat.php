<?php
include '../db.php';

// Ensure num_contrat is provided
if (!isset($_GET['num_contrat'])) {
	header("Location: contrats.php");
	exit();
}

$id = $_GET['num_contrat'];

try {
	// Use a transaction to keep DB consistent
	$pdo->beginTransaction();

	// Delete any user(s) linked to this contract
	$stmtUser = $pdo->prepare('DELETE FROM user WHERE num_contrat = :id');
	$stmtUser->execute(['id' => $id]);

	// Delete the contract itself
	$stmt = $pdo->prepare('DELETE FROM contrat WHERE num_contrat = :id');
	$stmt->execute(['id' => $id]);

	$pdo->commit();
} catch (Exception $e) {
	// Rollback on error and optionally log
	if ($pdo->inTransaction()) $pdo->rollBack();
	error_log('Error deleting contract ' . $id . ': ' . $e->getMessage());
}

header("Location: contrats.php");
exit();
