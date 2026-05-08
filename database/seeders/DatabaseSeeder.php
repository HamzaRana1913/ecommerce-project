<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin User ──────────────────────────────────────────
        $admin = User::firstOrCreate(
            ['email' => 'admin@luxestore.pk'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );

        // ── Sample Customer ──────────────────────────────────────
        $customer = User::firstOrCreate(
            ['email' => 'customer@example.com'],
            [
                'name'     => 'Ahmed Khan',
                'password' => Hash::make('password'),
                'is_admin' => false,
            ]
        );

        // ── Products ─────────────────────────────────────────────
        $products = [
            ['name' => 'Wireless Noise-Cancelling Headphones', 'category' => 'electronics', 'price' => 18500, 'stock' => 30],
            ['name' => 'Smart LED Desk Lamp',                  'category' => 'electronics', 'price' => 4200,  'stock' => 50],
            ['name' => 'Premium Leather Wallet',               'category' => 'fashion',     'price' => 3500,  'stock' => 80],
            ['name' => 'Slim-Fit Casual Shirt',                'category' => 'fashion',     'price' => 2200,  'stock' => 120],
            ['name' => 'Ceramic Coffee Mug Set (4pc)',         'category' => 'home & living','price' => 1800, 'stock' => 45],
            ['name' => 'Stainless Steel Water Bottle',         'category' => 'home & living','price' => 1200, 'stock' => 60],
            ['name' => 'Vitamin C Serum 30ml',                 'category' => 'beauty',      'price' => 2800,  'stock' => 35],
            ['name' => 'Moisturising Face Cream SPF50',        'category' => 'beauty',      'price' => 3200,  'stock' => 25],
            ['name' => 'Yoga Mat (6mm, Non-slip)',             'category' => 'sports',      'price' => 2500,  'stock' => 40],
            ['name' => 'Resistance Bands Set (5 levels)',      'category' => 'sports',      'price' => 1500,  'stock' => 75],
            ['name' => 'Bluetooth Mechanical Keyboard',        'category' => 'electronics', 'price' => 9800,  'stock' => 20],
            ['name' => 'Portable Charger 20000mAh',            'category' => 'electronics', 'price' => 3800,  'stock' => 55],
            ['name' => 'Linen Throw Blanket',                  'category' => 'home & living','price' => 2800, 'stock' => 30],
            ['name' => 'Satin Pajama Set',                     'category' => 'fashion',     'price' => 4500,  'stock' => 28],
            ['name' => 'Essential Oil Diffuser',               'category' => 'home & living','price' => 3200, 'stock' => 18],
        ];

        foreach ($products as $p) {
            Product::firstOrCreate(
                ['name' => $p['name']],
                array_merge($p, ['description' => 'Premium quality ' . $p['name'] . '. Built to last with exceptional craftsmanship.'])
            );
        }

        // ── Sample Orders ─────────────────────────────────────────
        $allProducts = Product::all();
        $statuses    = ['pending', 'processing', 'shipped', 'completed'];

        for ($i = 1; $i <= 6; $i++) {
            $order = Order::create([
                'user_id'          => $customer->id,
                'total_amount'     => 0,
                'payment_method'   => ['cod', 'bank_transfer', 'easypaisa'][($i - 1) % 3],
                'status'           => $statuses[($i - 1) % 4],
                'shipping_name'    => 'Ahmed Khan',
                'shipping_email'   => 'customer@example.com',
                'shipping_phone'   => '+92 300 1234567',
                'shipping_address' => 'House 42, Block B, Model Town, Lahore, Punjab',
                'notes'            => null,
                'created_at'       => now()->subDays(rand(1, 60)),
                'updated_at'       => now()->subDays(rand(0, 5)),
            ]);

            $total = 0;
            $pickedProducts = $allProducts->random(rand(1, 3));
            foreach ($pickedProducts as $product) {
                $qty = rand(1, 3);
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $product->id,
                    'quantity'   => $qty,
                    'price'      => $product->price,
                ]);
                $total += $product->price * $qty;
            }

            $shipping = $total > 2000 ? 0 : 200;
            $order->update(['total_amount' => $total + $shipping]);
        }
    }
}
