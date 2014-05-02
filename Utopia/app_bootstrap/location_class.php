<!DOCTYPE html>
<html lang="en">
<head>
    <title>Location List</title>
    <!-- <link rel="stylesheet" href="style2.css" /> -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <meta charset="utf-8" />

    <!-- bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/custom.css" rel="stylesheet">
    <script src="bootstrap/js/respond.js"></script>


</head>

<body>

<?php

/*    $array_index = 0;

    function increment(){

        global $array_index;

        $array_index ++;

        echo $array_index;

        var_dump($_POST);

        $_POST['runFunction'] = null;

        var_dump($_POST);

    }

    if(isset($_POST['runFunction']) && function_exists($_POST['runFunction']))
        call_user_func($_POST['runFunction']);*/
     
       // else
          //  echo "Function not found or wrong input";

class Location {

    public $name;
    public $description;
    public $main_photo;
    public $activities = array();
    public $restaurants = array();
    public $more_pics = array();
    public $more_pics_thumb = array();
    public $travel_types = array();
    public $region;
    
   public function __construct($name, $description, $main_photo, $activities, $restaurants, $more_pics, $more_pics_thumb, $travel_types, $region) {
   $this->name = $name;
   $this->description = $description;
   $this->main_photo = $main_photo;
   $this->activities = $activities;
   $this->restaurants = $restaurants;
   $this->more_pics = $more_pics;
   $this->more_pics_thumb = $more_pics_thumb;
   $this->travel_types = $travel_types;
   $this->region = $region;
    }

/*    public function get_place_type_as_string () {
        $type_string;
        switch ($this->$travel_types) {
            case ADVENTURE: $type_string = "Adventure";
            break;
            case LEISURE: $type_string = "Leisure";
            break;
            case CULTURE: $type_string = "Culture";
            break;
            case ENTERTAINMENT: $type_string = "Entertainment";
            break;
        }
        return $type_string;
    }   */

    public function place_thumbnail(){
        $serialized = '<div class="location_small">'.'<a href="#">';
        $serialized = $serialized.$this->name;
        $serialized = $serialized.'<br><br>'.$this->main_photo;
        $serialized = $serialized.'</a>';
        $serialized = $serialized.'</div>';
        return $serialized;
    }

    public function display_matching_places($index){

                $serialized = '
                <style type="text/css">
                    #location_hover_'.$index.' {
                    background-color: #F2F5F0;
                    border: 5px solid #8DCC6C;
                    width: 350px;
                    height: 350px;
                    -webkit-box-shadow: 0px 0px 4px #000;
                    -moz-box-shadow: 0px 0px 4px  #000;
                    box-shadow: 0px 0px 4px  #000;
                    margin-top: 10px;
                    border-radius: 3%;
                    display: inline-block;
                    // padding: 10px;
                    z-index: 100;
                    float:left;
                }

