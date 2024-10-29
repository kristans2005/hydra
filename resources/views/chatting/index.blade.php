<x-app-layout>

    <div>

    </div>


    <!-- <script type="text/javascript" src="{{ asset('resources\js\echo.js')}}"></script> -->

    <script>

        window.Echo.channel('chat')
            .listen('MessagingEvent', (e) => {
                console.log(e);

            })

    </script>

</x-app-layout>