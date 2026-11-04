
<style>
    /* TPDD TRAVEL CHATBOT */
    .tpdd-chatbot {
        position: fixed;
        right: 24px;
        bottom: 24px;
        z-index: 2000;
        font-family: Arial, Helvetica, sans-serif;
    }

    .tpdd-chatbot,
    .tpdd-chatbot * {
        box-sizing: border-box;
    }

    .tpdd-chatbot-toggle {
        width: 62px;
        height: 62px;
        border: none;
        border-radius: 50%;
        background: #0f766e;
        color: white;
        cursor: pointer;
        box-shadow: 0 6px 24px rgba(15, 118, 110, .35);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-left: auto;
        transition: transform .2s, background .2s;
    }

    .tpdd-chatbot-toggle:hover {
        background: #0d9488;
        transform: scale(1.06);
    }

    .tpdd-chatbot-toggle svg {
        width: 29px;
        height: 29px;
    }

    .tpdd-chatbot-window {
        width: 370px;
        height: 490px;
        max-height: calc(100dvh - 115px);
        display: flex;
        flex-direction: column;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 12px 45px rgba(15, 23, 42, .2);
        margin-bottom: 14px;
    }

    .tpdd-chatbot-window[hidden] {
        display: none;
    }

    .tpdd-chatbot-header {
        background: #0f766e;
        color: white;
        padding: 16px;
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
    }

    .tpdd-chatbot-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: rgba(255,255,255,.18);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .tpdd-chatbot-title {
        flex: 1;
    }

    .tpdd-chatbot-title strong {
        display: block;
        font-size: 16px;
    }

    .tpdd-chatbot-title small {
        color: #ccfbf1;
        font-size: 12px;
    }

    /* Nút bắt đầu cuộc trò chuyện mới */
    .tpdd-chatbot-reset {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 8px;
        width: 34px;
        height: 34px;
        font-size: 23px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .tpdd-chatbot-reset:hover {
        background: rgba(255, 255, 255, 0.28);
    }

    .tpdd-chatbot-reset:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .tpdd-chatbot-close {
        background: transparent;
        color: white;
        border: none;
        font-size: 25px;
        cursor: pointer;
        padding: 2px 6px;
    }

    .tpdd-chatbot-messages {
        flex: 1;
        min-height: 0;
        overflow-y: auto;
        padding: 18px 14px;
        background: #f8fafc;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .tpdd-chatbot-message {
        max-width: 85%;
        padding: 11px 14px;
        border-radius: 14px;
        font-size: 14px;
        line-height: 1.6;
        white-space: pre-wrap;
        overflow-wrap: anywhere;
    }

    .tpdd-chatbot-message.bot {
        align-self: flex-start;
        background: white;
        color: #1f2937;
        border: 1px solid #e2e8f0;
        border-bottom-left-radius: 4px;
    }

    .tpdd-chatbot-message.user {
        align-self: flex-end;
        background: #0f766e;
        color: white;
        border-bottom-right-radius: 4px;
    }

    .tpdd-chatbot-form {
        display: flex;
        gap: 9px;
        align-items: center;
        padding: 12px;
        background: white;
        border-top: 1px solid #e2e8f0;
    }

    .tpdd-chatbot-input {
        flex: 1;
        min-width: 0;
        padding: 12px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        outline: none;
        font-size: 14px;
    }

    .tpdd-chatbot-input:focus {
        border-color: #0d9488;
    }

    .tpdd-chatbot-send {
        width: 43px;
        height: 43px;
        flex-shrink: 0;
        border: none;
        border-radius: 10px;
        background: #0f766e;
        color: white;
        cursor: pointer;
        font-size: 20px;
    }

    .tpdd-chatbot-send:hover {
        background: #0d9488;
    }

    @media (max-width: 480px) {
        .tpdd-chatbot {
            right: 12px;
            bottom: 12px;
        }

        .tpdd-chatbot-window {
            width: calc(100vw - 24px);
            height: min(490px, calc(100dvh - 95px));
        }

        .tpdd-chatbot-toggle {
            width: 56px;
            height: 56px;
        }
    }



    .tpdd-chatbot-send:disabled {
        opacity: 0.55;
        cursor: not-allowed;
    }


    /* Nút xem trước lịch trình AI */
    .tpdd-chatbot-preview-btn {
        align-self: flex-start;
        padding: 10px 14px;
        border: none;
        border-radius: 10px;
        background: #0f766e;
        color: white;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
    }

    .tpdd-chatbot-preview-btn:hover {
        background: #0d9488;
    }

    .tpdd-chatbot-preview-btn:disabled {
        opacity: 0.55;
        cursor: not-allowed;
    }

    .tpdd-chatbot-preview {
        align-self: stretch;
        padding: 14px;
        background: #f0fdfa;
        border: 1px solid #99f6e4;
        border-radius: 12px;
        font-size: 13px;
        line-height: 1.6;
        overflow-wrap: anywhere;
    }

    .tpdd-chatbot-preview h3 {
        margin: 0 0 10px;
        color: #0f766e;
        font-size: 15px;
    }

    .tpdd-chatbot-preview p {
        margin: 6px 0;
    }

    .tpdd-chatbot-preview a {
        color: #0f766e;
        text-decoration: underline;
    }

    .tpdd-chatbot-input:disabled {
        background: #f1f5f9;
    }



    
    /* Định dạng nội dung Markdown từ Gemini */
    .tpdd-chatbot-message.bot {
        white-space: normal;
    }

    .tpdd-chatbot-message.bot p {
        margin: 0 0 10px;
        line-height: 1.65;
    }

    .tpdd-chatbot-message.bot p:last-child {
        margin-bottom: 0;
    }

    .tpdd-chatbot-message.bot strong {
        font-weight: 700;
        color: #0f766e;
    }

    .tpdd-chatbot-message.bot ul,
    .tpdd-chatbot-message.bot ol {
        margin: 8px 0 12px;
        padding-left: 20px;
    }

    .tpdd-chatbot-message.bot li {
        margin-bottom: 7px;
        line-height: 1.6;
    }

    .tpdd-chatbot-message.bot li:last-child {
        margin-bottom: 0;
    }

    .tpdd-chatbot-message.bot h1,
    .tpdd-chatbot-message.bot h2,
    .tpdd-chatbot-message.bot h3 {
        margin: 12px 0 8px;
        font-size: 15px;
        font-weight: 700;
        color: #0f766e;
    }

    .tpdd-chatbot-message.bot a {
        color: #0f766e;
        text-decoration: underline;
        overflow-wrap: anywhere;
    }

    .tpdd-chatbot-message.bot code {
        background: #f1f5f9;
        padding: 2px 5px;
        border-radius: 4px;
        font-size: 12px;
    }

    .tpdd-chatbot-message.bot blockquote {
        margin: 8px 0;
        padding-left: 10px;
        border-left: 3px solid #0d9488;
        color: #475569;
    }

</style>

<div
    class="tpdd-chatbot"
    id="tpddChatbot"
    data-chat-url="{{ route('chatbot.message') }}"
    data-prepare-url="{{ route('chatbot.itinerary.prepare') }}"
    data-save-url="{{ route('chatbot.itinerary.save') }}"
    data-login-url="{{ route('login') }}"
    data-csrf-token="{{ csrf_token() }}"
    data-authenticated="{{ auth()->check() ? '1' : '0' }}"
>

    <!-- Cửa sổ chat -->
    <section
        class="tpdd-chatbot-window"
        id="tpddChatbotWindow"
        aria-label="Trợ lý du lịch TPĐĐ Travel"
        hidden
    >
        <div class="tpdd-chatbot-header">
            <div class="tpdd-chatbot-avatar">🤖</div>

            <div class="tpdd-chatbot-title">
                <strong>Trợ lý TPĐĐ Travel</strong>
                <small>AI tư vấn du lịch Việt Nam</small>
            </div>

            <button
                type="button"
                class="tpdd-chatbot-reset"
                id="tpddChatbotReset"
                title="Cuộc trò chuyện mới"
                aria-label="Bắt đầu cuộc trò chuyện mới"
            >
                ↻
            </button>

            <button
                type="button"
                class="tpdd-chatbot-close"
                id="tpddChatbotClose"
                aria-label="Đóng chatbot"
            >
                &times;
            </button>
        </div>

        <!-- Danh sách tin nhắn -->
        <div
            class="tpdd-chatbot-messages"
            id="tpddChatbotMessages"
            aria-live="polite"
        >
            <div class="tpdd-chatbot-message bot">
                Xin chào! 👋 Mình là trợ lý TPĐĐ Travel.
                Bạn muốn khám phá địa điểm nào tại Việt Nam?
            </div>
        </div>

        <!-- Ô nhập tin nhắn -->
        <form class="tpdd-chatbot-form" id="tpddChatbotForm">
            <input
                type="text"
                class="tpdd-chatbot-input"
                id="tpddChatbotInput"
                placeholder="Nhập câu hỏi du lịch..."
                maxlength="1000"
                autocomplete="off"
                aria-label="Câu hỏi gửi chatbot"
                required
            >

            <button
                type="submit"
                class="tpdd-chatbot-send"
                aria-label="Gửi tin nhắn"
            >
                ➤
            </button>
        </form>
    </section>

    <!-- Nút chatbot nổi -->
    <button
        type="button"
        class="tpdd-chatbot-toggle"
        id="tpddChatbotToggle"
        aria-label="Mở chatbot"
        aria-expanded="false"
        aria-controls="tpddChatbotWindow"
    >
        <svg
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            aria-hidden="true"
        >
            <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
        </svg>
    </button>
</div>

<script src="https://cdn.jsdelivr.net/npm/marked@15.0.12/marked.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dompurify@3.2.6/dist/purify.min.js"></script>

<script>
(function () {
    const toggle = document.getElementById('tpddChatbotToggle');
    const windowEl = document.getElementById('tpddChatbotWindow');
    const closeBtn = document.getElementById('tpddChatbotClose');
    const resetBtn = document.getElementById('tpddChatbotReset');
    const form = document.getElementById('tpddChatbotForm');
    const input = document.getElementById('tpddChatbotInput');
    const messages = document.getElementById('tpddChatbotMessages');

    if (!toggle || !windowEl || !closeBtn || !resetBtn || !form || !input || !messages) {
        return;
    }

    function setChatOpen(isOpen) {
        windowEl.hidden = !isOpen;
        toggle.setAttribute('aria-expanded', String(isOpen));
        toggle.setAttribute(
            'aria-label',
            isOpen ? 'Đóng chatbot' : 'Mở chatbot'
        );

        if (isOpen) {
            input.focus();
        }
    }

    toggle.addEventListener('click', function () {
        setChatOpen(windowEl.hidden);
    });

    closeBtn.addEventListener('click', function () {
        setChatOpen(false);
        toggle.focus();
    });

    
    function addMessage(text, sender, shouldSave = true) {
        const bubble = document.createElement('div');

        bubble.className = 'tpdd-chatbot-message ' + sender;

        if (
            sender === 'bot' &&
            typeof marked !== 'undefined' &&
            typeof DOMPurify !== 'undefined'
        ) {
            const html = marked.parse(text, {
                breaks: true,
                gfm: true
            });

            bubble.innerHTML = DOMPurify.sanitize(html);
        } else {
            bubble.textContent = text;
        }

        messages.appendChild(bubble);
        messages.scrollTop = messages.scrollHeight;

        if (shouldSave) {
            displayedMessages.push({
                text: String(text),
                sender: sender
            });

            displayedMessages = displayedMessages.slice(-50);

            persistChatState();
        }
    }


    
    const chatbot = document.getElementById('tpddChatbot');
    const sendButton = form.querySelector('button[type="submit"]');

    let isSending = false;
    let isPreparingItinerary = false;
    let latestItineraryRequest = null;
    // Ghi nhớ lịch trình AI gần nhất đã hiển thị cho người dùng.
    let latestItineraryReply = null;

    // Lưu tối đa 10 tin nhắn gần nhất để gửi cho Gemini.
    const chatHistory = [];
    const MAX_CHAT_HISTORY = 10;

    // Lưu lịch sử hiển thị khi chuyển trang trong cùng tab.
    const CHAT_STORAGE_KEY = 'tpdd_chat_history_v1';
    const CHAT_DISPLAY_KEY = 'tpdd_chat_display_v1';
    const CHAT_ITINERARY_KEY = 'tpdd_chat_itinerary_v1';
    const CHAT_PREVIEW_KEY = 'tpdd_chat_preview_v1';

    let displayedMessages = [];
    let latestItineraryPreview = null;

    function persistChatState() {
        try {
            sessionStorage.setItem(
                CHAT_STORAGE_KEY,
                JSON.stringify(chatHistory)
            );

            sessionStorage.setItem(
                CHAT_DISPLAY_KEY,
                JSON.stringify(displayedMessages.slice(-50))
            );

            sessionStorage.setItem(
                CHAT_ITINERARY_KEY,
                JSON.stringify({
                    latestItineraryRequest: latestItineraryRequest,
                    latestItineraryReply: latestItineraryReply
                })
            );

            sessionStorage.setItem(
                CHAT_PREVIEW_KEY,
                JSON.stringify(latestItineraryPreview)
            );

        } catch (error) {
            console.warn('Không thể lưu lịch sử chatbot:', error);
        }
    }

    function showItineraryPreview(itinerary, draftToken) {
        const preview = document.createElement('div');
        preview.className = 'tpdd-chatbot-preview';

        const heading = document.createElement('h3');
        heading.textContent = itinerary.title || 'Lịch trình AI';
        preview.appendChild(heading);

        const duration = document.createElement('p');
        duration.textContent =
            `${itinerary.total_days} ngày ${itinerary.total_nights} đêm`;
        preview.appendChild(duration);

        const budget = document.createElement('p');
        budget.textContent = itinerary.budget !== null &&
            itinerary.budget !== undefined
            ? 'Ngân sách: ' +
            Number(itinerary.budget).toLocaleString('vi-VN') + ' VNĐ'
            : 'Ngân sách: Chưa xác định';

        preview.appendChild(budget);

        const items = Array.isArray(itinerary.items)
            ? itinerary.items
            : [];

        items.forEach(function (item) {
            const row = document.createElement('p');

            row.appendChild(document.createTextNode(
                `Ngày ${item.day_number}, ${item.start_time}–${item.end_time}: `
            ));

            const link = document.createElement('a');
            link.textContent = item.place_name || 'Địa điểm';
            link.href = item.place_url || '#';
            link.target = '_blank';
            link.rel = 'noopener noreferrer';

            row.appendChild(link);
            preview.appendChild(row);
        });

        const notice = document.createElement('p');
        notice.textContent =
            'Đây là bản nháp để kiểm tra. Lịch trình chưa được lưu.';
        preview.appendChild(notice);

        // Chỉ hiển thị nút lưu khi Laravel đã cấp draft_token.
        if (draftToken) {
            const saveButton = document.createElement('button');

            saveButton.type = 'button';
            saveButton.className = 'tpdd-chatbot-preview-btn';
            saveButton.textContent = 'Lưu lịch trình AI';

            saveButton.style.marginTop = '12px';
            saveButton.style.width = '100%';

            saveButton.addEventListener('click', function () {
                saveAiItinerary(draftToken, saveButton);
            });

            preview.appendChild(saveButton);
        }

        messages.appendChild(preview);
        messages.scrollTop = messages.scrollHeight;
    }


    async function saveAiItinerary(draftToken, button) {
        if (isSending || isPreparingItinerary) {
            return;
        }

        if (!draftToken) {
            addMessage(
                'Không tìm thấy mã bản nháp. Vui lòng xem trước lịch trình lại.',
                'bot'
            );
            return;
        }

        // Người dùng đã xác nhận lưu, không tự động lưu khi AI trả lời.
        const confirmed = window.confirm(
            'Bạn có muốn lưu lịch trình AI này vào "Lịch trình của tôi" không?'
        );

        if (!confirmed) {
            return;
        }

        isPreparingItinerary = true;
        button.disabled = true;
        button.textContent = 'Đang lưu lịch trình...';
        resetBtn.disabled = true;

        try {
            const response = await fetch(chatbot.dataset.saveUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': chatbot.dataset.csrfToken
                },
                body: JSON.stringify({
                    draft_token: draftToken
                })
            });

            const data = await response.json();

            if (!response.ok) {
                addMessage(
                    data.message ||
                    'Không thể lưu lịch trình. Vui lòng thử lại.',
                    'bot'
                );

                button.disabled = false;
                button.textContent = 'Lưu lịch trình AI';
                return;
            }

            if (data.success && data.redirect_url) {
                button.textContent = 'Đã lưu thành công';

                // Bản nháp đã được lưu, không khôi phục nút lưu cũ.
                latestItineraryPreview = null;
                sessionStorage.removeItem(CHAT_PREVIEW_KEY);

                addMessage(
                    'Đã lưu lịch trình AI thành công! Đang mở trang chi tiết lịch trình...',
                    'bot'
                );

                window.location.assign(data.redirect_url);
                return;
            }

            addMessage(
                'Hệ thống chưa xác nhận lưu lịch trình thành công.',
                'bot'
            );

            button.disabled = false;
            button.textContent = 'Lưu lịch trình AI';

        } catch (error) {
            addMessage(
                'Không thể kết nối chức năng lưu lịch trình. Vui lòng thử lại.',
                'bot'
            );

            button.disabled = false;
            button.textContent = 'Lưu lịch trình AI';

        } finally {
            isPreparingItinerary = false;
            resetBtn.disabled = false;
        }
    }


    function showItineraryPreviewButton(requestData) {
        if (!requestData || !requestData.message || !requestData.ai_reply) {
            return;
        }

        const previewButton = document.createElement('button');
        previewButton.type = 'button';
        previewButton.className = 'tpdd-chatbot-preview-btn';
        previewButton.textContent = 'Xem trước lịch trình AI';
        previewButton.title =
            'Xem trước và xác nhận lưu lịch trình AI vào tài khoản của bạn';

        previewButton.addEventListener('click', function () {
            prepareItinerary(requestData, previewButton);
        });

        messages.appendChild(previewButton);

        const saveHint = document.createElement('div');
        saveHint.style.fontSize = '12px';
        saveHint.style.color = '#64748b';
        saveHint.style.marginTop = '4px';
        saveHint.textContent =
            'Bạn có thể xem trước, kiểm tra và lưu lịch trình này vào mục "Lịch trình của tôi".';

        messages.appendChild(saveHint);
        messages.scrollTop = messages.scrollHeight;
    }


    async function prepareItinerary(requestData, button) {
        if (isPreparingItinerary || isSending) {
            return;
        }

        if (chatbot.dataset.authenticated !== '1') {
            addMessage(
                'Bạn cần đăng nhập để xem trước và lưu lịch trình AI.',
                'bot'
            );
            return;
        }

        isPreparingItinerary = true;
        button.disabled = true;
        button.textContent = 'Đang chuẩn bị lịch trình...';
        resetBtn.disabled = true;

        try {
            const response = await fetch(chatbot.dataset.prepareUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': chatbot.dataset.csrfToken
                },
                body: JSON.stringify(requestData)
            });

            const data = await response.json();

            if (!response.ok) {
                addMessage(
                    data.message ||
                    'Không thể chuẩn bị lịch trình. Vui lòng thử lại.',
                    'bot'
                );
                return;
            }

            if (data.success && data.itinerary && data.draft_token) {
                latestItineraryPreview = {
                    itinerary: data.itinerary,
                    draftToken: data.draft_token
                };

                persistChatState();

                showItineraryPreview(data.itinerary, data.draft_token);
                button.textContent = 'Đã xem trước lịch trình';
            } else {
                addMessage('Chưa nhận được dữ liệu lịch trình.', 'bot');
            }

        } catch (error) {
            addMessage(
                'Không thể kết nối chức năng xem trước lịch trình.',
                'bot'
            );
        } finally {
            isPreparingItinerary = false;
            resetBtn.disabled = false;
            button.disabled = false;

            if (button.textContent === 'Đang chuẩn bị lịch trình...') {
                button.textContent = 'Xem trước lịch trình AI';
            }
        }
    }


    function saveChatHistory(role, text) {
        chatHistory.push({ role, text });

        if (chatHistory.length > MAX_CHAT_HISTORY) {
            chatHistory.splice(
                0,
                chatHistory.length - MAX_CHAT_HISTORY
            );
        }

        persistChatState();
    }


    function restoreChatState() {
        try {
            const savedHistory = JSON.parse(
                sessionStorage.getItem(CHAT_STORAGE_KEY) || '[]'
            );

            const savedMessages = JSON.parse(
                sessionStorage.getItem(CHAT_DISPLAY_KEY) || '[]'
            );

            // Khôi phục dữ liệu yêu cầu tạo lịch trình AI
            const savedItinerary = JSON.parse(
                sessionStorage.getItem(CHAT_ITINERARY_KEY) || 'null'
            );

            // Khôi phục bản xem trước lịch trình AI
            const savedPreview = JSON.parse(
                sessionStorage.getItem(CHAT_PREVIEW_KEY) || 'null'
            );

            if (
                savedPreview &&
                typeof savedPreview === 'object' &&
                savedPreview.itinerary &&
                typeof savedPreview.itinerary === 'object' &&
                typeof savedPreview.draftToken === 'string' &&
                savedPreview.draftToken.length > 0
            ) {
                latestItineraryPreview = savedPreview;
            }

            if (savedItinerary && typeof savedItinerary === 'object') {
                latestItineraryRequest =
                    savedItinerary.latestItineraryRequest || null;

                latestItineraryReply =
                    savedItinerary.latestItineraryReply || null;
            }

            if (Array.isArray(savedHistory)) {
                chatHistory.length = 0;

                savedHistory.slice(-MAX_CHAT_HISTORY).forEach(function (item) {
                    if (
                        item &&
                        ['user', 'model'].includes(item.role) &&
                        typeof item.text === 'string'
                    ) {
                        chatHistory.push({
                            role: item.role,
                            text: item.text
                        });
                    }
                });
            }

            if (Array.isArray(savedMessages) && savedMessages.length > 0) {
                messages.innerHTML = '';
                displayedMessages = [];

                savedMessages.slice(-50).forEach(function (item) {
                    if (
                        item &&
                        ['user', 'bot'].includes(item.sender) &&
                        typeof item.text === 'string'
                    ) {
                        addMessage(item.text, item.sender, false);

                        displayedMessages.push({
                            text: item.text,
                            sender: item.sender
                        });
                    }
                });
            }

            // Khôi phục nút xem trước lịch trình AI khi chuyển trang
            if (latestItineraryRequest) {
                showItineraryPreviewButton(latestItineraryRequest);
            }

            // Khôi phục bản xem trước và nút lưu lịch trình AI
            if (latestItineraryPreview) {
                showItineraryPreview(
                    latestItineraryPreview.itinerary,
                    latestItineraryPreview.draftToken
                );
            }

        } catch (error) {
            console.warn('Không thể khôi phục lịch sử chatbot:', error);
        }
    }

    restoreChatState();


    // Bắt đầu cuộc trò chuyện mới
    resetBtn.addEventListener('click', function () {
        if (isSending || isPreparingItinerary) {
            return;
        }

        latestItineraryRequest = null;
        latestItineraryReply = null;
        latestItineraryPreview = null;

        // Xóa lịch sử gửi cho Gemini và lịch sử hiển thị.
        chatHistory.length = 0;
        displayedMessages = [];

        sessionStorage.removeItem(CHAT_STORAGE_KEY);
        sessionStorage.removeItem(CHAT_DISPLAY_KEY);
        sessionStorage.removeItem(CHAT_ITINERARY_KEY);
        sessionStorage.removeItem(CHAT_PREVIEW_KEY);

        // Xóa các tin nhắn đang hiển thị
        messages.innerHTML = '';

        // Hiển thị lại lời chào ban đầu
        addMessage(
            'Xin chào! 👋 Mình là trợ lý TPĐĐ Travel. Bạn muốn khám phá địa điểm nào tại Việt Nam?',
            'bot'
        );

        // Xóa nội dung đang nhập
        input.value = '';
        input.focus();
    });

    form.addEventListener('submit', async function (event) {
        event.preventDefault();

        if (isSending) {
            return;
        }

        const question = input.value.trim();

        if (!question) {
            return;
        }

        addMessage(question, 'user');
        input.value = '';

        isSending = true;
        sendButton.disabled = true;
        input.disabled = true;
        resetBtn.disabled = true;

        const loadingBubble = document.createElement('div');
        loadingBubble.className = 'tpdd-chatbot-message bot';
        loadingBubble.textContent = 'Đang suy nghĩ...';

        messages.appendChild(loadingBubble);
        messages.scrollTop = messages.scrollHeight;

        try {
            const response = await fetch(chatbot.dataset.chatUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': chatbot.dataset.csrfToken
                },
                body: JSON.stringify({
                    message: question,
                    history: chatHistory
                })
            });

            const data = await response.json();

            loadingBubble.remove();

            if (!response.ok) {
                addMessage(
                    data.reply || 'Có lỗi xảy ra khi gửi câu hỏi. Vui lòng thử lại.',
                    'bot'
                );
                return;
            }

            // API trả lời thành công
            const answer = data.reply || 'Mình chưa nhận được câu trả lời.';

            addMessage(answer, 'bot');


            // Nhận biết câu hỏi liên quan đến lịch trình.
            const isItineraryQuestion =
                /(lịch trình|lập kế hoạch|chuyến đi|ngày.*đêm|tham quan)/i
                    .test(question);

            // Nhận biết yêu cầu lưu lịch trình đã được AI gợi ý trước đó.
            const isSavePreviousItinerary =
                /(lưu|ghi lại|thêm vào)/i.test(question) &&
                /(lịch trình|chuyến đi)/i.test(question) &&
                /(vừa|trước đó|ở trên|này|đã gợi ý)/i.test(question);

            if (data.reply && isItineraryQuestion) {

                // Chỉ cập nhật khi câu trả lời chứa lịch trình theo ngày.
                const hasItineraryContent =
                    /ngày\s*1|ngày\s*thứ\s*nhất/i.test(data.reply);

                if (hasItineraryContent) {
                    latestItineraryReply = data.reply;
                }

                // Chụp lại ngữ cảnh trước khi cập nhật lịch sử.
                const requestData = {
                    message: question,

                    // Khi yêu cầu lưu lịch trình cũ, dùng lịch trình đã ghi nhớ.
                    // Các trường hợp khác dùng câu trả lời mới của Gemini.
                    ai_reply: isSavePreviousItinerary && latestItineraryReply
                        ? latestItineraryReply
                        : data.reply,

                    history: chatHistory.map(function (item) {
                        return {
                            role: item.role,
                            text: item.text
                        };
                    })
                };

                // Ghi nhớ yêu cầu lịch trình AI mới nhất
                latestItineraryRequest = requestData;

                // Bản xem trước cũ không còn tương ứng với yêu cầu mới
                latestItineraryPreview = null;

                // Cập nhật dữ liệu lưu trong sessionStorage
                persistChatState();

                // Hiển thị nút xem trước cho lịch trình mới
                showItineraryPreviewButton(requestData);
            }


            // Chỉ lưu lịch sử khi Gemini thực sự trả lời thành công
            if (data.reply) {
                saveChatHistory('user', question);
                saveChatHistory('model', data.reply);
            }

        } catch (error) {
            loadingBubble.remove();

            addMessage(
                'Không thể kết nối chatbot. Vui lòng kiểm tra mạng và thử lại.',
                'bot'
            );

        } finally {
            isSending = false;
            sendButton.disabled = false;
            input.disabled = false;
            resetBtn.disabled = false;
            input.focus();
        }
    });
})();
</script>
