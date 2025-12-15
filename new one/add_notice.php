<?php
require_once 'db.php';
session_start();
if (!isset($_SESSION['admin_id'])) { header('Location: admin_login.php'); exit; }
$err = '';
if (isset($_POST['save'])) {
    $title = trim($_POST['title']);
    $desc = trim($_POST['description']);
    $filePath = null;

    // Optional file upload
    if (!empty($_FILES['file']['name'])) {
        $uploadsDir = 'assets/uploads/';
        if (!is_dir($uploadsDir)) mkdir($uploadsDir, 0755, true);
        $target = $uploadsDir . time() . '_' . basename($_FILES['file']['name']);
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
            $filePath = $target;
        }
    }

    $conn = getConn();
    $stmt = $conn->prepare("INSERT INTO notices (title, description, file_path) VALUES (?,?,?)");
    $stmt->bind_param('sss', $title, $desc, $filePath);
    if ($stmt->execute()) {
        header('Location: manage_notices.php');
        exit;
    } else {
        $err = 'Error saving notice';
    }
}
include 'navbar.php';
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Add Notice</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body>
<div class="container py-5">
  <h3>Add Notice</h3>
  <?php if ($err) echo "<div class='alert alert-danger'>$err</div>"; ?>
  <form method="post" enctype="multipart/form-data" class="mt-3">
    <div class="mb-3"><label>Title</label><input class="form-control" name="title" required></div>
    <div class="mb-3"><label>Description</label><textarea class="form-control" name="description" rows="5"></textarea></div>
    <div class="mb-3"><label>Attach file (optional)</label><input type="file" class="form-control" name="file"></div>
    <button name="save" class="btn btn-success">Save</button>
    <a href="manage_notices.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>
</body>
</html>