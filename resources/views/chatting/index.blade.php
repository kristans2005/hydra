<x-app-layout>

    <div>
        <form action="{{ route('chat.send') }}" method="post" id="chat-form">
            @csrf
            <label for="message">Message:</label>
            <input type="text" name="message" id="message"><br>
            <input type="submit" value="Send">
        </form>
        
        <script>
            document.getElementById('chat-form').addEventListener('submit', function(e) {
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



    <script>
        setTimeout(() => {
            Echo.channel('chat')
                .listen('MessagingEvent', (e) => {
                    console.log(e);

                });
        }, 200);
    </script>

</x-app-layout>