                #info_icon_'.$index.' {
                   /* display: inline-block;
                    z-index: 1000;
                    float: left;
                    margin-left: 45px;
                    margin-top: 260px;
                    position: absolute;*/
                }

                #activities_icon_'.$index.' {
               /*     display: inline-block;
                    z-index: 1000;
                    margin-left: 115px;
                    margin-top: 260px;
                    float: left;
                    position: absolute;*/
                }

                #food_icon_'.$index.' {
                   /* display: inline-block;
                    z-index: 1000;
                    margin-left: 185px;
                    margin-top: 260px;
                    float: left;
                    position: absolute;*/
                }

                #pics_icon_'.$index.' {
               /*     display: inline-block;
                    z-index: 1000;
                    margin-left: 255px;
                    margin-top: 260px;
                    float: left;
                    position: absolute;*/
                }

                #img_'.$index.' {
                    float: left;
                    margin-left: 40px;
                    position: absolute;
                    width: 320px;
                    height: 250px;
                    background-image:url('.$this->main_photo.');
                }

                #name_'.$index.' {
                    // margin-bottom: 15px;
                    margin-top: 10px;
                    margin-bottom: 5px;
                    text-align: center;
                    color: #295C0F;
                    font: bold 1.5em/.8em "Helvetica Neue", Arial, Helvetica, Geneva, sans-serif;
                }

                #info_'.$index.' {
                    margin-top: 15px;
                    margin-left: 30px;
                    width: 330px;
                    text-align: left;
                    color: #000;
                    font: 1.2em "Minion Pro", serif;
                    position: absolute;
                    line-height: 18px;
                }

                #activities_'.$index.' {
                    margin-top: 15px;
                    margin-left: 30px;
                    text-align: left;
                    width: 330px;
                    color: #000;
                    font: 1.1em "Minion Pro", serif;
                    position: absolute;
                    line-height: 15px;
                }

                #restaurants_'.$index.' {
                    margin-top: 15px;
                    margin-left: 30px;
                    text-align: left;
                    width: 330px;
                    color: #000;
                    font: 1.1em "Minion Pro", serif;
                    position: absolute;
                    line-height: 15px;
                }

                #more_pics_thumb_'.$index.' {
                    float: left;
                    margin-left: 15px;
                    position: absolute;
                }

                #more_pics_container_'.$index.'{
                    margin-left: 25px;
                    position: absolute;
                    width: 320px;
                    height: 250px;
                }

                #more_pics_container_'.$index.' p{
                    position: absolute;
                    margin-top: 235px;
                }

                #more_pics_1_'.$index.'{
                    position: absolute;
                    width: 320px;
                    height: 230px;
                    background-image:url('.$this->more_pics[0].');
                }
                #more_pics_2_'.$index.'{
                    position: absolute;
                    width: 320px;
                    height: 230px;
                    background-image:url('.$this->more_pics[1].');
                }
                #more_pics_3_'.$index.'{
                    position: absolute;
                    width: 320px;
                    height: 230px;
                    background-image:url('.$this->more_pics[2].');
                }

                #hover_buttons_'.$index.'{
                    margin-top: 270px;
                };

                </style>

                <div id="location_hover_'.$index.'">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div id="name_'.$index.'">
                                                    '.$this->name.'
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-8" id="img_'.$index.'">
                                            </div>
                                            <div class="col-xs-8 col-xs-offset-2" id="info_'.$index.'">
                                                '.$this->description.'
                                            </div>
                                            <div class="col-xs-8 col-xs-offset-2" id="activities_'.$index.'">
                                                <strong><u>Activities</u></strong><br><br>
                                            </div>
                                            <div class="col-xs-8 col-xs-offset-2" id="restaurants_'.$index.'">
                                                <strong><u>Restaurants</u></strong><br><br>
                                            </div>
                                            <div class="col-xs-8 col-xs-offset-2" id="more_pics_container_'.$index.'">
                                                <div id="more_pics_1_'.$index.'">
                                                </div>
                                                <div id="more_pics_2_'.$index.'">
                                                </div>
                                                <div id="more_pics_3_'.$index.'">
                                                </div>
                                                <p><em>Click or tap for next image</em></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                        </div>
                                        <div class="row">
                                        </div>
                                        <div class="row" id="hover_buttons_'.$index.'">
                                            <center>
                                                <div class="btn-group" id="nav_'.$index.'">
                                                  <div class="btn-group" id="info_icon_'.$index.'">
                                                    <button type="button" class="btn btn-default">Info</button>
                                                  </div>
                                                  <div class="btn-group" id="activities_icon_'.$index.'">
                                                    <button type="button" class="btn btn-default">Activities</button>
                                                  </div>
                                                  <div class="btn-group" id="food_icon_'.$index.'">
                                                    <button type="button" class="btn btn-default">Food</button>
                                                  </div>
                                                  <div class="btn-group" id="pics_icon_'.$index.'">
                                                    <button type="button" class="btn btn-default">More Pics</button>
                                                  </div>
                                                  <div class="btn-group" id="save_icon_'.$index.'">
                                                    <button type="button" class="btn btn-default">Save</button>
                                                  </div>
                                                </div>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                                    

         <script>
        //begin jquery


         $(function() {

        //set initial opacity to 0
            
         $("#location_hover_'.$index.'").css("opacity","1");
         $("#info_icon_'.$index.'").css("opacity",".5");
         $("#activities_icon_'.$index.'").css("opacity",".5");
         $("#pics_icon_'.$index.'").css("opacity",".5");
         $("#food_icon_'.$index.'").css("opacity",".5");
         $("#save_icon_'.$index.'").css("opacity",".5");
         $("#info_'.$index.'").hide();
         $("#activities_'.$index.'").hide();
        //$("#more_pics_thumb_'.$index.'").hide();
         $("#restaurants_'.$index.'").hide();
         $("#more_pics_container_'.$index.'").hide();


        //begin hover

         $("#location_hover_'.$index.'").hover(

        //ON MOUSE OVER (internal function)

         function () {

        //SET OPACITY TO VISIBLE

         $("#location_hover_'.$index.'").stop().animate({ opacity: 1}, "fast");
         $("#info_icon_'.$index.'").stop().animate({opacity: 1}, "fast");
         $("#activities_icon_'.$index.'").stop().animate({opacity: 1}, "fast");
         $("#pics_icon_'.$index.'").stop().animate({opacity: 1}, "fast");
         $("#food_icon_'.$index.'").stop().animate({opacity: 1}, "fast");
         $("#save_icon_'.$index.'").stop().animate({opacity: 1}, "fast");
         },

        //ON MOUSE OUT (new internal function)

         function () {

        //SET OPACITY BACK TO 0

         $("#location_hover_'.$index.'").stop().animate({opacity: 1}, "fast");
         $("#info_icon_'.$index.'").stop().animate({opacity: 1}, "fast");
         $("#activities_icon_'.$index.'").stop().animate({opacity: 1}, "fast");
         $("#pics_icon_'.$index.'").stop().animate({opacity: 1}, "fast");
         $("#food_icon_'.$index.'").stop().animate({opacity: 1}, "fast");
         $("#save_icon_'.$index.'").stop().animate({opacity: 1}, "fast");
         $("#img_'.$index.'").stop().animate({opacity: 1}, "fast");
         $("#info_'.$index.'").hide();
         $("#activities_'.$index.'").hide();
        //$("#more_pics_thumb_'.$index.'").hide();
         $("#restaurants_'.$index.'").hide();
         $("#img_'.$index.'").show();
         $("#more_pics_container_'.$index.'").hide();



        //info_icon BUTTON MOUSE OVER

         });

         $("#info_icon_'.$index.'").hover(
         function () {

        //info_icon OPACITY FULL, FADE FOR OTHER BUTTONS

         $("#info_icon_'.$index.'").stop().animate({opacity: 1}, "fast");
         $("#activities_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");
         $("#pics_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");
         $("#food_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");
         $("#save_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");
         $("#info_'.$index.'").show();
         $("#img_'.$index.'").hide();
         $("#activities_'.$index.'").hide();
        //$("#more_pics_thumb_'.$index.'").hide();
         $("#restaurants_'.$index.'").hide();
         $("#more_pics_container_'.$index.'").hide();


         });

        //activities_icon BUTTON MOUSE OVER

         $("#activities_icon_'.$index.'").hover(
         function () {

        // activities_icon OPACITY FULL, FADE OTHER BUTTONS

         $("#activities_icon_'.$index.'").stop().animate({opacity: 1.0}, "fast");
         $("#info_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");
         $("#pics_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");
         $("#food_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");
         $("#save_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");
         $("#activities_'.$index.'").show();
         $("#img_'.$index.'").hide();
         $("#more_pics_thumb_'.$index.'").hide();
         $("#info_'.$index.'").hide();
         $("#restaurants_'.$index.'").hide();
         $("#more_pics_container_'.$index.'").hide();
         });

        //pics_icon BUTTON MOUSE OVER

         $("#pics_icon_'.$index.'").hover(
         function () {

        //pics_icon OPACITY FULL, FADE OTHER BUTTONS

         $("#pics_icon_'.$index.'").stop().animate({opacity: 1.0}, "fast");
         $("#info_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");
         $("#food_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");
         $("#save_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");
         $("#activities_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");
         $("#more_pics_container_'.$index.'").show();
         $("#info_'.$index.'").hide();
         $("#img_'.$index.'").hide();
         $("#activities_'.$index.'").hide();
         $("#restaurants_'.$index.'").hide();
         });

         $( "#more_pics_1_'.$index.'" ).click(function() {
                $( "#more_pics_1_'.$index.'" ).hide();
                $( "#more_pics_2_'.$index.'" ).show();
                $( "#more_pics_3_'.$index.'" ).hide();
        });
         $( "#more_pics_2_'.$index.'" ).click(function() {
                $( "#more_pics_1_'.$index.'" ).hide();
                $( "#more_pics_2_'.$index.'" ).hide();
                $( "#more_pics_3_'.$index.'" ).show();
        });
         $( "#more_pics_3_'.$index.'" ).click(function() {
                $( "#more_pics_1_'.$index.'" ).show();
                $( "#more_pics_2_'.$index.'" ).hide();
                $( "#more_pics_3_'.$index.'" ).hide();
        });

         $("#food_icon_'.$index.'").hover(
         function () {

        //restaurants_icon OPACITY FULL, FADE OTHER BUTTONS

         $("#pics_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");
         $("#info_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");
         $("#save_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");
         $("#food_icon_'.$index.'").stop().animate({opacity: 1.0}, "fast");
         $("#activities_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");
         $("#restaurants_'.$index.'").show();
         $("#info_'.$index.'").hide();
         $("#activities_'.$index.'").hide();
         $("#more_pics_thumb_'.$index.'").hide();
             $("#more_pics_container_'.$index.'").hide();
         $("#img_'.$index.'").hide();
         });

        //END HOVER FUNCTION

        });

        </script>'; 
        return $serialized;

    }

    public function place_hover($index){

        $pic_index = 0;



        $serialized = '<style type="text/css">
                    #location_hover_'.$index.' {
                    background-color: #F2F5F0;
                    border: 5px solid #8DCC6C;
                    width: 350px;
                    height: 330px;
                    -webkit-box-shadow: 0px 0px 4px #000;
                    -moz-box-shadow: 0px 0px 4px  #000;
                    box-shadow: 0px 0px 4px  #000;
                    margin-top: 10px;
                    border-radius: 3%;
                    display: inline-block;
                    // padding: 10px;
                    position: absolute;
                    z-index: 100;
                    float:left;
                }

                #info_icon_'.$index.' {

                }

                #activities_icon_'.$index.' {
            
                }

                #food_icon_'.$index.' {
                   
                }

                #pics_icon_'.$index.' {
               
                }

                #img_'.$index.' {
                    z-index: -1;
                    float: left;
                    margin-left: 40px;
                    position: absolute;
                    width: 320px;
                    height: 250px;
                    background-image:url('.$this->main_photo.');
                }

                #name_'.$index.' {
                    z-index: -1;
                    // margin-bottom: 15px;
                    margin-top: 0px;
                    margin-left: auto;
                    margin-right: auto;
                    text-align: center;
                    color: #295C0F;
                    font: bold 1.5em/.8em "Helvetica Neue", Arial, Helvetica, Geneva, sans-serif;
                }

                #info_'.$index.' {
                    z-index: -1;
                    margin-top: 15px;
                    margin-left: auto;
                    margin-right: auto;
                    width: 330px;
                    text-align: left;
                    color: #000;
                    font: 1.2em "Minion Pro", serif;
                    position: absolute;
                    line-height: 18px;
                }

                #activities_'.$index.' {
                    margin-top: 15px;
                    margin-left: auto;
                    margin-right: auto;
                    text-align: left;
                    width: 330px;
                    color: #000;
                    font: 1.1em "Minion Pro", serif;
                    position: absolute;
                    line-height: 15px;
                }

                #restaurants_'.$index.' {
                    margin-top: 15px;
                    margin-left: auto;
                    margin-right: auto;
                    text-align: left;
                    width: 330px;
                    color: #000;
                    font: 1.1em "Minion Pro", serif;
                    position: absolute;
                    line-height: 15px;
                }

                #more_pics_thumb_'.$index.' {
                    z-index: -1;
                    float: left;
                    margin-left: 15px;
                    position: absolute;
                }

                #more_pics_container_'.$index.'{
                    margin-left: 15px;
                    position: absolute;
                    width: 320px;
                    height: 250px;
                }

                #more_pics_container_'.$index.' p{
                    position: absolute;
                    margin-top: 235px;
                }

                #more_pics_1_'.$index.'{
                    position: absolute;
                    width: 320px;
                    height: 230px;
                    background-image:url('.$this->more_pics[0].');
                }
                #more_pics_2_'.$index.'{
                    position: absolute;
                    width: 320px;
                    height: 230px;
                    background-image:url('.$this->more_pics[1].');
                }
                #more_pics_3_'.$index.'{
                    position: absolute;
                    width: 320px;
                    height: 230px;
                    background-image:url('.$this->more_pics[2].');
                };';


                $serialized = $serialized.'</style>';


