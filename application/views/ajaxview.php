<?php
$colors = array('blue','gray','green','orange','purple','red','b-blue','yellow','brown','gray');

 foreach ($results as $key => $result) { 
  $price1 = str_replace("a month", "", $result->price);
?>
       <div class="col-md-offset<?php echo ( ($key % 5) == 0 ) ? '-1' : ''; ?> col-md-2 col-sm-3">
        <input type="hidden" name="iframe" id="iframe_url" value="<?php echo $result->url; ?>"> <!-- the url of the offer -->
          <div class="mobile-box gradient <?php echo ($key > 9) ? $colors[($key - (10 * floor($key / 10)))] : $colors[$key]; ?>"> 
            <span class="overlay">
              <h1 class="price"><?php echo $price1;  ?>£</h1>
              <p ><?php echo $result->type; ?></p>
              <p><strong><?php echo $result->minutes; ?></strong></p>
              <p><strong><?php echo $result->text; ?></strong> </p>
              <p><?php echo $result->data; ?></p>
              <p><strong><?php echo $result->contract_length; ?></strong></p>
            <input type="hidden" id="name_hidden" value="<?php echo $result->type; ?>">
              <a class="btn btn-primary view-btn gradient blue" id="view_btn" role="button" data-toggle="modal" data-target="#myModal">View</a>
            </span>
             <h1 class="price"><?php echo $price1;  ?>£</h1>
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