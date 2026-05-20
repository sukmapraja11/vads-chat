<!DOCTYPE html>
<html>

<head>

    <title>Queue Room</title>

    <link href=
    "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">

                Queue Room

            </div>

            <div class="card-body text-center">
                <h3>
                    Searching Service Desk...
                </h3>

                <p>
                    Please wait
                </p>

                <h1 id="timer">
                    180
                </h1>
            </div>
        </div>
    </div>

    <script>
        let seconds = 180;

        const sessionId = {{ $session->id }};

        const timer = setInterval(function() {

            seconds--;

            document
                .getElementById('timer')
                .innerHTML = seconds;

            fetch('/check-sd/' + sessionId)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.status == 'connected') {
                        clearInterval(timer);
                        alert(
                            'Service Desk Connected'
                        );
                        window.location.href =
                            '/chat/' + sessionId;
                    }
                });

            if (seconds <= 0) {
                clearInterval(timer);
                alert(
                    'No Service Desk Available'
                );
                window.location.href =
                    '/login';
            }
        }, 3000);
    </script>

    <script src="https://cdn.socket.io/4.7.5/socket.io.min.js"></script>

    <script>
        const socket =
            io('http://127.0.0.1:3000');

        socket.emit('new_customer', {
            id: '{{ $session->id }}',
            customer_name: '{{ $session->customer_name }}',
            email: '{{ $session->email }}',
            phone: '{{ $session->phone }}',
            created_at: '{{ $session->created_at }}'
        });
    </script>
</body>

</html>
