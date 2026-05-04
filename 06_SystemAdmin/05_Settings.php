<?php
// Global Variable and DB Connection
include_once '../02_Actions/GlobalVariables.php';
include_once '../00_Config/config.php';

require '../02_Actions/04_System-Admin-CRUD/select-count.php';

// ── GUARD: Users must log in ────────────────────────
if (!$_SESSION['user_id']) {
  header('Location: ../03_Authentication/login.php');
  exit;
}

// ── Handle Settings Save (POST) ────────────────────
$successMsg = '';
$errorMsg   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_settings'])) {
  // Example: save to a settings table or config file
  // $stmt = $pdo->prepare("UPDATE system_settings SET value = ? WHERE key = ?");
  // For now we just flash a success message
  $successMsg = 'Settings saved successfully.';
}
?>

<!doctype html>
<html class="is-animating">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="../07_Assets/images/logo.png" type="image/png" />
  <title>Settings</title>

  <script src="../07_Assets/css/js/sidebar_and_topbar.js"></script>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

  <!-- jQuery -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

  <!-- STYLES -->
  <link rel="stylesheet" href="../07_Assets/css/00_Global CSS/override-fonts.css" />
  <link rel="stylesheet" href="../07_Assets/css/01_PatientUser CSS/01_Home.css" />
  <link rel="stylesheet" href="../07_Assets/css/02_PharmacyAdmin CSS/01_dashboard.css">
  <link rel="stylesheet" href="../07_Assets/css/02_PharmacyAdmin CSS/02_ManageInventory.css">
  <link rel="stylesheet" href="../07_Assets/css/00_Global CSS/override-body-css.css">

  <!-- Page transition -->
  <?php include '../01_Includes/page-transition-hardcode.php' ?>

  <style>
    body {
      overflow: auto;
    }

    /* ── Settings Tabs (matches reports page rtab pattern) ── */
    .settings-tabs {
      display: flex;
      gap: 4px;
      padding: 0 1.5rem;
      border-bottom: 1.5px solid #e9ecef;
      background: #fff;
      margin-bottom: 0;
    }

    .stab {
      padding: 12px 18px;
      font-size: 13px;
      font-weight: 500;
      color: #6c757d;
      background: transparent;
      border: none;
      border-bottom: 2.5px solid transparent;
      margin-bottom: -1.5px;
      cursor: pointer;
      transition: color 0.15s, border-color 0.15s;
      display: flex;
      align-items: center;
      gap: 7px;
    }

    .stab:hover {
      color: #343a40;
    }

    .stab.active {
      color: #1d9e75;
      border-bottom-color: #1d9e75;
    }

    /* ── Panel visibility ── */
    .settings-panel {
      display: none;
    }

    .settings-panel.active {
      display: block;
    }

