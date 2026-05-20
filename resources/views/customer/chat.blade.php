<!DOCTYPE html>
<html>

<head>
    <title>Live Chat</title>
    <link href=
"https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.socket.io/4.7.5/socket.io.min.js"></script>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                Live Chat Customer
            </div>

            <div class="card-body">
                <div id="chat-box" style="height:350px; overflow:auto; border:1px solid #ddd; padding:10px;">
                    <div class="mb-2">
                        <b>BOT:</b>
                        Halo
                        {{ $session->customer_name }}.
                        Saya Agent BOT apa yang kamu
                        ingin tanyakan?
                    </div>

                    @foreach ($messages as $chat)
                        <div class="mb-2">
                            <b>
                                {{ $chat->sender }}:
                            </b>
                            {{ $chat->message }}
                        </div>
                    @endforeach
                </div>

                <div class="mt-3 d-flex">
                    <textarea id="message" class="form-control me-2"></textarea>
                    <button onclick="sendMessage()" class="btn btn-primary">
                        Send
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const socket =
            io('http://127.0.0.1:3000');

        socket.on('connect', () => {
            console.log(
                'CONNECTED SOCKET'
            );
        });

        const room =
            'chat_{{ $session->id }}';

        socket.emit('join_room', room);

        console.log(
            'JOIN ROOM:',
            room
        );

        socket.on('receive_message', (data) => {
            console.log(
                'RECEIVED:',
                data
            );

            const chatBox =
                document.getElementById('chat-box');
            chatBox.innerHTML += `

        <div class="mb-2">
            <b>${data.sender}:</b>
            ${data.message}
        </div>
    `;
            chatBox.scrollTop =
                chatBox.scrollHeight;
        });

        let idleTime = 0;

        function sendMessage() {
            let message =
                document
                .getElementById('message')
                .value;

            socket.emit('send_message', {
                room: room,
                sender: 'Customer',
                message: message
            });

            fetch('/save-message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    session_id: '{{ $session->id }}',
                    sender: 'Customer',
                    message: message
                })
            });
            document
                .getElementById('message')
                .value = '';

            idleTime = 0;
        }

        setInterval(function() {
            idleTime++;
            if (idleTime == 180) {

                document
                    .getElementById('chat-box')
                    .innerHTML +=

                    `<div class="mb-2 text-warning">
            BOT:
            Saya masih menunggu
            respons jawaban
            chat Bapak/Ibu.
        </div>`;
            }

            if (idleTime == 240) {
                document
                    .getElementById('chat-box')
                    .innerHTML +=

                    `<div class="mb-2 text-danger">

            BOT:
            Mohon maaf,
            karena tidak ada
            respons chat dari
            Bapak/Ibu,
            saya akhiri chat ini.
        </div>`;

                setTimeout(() => {
                    window.location.href =
                        '/login';
                }, 3000);
            }
        }, 1000);

        document.addEventListener(
            'keypress',
            () => {

                idleTime = 0;
            });
    </script>

</body>

</html>
