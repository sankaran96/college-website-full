<?php
require_once 'db.php';
session_start();
if (!isset($_SESSION['admin_id'])) { header('Location: admin_login.php'); exit; }
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$conn = getConn();

// find file
$stmt = $conn->prepare("SELECT file_path FROM notices WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->bind_result($file);
$stmt->fetch();
$stmt->close();

if ($file && file_exists($file)) @unlink($file);

$stmt2 = $conn->prepare("DELETE FROM notices WHERE id = ?");
$stmt2->bind_param('i', $id);
$stmt2->execute();
$stmt2->close();

header('Location: manage_notices.php');
exit;
?>