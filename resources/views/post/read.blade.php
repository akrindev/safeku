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
            <i class="fe fe-clock"></i> {{ $data->created_at->toDayDateTimeString() }} <i class="fe fe-tag ml-2 mr-1"></i> <a class="text-muted" href="/category/{{ $data->category->name }}">{{ $data->category->name }}</a> </small>
           <hr class="my-2">
          @if (request()->isMethod('post'))
           <div class="text-center"><a href="#generate" class="btn btn-outline-danger generate" id="to-generate">Generate link</a></div>
          @endif
          {!! (new \Parsedown)->text(nl2br(e($data->body))) !!}
         <div class="mt-5"></div>
            @if (request()->isMethod('post'))
       <div class="text-center" id="generate"></div>
            <input type="hidden" id="true-l" value="{{ $data->safe->url }}">
            @endif

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

@section('footer')
@if (request()->isMethod('post'))
<script>
let generate = document.getElementById("to-generate"),
    isDone = document.getElementById("generate"),
    isSafeTrue = document.getElementById("true-l");

  generate.addEventListener('click', e => {
    e.preventDefault();
  	generate.classList.add('btn-loading');

    setTimeout(() => {
      	window.location.href = "#generate";
  		generate.classList.remove('btn-loading');

    	isDone.innerHTML = `<a href="${isSafeTrue.value}" class="btn btn-outline-danger generate" target="_blank">Menuju link</a>`;
    }, 3000);
  });
</script>
@endif
@endsection