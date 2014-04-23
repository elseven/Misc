<?php
require_once 'sql_queries.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Location List</title>
    <link rel="stylesheet" href="style2.css" />

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>


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

    public function place_thumbnail(){
        $serialized = '<div class="location_small">'.'<a href="#">';
        $serialized = $serialized.$this->name;
        $serialized = $serialized.'<br><br>'.$this->main_photo;
        $serialized = $serialized.'</a>';
        $serialized = $serialized.'</div>';
        return $serialized;
    }


    public function place_hover($index){
        global $user_id;

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
                    padding: 10px;
                    position: absolute;
                    z-index: 100;
                    float:left;
                }

                #info_icon_'.$index.' {
                    display: inline-block;
                    z-index: 1000;
                    float: left;
                    margin-left: 45px;
                    margin-top: 260px;
                    position: absolute;
                }

                #activities_icon_'.$index.' {
                    display: inline-block;
                    z-index: 1000;
                    margin-left: 115px;
                    margin-top: 260px;
                    float: left;
                    position: absolute;
                }

                #food_icon_'.$index.' {
                    display: inline-block;
                    z-index: 1000;
                    margin-left: 185px;
                    margin-top: 260px;
                    float: left;
                    position: absolute;
                }

                #pics_icon_'.$index.' {
                    display: inline-block;
                    z-index: 1000;
                    margin-left: 255px;
                    margin-top: 260px;
                    float: left;
                    position: absolute;
                }

                #save_icon_'.$index.' {
                    display: inline-block;
                    z-index: 1000;
                    margin-top: -40px;
                    float: left;
                    position: absolute;
                }

                #img_'.$index.' {
                    z-index: -1;
                    float: left;
                    margin-left: 15px;
                    position: absolute;
                    width: 320px;
                    height: 250px;
                    background-image:url('.$this->main_photo.');
                }

                #name_'.$index.' {
                    z-index: -1;
                    margin-bottom: 15px;
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


        $serialized = $serialized.'<div class="container">';


        $serialized = $serialized.'<div class="hover_container">';



        //location hover div

        $serialized = $serialized.'<div id="location_hover_'.$index.'">';

        $serialized = $serialized.'<div id="name_'.$index.'">';
        $serialized = $serialized.$this->name;
        $serialized = $serialized.'</div>';

        $serialized = $serialized.'<div id="img_'.$index.'">';
        $serialized = $serialized.'</div>';

        $serialized = $serialized.'<div id="info_'.$index.'">';
        $serialized = $serialized.$this->description;
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
        $serialized = $serialized.'</div>';

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
        


        //info_icon
        
        $serialized = $serialized.'<div id="info_icon_'.$index.'">';
        $serialized = $serialized.'<img src="nav_menu/description_button.png" width="40" height="47" alt="description" />';
        $serialized = $serialized.'</div>';//end info_icon_##

        //activities_icon

        $serialized = $serialized.'<div id="activities_icon_'.$index.'">';
        $serialized = $serialized.'<img src="nav_menu/activities_button.png" width="40" height="40" alt="activities_icon" />';
        $serialized = $serialized.'</div>';//end activities_icon_##

        //food_icon

        $serialized = $serialized.'<div id="food_icon_'.$index.'">';
        $serialized = $serialized.'<img src="nav_menu/restaurants_button.png" width="40" height="40" alt="pics_icon" />';
        $serialized = $serialized.'</div>';//end food_icon_##

        //pics_icon

        $serialized = $serialized.'<div id="pics_icon_'.$index.'">';
        $serialized = $serialized.'<img src="nav_menu/pics_button.png" width="40" height="40" alt="pics_icon" />';
        $serialized = $serialized.'</div>';//end pics_icon_##

        //save_icon

        $serialized = $serialized.'<div id="save_icon_'.$index.'">';
        $serialized = $serialized.'<img src="nav_menu/pics_button.png" width="40" height="40" alt="pics_icon" />';
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

        // $serialized = $serialized.addUserLocation($user_id, $this->name);

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
       
       $actionStruct = "addUserLocation~".$this->name."~".$user_id;
        
       
        //data: {actionStruct: '.$actionStruct.'},
        $serialized = $serialized.'$("#save_icon_'.$index.'").click(function(){
            
            $.ajax({
              url: "sql_queries.php",
              data: {actionStruct: "'.$actionStruct.'"},
              type: "post",
                success: function(output) {
                      alert(output);
                }
            })
        });';


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

</body>
</html>