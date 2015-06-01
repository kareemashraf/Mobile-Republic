<!DOCTYPE html>
<?php $colors = array('blue','gray','green','orange','purple','red','b-blue','yellow','brown','gray'); ?>
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
    <div class="container-fluid">
        <div class="result-search-block col-md-offset-1 col-md-10 col-sm-12">
        <form method="post">
          <input type="hidden" name="minutes" id="hidden_minutes" value="" />
          <input type="hidden" name="texts"   id="hidden_texts"   value="" />
          <input type="hidden" name="price"  id="hidden_price"    value="" />
          <input type="hidden" name="duration" id="hidden_duration" value="" />
        </form>
          <div class="row result-search-block" id="result_change">
            <div class="col-md-3 col-sm-12">
              <div class="slider-container">
                <label class="col-md-3  col-sm-2" for="minutes">Minutes</label>
                <span class="col-md-9  col-sm-10 slider-box">
                  <input type="text" id="minutes" name="minutes" value="" />
                </span>
              </div>
            </div>
            <div class="col-md-3 col-sm-12">
              <div class="slider-container">
                <label class="col-md-3" for="texts">Texts</label>
                <span class="col-md-9 slider-box">
                  <input type="text" id="texts" name="texts" value="" />
                </span>
              </div>
            </div>
            <div class="col-md-3 col-sm-12">
              <div class="slider-container">
                <label class="col-md-3" for="price">price</label>
                <span class="col-md-9 slider-box">
                  <input type="text" id="price" name="price" value="" />
                </span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="slider-container">
                <label class="col-md-3" for="month">Duration</label>
                <span class="col-md-9 slider-box">
                  <input type="text" id="month" name="month" value="" />
                </span>
              </div>
            </div>
          </div>
        </div>
        <!--  -->
        <div id="datacontent">
<?php foreach ($results as $key => $result) { 
  $price1 = str_replace("a month", "", $result->price);
?>
       <div class="col-md-offset<?php echo ( ($key % 5) == 0 ) ? '-1' : ''; ?> col-md-2 col-sm-3">
        <input type="hidden" name="iframe" id="iframe_url" value="<?php echo $result->url; ?>"> <!-- the url of the offer -->
          <div class="mobile-box gradient <?php echo ($key > 9) ? $colors[($key - (10 * floor($key / 10)))] : $colors[$key]; ?>"> 
            <span class="overlay">
              <h1 class="price"><?php echo $price1;  ?>£</h1>
              <!-- <p ><?php //echo $result->type; ?></p> -->
              <p><strong><?php echo $result->minutes; ?></strong> Minutes</p>
              <p><strong><?php echo $result->text; ?></strong> Texts</p>
              <p><?php echo $result->data; ?> Data</p>
              <p><strong><?php echo $result->contract_length; ?></strong> Months</p>
            <input type="hidden" id="name_hidden" value="<?php echo $result->type; ?>">
              <a class="btn btn-primary view-btn gradient blue" id="view_btn" role="button" data-toggle="modal" data-target="#myModal">View</a>
            </span>
             <h2 class="price"><?php echo $price1;  ?>£</h2>
             <img src="http://cdn2.gsmarena.com/vv/bigpic/<?php echo $result->image; ?>">
             <?php if ( $result->network_id == 1) { ?>
             <img src="<?php echo base_url(); ?>dist/img/voda_small.png">
             <?php }elseif ($result->network_id == 2) {  ?>
              <img src="<?php echo base_url(); ?>dist/img/orange_small.png">
              <?php }elseif ($result->network_id == 3) {  ?>
              <img src="<?php echo base_url(); ?>dist/img/3_small.png">
               <?php }elseif ($result->network_id == 4) {  ?>
              <img src="<?php echo base_url(); ?>dist/img/o2_small.png">
              <?php }elseif ($result->network_id == 5) {  ?>
              <img src="<?php echo base_url(); ?>dist/img/tmobile_small.png">
               <?php }elseif ($result->network_id == 7) {  ?>
              <img src="<?php echo base_url(); ?>dist/img/s_small.png">
              <?php }elseif ($result->network_id == 8) {  ?>
              <img src="<?php echo base_url(); ?>dist/img/tesco_small.png">
              <?php } ?>
          </div>
        </div>
        <?php } ?>
        </div>
       

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><img src="<?php echo base_url(); ?>dist/img/close.png"></span></button>

      <div class="modal-body">
         <iframe  src="<?php echo $result->url; ?>" style="zoom:0" width="100%" height="500" frameborder="0"></iframe> 
      </div>
    
    </div>
  </div>
</div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
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
          max: 100,
          from: 0,
          to: 100,
          grid: false
        });
        $("#month").ionRangeSlider({
          type: "double",
          min: 0,
          max: 48,
          from: 0,
          to: 48,
          grid: false,
          postfix: " month"
        });
        $("#battary").ionRangeSlider({
          type: "double",
          min: 0,
          max: 1000,
          from: 0,
          to: 1000,
          grid: false
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

    $(document).ready(function(){
        $("#view_btn").click(function(){
          var name   =  $('#name_hidden').val();
          var url    =  $('#iframe_url').val();
          $('.modal-body').html(' <iframe src="'+url+'" style="zoom:0" width="100%" height="500" frameborder="0"></iframe>');
          
        });

       $("#result_change").change(function(){
          var minutes        =  $('#minutes').val();
          var texts          =  $('#texts').val();
          var price          =  $('#price').val();
          var duration       =  $('#month').val();
         

          $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url().'home/result_update' ?>', 
                    data: {minutes: minutes,texts: texts,price: price,duration: duration},
                    success: function(results) {
                     
                          $('#datacontent').html(results);
                    }

          });
    });


    });

    </script>
  </body>
</html>