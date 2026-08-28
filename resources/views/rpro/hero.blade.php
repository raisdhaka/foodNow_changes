<div class="relative items-center justify-center w-full overflow-x-hidden lg:pb-40 sm:pt-8 md:pt-12">
    <div class="container flex flex-col items-center justify-between h-full max-w-6xl px-8 mx-auto lg:flex-row xl:px-0">
        <div class="z-30 flex flex-col items-center w-full max-w-xl text-center lg:items-start lg:w-1/2 lg:pt-24 lg:text-left">
            <h1 class="relarive lg:pr-16 sm:text-6xl lg:mb-8 mt-6 text-3xl font-medium tracking-tight text-gray-950 sm:text-5xl">{{ __('Restaurants.') }}<br />{{ __('You deserve this.') }}</h1>
            <p class="pr-0 mb-8 text-base text-zinc-600 sm:text-lg xl:text-xl lg:pr-20">{{ __('Transform your restaurant with our complete platform - POS, online ordering, reservations, mobile app, kitchen display system and more. Everything you need to streamline operations.') }}</p>
            <div class="flex gap-4 items-center">
                <a href="{{ route('newrestaurant.register') }}" class="relative self-start inline-block w-auto px-8 py-4 mx-auto mt-0 text-base font-bold text-white bg-gray-900 border-t border-zinc-200 rounded-md shadow-xl sm:mt-1 fold-bold lg:mx-0" data-primary="gray-900" data-rounded="rounded-md">{{ __('Get Started Free') }}</a>
                @if(config('settings.demo_video_url'))
                <a href="{{ config('settings.demo_video_url') }}" class="glightbox relative self-start inline-flex items-center w-auto px-6 py-3 mx-auto mt-0 text-base text-gray-600 bg-transparent hover:bg-gray-50 rounded-md transition-colors duration-200 sm:mt-1 lg:mx-0" data-gallery="video">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                    </svg>
                    {{ __('Watch Demo') }}
                </a>
                @endif
            </div>

           

            <!-- Integrates with section -->
            <div class="flex-col hidden mt-12 sm:flex lg:mt-24">
                <p class="mb-4 text-sm font-medium tracking-widest text-zinc-500 uppercase">{{ __('Integrates With') }}</p>
                <div class="flex">
                    <svg class="h-8 mr-4 text-zinc-500 duration-150 cursor-pointer fill-current transition-color hover:text-zinc-600" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                        <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
                    </svg>
                    <svg class="h-8 mr-4 text-zinc-500 duration-150 cursor-pointer fill-current transition-color hover:text-zinc-600" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.2819 9.8211a5.9847 5.9847 0 0 0-.5157-4.9108 6.0462 6.0462 0 0 0-6.5098-2.9A6.0651 6.0651 0 0 0 4.9807 4.1818a5.9847 5.9847 0 0 0-3.9977 2.9 6.0462 6.0462 0 0 0 .7427 7.0966 5.98 5.98 0 0 0 .511 4.9107 6.051 6.051 0 0 0 6.5146 2.9001A5.9847 5.9847 0 0 0 13.2599 24a6.0557 6.0557 0 0 0 5.7718-4.2058 5.9894 5.9894 0 0 0 3.9977-2.9001 6.0557 6.0557 0 0 0-.7475-7.0729zm-9.022 12.6081a4.4755 4.4755 0 0 1-2.8764-1.0408l.1419-.0804 4.7783-2.7582a.7948.7948 0 0 0 .3927-.6813v-6.7369l2.02 1.1686a.071.071 0 0 1 .038.052v5.5826a4.504 4.504 0 0 1-4.4945 4.4944zm-9.6607-4.1254a4.4708 4.4708 0 0 1-.5346-3.0137l.142.0852 4.783 2.7582a.7712.7712 0 0 0 .7806 0l5.8428-3.3685v2.3324a.0804.0804 0 0 1-.0332.0615L9.74 19.9502a4.4992 4.4992 0 0 1-6.1408-1.6464zM2.3408 7.8956a4.485 4.485 0 0 1 2.3655-1.9728V11.6a.7664.7664 0 0 0 .3879.6765l5.8144 3.3543-2.0201 1.1685a.0757.0757 0 0 1-.071 0l-4.8303-2.7865A4.504 4.504 0 0 1 2.3408 7.872zm16.5963 3.8558L13.1038 8.364 15.1192 7.2a.0757.0757 0 0 1 .071 0l4.8303 2.7913a4.4944 4.4944 0 0 1-.6765 8.1042v-5.6772a.79.79 0 0 0-.407-.667zm2.0107-3.0231l-.142-.0852-4.7735-2.7818a.7759.7759 0 0 0-.7854 0L9.409 9.2297V6.8974a.0662.0662 0 0 1 .0284-.0615l4.8303-2.7866a4.4992 4.4992 0 0 1 6.6802 4.66zM8.3065 12.863l-2.02-1.1638a.0804.0804 0 0 1-.038-.0567V6.0742a4.4992 4.4992 0 0 1 7.3757-3.4537l-.142.0805L8.704 5.459a.7948.7948 0 0 0-.3927.6813zm1.0976-2.3654l2.602-1.4998 2.6069 1.4998v2.9994l-2.5974 1.4997-2.6067-1.4997Z"/>
                    </svg>
                    <svg class="h-8 mr-4 text-zinc-500 duration-150 cursor-pointer fill-current transition-color hover:text-zinc-600" viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <path d="M128.080089,-0.000183105 C135.311053,0.0131003068 142.422517,0.624138494 149.335663,1.77979593 L149.335663,1.77979593 L149.335663,76.2997796 L202.166953,23.6044907 C208.002065,27.7488446 213.460883,32.3582023 218.507811,37.3926715 C223.557281,42.4271407 228.192318,47.8867213 232.346817,53.7047992 L232.346817,53.7047992 L179.512985,106.400063 L254.227854,106.400063 C255.387249,113.29414 256,120.36111 256,127.587243 L256,127.587243 L256,127.759881 C256,134.986013 255.387249,142.066204 254.227854,148.960282 L254.227854,148.960282 L179.500273,148.960282 L232.346817,201.642324 C228.192318,207.460402 223.557281,212.919983 218.523066,217.954452 L218.523066,217.954452 L218.507811,217.954452 C213.460883,222.988921 208.002065,227.6115 202.182208,231.742607 L202.182208,231.742607 L149.335663,179.04709 L149.335663,253.5672 C142.435229,254.723036 135.323765,255.333244 128.092802,255.348499 L128.092802,255.348499 L127.907197,255.348499 C120.673691,255.333244 113.590195,254.723036 106.677048,253.5672 L106.677048,253.5672 L106.677048,179.04709 L53.8457596,231.742607 C42.1780766,223.466917 31.977435,213.278734 23.6658953,201.642324 L23.6658953,201.642324 L76.4997269,148.960282 L1.78485803,148.960282 C0.612750404,142.052729 0,134.946095 0,127.719963 L0,127.719963 L0,127.349037 C0.0121454869,125.473817 0.134939797,123.182933 0.311311815,120.812834 L0.36577283,120.099764 C0.887996182,113.428547 1.78485803,106.400063 1.78485803,106.400063 L76.4997269,106.400063 L23.6658953,53.7047992 C27.8076812,47.8867213 32.4300059,42.4403618 37.4769335,37.4193681 L37.4769335,37.4193681 L37.5023588,37.3926715 C42.5391163,32.3582023 48.0106469,27.7488446 53.8457596,23.6044907 L53.8457596,23.6044907 L106.677048,76.2997796 L106.677048,1.77979593 C113.590195,0.624138494 120.688946,0.0131003068 127.932622,-0.000183105 L127.932622,-0.000183105 L128.080089,-0.000183105 Z" fill="currentColor" fill-rule="nonzero">
                            </path>
                        </g>
                    </svg>
                   
                    <svg class="h-8 text-zinc-500 duration-150 cursor-pointer fill-current transition-color hover:text-zinc-600" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.976 9.15c-2.172-.806-3.356-1.426-3.356-2.409 0-.831.683-1.305 1.901-1.305 2.227 0 4.515.858 6.09 1.631l.89-5.494C18.252.975 15.697 0 12.165 0 9.667 0 7.589.654 6.104 1.872 4.56 3.147 3.757 4.992 3.757 7.218c0 4.039 2.467 5.76 6.476 7.219 2.585.92 3.445 1.574 3.445 2.583 0 .98-.84 1.545-2.354 1.545-1.875 0-4.965-.921-6.99-2.109l-.9 5.555C5.175 22.99 8.385 24 11.714 24c2.641 0 4.843-.624 6.328-1.813 1.664-1.305 2.525-3.236 2.525-5.732 0-4.128-2.524-5.851-6.594-7.305h.003z" fill="currentColor"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="relative z-50 flex flex-col items-end justify-center w-full h-full lg:w-1/2 lg:pl-10">
            <div class="container relative left-0 w-full max-w-4xl lg:absolute lg:w-screen">
                <img src="{{ asset('default/hero.png') }}" class="w-full h-auto mt-20 mb-20 ml-0 shadow-2xl rounded-xl lg:mb-0 lg:h-full xl:-ml-12" data-rounded="rounded-xl" data-rounded-max="rounded-full">
            </div>
        </div>
         
    </div>
