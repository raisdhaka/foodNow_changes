<?php

namespace Modules\Blog\Database\Seeds;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Blog\Models\Blog;

class BlogDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

       //if project is not in demo mode, don't insert demo data
       if(!config('settings.is_demo',false)){
            return;
        }

        //Make data for 10 WhatsApp Marketing software named "WhatsBox" 
        //Later will insert them in the database
        //The migration file is in the module Blog, 
        //Use https://unsplash.com/ to get images
        //USE AI to generate the 
        

$blogs = [
    [
        'title' => 'Top Features of WhatsBox for Effective Marketing',
        'slug' => 'top-features-of-whatsbox',
        'content' => '<h2>Revolutionary Features That Set WhatsBox Apart</h2>
<p>In today\'s digital marketing landscape, WhatsBox stands as a beacon of innovation, offering unparalleled features that transform how businesses approach WhatsApp marketing:</p>

<h3>1. Advanced Automation Suite</h3>
<ul>
    <li>Smart Reply System with AI-powered response suggestions</li>
    <li>Automated campaign scheduling with timezone optimization</li>
    <li>Custom workflow builders for complex marketing sequences</li>
</ul>

<h3>2. Analytics Dashboard</h3>
<p>Our comprehensive analytics suite provides deep insights into your marketing performance:</p>
<div class="metrics-container">
    <ul>
        <li>Real-time engagement tracking</li>
        <li>Conversion funnel analysis</li>
        <li>Customer behavior patterns</li>
    </ul>
</div>

<h3>3. Integration Capabilities</h3>
<p>Seamlessly connect with your existing tools:</p>
<div class="integration-box">
    <ul>
        <li>CRM systems integration</li>
        <li>E-commerce platform synchronization</li>
        <li>API-first architecture for custom solutions</li>
    </ul>
</div>',
        'excerpt' => 'Learn about the top features of WhatsBox that can transform your marketing strategy.',
        'featured_image' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?q=80&w=1000',
        'meta_title' => 'Top Features of WhatsBox',
        'meta_description' => 'Explore the top features of WhatsBox for enhancing your WhatsApp marketing campaigns.',
        'meta_keywords' => 'WhatsBox, WhatsApp marketing, marketing software',
        'status' => 'published',
        'is_featured' => true,
    ],
    [
        'title' => 'How WhatsBox Helps Small Businesses Grow',
        'slug' => 'how-whatsbox-helps-small-businesses',
        'content' => '<article class="business-growth">
<h2>Empowering Small Businesses with WhatsBox</h2>

<div class="introduction">
    <p>Small businesses face unprecedented challenges in today\'s digital marketplace. WhatsBox provides a comprehensive solution that levels the playing field:</p>
</div>

<section class="key-benefits">
    <h3>Cost-Effective Marketing Solutions</h3>
    <div class="benefit-box">
        <p>Our platform reduces marketing costs by up to 60% compared to traditional channels:</p>
        <ul>
            <li>Pay-as-you-grow pricing model</li>
            <li>No hidden fees or long-term contracts</li>
            <li>Scalable solutions that grow with your business</li>
        </ul>
    </div>

    <h3>Customer Engagement Tools</h3>
    <div class="engagement-metrics">
        <p>Boost your customer engagement with our suite of tools:</p>
        <table class="metrics-table">
            <tr>
                <th>Feature</th>
                <th>Impact</th>
            </tr>
            <tr>
                <td>Auto-responders</td>
                <td>24/7 customer support</td>
            </tr>
            <tr>
                <td>Smart Campaigns</td>
                <td>40% higher open rates</td>
            </tr>
        </table>
    </div>
</section></article>',
        'excerpt' => 'See how WhatsBox empowers small businesses with powerful marketing tools.',
        'featured_image' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=1000',
        'meta_title' => 'WhatsBox for Small Businesses',
        'meta_description' => 'Learn how WhatsBox supports small businesses with cutting-edge marketing solutions.',
        'meta_keywords' => 'WhatsBox, small business, WhatsApp marketing',
        'status' => 'published',
        'is_featured' => false,
    ],
    [
        'title' => 'The Ultimate Guide to WhatsApp Marketing with WhatsBox',
        'slug' => 'ultimate-guide-to-whatsapp-marketing',
        'content' => 'WhatsBox simplifies WhatsApp marketing. This guide will show you how to maximize its potential...',
        'excerpt' => 'Master WhatsApp marketing with this comprehensive guide to WhatsBox.',
        'featured_image' => 'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?q=80&w=1000',
        'meta_title' => 'Guide to WhatsApp Marketing',
        'meta_description' => 'A complete guide to using WhatsBox for effective WhatsApp marketing.',
        'meta_keywords' => 'WhatsBox, WhatsApp marketing, guide',
        'status' => 'published',
        'is_featured' => true,
    ],
    [
        'title' => 'Boost Customer Engagement with WhatsBox',
        'slug' => 'boost-customer-engagement-whatsbox',
        'content' => 'Customer engagement is key to success. WhatsBox offers tools to keep your audience connected...',
        'excerpt' => 'Engage your customers like never before with WhatsBox.',
        'featured_image' => 'https://images.unsplash.com/photo-1556745757-8d76bdb6984b?q=80&w=1000',
        'meta_title' => 'Boost Customer Engagement',
        'meta_description' => 'Enhance customer engagement with WhatsBox\'s advanced features.',
        'meta_keywords' => 'WhatsBox, customer engagement, marketing software',
        'status' => 'published',
        'is_featured' => false,
    ],
    [
        'title' => 'WhatsBox: The Future of WhatsApp Marketing',
        'slug' => 'whatsbox-future-of-marketing',
        'content' => 'Explore why WhatsBox is shaping the future of WhatsApp marketing with innovative features...',
        'excerpt' => 'WhatsBox is redefining the future of WhatsApp marketing.',
        'featured_image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=1000',
        'meta_title' => 'WhatsBox: Future of Marketing',
        'meta_description' => 'Discover how WhatsBox is leading the way in WhatsApp marketing innovation.',
        'meta_keywords' => 'WhatsBox, WhatsApp marketing, future',
        'status' => 'published',
        'is_featured' => true
    ],
    
        [
            'title' => '5 Reasons Why WhatsBox is a Game Changer for Marketers',
            'slug' => 'reasons-whatsbox-is-game-changer',
            'content' => 'WhatsBox is revolutionizing WhatsApp marketing with its intuitive design and powerful features...',
            'excerpt' => 'Discover why marketers are calling WhatsBox a game changer.',
            'featured_image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=1000',
            'meta_title' => '5 Reasons WhatsBox is a Game Changer',
            'meta_description' => 'Learn the top 5 reasons why WhatsBox is transforming the marketing landscape.',
            'meta_keywords' => 'WhatsBox, WhatsApp marketing, innovation',
            'status' => 'published',
            'is_featured' => false,
        ],
        [
            'title' => 'How to Automate Your WhatsApp Campaigns with WhatsBox',
            'slug' => 'automate-whatsapp-campaigns',
            'content' => 'Automation is the future of marketing, and WhatsBox makes it easier than ever...',
            'excerpt' => 'Learn how to save time by automating your WhatsApp campaigns using WhatsBox.',
            'featured_image' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=1000',
            'meta_title' => 'Automate WhatsApp Campaigns',
            'meta_description' => 'Find out how WhatsBox helps you automate your WhatsApp marketing campaigns.',
            'meta_keywords' => 'WhatsBox, WhatsApp automation, campaigns',
            'status' => 'published',
            'is_featured' => true,
        ],
        [
            'title' => 'The Role of AI in WhatsApp Marketing with WhatsBox',
            'slug' => 'ai-in-whatsapp-marketing',
            'content' => 'Artificial Intelligence is transforming marketing strategies, and WhatsBox is at the forefront...',
            'excerpt' => 'Explore how AI-powered tools in WhatsBox are reshaping WhatsApp marketing.',
            'featured_image' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?q=80&w=1000',
            'meta_title' => 'AI in WhatsApp Marketing',
            'meta_description' => 'Discover the role of AI in WhatsBox and how it enhances WhatsApp marketing.',
            'meta_keywords' => 'WhatsBox, AI, WhatsApp marketing',
            'status' => 'published',
            'is_featured' => false,
        ],
        [
            'title' => '10 Tips to Maximize ROI with WhatsBox',
            'slug' => 'maximize-roi-with-whatsbox',
            'content' => 'Achieving a high ROI is every marketer\'s goal. With WhatsBox, you can take your campaigns to the next level...',
            'excerpt' => 'Learn 10 practical tips to maximize your marketing ROI using WhatsBox.',
            'featured_image' => 'https://images.unsplash.com/photo-1579532537598-459ecdaf39cc?q=80&w=1000',
            'meta_title' => 'Maximize ROI with WhatsBox',
            'meta_description' => 'Learn how to maximize ROI on your WhatsApp marketing campaigns with WhatsBox.',
            'meta_keywords' => 'WhatsBox, ROI, WhatsApp marketing',
            'status' => 'published',
            'is_featured' => true,
        ],
        [
            'title' => 'WhatsBox Success Stories: Real Businesses, Real Results',
            'slug' => 'whatsbox-success-stories',
            'content' => 'From small startups to established enterprises, WhatsBox has helped businesses achieve remarkable success...',
            'excerpt' => 'Read inspiring success stories of businesses that have grown with WhatsBox.',
            'featured_image' => 'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?q=80&w=1000',
            'meta_title' => 'WhatsBox Success Stories',
            'meta_description' => 'Explore real-world success stories of businesses using WhatsBox.',
            'meta_keywords' => 'WhatsBox, success stories, WhatsApp marketing',
            'status' => 'published',
            'is_featured' => false,
        ]
        
    ];

    //Reverse the array
    //$blogs = array_reverse($blogs);
    if(config('settings.app_code_name')=='rpro'){
        $blogs =[
            [
                'title' => 'Essential Restaurant Management Tips for 2025',
                'slug' => 'essential-restaurant-management-tips',
                'content' => '<h2>Modern Restaurant Management Strategies</h2>
    <p>Success in today\'s competitive restaurant industry requires a blend of traditional wisdom and modern innovation:</p>
    
    <h3>1. Digital Integration</h3>
    <ul>
        <li>Online ordering system optimization</li>
        <li>Restaurant management software implementation</li>
        <li>Social media presence management</li>
    </ul>
    
    <h3>2. Staff Management</h3>
    <p>Your team is your greatest asset. Here\'s how to optimize workforce management:</p>
    <div class="staff-tips">
        <ul>
            <li>Effective training programs</li>
            <li>Employee retention strategies</li>
            <li>Performance incentive systems</li>
        </ul>
    </div>
    
    <h3>3. Customer Experience</h3>
    <p>Elevate your dining experience with these proven strategies:</p>
    <div class="experience-box">
        <ul>
            <li>Personalized service approaches</li>
            <li>Ambiance optimization</li>
            <li>Quality control measures</li>
        </ul>
    </div>',
                'excerpt' => 'Master the art of modern restaurant management with these essential tips and strategies.',
                'featured_image' => 'https://images.unsplash.com/photo-1552566626-52f8b828add9?q=80&w=1000',
                'meta_title' => 'Restaurant Management Tips 2024',
                'meta_description' => 'Learn essential restaurant management strategies for success in 2024.',
                'meta_keywords' => 'restaurant management, tips, strategies, 2024',
                'status' => 'published',
                'is_featured' => true
            ],
            [
                'title' => 'Revolutionizing Your Restaurant with Digital Menu Solutions',
                'slug' => 'digital-menu-solutions',
                'content' => '<article class="digital-transformation">
    <h2>The Digital Menu Revolution</h2>
    
    <div class="introduction">
        <p>Digital menus are transforming the restaurant industry. Here\'s how to stay ahead of the curve:</p>
    </div>
    
    <section class="key-benefits">
        <h3>Benefits of Digital Menus</h3>
        <div class="benefit-box">
            <p>Transform your customer experience with these advantages:</p>
            <ul>
                <li>Real-time menu updates</li>
                <li>Interactive dish presentations</li>
                <li>Multi-language support</li>
                <li>Allergen information integration</li>
            </ul>
        </div>
    
        <h3>Implementation Strategy</h3>
        <div class="strategy-section">
            <p>Follow these steps for successful digital menu integration:</p>
            <ol>
                <li>Choose the right platform</li>
                <li>Train your staff effectively</li>
                <li>Gather customer feedback</li>
                <li>Optimize based on data</li>
            </ol>
        </div>
    </section></article>',
                'excerpt' => 'Discover how digital menu solutions can transform your restaurant operations.',
                'featured_image' => 'https://images.unsplash.com/photo-1726661025461-5635b785ec23?q=80&w=1000',
                'meta_title' => 'Digital Menu Solutions',
                'meta_description' => 'Transform your restaurant with modern digital menu solutions.',
                'meta_keywords' => 'digital menu, restaurant technology, QR codes',
                'status' => 'published',
                'is_featured' => true
            ],
            [
                'title' => 'Sustainable Restaurant Practices: A Guide to Eco-Friendly Dining',
                'slug' => 'sustainable-restaurant-practices',
                'content' => '<h2>Building a Sustainable Restaurant Business</h2>
    <p>Sustainability isn\'t just good for the planet—it\'s good for business. Learn how to implement eco-friendly practices that attract conscious consumers and reduce operational costs.</p>
    
    <h3>Key Sustainability Initiatives</h3>
    <ul>
        <li>Waste reduction strategies</li>
        <li>Energy-efficient equipment</li>
        <li>Local sourcing programs</li>
        <li>Composting systems</li>
    </ul>
    
    <h3>Cost Benefits</h3>
    <p>Discover how sustainable practices can improve your bottom line:</p>
    <ul>
        <li>Reduced utility costs</li>
        <li>Decreased food waste expenses</li>
        <li>Increased customer loyalty</li>
    </ul>',
                'excerpt' => 'Learn how to implement sustainable practices in your restaurant while improving profitability.',
                'featured_image' => 'https://images.unsplash.com/photo-1596480695897-0c2d075e2e15?q=80&w=1000',
                'meta_title' => 'Sustainable Restaurant Guide',
                'meta_description' => 'Comprehensive guide to implementing sustainable practices in restaurants.',
                'meta_keywords' => 'sustainable restaurant, eco-friendly dining, green practices',
                'status' => 'published',
                'is_featured' => false
            ],
            [
                'title' => 'Mastering Restaurant Social Media Marketing',
                'slug' => 'restaurant-social-media-marketing',
                'content' => 'Learn how to leverage social media platforms to attract more customers and build a strong brand presence...',
                'excerpt' => 'Effective social media strategies for modern restaurants.',
                'featured_image' => 'https://images.unsplash.com/photo-1683721003111-070bcc053d8b?q=80&w=1000',
                'meta_title' => 'Restaurant Social Media Marketing',
                'meta_description' => 'Master social media marketing strategies for your restaurant.',
                'meta_keywords' => 'restaurant marketing, social media, digital presence',
                'status' => 'published',
                'is_featured' => true
            ],
            [
                'title' => 'Innovative Restaurant Design Trends for 2024',
                'slug' => 'restaurant-design-trends',
                'content' => 'Explore the latest design trends shaping the modern dining experience...',
                'excerpt' => 'Stay ahead with the latest restaurant design trends.',
                'featured_image' => 'https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=1000',
                'meta_title' => 'Restaurant Design Trends',
                'meta_description' => 'Latest restaurant design trends and interior inspiration.',
                'meta_keywords' => 'restaurant design, interior trends, dining experience',
                'status' => 'published',
                'is_featured' => false
            ],
            [
                'title' => 'Maximizing Restaurant Profits Through Efficient Inventory Management',
                'slug' => 'restaurant-inventory-management',
                'content' => 'Master inventory control to reduce waste and increase profits...',
                'excerpt' => 'Learn how proper inventory management can boost your restaurant\'s bottom line.',
                'featured_image' => 'https://images.unsplash.com/photo-1556911261-6bd341186b2f?q=80&w=1000',
                'meta_title' => 'Restaurant Inventory Management',
                'meta_description' => 'Effective inventory management strategies for restaurants.',
                'meta_keywords' => 'inventory management, restaurant operations, profit optimization',
                'status' => 'published',
                'is_featured' => true
            ],
            [
                'title' => 'Building a Successful Restaurant Loyalty Program',
                'slug' => 'restaurant-loyalty-program',
                'content' => 'Create an effective loyalty program that keeps customers coming back...',
                'excerpt' => 'Design and implement a successful restaurant loyalty program.',
                'featured_image' => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?q=80&w=1000',
                'meta_title' => 'Restaurant Loyalty Programs',
                'meta_description' => 'Guide to creating successful restaurant loyalty programs.',
                'meta_keywords' => 'loyalty program, customer retention, restaurant marketing',
                'status' => 'published',
                'is_featured' => false
            ],
            [
                'title' => 'Essential Food Safety Practices for Restaurants',
                'slug' => 'food-safety-practices',
                'content' => 'Comprehensive guide to maintaining the highest food safety standards...',
                'excerpt' => 'Ensure food safety compliance and maintain quality standards.',
                'featured_image' => 'https://images.unsplash.com/photo-1564844536308-50b114a1d946?q=80&w=1000',
                'meta_title' => 'Restaurant Food Safety',
                'meta_description' => 'Essential food safety guidelines for restaurants.',
                'meta_keywords' => 'food safety, restaurant compliance, health standards',
                'status' => 'published',
                'is_featured' => true
            ],
            [
                'title' => 'Effective Staff Training Techniques for Restaurants',
                'slug' => 'restaurant-staff-training',
                'content' => 'Develop a comprehensive training program for your restaurant staff...',
                'excerpt' => 'Create an effective training program for your restaurant team.',
                'featured_image' => 'https://images.unsplash.com/photo-1560863223-5c6d0237e4da?q=80&w=1000',
                'meta_title' => 'Restaurant Staff Training',
                'meta_description' => 'Guide to effective restaurant staff training methods.',
                'meta_keywords' => 'staff training, restaurant management, employee development',
                'status' => 'published',
                'is_featured' => false
            ],
            [
                'title' => 'Leveraging Technology for Better Restaurant Operations',
                'slug' => 'restaurant-technology-solutions',
                'content' => 'Explore how modern technology can streamline your restaurant operations...',
                'excerpt' => 'Implement the latest technology solutions in your restaurant.',
                'featured_image' => 'https://images.unsplash.com/photo-1556742393-d75f468bfcb0?q=80&w=1000',
                'meta_title' => 'Restaurant Technology Solutions',
                'meta_description' => 'Modern technology solutions for efficient restaurant operations.',
                'meta_keywords' => 'restaurant technology, automation, digital solutions',
                'status' => 'published',
                'is_featured' => true
            ]
        ];

        //Add 10 blogs for RPRO
        
    }

    //Insert the data in the database
    foreach ($blogs as $blog) {
        Blog::create($blog);
    }
    

      
        Model::reguard();
    }
}

