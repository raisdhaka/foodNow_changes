<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RporSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(config('settings.app_code_name')!='rpro'){
            return;
        }

        Model::unguard();

        $features = [
            [
                'type' => 'feature',
                'title' => '{"en":"Stunning Menu Design"}',
                'subtitle' => '{"en":"Captivate your customers with beautiful, easy-to-navigate menus"}',
                'description' => '{"en":"Customizable templates that showcase your brand,One-click ordering experience,Real-time menu updates,Smart upselling features that boost average order value"}',
                'image' => 'https://mobidonia-demo.imgix.net/img/rpro/restaurant_menu_design.jpg'
            ],
            [
                'type' => 'feature',
                'title' => '{"en":"WhatsApp Integration"}',
                'subtitle' => '{"en":"Keep customers informed through their favorite messaging app"}',
                'description' => '{"en":"Instant order confirmations via WhatsApp,Real-time status updates,Personalized customer communication,Automated notifications that reduce support calls"}',
                'image' => 'https://mobidonia-demo.imgix.net/img/rpro/whatsapp_ordering.jpg'
            ],
            [
                'type' => 'feature',
                'title' => '{"en":"Revolutionary POS System"}',
                'subtitle' => '{"en":"The most intuitive and powerful point-of-sale in the industry"}',
                'description' => '{"en":"Lightning-fast order processing,Customizable interface for any restaurant type,Seamless table management,Offline functionality that never stops working"}',
                'image' => 'https://mobidonia-demo.imgix.net/img/rpro/restaurant_pos_system.jpg'
            ],
            [
                'type' => 'feature',
                'title' => '{"en":"AI Phone Ordering"}',
                'subtitle' => '{"en":"Never miss an order with our intelligent virtual assistant"}',
                'description' => '{"en":"24/7 automated phone ordering,Natural language processing that understands accents,Instant integration with your kitchen system,Increased revenue without additional staff"}',
                'image' => 'https://mobidonia-demo.imgix.net/img/rpro/ai_phone_ordering.jpg'
            ],
            [
                'type' => 'feature',
                'title' => '{"en":"Smart Reservation System"}',
                'subtitle' => '{"en":"Maximize your tables with our intelligent booking platform"}',
                'description' => '{"en":"AI-powered phone reservations,Custom floor plan management,Automated reminder system,Waitlist management that optimizes seating efficiency"}',
                'image' => 'https://mobidonia-demo.imgix.net/img/rpro/restaurant_reservations.jpg'
            ],
            [
                'type' => 'feature',
                'title' => '{"en":"Loyalty & Rewards"}',
                'subtitle' => '{"en":"Turn first-time visitors into lifelong customers"}',
                'description' => '{"en":"Customizable points system,Digital punch cards,Birthday rewards,VIP tiers that drive repeat business"}',
                'image' => 'https://mobidonia-demo.imgix.net/img/rpro/restaurant_loyalty.jpg'
            ],
            [
                'type' => 'feature',
                'title' => '{"en":"Powerful Analytics"}',
                'subtitle' => '{"en":"Data-driven insights to grow your restaurant business"}',
                'description' => '{"en":"Real-time sales dashboards,Menu performance metrics,Customer behavior analysis,Predictive forecasting for inventory management"}',
                'image' => 'https://mobidonia-demo.imgix.net/img/rpro/restaurant_analytics.jpg'
            ],
            [
                'type' => 'feature',
                'title' => '{"en":"Mobile Apps Ecosystem"}',
                'subtitle' => '{"en":"Connect everyone in your restaurant operation"}',
                'description' => '{"en":"Customer ordering apps for iOS & Android,Driver delivery tracking,Vendor management portal,Real-time synchronization across all platforms"}',
                'image' => 'https://mobidonia-demo.imgix.net/img/rpro/restaurant_mobile_apps.jpg'
            ]
        ];

        foreach ($features as $key => $feature) {
            DB::table('posts')->insert([
                'post_type' => $feature['type'],
                'title' => $feature['title'],
                'subtitle' => $feature['subtitle'],
                'description' => $feature['description'],
                'image' => $feature['image'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        $testimonials = [
            [
                'type' => 'testimonial',
                'title' => '{"en":"Michael Johnson"}',
                'subtitle' => '{"en":"Owner, Bistro Elegance"}',
                'description' => '{"en":"This platform has completely transformed our restaurant operations! The POS system is intuitive, online ordering integration boosted our sales by 30%, and the kitchen display system eliminated order confusion. Best investment we\'ve made!"}',
                'image' => 'https://mobidonia-demo.imgix.net/img/testimonials/maletestimonials/1.png?w=100&h=100',
                'review' => "male"
            ],
            [
                'type' => 'testimonial',
                'title' => '{"en":"Sarah Williams"}',
                'subtitle' => '{"en":"Chef-Owner, Coastal Cuisine"}',
                'description' => '{"en":"As a chef-owner juggling kitchen and business duties, this system has been a game-changer! The mobile app keeps me connected even when I\'m sourcing ingredients, and the reservation system has eliminated double-bookings. Absolutely worth every penny!"}',
                'image' => 'https://mobidonia-demo.imgix.net/img/testimonials/femaletestimonials/1.png?w=100&h=100',
                'review' => "female"
            ],
            [
                'type' => 'testimonial',
                'title' => '{"en":"Robert Chen"}',
                'subtitle' => '{"en":"CEO, Metropolitan Restaurant Group"}',
                'description' => '{"en":"We\'ve implemented this platform across our 12 restaurants, and the results are outstanding! The centralized management, detailed analytics, and seamless integration between all modules have streamlined our operations and increased profitability by 25%."}',
                'image' => 'https://mobidonia-demo.imgix.net/img/testimonials/maletestimonials/2.png?w=100&h=100',
                'review' => "male"
            ],
            [
                'type' => 'testimonial',
                'title' => '{"en":"Jennifer Garner"}',
                'subtitle' => '{"en":"Manager, Sunset Dining"}',
                'description' => '{"en":"The all-in-one solution we\'ve been searching for! Our staff adapted quickly to the intuitive interface, customers love the online ordering, and the kitchen display system has reduced our ticket times by 40%. Our restaurant runs like clockwork now!"}',
                'image' => 'https://mobidonia-demo.imgix.net/img/testimonials/femaletestimonials/2.png?w=100&h=100',
                'review' => "female"
            ],
            [
                'type' => 'testimonial',
                'title' => '{"en":"David Martinez"}',
                'subtitle' => '{"en":"Owner, Fusion Flavors"}',
                'description' => '{"en":"This complete restaurant platform has revolutionized how we operate! From tableside ordering to inventory management, everything is seamlessly integrated. Our staff is happier, customers are impressed, and our bottom line has never looked better!"}',
                'image' => 'https://mobidonia-demo.imgix.net/img/testimonials/maletestimonials/3.png?w=100&h=100',
                'review' => "male"
            ],
            [
                'type' => 'testimonial',
                'title' => '{"en":"Emily Chang"}',
                'subtitle' => '{"en":"Owner, Urban Eats"}',
                'description' => '{"en":"The reservation system alone paid for itself in the first month! Add in the POS, mobile app, and kitchen display, and we\'ve created a dining experience that keeps customers coming back. This platform is essential for any serious restaurant owner."}',
                'image' => 'https://mobidonia-demo.imgix.net/img/testimonials/femaletestimonials/3.png?w=100&h=100',
                'review' => "female"
            ],
            [
                'type' => 'testimonial',
                'title' => '{"en":"James Wilson"}',
                'subtitle' => '{"en":"Owner, Riverside Grill"}',
                'description' => '{"en":"From day one, this platform exceeded our expectations! The online ordering integration boosted our takeout sales by 45%, and the comprehensive analytics help us make data-driven decisions. It\'s like having an extra manager on staff 24/7!"}',
                'image' => 'https://mobidonia-demo.imgix.net/img/testimonials/maletestimonials/4.png?w=100&h=100',
                'review' => "male"
            ],
            [
                'type' => 'testimonial',
                'title' => '{"en":"Maria Rodriguez"}',
                'subtitle' => '{"en":"Owner, Spice Market"}',
                'description' => '{"en":"This all-in-one platform has transformed our family restaurant! The POS is lightning-fast, the mobile app keeps our loyal customers engaged, and the kitchen display system has eliminated order errors. We\'re operating more efficiently than ever!"}',
                'image' => 'https://mobidonia-demo.imgix.net/img/testimonials/femaletestimonials/4.png?w=100&h=100',
                'review' => "female"
            ],
            [
                'type' => 'testimonial',
                'title' => '{"en":"John Smith"}',
                'subtitle' => '{"en":"Restaurant Owner, Bistro Elegance"}',
                'description' => '{"en":"You deserve this. This platform has completely transformed our restaurant! From the intuitive POS to AI ordering, online reservations, and kitchen display system - it\'s the complete package. Our operations are streamlined, staff is happier, and profits are up. Everything we needed in one solution."}',
                'image' => 'https://mobidonia-demo.imgix.net/img/testimonials/maletestimonials/5.png?w=100&h=100',
                'review' => "male"
            ]
        ];

        foreach ($testimonials as $key => $testimonial) {
            DB::table('posts')->insert([
                'post_type' => $testimonial['type'],
                'title' => $testimonial['title'],
                'subtitle' => $testimonial['subtitle'],
                'description' => $testimonial['description'],
                'image' => $testimonial['image'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        //Add FAQ for RPRO
        $faqs = [
            [
                'title' => '{"en":"What is RPRO?"}',
                'description' => '{"en":"RPRO is a platform that allows you to manage your restaurant operations."}',
            ],
            [
                'title' => '{"en":"How does the AI phone ordering system work?"}',
                'description' => '{"en":"Our AI phone ordering system uses advanced natural language processing to automatically take customer orders over the phone 24/7. It can understand various accents, process complex orders, and instantly integrate them into your kitchen system - all without human intervention. This means you never miss an order, even during peak hours or after closing time."}',
            ],
            [
                'title' => '{"en":"What features does the POS system include?"}',
                'description' => '{"en":"Our revolutionary POS system includes lightning-fast order processing, a customizable interface that adapts to any restaurant type, seamless table management, and offline functionality to ensure continuous operation. It\'s designed to be intuitive for staff while providing powerful management tools for owners."}',
            ],
            [
                'title' => '{"en":"How does the WhatsApp integration benefit my restaurant?"}',
                'description' => '{"en":"The WhatsApp integration enables automatic order confirmations, real-time status updates, and personalized communication with customers through WhatsApp. This reduces support calls, improves customer satisfaction, and keeps your customers informed through a platform they already use daily."}',
            ],
            [
                'title' => '{"en":"What type of analytics and insights are available?"}',
                'description' => '{"en":"Our analytics platform provides comprehensive insights including real-time sales dashboards, menu performance metrics, customer behavior analysis, and predictive forecasting for inventory management. These data-driven insights help you make informed decisions to grow your business and optimize operations."}',
            ],
            [
                'title' => '{"en":"How does the loyalty program help retain customers?"}',
                'description' => '{"en":"Our loyalty program includes customizable points systems, digital punch cards, special birthday rewards, and VIP tiers. These features help turn first-time visitors into regular customers by rewarding their loyalty and encouraging repeat visits. The system automatically tracks customer engagement and rewards, making it easy to manage."}',
            ]
        ];

        foreach ($faqs as $key => $faq) {
            DB::table('posts')->insert([
                'post_type' => 'faq',
                'title' => $faq['title'],
                'description' => $faq['description'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
        }
        
      

        Model::reguard();
    }
}