/*        $serialized = $serialized.'<div class="container">';


        $serialized = $serialized.'<div class="hover_container">';*/


        $serialized = $serialized.'<img src="http://utopia.mynmi.net/app_bootstrap/pics/northeast/seaside_1.jpg">';        

        $serialized = $serialized.'<div id="location_hover_'.$index.'">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-xs-8 col-xs-offset-3">
                                                <h3>'.$this->name.'</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-8" id="img_'.$index.'">
                                            </div>
                                            <div class="col-xs-8 col-xs-offset-2" id="info_'.$index.'">
                                                '.$this->description.'
                                            </div>
                                            <div class="col-xs-8 col-xs-offset-2" id="activities_'.$index.'">
                                                <strong><u>Activities</u></strong><br><br>
                                            </div>
                                            <div class="col-xs-8 col-xs-offset-2" id="restaurants_'.$index.'">
                                                <strong><u>Restaurants</u></strong><br><br>
                                            </div>
                                            <div class="col-xs-8 col-xs-offset-2" id="restaurants_'.$index.'">
                                                <div id="more_pics_container_'.$index.'">
                                                    <div id="more_pics_1_'.$index.'">
                                                    </div>
                                                    <div id="more_pics_2_'.$index.'">
                                                    </div>
                                                    <div id="more_pics_3_'.$index.'">
                                                    </div>
                                                    <p><em>Click or tap for next image</em></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                        </div>
                                        <div class="row">
                                        </div>
                                        <div class="row">
                                            <div class="btn-group btn-group-lg" id="nav_'.$index.'">
                                                <button type="button" class="btn btn-default" id="info_icon_'.$index.'">Info</button>
                                                <button type="button" class="btn btn-default" id="activities_icon_'.$index.'">Activities</button>
                                                <button type="button" class="btn btn-default" id="food_icon_'.$index.'">Food</button>
                                                <button type="button" class="btn btn-default" id="pics_icon_'.$index.'">More Pics</button>
                                                <button type="button" class="btn btn-default" id="save_icon_'.$index.'">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>';

        //location hover div

