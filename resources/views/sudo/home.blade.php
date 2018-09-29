@extends('layouts.tabler')

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title">Analytics</h1>
    </div>

    <!-- //analytics -->
    <div class="row">
      <!-- // total safelink -->
      <div class="col-md-4">
        <div class="card p-3">
          <div class="d-flex align-items-center">
            <span class="stamp stamp-md bg-green mr-3">
              <i class="fe fe-shield"></i>
            </span>
          <div>
            <h4 class="m-0"><a href="javascript:void(0)">{{ auth()->user()->safelink->count() }}
            <small>Safe links</small></a></h4>
            <small class="text-muted">The protected links</small>
          </div>
          </div>
        </div>
      </div>
      <!-- // total post -->
      <div class="col-md-4">
        <div class="card p-3">
          <div class="d-flex align-items-center">
            <span class="stamp stamp-md bg-red mr-3">
              <i class="fe fe-book"></i>
            </span>
          <div>
            <h4 class="m-0"><a href="javascript:void(0)">{{ auth()->user()->post->count() }} <small>Posted articles</small></a></h4>
            <small class="text-muted">The articles</small>
          </div>
          </div>
        </div>
      </div>
    </div>

    <!-- info -->
    <div class="row">
      <!-- safe the link -->
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Safe the link</h3>
          </div>
          <div id="url-info"></div>
          <div class="card-body p-3" style="font-size:13px;font-weight:400">
            <form action="/shorten" method="post" id="shorten">
            @csrf

              <div class="form-group">
                <label class="form-label">Link</label>
                <input type="url" class="form-control" name="url" placeholder="Your url to protect" required>
              </div>

              <div class="form-group">
                <button class="btn btn-outline-primary btn-pill" type="submit" id="shorten-btn"><i class="fe fe-shield"></i> Protect now</button>
              </div>

            </form>

            <div class="form-group">
              <a href="/store/post" class="btn btn-outline-primary mt-5"><i class="fe fe-plus"></i> Create new post</a>
            </div>
          </div>
        </div>
      </div>

      <!-- the links -->
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Latest shorten</h3>
          </div>
          @if ($links->count() == 0)
            <b class="p-5">belum ada short link</b>
          @endif
         <table class="card-table table table-striped" style="font-size:13px;font-weight:400">
           @foreach ($links as $link)
           <tr>
             <td class="p-2"><div> <a href="/?v={{ $link->shorten }}">{{ url('?v='.$link->shorten) }}</a> <br> <small class="text-muted">{{ $link->url }} <span class="text-right ml-2"> <i class="fe fe-clock"></i> {{ $link->created_at->toDayDateTimeString() }}</span> </small> </div></td>
           </tr>
           @endforeach
         </table>
        </div>
      </div>
    </div>

    <!-- post & category-->
    <div class="row">
      <!-- posts -->
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Posts</h3>
          </div>
          @if ($posts->count() == 0)
            <b class="p-5">belum ada post</b>
          @endif
          <table class="card-table table table-striped">
          @foreach ($posts as $post)
            <tr>
              <td class="p-2"><div> <a href="/{{ $post->slug }}"> {{ $post->title }}</a> <br> <small class="text-muted">{{ $post->created_at->toDayDateTimeString() }}</small> </div></td>
            </tr>
          @endforeach
          </table>
        </div>
          {{ $posts->links() }}
      </div>

      <!-- categories -->
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Category post</h3>
          </div>
          <div class="card-body p-3" style="font-size:13px;font-weight:400">
            <form action="/store/category" id="category-form" method="post">

              <div class="form-group">
                <label class="form-label">Category</label>
                <input type="text" class="form-control" name="name" required>
              </div>

              <div class="form-group">
                <button class="btn btn-outline-primary btn-pill" type="submit" id="category-btn"><i class="fe fe-tag"></i> Add category</button>
              </div>

            </form>
            <hr class="my-1">
            <div id="categories-list" class="dimmer active o-auto" style="height:150px">
              <div class="loader"></div>
              <div class="dimmer-content"></div>
            </div>

          </div>
        </div>
      </div>
    </div>


  </div>
</div>
@endsection

@section('head')
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
  let shorten = document.getElementById("shorten"),
      categoryForm = document.getElementById("category-form"),
      cBtn = document.getElementById("category-btn"),
      btnShorten = document.getElementById("shorten-btn"),
      urlInfo = document.getElementById("url-info");

  shorten.addEventListener('submit', e => {
  	e.preventDefault();

    btnShorten.classList.add('btn-loading');

    let data = new FormData(e.target);


    axios.post('/shorten', data)
    .then(response => {
      if(response.data.success){
        swal("Url has been protected",{
        	icon: 'success'
        }).then(() => {
        	urlInfo.innerHTML = `<div class="card-alert alert alert-success"><strong>Success!</strong><br /> <br />
Link: <b>${response.data.shorten}</b></div>`;
        });
      } else {
        swal("url field is required!", {
        	icon: 'error'
        });
      }

    }).catch(err => alert(err))
    .finally(() => {
      btnShorten.classList.remove('btn-loading')
      shorten.reset()
    });
  });

  categoryForm.addEventListener('submit', e => {
  	e.preventDefault();

    let data = new FormData(e.target);
    cBtn.classList.add('btn-loading');


    axios.post('/store/category', data)
    .then(response => {
      if(response.data.success){
        swal("nee category has been added", {
        	icon: 'success'
        }).then(() => loadCategory());
      }

    }).catch(err => alert(err))
      .finally(() => {
      	cBtn.classList.remove('btn-loading')
      	categoryForm.reset()
      });

  });

function loadCategory() {
  axios.get('/fetch/category')
  .then(res => {
    const cList = document.getElementById("categories-list");
    cList.innerHTML = ''
    cList.classList.remove('active')

  	res.data.map(item => {
    	cList.innerHTML += `- ${item.name} <br>`;
    });
  }).catch(err => alert(err));
}
  loadCategory()
</script>

@endsection