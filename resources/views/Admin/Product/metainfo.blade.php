{{ Form::open(['route' => ['admin.metainfo.update', ['id' => $product->id]], 'id' => 'metaFrom', 'data-parsley-validate', 'files' => true, 'autocomplete' => 'off']) }}
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
                <div class="col-6">
                    <div class="mb-3">
                    <label for="meta_title" class="form-label">Meta Title</label>
                        {{Form::textarea('meta_title',$product->meta_title, ['class' => 'form-control', 'placeholder' => 'Enter Meta Title', 'id' => 'meta_title','rows'=> 3])}}
                    </div>
                </div>    
                <div class="col-6">
                    <div class="mb-3">
                    <label for="meta_keyword" class="form-label">Meta Keyword</label>
                        {{Form::textarea('meta_keyword',$product->meta_keyword, ['class' => 'form-control', 'placeholder' => 'Enter Meta keyword', 'id' => 'meta_title','rows'=> 3])}}
                    </div>
                </div>
            </div>    
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        {{Form::textarea('meta_description',$product->meta_description, ['class' => 'form-control', 'placeholder' => 'Enter Meta Description', 'id' => 'meta_title','rows'=> 3])}}
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
    </div>
{{ Form::close() }}