</div>

<!-- Video Modal -->
<div id="video-modal" class="hidden fixed inset-0 w-full h-full z-50 overflow-hidden flex justify-center items-center bg-black bg-opacity-75 transition-opacity duration-300">
    <div class="relative mx-4" style="height: 600px; width: 1067px;">
        <div class="relative z-50 bg-white rounded-lg shadow-xl h-full">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4 border-b">
                <h3 class="text-xl font-semibold text-gray-900">{{ __('Watch Demo') }}</h3>
                <button onclick="closeVideoModal()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="p-6 h-[calc(100%-80px)]">
                <div class="relative h-full w-full">
                    <iframe id="demo-video" class="absolute inset-0 w-full h-full" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function closeVideoModal() {
        const modal = document.getElementById('video-modal');
        const iframe = document.getElementById('demo-video');
        modal.classList.add('hidden');
        iframe.src = ''; // Reset iframe src to stop video
        document.body.style.overflow = 'auto'; // Re-enable scrolling
    }

    // Close modal when clicking outside
    document.getElementById('video-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeVideoModal();
        }
    });

    // Close modal on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !document.getElementById('video-modal').classList.contains('hidden')) {
            closeVideoModal();
        }
    });

    // Open modal and set video
    document.querySelector('[onclick="document.getElementById(\'video-modal\').classList.remove(\'hidden\')"]')
        .addEventListener('click', function() {
            const modal = document.getElementById('video-modal');
            const iframe = document.getElementById('demo-video');
            iframe.src = 'https://www.youtube.com/embed/YOUR_VIDEO_ID'; // Replace with your video URL
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
    });
</script>

<!-- Add GLightbox CSS in head section -->
@push('head')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
@endpush

<!-- Add GLightbox JS and initialization at the end of the body -->
@push('js')
<script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
<script>
    const lightbox = GLightbox({
        touchNavigation: true,
        loop: false,
        autoplayVideos: true,
        plyr: {
            css: 'https://cdn.plyr.io/3.7.8/plyr.css',
            js: 'https://cdn.plyr.io/3.7.8/plyr.js',
            config: {
                ratio: '16:9',
                youtube: {
                    noCookie: true,
                    rel: 0,
                    showinfo: 0,
                    iv_load_policy: 3
                }
            }
        }
    });
</script>
@endpush