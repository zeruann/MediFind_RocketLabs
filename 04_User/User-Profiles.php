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
    <div class="main-panel d-flex flex-column flex-grow-1">
      <div id="content">
        <div class="content-body">
          <div class="profile-page">

            <!-- ── Success / Error Toast ───────────────────────────── -->
            <?php if (isset($_SESSION['success'])): ?>
              <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                <?= htmlspecialchars($_SESSION['success']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>
              <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
              <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                <?= htmlspecialchars($_SESSION['error']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>
              <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <!-- ── Top Profile Card ────────────────────────────────── -->
            <div class="profile-header-card">
              <div class="profile-header-left">
                <div class="profile-avatar">
                  <img src="<?= $_SESSION['profile_pic']
                    ? htmlspecialchars($_SESSION['profile_pic'])
                    : '../07_Assets/images/person.jpg' ?>" alt="Profile Picture" />
                </div>

                <div class="profile-user-details">
                  <h2><?= htmlspecialchars(strtoupper($_SESSION['full_name'] ?? '')) ?></h2>
                  <p><?= htmlspecialchars($_SESSION['Email'] ?? '') ?></p>
                  <p><?= htmlspecialchars($_SESSION['Phone'] ?? '') ?></p>
                </div>
              </div>

              <div class="profile-header-divider"></div>

              <div class="profile-header-center">
                <img src="../07_Assets/images/logo.png" alt="MediFind Logo" class="medifind-logo" />
                <div class="brand-text">
                  <h1>Medi<span>Find</span></h1>
                  <small>Malaybalay Medicine Availability Checker</small>
                </div>
              </div>
            </div>

            <!-- ── Tabs Nav ────────────────────────────────────────── -->
            <div class="profile-tabs-nav">
              <button class="tab-btn active" data-tab="edit">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                  <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>
                Edit Profile
              </button>
              <button class="tab-btn" data-tab="saved">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z" />
                </svg>
                Saved
              </button>
              <button class="tab-btn" data-tab="settings">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="12" r="3" />
                  <path
                    d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z" />
                </svg>
                Settings
              </button>
              <button class="tab-btn" data-tab="help">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="12" r="10" />
                  <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                  <line x1="12" y1="17" x2="12.01" y2="17" />
                </svg>
                Help & Support
              </button>
              <button class="tab-btn" data-tab="about">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="12" r="10" />
                  <line x1="12" y1="8" x2="12" y2="12" />
                  <line x1="12" y1="16" x2="12.01" y2="16" />
                </svg>
                About
              </button>
            </div>

            <!-- ── Tab Content ─────────────────────────────────────── -->
            <div class="profile-tab-content">

              <!-- EDIT PROFILE TAB -->
              <div class="tab-panel active" id="tab-edit" style="margin-bottom: 70px;">
                <div class="profile-info-card">
                  <form method="POST" action="../02_Actions/04_Users-Actions/profile_update.php" id="profileForm">
                    <div class="row g-4">

                      <!-- LEFT: Basic Info -->
                      <div class="col-lg-6">
                        <div class="info-section">
                          <h4>Basic Information</h4>
                          <div class="row g-3">
                            <div class="col-md-6">
                              <label>First Name</label>
                              <input type="text" name="first_name" class="form-control custom-input"
                                value="<?= htmlspecialchars($_SESSION['fname'] ?? '') ?>" placeholder="First Name"
                                required />
                            </div>
                            <div class="col-md-6">
                              <label>Middle Name</label>
                              <input type="text" name="middle_name" class="form-control custom-input"
                                value="<?= htmlspecialchars($_SESSION['mname'] ?? '') ?>" placeholder="Middle Name" />
                            </div>
                            <div class="col-md-6">
                              <label>Last Name</label>
                              <input type="text" name="last_name" class="form-control custom-input"
                                value="<?= htmlspecialchars($_SESSION['lname'] ?? '') ?>" placeholder="Last Name"
                                required />
                            </div>
                            <div class="col-md-6">
                              <label>Contact Number</label>
                              <input type="text" name="phone" class="form-control custom-input"
                                value="<?= htmlspecialchars($_SESSION['Phone'] ?? '') ?>"
                                placeholder="Contact Number" />
                            </div>
                            <div class="col-md-6">
                              <label class="d-block mb-1">Gender</label>
                              <div class="d-flex flex-wrap gap-3">
                                <?php foreach (['M' => 'Male', 'F' => 'Female'] as $val => $label): ?>
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value="<?= $val ?>"
                                      <?= isset($_SESSION['Gender']) && strtoupper($_SESSION['Gender']) === $val ? 'checked' : '' ?>>
                                    <label class="form-check-label"><?= $label ?></label>
                                  </div>
                                <?php endforeach; ?>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <label>Birth Date</label>
                              <input type="date" name="birth_date" class="form-control custom-input"
                                value="<?= htmlspecialchars(substr($_SESSION['Birthdate'] ?? '', 0, 10)) ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- RIGHT: Address + Login Info -->
                      <div class="col-lg-6">
                        <div class="info-section mb-4">
                          <h4>Address Information</h4>
                          <div class="row g-3">
                            <div class="col-md-6">
                              <label>Province</label>
                              <select class="form-control custom-input" id="Province_ID" name="province">
                                <option value="" disabled selected>Select Province</option>
                              </select>
                            </div>
                            <div class="col-md-6">
                              <label>City / Municipality</label>
                              <select class="form-control custom-input" id="City_ID" name="city">
                                <option value="" disabled selected>Select City</option>
                              </select>
                            </div>
                            <div class="col-md-6">
                              <label>Barangay</label>
                              <select class="form-control custom-input" id="Barangay_ID" name="barangay">
                                <option value="" disabled selected>Select Barangay</option>
                              </select>
                            </div>
                            <div class="col-md-6">
                              <label>Purok/Street</label>
                              <input type="text" name="street" class="form-control custom-input"
                                value="<?= htmlspecialchars($_SESSION['Street'] ?? '') ?>" placeholder="Purok/Street" />
                            </div>
                          </div>
                        </div>

                        <div class="info-section">
                          <h4>Login Information</h4>
                          <div class="row g-3">
                            <div class="col-12">
                              <label>Email</label>
                              <input type="email" name="email" class="form-control custom-input"
                                value="<?= htmlspecialchars($_SESSION['Email'] ?? '') ?>" placeholder="Email"
                                required />
                            </div>
                            <div class="col-md-6">
                              <label>New Password</label>
                              <div class="input-group">
                                <input type="password" name="password" id="pw1" class="form-control custom-input"
                                  placeholder="Leave blank to keep current" />
                                <button type="button" class="btn btn-outline-secondary"
                                  onclick="togglePw('pw1','e1s','e1h')">
                                  <svg id="e1s" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                  </svg>
                                  <svg id="e1h" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                    stroke-linejoin="round" style="display:none">
                                    <path
                                      d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" />
                                    <line x1="1" y1="1" x2="23" y2="23" />
                                  </svg>
                                </button>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <label>Confirm Password</label>
                              <div class="input-group">
                                <input type="password" name="confirm_password" id="pw2"
                                  class="form-control custom-input" placeholder="Confirm password"
                                  oninput="checkMatch()" />
                                <button type="button" class="btn btn-outline-secondary"
                                  onclick="togglePw('pw2','e2s','e2h')">
                                  <svg id="e2s" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                  </svg>
                                  <svg id="e2h" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                    stroke-linejoin="round" style="display:none">
                                    <path
                                      d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" />
                                    <line x1="1" y1="1" x2="23" y2="23" />
                                  </svg>
                                </button>
                              </div>
                              <small id="match-msg" class="mt-1 d-block"></small>
                            </div>
                          </div>
                        </div>
                      </div>



                    </div>

                    <div class="edit-save-row">
                      <button type="submit" class="btn-profile btn-edit">Save Changes</button>
                      <!-- Cancel reloads the page, discarding unsaved changes -->
                      <button type="button" class="btn-profile btn-cancel"
                        onclick="window.location.href='05_Profile.php'">
                        Cancel
                      </button>
                    </div>
                  </form>
                </div>
              </div>


              <!-- SAVED TAB -->
              <div class="tab-panel" id="tab-saved">
                <div class="profile-info-card tab-empty-state">
                  <div class="empty-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#20a16b" stroke-width="1.5">
                      <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z" />
                    </svg>
                  </div>
                  <h5>Nothing Saved Yet</h5>
                  <p>Medicines and pharmacies you save will appear here.</p>
                </div>
              </div>

              <!-- SETTINGS TAB -->
              <div class="tab-panel" id="tab-settings">
                <div class="profile-info-card">
                  <div class="info-section">
                    <h4>Settings</h4>
                    <div class="settings-list">
                      <div class="settings-item">
                        <span>Notifications</span>
                        <label class="toggle-switch">
                          <input type="checkbox" checked />
                          <span class="toggle-slider"></span>
                        </label>
                      </div>
                      <div class="settings-item">
                        <span>Location Access</span>
                        <label class="toggle-switch">
                          <input type="checkbox" />
                          <span class="toggle-slider"></span>
                        </label>
                      </div>
                      <div class="settings-item">
                        <span>Dark Mode</span>
                        <label class="toggle-switch">
                          <input type="checkbox" />
                          <span class="toggle-slider"></span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- HELP & SUPPORT TAB -->
              <div class="tab-panel" id="tab-help">
                <div class="profile-info-card">
                  <div class="info-section">
                    <h4>Help & Support</h4>
                    <div class="help-list">
                      <div class="help-item">
                        <strong>How do I search for medicines?</strong>
                        <p>Go to the Medicines tab and type the name of the medicine you're looking for.</p>
                      </div>
                      <div class="help-item">
                        <strong>How does Scan RX work?</strong>
                        <p>Take a photo of your prescription and we'll identify the medicines listed.</p>
                      </div>
                      <div class="help-item">
                        <strong>Contact Us</strong>
                        <p>Email us at <a href="mailto:support@medifind.ph">support@medifind.ph</a></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- ABOUT TAB -->
              <div class="tab-panel" id="tab-about">
                <div class="profile-info-card">
                  <div class="info-section">
                    <h4>About MediFind</h4>
                    <p class="about-text">
                      MediFind is a medicine availability checker for Malaybalay City.
                      It helps residents quickly locate medicines in nearby pharmacies.
                    </p>
                    <div class="about-meta">
                      <span>Version 1.0.0</span>
                      <span>Malaybalay, Bukidnon</span>
                    </div>
                  </div>
                </div>
              </div>

            </div><!-- /.profile-tab-content -->

            
          </div><!-- /.profile-page -->
        </div>
      </div>
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