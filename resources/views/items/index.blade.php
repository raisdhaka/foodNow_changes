@extends('layouts.app', ['title' => __('Restaurant Menu Management')])
@section('admin_title')
    {{__('Menu')}}
@endsection
@section('content')
    <style>
        .card {
            transition: all 0.2s ease;
            border-radius: 8px;
            background: #fff;
        }
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
        }
        .menu-item-card {
            height: 100%;
            background: #f8f9fa;
        }
        .menu-item-card .row {
            margin: 0;
            height: 100%;
            background: #f8f9fa;
        }
        .menu-item-card .card-body {
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: #f8f9fa;
        }
        .menu-item-card .item-image-wrapper {
            padding: 0;
            position: relative;
            min-height: 140px;
        }
        .menu-item-card .item-image {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }
        .menu-item-card .item-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }
        .menu-item-card .item-description {
            font-size: 0.875rem;
            color: #718096;
            margin-bottom: 1rem;
            line-height: 1.4;
        }
        .menu-item-card .item-price {
            font-weight: 600;
            color: #4a5568;
            font-size: 1rem;
            margin-top: auto;
        }
        .badge {
            font-size: 0.75rem;
            padding: 0.25em 0.75em;
            border-radius: 4px;
            font-weight: 500;
        }
        .badge-warning {
            background-color: #FEF3C7;
            color: #D97706;
        }
        .badge-danger {
            background-color: #FEE2E2;
            color: #DC2626;
        }
        .category-header {
            padding: 1.5rem;
            border-bottom: 1px solid #E5E7EB;
        }
        .category-header h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1F2937;
        }
        .btn-group .btn {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            border-radius: 6px;
        }
        .add-item-card {
            background: #F9FAFB;
            border: 2px dashed #E5E7EB;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 140px;
        }
        .add-item-card:hover {
            border-color: #D1D5DB;
            background: #F3F4F6;
        }
    </style>
    
    @include('items.partials.modals', ['restorant_id' => $restorant_id])
    
    <div class="header bg-gradient-primary pb-7 pt-2 pt-md-2">
        <div class="container-fluid">
            <div class="header-body">
            <div class="row align-items-center py-4">
                <!--<div class="col-lg-6 col-7">
                </div>-->
                <div class="col-lg-12 col-12 text-right">
                  
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="mb-0">{{ __('Restaurant Menu Management') }} @if(config('settings.enable_miltilanguage_menus')) ({{ $currentLanguage}}) @endif</h3>
                                    </div>
                                    <div class="col-auto">
                                        @if(config('settings.enable_miltilanguage_menus'))
                                                   
                                        @include('items.partials.languages')
                                    @endif
                                        <div class="dropdown">
                                            <button class="btn-sm btn-info dropdown-toggle" type="button" id="menuActionsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-cog"></i> {{ __('Menu Actions') }}
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="menuActionsDropdown">
                                                @if (isset($hasMenuPDf)&&$hasMenuPDf)
                                                    <a class="dropdown-item" target="_blank" href="{{ route('menupdf.download')}}">
                                                        <i class="fas fa-file-pdf text-danger mr-2"></i> {{ __('PDF Menu') }}
                                                    </a>
                                                @endif
                                                
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-items-category">
                                                    <i class="fas fa-plus text-info mr-2"></i> {{ __('Add new category') }}
                                                </a>
                                                
                                                @if($canAdd)
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-import-items" onClick=(setRestaurantId({{ $restorant_id }}))>
                                                        <i class="fas fa-file-excel text-success mr-2"></i> {{ __('Import from CSV') }}
                                                    </a>

                                                    <a class="dropdown-item" href="{{ url('/api/v2/client/vendor/'.$restorant_id.'/items_ai') }}" target="_blank">
                                                        <i class="fas fa-robot text-primary mr-2"></i> {{ __('AI MENU - JSON') }}
                                                    </a>
                                                @endif
                                                
                                               
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="col-12">
                        @include('partials.flash')
                    </div>
                    <div class="card-body">
                        @if(count($categories)==0)
                            <div class="col-lg-3" >
                                <a  data-toggle="modal" data-target="#modal-items-category" data-toggle="tooltip" data-placement="top" title="{{ __('Add new category')}}">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset('images') }}/default/add_new_item.jpg" alt="...">
                                        <div class="card-body">
                                            <h3 class="card-title text-primary text-uppercase">{{ __('Add first category') }}</h3> 
                                        </div>
                                    </div>
                                </a>
                                <br />
                            </div>
                        @endif
                       
                        @foreach ($categories as $index => $category)
                        
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h2 class="mb-0">{{ $category->name }}
                                            @if($category->active == 0)
                                                <span class="badge badge-warning ml-2">{{ __('Paused') }}</span>
                                            @endif
                                        </h2>
                                    </div>
                                    <div class="col-auto">
                                        <div class="btn-group" role="group">
                                            @if($canAdd)
                                                <button class="btn btn-sm btn-outline-secondary" type="button" data-toggle="modal" data-target="#modal-new-item" title="{{ __('Add item in') }} {{$category->name}}" onClick=(setSelectedCategoryId({{ $category->id }})) >
                                                   <i class="fa fa-plus"></i> {{ __('Add Item') }}
                                                </button>
                                            @endif
                                            <button class="btn btn-sm btn-outline-secondary" type="button" data-toggle="modal" data-target="#modal-edit-category" title="{{ __('Edit category') }}" data-id="<?= $category->id ?>" data-name="<?= $category->name ?>" >
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            @if($category->active == 1)
                                                <a href="{{ route('categories.pause', $category->id) }}" class="btn btn-sm btn-outline-secondary" title="{{ __('Pause category') }}">
                                                    <i class="fa fa-pause"></i>
                                                </a>
                                            @endif
                                            @if($category->active == 0)
                                                <a href="{{ route('categories.resume', $category->id) }}" class="btn btn-sm btn-outline-secondary" title="{{ __('Resume category') }}">
                                                    <i class="fa fa-play"></i>
                                                </a>
                                            @endif
                                            <form action="{{ route('categories.destroy', $category) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-outline-secondary" type="button" onclick="confirm('{{ __("Are you sure you want to delete this category?") }}') ? this.parentElement.submit() : ''" title="{{ __('Delete') }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                        
                                        @if(count($categories)>1)
                                            <div class="btn-group ml-2" role="group">
                                                @if ($index!=0)
                                                    <a href="{{ route('items.reorder',['up'=>$category->id]) }}" class="btn btn-sm btn-outline-secondary" title="{{ __('Move Up') }}">
                                                        <i class="fas fa-arrow-up"></i>
                                                    </a>
                                                @endif
                                                @if ($index+1!=count($categories))
                                                    <a href="{{ route('items.reorder',['up'=>$categories[$index+1]->id]) }}" class="btn btn-sm btn-outline-secondary" title="{{ __('Move Down') }}">
                                                        <i class="fas fa-arrow-down"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <div class="row row-grid category-items">
                                            @foreach ( $category->items as $item)
                                                <div class="col-lg-6 item mb-4" data-item-id="{{ $item->id }}">
                                                    <a href="{{ route('items.edit', $item) }}" class="text-decoration-none">
                                                        <div class="card shadow-sm border-0 menu-item-card">
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <div class="card-body">
                                                                        <div>
                                                                            <h4 class="item-title">{{ $item->name }}</h4>
                                                                            @if($item->available == 0)
                                                                                <span class="badge badge-danger">{{ __("UNAVAILABLE") }}</span>
                                                                            @endif
                                                                            <p class="item-description">{{ $item->description }}</p>
                                                                        </div>
                                                                        <div class="item-price">
                                                                            @money($item->price, config('settings.cashier_currency'),config('settings.do_convertion'))
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 item-image-wrapper">
                                                                    <img class="item-image" src="{{ $item->logom }}" alt="{{ $item->name }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach
                                            @if($canAdd)
                                            <div class="col-lg-6 mb-4">
                                                <a data-toggle="modal" data-target="#modal-new-item" href="javascript:void(0);" onclick=(setSelectedCategoryId({{ $category->id }})) class="text-decoration-none">
                                                    <div class="card shadow-sm border-0 add-item-card">
                                                        <div class="text-center">
                                                            <i class="fa fa-plus-circle fa-2x text-gray-400 mb-2"></i>
                                                            <h4 class="item-title mb-0">{{ __('Add item') }}</h4>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
  $("[data-target='#modal-edit-category']").on('click',function() {
    var id = $(this).attr('data-id');
    var name = $(this).attr('data-name');


    
    $('#cat_name').val(name);
    $("#form-edit-category").attr("action", "/categories/"+id);
})
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const categoryContainers = document.querySelectorAll('.category-items');
    
    categoryContainers.forEach(container => {
        new Sortable(container, {
            animation: 150,
            onEnd: function(evt) {
                const categoryId = evt.to.dataset.categoryId;
                var items = Array.from(evt.to.children).map(item => item.dataset.itemId);

                //Remove any item that is null
                items = items.filter(item => item != null);

                console.log(items);
                
                fetch('{{ route('items.reorderitems') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ items: items })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Items reordered successfully');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });
});
</script>
@endsection