/*        $serialized = $serialized.'<div id="location_hover_'.$index.'">';

        $serialized = $serialized.'<div id="name_'.$index.'">';
        $serialized = $serialized.$this->name;
        $serialized = $serialized.'</div>';

        $serialized = $serialized.'<div id="img_'.$index.'">';
        $serialized = $serialized.'</div>';

        $serialized = $serialized.'<div id="info_'.$index.'">';
        $serialized = $serialized.$this->description;
        // $serialized = $serialized.$this->get_place_type_as_string();
        $serialized = $serialized.'</div>';

        $serialized = $serialized.'<div id="activities_'.$index.'">';
        $serialized = $serialized.'<strong><u>'.'Activities'.'</u></strong>'.'<br><br>';
        foreach ($this->activities as $activity) {
            $serialized = $serialized.'-'.$activity.'<br><br>';
        }
        $serialized = $serialized.'</div>';

        $serialized = $serialized.'<div id="restaurants_'.$index.'">';
        $serialized = $serialized.'<strong><u>'.'Restaurants'.'</u></strong>'.'<br><br>';
        foreach ($this->restaurants as $restaurant) {
            $serialized = $serialized.'-'.$restaurant.'<br><br>';
        }
        $serialized = $serialized.'</div>';

        $serialized = $serialized.'<div id="more_pics_container_'.$index.'">';
        $serialized = $serialized.'<div id="more_pics_1_'.$index.'">';
        $serialized = $serialized.'</div>';
        $serialized = $serialized.'<div id="more_pics_2_'.$index.'">';
        $serialized = $serialized.'</div>';
        $serialized = $serialized.'<div id="more_pics_3_'.$index.'">';
        $serialized = $serialized.'</div>';
        $serialized = $serialized.'<p><em>Click or tap for next image</em></p>';
        $serialized = $serialized.'</div>';*/

