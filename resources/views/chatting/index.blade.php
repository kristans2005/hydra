<x-app-layout>
    <div class="max-w-2xl mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">

        {{-- Chat Messages --}}
        <div id="chat-messages" class="mb-4">
            @foreach($messages as $message)
                <div class="mb-2">
                    <p class="text-gray-800"><strong class="text-blue-600">{{ $message->name }}:</strong>
                        {{ $message->message }}</p>
                </div>
            @endforeach
        </div>

        {{-- Message Form --}}
        <div class="mt-6">
            <form action="{{ route('chat.send') }}" method="post" id="chat-form" class="flex items-center space-x-4">
                @csrf
                <div class="flex-1">
                    <label for="message" class="sr-only">Message:</label>
                    <input type="text" name="message" id="message" placeholder="Type your message..."
                        class="w-full px-4 py-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div>
                    <input type="submit" value="Send"
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 cursor-pointer">
                </div>
            </form>
        </div>

        {{-- JavaScript for Message Submission --}}
        <script>
            document.getElementById('chat-form').addEventListener('submit', function (e) {
                e.preventDefault();
                axios.post(this.action, {
                    '_token': '{{ csrf_token() }}',
                    'message': document.getElementById('message').value
                })
                    .then(function (response) {
                        console.log(response);
                        document.getElementById('message').value = '';
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            });
        </script>
    </div>

    {{-- JavaScript for Real-Time Messaging --}}
    <script>
        setTimeout(() => {
            Echo.channel('chat')
                .listen('MessagingEvent', (e) => {
                    console.log(e);
                    const chatMessages = document.getElementById('chat-messages');

                    // Create new message element
                    const messageDiv = document.createElement('div');
                    messageDiv.classList.add('mb-2');
                    messageDiv.innerHTML = `<p class="text-gray-800"><strong class="text-blue-600">${e.user.name}:</strong> ${e.message}</p>`;

                    // Append the new message
                    chatMessages.appendChild(messageDiv);

                    // Optionally scroll to the bottom for new message visibility
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                });
        }, 200);
    </script>
</x-app-layout>