{{ Form::open(['route' => ['admin.product.update', ['id' => $product->id]], 'id' => 'productFrom', 'data-parsley-validate', 'files' => true, 'autocomplete' => 'off']) }}
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
                <div class="col-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        {{Form::text('name',$product->name, ['class' => 'form-control', 'placeholder' => 'Enter Name', 'id' => 'name', 'required'])}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-9">
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                        {{Form::text('slug',$product->slug, ['class' => 'form-control', 'placeholder' => 'Enter Slug', 'id' => 'slug', 'required', 'data-parsley-slug'=>"true", 'data-parsley-slug-message'=>"Please provide a unique slug"])}}
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        @php($status = array('Active' => 'Active', 'Inactive' => 'Inactive'))
                        {{Form::select('status', $status,$product->status,['class' => 'form-select', 'required'])}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="mb-3">
                        <label for="product_type" class="form-label">Product Type <span class="text-danger">*</span></label>
                        {{Form::select('product_type', $product_type,$product->product_type,['class' => 'form-select','placeholder' => 'Please Select','required'])}}
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="product_used_in" class="form-label">Product Used In <span class="text-danger">*</span></label>
                        {{Form::select('product_used_in', $product_use_in,$product->product_used_in,['class' => 'form-select','placeholder' => 'Please Select','required'])}}
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="product_use_type" class="form-label">Product Used Type <span class="text-danger">*</span></label>
                        {{Form::select('product_use_type', $product_use_type,$product->product_use_type,['class' => 'form-select','placeholder' => 'Please Select','required'])}}
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="product_usage" class="form-label">Product Usage <span class="text-danger">*</span></label>
                        {{Form::select('product_usage', $product_usage,$product->product_usage,['class' => 'form-select','placeholder' => 'Please Select','required'])}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="mb-3">
                        <label for="device_code" class="form-label">Device Code <span class="text-danger">*</span></label>
                        {{Form::text('device_code', $product->device_code, ['class' => 'form-control', 'placeholder' => 'Enter Device Code', 'id' => 'device_code', 'required'])}}
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-3">
                        <label for="colour" class="form-label">Colour <span class="text-danger">*</span></label>
                        {{Form::text('colour',$product->colour, ['class' => 'form-control', 'placeholder' => 'Enter Colour', 'id' => 'colour', 'required'])}}
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-3">
                        <label for="wattage" class="form-label">Wattage <span class="text-danger">*</span></label>
                        {{Form::text('wattage',$product->wattage, ['class' => 'form-control', 'placeholder' => 'Enter Wattage', 'id' => 'wattage', 'required'])}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="short_description" class="form-label">Short Description</label>
                        {{Form::textarea('short_description',$product->short_description, ['class' => 'form-control', 'placeholder' => 'Enter Short Description', 'id' => 'short_description','rows'=> 3])}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        {{Form::textarea('description',$product->description,['class' => 'form-control ckeditor-classic','placeholder' => 'Enter Description', 'id' => 'description'])}}
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
    </div>
    <!--end col-->
</div>
{{ Form::close() }}  
