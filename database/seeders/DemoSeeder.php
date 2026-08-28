<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Restorant
         * Categories
         * Menu Items
         * Drivers
         * Clients
         * Orders
         * Cities / since 1_5
         * Item versions / since 1_5
         * Reviews / since 1_5.
         * Expenses / since 2_5
         * Blog / since 3.1.5
         */

        //Cities
        $this->call(CitiesTableSeeder::class);

        //Restorants
        $this->call(RestorantsTableSeeder::class);

        //Expenses
        $this->call(ExpensesTableSeeder::class);

        if (config('app.isqrsaas')) {
            //QRSAAS
            $this->call(PlansSeeder::class);
      

            //Orders
            $demoOrders = \App\Order::factory()->count(500)->create();

            //Set initial status for all demo orders
            foreach ($demoOrders as $order) {
                DB::table('order_has_status')->insert([
                    'order_id' => $order->id,
                    'status_id' => 1,
                    'user_id' => 1,
                    'comment' => 'Demo Order',
                    'created_at' => now(),
                    'updated_at' => null,
                ]);
            }

            $demoOrdersLast3Days = \App\Order::factory()->count(100)->recent()->create();

            //Set initial status for all recent demo orders
            foreach ($demoOrdersLast3Days as $order) {
                //SET CCOMMENT TO 
                $order->comment = 'Demo Order, data and calculations are random and not real';
                $order->save();
                DB::table('order_has_status')->insert([
                    'order_id' => $order->id,
                    'status_id' => 1,
                    'user_id' => 1,
                    'comment' => 'Demo Order',
                    'created_at' => now(),
                    'updated_at' => null,
                ]);

                // Random path generator for each order
                $path = rand(1, 100);

                // Path 1: Rejected by admin (15% chance)
                if ($path <= 15) {
                    DB::table('order_has_status')->insert([
                        'order_id' => $order->id,
                        'status_id' => 8,
                        'user_id' => 1,
                        'comment' => 'Rejected by admin',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                // Path 2: Accepted by admin -> Rejected by restaurant (10% chance)
                else if ($path <= 25) {
                    DB::table('order_has_status')->insert([
                        'order_id' => $order->id,
                        'status_id' => 2,
                        'user_id' => 1,
                        'comment' => 'Accepted by admin',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    DB::table('order_has_status')->insert([
                        'order_id' => $order->id,
                        'status_id' => 9,
                        'user_id' => 1,
                        'comment' => 'Rejected by restaurant',
                        'created_at' => now()->addMinutes(rand(5, 15)),
                        'updated_at' => now()->addMinutes(rand(5, 15)),
                    ]);
                }
                // Path 3: Full successful delivery path (40% chance)
                else if ($path <= 65) {
                    $timeOffset = 0;
                    
                    // Accepted by admin
                    DB::table('order_has_status')->insert([
                        'order_id' => $order->id,
                        'status_id' => 2,
                        'user_id' => 1,
                        'comment' => 'Accepted by admin',
                        'created_at' => now()->addMinutes($timeOffset),
                        'updated_at' => now()->addMinutes($timeOffset),
                    ]);
                    $timeOffset += rand(5, 15);

                    // Accepted by restaurant
                    DB::table('order_has_status')->insert([
                        'order_id' => $order->id,
                        'status_id' => 3,
                        'user_id' => 1,
                        'comment' => 'Accepted by restaurant',
                        'created_at' => now()->addMinutes($timeOffset),
                        'updated_at' => now()->addMinutes($timeOffset),
                    ]);
                    $timeOffset += rand(5, 15);

                    // Assigned to driver
                    DB::table('order_has_status')->insert([
                        'order_id' => $order->id,
                        'status_id' => 4,
                        'user_id' => 1,
                        'comment' => 'Assigned to driver',
                        'created_at' => now()->addMinutes($timeOffset),
                        'updated_at' => now()->addMinutes($timeOffset),
                    ]);
                    $timeOffset += rand(5, 15);

                    // Random driver acceptance/rejection
                    if (rand(1, 100) <= 90) {
                        DB::table('order_has_status')->insert([
                            'order_id' => $order->id,
                            'status_id' => 13,
                            'user_id' => 1,
                            'comment' => 'Accepted by driver',
                            'created_at' => now()->addMinutes($timeOffset),
                            'updated_at' => now()->addMinutes($timeOffset),
                        ]);
                        $timeOffset += rand(5, 15);

                        // Prepared
                        DB::table('order_has_status')->insert([
                            'order_id' => $order->id,
                            'status_id' => 5,
                            'user_id' => 1,
                            'comment' => 'Prepared by restaurant',
                            'created_at' => now()->addMinutes($timeOffset),
                            'updated_at' => now()->addMinutes($timeOffset),
                        ]);
                        $timeOffset += rand(5, 15);

                        // Picked up
                        DB::table('order_has_status')->insert([
                            'order_id' => $order->id,
                            'status_id' => 6,
                            'user_id' => 1,
                            'comment' => 'Picked up by driver',
                            'created_at' => now()->addMinutes($timeOffset),
                            'updated_at' => now()->addMinutes($timeOffset),
                        ]);
                        $timeOffset += rand(10, 30);

                        // Delivered
                        DB::table('order_has_status')->insert([
                            'order_id' => $order->id,
                            'status_id' => 7,
                            'user_id' => 1,
                            'comment' => 'Delivered',
                            'created_at' => now()->addMinutes($timeOffset),
                            'updated_at' => now()->addMinutes($timeOffset),
                        ]);
                        $timeOffset += rand(5, 15);

                        // Closed (80% chance after delivery)
                        if (rand(1, 100) <= 80) {
                            DB::table('order_has_status')->insert([
                                'order_id' => $order->id,
                                'status_id' => 11,
                                'user_id' => 1,
                                'comment' => 'Order closed',
                                'created_at' => now()->addMinutes($timeOffset),
                                'updated_at' => now()->addMinutes($timeOffset),
                            ]);
                        }
                    } else {
                        // Driver rejected
                        DB::table('order_has_status')->insert([
                            'order_id' => $order->id,
                            'status_id' => 12,
                            'user_id' => 1,
                            'comment' => 'Rejected by driver',
                            'created_at' => now()->addMinutes($timeOffset),
                            'updated_at' => now()->addMinutes($timeOffset),
                        ]);
                    }
                }
                // Path 4: In progress (35% chance)
                else {
                    $timeOffset = 0;
                    $progressPoint = rand(1, 5);
                    
                    // Accepted by admin
                    if ($progressPoint >= 1) {
                        DB::table('order_has_status')->insert([
                            'order_id' => $order->id,
                            'status_id' => 2,
                            'user_id' => 1,
                            'comment' => 'Accepted by admin',
                            'created_at' => now()->addMinutes($timeOffset),
                            'updated_at' => now()->addMinutes($timeOffset),
                        ]);
                        $timeOffset += rand(5, 15);
                    }

                    // Accepted by restaurant
                    if ($progressPoint >= 2) {
                        DB::table('order_has_status')->insert([
                            'order_id' => $order->id,
                            'status_id' => 3,
                            'user_id' => 1,
                            'comment' => 'Accepted by restaurant',
                            'created_at' => now()->addMinutes($timeOffset),
                            'updated_at' => now()->addMinutes($timeOffset),
                        ]);
                        $timeOffset += rand(5, 15);
                    }

                    // Assigned to driver
                    if ($progressPoint >= 3) {
                        DB::table('order_has_status')->insert([
                            'order_id' => $order->id,
                            'status_id' => 4,
                            'user_id' => 1,
                            'comment' => 'Assigned to driver',
                            'created_at' => now()->addMinutes($timeOffset),
                            'updated_at' => now()->addMinutes($timeOffset),
                        ]);
                        $timeOffset += rand(5, 15);
                    }

                    // Prepared
                    if ($progressPoint >= 4) {
                        DB::table('order_has_status')->insert([
                            'order_id' => $order->id,
                            'status_id' => 5,
                            'user_id' => 1,
                            'comment' => 'Prepared by restaurant',
                            'created_at' => now()->addMinutes($timeOffset),
                            'updated_at' => now()->addMinutes($timeOffset),
                        ]);
                    }
                }

                // Random updates (10% chance)
                if (rand(1, 100) <= 10) {
                    DB::table('order_has_status')->insert([
                        'order_id' => $order->id,
                        'status_id' => 10,
                        'user_id' => 1,
                        'comment' => 'Order updated',
                        'created_at' => now()->addMinutes(rand(1, 60)),
                        'updated_at' => now()->addMinutes(rand(1, 60)),
                    ]);
                }
            }

        

            foreach ($demoOrdersLast3Days as $order) {
                DB::table('order_has_items')->insert([
                    'order_id' => $order->id,
                    'item_id' => rand(1, 10),
                    'qty' => rand(1, 5),
                    'extras' => null,
                    'vat' => rand(5, 20) / 100,
                    'vatvalue' => rand(1, 10),
                    'variant_price' => rand(10, 100),
                    'variant_name' => 'Default variant',
                    'kds_finished' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                //->whereNotNull('payment_method')->where('payment_status', 'paid');
                $order->payment_method = 'cash';
                $order->payment_status = 'paid';
                $order->save();
            }
            

            //Whatsapp and POS
            if (config('settings.is_whatsapp_ordering_mode')
                || config('settings.is_pos_cloud_mode')
                || config('settings.is_agris_mode')
                || config('app.issd')) {
                $this->call(LandingPageSeeder::class);
            }

            //Agris
            if (config('settings.is_agris_mode')) {
                $this->call(AgrisSeeder::class);
            }
        } elseif (config('app.isdrive')) {
            //FT Social Dirve
            $this->call(PlansSeeder::class);

            $demoClientId = DB::table('users')->insertGetId([
                'name' => 'Demo Client 1',
                'email' => 'client@example.com',
                'password' => Hash::make('secret'),
                'api_token' => Str::random(80),
                'email_verified_at' => now(),
                'phone' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            //Assign client role
            DB::table('model_has_roles')->insert([
                'role_id' => 4,
                'model_type' => \App\User::class,
                'model_id' => $demoClientId,
            ]);
        } else {
            //Pure FT
            $this->call(PlansSeeder::class);

            //Driver
            $demoDriverId = DB::table('users')->insertGetId([
                'name' => 'Demo Driver',
                'email' => 'driver@example.com',
                'password' => Hash::make('secret'),
                'api_token' => Str::random(80),
                'email_verified_at' => now(),
                'phone' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            //Assign driver role
            DB::table('model_has_roles')->insert([
                'role_id' => 3,
                'model_type' => \App\User::class,
                'model_id' => $demoDriverId,
            ]);

            //Client 1
            $demoClientId = DB::table('users')->insertGetId([
                'name' => 'Demo Client 1',
                'email' => 'client@example.com',
                'password' => Hash::make('secret'),
                'api_token' => Str::random(80),
                'email_verified_at' => now(),
                'phone' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            //Assign client role
            DB::table('model_has_roles')->insert([
                'role_id' => 4,
                'model_type' => \App\User::class,
                'model_id' => $demoClientId,
            ]);

            //Client 2
            $demoClientId2 = DB::table('users')->insertGetId([
                'name' => 'Demo Client 2',
                'email' => 'client2@example.com',
                'password' => Hash::make('secret'),
                'api_token' => Str::random(80),
                'email_verified_at' => now(),
                'phone' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            //Assign client role
            DB::table('model_has_roles')->insert([
                'role_id' => 4,
                'model_type' => \App\User::class,
                'model_id' => $demoClientId2,
            ]);

            //Driver 2
            $demoDriverId2 = DB::table('users')->insertGetId([
                'name' => 'Demo Driver 2',
                'email' => 'driver2@example.com',
                'password' => Hash::make('secret'),
                'api_token' => Str::random(80),
                'email_verified_at' => now(),
                'phone' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            //Assign driver role
            DB::table('model_has_roles')->insert([
                'role_id' => 3,
                'model_type' => \App\User::class,
                'model_id' => $demoDriverId2,
            ]);

            //Addresses
            $clientAddress = \App\Address::factory()->count(10)->create();

            //Orders
            $demoOrders = \App\Order::factory()->count(500)->create();

            //Set initial status for all demo orders
            foreach ($demoOrders as $order) {
                DB::table('order_has_status')->insert([
                    'order_id' => $order->id,
                    'status_id' => 1,
                    'user_id' => 1,
                    'comment' => 'Demo Order',
                    'created_at' => now(),
                    'updated_at' => null,
                ]);
            }

            $demoOrdersLast3Days = \App\Order::factory()->count(100)->recent()->create();

            //Set initial status for all recent demo orders
            foreach ($demoOrdersLast3Days as $order) {
                DB::table('order_has_status')->insert([
                    'order_id' => $order->id,
                    'status_id' => 1,
                    'user_id' => 1,
                    'comment' => 'Demo Order',
                    'created_at' => now(),
                    'updated_at' => null,
                ]);

                // Random path generator for each order
                $path = rand(1, 100);

                // Path 1: Rejected by admin (15% chance)
                if ($path <= 15) {
                    DB::table('order_has_status')->insert([
                        'order_id' => $order->id,
                        'status_id' => 8,
                        'user_id' => 1,
                        'comment' => 'Rejected by admin',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                // Path 2: Accepted by admin -> Rejected by restaurant (10% chance)
                else if ($path <= 25) {
                    DB::table('order_has_status')->insert([
                        'order_id' => $order->id,
                        'status_id' => 2,
                        'user_id' => 1,
                        'comment' => 'Accepted by admin',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    DB::table('order_has_status')->insert([
                        'order_id' => $order->id,
                        'status_id' => 9,
                        'user_id' => 1,
                        'comment' => 'Rejected by restaurant',
                        'created_at' => now()->addMinutes(rand(5, 15)),
                        'updated_at' => now()->addMinutes(rand(5, 15)),
                    ]);
                }
                // Path 3: Full successful delivery path (40% chance)
                else if ($path <= 65) {
                    $timeOffset = 0;
                    
                    // Accepted by admin
                    DB::table('order_has_status')->insert([
                        'order_id' => $order->id,
                        'status_id' => 2,
                        'user_id' => 1,
                        'comment' => 'Accepted by admin',
                        'created_at' => now()->addMinutes($timeOffset),
                        'updated_at' => now()->addMinutes($timeOffset),
                    ]);
                    $timeOffset += rand(5, 15);

                    // Accepted by restaurant
                    DB::table('order_has_status')->insert([
                        'order_id' => $order->id,
                        'status_id' => 3,
                        'user_id' => 1,
                        'comment' => 'Accepted by restaurant',
                        'created_at' => now()->addMinutes($timeOffset),
                        'updated_at' => now()->addMinutes($timeOffset),
                    ]);
                    $timeOffset += rand(5, 15);

                    // Assigned to driver
                    DB::table('order_has_status')->insert([
                        'order_id' => $order->id,
                        'status_id' => 4,
                        'user_id' => 1,
                        'comment' => 'Assigned to driver',
                        'created_at' => now()->addMinutes($timeOffset),
                        'updated_at' => now()->addMinutes($timeOffset),
                    ]);
                    $timeOffset += rand(5, 15);

                    // Random driver acceptance/rejection
                    if (rand(1, 100) <= 90) {
                        DB::table('order_has_status')->insert([
                            'order_id' => $order->id,
                            'status_id' => 13,
                            'user_id' => 1,
                            'comment' => 'Accepted by driver',
                            'created_at' => now()->addMinutes($timeOffset),
                            'updated_at' => now()->addMinutes($timeOffset),
                        ]);
                        $timeOffset += rand(5, 15);

                        // Prepared
                        DB::table('order_has_status')->insert([
                            'order_id' => $order->id,
                            'status_id' => 5,
                            'user_id' => 1,
                            'comment' => 'Prepared by restaurant',
                            'created_at' => now()->addMinutes($timeOffset),
                            'updated_at' => now()->addMinutes($timeOffset),
                        ]);
                        $timeOffset += rand(5, 15);

                        // Picked up
                        DB::table('order_has_status')->insert([
                            'order_id' => $order->id,
                            'status_id' => 6,
                            'user_id' => 1,
                            'comment' => 'Picked up by driver',
                            'created_at' => now()->addMinutes($timeOffset),
                            'updated_at' => now()->addMinutes($timeOffset),
                        ]);
                        $timeOffset += rand(10, 30);

                        // Delivered
                        DB::table('order_has_status')->insert([
                            'order_id' => $order->id,
                            'status_id' => 7,
                            'user_id' => 1,
                            'comment' => 'Delivered',
                            'created_at' => now()->addMinutes($timeOffset),
                            'updated_at' => now()->addMinutes($timeOffset),
                        ]);
                        $timeOffset += rand(5, 15);

                        // Closed (80% chance after delivery)
                        if (rand(1, 100) <= 80) {
                            DB::table('order_has_status')->insert([
                                'order_id' => $order->id,
                                'status_id' => 11,
                                'user_id' => 1,
                                'comment' => 'Order closed',
                                'created_at' => now()->addMinutes($timeOffset),
                                'updated_at' => now()->addMinutes($timeOffset),
                            ]);
                        }
                    } else {
                        // Driver rejected
                        DB::table('order_has_status')->insert([
                            'order_id' => $order->id,
                            'status_id' => 12,
                            'user_id' => 1,
                            'comment' => 'Rejected by driver',
                            'created_at' => now()->addMinutes($timeOffset),
                            'updated_at' => now()->addMinutes($timeOffset),
                        ]);
                    }
                }
                // Path 4: In progress (35% chance)
                else {
                    $timeOffset = 0;
                    $progressPoint = rand(1, 5);
                    
                    // Accepted by admin
                    if ($progressPoint >= 1) {
                        DB::table('order_has_status')->insert([
                            'order_id' => $order->id,
                            'status_id' => 2,
                            'user_id' => 1,
                            'comment' => 'Accepted by admin',
                            'created_at' => now()->addMinutes($timeOffset),
                            'updated_at' => now()->addMinutes($timeOffset),
                        ]);
                        $timeOffset += rand(5, 15);
                    }

                    // Accepted by restaurant
                    if ($progressPoint >= 2) {
                        DB::table('order_has_status')->insert([
                            'order_id' => $order->id,
                            'status_id' => 3,
                            'user_id' => 1,
                            'comment' => 'Accepted by restaurant',
                            'created_at' => now()->addMinutes($timeOffset),
                            'updated_at' => now()->addMinutes($timeOffset),
                        ]);
                        $timeOffset += rand(5, 15);
                    }

                    // Assigned to driver
                    if ($progressPoint >= 3) {
                        DB::table('order_has_status')->insert([
                            'order_id' => $order->id,
                            'status_id' => 4,
                            'user_id' => 1,
                            'comment' => 'Assigned to driver',
                            'created_at' => now()->addMinutes($timeOffset),
                            'updated_at' => now()->addMinutes($timeOffset),
                        ]);
                        $timeOffset += rand(5, 15);
                    }

                    // Prepared
                    if ($progressPoint >= 4) {
                        DB::table('order_has_status')->insert([
                            'order_id' => $order->id,
                            'status_id' => 5,
                            'user_id' => 1,
                            'comment' => 'Prepared by restaurant',
                            'created_at' => now()->addMinutes($timeOffset),
                            'updated_at' => now()->addMinutes($timeOffset),
                        ]);
                    }
                }

                // Random updates (10% chance)
                if (rand(1, 100) <= 10) {
                    DB::table('order_has_status')->insert([
                        'order_id' => $order->id,
                        'status_id' => 10,
                        'user_id' => 1,
                        'comment' => 'Order updated',
                        'created_at' => now()->addMinutes(rand(1, 60)),
                        'updated_at' => now()->addMinutes(rand(1, 60)),
                    ]);
                }
            }
        }
    }
}
