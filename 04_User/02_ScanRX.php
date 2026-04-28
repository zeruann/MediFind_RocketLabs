<!doctype html>
<html lang="en" class="is-animating">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MediFind: Scan Prescriptions</title>
  <link rel="icon" href="../07_Assets/images/logo.png" type="image/png" />
  <link href="../07_Assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../07_Assets/css/01_PatientUser CSS/scanrx.css" />

  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap"
    rel="stylesheet" />

  <!-- Page transition -->
  <?php include '../01_Includes/page-transition-hardcode.php' ?>

</head>

<body>
  <div class="wrapper d-flex align-items-stretch">
    <div id="sidebar-container"></div>

    <div class="main-panel d-flex flex-column flex-grow-1">
      <div id="topbar-container"></div>

      <div id="content">
        <div class="content-body">
          <!-- Page Title -->
          <div class="page-title-block">
            <div class="page-title-icon">
              <span class="material-symbols-outlined">medication</span>
            </div>
            <div class="page-title-text">
              <h2>My Prescriptions</h2>
              <p>View your scanned prescriptions</p>
            </div>
          </div>

          <!-- Two-column layout -->
          <div class="prescription-layout">
            <!-- LEFT: Prescriptions Table -->
            <div class="prescription-table-panel">
              <table class="prescription-table">
                <thead>
                  <tr>
                    <th>
                      <input
                        type="checkbox"
                        class="rx-checkbox"
                        id="select-all" />
                    </th>
                    <th>Medicine Name</th>
                    <th>Date Scanned</th>
                    <th>Available Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="checkbox" class="rx-checkbox" /></td>
                    <td>Amoxicillin</td>
                    <td>Dec 31, 2026</td>
                    <td>
                      <div class="action-btns">
                        <button class="btn-view" onclick="openRxModal(
                            'Amoxicillin',
                            'Dec 31, 2026',
                            '../07_Assets/images/sample-rx/2.png'
                          )">
                          <span class="material-symbols-outlined">visibility</span>
                          View
                        </button>
                        <button class="btn-delete">
                          <span class="material-symbols-outlined">delete</span>
                          Delete
                        </button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" class="rx-checkbox" /></td>
                    <td>Amoxicillin</td>
                    <td>Dec 31, 2026</td>
                    <td>
                      <div class="action-btns">
                        <button class="btn-view" onclick="openRxModal(
                              'Amoxicillin',
                              'Dec 31, 2026',
                              '../07_Assets/images/sample-rx/1.jpeg'
                            )">
                          <span class="material-symbols-outlined">visibility</span>
                          View
                        </button>
                        <button class="btn-delete">
                          <span class="material-symbols-outlined">delete</span>
                          Delete
                        </button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" class="rx-checkbox" /></td>
                    <td>Amoxicillin</td>
                    <td>Dec 31, 2026</td>
                    <td>
                      <div class="action-btns">
                        <button class="btn-view" onclick="openRxModal(
                            'Amoxicillin',
                            'Dec 31, 2026',
                            '../07_Assets/images/sample-rx/2.png'
                          )">
                          <span class="material-symbols-outlined">visibility</span>
                          View
                        </button>
                        <button class="btn-delete">
                          <span class="material-symbols-outlined">delete</span>
                          Delete
                        </button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" class="rx-checkbox" /></td>
                    <td>Amoxicillin</td>
                    <td>Dec 31, 2026</td>
                    <td>
                      <div class="action-btns">
                        <button class="btn-view" onclick="openRxModal(
                              'Amoxicillin',
                              'Dec 31, 2026',
                              '../07_Assets/images/sample-rx/1.jpeg'
                            )">
                          <span class="material-symbols-outlined">visibility</span>
                          View
                        </button>
                        <button class="btn-delete">
                          <span class="material-symbols-outlined">delete</span>
                          Delete
                        </button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" class="rx-checkbox" /></td>
                    <td>Amoxicillin</td>
                    <td>Dec 31, 2026</td>
                    <td>
                      <div class="action-btns">
                        <button class="btn-view" onclick="openRxModal(
                                'Amoxicillin',
                                'Dec 31, 2026',
                                '../07_Assets/images/sample-rx/1.jpeg'
                              )">
                          <span class="material-symbols-outlined">visibility</span>
                          View
                        </button>
                        <button class="btn-delete">
                          <span class="material-symbols-outlined">delete</span>
                          Delete
                        </button>
                      </div>
                    </td>
                  </tr>

                </tbody>
              </table>
            </div>

            <!-- RIGHT: Prescription Reader -->
            <div class="prescription-reader-panel">
              <div class="reader-icon-wrap">
                <img
                  src="../07_Assets/images/icons/location.png"
                  alt="Prescription Icon"
                  class="reader-icon"
                  width="100" />
              </div>
              <h2 class="reader-title">
                <span class="orange">Prescription</span>
                <span class="green">Reader</span>
              </h2>
              <p class="reader-subtitle">
                Upload your prescription and we'll find the medicine for you.
              </p>
              <div class="reader-actions">
                <input
                  type="file"
                  id="rxFileInput"
                  accept="image/png, image/jpeg"
                  hidden />

                <a
                  class="btn-scan"
                  href="../04_User/02.2_ScannedRx.php"
                  style="text-decoration: none">
                  <span class="material-symbols-outlined">document_scanner</span>
                  Scan Prescription
                </a>

                <!-- Change <a> to <button> and trigger the input -->
                <button
                  class="btn-file"
                  onclick="document.getElementById('rxFileInput').click()">
                  <span class="material-symbols-outlined">add_photo_alternate</span>
                  Select PNG/JPEG File
                </button>

                <p class="drop-hint">or drop file here</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- View Prescription Modal -->
  <div class="modal-overlay" id="rxModal" onclick="closeRxModal(event)">
    <div class="modal-card">
      <div class="rxm-header">
        <div class="rxm-header-left">
          <span class="material-symbols-outlined" style="color:#1d9e75;font-size:1.3rem">medication</span>
          <h5 id="modalMedicineName">Amoxicillin</h5>
        </div>
        <button class="rxm-close-btn" onclick="closeModal()">
          <span class="material-symbols-outlined">close</span>
        </button>
      </div>
      <div class="rxm-body rxm-body-with-image">
        <div class="rxm-details">
          <div class="rxm-row">
            <span class="rxm-label">Date Scanned</span>
            <span class="rxm-value" id="modalDateScanned">Dec 31, 2026</span>
          </div>

          <div class="rxm-row">
            <span class="rxm-label">Dosage</span>
            <span class="rxm-value" id="modalDosage">500mg</span>
          </div>

          <div class="rxm-row">
            <span class="rxm-label">Frequency</span>
            <span class="rxm-value" id="modalFrequency">3x a day</span>
          </div>

          <div class="rxm-row">
            <span class="rxm-label">Duration</span>
            <span class="rxm-value" id="modalDuration">7 days</span>
          </div>

          <div class="rxm-row">
            <span class="rxm-label">Prescribed by</span>
            <span class="rxm-value" id="modalDoctor">Dr. Santos</span>
          </div>
        </div>

        <div class="modal-image-wrap" id="modalImageWrap" style="display:none;">
          <img id="modalRxImage" src="" alt="Prescription Image" />
          <p class="modal-image-hint">Scanned prescription image</p>
        </div>
      </div>
      <div class="rxm-footer">
        <button class="btn-delete" onclick="closeModal()">
          <span class="material-symbols-outlined">delete</span>
          Delete
        </button>
        <button class="btn-view" onclick="closeModal()">
          <span class="material-symbols-outlined">close</span>
          Close
        </button>
      </div>
    </div>
  </div>


  <script>
    function openRxModal(medicineName, dateScanned, imageSrc = '') {
      document.getElementById('modalMedicineName').textContent = medicineName;
      document.getElementById('modalDateScanned').textContent = dateScanned;

      const imgWrap = document.getElementById('modalImageWrap');
      const img = document.getElementById('modalRxImage');
      if (imageSrc) {
        img.src = imageSrc;
        imgWrap.style.display = 'block';
      } else {
        imgWrap.style.display = 'none';
      }

      document.getElementById('rxModal').classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function closeModal() {
      document.getElementById('rxModal').classList.remove('active');
      document.body.style.overflow = '';
    }

    function closeRxModal(event) {
      if (event.target === document.getElementById('rxModal')) closeModal();
    }
  </script>



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

  <script>
    document
      .getElementById("rxFileInput")
      .addEventListener("change", function() {
        const file = this.files[0];
        if (!file) return;

        // Store the file so 02.2_ScannedRx.html can use it
        const reader = new FileReader();
        reader.onload = (e) => {
          sessionStorage.setItem("uploadedRx", e.target.result);
          window.location.href = "../04_User/02.2_ScannedRx.php";
        };
        reader.readAsDataURL(file);
      });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../07_Assets/css/js/sidebar_and_topbar.js"></script>

  <script>
    document
      .getElementById("select-all")
      .addEventListener("change", function() {
        document
          .querySelectorAll(".rx-checkbox")
          .forEach((cb) => (cb.checked = this.checked));
      });
  </script>
</body>

</html>