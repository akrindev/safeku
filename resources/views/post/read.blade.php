@extends('layouts.tabler_blog')

@section('title', $data->title)
@section('description', e($data->body))

@section('content')
<div class="my-5">
  <div class="container">

    <div class="row">
      <div class="col-12 mb-5 h3">
        {{ $data->title }}
      </div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-body p-3">
         <small class="text-muted">Posted by: {{ $data->user->name }} <br>
            <i class="fe fe-clock"></i> {{ $data->created_at->toDayDateTimeString() }} <i class="fe fe-tag ml-2 mr-1"></i> {{ $data->category->name }} </small>
           <hr class="my-2">
          {!! (new \Parsedown)->text(nl2br(e($data->body))) !!}

          </div>
        </div>
      </div>

      <!-- random  post -->
      <div class="col-md-4">

         @include('inc.random_post')
      </div>
    </div>
  </div>
</div>
@endsection