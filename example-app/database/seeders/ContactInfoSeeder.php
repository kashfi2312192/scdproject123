<?php

namespace Database\Seeders;

use App\Models\ContactInfo;
use Illuminate\Database\Seeder;

class ContactInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contactInfos = [
            [
                'key' => 'address',
                'value' => 'PO Box 1622 Bamboo Street West',
            ],
            [
                'key' => 'email',
                'value' => 'Emillia@example.com',
            ],
            [
                'key' => 'phone',
                'value' => '+(123)-456-7890',
            ],
            [
                'key' => 'opening_hours',
                'value' => '9:00AM - 10:00PM',
            ],
        ];

        foreach ($contactInfos as $info) {
            ContactInfo::updateOrCreate(
                ['key' => $info['key']],
                ['value' => $info['value']]
            );
        }
    }
}