/*        $serialized = $serialized.'<div id="more_pics_thumb_'.$index.'">';
        foreach ($this->more_pics_thumb as $pic_t) {
            $serialized = $serialized.$pic_t.'  ';
        }
        // $serialized = $serialized.'<p><em>Click or tap an image to zoom in/out</em></p>';
        $serialized = $serialized.'</div>';*/

/*        $serialized = $serialized.'<div id="more_pics_container_'.$index.'">';
        for($ii=0;$ii<sizeof($this->more_pics);$ii++){
            $serialized = $serialized.'<div id="more_pics_'.$ii.'_'.$index.'">';
            $serialized = $serialized.'</div>';
        }
        $serialized = $serialized.'<p><em>Click or tap for next image</em></p>';
        $serialized = $serialized.'</div>';*/


/*        var_dump($_POST['array_index']);
       if($_POST['array_index']){
            $array_index = $_POST['array_index'];
       }else{
        $array_index=0;
       }*/
       /*
        $array_index = $array_index % sizeof($this->more_pics_thumb);


       // $_POST['array_index']=null;
        $temp = $array_index +1;
        $serialized = $serialized.$this->more_pics_thumb[$array_index];
        $serialized = $serialized.'<p><em>Click or tap an image to view the next one.</em></p>';
        $serialized = $serialized.'<form method="post">
            <input type="hidden" value='.$temp.' name="array_index"/>
            <button type="submit" formmethod="post">Next Image</button>
            </form>';*/
        

