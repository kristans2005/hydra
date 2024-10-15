<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    <!-- Customer Service Chat Box -->
                    <div class="chat-box" style="width: 300px; height: 400px; border: 1px solid #ccc; border-radius: 10px; display: flex; flex-direction: column; box-shadow: 0 4px 8px rgba(0,0,0,0.1); margin-top: 20px;">
                        <div class="chat-header" style="background-color: #343a40; color: white; padding: 10px; border-bottom: 1px solid #ccc; border-radius: 10px 10px 0 0; text-align: center; font-weight: bold;">
                            Customer Service
                        </div>
                        <div class="chat-messages" style="flex-grow: 1; padding: 10px; overflow-y: auto; background-color: #f8f9fa;">
                        </div>
                        <div class="chat-input" style="display: flex; border-top: 1px solid #ccc;">
                            <textarea rows="2" placeholder="Type your message..." style="flex-grow: 1; padding: 10px; border: none; border-radius: 0; resize: none; font-size: 14px; outline: none;"></textarea>
                            <button onclick="sendMessage()" style="padding: 10px 20px; border: none; background-color: #28a745; color: white; cursor: pointer; border-radius: 0 0 10px 0; font-size: 14px;">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
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
</x-app-layout>
