<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('inc_ipraynow/')}}/favicon.ico">

    <title>iPrayNow</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('inc_ipraynow/')}}css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('inc_ipraynow/')}}css/cover.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="main-container">
      <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#"><img src="{{asset('inc_ipraynow/')}}img/logo.png"></a>
        </div>      
        <ul class="nav navbar-nav navbar-right">
          <li id="sis">by SISTERS</li>
        </ul>
      </div>
    </nav>
    <div class="container">
      <div class="col-md-offset-1 col-md-7">
        <div class="form">
          <h1 id="title-1">Jazak Allahu khairan...</h1>
          <h1 id="title-2">You'll receive an sms soon with a link to the app</h1>

          <h3 id="sub">You can also receive our latest DuaCard every morning by email & let us share the thawaab!</h3>
            <form class="form-inline" method="post">
              <div class="form-group">
                <input type="text" name="fullname" class="form-control" placeholder="Enter your name">
              </div>
              <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Enter your email">
              </div>
              <button type="submit" name="submit" class="btn btn-primary">Send me DuaCard</button>
          </form>
        </div>
      </div>
      <div class="col-md-3">
        <div class="mobile-screen">
          <img class="img-responsive" src="{{asset('inc_ipraynow/')}}img/dua.png">
        </div>
      </div>
    </div>

    <div class="footer">
      <p>iPrayNow 2015 copy rights protected</p>
    </div>
    </div>
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="{{asset('inc_ipraynow/')}}js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="{{asset('inc_ipraynow/')}}js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
