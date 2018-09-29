@php
$rand = App\Post::inRandomOrder()->take(5)->get();
@endphp


<div class="mt-5">
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Random post</h3>
  </div>
  <div class="card-body p-3">
  @foreach ($rand as $r)
  - <a href="/read/{{ $r->slug }}">{{ $r->title }}</a> <br>
@endforeach
  </div>
</div>
</div>