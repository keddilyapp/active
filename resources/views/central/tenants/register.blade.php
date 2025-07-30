
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New Tenant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Register New Tenant</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('central.register.store') }}">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Tenant Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="subdomain" class="form-label">Subdomain</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="subdomain" name="subdomain" value="{{ old('subdomain') }}" required>
                                    <span class="input-group-text">.{{ config('app.domain', 'localhost') }}</span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="plan" class="form-label">Plan</label>
                                <select class="form-control" id="plan" name="plan" required>
                                    <option value="basic" {{ old('plan') === 'basic' ? 'selected' : '' }}>Basic (100 products, 500 orders)</option>
                                    <option value="premium" {{ old('plan') === 'premium' ? 'selected' : '' }}>Premium (1000 products, 5000 orders)</option>
                                    <option value="enterprise" {{ old('plan') === 'enterprise' ? 'selected' : '' }}>Enterprise (Unlimited)</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Create Tenant</button>
                                <a href="{{ route('central.dashboard') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
