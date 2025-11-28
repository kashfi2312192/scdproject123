<?php

namespace Database\Seeders;

use App\Models\Policy;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $policies = [
            // Our Policies
            [
                'title' => 'Shipping & Delivery',
                'slug' => 'shipping-delivery',
                'type' => 'policy',
                'content' => 'We aim to deliver your order within 3–5 business days. All shipments are tracked and insured. Delivery times may vary depending on your location. We ship to addresses within our service areas. For international orders, please allow additional time for customs processing.',
            ],
            [
                'title' => 'Returns Policy',
                'slug' => 'returns-policy',
                'type' => 'policy',
                'content' => 'Returns accepted within 14 days of delivery. Items must be unworn and in original packaging with all tags attached. Custom or personalized items are not eligible for return. Please contact us before returning any items. Refunds will be processed to the original payment method within 5-7 business days after we receive and inspect the returned item.',
            ],
            [
                'title' => 'Terms & Conditions',
                'slug' => 'terms-conditions',
                'type' => 'policy',
                'content' => 'By using our website and purchasing our products, you agree to these terms and conditions. All products are subject to availability. We reserve the right to refuse or cancel any order. Prices are subject to change without notice. All intellectual property rights in the website and products belong to us. We are not liable for any indirect or consequential damages.',
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'type' => 'policy',
                'content' => 'We respect your privacy and are committed to protecting your personal information. We collect information that you provide directly to us, such as when you create an account, make a purchase, or contact us. We use this information to process your orders, communicate with you, and improve our services. We do not sell your personal information to third parties. We implement appropriate security measures to protect your data.',
            ],
            // Customer Care
            [
                'title' => 'FAQs',
                'slug' => 'faqs',
                'type' => 'customer_care',
                'content' => 'Frequently Asked Questions:

Q: How long does shipping take?
A: Standard shipping takes 3-5 business days. Express shipping options are available at checkout.

Q: Do you offer international shipping?
A: Yes, we ship internationally. Shipping times and costs vary by location.

Q: Can I track my order?
A: Yes, you will receive a tracking number via email once your order ships.

Q: What payment methods do you accept?
A: We accept credit cards, debit cards, and cash on delivery.

Q: How do I return an item?
A: Contact us within 14 days of delivery to initiate a return. Items must be in original condition.',
            ],
            [
                'title' => 'Terms of Service',
                'slug' => 'terms-of-service',
                'type' => 'customer_care',
                'content' => 'These Terms of Service govern your use of our website and services. By accessing or using our website, you agree to be bound by these terms. You may not use our website for any unlawful purpose or to solicit others to perform unlawful acts. You agree not to reproduce, duplicate, copy, sell, resell, or exploit any portion of the service without express written permission. We reserve the right to terminate or suspend access to our service immediately, without prior notice, for any breach of these terms.',
            ],
            [
                'title' => 'Gift Card',
                'slug' => 'gift-card',
                'type' => 'customer_care',
                'content' => 'Gift cards are available for purchase in various denominations. Gift cards can be used to purchase any products on our website. Gift cards do not expire and have no fees. Gift cards cannot be redeemed for cash. If your order total is less than the gift card value, the remaining balance will stay on the gift card for future use. If your order exceeds the gift card value, you can pay the difference using another payment method. Gift cards are non-refundable.',
            ],
        ];

        foreach ($policies as $policy) {
            Policy::updateOrCreate(
                ['slug' => $policy['slug']],
                [
                    'title' => $policy['title'],
                    'content' => $policy['content'],
                    'type' => $policy['type'],
                ]
            );
        }
    }
}
