
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Suspended</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8 text-center">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-warning">Account Suspended</h1>
                        <p class="lead">This tenant account has been suspended.</p>
                        <p>Please contact support for more information.</p>
                        <hr>
                        <p><strong>Tenant:</strong> {{ $tenant->name }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($tenant->status) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
