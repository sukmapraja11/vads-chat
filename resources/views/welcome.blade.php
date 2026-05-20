<!DOCTYPE html>
<html>

<head>

    <title>Live Chat App</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        #chat-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #25d366;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: 0.2s;
        }

        #chat-icon:hover {
            transform: scale(1.1);
        }
    </style>

</head>

<body class="bg-light d-flex align-items-center justify-content-center" style="height:100vh;">

    <div class="card shadow" style="width: 420px;">

        <div class="container">

            <div class="d-flex align-items-center justify-content-center" style="height:100vh;">

                <div class="card shadow" style="width: 450px;">

                    <div class="card-header bg-primary text-white text-center">
                        Login Service Desk
                    </div>

                    <div class="card-body">

                        <form method="POST" action="/login">
                            @csrf

                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control form-control-lg" required>
                            </div>

                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control form-control-lg" required>
                            </div>

                            <button class="btn btn-primary w-100 btn-lg">
                                Login
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

        <div id="chat-icon" onclick="goToChat()">
            <i class="bi bi-chat-dots-fill"></i>
        </div>

        <script>
            function goToChat() {
                window.location.href = "/register-chat";
            }
        </script>

</body>

</html>
