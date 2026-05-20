<!DOCTYPE html>
<html>

<head>

    <title>Live Chat Register</title>

    <link href=
"https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        Live Chat Support
                    </div>

                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="/register-chat">
                            @csrf
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="customer_name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>No Phone</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Captcha</label>
                                <div class="d-flex align-items-center">
                                    <div id="captcha-box"
                                        class="border rounded p-3 text-center flex-grow-1 me-2 bg-light">
                                        <h4 class="mb-0">
                                            {{ $captcha }}
                                        </h4>
                                    </div>

                                    <button type="button" class="btn btn-secondary" onclick="refreshCaptcha()">
                                        Refresh
                                    </button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <input type="text" name="captcha" class="form-control" placeholder="Input captcha"
                                    required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                Next
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function refreshCaptcha() {
            fetch('/refresh-captcha')
                .then(response => response.json())
                .then(data => {
                    document
                        .getElementById('captcha-box')
                        .innerHTML =
                        '<h4 class="mb-0">' +
                        data.captcha +
                        '</h4>';
                });
        }
    </script>

</body>

</html>
