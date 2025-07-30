
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Central Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="{{ route('central.dashboard') }}">SaaS Central</a>
                        <div class="navbar-nav ms-auto">
                            <a class="nav-link" href="{{ route('central.tenants.index') }}">Tenants</a>
                            <a class="nav-link" href="{{ route('central.register') }}">Add Tenant</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <h2>Dashboard</h2>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h4>{{ $stats['total_tenants'] }}</h4>
                        <p>Total Tenants</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h4>{{ $stats['active_tenants'] }}</h4>
                        <p>Active Tenants</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h4>{{ $stats['suspended_tenants'] }}</h4>
                        <p>Suspended Tenants</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Recent Tenants</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Plan</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stats['recent_tenants'] as $tenant)
                                <tr>
                                    <td>{{ $tenant->name }}</td>
                                    <td>{{ $tenant->email }}</td>
                                    <td>{{ ucfirst($tenant->plan) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $tenant->status === 'active' ? 'success' : 'warning' }}">
                                            {{ ucfirst($tenant->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $tenant->created_at->format('M d, Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
