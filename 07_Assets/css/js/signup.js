// ============================================================
//  signup.js
//  Handles: multi-step form, cascading address dropdowns,
//           client-side validation, AJAX form submission
// ============================================================

'use strict';

// ── Step Navigation ──────────────────────────────────────────

/**
 * Show a specific step and hide the others.
 * @param {number} stepNumber - 1, 2, or 3
 */
function changeStep(stepNumber) {
    document.querySelectorAll('.form-step').forEach(step => {
        step.style.display = 'none';
    });
    const target = document.getElementById(`step${stepNumber}`);
    if (target) target.style.display = 'block';
}


// ── Step 1 Validation ────────────────────────────────────────

function validateStep1() {
    const fields = ['Fname', 'Lname', 'ContactNo', 'gender', 'birth_date'];
    let valid = true;

    fields.forEach(id => {
        const el = document.getElementById(id);
        if (!el.value.trim()) {
            el.classList.add('is-invalid');
            valid = false;
        } else {
            el.classList.remove('is-invalid');
        }
    });

    // Validate phone format (PH: 09XXXXXXXXX or +639XXXXXXXXX)
    const contact = document.getElementById('ContactNo');
    const phonePattern = /^(\+63|0)9\d{9}$/;
    if (contact.value && !phonePattern.test(contact.value.trim())) {
        contact.classList.add('is-invalid');
        valid = false;
    }

    if (valid) changeStep(2);
}


// ── Step 2 Validation ────────────────────────────────────────

function validateStep2() {
    const fields = ['Province_ID', 'City_ID', 'Barangay_ID', 'Street_ID'];
    let valid = true;

    fields.forEach(id => {
        const el = document.getElementById(id);
        if (!el.value) {
            el.classList.add('is-invalid');
            valid = false;
        } else {
            el.classList.remove('is-invalid');
        }
    });

    if (valid) changeStep(3);
}


// ── Cascading Dropdowns ──────────────────────────────────────

/**
 * Populate a <select> from an AJAX call to get_address.php
 * @param {string} type       - 'city' | 'barangay' | 'street'
 * @param {number} id         - Parent ID to filter by
 * @param {string} selectId   - ID of the <select> element to populate
 * @param {string} placeholder - Default option text
 * @param {string[]} resetIds  - IDs of downstream selects to reset
 */
async function loadAddressOptions(type, id, selectId, placeholder, resetIds = []) {
    // Reset downstream dropdowns first
    resetIds.forEach(rid => resetDropdown(rid, getPlaceholder(rid)));

    const select = document.getElementById(selectId);
    select.disabled = true;
    select.innerHTML = `<option value="" disabled selected>Loading...</option>`;

    try {
        const response = await fetch(`../00_Config/get_address.php?type=${type}&id=${id}`);
        if (!response.ok) throw new Error('Network error');

        const data = await response.json();

        select.innerHTML = `<option value="" disabled selected>${placeholder}</option>`;

        if (data.length === 0) {
            select.innerHTML = `<option value="" disabled selected>No ${placeholder.toLowerCase()} found</option>`;
        } else {
            data.forEach(item => {
                const option = document.createElement('option');
                option.value = item.id;
                option.textContent = item.name;
                select.appendChild(option);
            });
            select.disabled = false;
        }

    } catch (err) {
        console.error(`Failed to load ${type}:`, err);
        select.innerHTML = `<option value="" disabled selected>Error loading data</option>`;
    }
}

/**
 * Reset a dropdown to its default disabled state.
 */
function resetDropdown(selectId, placeholder) {
    const select = document.getElementById(selectId);
    if (!select) return;
    select.innerHTML = `<option value="" disabled selected>${placeholder}</option>`;
    select.disabled = true;
    select.classList.remove('is-invalid');
}

function getPlaceholder(selectId) {
    const map = {
        City_ID:     'Select City',
        Barangay_ID: 'Select Barangay',
        Street_ID:   'Select Street',
    };
    return map[selectId] || 'Select';
}