/*        $serialized = $serialized.'<div class="btn-group btn-group-justified" id="nav_'.$index.'">
                                      <div class="btn-group" id="info_icon_'.$index.'">
                                        <button type="button" class="btn btn-default">Left</button>
                                      </div>
                                      <div class="btn-group" id="activities_icon_'.$index.'">
                                        <button type="button" class="btn btn-default">Middle</button>
                                      </div>
                                      <div class="btn-group" id="food_icon_'.$index.'">
                                        <button type="button" class="btn btn-default">Right</button>
                                      </div>
                                      <div class="btn-group" id="pics_icon_'.$index.'">
                                        <button type="button" class="btn btn-default">Right</button>
                                      </div>
                                      <div class="btn-group" id="save_icon_'.$index.'">
                                        <button type="button" class="btn btn-default">Right</button>
                                      </div>
                                    </div>';*/

        //info_icon
        
        $serialized = $serialized.'<div id="info_icon_'.$index.'">';
        // $serialized = $serialized.'<img src="nav_menu/description_button.png" width="40" height="47" alt="description" />';
        $serialized = $serialized.'</div>';//end info_icon_##

        //activities_icon

        $serialized = $serialized.'<div id="activities_icon_'.$index.'">';
        // $serialized = $serialized.'<img src="nav_menu/activities_button.png" width="40" height="40" alt="activities_icon" />';
        $serialized = $serialized.'</div>';//end activities_icon_##

        //food_icon

        $serialized = $serialized.'<div id="food_icon_'.$index.'">';
        // $serialized = $serialized.'<img src="nav_menu/restaurants_button.png" width="40" height="40" alt="pics_icon" />';
        $serialized = $serialized.'</div>';//end food_icon_##

        //pics_icon

        $serialized = $serialized.'<div id="pics_icon_'.$index.'">';
        // $serialized = $serialized.'<img src="nav_menu/pics_button.png" width="40" height="40" alt="pics_icon" />';
        $serialized = $serialized.'</div>';//end pics_icon_##


        $serialized = $serialized.'</div>';//end location_hover_##

       


        //begin jquery

        $serialized = $serialized.'<script>';
        $serialized = $serialized.'$(function() {';

        //set initial opacity to 0
            
        $serialized = $serialized.'$("#location_hover_'.$index.'").css("opacity","1");';
        $serialized = $serialized.'$("#info_icon_'.$index.'").css("opacity",".5");';
        $serialized = $serialized.'$("#activities_icon_'.$index.'").css("opacity",".5");';
        $serialized = $serialized.'$("#food_icon_'.$index.'").css("opacity",".5");';
        $serialized = $serialized.'$("#pics_icon_'.$index.'").css("opacity",".5");';
        $serialized = $serialized.'$("#info_'.$index.'").hide();';
        $serialized = $serialized.'$("#activities_'.$index.'").hide();';
        // $serialized = $serialized.'$("#more_pics_thumb_'.$index.'").hide();';
        $serialized = $serialized.'$("#restaurants_'.$index.'").hide();';
        $serialized = $serialized.'$("#more_pics_container_'.$index.'").hide();';


        //begin hover

        $serialized = $serialized.'$("#location_hover_'.$index.'").hover(';

        //ON MOUSE OVER (internal function)

        $serialized = $serialized.'function () {';

        //SET OPACITY TO VISIBLE

        $serialized = $serialized.'$("#location_hover_'.$index.'").stop().animate({ opacity: 1}, "fast");';
        $serialized = $serialized.'$("#info_icon_'.$index.'").stop().animate({opacity: 0.5}, "fast");';
        $serialized = $serialized.'$("#activities_icon_'.$index.'").stop().animate({opacity: 0.5}, "fast");';
        $serialized = $serialized.'$("#pics_icon_'.$index.'").stop().animate({opacity: 0.5}, "fast");';
        $serialized = $serialized.'$("#food_icon_'.$index.'").stop().animate({opacity: 0.5}, "fast");';
        $serialized = $serialized.'},';

        //ON MOUSE OUT (new internal function)

        $serialized = $serialized.'function () {';

        //SET OPACITY BACK TO 0

        $serialized = $serialized.'$("#location_hover_'.$index.'").stop().animate({opacity: 1}, "fast");';
        $serialized = $serialized.'$("#info_icon_'.$index.'").stop().animate({opacity: .5}, "fast");';
        $serialized = $serialized.'$("#activities_icon_'.$index.'").stop().animate({opacity: .5}, "fast");';
        $serialized = $serialized.'$("#pics_icon_'.$index.'").stop().animate({opacity: .5}, "fast");';
        $serialized = $serialized.'$("#food_icon_'.$index.'").stop().animate({opacity: .5}, "fast");';
        $serialized = $serialized.'$("#img_'.$index.'").stop().animate({opacity: 1}, "fast");';
        $serialized = $serialized.'$("#info_'.$index.'").hide();';
        $serialized = $serialized.'$("#activities_'.$index.'").hide();';
        // $serialized = $serialized.'$("#more_pics_thumb_'.$index.'").hide();';
        $serialized = $serialized.'$("#restaurants_'.$index.'").hide();';
        $serialized = $serialized.'$("#img_'.$index.'").show();';
        $serialized = $serialized.'$("#more_pics_container_'.$index.'").hide();';



        //info_icon BUTTON MOUSE OVER

        $serialized = $serialized.'});';

        $serialized = $serialized.'$("#info_icon_'.$index.'").hover(';
        $serialized = $serialized.'function () {';

        //info_icon OPACITY FULL, FADE FOR OTHER BUTTONS

        $serialized = $serialized.'$("#info_icon_'.$index.'").stop().animate({opacity: 1}, "fast");';
        $serialized = $serialized.'$("#activities_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");';
        $serialized = $serialized.'$("#pics_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");';
        $serialized = $serialized.'$("#food_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");';
        $serialized = $serialized.'$("#info_'.$index.'").show();';
        $serialized = $serialized.'$("#img_'.$index.'").hide();';
        $serialized = $serialized.'$("#activities_'.$index.'").hide();';
        // $serialized = $serialized.'$("#more_pics_thumb_'.$index.'").hide();';
        $serialized = $serialized.'$("#restaurants_'.$index.'").hide();';
        $serialized = $serialized.'$("#more_pics_container_'.$index.'").hide();';


        $serialized = $serialized.'});';

        //activities_icon BUTTON MOUSE OVER

        $serialized = $serialized.'$("#activities_icon_'.$index.'").hover(';
        $serialized = $serialized.'function () {';

        // activities_icon OPACITY FULL, FADE OTHER BUTTONS

        $serialized = $serialized.'$("#activities_icon_'.$index.'").stop().animate({opacity: 1.0}, "fast");';
        $serialized = $serialized.'$("#info_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");';
        $serialized = $serialized.'$("#pics_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");';
        $serialized = $serialized.'$("#food_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");';
        $serialized = $serialized.'$("#activities_'.$index.'").show();';
        $serialized = $serialized.'$("#img_'.$index.'").hide();';
        $serialized = $serialized.'$("#more_pics_thumb_'.$index.'").hide();';
        $serialized = $serialized.'$("#info_'.$index.'").hide();';
        $serialized = $serialized.'$("#restaurants_'.$index.'").hide();';
        $serialized = $serialized.'$("#more_pics_container_'.$index.'").hide();';
        $serialized = $serialized.'});';

        //pics_icon BUTTON MOUSE OVER

        $serialized = $serialized.'$("#pics_icon_'.$index.'").hover(';
        $serialized = $serialized.'function () {';

        //pics_icon OPACITY FULL, FADE OTHER BUTTONS

        $serialized = $serialized.'$("#pics_icon_'.$index.'").stop().animate({opacity: 1.0}, "fast");';
        $serialized = $serialized.'$("#info_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");';
        $serialized = $serialized.'$("#food_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");';
        $serialized = $serialized.'$("#activities_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");';
        $serialized = $serialized.'$("#more_pics_container_'.$index.'").show();';
        $serialized = $serialized.'$("#info_'.$index.'").hide();';
        $serialized = $serialized.'$("#img_'.$index.'").hide();';
        $serialized = $serialized.'$("#activities_'.$index.'").hide();';
        $serialized = $serialized.'$("#restaurants_'.$index.'").hide();';
        $serialized = $serialized.'});';
