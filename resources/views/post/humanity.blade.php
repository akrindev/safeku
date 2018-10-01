
<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
    <!-- Generated: 2018-04-16 09:29:05 +0200 -->
    <title>Human verification</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">

    <!-- Dashboard Core -->
    <link href="/assets/css/app.min.css" rel="stylesheet" />
    <script src="/assets/js/jquery.min.js"></script>
     <script src="/assets/js/core.js"></script>
  </head>
  <body class="">
    <div class="page">
      <div class="page-content">
        <div class="container text-center">
          <div class="display-1 text-muted mb-5"><i class="si si-exclamation"></i> Are you a human?</div>
          <h1 class="h2 mb-3 text-red">Human verification</h1>
         <form action="/read/{{ $to->slug }}" method="post">
          @csrf
           <input type="hidden" name="val" value="{{ request('v') }}">
         <button class="btn btn-outline-primary btn-pill" type="submit">Verify</button>
         </form>
        </div>
      </div>
    </div>
  </body>
</html>