@extends('Layouts.master')

@section('main-content')
<div class="content-page py-5">
    <div class="container">
        <h1>{{$pageObj->title}}</h1>
        <div class="fc-page">
            {!! $pageObj->content !!}
        </div>
    </div>
</div>
@endsection

@section('page-css')
@endsection

@section('page-js')
<script>
    $(function(){
        'use strict'
    });
</script>
@endsection