/*        $serialized = $serialized.'$( "#more_pics_thumb_'.$index.'" ).click(function() {
            $( "#more_pics_'.$index.'" ).show();
            $( "#more_pics_thumb_'.$index.'" ).hide();
            });'; */

        // $next_url=$this->more_pics[0];

/*        for($ii=0;$ii<sizeof($this->more_pics);$ii++){//$ii
            $serialized = $serialized.'$( "#more_pics_'.$ii.'_'.$index.'" ).click(function() {';
            $show_index=($ii++) % sizeof($this->more_pics);
            echo $show_index;
            for($jj=0;$jj<sizeof($this->more_pics);$jj++){//jj
                if($jj==$show_index){
                  $serialized = $serialized.'$( "#more_pics_'.$jj.'_'.$index.'" ).show();';
                }else{
                    $serialized = $serialized.'$( "#more_pics_'.$jj.'_'.$index.'" ).hide();';

                }
            }
            $serialized = $serialized.'});';
        }*/


        $serialized = $serialized.'$( "#more_pics_1_'.$index.'" ).click(function() {
                $( "#more_pics_1_'.$index.'" ).hide();
                $( "#more_pics_2_'.$index.'" ).show();
                $( "#more_pics_3_'.$index.'" ).hide();
        });';
        $serialized = $serialized.'$( "#more_pics_2_'.$index.'" ).click(function() {
                $( "#more_pics_1_'.$index.'" ).hide();
                $( "#more_pics_2_'.$index.'" ).hide();
                $( "#more_pics_3_'.$index.'" ).show();
        });';
        $serialized = $serialized.'$( "#more_pics_3_'.$index.'" ).click(function() {
                $( "#more_pics_1_'.$index.'" ).show();
                $( "#more_pics_2_'.$index.'" ).hide();
                $( "#more_pics_3_'.$index.'" ).hide();
        });';

