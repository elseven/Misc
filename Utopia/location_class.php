<?php
require_once 'sql_queries.php';
$user_id = 0;
if(isset($_GET['user_id']) && !empty($_GET['user_id'])){
$user_id = $_GET['user_id'];

        
}
?>

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

    public function place_thumbnail(){
        $serialized = '<div class="location_small">'.'<a href="#">';
        $serialized = $serialized.$this->name;
        $serialized = $serialized.'<br><br>'.$this->main_photo;
        $serialized = $serialized.'</a>';
        $serialized = $serialized.'</div>';
        return $serialized;
    }


    public function display_matching_places($index,$uid){

        $restaurant_list;
        $activity_list;

        foreach ($this->restaurants as $restaurant) {
            $restaurant_list = $restaurant_list.'-'.$restaurant.'<br><br>';
        }
        foreach ($this->activities as $activity) {
            $activity_list = $activity_list.'-'.$activity.'<br><br>';
        }

        //$actionStruct = "addUserLocation~".$this->name."~".$user_id;
        $actionStruct = "addUserLocation~".$this->name."~".$uid;
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
                    margin-left: 30px;
                    text-align: left;
                    width: 330px;
                    color: #000;
                    font: 1.1em "Minion Pro", serif;
                    position: absolute;
                    line-height: 15px;
                }

                #restaurants_'.$index.' {
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
                                            <div class="col-xs-11 col-xs-offset-1" id="info_'.$index.'">
                                                '.$this->description.'
                                            </div>
                                            <div class="col-xs-11 col-xs-offset-1" id="activities_'.$index.'">
                                                <h4><u>Activities</u></h4>
                                                '.$activity_list.'
                                            </div>
                                            <div class="col-xs-8 col-xs-offset-2" id="restaurants_'.$index.'">
                                                <h4><u>Restaurants</u></h4>
                                                '.$restaurant_list.'
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
         $("#info_icon_'.$index.'").stop().animate({opacity: .5}, "fast");
         $("#activities_icon_'.$index.'").stop().animate({opacity: .5}, "fast");
         $("#pics_icon_'.$index.'").stop().animate({opacity: .5}, "fast");
         $("#food_icon_'.$index.'").stop().animate({opacity: .5}, "fast");
         $("#save_icon_'.$index.'").stop().animate({opacity: .5}, "fast");
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

        $("#save_icon_'.$index.'").hover(
         function () {

        //restaurants_icon OPACITY FULL, FADE OTHER BUTTONS

         $("#pics_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");
         $("#info_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");
         $("#save_icon_'.$index.'").stop().animate({opacity: 1.0}, "fast");
         $("#food_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");
         $("#activities_icon_'.$index.'").stop().animate({opacity: 0.2}, "fast");
         $("#restaurants_'.$index.'").hide();
         $("#info_'.$index.'").hide();
         $("#activities_'.$index.'").hide();
         $("#more_pics_thumb_'.$index.'").hide();
             $("#more_pics_container_'.$index.'").hide();
         $("#img_'.$index.'").hide();
         });

        $("#save_icon_'.$index.'").click(function(){
            
            $.ajax({
              url: "sql_queries.php",
              data: {actionStruct: "'.$actionStruct.'"},
              type: "post",
                success: function(output) {
                      alert(output);
                }
            })
        });

        //END HOVER FUNCTION

        });

        </script>'; 
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
        
?>

<script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>