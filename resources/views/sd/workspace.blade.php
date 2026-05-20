<!DOCTYPE html>
<html>

<head>

    <title>
        Workspace SD
    </title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href=
    "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">
    <div class="container mt-4">
        <div
            class="d-flex
            flex-column
            flex-md-row
            justify-content-between
            align-items-start
            align-items-md-center
            gap-3
            mb-4">

            <h3>
                Workspace Service Desk
            </h3>

            <div>
                <b>
                    {{ auth()->user()->name }}
                </b>

                <form method="POST" action="/logout" class="d-inline">
                    @csrf
                    <button class="btn btn-danger btn-sm">
                        Sign Out
                    </button>
                </form>

                <a href="/master-customer" class="btn btn-success btn-sm">
                    Master Customer
                </a>
            </div>
        </div>

        <div class="card shadow">

            <div class="card-header bg-primary text-white">
                Customer Live Chat
            </div>

            <div class="table-responsive">

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>
                                Icon
                            </th>

                            <th>
                                Customer
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Phone
                            </th>

                            <th>
                                Date
                            </th>

                            <th>
                                Last Client Chat
                            </th>

                            <th>
                                Last SD Chat
                            </th>

                            <th>
                                Date Insert
                            </th>

                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody id="customer-list">

                        @foreach ($sessions as $session)
                            <tr>
                                <td width="80">
                                    <img src="https://cdn-icons-png.flaticon.com/512/1144/1144760.png" width="50">
                                </td>

                                <td>
                                    {{ $session->customer_name }}
                                </td>

                                <td>
                                    {{ $session->email }}
                                </td>

                                <td>
                                    {{ $session->phone }}
                                </td>

                                <td>
                                    {{ $session->created_at }}
                                </td>

                                <td>
                                    @php
                                        $clientChat = \App\Models\ChatMessage::where(
                                            'customer_session_id',
                                            $session->id,
                                        )
                                            ->where('sender', 'Customer')
                                            ->latest()
                                            ->first();
                                    @endphp
                                    {{ $clientChat->message ?? '-' }}
                                </td>

                                <td>
                                    @php
                                        $sdChat = \App\Models\ChatMessage::where('customer_session_id', $session->id)
                                            ->where('sender', 'Service Desk')
                                            ->latest()
                                            ->first();
                                    @endphp
                                    {{ $sdChat->message ?? '-' }}
                                </td>

                                <td>
                                    @php
                                        $lastMessage = \App\Models\ChatMessage::where(
                                            'customer_session_id',
                                            $session->id,
                                        )
                                            ->latest()
                                            ->first();
                                    @endphp
                                    {{ $lastMessage->created_at ?? '-' }}
                                </td>

                                <td>
                                    <a href="/sd/chat/{{ $session->id }}" class="btn btn-primary btn-sm">View</a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.socket.io/4.7.5/socket.io.min.js"></script>
    <script>
        const socket =
            io('http://127.0.0.1:3000');

        socket.on(
            'customer_list_update',
            (data) => {

                let row = `
        <tr>

            <td width="80">
                <img
                src="https://cdn-icons-png.flaticon.com/512/1144/1144760.png"
                width="50">
            </td>

            <td>
                ${data.customer_name}
            </td>

            <td>
                ${data.email}
            </td>

            <td>
                ${data.phone}
            </td>

            <td>
                ${data.created_at}
            </td>

            <td>
                -
            </td>

            <td>
                -
            </td>

            <td>
                <a
                href="/sd/chat/${data.id}"
                class="btn btn-primary btn-sm">
                    View
                </a>
            </td>
        </tr>
        `;

                document
                    .getElementById('customer-list')
                    .innerHTML += row;

            });
    </script>
</body>

</html>