// Province → City
document.getElementById('Province_ID').addEventListener('change', function () {
    loadAddressOptions(
        'city',
        this.value,
        'City_ID',
        'Select City',
        ['Barangay_ID', 'Street_ID']
    );
    this.classList.remove('is-invalid');
});

// City → Barangay
document.getElementById('City_ID').addEventListener('change', function () {
    loadAddressOptions(
        'barangay',
        this.value,
        'Barangay_ID',
        'Select Barangay',
        ['Street_ID']
    );
    this.classList.remove('is-invalid');
});

// Barangay → Street
document.getElementById('Barangay_ID').addEventListener('change', function () {
    loadAddressOptions(
        'street',
        this.value,
        'Street_ID',
        'Select Street'
    );
    this.classList.remove('is-invalid');
});

// Remove invalid highlight when Street is selected
document.getElementById('Street_ID').addEventListener('change', function () {
    this.classList.remove('is-invalid');
});


// ── Step 3 Client-side Validation ───────────────────────────

function validateStep3() {
    let valid = true;

    const email = document.getElementById('email');
    const username = document.getElementById('username');
    const password = document.getElementById('password');
    const confirmpass = document.getElementById('confirmpass');

    const passwordError = document.getElementById('passwordError');
    const confirmPassError = document.getElementById('confirmPassError');

    // Reset
    [email, username, password, confirmpass].forEach(el => el.classList.remove('is-invalid'));
    passwordError.textContent = '';
    confirmPassError.textContent = '';

    // Email
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email.value.trim() || !emailPattern.test(email.value.trim())) {
        email.classList.add('is-invalid');
        valid = false;
    }

    // Username
    if (!username.value.trim()) {
        username.classList.add('is-invalid');
        valid = false;
    }

    // Password length
    if (password.value.length < 8) {
        password.classList.add('is-invalid');
        passwordError.textContent = 'Password must be at least 8 characters.';
        valid = false;
    }

    // Confirm password match
    if (password.value !== confirmpass.value) {
        confirmpass.classList.add('is-invalid');
        confirmPassError.textContent = 'Passwords do not match.';
        valid = false;
    }

    return valid;
}


// ── Show/Hide Password Toggle ────────────────────────────────

function togglePassword(inputId, btn) {
    const input = document.getElementById(inputId);
    const icon = btn.querySelector('i');

    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('bi-eye', 'bi-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('bi-eye-slash', 'bi-eye');
    }
}


// ── Alert Helper ─────────────────────────────────────────────

function showAlert(message, type = 'danger') {
    const alertBox = document.getElementById('alertBox');
    alertBox.textContent = message;
    alertBox.className = `alert alert-${type}`;
    alertBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function hideAlert() {
    const alertBox = document.getElementById('alertBox');
    alertBox.className = 'alert d-none';
}


// ── AJAX Form Submission ─────────────────────────────────────

document.getElementById('signupForm').addEventListener('submit', async function (e) {
    e.preventDefault();
    hideAlert();

    // Run client-side validation first
    if (!validateStep3()) return;

    const btn = document.getElementById('registerBtn');
    const btnText = document.getElementById('registerBtnText');
    const spinner = document.getElementById('registerSpinner');

    // Show loading state
    btn.disabled = true;
    btnText.textContent = 'Registering...';
    spinner.classList.remove('d-none');

    try {
        const formData = new FormData(this);

        const response = await fetch('signup_validate.php', {
            method: 'POST',
            body: formData,
        });

        const result = await response.json();

        if (result.success) {
            showAlert(result.message, 'success');
            // Redirect after short delay
            setTimeout(() => {
                window.location.href = result.redirect || 'login.php';
            }, 1500);
        } else {
            showAlert(result.message, 'danger');
            // Reset button
            btn.disabled = false;
            btnText.textContent = 'Register';
            spinner.classList.add('d-none');
        }

    } catch (err) {
        console.error('Submission error:', err);
        showAlert('A network error occurred. Please try again.', 'danger');
        btn.disabled = false;
        btnText.textContent = 'Register';
        spinner.classList.add('d-none');
    }
});