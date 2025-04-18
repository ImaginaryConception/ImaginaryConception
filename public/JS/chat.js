// Chat Widget Component
class ChatWidget {
    constructor() {
        this.isOpen = false;
        this.isMinimized = false;
        this.messages = [];
        this.createChatWidget();
        this.initWebSocket();
    }

    createChatWidget() {
        // Create main chat container
        const chatContainer = document.createElement('div');
        chatContainer.className = 'chat-widget';
        chatContainer.innerHTML = `
            <button class="chat-toggle-btn">
                <span class="chat-toggle-icon">💬</span>
                <span class="chat-toggle-text">Discuter maintenant</span>
            </button>
            <div class="chat-window" style="display: none;">
                <div class="chat-header">
                    <h3>Service Client</h3>
                    <div class="chat-controls">
                        <button class="minimize-btn">_</button>
                        <button class="close-btn">×</button>
                    </div>
                </div>
                <div class="chat-messages"></div>
                <div class="chat-input-container">
                    <textarea 
                        class="chat-input" 
                        placeholder="Écrivez votre message ici..."
                        rows="1"
                    ></textarea>
                    <button class="send-btn">Envoyer</button>
                </div>
            </div>
        `;

        document.body.appendChild(chatContainer);

        // Initialize elements
        this.toggleBtn = chatContainer.querySelector('.chat-toggle-btn');
        this.chatWindow = chatContainer.querySelector('.chat-window');
        this.minimizeBtn = chatContainer.querySelector('.minimize-btn');
        this.closeBtn = chatContainer.querySelector('.close-btn');
        this.messagesContainer = chatContainer.querySelector('.chat-messages');
        this.input = chatContainer.querySelector('.chat-input');
        this.sendBtn = chatContainer.querySelector('.send-btn');

        // Add event listeners
        this.toggleBtn.addEventListener('click', () => this.toggleChat());
        this.minimizeBtn.addEventListener('click', () => this.minimizeChat());
        this.closeBtn.addEventListener('click', () => this.closeChat());
        this.sendBtn.addEventListener('click', () => this.sendMessage());
        this.input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                this.sendMessage();
            }
        });

        // Auto-expand textarea
        this.input.addEventListener('input', () => {
            this.input.style.height = 'auto';
            this.input.style.height = this.input.scrollHeight + 'px';
        });

        // Show welcome message after a short delay
        setTimeout(() => {
            this.addMessage({
                type: 'bot',
                content: 'Bonjour ! Comment puis-je vous aider aujourd\'hui ?'
            });
        }, 1000);
    }

    initWebSocket() {
        // Initialize WebSocket connection
        this.socket = new WebSocket('ws://' + window.location.host + '/chat');

        this.socket.onmessage = (event) => {
            const message = JSON.parse(event.data);
            this.addMessage(message);
        };

        this.socket.onerror = (error) => {
            console.error('WebSocket error:', error);
        };
    }

    toggleChat() {
        if (this.isMinimized) {
            this.isMinimized = false;
            this.chatWindow.style.transform = 'translateY(0)';
        } else {
            this.isOpen = !this.isOpen;
            this.chatWindow.style.display = this.isOpen ? 'flex' : 'none';
            if (this.isOpen) {
                this.input.focus();
            }
        }
    }

    minimizeChat() {
        this.isMinimized = true;
        this.chatWindow.style.transform = 'translateY(calc(100% - 40px))';
    }

    closeChat() {
        this.isOpen = false;
        this.chatWindow.style.display = 'none';
    }

    sendMessage() {
        const content = this.input.value.trim();
        if (!content) return;

        // Add user message
        this.addMessage({
            type: 'user',
            content: content
        });

        // Clear input
        this.input.value = '';
        this.input.style.height = 'auto';

        // Send message to server
        if (this.socket.readyState === WebSocket.OPEN) {
            this.socket.send(JSON.stringify({
                type: 'user',
                content: content
            }));
        }

        // Simulate bot response (temporary)
        setTimeout(() => {
            this.addMessage({
                type: 'bot',
                content: 'Je vais vous aider avec votre demande. Un instant s\'il vous plaît...'
            });
        }, 1000);
    }

    addMessage(message) {
        const messageElement = document.createElement('div');
        messageElement.className = `chat-message ${message.type}-message`;
        messageElement.innerHTML = `
            <div class="message-content">${message.content}</div>
            <div class="message-time">${new Date().toLocaleTimeString()}</div>
        `;

        this.messagesContainer.appendChild(messageElement);
        this.messagesContainer.scrollTop = this.messagesContainer.scrollHeight;
        this.messages.push(message);
    }
}

// Initialize chat widget when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new ChatWidget();
});