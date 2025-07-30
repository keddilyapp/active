<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Ensure this line is present
use App\Models\BusinessSetting;

class TenantSeeder extends Seeder
{
    public function run()
    {
        // Create admin user for tenant
        User::create([
            'name' => 'Tenant Admin',
            'email' => 'admin@' . tenant('id') . '.com',
            'password' => bcrypt('password'),
            'user_type' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create basic business settings
        $this->createBusinessSettings();
    }

    private function createBusinessSettings()
    {
        $settings = [
            ['type' => 'system_name', 'value' => tenant('name')],
            ['type' => 'system_logo_white', 'value' => ''],
            ['type' => 'system_logo_black', 'value' => ''],
            ['type' => 'site_name', 'value' => tenant('name')],
            ['type' => 'site_motto', 'value' => 'Your E-commerce Store'],
            ['type' => 'site_icon', 'value' => ''],
            ['type' => 'base_color', 'value' => '#e62e04'],
            ['type' => 'base_hue', 'value' => '5'],
            ['type' => 'frontend_copyright_text', 'value' => '© ' . date('Y') . ' ' . tenant('name')],
        ];

        foreach ($settings as $setting) {
            BusinessSetting::create($setting);
        }
    }
}