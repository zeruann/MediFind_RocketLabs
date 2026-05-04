<!doctype html>
<html lang="en" class="is-animating">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MediFind: Scan Prescriptions</title>
  <link rel="icon" href="../07_Assets/images/logo.png" type="image/png" />
  <!-- <link href="../07_Assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" /> -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../07_Assets/css/01_PatientUser CSS/scannedrx.css" />

  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap"
    rel="stylesheet" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../07_Assets/css/00_Global CSS/override-fonts.css" />

  <!-- Page transition -->
  <?php include '../01_Includes/page-transition-hardcode.php' ?>

</head>

<body data-active="02">
  <div class="wrapper d-flex align-items-stretch">
    <div id="sidebar-container"></div>

    <div class="main-panel d-flex flex-column flex-grow-1">
      <div id="topbar-container"></div>

      <div id="content">
        <div class="content-body">
          <div class="page-wrapper container-fluid">

            <a href="02_ScanRX.php" class="back-btn" onclick="history.back()" href="#">
              <span class="material-symbols-outlined">arrow_back</span>
              Back
            </a>

            <div class="content-box">
              <div class="row align-items-start">
                <!-- LEFT PANEL -->
                <div class="col-lg-5 left-panel">
                  <h3 class="scan-title">Prescription scanned!</h3>
                  <p class="scan-subtitle">
                    We extracted the details below.<br />
                    Please review before continuing.
                  </p>

                  <div class="pill-icon-wrap">
                    <span class="material-symbols-outlined">pill</span>
                  </div>

                  <h4 class="medicine-title">Paracetamol 500mg</h4>

                  <table class="details-table">
                    <tr>
                      <td>Medicine Name</td>
                      <td>Paracetamol</td>
                    </tr>
                    <tr>
                      <td>Strength</td>
                      <td>500mg</td>
                    </tr>
                    <tr>
                      <td>Form</td>
                      <td>Tablet</td>
                    </tr>
                    <tr>
                      <td>Dose</td>
                      <td>1 tablet</td>
                    </tr>
                    <tr>
                      <td>Frequency</td>
                      <td>After meals</td>
                    </tr>
                    <tr>
                      <td>Quantity</td>
                      <td>30</td>
                    </tr>
                    <tr>
                      <td>Note</td>
                      <td>Take daily after eating</td>
                    </tr>
                  </table>

                  <button
                    class="btn-continue"
                    onclick="window.location.href = '02.3_MedicineMap.php   '">
                    Continue
                    <span class="material-symbols-outlined align-middle">arrow_right_alt</span>
                  </button>

                  <button class="btn-rescan">Rescan</button>
                </div>

                <!-- RIGHT PANEL -->
                <div class="col-lg-7 right-panel">
                  <div class="image-placeholder">Insert Image</div>

                  <!--
            <img
              src="your-prescription-image.png"
              alt="Prescription"
              class="img-fluid rounded shadow-sm"
            />
            -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../07_Assets/css/js/sidebar_and_topbar.js"></script>
  <script>
    const savedImage = sessionStorage.getItem("uploadedRx");
    if (savedImage) {
      document.querySelector(".image-placeholder").outerHTML =
        `<img src="${savedImage}" alt="Prescription" class="img-fluid rounded shadow-sm" style="width:100%;" />`;
      sessionStorage.removeItem("uploadedRx"); // clean up
    }
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