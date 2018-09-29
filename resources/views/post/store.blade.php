@extends('layouts.tabler')

@section('title','Create New Post')
@section('content')
<link rel="stylesheet" href="/assets/plugins/md/simplemde.min.css">

<div class="my-3 my-md-5">

<div class="container">
  <div class="page-header">
    <h1 class="page-title">Create new post</h1>
  </div>

<div class='row'>
  <div class="col-md-8">
    <div class="card">

      <div class="card-header">
        <h3 class="card-title">Create New Post</h3>
      </div>

      <div class="card-body">
      <form action="" method="post" id="form-post">

        @csrf

      <div class="form-group">
        <label>Judul</label>
        <input type="text" name="title" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Content</label>
        <textarea id="sectionBody" name="body" class="form-control" data-provide="markdown" rows=10 required></textarea>
        <div class="help-block">
          <small class="text-muted">Markdown supported!</small>
        </div>
      </div>


      <div class="form-group">
        <label class="form-label">Category</label>

            <div class="selectgroup selectgroup-pills">
          @foreach ((new App\Category)->get() as $tag)
                          <label class="selectgroup-item">
                            <input type="radio" name="category" value="{{ $tag->id }}" class="selectgroup-input">
                            <span class="selectgroup-button">{{ $tag->name }}</span>
                          </label>
          @endforeach
        </div>
        </div>
      <button type="submit" class="btn btn-primary" id="btn-publish">Publish</button>

     </form>

    </div>
  </div>
</div>

    </div>
  </div>
</div>

@endsection

@section('head')

<link href="/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css">
<script src="/assets/js/bootstrap-markdown.js">
</script>
<script src="/assets/js/markdown.js">
</script>
<script src="/assets/js/to-markdown.js">
</script>

<link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/nprogress.css" />
<style type="text/css">
  #nprogress .bar {
    background: red !important;
  }
  #nprogress .peg {
    box-shadow: 0 0 10px red, 0 0 5px red !important;
  }
  #nprogress .spinner-icon {
    border-top-color: red !important;
    border-left-color: red !important;
  }
</style>
@endsection

@section('footer')
<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="//unpkg.com/axios/dist/axios.min.js"></script><script src="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/index.js"></script>

<script type="text/javascript">
  loadProgressBar();
</script>

<script>
let formPost = document.getElementById("form-post"),
    btnPublish = document.getElementById("btn-publish");

  formPost.addEventListener('submit', e => {
  	e.preventDefault();

    let data = new FormData(e.target);

    btnPublish.classList.add("btn-loading")

    axios.post('/store/post', data)
    .then(res => {
      if(res.data.success) {
        swal("post berhasil di terbitkan", {
        	icon: 'success'
        }).then(() => window.location.href = '/read/'+res.data.slug);
      }

    }).catch(err => alert(err))
    .finally(() => btnPublish.classList.remove("btn-loading"));
  });
</script>

@endsection