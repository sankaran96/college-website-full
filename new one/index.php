<?php include 'navbar.php'; ?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>My College</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <!-- navbar included by PHP above -->

  <header class="hero text-center">
    <div class="container">

      <img src="cmd.jpeg" class="rounded float-start" alt="..." height="100">
      <img src="tn.jpeg" class="rounded float-end" alt="..." height="100">
    <div class="row align-items-center">
      <div class="col-md-6">
      <h1 class="display-8 fw-bold">Government Arts College(grade-1)</h1>
      <p class="lead">B.muttur,Chidambaram-608102</p>
       <p class="lead">Tamilnadu,India.</p>
      </div>
       
      <div class="col-md-6">
      <h1 class="display-8 fw-bold">அரசு கலைக் கல்லூரி(நிலை-1)</h1>
      <p class="lead">B.முட்லூர்,சிதம்பரம்-608102</p>
       <p class="lead">தமிழ்நாடு, இந்தியா.</p>
      </div>
    </div>
      <a href="about.php" class="btn btn-light btn-lg">Learn More</a>
    </div>
  </header>
  <section class="py-5">
    <div class="container">
      <h2 class="mb-4">Latest Notices</h2>
      <div class="row">
        <?php
        require_once 'db.php';
        $conn = getConn();
        $res = $conn->query("SELECT id, title, description, created_at FROM notices ORDER BY created_at DESC LIMIT 3");
        if ($res && $res->num_rows>0) {
            while ($row = $res->fetch_assoc()) {
                echo '<div class="col-md-4 mb-3"><div class="card h-100 shadow-sm"><div class="card-body">';
                echo '<h5 class="card-title">'.htmlspecialchars($row['title']).'</h5>';
                echo '<p class="card-text">'.htmlspecialchars(substr($row['description'],0,120)).'...</p>';
                echo '</div><div class="card-footer"><small class="text-muted">'.htmlspecialchars($row['created_at']).'</small></div></div></div>';
            }
        } else {
            echo '<p class="ms-3">No notices yet.</p>';
        }
        ?>
      </div>
    </div>
  </section>

  <div class="row align-items-center">
       <div class="col-md-6">
          <video width="400" height="200" controls>
          <source src="intro.mp4" type="video/mp4">
          Your browser does not support the video tag.
          </video> 
       </div>

       <div class="col-md-3">
        <h3></h3>
       </div>

       <div class="col-md-3">
        <h3></h3>
       </div>
  </div>


  <footer class="py-4 text-center">
    <div class="container">
      <p>&copy; <?php echo date('Y'); ?> My College</p>
    </div>


  </footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>