/* ── Content wrapper ── */
.settings-content {
  padding: 1.5rem;
  /* max-width: 860px;  ← remove or comment out this line */
}

    /* ── Section cards (reuses stat-card look) ── */
    .settings-section {
      background: #fff;
      border: 1px solid #e9ecef;
      border-radius: 12px;
      padding: 1.25rem 1.5rem;
      margin-bottom: 1rem;
    }

    .settings-section-title {
      font-size: 14px;
      font-weight: 600;
      color: #212529;
      margin-bottom: 3px;
    }

    .settings-section-desc {
      font-size: 12px;
      color: #6c757d;
      margin-bottom: 1.1rem;
    }

    /* ── Form fields ── */
    .settings-label {
      font-size: 12px;
      font-weight: 500;
      color: #495057;
      margin-bottom: 5px;
      display: block;
    }

    .settings-input,
    .settings-select {
      width: 100%;
      padding: 8px 11px;
      border: 1px solid #dee2e6;
      border-radius: 8px;
      font-size: 13px;
      color: #212529;
      background: #fff;
      transition: border-color 0.15s;
      outline: none;
    }

    .settings-input:focus,
    .settings-select:focus {
      border-color: #1d9e75;
      box-shadow: 0 0 0 3px rgba(29, 158, 117, 0.1);
    }

    /* ── Toggle rows ── */
    .toggle-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 11px 0;
      border-bottom: 1px solid #f1f3f5;
    }

    .toggle-row:last-child {
      border-bottom: none;
    }

    .toggle-label {
      font-size: 13px;
      font-weight: 500;
      color: #212529;
    }

    .toggle-desc {
      font-size: 12px;
      color: #6c757d;
      margin-top: 2px;
    }

    /* Custom toggle switch */
    .tog {
      position: relative;
      width: 38px;
      height: 21px;
      flex-shrink: 0;
    }

    .tog input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .tog-slider {
      position: absolute;
      inset: 0;
      background: #ced4da;
      border-radius: 21px;
      cursor: pointer;
      transition: background 0.2s;
    }

    .tog-slider:before {
      content: '';
      position: absolute;
      width: 15px;
      height: 15px;
      left: 3px;
      top: 3px;
      background: #fff;
      border-radius: 50%;
      transition: transform 0.2s;
    }

    .tog input:checked+.tog-slider {
      background: #1d9e75;
    }

    .tog input:checked+.tog-slider:before {
      transform: translateX(17px);
    }

    /* ── Divider ── */
    .settings-divider {
      border: none;
      border-top: 1px solid #f1f3f5;
      margin: 1rem 0;
    }

    /* ── Metric mini-cards ── */
    .sys-info-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
      gap: 10px;
      margin-top: 4px;
    }

    .sys-info-card {
      background: #f8f9fa;
      border-radius: 8px;
      padding: 10px 14px;
    }

    .sys-info-card .si-label {
      font-size: 11px;
      color: #6c757d;
      margin-bottom: 4px;
    }

    .sys-info-card .si-value {
      font-size: 14px;
      font-weight: 600;
      color: #212529;
    }

    /* ── Admin user row ── */
    .admin-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 9px 0;
      border-bottom: 1px solid #f1f3f5;
    }

    .admin-row:last-of-type {
      border-bottom: none;
    }

    .admin-avatar {
      width: 34px;
      height: 34px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
      font-weight: 600;
      flex-shrink: 0;
    }

    .admin-name {
      font-size: 13px;
      font-weight: 500;
      color: #212529;
    }

    .admin-email {
      font-size: 12px;
      color: #6c757d;
    }

    /* ── Badges ── */
    .badge-role {
      padding: 4px 11px;
      border-radius: 20px;
      font-size: 11px;
      font-weight: 500;
    }

    .badge-superadmin {
      background: #d4f5e2;
      color: #1a7a45;
    }

    .badge-staffadmin {
      background: #fff3cd;
      color: #856404;
    }

    /* ── Save / action buttons ── */
    .btn-settings-save {
      background-color: #1d9e75;
      border-color: #1d9e75;
      color: #fff;
      font-size: 13px;
      padding: 8px 22px;
      border-radius: 8px;
      font-weight: 500;
      border: none;
      cursor: pointer;
      transition: background 0.15s;
    }

    .btn-settings-save:hover {
      background-color: #178a63;
    }

    .btn-settings-outline {
      background: transparent;
      border: 1px solid #dee2e6;
      color: #495057;
      font-size: 13px;
      padding: 7px 16px;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.15s;
    }

    .btn-settings-outline:hover {
      background: #f8f9fa;
    }

    /* ── Alert toast ── */
    .settings-alert {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 14px;
      border-radius: 8px;
      font-size: 13px;
      margin-bottom: 1rem;
    }

    .settings-alert.success {
      background: #d4f5e2;
      color: #1a7a45;
      border: 1px solid #a3e4c1;
    }

    .settings-alert.error {
      background: #fde8e8;
      color: #c0392b;
      border: 1px solid #f7c1c1;
    }

    /* ── Page header ── */
    .settings-page-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 1.1rem 1.5rem 0.6rem;
    }

    .settings-page-title {
      font-size: 18px;
      font-weight: 600;
      color: #212529;
    }

    .settings-page-sub {
      font-size: 12px;
      color: #6c757d;
      margin-top: 2px;
    }
  </style>
</head>

