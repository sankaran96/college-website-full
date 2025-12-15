<?php include 'navbar.php'; ?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Contact - My College</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container py-5">
    <h1>Contact Us</h1>
    <div class="row g-4">
      <div class="col-md-6">
        <form method="post" action="contact_process.php">
          <div class="mb-3"><label class="form-label">Name</label><input class="form-control" name="name" required></div>
          <div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control" name="email" required></div>
          <div class="mb-3"><label class="form-label">Message</label><textarea class="form-control" name="message" rows="4" required></textarea></div>
          <button class="btn btn-primary">Send Message</button>
        </form>
      </div>
      <div class="col-md-6">
        <h5>Address</h5>
        <p>123 College Road, City, State, ZIP</p>
        <h5>Phone</h5>
        <p>+91 98765 43210</p>
        <h5>Email</h5>
        <p>info@mycollege.edu</p>
      </div>
    </div>
  </div>
</body>
</html>