console.log("hiiiiii");


Echo.channel('chat')
    .listen('MessagingEvent', (e) => {
        console.log(e.message);
    });