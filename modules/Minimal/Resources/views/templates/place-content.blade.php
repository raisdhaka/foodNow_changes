<!-- section-place-content -->
<section class='section section-place-content bg-gray-50'>
    <div class='packer w-full'>
        <div class='package'>
            <!-- Remove the floating cart button -->
            
            <!-- Add persistent cart button to the top -->
           
           
            <div class='content' style="z-index: 0;">
                
                <!-- Text-based menu -->
                <div id='place-menu' class='holder-left {{  !$canDoOrdering?"fullHolder":""  }} content-tab expanded'>
                    <div class='content-center max-w-3xl mx-auto py-6'>
                        <!-- Restaurant name and hours header -->
                        <div class="text-center mb-8 px-4">
                            <div class="flex items-center justify-center mb-2">
                                <div class="w-24 border-t-2 border-gray-300"></div>
                                <h2 class="mx-4 text-gray-500 font-medium tracking-wider uppercase text-sm">{{ $restorant->name }}</h2>
                                <div class="w-24 border-t-2 border-gray-300"></div>
                            </div>
                            
                            <h1 class="text-5xl font-serif tracking-wide mb-2">MENU</h1>

                            <!-- Checkout Button -->
                            @if ($canDoOrdering)
                            <a 
                                href='/cart-checkout'
                                class="mt-4 inline-flex items-center py-2 px-4 text-white leading-none bg-black/40 backdrop-blur-sm rounded-md border-0 cursor-pointer hover:bg-black/60 transition-all duration-300">
                                <span class="mr-1"><i class="las la-shopping-cart"></i></span>
                                <span>{{ __('Checkout') }}</span>
                            </a>
                            @endif
                            
                          
                            
                            <div class="w-full border-t-2 border-gray-300 mt-6"></div>
                        </div>

                        @if(!$restorant->categories->isEmpty())
                            @foreach ($restorant->categories as $key => $category)
                            <div id="cat-{{ $category->id }}" class="mb-12 px-4">
                                <div class="category-heading mb-6">
                                    <h2 id='subsection-{{ $category->id }}' class="text-xl text-amber-600 font-light uppercase tracking-wider">{{ $category->name }}</h2>
                                </div>
                                
                                <!-- Text menu items for category -->
                                <div class="menu-items space-y-6">
                                    @foreach ($category->aitems as $item)
                                    <div class="menu-item">
                                        <div class="flex justify-between items-baseline mb-1">
                                            <h3 class="text-base font-medium text-gray-800 uppercase tracking-wide">{{ $item->name }}</h3>
                                            <div class="flex items-center">
                                                <span class="text-xl font-medium text-gray-700">
                                                    @if ($item->discounted_price > 0)
                                                        <span style="text-decoration: line-through;" class="text-sm mr-2 text-gray-500">@money($item->discounted_price, config('settings.cashier_currency'),config('settings.do_convertion'))</span>
                                                    @endif
                                                    @money($item->price, config('settings.cashier_currency'),config('settings.do_convertion'))
                                                </span>
                                            </div>
                                        </div>
                                        
                                        @if(strlen($item->short_description) > 2)
                                        <p class="text-sm text-gray-500 pr-12">{{ $item->short_description }}</p>
                                        @endif
                                        
                                        @if(count($item->allergens) > 0)
                                        <div class="allergens flex mt-1">
                                            @foreach ($item->allergens as $allergen)
                                                <div class='allergen mr-1' data-toggle="tooltip" data-placement="bottom" title="{{$allergen->title}}">
                                                    <img src="{{$allergen->image_link}}" class="h-4 w-4"/>
                                                </div>
                                            @endforeach
                                        </div>
                                        @endif
                                        
                                        <div class="menu-item-action mt-2">
                                            <a href='javascript:;' onClick="setCurrentItemInGlow({{ $item->id }})" 
                                               class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                                {{ __('Add to cart') }}
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                   
                </div>
                <!-- Remove the Info tab since it's not needed anymore -->
            </div>
        </div>
    </div>
</section>

<style>
    /* Text Menu specific styles */
    .menu-item {
        position: relative;
        padding-bottom: 6px;
        border-bottom: 1px dotted #e5e5e5;
        transition: all 0.3s ease;
    }
    
    .menu-item:hover {
        border-bottom-color: #d1d1d1;
    }
    
    .menu-item:last-child {
        border-bottom: none;
    }
    
    .category-heading {
        position: relative;
    }
    
    /* Ensure the menu is expanded by default */
    #place-menu.content-tab {
        display: block !important;
    }
    
    /* Smooth scrolling for category links */
    html {
        scroll-behavior: smooth;
    }
    
    /* Cart button styling */
    #cartButtonHeader {
        transition: transform 0.3s ease;
    }
    
    #cartButtonHeader:hover {
        transform: scale(1.05);
    }
    
    #itemsCount {
        position: relative;
    }
    
    #itemsCount.updated {
        animation: pulse 0.5s ease;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }
    
    /* Make sure the menu is visible on mobile */
    @media (max-width: 768px) {
        .holder-left {
            width: 100%;
        }
        
        /* Ensure cart button is visible on mobile */
        #cartButtonHeader {
            top: 1rem;
            right: 1rem;
        }
    }
    
    /* Adjust for tablet */
    @media (min-width: 769px) and (max-width: 1024px) {
        #cartButtonHeader {
            top: 1.5rem;
            right: 1.5rem;
        }
    }
    
    /* Adjust for desktop */
    @media (min-width: 1025px) {
        #cartButtonHeader {
            top: 2rem;
            right: 2rem;
        }
    }
</style>

<script>
    // Scroll to category when clicking on category tabs
    document.addEventListener('DOMContentLoaded', function() {
        const categoryLinks = document.querySelectorAll('.flex.flex-wrap.justify-start.gap-1 a');
        
        categoryLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    // Scroll to the category with offset for the sticky header
                    window.scrollTo({
                        top: targetElement.offsetTop - 60,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Update cart count based on items in cart
        function updateCartCount() {
            let cartCount = 0;
            if (window.localStorage.getItem('cart')) {
                try {
                    const cart = JSON.parse(window.localStorage.getItem('cart'));
                    if (cart && cart.items) {
                        Object.keys(cart.items).forEach(key => {
                            cartCount += cart.items[key].quantity;
                        });
                    }
                } catch (e) {
                    console.error('Error parsing cart data', e);
                }
            }
            
            const countElement = document.getElementById('itemsCount');
            if (countElement) {
                // Add animation when count changes
                const oldValue = parseInt(countElement.innerText);
                if (oldValue !== cartCount) {
                    countElement.classList.add('updated');
                    setTimeout(() => {
                        countElement.classList.remove('updated');
                    }, 500);
                }
                
                countElement.innerText = cartCount;
            }
        }
        
        // Initial cart count update
        updateCartCount();
        
        // Listen for cart changes
        window.addEventListener('cartUpdated', function() {
            updateCartCount();
        });
        
        // Custom event for cart updates
        document.addEventListener('cart-updated', function() {
            updateCartCount();
        });
        
        // Also hook into the existing cart update functionality
        const originalAddToCartFunction = window.addToCart;
        if (typeof originalAddToCartFunction === 'function') {
            window.addToCart = function() {
                originalAddToCartFunction.apply(this, arguments);
                updateCartCount();
            }
        }
        
        // Update cart count periodically to ensure it's always correct
        setInterval(updateCartCount, 2000);
    });
</script> 