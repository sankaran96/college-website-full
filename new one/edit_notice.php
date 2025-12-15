<?php
require_once 'db.php';
session_start();
if (!isset($_SESSION['admin_id'])) { header('Location: admin_login.php'); exit; }
$conn = getConn();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $desc = trim($_POST['description']);
    $filePath = null;

    // existing file path keep
    $stmt0 = $conn->prepare("SELECT file_path FROM notices WHERE id = ?");
    $stmt0->bind_param('i', $id);
    $stmt0->execute();
    $stmt0->bind_result($existingFile);
    $stmt0->fetch();
    $stmt0->close();

    if (!empty($_FILES['file']['name'])) {
        $uploadsDir = 'assets/uploads/';
        if (!is_dir($uploadsDir)) mkdir($uploadsDir, 0755, true);
        $target = $uploadsDir . time() . '_' . basename($_FILES['file']['name']);
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
            $filePath = $target;
            if ($existingFile && file_exists($existingFile)) @unlink($existingFile);
        }
    } else {
        $filePath = $existingFile;
    }

    $stmt = $conn->prepare("UPDATE notices SET title=?, description=?, file_path=? WHERE id=?");
    $stmt->bind_param('sssi', $title, $desc, $filePath, $id);
    if ($stmt->execute()) {
        header('Location: manage_notices.php');
        exit;
    } else {
        $err = 'Update failed';
    }
}

// load existing
$stmt2 = $conn->prepare("SELECT title, description, file_path FROM notices WHERE id = ?");
$stmt2->bind_param('i', $id);
$stmt2->execute();
$stmt2->bind_result($titleVal, $descVal, $fileVal);
$stmt2->fetch();
$stmt2->close();

include 'navbar.php';
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Edit Notice</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body>
<div class="container py-5">
  <h3>Edit Notice</h3>
  <?php if ($err) echo "<div class='alert alert-danger'>$err</div>"; ?>
  <form method="post" enctype="multipart/form-data" class="mt-3">
    <div class="mb-3"><label>Title</label><input class="form-control" name="title" value="<?php echo htmlspecialchars($titleVal); ?>" required></div>
    <div class="mb-3"><label>Description</label><textarea class="form-control" name="description" rows="5"><?php echo htmlspecialchars($descVal); ?></textarea></div>
    <div class="mb-3"><label>Replace file (optional)</label><input type="file" class="form-control" name="file"></div>
    <?php if ($fileVal): ?>
      <p>Current file: <a href="<?php echo htmlspecialchars($fileVal); ?>" target="_blank">View</a></p>
    <?php endif; ?>
    <button class="btn btn-primary">Update</button>
    <a href="manage_notices.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>
</body>
</html>