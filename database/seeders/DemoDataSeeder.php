<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create buffet restaurant categories
        $mainDishes = Category::firstOrCreate(
            ['slug' => 'main-dishes'],
            [
                'name' => 'Main Dishes',
                'description' => 'Main course items for buffet',
                'is_active' => true,
            ]
        );

        $appetizers = Category::firstOrCreate(
            ['slug' => 'appetizers'],
            [
                'name' => 'Appetizers',
                'description' => 'Starter items and finger foods',
                'is_active' => true,
            ]
        );

        $desserts = Category::firstOrCreate(
            ['slug' => 'desserts'],
            [
                'name' => 'Desserts',
                'description' => 'Sweet treats and desserts',
                'is_active' => true,
            ]
        );

        $beverages = Category::firstOrCreate(
            ['slug' => 'beverages'],
            [
                'name' => 'Beverages',
                'description' => 'Drinks and beverages',
                'is_active' => true,
            ]
        );

        $salads = Category::firstOrCreate(
            ['slug' => 'salads'],
            [
                'name' => 'Salads & Sides',
                'description' => 'Fresh salads and side dishes',
                'is_active' => true,
            ]
        );

        $seafood = Category::firstOrCreate(
            ['slug' => 'seafood'],
            [
                'name' => 'Seafood',
                'description' => 'Fresh seafood dishes',
                'parent_id' => $mainDishes->id,
                'is_active' => true,
            ]
        );

        // Create suppliers for restaurant
        $foodSupplier = Supplier::firstOrCreate(
            ['code' => 'SUP0001'],
            [
                'name' => 'Fresh Food Distributors',
                'email' => 'orders@freshfood.com',
                'phone' => '+1555-123-4567',
                'address' => '123 Market Street',
                'city' => 'Downtown',
                'country' => 'USA',
                'contact_person' => 'Maria Rodriguez',
                'is_active' => true,
            ]
        );

        $beverageSupplier = Supplier::firstOrCreate(
            ['code' => 'SUP0002'],
            [
                'name' => 'Premium Beverage Co',
                'email' => 'sales@premiumbev.com',
                'phone' => '+1555-234-5678',
                'address' => '456 Industrial Blvd',
                'city' => 'Warehouse District',
                'country' => 'USA',
                'contact_person' => 'Robert Chen',
                'is_active' => true,
            ]
        );

        $dairySupplier = Supplier::firstOrCreate(
            ['code' => 'SUP0003'],
            [
                'name' => 'Golden Valley Dairy',
                'email' => 'orders@goldendairy.com',
                'phone' => '+1555-345-6789',
                'address' => '789 Farm Road',
                'city' => 'Valley Springs',
                'country' => 'USA',
                'contact_person' => 'Sarah Johnson',
                'is_active' => true,
            ]
        );

        // Create buffet products
        $products = [
            // Main Dishes
            [
                'name' => 'Grilled Chicken Breast',
                'sku' => 'MAIN001',
                'barcode' => '2234567890001',
                'description' => 'Herb-seasoned grilled chicken breast',
                'category_id' => $mainDishes->id,
                'supplier_id' => $foodSupplier->id,
                'cost_price' => 8.50,
                'selling_price' => 15.99,
                'quantity' => 45,
                'min_stock_level' => 10,
                'max_stock_level' => 100,
                'unit' => 'portions',
                'location' => 'Main Kitchen - Grill Station',
                'is_active' => true,
            ],
            [
                'name' => 'Beef Stroganoff',
                'sku' => 'MAIN002',
                'barcode' => '2234567890002',
                'description' => 'Classic beef stroganoff with mushrooms',
                'category_id' => $mainDishes->id,
                'supplier_id' => $foodSupplier->id,
                'cost_price' => 12.00,
                'selling_price' => 19.99,
                'quantity' => 35,
                'min_stock_level' => 8,
                'max_stock_level' => 80,
                'unit' => 'portions',
                'location' => 'Main Kitchen - Hot Station',
                'is_active' => true,
            ],
            [
                'name' => 'Vegetable Lasagna',
                'sku' => 'MAIN003',
                'barcode' => '2234567890003',
                'description' => 'Layered vegetable lasagna with ricotta',
                'category_id' => $mainDishes->id,
                'supplier_id' => $foodSupplier->id,
                'cost_price' => 7.25,
                'selling_price' => 13.99,
                'quantity' => 28,
                'min_stock_level' => 5,
                'max_stock_level' => 60,
                'unit' => 'portions',
                'location' => 'Main Kitchen - Vegetarian Station',
                'is_active' => true,
            ],

            // Seafood
            [
                'name' => 'Grilled Salmon Fillet',
                'sku' => 'SEA001',
                'barcode' => '2234567890004',
                'description' => 'Fresh Atlantic salmon with lemon herbs',
                'category_id' => $seafood->id,
                'supplier_id' => $foodSupplier->id,
                'cost_price' => 15.00,
                'selling_price' => 24.99,
                'quantity' => 20,
                'min_stock_level' => 5,
                'max_stock_level' => 40,
                'unit' => 'portions',
                'location' => 'Main Kitchen - Seafood Station',
                'is_active' => true,
            ],
            [
                'name' => 'Shrimp Tempura',
                'sku' => 'SEA002',
                'barcode' => '2234567890005',
                'description' => 'Crispy tempura battered shrimp',
                'category_id' => $seafood->id,
                'supplier_id' => $foodSupplier->id,
                'cost_price' => 11.50,
                'selling_price' => 18.99,
                'quantity' => 30,
                'min_stock_level' => 8,
                'max_stock_level' => 60,
                'unit' => 'portions',
                'location' => 'Main Kitchen - Fryer Station',
                'is_active' => true,
            ],

            // Appetizers
            [
                'name' => 'Buffalo Chicken Wings',
                'sku' => 'APP001',
                'barcode' => '2234567890006',
                'description' => 'Spicy buffalo chicken wings with ranch',
                'category_id' => $appetizers->id,
                'supplier_id' => $foodSupplier->id,
                'cost_price' => 6.75,
                'selling_price' => 12.99,
                'quantity' => 50,
                'min_stock_level' => 15,
                'max_stock_level' => 120,
                'unit' => 'portions',
                'location' => 'Appetizer Station',
                'is_active' => true,
            ],
            [
                'name' => 'Mozzarella Sticks',
                'sku' => 'APP002',
                'barcode' => '2234567890007',
                'description' => 'Golden fried mozzarella with marinara',
                'category_id' => $appetizers->id,
                'supplier_id' => $dairySupplier->id,
                'cost_price' => 4.25,
                'selling_price' => 8.99,
                'quantity' => 65,
                'min_stock_level' => 20,
                'max_stock_level' => 150,
                'unit' => 'portions',
                'location' => 'Appetizer Station',
                'is_active' => true,
            ],

            // Salads & Sides
            [
                'name' => 'Caesar Salad',
                'sku' => 'SAL001',
                'barcode' => '2234567890008',
                'description' => 'Fresh romaine with caesar dressing',
                'category_id' => $salads->id,
                'supplier_id' => $foodSupplier->id,
                'cost_price' => 3.50,
                'selling_price' => 7.99,
                'quantity' => 40,
                'min_stock_level' => 10,
                'max_stock_level' => 80,
                'unit' => 'portions',
                'location' => 'Salad Bar',
                'is_active' => true,
            ],
            [
                'name' => 'Garlic Mashed Potatoes',
                'sku' => 'SIDE001',
                'barcode' => '2234567890009',
                'description' => 'Creamy mashed potatoes with roasted garlic',
                'category_id' => $salads->id,
                'supplier_id' => $foodSupplier->id,
                'cost_price' => 2.75,
                'selling_price' => 5.99,
                'quantity' => 60,
                'min_stock_level' => 15,
                'max_stock_level' => 120,
                'unit' => 'portions',
                'location' => 'Side Station',
                'is_active' => true,
            ],

            // Desserts
            [
                'name' => 'Chocolate Cake Slice',
                'sku' => 'DES001',
                'barcode' => '2234567890010',
                'description' => 'Rich chocolate layer cake with frosting',
                'category_id' => $desserts->id,
                'supplier_id' => $dairySupplier->id,
                'cost_price' => 3.25,
                'selling_price' => 6.99,
                'quantity' => 24,
                'min_stock_level' => 6,
                'max_stock_level' => 48,
                'unit' => 'slices',
                'location' => 'Dessert Station',
                'is_active' => true,
            ],
            [
                'name' => 'Fresh Fruit Tart',
                'sku' => 'DES002',
                'barcode' => '2234567890011',
                'description' => 'Pastry tart with seasonal fresh fruits',
                'category_id' => $desserts->id,
                'supplier_id' => $foodSupplier->id,
                'cost_price' => 4.50,
                'selling_price' => 8.99,
                'quantity' => 18,
                'min_stock_level' => 4,
                'max_stock_level' => 36,
                'unit' => 'pieces',
                'location' => 'Dessert Station',
                'is_active' => true,
            ],

            // Beverages
            [
                'name' => 'Fresh Orange Juice',
                'sku' => 'BEV001',
                'barcode' => '2234567890012',
                'description' => 'Freshly squeezed orange juice',
                'category_id' => $beverages->id,
                'supplier_id' => $beverageSupplier->id,
                'cost_price' => 1.50,
                'selling_price' => 3.99,
                'quantity' => 80,
                'min_stock_level' => 20,
                'max_stock_level' => 200,
                'unit' => 'glasses',
                'location' => 'Beverage Station',
                'is_active' => true,
            ],
            [
                'name' => 'Premium Coffee',
                'sku' => 'BEV002',
                'barcode' => '2234567890013',
                'description' => 'Freshly brewed premium coffee blend',
                'category_id' => $beverages->id,
                'supplier_id' => $beverageSupplier->id,
                'cost_price' => 0.75,
                'selling_price' => 2.99,
                'quantity' => 120,
                'min_stock_level' => 30,
                'max_stock_level' => 300,
                'unit' => 'cups',
                'location' => 'Beverage Station',
                'is_active' => true,
            ],
            [
                'name' => 'Iced Tea',
                'sku' => 'BEV003',
                'barcode' => '2234567890014',
                'description' => 'Refreshing iced tea with lemon',
                'category_id' => $beverages->id,
                'supplier_id' => $beverageSupplier->id,
                'cost_price' => 0.50,
                'selling_price' => 2.49,
                'quantity' => 5,
                'min_stock_level' => 25,
                'max_stock_level' => 250,
                'unit' => 'glasses',
                'location' => 'Beverage Station',
                'is_active' => true,
            ],
        ];

        $adminUser = User::where('email', 'admin@example.com')->first();

        foreach ($products as $productData) {
            $sku = $productData['sku'];
            $quantity = $productData['quantity'];
            unset($productData['quantity']); // Remove quantity for firstOrCreate

            $product = Product::firstOrCreate(
                ['sku' => $sku],
                $productData
            );

            // Update quantity if product was just created
            if ($product->wasRecentlyCreated && $quantity > 0) {
                $product->update(['quantity' => $quantity]);

                // Create initial stock transaction
                StockTransaction::create([
                    'product_id' => $product->id,
                    'user_id' => $adminUser->id,
                    'type' => 'in',
                    'quantity' => $quantity,
                    'quantity_before' => 0,
                    'quantity_after' => $quantity,
                    'unit_cost' => $product->cost_price,
                    'total_cost' => $product->cost_price * $quantity,
                    'reason' => 'Initial stock - Daily prep',
                    'transaction_date' => now()->subDays(rand(1, 3)),
                ]);
            }
        }

        // Create some sample transactions
        $this->createBuffetTransactions($adminUser);
    }

    private function createBuffetTransactions(User $user): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            // Simulate buffet consumption throughout the day
            if ($product->quantity > 10) {
                $outQty = rand(3, 8); // Customers taking portions
                $newQty = max(0, $product->quantity - $outQty);

                StockTransaction::create([
                    'product_id' => $product->id,
                    'user_id' => $user->id,
                    'type' => 'out',
                    'quantity' => $outQty,
                    'quantity_before' => $product->quantity,
                    'quantity_after' => $newQty,
                    'unit_cost' => $product->cost_price,
                    'total_cost' => $product->cost_price * $outQty,
                    'reason' => 'Buffet service - customer consumption',
                    'transaction_date' => now()->subHours(rand(2, 10)),
                ]);

                $product->update(['quantity' => $newQty]);
            }
        }
    }
}
