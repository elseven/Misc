<?php


require_once 'location_class.php';


function create_css(){

	$serialized = '

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

                #img_'.$index.' {
                    z-index: -1;
                    float: left;
                    margin-left: 15px;
                    position: absolute;
                    width: 320px;
                    height: 250px;
                    background-image:url('.$more_pics[$pic_index].');
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
                }';


}


?>