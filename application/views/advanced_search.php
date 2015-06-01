<!DOCTYPE html>
<html lang="en">
<?php //echo "<pre>"; var_dump($brands);

 ?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mobile Republic</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>dist/css/main.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>dist/css/ion.rangeSlider.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>dist/css/ion.rangeSlider.skinHTML5.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>dist/css/jquery.selectbox.css" type="text/css" rel="stylesheet" />

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
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>dist/img/logo.png"></a>
        </div>
      </div><!-- /.container-fluid -->
    </nav>
    <div class="container adv-search-container">
      <div class="col-md-offset-1 col-md-10">
            <div id="error-div">
                <?php 
                    $message =  $this->session->userdata('sample'); 
                    if (!empty($message)) {
                      echo $message;
                      $this->session->unset_userdata('sample');
                    }

                ?>
            </div>
      <form method="post" id="search-form" action="<?php echo base_url().'home/advanced_result'; ?>" >
            <input type="hidden" name="hidden_brand"   id="hidden_brand"    value="" />
            <input type="hidden" name="hidden_model"   id="hidden_model"    value="" />
            <input type="hidden" name="hidden_price"   id="hidden_price"    value="" />
            <input type="hidden" name="hidden_network" id="hidden_network"  value="" />
            <input type="hidden" name="hidden_contract"id="hidden_contract" value="" />
            <input type="hidden" name="hidden_minutes" id="hidden_minutes"  value="" />
            <input type="hidden" name="hidden_texts"   id="hidden_texts"    value="" />
            <input type="hidden" name="hidden_screen"  id="hidden_screen"   value="" />
            <input type="hidden" name="hidden_camera"  id="hidden_camera"   value="" />
            <input type="hidden" name="hidden_battery" id="hidden_battery"  value="" />
          <div class="col-md-6">
            <select name="mobile_brand" id="mobile_brand" class="select" tabindex="1">
             <option value="">Select a Brand</option>
             <?php foreach ($brands as $row){ ?>
                 <option value="<?php echo $row->phone_id;?>"><?php echo $row->phone; ?></option>
             <?php } ?>
            </select>
          </div>
          <div class="col-md-6">
            <select name="mobile_model" id="mobile_model" class="select" tabindex="2">
              <option  value="">Select Model</option>
              <option class="model_x" value=""></option>
            </select>
          </div>
          <div class="col-md-6">
            <select name="mobile_network" id="mobile_network" class="select" tabindex="1">
              <option value="">Network</option>
                <option value="1">Vodafone</option>
                <option value="2">Orange</option>
                <option value="3">Three</option>
                <option value="4">O2</option>
                <option value="5">T-mobile</option>
                <option value="6">Shebang</option>
                <option value="7">Sainsbury</option>
                <option value="8">Tesco</option>
                <option value="9">Lebara</option>
            </select>
          </div>
          <div class="col-md-6">
            <select name="mobile_contract" id="mobile_contract" class="select" tabindex="2">
              <option value="">Contract Length</option>
                <option value="12">12 Months</option>
                <option value="24">24 Months</option>
                
            </select>
          </div>
          <div class="col-md-6">
              <div class="slider-container">
                  <label class="col-md-3" for="minutes">Minutes</label>
                  <span class="col-md-9 slider-box">
                    <input type="text" id="minutes" name="minutes" value="" />
                  </span>
              </div>
          </div>
          <div class="col-md-6">
            <div class="slider-container">
              <label class="col-md-3" for="texts">Texts</label>
              <span class="col-md-9 slider-box">
                <input type="text" id="texts" name="texts" value="" />
              </span>
            </div>
          </div>
          <div class="col-md-12">
            <div class="slider-container">
              <label class="col-md-2" for="price">Price</label>
              <span class="col-md-10 slider-box">
                <input type="text" id="example_id" name="price" value="" />
              </span>
            </div>
          </div>
          <div class="col-md-12">
            <div class="slider-container" id="screen">
              <label class="col-md-2" for="price">Screen size</label>
              <div class="col-md-10">
                <label class="device" for="small-screen">
                <input checked="true" id="small-screen" type="radio" name="template" value="small">
                <span><i class="glyphicon glyphicon-phone" aria-hidden="true"></i> Small</span>
              </label>
              <label class="device" for="medium-screen">
                  <input id="medium-screen" type="radio" name="template" value="medium">
                <span><i class="glyphicon glyphicon-phone" aria-hidden="true"></i> Medium</span>
              </label>
              <label class="device" for="larg-screen">
                  <input id="larg-screen" type="radio" name="template" value="large">
                  <span><i class="glyphicon glyphicon-phone" aria-hidden="true"></i> Large</span>
              </label>
              <label class="device" for="xlarg-screen">
                  <input id="xlarg-screen" type="radio" name="template" value="xlarge">
                  <span><i class="glyphicon glyphicon-phone" aria-hidden="true"></i> Xlarge</span>
              </label>
              </div>
            </div>
          </div>


          <div class="col-md-12">
            <div class="slider-container">
              <label class="col-md-2" for="camera">Camera PX</label>
              <span class="col-md-10 slider-box">
                <input type="text" id="camera" name="camera" value="" />
              </span>
            </div>
          </div>
          <div class="col-md-12 last-item">
            <div class="slider-container">
              <label class="col-md-2" for="battary">Battary life</label>
              <span class="col-md-10 slider-box">
                <input type="text" id="battary" name="battary" value="" />
              </span>
            </div>
          </div>
          <button class="btn btn-primary" type="submit">Search</button>
          <h1 class="search-result"></h1>
      </form>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url(); ?>dist/js/jquery-1.7.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url(); ?>dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>dist/js/ion.rangeSlider.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>dist/js/jquery.selectbox-0.2.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function($) {
        $("#minutes").ionRangeSlider({
          type: "double",
          min: 0,
          max: 1000,
          from: 0,
          to: 1000,
          grid: false
        });
        $("#texts").ionRangeSlider({
          type: "double",
          min: 0,
          max: 1000,
          from: 0,
          to: 1000,
          grid: false
        });
        $("#price").ionRangeSlider({
          type: "double",
          min: 0,
          max: 1000,
          from: 0,
          to: 1000,
          grid: false,
          prefix: "$"
        });
        $("#camera").ionRangeSlider({
          type: "double",
          min: 0,
          max: 1000,
          from: 0,
          to: 1000,
          grid: false,
          postfix: "PX"
        });
        $("#battary").ionRangeSlider({
          type: "double",
          min: 0,
          max: 1000,
          from: 0,
          to: 1000,
          grid: false,
          postfix: "h"
        });
      });
    </script>
    <script type="text/javascript">
      $(function () {
        $("#mobile_brand").selectbox();
        $("#mobile_model").selectbox();
        $("#mobile_network").selectbox();
        $("#mobile_contract").selectbox();
      });
    </script>
    <script type="text/javascript">
      $(document).ready(function($) {
        $("#example_id").ionRangeSlider({
          type: "double", 
          min: 0,
          max: 1000,
          from: 0,
          to: 1000,
          grid: false,
          prefix: "$"
        });
      });

   //--------- JQuery post ajax on change ---------->
  $(document).ready(function(){
   
// when the brand is changed 

$("#mobile_brand").change(function(){
          var brand          =  $('#mobile_brand').val(); 
          $('#hidden_brand').val(brand);

          $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url().'home/model' ?>', 
                    data: { brand: brand },
                    success: function(result) {
                       // alert(price);
                        
                        $('#mobile_model').selectbox("detach"); 
                        $('.model_x').remove(); 
                       var result = $.parseJSON(result);

                       if (result.length == 0) {  $('.search-result').text('No Available model ') }
                        else { $('.search-result').text(result.length) }

                       for(var i=0;i<result.length;i++){ 
                          $('#mobile_model').append('<option class="model_x" value = '+result[i].item_id+'>'+result[i].type+'</option>')
                        }
                          $('#mobile_model').selectbox("attach");
                    }

          });
    });


