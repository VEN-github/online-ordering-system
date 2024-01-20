<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category\Category;
use App\Models\Faq\Faq;
use App\Models\Item\Item;
use App\Models\Order\Order;
use App\Models\Product\Product;
use App\Models\Supplier\Supplier;
use App\Models\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseTestSeeder extends Seeder
{
    /** Run the database seeds. */
    public function run(): void
    {
        $this->command->info('Running Supplier Seeder...');
        Supplier::factory()->count(10)->create();
        $this->command->info('Supplier Seeded Successfully.' . "\n");

        $this->command->info('Running Category Seeder...');

        $categories = [
            [
                'name' => 'Sofas',
                'slug' => Str::slug('Sofas'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dining Tables',
                'slug' => Str::slug('Dining Tables'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Beds',
                'slug' => Str::slug('Beds'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Wardrobes',
                'slug' => Str::slug('Wardrobes'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Desks',
                'slug' => Str::slug('Desks'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bookshelves',
                'slug' => Str::slug('Bookshelves'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Coffee Tables',
                'slug' => Str::slug('Coffee Tables'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chairs',
                'slug' => Str::slug('Chairs'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Outdoor Furniture',
                'slug' => Str::slug('Outdoor Furniture'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lighting',
                'slug' => Str::slug('Lighting'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('categories')->insert($categories);

        $categories = Category::get();

        $categoryImages = [
            '/images/categories/sofa.jpeg',
            '/images/categories/table.jpeg',
            '/images/categories/bed.png',
            '/images/categories/wardrobe.jpeg',
            '/images/categories/desk.jpeg',
            '/images/categories/bookshelve.png',
            '/images/categories/coffee-table.jpeg',
            '/images/categories/chair.jpg',
            '/images/categories/outdoor.jpeg',
            '/images/categories/lighting.jpeg',
        ];

        foreach ($categories as $key => $category) {
            $category->addMediaFromUrl(asset($categoryImages[$key]))
                ->toMediaCollection('image');
        }

        $this->command->info('Category Seeded Successfully.' . "\n");

        $this->command->info('Running Faq Seeder...');

        $faqs = [
            [
                'question' => 'What types of furniture do you offer?',
                'answer' => 'We offer a wide range of furniture, including sofas, beds, dining tables, chairs, wardrobes, desks, and more.',
                'active' => true,
                'slug' => Str::slug('What types of furniture do you offer?'),
            ],
            [
                'question' => 'Do you provide customization options for furniture?',
                'answer' => 'Yes, we offer customization options for many of our furniture pieces. You can choose from different fabrics, colors, and materials to suit your preferences.',
                'active' => true,
                'slug' => Str::slug('Do you provide customization options for furniture?'),
            ],
            [
                'question' => 'How do I place an order?',
                'answer' => 'You can place an order on our website by selecting the desired items, adding them to your cart, and completing the checkout process. Alternatively, you can visit our showroom or contact our customer service for assistance.',
                'active' => true,
                'slug' => Str::slug('How do I place an order?'),
            ],
            [
                'question' => 'What payment methods do you accept?',
                'answer' => 'We accept various payment methods, including credit/debit cards, bank transfers, and online payment gateways. Please refer to our payment options during the checkout process for more details.',
                'active' => true,
                'slug' => Str::slug('What payment methods do you accept?'),
            ],
            [
                'question' => 'What is your return policy?',
                'answer' => 'Our return policy allows you to return unused and undamaged items within 30 days of delivery. Please review our detailed return policy on our website for specific instructions and conditions.',
                'active' => true,
                'slug' => Str::slug('What is your return policy?'),
            ],
            [
                'question' => 'Can I track the status of my order?',
                'answer' => 'Yes, you can track the status of your order by logging into your account on our website. You will receive email notifications at different stages of the order processing and shipping.',
                'active' => true,
                'slug' => Str::slug('Can I track the status of my order?'),
            ],
            [
                'question' => 'Do you offer international shipping?',
                'answer' => 'Yes, we offer international shipping to select countries. Shipping costs and delivery times may vary based on your location. Please check our shipping information for more details.',
                'active' => true,
                'slug' => Str::slug('Do you offer international shipping?'),
            ],
            [
                'question' => 'Are your products eco-friendly?',
                'answer' => 'We prioritize sustainability and offer a range of eco-friendly furniture options. Look for products labeled as sustainable, made from recycled materials, or certified by environmental standards.',
                'active' => true,
                'slug' => Str::slug('Are your products eco-friendly?'),
            ],
            [
                'question' => 'What assembly is required for your furniture?',
                'answer' => 'Most of our furniture comes with easy-to-follow assembly instructions. Some items may require minimal assembly, while others may be fully assembled. Check the product details for assembly information.',
                'active' => true,
                'slug' => Str::slug('What assembly is required for your furniture?'),
            ],
            [
                'question' => 'How can I contact your customer support?',
                'answer' => 'You can contact our customer support team through our website\'s contact form, via email at support@example.com, or by calling our helpline at (123) 456-7890 during business hours.',
                'active' => true,
                'slug' => Str::slug('How can I contact your customer support?'),
            ],
        ];

        DB::table('frequently_asked_questions')->insert($faqs);

        $this->command->info('Faq Seeded Successfully.');

        $this->command->info('Running Product Seeder...');

        $products = [
            [
                'name' => 'Elegant Sofa',
                'description' => 'Create a cozy and inviting living space with our elegant sofas. Discover a variety of styles and fabrics to suit your taste.',
                'category' => 'Sofas',
                'orig_price' => 2500,
                'selling_price' => 2500,
                'discounted_price' => 1500,
                'standard_shipping_price' => 150,
                'express_shipping_price' => 180,
            ],
            [
                'name' => 'Modern Dining Table',
                'description' => 'Gather your family and friends around a modern dining table. Our collection features high-quality tables that enhance your dining experience.',
                'category' => 'Dining Tables',
                'orig_price' => 5500,
                'selling_price' => 5500,
                'discounted_price' => 4000,
                'standard_shipping_price' => 250,
                'express_shipping_price' => 280,
            ],
            [
                'name' => 'Comfort Bed',
                'description' => 'Experience a restful sleep with our comfortable beds. Explore a range of designs, from classic to contemporary, for your bedroom.',
                'category' => 'Beds',
                'orig_price' => 2500,
                'selling_price' => 2500,
                'discounted_price' => 2000,
                'standard_shipping_price' => 250,
                'express_shipping_price' => 280,
            ],
            [
                'name' => 'Spacious Wardrobe',
                'description' => 'Organize your clothes with our spacious wardrobes. Discover smart storage solutions that combine functionality and style.',
                'category' => 'Wardrobes',
                'orig_price' => 2800,
                'selling_price' => 2800,
                'discounted_price' => 1800,
                'standard_shipping_price' => 150,
                'express_shipping_price' => 180,
            ],
            [
                'name' => 'Stylish Desk',
                'description' => 'Enhance your workspace with our stylish desks. Whether for work or study, our desks provide a productive and aesthetically pleasing environment.',
                'category' => 'Desks',
                'orig_price' => 800,
                'selling_price' => 800,
                'discounted_price' => 500,
                'standard_shipping_price' => 150,
                'express_shipping_price' => 180,
            ],
            [
                'name' => 'Book Lover\'s Bookshelf',
                'description' => 'Showcase your book collection with our bookshelves. Find the perfect balance of form and function for your home library.',
                'category' => 'Bookshelves',
                'orig_price' => 2800,
                'selling_price' => 2800,
                'discounted_price' => 2500,
                'standard_shipping_price' => 250,
                'express_shipping_price' => 280,
            ],
            [
                'name' => 'Coffee Bliss Table',
                'description' => 'Complete your living room with a coffee bliss table. Our selection includes functional and stylish tables that complement any decor.',
                'category' => 'Coffee Tables',
                'orig_price' => 2900,
                'selling_price' => 2900,
                'discounted_price' => 2600,
                'standard_shipping_price' => 250,
                'express_shipping_price' => 280,
            ],
            [
                'name' => 'Cozy Chair',
                'description' => 'Sit back and relax in our cozy chairs. From accent chairs to recliners, we offer a range of seating options for every room.',
                'category' => 'Chairs',
                'orig_price' => 900,
                'selling_price' => 900,
                'discounted_price' => 700,
                'standard_shipping_price' => 150,
                'express_shipping_price' => 180,
            ],
            [
                'name' => 'Outdoor Oasis Set',
                'description' => 'Transform your outdoor space with our outdoor oasis set. Enjoy the fresh air with durable and stylish furniture designed for outdoor living.',
                'category' => 'Outdoor Furniture',
                'orig_price' => 7900,
                'selling_price' => 7900,
                'discounted_price' => 7700,
                'standard_shipping_price' => 550,
                'express_shipping_price' => 580,
            ],
            [
                'name' => 'Contemporary Lighting Fixture',
                'description' => 'Illuminate your space with contemporary lighting fixtures. Discover a variety of designs that add warmth and ambiance to any room.',
                'category' => 'Lighting',
                'orig_price' => 8900,
                'selling_price' => 8900,
                'discounted_price' => 8500,
                'standard_shipping_price' => 1350,
                'express_shipping_price' => 1580,
            ],
        ];

        foreach ($products as &$product) {
            $category = Category::select('id')
                ->whereName($product['category'])
                ->first();

            $product['slug'] = Str::slug($product['name']);
            $product['sku'] = strtoupper(Str::random(8));
            $product['is_featured'] = rand(0, 1);
            $product['is_active'] = 1;
            $product['category_id'] = $category->id;
            $product['stocks'] = rand(10, 100);
            $product['created_at'] = now();
            $product['updated_at'] = now();

            unset($product['category']);
        }

        DB::table('products')->insert($products);

        $products = Product::get();

        $productImages = [
            '/images/products/elegant-sofa.jpg',
            '/images/products/modern-dining-table.jpg',
            '/images/products/comfort-bed.png',
            '/images/products/spacious-wardrobe.png',
            '/images/products/stylish-desk.png',
            '/images/products/bookshelf.png',
            '/images/products/coffee-table.png',
            '/images/products/cozy-chair.png',
            '/images/products/outdoor.png',
            '/images/products/light.png',
        ];

        foreach ($products as $key => $product) {
            $product->addMediaFromUrl(asset($productImages[$key]))
                ->toMediaCollection('highlight_image');
        }

        $this->command->info('Product Seeded Successfully.');

        $this->command->info('Running User Seeder...');

        User::factory()->count(10)->create();

        $users = User::with('cart')->get();

        foreach ($users as $user) {
            $user->cart
                ->items()
                ->create(
                    [
                        'item_id' => Product::get()->first()->id,
                        'variation_id' => null,
                        'quantity' => fake()->numberBetween(1, 10),
                        'total' => fake()->numberBetween(600, 1000),
                    ]
                );
        }

        $this->command->info('User Seeded Successfully.');

        // $this->command->info('Running Order Seeder...');
        // Order::factory()->count(10)->create();
        // $this->command->info('Order Seeded Successfully.');

        // $this->command->info('Running Item Seeder...');
        // Item::factory()->count(5)->create();
        // $this->command->info('Item Seeded Successfully.');
    }
}
