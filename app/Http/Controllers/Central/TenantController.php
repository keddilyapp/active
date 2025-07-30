
<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Stancl\Tenancy\Database\Models\Domain;

class TenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::with('domains')->paginate(20);
        return view('central.tenants.index', compact('tenants'));
    }

    public function show(Tenant $tenant)
    {
        $tenant->load('domains');
        return view('central.tenants.show', compact('tenant'));
    }

    public function showRegistrationForm()
    {
        return view('central.tenants.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants,email',
            'subdomain' => 'required|string|max:255|unique:domains,domain',
            'plan' => 'required|in:basic,premium,enterprise',
        ]);

        // Create tenant
        $tenant = Tenant::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'email' => $request->email,
            'plan' => $request->plan,
            'status' => 'active',
            'settings' => [
                'max_products' => $this->getMaxProducts($request->plan),
                'max_orders' => $this->getMaxOrders($request->plan),
                'features' => $this->getPlanFeatures($request->plan),
            ],
        ]);

        // Create domain
        $domain = $request->subdomain . '.' . config('app.domain', 'localhost');
        $tenant->domains()->create([
            'domain' => $domain,
        ]);

        // Run tenant migrations
        $tenant->run(function () {
            \Artisan::call('migrate', [
                '--path' => 'database/migrations/tenant',
                '--force' => true,
            ]);
            
            // Seed basic data
            \Artisan::call('db:seed', [
                '--class' => 'TenantSeeder',
                '--force' => true,
            ]);
        });

        return redirect()->route('central.tenants.show', $tenant)
                        ->with('success', 'Tenant created successfully!');
    }

    public function updateStatus(Request $request, Tenant $tenant)
    {
        $request->validate([
            'status' => 'required|in:active,suspended,inactive',
        ]);

        $tenant->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Tenant status updated successfully!');
    }

    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return redirect()->route('central.tenants.index')
                        ->with('success', 'Tenant deleted successfully!');
    }

    private function getMaxProducts($plan)
    {
        return match($plan) {
            'basic' => 100,
            'premium' => 1000,
            'enterprise' => -1, // unlimited
            default => 100,
        };
    }

    private function getMaxOrders($plan)
    {
        return match($plan) {
            'basic' => 500,
            'premium' => 5000,
            'enterprise' => -1, // unlimited
            default => 500,
        };
    }

    private function getPlanFeatures($plan)
    {
        return match($plan) {
            'basic' => ['basic_analytics', 'email_support'],
            'premium' => ['advanced_analytics', 'priority_support', 'custom_themes'],
            'enterprise' => ['advanced_analytics', 'priority_support', 'custom_themes', 'api_access', 'white_label'],
            default => ['basic_analytics', 'email_support'],
        };
    }
}
