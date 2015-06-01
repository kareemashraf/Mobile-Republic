<!DOCTYPE html>
<?php //echo"<pre>"; var_dump($brands); ?> 
<html lang="en">
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
    <div class="container adv-search-container2">
      <form id="search-form" method="post" action="<?php echo base_url().'home/result'; ?>">
            <div id="error-div">
                <?php 
                    $message =  $this->session->userdata('sample'); 
                    if (!empty($message)) {
                      echo $message;
                      $this->session->unset_userdata('sample');
                    }
                ?>
            </div>
        <div class="container">
          <div class="col-md-3">
            <select name="mobile_brand" id="mobile_brand" class="select" tabindex="1">
            <option value="">Select a Brand</option>
            <?php foreach ($brands as $row){ ?>
                <option value="<?php echo $row->phone_id;?>"><?php echo $row->phone; ?></option>
            <?php } ?>
            </select>
          </div>
          <div class="col-md-3">
            <select name="mobile_model" id="mobile_model" class="select" tabindex="2">
              <option  value="">Select Model</option>
              <option class="model_x" value=""></option>
            </select>
          </div>
          <div class="col-md-6">
            <ul class="field">
              <!-- <li>
                <select name="selecta" id="selecta" class="select" tabindex="2">
                  <option value="">Select</option>
                </select>
              </li> -->
              <li>
                <input type="text" id="example_id" name="example_name" value="" />
              </li>
            </ul>
          </div>
        </div>
      <input type="hidden" name="hidden_brand" id="hidden_brand" value="" />
      <input type="hidden" name="hidden_model" id="hidden_model" value="" />
      <input type="hidden" name="hidden_price" id="hidden_price" value="" />
      <button class="btn btn-primary" name="submit" type="submit">Search</button>
      </form> 
        <div class="search-results">
            <h1 class="search-result"></h1>
        </div>
      <div class="search-nav" >
        <a href="<?php echo base_url().'home/get_search'; ?>"><p>Advanced Search</p></a>
        <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
      </div>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url(); ?>dist/js/jquery-1.7.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url(); ?>dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>dist/js/ion.rangeSlider.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>dist/js/jquery.selectbox-0.2.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>dist/js/custom.js"></script>
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
    $("#mobile_brand").change(function(){
       //hidden_brand   = $('#hidden_brand').html();
          var brand   =  $('#mobile_brand').val();
          var price   =  $('#example_id').val();
          var model   =  $('#mobile_model').val();
          $('#hidden_brand').val(brand);
          $('#hidden_model').val(model);
          $('#hidden_price').val(price);
          $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url().'home/model' ?>', 
                    data: { brand: brand,model: model,price: price },
                    success: function(result) {
                       //alert(result);
                        
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

//

 $("#search-form").change(function(){
         var price   =  $('#example_id').val();
         var model   =  $('#mobile_model').val();
         var brand   =  $('#mobile_brand').val();
         $('#hidden_brand').val(brand);        
         $('#hidden_model').val(model);
         $('#hidden_price').val(price);
        
        
          $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url().'home/numbers' ?>', 
                    data: { price: price,model: model,brand: brand },
                    success: function(results) {
                    //alert(results)
                     var results = $.parseJSON(results);
                     //alert(result[0].total); 
                     console.log(results)
                       if (results[0].total == 0) {  $('.search-result').text('No Available model ') }
                        else { $('.search-result').text(results[0].total) }

                    }

          });
    });
  

  });

    </script>
  </body>
</html>