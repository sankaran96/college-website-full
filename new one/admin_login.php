<?php
require_once 'db.php';
session_start();
$err = '';
if (isset($_POST['login'])) {
    $user = trim($_POST['username']);
    $pass = $_POST['password'];
    $conn = getConn();
    $stmt = $conn->prepare("SELECT id, password FROM admin WHERE username = ?");
    $stmt->bind_param('s', $user);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $hash);
        $stmt->fetch();
        if (password_verify($pass, $hash)) {
            $_SESSION['admin_id'] = $id;
            $_SESSION['admin_user'] = $user;
            header('Location: admin_dashboard.php');
            exit;
        } else $err = 'Invalid credentials';
    } else $err = 'Invalid credentials';
    $stmt->close();
}
?>
<?php include 'navbar.php'; ?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card shadow">
        <div class="card-body">
          <h3 class="card-title">Admin Login</h3>
          <?php if ($err): ?><div class="alert alert-danger"><?php echo $err; ?></div><?php endif; ?>
          <form method="post">
            <div class="mb-3"><label class="form-label">Username</label><input class="form-control" name="username" required></div>
            <div class="mb-3"><label class="form-label">Password</label><input type="password" class="form-control" name="password" required></div>
            <button class="btn btn-primary w-100" name="login">Login</button>
          </form>
          <p class="mt-3 small">Sample: admin / admin123</p>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>