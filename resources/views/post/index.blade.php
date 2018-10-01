@extends('layouts.tabler_blog')

@section('title', 'Home')

@section('content')
<div class="my-5">
   <div class="container">
     <div class="page-header">
       <h1 class="page-title">{{ 'Latest posts' }}</h1>
     </div>
   <div class="row row-cards row-deck">
     @foreach ($posts as $post)
      <div class="col-sm-6 col-xl-3">
         <div class="card">
           <!-- <a href="/read/{{ $post->slug }}"><img class="card-img-top" src="{{ to_img($post->body) }}" alt="And this isn&#39;t my nose. This is a false one."></a>-->
              <div class="card-body d-flex flex-column">
                 <h4><a href="/read/{{ $post->slug }}">{{ $post->title }}</a></h4>
                    <div class="text-muted">{{ str_limit($post->body) }}</div>
                    <div class="d-flex align-items-center pt-5 mt-auto">

                      <div>
                        <small class="d-block text-muted"><i class="fe fe-clock"></i> {{ $post->created_at->toDayDateTimeString() }} <i class="fe fe-tag ml-2"></i> {{ $post->category->name }} </small>
                      </div>
                      <div class="ml-auto text-muted">
                        <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
      </div>
     @endforeach

     <div class="col-12">
     {{ $posts->links() }}
     </div>
   </div>
  </div>
</div>
@endsection