{{ Form::open(['route' => ['admin.image.update', ['id' => $product->id]], 'id' => 'imageFrom', 'data-parsley-validate', 'files' => true, 'autocomplete' => 'off']) }}
<div class="row">
    <div class="col-lg-12">
        @if(Session::has('error'))
        <div class="alert alert-danger mb-2" product="alert">{{ Session::get('error') }}</div>
        @endif

        @if(Session::has('success'))
        <div class="alert alert-success mb-2" product="alert">{{ Session::get('success') }}</div>
        @endif

        @foreach ($errors->all() as $error)
        <div class="alert alert-danger mb-2" product="alert">{!! $errors->first() !!}</div>
        @endforeach
        <div class="row">
            <div class="col-3">
                <div class="mb-3">
                    <label for="image" class="form-label">Image<span class="text-danger">*</span> </label>
                    {{Form::file('image[]', ['class' => 'form-control', 'placeholder' => 'Select image', 'id' => 'image','required', 'multiple'])}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($product->images as $img)
            <div class="col-3">
                <div class="card">
                <img class="card-img-top img-fluid" src="{{asset($img->image)}}" alt="Card image cap">
                <div class="card-footer p-0">
                    <div class="input-group">
                    @if($img->is_main == 1)
                        <span class="alert alert-success input-group-text border-0 rounded-0">
                            <i class=" ri-home-4-fill label-icon"></i>
                        </span>
                    @else
                        <button class="alert alert-danger input-group-text border-0 rounded-0 main-image-button" data-id="{{ $img->id }}">
                            <i class=" ri-home-4-fill label-icon"></i>
                        </button>
                    @endif
                        <span class="input-group-text border-0 rounded-0" id="basic-addon1">Display Order</span>
                        {{Form::text('display_order', $img->display_order, ['class' => 'form-control border-0 rounded-0 display_order', 'data-id' => $img->id])}}
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="javascript:void(0)" class="card-link link-danger remove-image" data-id="{{$img->id}}">Remove <i class="ri-delete-bin-line align-middle ms-1 lh-1"></i></a>
                </div>
                </div>
            </div>  
            @endforeach
        </div>   
    </div>
    <!--end col-->
</div>
{{ Form::close() }}  
