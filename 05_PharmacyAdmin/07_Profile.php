<?php
require_once '../02_Actions/GlobalVariables.php';
require_once '../00_Config/config.php';

if (!$_SESSION['user_id']) {
  header('Location: ../03_Authentication/login.php');
  exit;
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MediFind: Profile</title>

  <link rel="icon" href="../07_Assets/images/logo.png" type="image/png" />
  <link href="../07_Assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../07_Assets/css/01_PatientUser CSS/profile.css" />

  <!-- Page transition -->
  <?php include '../01_Includes/page-transition-hardcode.php' ?>
</head>

<body>
  <div class="wrapper d-flex align-items-stretch">
    <div id="pharmacy-sidebar-container"></div>

    <div class="main-panel d-flex flex-column flex-grow-1">
      <div id="topbar-container"></div>

      <?php include '../04_User/User-Profiles.php' ?>
      
    </div>
  </div>

  <script src="../07_Assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../07_Assets/css/js/sidebar_and_topbar.js"></script>

  <script>
    // ── Tab switching ──────────────────────────────────────────────────
    document.querySelectorAll(".tab-btn").forEach((btn) => {
      btn.addEventListener("click", () => {
        const target = btn.dataset.tab;
        document.querySelectorAll(".tab-btn").forEach((b) => b.classList.remove("active"));
        document.querySelectorAll(".tab-panel").forEach((p) => p.classList.remove("active"));
        btn.classList.add("active");
        document.getElementById("tab-" + target).classList.add("active");
      });
    });

    // ── Auto-dismiss alerts after 4 seconds ───────────────────────────
    document.querySelectorAll('.alert').forEach(function (alert) {
      setTimeout(function () {
        var bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
      }, 4000);
    });
  </script>

  <script>
    const savedProvinceName = "<?= htmlspecialchars($_SESSION['Province_Name'] ?? '') ?>";
    const savedCityName = "<?= htmlspecialchars($_SESSION['City_Name'] ?? '') ?>";
    const savedBarangayName = "<?= htmlspecialchars($_SESSION['Barangay_Name'] ?? '') ?>";

    // ── Load provinces on page load ──────────────────────────────
    fetch('../02_Actions/01_Authentication-CRUD/get_address.php?type=province')
      .then(r => r.json())
      .then(data => {
        const sel = document.getElementById('Province_ID');
        data.forEach(p => {
          const opt = document.createElement('option');
          opt.value = p.Province_ID;
          opt.textContent = p.Province_Name;
          if (p.Province_Name === savedProvinceName) {
            opt.selected = true;
            // Auto-load cities for saved province
            loadCities(p.Province_ID);
          }
          sel.appendChild(opt);
        });
      });

    // ── Load cities ───────────────────────────────────────────────
    function loadCities(provinceId) {
      const citySelect = document.getElementById('City_ID');
      const brgySelect = document.getElementById('Barangay_ID');
      citySelect.innerHTML = '<option value="" disabled selected>Select City</option>';
      brgySelect.innerHTML = '<option value="" disabled selected>Select Barangay</option>';

      fetch(`../02_Actions/01_Authentication-CRUD/get_address.php?type=city&province_id=${provinceId}`)
        .then(r => r.json())
        .then(data => {
          data.forEach(c => {
            const opt = document.createElement('option');
            opt.value = c.City_ID;
            opt.textContent = c.City_Name;
            if (c.City_Name === savedCityName) {
              opt.selected = true;
              // Auto-load barangays for saved city
              loadBarangays(c.City_ID);
            }
            citySelect.appendChild(opt);
          });
        });
    }

    // ── Load barangays ────────────────────────────────────────────
    function loadBarangays(cityId) {
      const brgySelect = document.getElementById('Barangay_ID');
      brgySelect.innerHTML = '<option value="" disabled selected>Select Barangay</option>';

      fetch(`../02_Actions/01_Authentication-CRUD/get_address.php?type=barangay&city_id=${cityId}`)
        .then(r => r.json())
        .then(data => {
          data.forEach(b => {
            const opt = document.createElement('option');
            opt.value = b.Barangay_ID;
            opt.textContent = b.Barangay_Name;
            if (b.Barangay_Name === savedBarangayName) opt.selected = true;
            brgySelect.appendChild(opt);
          });
        });
    }

    // ── Province change ───────────────────────────────────────────
    document.getElementById('Province_ID').addEventListener('change', function () {
      loadCities(this.value);
    });

    // ── City change ───────────────────────────────────────────────
    document.getElementById('City_ID').addEventListener('change', function () {
      loadBarangays(this.value);
    });
  </script>


  <!-- TOGGLE PASSWORD -->
  <script>
    function togglePw(inputId, showId, hideId) {
      var input = document.getElementById(inputId);
      var isHidden = input.type === 'password';
      input.type = isHidden ? 'text' : 'password';
      document.getElementById(showId).style.display = isHidden ? 'none' : 'block';
      document.getElementById(hideId).style.display = isHidden ? 'block' : 'none';
    }
    function checkMatch() {
      var p1 = document.getElementById('pw1').value;
      var p2 = document.getElementById('pw2').value;
      var msg = document.getElementById('match-msg');
      if (!p2) { msg.textContent = ''; return; }
      if (p1 === p2) { msg.textContent = 'Passwords match'; msg.style.color = 'green'; }
      else { msg.textContent = 'Passwords do not match'; msg.style.color = 'red'; }
    }
  </script>
</body>

</html>