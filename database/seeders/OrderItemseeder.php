<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Pastikan ada data yang diperlukan
        $customers = Customer::all();
        $products = Product::all();

        if ($customers->isEmpty() || $products->isEmpty()) {
            $this->command->warn('Tidak ada customer atau product. Jalankan CustomerSeeder dan ProductSeeder terlebih dahulu.');
            return;
        }

        // Buat beberapa order terlebih dahulu
        $orders = [];
        for ($i = 0; $i < 20; $i++) {
            $customer = $customers->random();
            
            $order = Order::create([
                'order_number' => 'ORD' . now()->format('Ymd') . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'customer_id' => $customer->id_customer,
                'total_harga' => 0, // Akan diupdate setelah order items dibuat
                'status_order' => $faker->randomElement(['pending', 'processing', 'shipped', 'delivered', 'cancelled']),
                'catatan' => $faker->optional(0.3)->sentence(),
                'tanggal_order' => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
                'expired_at' => $faker->optional(0.5)->dateTimeBetween('now', '+7 days'),
            ]);

            $orders[] = $order;
        }

        // Buat order items untuk setiap order
        foreach ($orders as $order) {
            $itemCount = $faker->numberBetween(1, 5); // 1-5 items per order
            $totalHarga = 0;

            for ($j = 0; $j < $itemCount; $j++) {
                $product = $products->random();
                $quantity = $faker->numberBetween(1, 10);
                
                // Get price from product variants or set random price
                $unitPrice = $product->variants()->first()?->price?->regular_price ?? $faker->numberBetween(50000, 2000000);
                $subtotal = $unitPrice * $quantity;
                $totalHarga += $subtotal;

                OrderItem::create([
                    'id_order' => $order->id_order,
                    'id_product' => $product->id_product,
                    'total' => $quantity,
                    'unit_price' => $unitPrice,
                    'subtotal' => $subtotal,
                ]);

                // Update product stock (kurangi stok)
                $product->decrement('stok', $quantity);
                $product->increment('stok_sales', $quantity);
            }

            // Update total harga order
            $order->update(['total_harga' => $totalHarga]);
        }

        // Buat beberapa order items dengan nilai tinggi untuk testing
        $highValueOrders = Order::inRandomOrder()->limit(5)->get();
        
        foreach ($highValueOrders as $order) {
            $product = $products->random();
            $quantity = $faker->numberBetween(1, 3);
            $unitPrice = $faker->numberBetween(1500000, 5000000); // High value items
            $subtotal = $unitPrice * $quantity;

            OrderItem::create([
                'id_order' => $order->id_order,
                'id_product' => $product->id_product,
                'total' => $quantity,
                'unit_price' => $unitPrice,
                'subtotal' => $subtotal,
            ]);

            // Update order total
            $order->increment('total_harga', $subtotal);
            
            // Update product stock
            $product->decrement('stok', $quantity);
            $product->increment('stok_sales', $quantity);
        }

        // Buat order items untuk hari ini (untuk testing today's stats)
        $todayOrders = Order::inRandomOrder()->limit(3)->get();
        
        foreach ($todayOrders as $order) {
            $product = $products->random();
            $quantity = $faker->numberBetween(1, 5);
            $unitPrice = $product->variants()->first()?->price?->regular_price ?? $faker->numberBetween(100000, 1000000);
            $subtotal = $unitPrice * $quantity;

            $orderItem = OrderItem::create([
                'id_order' => $order->id_order,
                'id_product' => $product->id_product,
                'total' => $quantity,
                'unit_price' => $unitPrice,
                'subtotal' => $subtotal,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Update order total
            $order->increment('total_harga', $subtotal);
            
            // Update product stock
            $product->decrement('stok', $quantity);
            $product->increment('stok_sales', $quantity);
        }

        $this->command->info('OrderItem seeder completed successfully!');
        $this->command->info('Total orders created: ' . count($orders));
        $this->command->info('Total order items created: ' . OrderItem::count());
        $this->command->info('Total revenue: Rp ' . number_format(Order::sum('total_harga'), 0, ',', '.'));
    }
}