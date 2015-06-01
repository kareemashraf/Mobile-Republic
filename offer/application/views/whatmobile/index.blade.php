<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="stylesheet" href="{{asset('inc_whatmobile/')}}css/style.css">
        <link rel="stylesheet" type="text/css" href="{{asset('inc_whatmobile/')}}css/counter.css" />

        <script src="{{asset('inc_whatmobile/')}}js/libs/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        
        <div class="container_12">
            <div class="grid_12" id="cont">

                <div class="grid_8" id="bnr">
                </div><!--Red_Banner-->

                <div id="InputForm" class="grid_4">
                    <form method='post' action=''>
                        <div id="form-title"></div>
                        <div id="errorDiv1" class="error-div">
                        <?php 
                        if (!empty($error)) {
                            echo $error; 
                        }
                        ?>
                        </div>
                        <ul>
                            <li>
                                <input type="text" name="fullname" class="input req-min" minlength="3" maxlength="60" value="<?php echo $fullname; ?>" placeholder="First and Last Name"/>
                            </li>
                            <li style="width: 128px; margin-right: 141px;">
                                <input style="width: 124px;" style="width: 124px;" type="text" name="telephone" value="<? echo $telephone; ?>" class="input req-numeric req-min" minlength="3" maxlength="40" placeholder="Phone">
                            </li>
                            <li style="width: 100px; margin-right: 19px; margin-top: -50px;">
                                <input style="width:94px;" style="width: 97px;" name="postcode" value="<? echo $postcode; ?>" class="input req-min" minlength="3" maxlength="40" type="text" placeholder="Post code">
                            </li>
                            <li>
                                <input type="email" name="email" class="input req-min req-email" minlength="3" maxlength="40" value="<? echo $email; ?>" placeholder="Email"/>
                            </li>
                            <li>
                                <input name="address" class="input req-min" value="<? echo $address; ?>"  minlength="3" maxlength="100" type="text" alt=""   placeholder="Address"/>
                            </li>
                            <li>
                                <select name="county">
                                 <option value="<?php echo $country; ?>" selected="selected"> <?php echo $country; ?> </option>
                                </select>
                            </li>    
                        </ul>
                            <h5>By Submitting, you agree to our Terms</h5>
                         <button id="Button" type="submit"></button>
                    </form>
                </div> <!--End InputForm-->

            <div class="grid_12">

                <div> <!--Part1-->
                <img class="img-align" src="{{asset('inc_whatmobile/')}}img/h1.png" />
                <p class="text">Mobile Magazine is an online publication which started in December 2000. Mobile Magazine covers mobile technology, including notebook computers, mobile phones, personal digital assistants, MP3 players, digital cameras, mobile gaming, and other portable electronics and computing devices as well as automotive technology. The magazine is a great guide and aims to help prevent purchasing errors on expensive mobile products.</p>
                </div> <!--Part1-->

                <div> <!--Part2-->
                <img class="img-align" src="{{asset('inc_whatmobile/')}}img/h3.png" />
                <div class="grid_4">
                    <div class="text2">
                        <p class="mem">Don't buy untill you read first</p>
                        <img src="{{asset('inc_whatmobile/')}}img/members.png">
                        <span>Lucy</span>
                    </div>
                </div>
                <div class="grid_4">
                    <div class="text2">
                        <p class="mem">I saved money. Great guide</p>
                        <img src="{{asset('inc_whatmobile/')}}img/members.png">
                        <span>John</span>
                    </div>                
                </div>
                <div class="grid_4">
                    <div class="text2">
                        <p class="mem">Great content and lovely photos</p>
                        <img src="{{asset('inc_whatmobile/')}}img/members.png">
                        <span>William</span>
                    </div>
                </div>
                </div> <!--Part2-->

                <div> <!--Part3-->
                <img class="img-align" src="{{asset('inc_whatmobile/')}}img/h2.png" />
                <div class="push_1 grid_10 box">
                    <div class="grid_5"><img src="{{asset('inc_whatmobile/')}}img/mag.png"></div>
                    <div class="grid_5">
                    <div id="flip-counter" class="flip-counter" style="margin-right: 20px; margin-top: 35px;"></div>
                    <h2>Issues Downloaded this month & counting!</h2>
                    </div>
                </div>
                </div> <!--Part3-->

                <div> <!--Part4-->
                <img class="img-align" src="{{asset('inc_whatmobile/')}}img/h4.png" />
                <div class="grid_4">
                    <div class="text2">
                    <img class="s" src="{{asset('inc_whatmobile/')}}img/s1.png"/>
                    <p class="lstsection">Fill the form above</p>
                    <img id="lin2" src="{{asset('inc_whatmobile/')}}img/line.png"/>

                    <img class="arw1" src="{{asset('inc_whatmobile/')}}img/arrow.png"/>
                    </div>
                </div>
                <div class="grid_4">
                    <div class="text2">
                    <img class="s" src="{{asset('inc_whatmobile/')}}img/s2.png"/>
                    <p class="lstsection">View the Magazine online</p>
                    <img id="lin2" src="{{asset('inc_whatmobile/')}}img/line.png"/>
                    <!-- <img src="{{asset('inc_whatmobile/')}}img/box2_footer.png"> -->

                    <img class="arw2" src="{{asset('inc_whatmobile/')}}img/arrow.png"/>
                    </div>
                </div>
                <div class="grid_4">
                    <div class="text2">
                    <img class="s" src="{{asset('inc_whatmobile/')}}img/s3.png"/>
                    <p class="lstsection">We will contact you later to know what you think</p>
                    <img src="{{asset('inc_whatmobile/')}}img/line.png"/>
                    <img src="{{asset('inc_whatmobile/')}}img/box3_footer.png">
                    </div>
                </div>
                </div> <!--Part4-->

            </div> <!--Sub_Container_G12-->
            <img class="img-align" src="{{asset('inc_whatmobile/')}}img/endl.png"/>
            <p class="footer">Mobile Republic | all rights reserved</p>
            </div> <!--Container_G12-->

        </div> <!--Main_Container-->

        <script>window.jQuery || document.write('<script src="js/libs/jquery-1.8.2.min.js"><\/script>')</script>
        <script src="{{asset('inc_whatmobile/')}}js/libs/jquery.ufvalidator-1.0.7.js"></script>
        <script src="{{asset('inc_whatmobile/')}}js/flipcounter.min.js"></script>
        <script src="{{asset('inc_whatmobile/')}}js/plugins.js"></script>
        <script src="{{asset('inc_whatmobile/')}}js/main.js"></script>

    </body>
</html>