//background-image:url('.$next_url.');
//background-image:url('..');

        $serialized = $serialized.'$("#food_icon_'.$index.'").hover(';
        $serialized = $serialized.'function () {';

        //restaurants_icon OPACITY FULL, FADE OTHER BUTTONS

        $serialized = $serialized.'$("#pics_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");';
        $serialized = $serialized.'$("#info_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");';
        $serialized = $serialized.'$("#food_icon_'.$index.'").stop().animate({opacity: 1.0}, "fast");';
        $serialized = $serialized.'$("#activities_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");';
        $serialized = $serialized.'$("#restaurants_'.$index.'").show();';
        $serialized = $serialized.'$("#info_'.$index.'").hide();';
        $serialized = $serialized.'$("#activities_'.$index.'").hide();';
        $serialized = $serialized.'$("#more_pics_thumb_'.$index.'").hide();';
            $serialized = $serialized.'$("#more_pics_container_'.$index.'").hide();';
        $serialized = $serialized.'$("#img_'.$index.'").hide();';
        $serialized = $serialized.'});';

        //END HOVER FUNCTION

        $serialized = $serialized.'});';


        




        //END SCRIPT



        $serialized = $serialized.'</script>';


        $serialized = $serialized.'</div>';//end hover_container    
/*
  
        $serialized = $serialized.$this->name;
        $serialized = $serialized.'<br><br>'.$this->main_photo;
        $serialized = $serialized.'<p>'.$this->description.'</p>';
        $serialized = $serialized.'<h4>'.'activities_icon'.'</h4>';
        $serialized = $serialized."<p>";
        foreach ($this->activities_icon as $activity) {
            $serialized = $serialized.$activity."<br>";
        }
        $serialized = $serialized.'</p>';
        $serialized = $serialized.'</div>';*/
        return $serialized;
    }
}


/*      switch ($this->region) {
            case WEST: $serialized = $serialized."West";
            break;
            case MIDWEST: $serialized = $serialized."Midwest";
            break;
            case NORTHEAST: $serialized = $serialized."Northeast";
            break;
            case SOUTHEAST: $serialized = $serialized."Southeast";
            break;
        }*/

/*    public function reset(){

        //begin jquery

        $serialized = '<script>';
        $serialized = $serialized.'$(function() {';

        //set initial opacity to 0
            
        $serialized = $serialized.'$("#location_hover_'.$this->name.'").css("opacity","0");';
        $serialized = $serialized.'$("#info_icon_'.$this->name.'").css("opacity","0");';
        $serialized = $serialized.'$("#activities_icon_'.$this->name.'").css("opacity","0");';
        $serialized = $serialized.'$("#pics_icon_'.$this->name.'").css("opacity","0");';


        $serialized = $serialized.'});';

        //END SCRIPT

        $serialized = $serialized.'</script>';    

  
        $serialized = $serialized.$this->name;
        $serialized = $serialized.'<br><br>'.$this->main_photo;
        $serialized = $serialized.'<p>'.$this->description.'</p>';
        $serialized = $serialized.'<h4>'.'activities_icon'.'</h4>';
        $serialized = $serialized."<p>";
        foreach ($this->activities_icon as $activity) {
            $serialized = $serialized.$activity."<br>";
        }
        $serialized = $serialized.'</p>';
        $serialized = $serialized.'</div>';
        return $serialized;    }*/


        /*                #more_pics_1_'.$index.'{
                    position: absolute;
                    width: 320px;
                    height: 230px;
                    background-image:url('.$this->more_pics[0].');
                }
                #more_pics_2_'.$index.'{
                    position: absolute;
                    width: 320px;
                    height: 230px;
                    background-image:url('.$this->more_pics[1].');
                }
                #more_pics_3_'.$index.'{
                    position: absolute;
                    width: 320px;
                    height: 230px;
                    background-image:url('.$this->more_pics[2].');
                }*/

                
/*        for($ii=0;$ii<sizeof($this->more_pics);$ii++){//$ii
            $serialized = $serialized.'$( "#more_pics_'.$ii.'_'.$index.'" ).click(function() {';
            $show_index=(++$ii) % sizeof($this->more_pics);
            for($jj=0;$jj<sizeof($this->more_pics);$jj++){//jj
                if($jj==$show_index){
                  $serialized = $serialized.'$( "#more_pics_'.$jj.'_'.$index.'" ).show();';
                  $serialized = $serialized.'$( this ).css( "background-image" , "url('.$this->more_pics[$jj].')" );';
                }else{
                    $serialized = $serialized.'$( "#more_pics_'.$jj.'_'.$index.'" ).hide();';

                }
            }
            $serialized = $serialized.'});';
        }*/

    $serialized = $serialized.'</div>';










?>

<script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>