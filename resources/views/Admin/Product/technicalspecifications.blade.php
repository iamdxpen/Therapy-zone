{{ Form::open(['route' => ['admin.technicalspecifications.update', ['id' => $product->id]], 'id' => 'metaFrom', 'data-parsley-validate', 'files' => true, 'autocomplete' => 'off']) }}
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
            @foreach($technical_specifications as $technical_specification)
                <div class="row">
                    {{ Form::hidden('technical_specifications['.$technical_specification->id.'][id]', $technical_specification->id) }}
                    <div class="col-3">
                        <div class="mb-3">
                            {{ Form::text('technical_specifications['.$technical_specification->id.'][name]', $technical_specification->name, ['class' => 'form-control', 'readonly']) }}
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="mb-3">
                            {{ Form::text('technical_specifications['.$technical_specification->id.'][value]', isset($technical_specification->productTechnicalSpecifications) ? $technical_specification->productTechnicalSpecifications->value : '', ['class' => 'form-control', 'placeholder' => 'Enter Value']) }}
                        </div>
                    </div>                       
                </div>
            @endforeach   
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