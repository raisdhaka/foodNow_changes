
@section('extrameta')
<link rel="stylesheet" href="{{ asset('vendor/owl/assets/owl.carousel.min.css') }}">

@endsection

                                <div class="col-12">
                                    <!-- Set up your HTML -->

                                    @if(str_contains(url()->current(), 'city'))
                                        <div class="">
                                            <?php $categories=\App\Models\Posts::where('post_type','category')->get(); ?>
                                            <ul class="nav nav-pills bg-white mb-4 owl-carousel owl-theme categories">
                                                <li class="nav-item nav-item-category" onclick="showAllVendors()">
                                                    <a class="nav-link mb-sm-3 mb-md-0">{{__('All')}}</a>
                                                </li>
                                                @foreach ($categories as $category)
                                                    <li class="nav-item nav-item-category" onclick="showVendorsByCategory({{$category->id}})">
                                                        <a class="nav-link mb-sm-3 mb-md-0">{{ $category->title }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                <script>
                                    function showAllVendors(){
                                        $('.resitems').show();
                                    }
                                    function showVendorsByCategory(category){
                                        $('.resitems').hide();
                                        $('.cat'+category).show();
                                    }
                                    setTimeout(function(){
                                        $('.c').owlCarousel({
                                            margin:10,
                                            loop:false,
                                            autoWidth:true,
                                            items:4
                                        })
                                    }, 1000);
                                   
                                </script>
                           
                            <br /><br /><br />
                            @section('js')
                                <script src="{{ asset('vendor/owl/owl.carousel.min.js') }}"></script>
                            @endsection
                            
                            
                  