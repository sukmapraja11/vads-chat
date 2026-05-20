<!DOCTYPE html>
<html>

<head>

    <title>
        Master Customer
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href=
    "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    <div class="container mt-4">
        <div
            class="d-flex
                justify-content-between
                align-items-center
                mb-4">
            <h3>
                Master Customer JSON API
            </h3>
            <a href="/workspace" class="btn btn-primary">
                Back Workspace
            </a>
        </div>

        <div class="card shadow">
            <div class="card-header bg-success text-white">
                Random User API
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>
                                    Picture
                                </th>

                                <th>
                                    Name
                                </th>

                                <th>
                                    Email
                                </th>

                                <th>
                                    UUID
                                </th>

                                <th>
                                    Username
                                </th>

                                <th>
                                    Password
                                </th>

                                <th>
                                    Phone
                                </th>

                                <th>
                                    Cell
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td width="100">

                                        <img src="{{ $customer['picture']['medium'] }}" class="rounded-circle">

                                    </td>
                                    <td>

                                        {{ $customer['name'] }}

                                    </td>
                                    <td>

                                        {{ $customer['email'] }}

                                    </td>
                                    <td>

                                        {{ $customer['login']['uuid'] }}

                                    </td>
                                    <td>

                                        {{ $customer['login']['username'] }}

                                    </td>
                                    <td>

                                        {{ $customer['login']['password'] }}

                                    </td>
                                    <td>

                                        {{ $customer['phone'] }}

                                    </td>
                                    <td>

                                        {{ $customer['cell'] }}

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
