	    <!DOCTYPE html>
	    <html lang="en">
	        <head>
	            <!-- Required meta tags always come first -->
	            <meta charset="utf-8">
	            <meta http-equiv="refresh" content="1">
	            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	            <meta http-equiv="x-ua-compatible" content="ie=edge">

	            <!-- Bootstrap CSS -->
	            <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
	            <style>
	                .box-padding{
	                    padding:15px;
	                }
	                .text-center{
	                    text-align: center;
	                }
	                #map{
	                    width:  100%;
	                }
	                .box-center{
	                    margin: 0 auto;
	                    max-width: 750px;
	                    width: 100%;
	                }
	                .map-img{
	                    width: 100%;
	                    max-width: 800px;
	                }
	                .bg-gray{
	                    background-color: gray ;
	                }
	                .box-shadow{
	                   box-shadow: 0px 9px 10px 5px rgba(119, 119, 119, 0.74);
	                    -moz-box-shadow: 0px 9px 10px 5px rgba(119, 119, 119, 0.74);
	                    -webkit-box-shadow: 0px 9px 10px 5px rgba(119, 119, 119, 0.74);
	                }
	                .box-shadow-inner{
	                   box-shadow: inset 1px 11px 25px 10px rgba(119, 119, 119, 0.85);
	                    -moz-box-shadow: inset 1px 11px 25px 10px rgba(119, 119, 119, 0.85);
	                    -webkit-box-shadow: inset 1px 11px 25px 10px rgba(119, 119, 119, 0.85);
	                }
	                table {
	                    font-size: 1.1em;
	                }
	            </style>
	        </head>
	        <body>

	        <?php

	            $objConnect = mysqli_connect("localhost","root","") or die("Error Connect to Database");

	            $objDB = mysqli_select_db($objConnect,"bustable");

	            
	            $strSQL = "SELECT bussocket.next_time as time,busdetail.bus_no as bus_no,busdetail.bus_license as license,busdetail.type as type,busstation.station_description as bus_station,bussocket.station as station, bussocket.timestamp as timestamp  FROM busdetail, bussocket, busstation WHERE bussocket.station=busstation.station_id and busdetail.id = 1 ORDER BY bussocket.timestamp DESC LIMIT 1";

	            $objQuery = mysqli_query($objConnect,$strSQL) or die ("Error Query [".$strSQL."]");



	            ?>
	            <nav class="navbar navbar-dark bg-inverse">
	                <a class="navbar-brand" href="#">IMT : Public Transport</a>

	            </nav>
	            <?php while ($objResult = mysqli_fetch_array($objQuery))  { ?>
	            <div class="row bg-gray box-shadow-inner">
	                <div class="container">
	                    <div class=" box-padding">
	                 
	                        <div class="box-center box-shadow">
	                            <?php if($objResult['station']=='a'){ ?>
	                                <img class="map-img" align="middle" src="img/StationA.png">
	                            <?php } else if($objResult['station']=='b'){ ?>
	                                <img class="map-img" align="middle" src="img/StationB.png">
	                            <?php } else if($objResult['station']=='c'){ ?>
	                                <img class="map-img" align="middle" src="img/StationC.png">
	                            <?php } else if($objResult['station']=='d'){ ?>
	                                <img class="map-img" align="middle" src="img/StationD.png"> 
	                            <?php } else if($objResult['station']=='e'){ ?>
	                                <img class="map-img" align="middle" src="img/StationE.png">
	                            <?php } else if($objResult['station']=='f'){ ?>
	                                <img class="map-img" align="middle" src="img/StationF.png">
	                            <?php } ?>
	                        </div>
	                       
	                    </div>
	                </div>
	                
	            </div>
	            <div class="row">
	                <div class="col-sm-offset-2 col-sm-8">
	                    <div class="container">
	                        <div class="row">
	                            <div class="panel panel-default box-padding ">
	                                <table class="table table-bordered " style="box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.25);">
	                                    <tr>
	                                        <th colspan="6" class="text-center" style="background-color:#f5f5f5;">
	                                        <h2>ตารางเวลารถเมล์</h2>
	                                        </th>
	                                    </tr>
	                                    <tr >
	                                        <th class="text-center">สายรถเมล์</th>
	                                        <th  class="text-center">เลขทะเบียน</th>
	                                        <th class="text-center">ประเภท</th>
	                                        <th class="text-center">ระยะเวลา(นาที)</th>
	                                        <th class="text-center">เวลาที่จะถึง</th>
	                                        <th class="text-center">สถานีถัดไป</th>
	                                    </tr>

	                                    <tr>
	                                        <!-- Time calculation -->
	                                        <?php
	                                        $time = $objResult['time'];
	                                        $datetime = $objResult['timestamp'];
	                                        //echo $datetime; <!--Bf time -->
	                                        $currentDate = strtotime($datetime);
	                                        $futureDate = $currentDate+(60*$objResult['time']);
	                                        $formatDate = date("H:i", $futureDate);
	                                        
	                                        //echo $formatDate; <!--Af time -->
	                                        ?>
	                                        <!--/ Time calculation-->
	                                        <td  class="text-center">
	                                                <?php echo $objResult['bus_no'] ?>
	                                        </td>
	                                        <td  class="text-center"><?php echo $objResult['license'] ?></td>
	                                        <td  class="text-center"><?php echo $objResult['type'] ?></td>
	                                        <td  class="text-center"><?php echo $objResult['time'] ?></td>
	                                        <td  class="text-center"><?php echo $formatDate ?></td>
	                                        <td  class="text-center"><?php echo $objResult['bus_station']?></td>
	                                    
	                                    </tr>
	                                   
	                                </table>
	                            </div>
	                        </div>
	                    </div>

	                </div>

	            </div>
	            <?php } ?>

	            <!-- jQuery first, then Bootstrap JS. -->
	            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	            <script src="js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
	        </body>
	    </html>