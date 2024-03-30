@extends('Layouts.master')

@section('main-content')
<div class="py-3 py-lg-5">
    <div class="container">
        <form action="{{route('products')}}" method="GET" id="product_form">
            <div class="product-listing align-items-start">
                <div class="product-sidebar sticky-lg-top"> 

                    <div class="prodct-count d-flex align-items-center justify-content-end d-lg-none mb-3">
                        <a href="javascript:void(0)" class="d-lg-none close-filter"><img src="{{asset('front/assets/images/bars-filter.svg')}}" alt="filter" width="10" height="5" class="me-2"> Close Filter </a>
                    </div>

                    <div class="accordion accordion-flush" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    Product Categories
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <div class="form-check">
                                        <input class="form-check-input reset-checkbox" type="checkbox" name="all" value="reset" id="flexCheckDefault" @if(empty($request->type) && empty($request->used_id) && empty($request->used_type) && empty($request->usage)) checked @endif >
                                        <label class="form-check-label" for="flexCheckDefault">
                                            All
                                        </label>
                                    </div>
                                    @foreach($productTypes as $key => $type)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type" value="{{$type->name}}" id="flexCheckDefault{{$key}}" @if($request->type == $type->name) checked @endif >
                                        <label class="form-check-label" for="flexCheckDefault{{$key}}">
                                            {{$type->name}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                    Filter by Used In
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    @foreach($productUsedIn as $key => $used)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="used_id" value="{{$used->name}}" id="flexCheckUsed{{$key}}" @if($request->used_id == $used->name) checked @endif>
                                        <label class="form-check-label" for="flexCheckUsed{{$key}}">
                                            {{$used->name}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    Filter by Used Type
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    @foreach($productUsedType as $key => $usedType)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="used_type[]" value="{{$usedType->name}}" id="flexCheckType{{$key}}" @if(!empty($request->used_type) && in_array($usedType->name, $request->used_type)) checked @endif>
                                        <label class="form-check-label" for="flexCheckType{{$key}}">
                                            {{$usedType->name}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                Filter by Usage
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    @foreach($productUsage as $key => $usage)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="usage[]" value="{{$usage->name}}" id="flexCheckUsage{{$key}}" @if(!empty($request->usage) && in_array($usage->name, $request->usage)) checked @endif>
                                        <label class="form-check-label" for="flexCheckUsage{{$key}}">
                                            {{$usage->name}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="plMain">
                    <h1>
                        @if(empty($request->type) && empty($request->used_id) && empty($request->used_type) && empty($request->usage))
                        All
                        @endif

                        <?php 
                        $str = '';
                        if(!empty($request->type)){
                            $str = $request->type;
                        }
                        if(!empty($request->used_id)){
                            $str = !empty($str)?$str.' - '.$request->used_id:$request->used_id;
                        }

                        if(!empty($request->used_type)){
                            $strUsedType = '';
                            foreach($request->used_type as $used_type){
                                $strUsedType = !empty($strUsedType)?$strUsedType.' + '.$used_type:$used_type;
                            }
                            $str = !empty($str)?$str.' - '.$strUsedType:$strUsedType;
                        }

                        if(!empty($request->usage)){
                            $strUsage = '';
                            foreach($request->usage as $usage){
                                $strUsage = !empty($strUsage)?$strUsage.' + '.$usage:$usage;
                            }
                            $str = !empty($str)?$str.' - '.$strUsage:$strUsage;
                        }
                        ?>
                        {{$str}}
                    </h1>
                    <div class="pl-filter d-flex">
                        <div class="prodct-count d-flex align-items-center">
                            <a href="javascript:void(0)" class="me-2 d-lg-none wap-filter">
                                <img src="{{asset('front/assets/images/bars-filter.svg')}}" alt="filter" width="10" height="5">
                            </a> Showing {{($products->firstItem()>0)?$products->firstItem():0}}-{{($products->lastItem()>0)?$products->lastItem():0}} of {{ $products->total() }} results
                        </div>
                        <div class="product-sorting">
                            <select class="form-control form-select border-0 rounded-0 py-0 sort-by-options" name="order_by">
                                <option value="latest" @if(empty($request->order_by) || $request->order_by == 'latest') selected @endif >Sort by latest</option>
                                <option value="old" @if($request->order_by == 'old') selected @endif>Sort by old</option>
                                {{-- <option value="price" @if($request->order_by == 'price') selected @endif>Sort by price</option> --}}
                            </select>
                        </div>
                    </div>

                    <div class="pl-inner py-4">
                        @foreach($products as $product)
                        <div class="products-card">
                            <div class="pc-body position-relative">
                                {{-- <a href="#" class="fav-product"><img src="{{asset('front/assets/images/fav-icon.svg')}}" alt="fav" width="10" height="10"></a> --}}
                                <figure><img src="{{get_image_url(!empty($product->thumbnail)?$product->thumbnail->image:'')}}" alt="{{$product->name}}" width="100" height="100"></figure>
                                <a href="{{route('product.detail', ['slug' => $product->slug])}}" class="btn btn-read-more">More Details</a>
                            </div>
                            <h2>{{$product->name}}</h2>
                        </div>
                        @endforeach

                        @if($products->count() == 0)
                        <h3 class="full-width mt-5 text-center">No product found.</h3>
                        @endif

                    </div>

                    {{ $products->appends($request->toArray())->links('pagination::bootstrap-4') }}

                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('page-css')
{{-- <link href="{{asset('assets/libs/jsvectormap/css/jsvectormap.min.css?v='.env('FILE_VERSION'))}}" rel="stylesheet" type="text/css" /> --}}
@endsection

@section('page-js')
{{-- <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js?v='.env('FILE_VERSION'))}}"></script> --}}

<script>
    $(function(){
        'use strict'

        $(".wap-filter").click(function(){
            $(".product-sidebar").toggle('slide');
            $(".product-sidebar").addClass("showsidebar");
        });

        $(".close-filter").click(function(){
            $(".product-sidebar").toggle('slide');
            $(".product-sidebar").removeClass("showsidebar");
        });

        $(document).on('click', '.form-check-input', function(){
            if($(this).val() != 'reset'){
                $('.reset-checkbox').prop('checked', false);
            }

            $('#product_form').submit();
        });

        $(document).on('change', '.sort-by-options', function(){
            $('.reset-checkbox').prop('checked', false);
            $('#product_form').submit();
        })
    });
</script>
@endsection