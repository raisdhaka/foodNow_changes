<!-- section-place-content -->
<section class='section section-place-content bg-gray-100'>
    <div class='packer w-full'>
        <div class='package'>
            <!-- Remove the floating cart button -->
            
            <!-- Add persistent cart button to the top -->
            @if ($canDoOrdering)
            <div id="cartButtonHeader">
                <a href="/cart-checkout">
                    <i class="las la-shopping-cart"></i>
                </a>
            </div>
            @endif
           
       
            <div class='content' style="z-index: 0;">
                
                <!-- Photo-based menu -->
                <div id='place-menu' class='holder-left {{  !$canDoOrdering?"fullHolder":""  }} content-tab expanded'>
                    <div class='content-center'>
                        @if(!$restorant->categories->isEmpty())
                           
                            
                            @foreach ($restorant->categories as $key => $category)
                            <div id="cat-{{ $category->id }}" class="mb-4">
                                <div class="category-heading flex items-center mb-2 px-2">
                                    <h1 id='subsection-{{ $category->id }}' class="text-lg text-slate-700 font-bold">{{ $category->name }}</h1>
                                    <div class="ml-2 flex-grow border-t-2 border-slate-200"></div>
                                </div>
                                
                                <!-- Photo grid for category items - 2 per row -->
                                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-2 px-2">
                                    @foreach ($category->aitems as $item)
                                    <div class="photo-menu-item" data-item-id="{{ $item->id }}">
                                        <a href='javascript:;' onClick="setCurrentItemInGlow({{ $item->id }})"
                                            class="block relative overflow-hidden bg-white shadow-md hover:shadow-lg rounded-lg transform hover:-translate-y-1 transition-all duration-300"
                                            style="text-decoration: none; outline: none;">
                                            
                                            <!-- Item Image with Title Overlay -->
                                            <div class="relative w-full h-56 overflow-hidden">
                                                @if (strlen($item->logom) > 5)
                                                    <img loading="lazy" src="{{ $item->logom }}" 
                                                        class="w-full h-full object-cover transition-transform duration-300 hover:scale-110"
                                                        alt="{{ $item->name }}"
                                                    />
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center bg-slate-100">
                                                        <span class="text-slate-400 text-lg">{{ __('No image') }}</span>
                                                    </div>
                                                @endif
                                                
                                                <!-- Title Overlay -->
                                                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent px-3 py-2">
                                                    <h3 class="text-white font-bold text-base truncate">{{ $item->name }}</h3>
                                                </div>
                                                
                                                <!-- Price Badge -->
                                                <div class="absolute top-2 right-2 bg-white px-2 py-1 rounded-full shadow-md">
                                                    @if ($item->discounted_price > 0)
                                                        <span style="text-decoration: line-through;" class="text-xs text-slate-500">@money($item->discounted_price, config('settings.cashier_currency'),config('settings.do_convertion'))</span>
                                                    @endif
                                                    <span class="text-sm font-bold text-slate-700">@money($item->price, config('settings.cashier_currency'),config('settings.do_convertion'))</span>
                                                </div>
                                            </div>
                                            
                                            <!-- Allergens only, no description - more compact -->
                                            @if(count($item->allergens) > 0)
                                            <div class="allergens flex p-1">
                                                @foreach ($item->allergens as $allergen)
                                                    <div class='allergen mr-1' data-toggle="tooltip" data-placement="bottom" title="{{$allergen->title}}">
                                                        <img src="{{$allergen->image_link}}" class="h-4 w-4"/>
                                                    </div>
                                                @endforeach
                                            </div>
                                            @endif
                                        </a>
                                        
                                        <!-- Item Description -->
                                        @if(strlen($item->description) > 0)
                                        <div class="item-description px-3 py-2">
                                            <p class="line-clamp-2 text-sm">{{ $item->description }}</p>
                                        </div>
                                        @endif
                                        
                                        <!-- Add Price Button at the bottom -->
                                        <button 
                                            class="btn-price w-full py-2 mt-2 text-center font-bold" 
                                            onClick="setCurrentItemInGlow({{ $item->id }})"
                                        >
                                            @money($item->price, config('settings.cashier_currency'),config('settings.do_convertion'))
                                        </button>
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
    /* Photo Menu specific styles */
    .photo-menu-item {
        transition: all 0.3s ease;
    }
    
    .category-heading {
        position: relative;
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
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
        
        /* Adjust image height on mobile */
        .relative.w-full.h-56 {
            height: 11rem;
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

<!-- Link our custom fusion theme CSS -->
<link rel="stylesheet" href="{{ asset('css/fusion-theme.css') }}">

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
        
        // Handle menu tabs (ORISON/ENGOM)
        const menuTabs = document.querySelectorAll('.menu-tab');
        menuTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs
                menuTabs.forEach(t => t.classList.remove('active'));
                // Add active class to clicked tab
                this.classList.add('active');
                
                // Here you can implement filtering logic based on data-target attribute
                const target = this.getAttribute('data-target');
                // For demo purposes, just log the target
                console.log('Selected tab:', target);
                
                // You could implement actual filtering here
                // For example, show/hide menu items based on a certain criteria
            });
        });
        
        // Apply alternating colors to price buttons based on position in grid
        const applyButtonColors = () => {
            const menuItems = document.querySelectorAll('.photo-menu-item');
            menuItems.forEach((item, index) => {
                const button = item.querySelector('.btn-price');
                if (button) {
                    // Remove any existing color classes
                    button.classList.remove('red', 'blue', 'purple');
                    
                    // Add color class based on position
                    if (index % 3 === 0) {
                        button.classList.add('red');
                    } else if (index % 3 === 1) {
                        button.classList.add('blue');
                    } else {
                        button.classList.add('purple');
                    }
                }
            });
        };
        
        // Apply colors on page load
        applyButtonColors();
        
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