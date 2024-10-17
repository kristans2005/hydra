<!-- Chat Icon Button -->
<div id="chat-icon" style="position: fixed; bottom: 20px; right: 20px; cursor: pointer;">
    <img src="{{ asset('images/chaticon.png') }}" alt="Chat Icon" width="50" height="50" />
</div>

<!-- Chat Box -->
<div id="chat-box" class="chat-box" style="width: 300px; height: 400px; position: fixed; bottom: 80px; right: 20px; border: 1px solid #ccc; border-radius: 10px; display: none; flex-direction: column; box-shadow: 0 4px 8px rgba(0,0,0,0.1); transition: opacity 0.3s ease, transform 0.3s ease;">
    <div class="chat-header" style="background-color: #343a40; color: white; padding: 10px; border-bottom: 1px solid #ccc; border-radius: 10px 10px 0 0; text-align: center; font-weight: bold;">
        Customer Service
        <button id="close-chat" style="background-color: transparent; border: none; color: white; float: right; cursor: pointer;">&times;</button>
    </div>
    <div class="chat-messages" style="flex-grow: 1; padding: 10px; overflow-y: auto; background-color: #f8f9fa;">
        <!-- Chat messages will appear here -->
    </div>
    <div class="chat-input" style="display: flex; border-top: 1px solid #ccc;">
        <textarea rows="2" placeholder="Type your message..." style="flex-grow: 1; padding: 10px; border: none; border-radius: 0; resize: none; font-size: 14px; outline: none;"></textarea>
        <button onclick="sendMessage()" style="padding: 10px 20px; border: none; background-color: #28a745; color: white; cursor: pointer; border-radius: 0 0 10px 0; font-size: 14px;">Send</button>
    </div>
</div>

<script>
    const chatBox = document.getElementById('chat-box');
    const chatIcon = document.getElementById('chat-icon');
    const closeChat = document.getElementById('close-chat');

    let isChatOpen = false; // Tracks the chatbox state (open or closed)

    // Toggle chatbox open/close when clicking the chat icon
    chatIcon.addEventListener('click', function () {
        if (isChatOpen) {
            closeChatBox();
        } else {
            openChatBox();
        }
    });

    // Close chatbox when clicking the close button inside the chatbox
    closeChat.addEventListener('click', function () {
        closeChatBox();
    });

    function openChatBox() {
        chatBox.style.display = 'flex';
        chatBox.style.opacity = '0';
        chatBox.style.transform = 'scale(0.8)';
        setTimeout(() => {
            chatBox.style.opacity = '1';
            chatBox.style.transform = 'scale(1)';
        }, 10);
        isChatOpen = true;
    }

    function closeChatBox() {
        chatBox.style.opacity = '0';
        chatBox.style.transform = 'scale(0.8)';
        setTimeout(() => {
            chatBox.style.display = 'none';
        }, 300); // Matches the transition duration
        isChatOpen = false;
    }

    function sendMessage() {
        const messagesContainer = document.querySelector('.chat-messages');
        const inputField = document.querySelector('.chat-input textarea');
        const messageText = inputField.value.trim();
        
        if (messageText) {
            const newMessage = document.createElement('div');
            newMessage.textContent = messageText;
            newMessage.style.padding = '10px';
            newMessage.style.margin = '10px 0';
            newMessage.style.borderRadius = '5px';
            newMessage.style.backgroundColor = '#e2e3e5';
            newMessage.style.alignSelf = 'flex-end';
            messagesContainer.appendChild(newMessage);
            inputField.value = '';
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }
    }
</script>
