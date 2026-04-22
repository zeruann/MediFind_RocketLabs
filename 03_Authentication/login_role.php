<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MediFind: Malaybalay Medicine Availability Checker</title>

    <link rel="icon" href="/07_Assets/images/logo.png" type="image/png" />
    
    <link rel="stylesheet" href="07_Assets/css/user-role.css" />
    <link rel="stylesheet" href="07_Assets/node_modules/material-symbols/outlined.css" />
    <link rel="stylesheet" href="07_Assets/css/login-role.css" />

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">


    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <link
      href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap"
      rel="stylesheet"
    />



  </head>
  <body>
    <!-- START OF NAVBAR -->
    <nav class="navbar navbar-expand-lg border-bottom py-3 px-5">
      <div class="container-fluid">
        <div class="navbar-logo" href="#">
          Medi<span class="brand2">Find</span>
          <span class="brand-tagline"
            >Malaybalay Medicine Availability Checker</span
          >
        </div>

        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarToggler"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarToggler">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-5 me-4">
            <li class="nav-item"><a class="nav-link" href="landing_page.html">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
            <li class="nav-item"><a class="nav-link" href="#">FAQs</a></li>
          </ul>
          <div class="d-flex gap-3">
            <a href="#" class="btn btn-login px-5 py-2 rounded-pill">Login</a>
            <a href="#" class="btn btn-signup px-5 py-2 rounded-pill"
              >Sign Up</a
            >
          </div>
        </div>
      </div>
    </nav>

    <!-- END OF NAVBAR -->
    <!-- ================================================================================================== -->

    <!-- START OF MAIN CONTENT -->

    <main class="main-content">
      <div class="hero-card">
        <div class="hero-title">Medi<span>Find</span></div>
        <div class="hero-subtitle">
          Malaybalay Medicine Availability Checker
        </div>
        <p>
          Select an Account Type to Continue
        </p>

        <div class="btn-stack">
          <a href="#" class="card-btn card-btn-primary">
             Patient
          </a>
          <a href="#" class="card-btn card-btn-primary">
             Pharmacy Admin
          </a>
          <a href="#" class="card-btn card-btn-primary">
             System Admin
          </a>
        </div>


      </div>
    </main>

    <!-- END OF MAIN CONTENT -->
    <!-- ================================================================================================== -->

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
      // Tab switching
      document.querySelectorAll(".card-tab").forEach((tab) => {
        tab.addEventListener("click", () => {
          const siblings = tab.parentElement.querySelectorAll(".card-tab");
          siblings.forEach((t) => t.classList.remove("active"));
          tab.classList.add("active");
        });
      });
    </script>
  </body>
</html>