// when any of the form details changes

 $("#search-form").change(function(){
         /*hidden_brand   = $('#hidden_brand').html();
         var brand          =  $('#mobile_brand').val();*/
          var price          =  $('#example_id').val();
          var model          =  $('#mobile_model').val();
          var mobile_network =  $('#mobile_network').val();
          var mobile_contract=  $('#mobile_contract').val();
          var minutes        =  $('#minutes').val();
          var texts          =  $('#texts').val();
          var screen_size    =  $('input[name="template"]:checked').val();
          var camera         =  $('#camera').val();
          var battery        =  $('#battary').val();
         
        //  $('#hidden_brand').val(brand);
          $('#hidden_model').val(model);
          $('#hidden_price').val(price);
          $('#hidden_network').val(mobile_network);
          $('#hidden_contract').val(mobile_contract);
          $('#hidden_minutes').val(minutes);
          $('#hidden_texts').val(texts);
          $('#hidden_screen').val(screen_size);
          $('#hidden_camera').val(camera);
          $('#hidden_battery').val(battery);
          /*$.ajax({
                    type: 'POST',
                    //url: '<?php echo base_url().'home/model' ?>', 
                    data: { brand: brand },
                    success: function(result) {
                        alert(price);
                        
                       $('#mobile_model').selectbox("detach"); 
                        $('.model_x').remove(); 
                       var result = $.parseJSON(result);

                       if (result.length == 0) {  $('.search-result').text('No Available model ') }
                        else { $('.search-result').text(result.length) }

                       for(var i=0;i<result.length;i++){ 
                          $('#mobile_model').append('<option class="model_x" value = '+result[i].id+'>'+result[i].type+'</option>')
                        }
                          $('#mobile_model').selectbox("attach");
                    }

          });*/
    });

  

  });

    </script>
  </body>
</html>