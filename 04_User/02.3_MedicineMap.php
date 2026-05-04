<!doctype html>
<html lang="en" class="is-animating">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MediFind: Find Medicine</title>
  <link rel="icon" href="../07_Assets/images/logo.png" type="image/png" />
  <!-- <link href="../07_Assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" /> -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../07_Assets/node_modules/material-symbols/outlined.css" />
  <link rel="stylesheet" href="../07_Assets/css/01_PatientUser CSS/medicinemap.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../07_Assets/css/00_Global CSS/override-fonts.css" />

  <!-- Page transition -->
  <?php include '../01_Includes/page-transition-hardcode.php' ?>
</head>

<body data-active="02">
  <div class="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-container"></div>

    <!-- Main panel -->
    <div class="main-panel">

      <!-- Topbar -->
      <div id="topbar-container"></div>

      <!-- Content -->
      <div id="content">

        <!-- MAP -->
        <div id="map-full"></div>

        <!-- TOP SEARCH BAR -->
        <div class="top-bar">
          <a class="back-btn" onclick="history.back()" href="02_ScanRX.php">
            <span class="material-symbols-outlined">arrow_back</span>
            Back
          </a>
          <div class="search-bar">
            <span class="material-symbols-outlined">search</span>
            <input type="text" id="searchInput" value="Paracetamol 500mg" placeholder="Search medicine..." />
          </div>
        </div>

        <!-- BOTTOM SHEET -->
        <div class="bottom-sheet" id="bottomSheet">
          <div class="sheet-handle-row" id="sheetHandleRow">
            <div class="sheet-handle"></div>
          </div>

          <div class="sheet-header">
            <div class="result-summary">
              <span>12 nearby pharmacies with</span>
              <span class="medicine-badge">Paracetamol 500mg</span>
            </div>
            <div class="result-count">Sorted by distance · Malaybalay, Bukidnon</div>
          </div>

          <div class="filter-chips">
            <div class="chip active"><span class="material-symbols-outlined">near_me</span>Nearest</div>
            <div class="chip"><span class="material-symbols-outlined">check_circle</span>In Stock</div>
            <div class="chip"><span class="material-symbols-outlined">schedule</span>Open Now</div>
            <div class="chip"><span class="material-symbols-outlined">payments</span>Lowest Price</div>
            <div class="chip"><span class="material-symbols-outlined">star</span>Top Rated</div>
          </div>

          <!-- CARD GRID -->
          <div class="pharmacy-scroll">

            <!-- Card 1 -->
            <div class="pharmacy-result-card selected" data-lat="8.1548" data-lng="125.1281" data-name="Rose Pharmacy">
              <div class="card-img-wrap">
                <img src="../07_Assets/images/pharmacies/RosePharmacy.png" alt="Rose Pharmacy" class="card-pharmacy-img" />

              </div>
              <div class="card-body-inner">
                <div class="card-pharmacy-name">Rose Pharmacy</div>
                <div class="card-pharmacy-addr">Fortich St., Barangay 8, M</div>
                <div class="card-status-row">
                  <span class="open-dot"></span>
                  <span class="open-label">Open · Closes 10PM</span>
                </div>
                <div class="card-dist-row">
                  <span class="material-symbols-outlined">location_on</span>0.8 km away
                </div>
                <div class="card-med-box">
                  <div class="card-med-info">
                    <div class="card-med-name">Paracetamol 500mg · Tablet</div>
                    <div class="card-stock in-stock">
                      <span class="material-symbols-outlined">check_circle</span>In Stock · 8 packs left
                    </div>
                  </div>
                  <div class="card-price-wrap">
                    <div class="card-price">₱2.75</div>
                    <div class="card-per-unit">/ tablet</div>
                  </div>
                </div>
                <div class="card-actions">
                  <button class="btn-directions"><span class="material-symbols-outlined">north_east</span>Get Directions</button>
                  <button class="btn-save"><span class="material-symbols-outlined">bookmark</span></button>
                </div>
              </div>
            </div>

            <!-- Card 2 -->
            <div class="pharmacy-result-card" data-lat="8.1563" data-lng="125.1285" data-name="Generika Drugstore">
              <div class="card-img-wrap">
                <img src="../07_Assets/images/pharmacies/Generika.png" alt="Generika Drugstore" class="card-pharmacy-img" />

              </div>
              <div class="card-body-inner">
                <div class="card-pharmacy-name">Generika Drugstore</div>
                <div class="card-pharmacy-addr">Fortich St., Poblacion, Mal</div>
                <div class="card-status-row">
                  <span class="open-dot"></span>
                  <span class="open-label">Open · Closes 9PM</span>
                </div>
                <div class="card-dist-row">
                  <span class="material-symbols-outlined">location_on</span>0.8 km away
                </div>
                <div class="card-med-box">
                  <div class="card-med-info">
                    <div class="card-med-name">Paracetamol 500mg · Tablet</div>
                    <div class="card-stock in-stock">
                      <span class="material-symbols-outlined">check_circle</span>In Stock · 8 packs left
                    </div>
                  </div>
                  <div class="card-price-wrap">
                    <div class="card-price">₱2.75</div>
                    <div class="card-per-unit">/ tablet</div>
                  </div>
                </div>
                <div class="card-actions">
                  <button class="btn-directions"><span class="material-symbols-outlined">north_east</span>Get Directions</button>
                  <button class="btn-save"><span class="material-symbols-outlined">bookmark</span></button>
                </div>
              </div>
            </div>

            <!-- Card 3 -->
            <div class="pharmacy-result-card" data-lat="8.1547" data-lng="125.1279" data-name="Mercury Drug">
              <div class="card-img-wrap">
                <img src="../07_Assets/images/pharmacies/MercuryDrug.jpg" alt="Mercury Drug" class="card-pharmacy-img" />

              </div>
              <div class="card-body-inner">
                <div class="card-pharmacy-name">Mercury Drug</div>
                <div class="card-pharmacy-addr">Sayre Highway, Casisang</div>
                <div class="card-status-row">
                  <span class="open-dot"></span>
                  <span class="open-label">Open 24 Hours</span>
                </div>
                <div class="card-dist-row">
                  <span class="material-symbols-outlined">location_on</span>1.1 km away
                </div>
                <div class="card-med-box">
                  <div class="card-med-info">
                    <div class="card-med-name">Paracetamol 500mg · Tablet</div>
                    <div class="card-stock low-stock">
                      <span class="material-symbols-outlined">warning</span>Low Stock · 3 packs left
                    </div>
                  </div>
                  <div class="card-price-wrap">
                    <div class="card-price">₱3.00</div>
                    <div class="card-per-unit">/ tablet</div>
                  </div>
                </div>
                <div class="card-actions">
                  <button class="btn-directions"><span class="material-symbols-outlined">north_east</span>Get Directions</button>
                  <button class="btn-save"><span class="material-symbols-outlined">bookmark</span></button>
                </div>
              </div>
            </div>

            <!-- Card 4 -->
            <div class="pharmacy-result-card" data-lat="8.1547" data-lng="125.1275" data-name="Watsons Pharmacy">
              <div class="card-img-wrap">
                <img src="../07_Assets/images/pharmacies/Watsons.png" alt="Watsons Pharmacy" class="card-pharmacy-img" />

              </div>
              <div class="card-body-inner">
                <div class="card-pharmacy-name">Watsons Pharmacy</div>
                <div class="card-pharmacy-addr">Centrio Mall, Sayre Highw</div>
                <div class="card-status-row">
                  <span class="open-dot"></span>
                  <span class="open-label">Open · Closes 9PM</span>
                </div>
                <div class="card-dist-row">
                  <span class="material-symbols-outlined">location_on</span>1.4 km away
                </div>
                <div class="card-med-box">
                  <div class="card-med-info">
                    <div class="card-med-name">Paracetamol 500mg · Tablet</div>
                    <div class="card-stock in-stock">
                      <span class="material-symbols-outlined">check_circle</span>In Stock · 12 packs left
                    </div>
                  </div>
                  <div class="card-price-wrap">
                    <div class="card-price">₱2.75</div>
                    <div class="card-per-unit">/ tablet</div>
                  </div>
                </div>
                <div class="card-actions">
                  <button class="btn-directions"><span class="material-symbols-outlined">north_east</span>Get Directions</button>
                  <button class="btn-save"><span class="material-symbols-outlined">bookmark</span></button>
                </div>
              </div>
            </div>

            <!-- Card 5 -->
            <div class="pharmacy-result-card" data-lat="8.1558" data-lng="125.1269" data-name="Rojon Pharmacy">
              <div class="card-img-wrap">
                <img src="../07_Assets/images/pharmacies/RojonPharmacy.png" alt="Rojon Pharmacy" class="card-pharmacy-img" />

              </div>
              <div class="card-body-inner">
                <div class="card-pharmacy-name">Rojon Pharmacy</div>
                <div class="card-pharmacy-addr">546C+P3R, Sayre Hwy, Mc</div>
                <div class="card-status-row">
                  <span class="open-dot"></span>
                  <span class="open-label">Open · Closes 10PM</span>
                </div>
                <div class="card-dist-row">
                  <span class="material-symbols-outlined">location_on</span>1.7 km away
                </div>
                <div class="card-med-box">
                  <div class="card-med-info">
                    <div class="card-med-name">Paracetamol 500mg · Tablet</div>
                    <div class="card-stock in-stock">
                      <span class="material-symbols-outlined">check_circle</span>In Stock · 5 packs left
                    </div>
                  </div>
                  <div class="card-price-wrap">
                    <div class="card-price">₱2.50</div>
                    <div class="card-per-unit">/ tablet</div>
                  </div>
                </div>
                <div class="card-actions">
                  <button class="btn-directions"><span class="material-symbols-outlined">north_east</span>Get Directions</button>
                  <button class="btn-save"><span class="material-symbols-outlined">bookmark</span></button>
                </div>
              </div>
            </div>

            <!-- Card 6 -->
            <div class="pharmacy-result-card" data-lat="8.1567" data-lng="125.1263" data-name="TGP The Generics Pharmacy">
              <div class="card-img-wrap">
                <img src="../07_Assets/images/pharmacies/TGP.png" alt="TGP The Generics Pharmacy" class="card-pharmacy-img" />

              </div>
              <div class="card-body-inner">
                <div class="card-pharmacy-name">TGP The Generics Pha...</div>
                <div class="card-pharmacy-addr">Chavez St., Poblacion, Mc</div>
                <div class="card-status-row">
                  <span class="open-dot"></span>
                  <span class="open-label">Open · Closes 8PM</span>
                </div>
                <div class="card-dist-row">
                  <span class="material-symbols-outlined">location_on</span>2.0 km away
                </div>
                <div class="card-med-box">
                  <div class="card-med-info">
                    <div class="card-med-name">Paracetamol 500mg · Tablet</div>
                    <div class="card-stock in-stock">
                      <span class="material-symbols-outlined">check_circle</span>In Stock · 20 packs left
                    </div>
                  </div>
                  <div class="card-price-wrap">
                    <div class="card-price">₱2.00</div>
                    <div class="card-per-unit">/ tablet</div>
                  </div>
                </div>
                <div class="card-actions">
                  <button class="btn-directions"><span class="material-symbols-outlined">north_east</span>Get Directions</button>
                  <button class="btn-save"><span class="material-symbols-outlined">bookmark</span></button>
                </div>
              </div>
            </div>

          </div><!-- /pharmacy-scroll -->
        </div><!-- /bottom-sheet -->


      </div><!-- /#content -->
    </div><!-- /.main-panel -->
  </div><!-- /.wrapper -->

  <!-- =============================================
       CHAT PANEL
       ============================================= -->
  <div class="chat-panel hidden" id="chatPanel">

    <div class="chat-header">
      <div class="bot-avatar">
        <span class="material-symbols-outlined" style="font-size:1.2rem; color:#fff">smart_toy</span>
      </div>
      <div class="chat-header-info">
        <h6>MediFind Assistant</h6>
        <span>● Online now</span>
      </div>
      <button class="chat-close-btn" onclick="toggleChat()">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    <div class="chat-messages" id="chatMessages">
      <div class="msg bot">
        <div class="msg-avatar">
          <span class="material-symbols-outlined" style="font-size:0.95rem; color:#1d9e75">smart_toy</span>
        </div>
        <div>
          <div class="bubble">Hi! I'm your MediFind assistant. Ask me anything about medicines, dosages, or nearby pharmacies 💊</div>
          <div class="msg-time">Just now</div>
        </div>
      </div>
    </div>

    <div class="chat-suggestions" id="chatSuggestions">
      <button class="suggest-chip" onclick="sendSuggestion('What is Paracetamol used for?')">Paracetamol</button>
      <button class="suggest-chip" onclick="sendSuggestion('Find nearby pharmacies')">Nearby pharmacies</button>
      <button class="suggest-chip" onclick="sendSuggestion('Amoxicillin dosage')">Amoxicillin</button>
    </div>

    <div class="chat-input-row">
      <input
        class="chat-input"
        id="chatInput"
        type="text"
        placeholder="Ask about a medicine..."
        onkeydown="if(event.key==='Enter') sendMessage()" />
      <button class="chat-send-btn" onclick="sendMessage()">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.269 20.876L5.999 12zm0 0h7.5" />
        </svg>
      </button>
    </div>

  </div>

  <!-- =============================================
       FLOATING BUTTON
       ============================================= -->
  <div class="floating-btns">
    <button class="float-btn" id="floatBtn" onclick="toggleChat()" aria-label="Open chat assistant">
      <span class="material-symbols-outlined bot-icon" id="iconBot">smart_toy</span>
      <span class="material-symbols-outlined bot-icon" id="iconClose" style="display:none">close</span>
    </button>
  </div>

  <!-- =============================================
       CHAT SCRIPT
       ============================================= -->
  <script>
    let isOpen = false;
    const panel = document.getElementById('chatPanel');
    const chatMsgs = document.getElementById('chatMessages');
    const chatInput = document.getElementById('chatInput');
    const iconBot = document.getElementById('iconBot');
    const iconClose = document.getElementById('iconClose');

    // ── Sample bot replies (replace with real API call) ──────────────────
    const botReplies = [
      "Paracetamol is commonly used to relieve fever and mild to moderate pain such as headache, body aches, or toothache.",
      "For adults, Paracetamol 500mg is typically taken every 4–6 hours. Don't exceed 4g (8 tablets) in 24 hours.",
      "It is generally gentle on the stomach and can be taken with or without food.",
      "If you miss a dose and take it only when needed, just skip the missed one. If on a schedule, take it as soon as you remember.",
      "I can help you find which nearby pharmacy has this medicine in stock. Want me to search for you?"
    ];
    let replyIdx = 0;

    // ── Toggle open / close ──────────────────────────────────────────────
    function toggleChat() {
      isOpen = !isOpen;
      panel.classList.toggle('hidden', !isOpen);
      panel.classList.toggle('visible', isOpen);
      iconBot.style.display = isOpen ? 'none' : '';
      iconClose.style.display = isOpen ? '' : 'none';
      if (isOpen) setTimeout(() => chatInput.focus(), 300);
    }

    // ── Helpers ───────────────────────────────────────────────────────────
    function getTime() {
      return new Date().toLocaleTimeString([], {
        hour: '2-digit',
        minute: '2-digit'
      });
    }

    function scrollBottom() {
      chatMsgs.scrollTop = chatMsgs.scrollHeight;
    }

    function addMessage(text, type) {
      const div = document.createElement('div');
      div.className = 'msg ' + type;

      if (type === 'bot') {
        div.innerHTML = `
    <div class="msg-avatar">
      <span class="material-symbols-outlined" style="font-size:0.95rem; color:#1d9e75">smart_toy</span>
    </div>
    <div>
      <div class="bubble">${text}</div>
      <div class="msg-time">${getTime()}</div>
    </div>`;
      } else {
        div.innerHTML = `
          <div>
            <div class="bubble">${text}</div>
            <div class="msg-time" style="text-align:right">${getTime()}</div>
          </div>`;
      }

      chatMsgs.appendChild(div);
      scrollBottom();
    }

    function showTyping() {
      const t = document.createElement('div');
      t.className = 'msg bot';
      t.id = 'typingIndicator';
      t.innerHTML = `
  <div class="msg-avatar">
    <span class="material-symbols-outlined" style="font-size:0.95rem; color:#1d9e75">smart_toy</span>
  </div>
  <div class="typing-indicator">
    <div class="typing-dot"></div>
    <div class="typing-dot"></div>
    <div class="typing-dot"></div>
  </div>`;
      chatMsgs.appendChild(t);
      scrollBottom();
    }

    function removeTyping() {
      const t = document.getElementById('typingIndicator');
      if (t) t.remove();
    }

    // ── Send message ──────────────────────────────────────────────────────
    function sendMessage() {
      const text = chatInput.value.trim();
      if (!text) return;
      addMessage(text, 'user');
      chatInput.value = '';

      // Hide suggestions after first user message
      document.getElementById('chatSuggestions').style.display = 'none';

      showTyping();
      setTimeout(() => {
        removeTyping();
        // 🔁 Replace the line below with your actual API call
        addMessage(botReplies[replyIdx % botReplies.length], 'bot');
        replyIdx++;
      }, 1100);
    }

    function sendSuggestion(text) {
      addMessage(text, 'user');
      document.getElementById('chatSuggestions').style.display = 'none';
      showTyping();
      setTimeout(() => {
        removeTyping();
        addMessage(botReplies[replyIdx % botReplies.length], 'bot');
        replyIdx++;
      }, 1100);
    }
  </script>

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../07_Assets/css/js/sidebar_and_topbar.js"></script>
  <script>
    const map = L.map('map-full').setView([8.1555, 125.1275], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    function makeIcon(color = '#1d9e75') {
      return L.divIcon({
        className: '',
        html: `<div style="background:${color};width:30px;height:30px;border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:3px solid #fff;box-shadow:0 2px 8px rgba(0,0,0,0.25);"></div>`,
        iconSize: [30, 30],
        iconAnchor: [15, 30],
        popupAnchor: [0, -32]
      });
    }

    const pharmacyData = [{
        name: 'Rose Pharmacy',
        lat: 8.1548,
        lng: 125.1281,
        stock: 'In Stock · 8 packs',
        price: '₱2.75'
      },
      {
        name: 'Generika Drugstore',
        lat: 8.1563,
        lng: 125.1285,
        stock: 'In Stock · 8 packs',
        price: '₱2.75'
      },
      {
        name: 'Mercury Drug',
        lat: 8.1547,
        lng: 125.1279,
        stock: 'Low Stock · 3 packs',
        price: '₱3.00'
      },
      {
        name: 'Watsons Pharmacy',
        lat: 8.1547,
        lng: 125.1275,
        stock: 'In Stock · 12 packs',
        price: '₱2.75'
      },
      {
        name: 'Rojon Pharmacy',
        lat: 8.1558,
        lng: 125.1269,
        stock: 'In Stock · 5 packs',
        price: '₱2.50'
      },
      {
        name: 'TGP The Generics Pharmacy',
        lat: 8.1567,
        lng: 125.1263,
        stock: 'In Stock · 20 packs',
        price: '₱2.00'
      },
    ];

    const markers = {};
    pharmacyData.forEach(p => {
      const m = L.marker([p.lat, p.lng], {
          icon: makeIcon()
        }).addTo(map)
        .bindPopup(`
        <div class="popup-inner">
          <div class="popup-top-bar">
            <div class="popup-name">${p.name}</div>
            <div class="popup-avail ${p.stock.toLowerCase().includes('low') ? 'low' : ''}">${p.stock}</div>
          </div>
          <div class="popup-bottom-bar">
            <div class="popup-med-name">Paracetamol 500mg</div>
            <div>
              <div class="popup-price">${p.price}</div>
              <div class="popup-per">/ tablet</div>
            </div>
          </div>
        </div>
      `, {
          maxWidth: 240
        });
      markers[p.name] = m;
    });
    markers['Rose Pharmacy'].openPopup();

    const sheet = document.getElementById('bottomSheet');
    const floatingBtns = document.getElementById('floatingBtns');

    document.getElementById('sheetHandleRow').addEventListener('click', () => {
      sheet.classList.toggle('expanded');
      // removed floatingBtns.style.bottom — button is now fixed outside wrapper
      setTimeout(() => map.invalidateSize(), 360);
    });

    document.querySelectorAll('.pharmacy-result-card').forEach(card => {
      card.addEventListener('click', () => {
        document.querySelectorAll('.pharmacy-result-card').forEach(c => c.classList.remove('selected'));
        card.classList.add('selected');
        const lat = parseFloat(card.dataset.lat);
        const lng = parseFloat(card.dataset.lng);
        const name = card.dataset.name;
        sheet.classList.remove('expanded');
        // removed floatingBtns.style.bottom — button is now fixed outside wrapper
        setTimeout(() => {
          map.invalidateSize();
          map.setView([lat, lng], 16);
          if (markers[name]) markers[name].openPopup();
        }, 360);
      });

      const dirBtn = card.querySelector('.btn-directions');
      if (dirBtn) {
        dirBtn.addEventListener('click', e => {
          e.stopPropagation();
          window.open(`https://www.openstreetmap.org/directions?to=${card.dataset.lat},${card.dataset.lng}`, '_blank');
        });
      }
    });

    document.querySelectorAll('.chip').forEach(chip => {
      chip.addEventListener('click', () => {
        document.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
        chip.classList.add('active');
      });
    });
  </script>
</body>

</html>