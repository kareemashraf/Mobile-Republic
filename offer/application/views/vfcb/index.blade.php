<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vodafone</title>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link href="{{asset('inc_vfcb/css/')}}bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('inc_vfcb/css/')}}main.css" rel="stylesheet">
    <link href="{{asset('inc_vfcb/css/')}}parsley.css" rel="stylesheet">
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!--[if gte IE 9]>
      <style type="text/css">
        .gradient {
          filter: none;
        }
      </style>
    <![endif]-->
  </head>
  <body>
    <img src="{{asset('inc_vfcb/img/')}}vodafone-logo-left.png" id="logo">
    
        <div class="buttons-container hidden-sm hidden-xs">
          <a class="button" id="privacy" href="#">Privacy and cookies <span class="glyphicon glyphicon-triangle-right"></span></a>
          <a class="button" id="login" href="#">Log in to My account <span class="glyphicon glyphicon-triangle-right"></span></a>
        </div>

        <div id="nav-container" role="tabpanel">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation">
              <a href="#personal" aria-controls="personal" role="tab">Personal</a>
            </li>
            <li role="presentation" class="active">
              <a href="#business" aria-controls="business" role="tab" data-toggle="tab">Business</a>
            </li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane" id="personal">...</div>
            <div role="tabpanel" class="tab-pane active" id="business">
              <div class="container">
                <div class="col-md-12">
                  <h1>Vodafone RED Business</h1>
                  <img id="main-banner" class="img-responsive" src="{{asset('inc_vfcb/img/')}}banner.jpg">
                </div>
                <div class="col-md-offset-1 col-md-10">
                  <div class="form-container">
                    <h3>Request a call back</h3>
                    <span>We'll call you back at a time convenient to you.</span>
                    <form class="form-inline" data-parsley-validate>
                      <div class="form-group" style="position: relative;">
                        <input type="text" name="telephone" value="" class="form-control input"  placeholder="Phone number" data-parsley-type="number" required>
                      </div>
                      <button type="submit" class="btn callback-btn">Request a call back</button>
                    </form>
                  </div>
                  <div class="row">
                    <div class="col-md-8">
                      <h3>One Net Lite</h3>
                      <span>All our RED Business plans come with One Net Lite - a <strong>virtual landline number that connects straight to your mobile</strong>.</span>
                      <ul class="dot-dark"><li>Never miss a business call again: bring your landline wherever you are working.</li><li>Reduce costs: no call divert charges.</li></ul>
                    </div>
                    <div class="col-md-4">
                      <img class="img-responsive" src="{{asset('inc_vfcb/img/')}}OneNetLite_icon.jpg">
                    </div>
                  </div>
                  <span>All prices exclude VAT</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="footer">
          <div class="container">
            <div class="col-md-3">
              <h3><a class="ft-trigger ft-active" href="//www.vodafone.ie/aboutus/">Vodafone Ireland</a></h3>
              <ul class="ft-links ft-active">
                <li><a href="//www.vodafone.ie/jobs/">Careers</a></li>
                <li><a href="//www.vodafone.ie/aboutus/news/">News &amp; press releases</a></li>
                <li><a href="//www.vodafone.ie/foundation">Vodafone Ireland Foundation</a></li>
                <li><a href="//www.vodafone.ie/terms/">Terms &amp; Conditions</a></li>
                <li><a href="//www.vodafone.ie/accessibility/">Accessibility</a></li>
                <li><a class="link-arrow" href="//www.vodafone.ie/aboutus/">About us</a></li>
              </ul>
            </div>
            <div class="col-md-3">
              <h3><a class="ft-trigger" href="//www.vodafone.ie/business-support/">Support</a></h3>
              <ul class="ft-links">
                <li><a href="http://deviceguides.vodafone.ie/web/">Help with devices</a></li>
                <li><a href="https://support.vodafone.ie/system/selfservice.controller?CMD=BROWSE_TOPIC&amp;EXPANDED_TOPIC_TREE_NODES=+38567+&amp;MAKE=&amp;MODEL=&amp;COUNTRY=ie&amp;LANGUAGE=en&amp;TOPIC_ID=38567&amp;TOPIC_TYPE=0&amp;STARTING_ID=0&amp;TOPIC_NAME=Mobile+broadband+&amp;PARENT_TOPIC_ID=-1&amp;PARENT_TOPIC_TYPE=0&amp;SOURCE_FORM=TOPIC_TREE&amp;SUBTOPIC=38567&amp;SUB_TOPIC_ID=-1&amp;TOPIC=38567&amp;ShowFaq=1&amp;SIDE_LINK_TOPIC_ID=38567&amp;CONFIGURATION=1011&amp;PARTITION_ID=1&amp;USERTYPE=1">Mobile broadband help</a></li>
                <li><a href="https://support.vodafone.ie/system/selfservice.controller?CMD=BROWSE_TOPIC&amp;EXPANDED_TOPIC_TREE_NODES=+38562+&amp;MAKE=&amp;MODEL=&amp;COUNTRY=ie&amp;LANGUAGE=en&amp;TOPIC_ID=38562&amp;TOPIC_TYPE=0&amp;STARTING_ID=0&amp;TOPIC_NAME=Office+landine+%26+broadband+&amp;PARENT_TOPIC_ID=-1&amp;PARENT_TOPIC_TYPE=0&amp;SOURCE_FORM=TOPIC_TREE&amp;SUBTOPIC=38562&amp;SUB_TOPIC_ID=-1&amp;TOPIC=38562&amp;ShowFaq=1&amp;SIDE_LINK_TOPIC_ID=38562&amp;CONFIGURATION=1011&amp;PARTITION_ID=1&amp;USERTYPE=1">Home phone &amp; broadband</a></li>
                <li><a href="https://support.vodafone.ie/system/selfservice.controller?CMD=VIEW_ARTICLE&amp;CURRENT_CMD=BROWSE_TOPIC&amp;allArticleIds=2067%2C2039%2C2041%2C2108%2C2040%2C2107%2C2068&amp;basicOrAdvanced=basic&amp;SIDE_LINK_TOPIC_ID=2513&amp;SIDE_LINK_SUB_TOPIC_ID=2515&amp;SIDE_LINK_TOPIC_INDEX=&amp;SIDE_LINK_SUB_TOPIC_INDEX=&amp;userInput=&amp;isSortingReq=0&amp;sortOrder=&amp;sortOn=&amp;nextPageNo=&amp;currPageNo=1&amp;totalPages=1&amp;USEFUL_ITEMS_FRAME_TITLE=&amp;COUNTRY=ie&amp;LANGUAGE=en&amp;ARTICLE_ID=2036&amp;CONFIGURATION=1003&amp;PARTITION_ID=1&amp;EXPANDED_TOPIC_TREE_NODES=+2513+&amp;USERTYPE=1">Phone repairs</a></li>
                <li><a class="link-arrow" href="//www.vodafone.ie/business-support/">All help topics</a></li>
              </ul>
            </div>
            <div class="col-md-3">
              <h3><a class="ft-trigger" href="//www.vodafone.ie/index.jsp?site=business">Our services</a></h3>
              <ul class="ft-links">
                <li><a href="//www.vodafone.ie/small-business/">Small business</a></li>
                <li><a href="//www.vodafone.ie/medium-large-business/">Medium-large business</a></li>
                <li><a href="//www.vodafone.ie/medium-large-business/public-sector/">Public sector</a></li>
                <li><a href="//www.vodafone.ie/partners/">Partner programme</a></li>
                <li><a href="//www.vodafone.ie/aboutus/affiliates/">Affiliate programme</a></li>
              </ul>
            </div>
            <div class="col-md-3">
              <h3><a class="ft-trigger" href="//www.vodafone.ie/helpsupport/contactus/">Contact us</a></h3>
              <ul class="ft-links">
                <li><a href="//www.vodafone.ie/business-support/contact-us">Email or call us</a></li>
                <li><a href="https://community.vodafone.ie">Join our Community</a></li>
                <li><a href="//www.vodafone.ie/df/store-locator/">Find a store</a></li>
                <li><a href="https://twitter.com/VodafoneIEbiz">Follow us on Twitter</a></li>
              </ul>
            </div>
          </div>
        </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset('inc_vfcb/js/')}}bootstrap.min.js"></script>
    <script src="{{asset('inc_vfcb/js/')}}parsley.min.js"></script>
    <script type="text/javascript">
      //$('#form').parsley();
    </script>
  </body>
</html>