<?php
require_once 'db.php';
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}
include 'navbar.php';
$conn = getConn();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Admin Dashboard</h2>
    <div>
      <a href="manage_notices.php" class="btn btn-primary">Manage Notices</a>
      <a href="logout.php" class="btn btn-outline-danger">Logout</a>
    </div>
  </div>

  <div class="row g-4">
    <div class="col-md-4"><div class="card shadow p-3"><h5>Manage Notices</h5><p>Add / Edit / Delete notices</p></div></div>
    <div class="col-md-4"><div class="card shadow p-3"><h5>Manage Students</h5><p>(Optional) Add / Edit / Delete students</p></div></div>
    <div class="col-md-4"><div class="card shadow p-3"><h5>Upload Results</h5><p>(Optional) Add results per student</p></div></div>
  </div>
</div>
</body>
</html>