<body>
  <div class="wrapper d-flex align-items-stretch">
    <div id="system-sidebar-container"></div>

    <div class="main-panel d-flex flex-column flex-grow-1">
      <div id="topbar-container"></div>

      <div class="content">

        <!-- ── Page Header ──────────────────────────────────────── -->
        <div class="settings-page-header">
          <div>
            <div class="settings-page-title">
              <span class="material-symbols-outlined" style="font-size:20px; vertical-align:-4px; color:#1d9e75; margin-right:6px;">settings</span>
              Settings
            </div>
            <div class="settings-page-sub">Manage system configuration and preferences</div>
          </div>
          <button class="btn-settings-save" onclick="saveSettings()">
            <span class="material-symbols-outlined" style="font-size:15px; vertical-align:-3px; margin-right:4px;">save</span>
            Save changes
          </button>
        </div>

        <!-- ── Tabs ─────────────────────────────────────────────── -->
        <div class="settings-tabs">
          <button class="stab active" onclick="switchSettingsTab('general', this)">
            <span class="material-symbols-outlined" style="font-size:15px;">tune</span> General
          </button>
          <button class="stab" onclick="switchSettingsTab('security', this)">
            <span class="material-symbols-outlined" style="font-size:15px;">lock</span> Security
          </button>
          <button class="stab" onclick="switchSettingsTab('notifications', this)">
            <span class="material-symbols-outlined" style="font-size:15px;">notifications</span> Notifications
          </button>
          <button class="stab" onclick="switchSettingsTab('users', this)">
            <span class="material-symbols-outlined" style="font-size:15px;">manage_accounts</span> Users & Roles
          </button>
          <button class="stab" onclick="switchSettingsTab('system', this)">
            <span class="material-symbols-outlined" style="font-size:15px;">dns</span> System
          </button>
        </div>

        <!-- ── Settings Content ──────────────────────────────────── -->
        <div class="settings-content">

          <?php if ($successMsg): ?>
            <div class="settings-alert success">
              <span class="material-symbols-outlined" style="font-size:16px;">check_circle</span>
              <?= htmlspecialchars($successMsg) ?>
            </div>
          <?php endif; ?>

          <?php if ($errorMsg): ?>
            <div class="settings-alert error">
              <span class="material-symbols-outlined" style="font-size:16px;">error</span>
              <?= htmlspecialchars($errorMsg) ?>
            </div>
          <?php endif; ?>

          <form method="POST" id="settingsForm">
            <input type="hidden" name="save_settings" value="1">

            <!-- ══ GENERAL PANEL ═══════════════════════════════════ -->
            <div class="settings-panel active" id="panel-general">

              <div class="settings-section">
                <div class="settings-section-title">Clinic information</div>
                <div class="settings-section-desc">Basic details shown across the system</div>

                <div class="row g-3">
                  <div class="col-12 col-md-6">
                    <label class="settings-label">Clinic name</label>
                    <input type="text" name="clinic_name" class="settings-input" value="MediFind Health Center" />
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="settings-label">Contact number</label>
                    <input type="text" name="clinic_phone" class="settings-input" value="+63 912 345 6789" />
                  </div>
                  <div class="col-12">
                    <label class="settings-label">Address</label>
                    <input type="text" name="clinic_address" class="settings-input" value="Cagayan de Oro City, Misamis Oriental" />
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="settings-label">Email address</label>
                    <input type="email" name="clinic_email" class="settings-input" value="admin@medifind.com" />
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="settings-label">Website</label>
                    <input type="text" name="clinic_website" class="settings-input" placeholder="https://..." />
                  </div>
                </div>
              </div>

              <div class="settings-section">
                <div class="settings-section-title">Regional preferences</div>
                <div class="settings-section-desc">Localization and display settings</div>

                <div class="row g-3">
                  <div class="col-12 col-md-6">
                    <label class="settings-label">Timezone</label>
                    <select name="timezone" class="settings-select">
                      <option value="Asia/Manila" selected>Asia/Manila (UTC+8)</option>
                      <option value="UTC">UTC</option>
                    </select>
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="settings-label">Date format</label>
                    <select name="date_format" class="settings-select">
                      <option value="MM/DD/YYYY">MM/DD/YYYY</option>
                      <option value="DD/MM/YYYY">DD/MM/YYYY</option>
                      <option value="YYYY-MM-DD">YYYY-MM-DD</option>
                    </select>
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="settings-label">Language</label>
                    <select name="language" class="settings-select">
                      <option value="en" selected>English</option>
                      <option value="fil">Filipino</option>
                    </select>
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="settings-label">Currency</label>
                    <select name="currency" class="settings-select">
                      <option value="PHP" selected>PHP — Philippine Peso</option>
                      <option value="USD">USD — US Dollar</option>
                    </select>
                  </div>
                </div>
              </div>

            </div>
            <!-- ══ END GENERAL ════════════════════════════════════ -->


            <!-- ══ SECURITY PANEL ═════════════════════════════════ -->
            <div class="settings-panel" id="panel-security">

              <div class="settings-section">
                <div class="settings-section-title">Authentication</div>
                <div class="settings-section-desc">Control how users log in to the system</div>

                <div class="toggle-row">
                  <div>
                    <div class="toggle-label">Two-factor authentication (2FA)</div>
                    <div class="toggle-desc">Require a one-time code on every login</div>
                  </div>
                  <label class="tog"><input type="checkbox" name="enable_2fa" checked /><span class="tog-slider"></span></label>
                </div>

                <div class="toggle-row">
                  <div>
                    <div class="toggle-label">Force password reset on first login</div>
                    <div class="toggle-desc">New accounts must change their password immediately</div>
                  </div>
                  <label class="tog"><input type="checkbox" name="force_pw_reset" checked /><span class="tog-slider"></span></label>
                </div>

                <div class="toggle-row">
                  <div>
                    <div class="toggle-label">Single sign-on (SSO)</div>
                    <div class="toggle-desc">Allow login via external identity provider</div>
                  </div>
                  <label class="tog"><input type="checkbox" name="enable_sso" /><span class="tog-slider"></span></label>
                </div>
              </div>

              <div class="settings-section">
                <div class="settings-section-title">Session & password policy</div>
                <div class="settings-section-desc">Define expiry rules and password strength requirements</div>

                <div class="row g-3">
                  <div class="col-12 col-md-6">
                    <label class="settings-label">Session timeout (minutes)</label>
                    <input type="number" name="session_timeout" class="settings-input" value="30" min="5" max="480" />
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="settings-label">Max failed login attempts</label>
                    <input type="number" name="max_login_attempts" class="settings-input" value="5" min="3" max="20" />
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="settings-label">Minimum password length</label>
                    <input type="number" name="min_pw_length" class="settings-input" value="8" min="6" max="32" />
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="settings-label">Password expiry (days)</label>
                    <input type="number" name="pw_expiry_days" class="settings-input" value="90" min="30" max="365" />
                  </div>
                </div>
              </div>

            </div>
            <!-- ══ END SECURITY ═══════════════════════════════════ -->


            <!-- ══ NOTIFICATIONS PANEL ════════════════════════════ -->
            <div class="settings-panel" id="panel-notifications">

              <div class="settings-section">
                <div class="settings-section-title">Email notifications</div>
                <div class="settings-section-desc">Choose which system events trigger email alerts</div>

                <div class="toggle-row">
                  <div>
                    <div class="toggle-label">New pharmacy registration</div>
                    <div class="toggle-desc">Notify when a pharmacy submits for approval</div>
                  </div>
                  <label class="tog"><input type="checkbox" name="notif_new_pharmacy" checked /><span class="tog-slider"></span></label>
                </div>

                <div class="toggle-row">
                  <div>
                    <div class="toggle-label">Pharmacy approval / rejection</div>
                    <div class="toggle-desc">Alert when a pharmacy request is resolved</div>
                  </div>
                  <label class="tog"><input type="checkbox" name="notif_pharmacy_approval" checked /><span class="tog-slider"></span></label>
                </div>

                <div class="toggle-row">
                  <div>
                    <div class="toggle-label">New patient registration</div>
                    <div class="toggle-desc">Notify when a new patient account is created</div>
                  </div>
                  <label class="tog"><input type="checkbox" name="notif_new_patient" /><span class="tog-slider"></span></label>
                </div>

                <div class="toggle-row">
                  <div>
                    <div class="toggle-label">Suspended accounts</div>
                    <div class="toggle-desc">Alert when a user or pharmacy is suspended</div>
                  </div>
                  <label class="tog"><input type="checkbox" name="notif_suspension" checked /><span class="tog-slider"></span></label>
                </div>

                <div class="toggle-row">
                  <div>
                    <div class="toggle-label">Expired medicine stock</div>
                    <div class="toggle-desc">Weekly digest of expired inventory across pharmacies</div>
                  </div>
                  <label class="tog"><input type="checkbox" name="notif_expired_stock" checked /><span class="tog-slider"></span></label>
                </div>

                <div class="toggle-row">
                  <div>
                    <div class="toggle-label">System error alerts</div>
                    <div class="toggle-desc">Critical server or application errors</div>
                  </div>
                  <label class="tog"><input type="checkbox" name="notif_system_errors" checked /><span class="tog-slider"></span></label>
                </div>
              </div>

              <div class="settings-section">
                <div class="settings-section-title">Notification recipient</div>
                <div class="settings-section-desc">Email address that receives all system alerts</div>

                <div class="row g-3">
                  <div class="col-12 col-md-8">
                    <label class="settings-label">Admin email</label>
                    <input type="email" name="notif_email" class="settings-input" value="admin@medifind.com" />
                  </div>
                </div>
              </div>

            </div>
            <!-- ══ END NOTIFICATIONS ══════════════════════════════ -->


            <!-- ══ USERS & ROLES PANEL ════════════════════════════ -->
            <div class="settings-panel" id="panel-users">

              <div class="settings-section">
                <div class="settings-section-title">Active administrators</div>
                <div class="settings-section-desc">Users with access to this settings panel</div>

                <!-- Admin list pulled from session / DB in production -->
                <div class="admin-row">
                  <div class="d-flex align-items-center gap-2">
                    <div class="admin-avatar" style="background:#d4f5e2; color:#1a7a45;">
                      <?= strtoupper(substr($_SESSION['first_name'] ?? 'A', 0, 1) . substr($_SESSION['last_name'] ?? 'D', 0, 1)) ?>
                    </div>
                    <div>
                      <div class="admin-name"><?= htmlspecialchars(($_SESSION['first_name'] ?? 'Admin') . ' ' . ($_SESSION['last_name'] ?? 'User')) ?></div>
                      <div class="admin-email"><?= htmlspecialchars($_SESSION['email'] ?? 'admin@medifind.com') ?></div>
                    </div>
                  </div>
                  <span class="badge-role badge-superadmin">Super admin</span>
                </div>

                <hr class="settings-divider">
                <button type="button" class="btn-settings-outline">
                  <span class="material-symbols-outlined" style="font-size:14px; vertical-align:-3px; margin-right:4px;">person_add</span>
                  Add administrator
                </button>
              </div>

              <div class="settings-section">
                <div class="settings-section-title">Staff role permissions</div>
                <div class="settings-section-desc">Control what pharmacy staff accounts can access</div>

                <div class="toggle-row">
                  <div>
                    <div class="toggle-label">View patient records</div>
                    <div class="toggle-desc">Read-only access to patient data</div>
                  </div>
                  <label class="tog"><input type="checkbox" name="perm_view_patients" checked /><span class="tog-slider"></span></label>
                </div>

                <div class="toggle-row">
                  <div>
                    <div class="toggle-label">Edit medicine inventory</div>
                    <div class="toggle-desc">Add, update, or remove medicine stocks</div>
                  </div>
                  <label class="tog"><input type="checkbox" name="perm_edit_inventory" checked /><span class="tog-slider"></span></label>
                </div>

                <div class="toggle-row">
                  <div>
                    <div class="toggle-label">Generate and export reports</div>
                    <div class="toggle-desc">Download CSV and analytics reports</div>
                  </div>
                  <label class="tog"><input type="checkbox" name="perm_reports" /><span class="tog-slider"></span></label>
                </div>

                <div class="toggle-row">
                  <div>
                    <div class="toggle-label">Manage pharmacy profile</div>
                    <div class="toggle-desc">Edit pharmacy info, hours, and contact details</div>
                  </div>
                  <label class="tog"><input type="checkbox" name="perm_manage_profile" checked /><span class="tog-slider"></span></label>
                </div>
              </div>

            </div>
            <!-- ══ END USERS & ROLES ══════════════════════════════ -->


            <!-- ══ SYSTEM PANEL ═══════════════════════════════════ -->
            <div class="settings-panel" id="panel-system">

              <div class="settings-section">
                <div class="settings-section-title">Maintenance mode</div>
                <div class="settings-section-desc">Temporarily disable the system for all non-admin users</div>

                <div class="toggle-row">
                  <div>
                    <div class="toggle-label">Enable maintenance mode</div>
                    <div class="toggle-desc">Only admins can log in while this is active</div>
                  </div>
                  <label class="tog"><input type="checkbox" name="maintenance_mode" /><span class="tog-slider"></span></label>
                </div>

                <div class="toggle-row">
                  <div>
                    <div class="toggle-label">Show maintenance notice to users</div>
                    <div class="toggle-desc">Display a scheduled downtime banner on the login page</div>
                  </div>
                  <label class="tog"><input type="checkbox" name="show_maintenance_banner" checked /><span class="tog-slider"></span></label>
                </div>
              </div>

              <div class="settings-section">
                <div class="settings-section-title">Data & backups</div>
                <div class="settings-section-desc">Automated database backup schedule and retention policy</div>

                <div class="row g-3 mb-3">
                  <div class="col-12 col-md-6">
                    <label class="settings-label">Backup frequency</label>
                    <select name="backup_frequency" class="settings-select">
                      <option value="daily" selected>Daily</option>
                      <option value="weekly">Weekly</option>
                      <option value="monthly">Monthly</option>
                    </select>
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="settings-label">Retention period (days)</label>
                    <input type="number" name="backup_retention" class="settings-input" value="30" min="7" max="365" />
                  </div>
                </div>

                <button type="button" class="btn-settings-outline" onclick="triggerManualBackup()">
                  <span class="material-symbols-outlined" style="font-size:14px; vertical-align:-3px; margin-right:4px;">cloud_upload</span>
                  Run backup now
                </button>
              </div>

              <div class="settings-section">
                <div class="settings-section-title">System information</div>
                <div class="settings-section-desc">Read-only environment details</div>

                <div class="sys-info-grid">
                  <div class="sys-info-card">
                    <div class="si-label">PHP version</div>
                    <div class="si-value"><?= phpversion() ?></div>
                  </div>
                  <div class="sys-info-card">
                    <div class="si-label">Server software</div>
                    <div class="si-value"><?= htmlspecialchars($_SERVER['SERVER_SOFTWARE'] ?? 'Apache') ?></div>
                  </div>
                  <div class="sys-info-card">
                    <div class="si-label">Last backup</div>
                    <div class="si-value"><?= date('M d, Y') ?></div>
                  </div>
                  <div class="sys-info-card">
                    <div class="si-label">System version</div>
                    <div class="si-value">v1.0.0</div>
                  </div>
                  <div class="sys-info-card">
                    <div class="si-label">Database</div>
                    <div class="si-value">MySQL 8.0</div>
                  </div>
                  <div class="sys-info-card">
                    <div class="si-label">Environment</div>
                    <div class="si-value">Production</div>
                  </div>
                </div>
              </div>

            </div>
            <!-- ══ END SYSTEM ═════════════════════════════════════ -->

          </form><!-- end settingsForm -->

        </div><!-- end settings-content -->

      </div><!-- end content -->
    </div><!-- end main-panel -->
  </div><!-- end wrapper -->


  <!-- ── Scripts ──────────────────────────────────────────────── -->
  <script>
    // ── Tab switching ────────────────────────────────────────────
    function switchSettingsTab(name, btn) {
      document.querySelectorAll('.settings-panel').forEach(p => p.classList.remove('active'));
      document.querySelectorAll('.stab').forEach(t => t.classList.remove('active'));
      document.getElementById('panel-' + name).classList.add('active');
      btn.classList.add('active');
    }

    // ── Save (submits the form) ───────────────────────────────────
    function saveSettings() {
      document.getElementById('settingsForm').submit();
    }

    // ── Manual backup placeholder ─────────────────────────────────
    function triggerManualBackup() {
      // Wire to an AJAX endpoint or PHP action in production
      alert('Backup started. You will receive an email when it completes.');
    }
  </script>

</body>

</html>