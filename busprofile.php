        <!DOCTYPE html>
        <html lang="en">
            <head>
                <!-- Required meta tags always come first -->
                <!--<meta http-equiv=Content-Type content="text/html; charset=tis-620">-->
                <meta http-equiv=Content-Type charset="utf-8">
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
                        height: 100%;
                    }
                    .pull-right{
                        text-align: right;
                        width: 175px;
                    }
                    table tr>td{
                        padding-left: 15px;

                    }
                    .box-left{
                        max-width: 350px;
                        margin: auto;
                        padding-top: 10%;
                        

                    }
                    .box-border{
                        padding: 10px;
                        background-color: #fff;
                        border-color: gray;
                        border-width: 1px;
                    }
                </style>
                
            </head>
            <body>
                <?php

                $objConnect = mysqli_connect("localhost","root","") or die("Error Connect to Database");

                $objDB = mysqli_select_db($objConnect,"bustable");

                $data = $_GET["busid"];
                $data2 = $_GET["license"];
                //echo $data;
                //echo $data2;
                $strSQL = "SELECT * FROM busstation WHERE bus_no = '".$data."'";

                $strSQL2 = "SELECT * FROM busdetail WHERE bus_no = ".$data. " AND bus_license LIKE '". $data2."' LIMIT 1" ;
                
                if(isset($_GET["busid"]) & $_GET['license']){
                    
                   
                }

                $objQuery = mysqli_query($objConnect,$strSQL) or die ("Error Query [".$strSQL."]");

                $objQuery2 = mysqli_query($objConnect,$strSQL2) or die ("Error Query [".$strSQL2."]");

                ?>
                <nav class="navbar navbar-dark bg-inverse">
                    <a class="navbar-brand" href="#">IMT : Public Transport</a>

                </nav>

                <div class="row">
                    <?php

                    while($objResult2 = mysqli_fetch_array($objQuery2))

                    {   

                    ?>
                    <div class="col-md-4">

                        <div class="box-padding">
                        <div class="box-left">
                            <!--<div class="panel panel-default">-->
                            <div class="box-border">
                                <div class="panel-heading">
                                    <h3 class="panel-title ">ข้อมูลรถเมล์</h3>
                                </div>
                                <div class="panel-body">
                                    <table class="table">
                                        <tr >
                                            <td class="pull-right">สายรถเมล์ :</td>
                                            <td><?php echo $objResult2["bus_no"] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="pull-right">ทะเบียน :</td>
                                            <td><?php echo $objResult2["bus_license"] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="pull-right">อู่ :</td>
                                            <td><?php echo $objResult2["bus_garage"] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="pull-right">คนขับรถ :</td>
                                            <td><?php echo $objResult2["bus_driver"] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="pull-right">ผู้ช่วย :</td>
                                            <td><?php echo $objResult2["bus_assistant"] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="pull-right">ช่วงเวลา :</td>
                                            <td><?php echo $objResult2["time_service"] ?></td>
                                        </tr>
                                    </table>
                                   
                                </div>
                            </div>
                                
                            <!--</div>-->
                        </div>
                            
                    </div>
                        
                   </div>

                <?php }

                ?>
                    <div class="col-md-8">

                                <div class="panel panel-default box-padding">

                                    <table class="table table-bordered">
                                        <tr>
                                            <th colspan="5" class=""><h2>รถเมล์สาย <?php echo $data?></h2></th>
                                        </tr>
                                        <tr class="text-center">
                                            <th></th>
                                            <th>สถานี</th>
                                            <th>เวลา</th>
                                            
                                        </tr>
                                        <?php
                                            while($objResult = mysqli_fetch_array($objQuery))

                                            { 
                                        ?>
                                        <tr>
                                            <td><?php echo $objResult['station_id'] ?> </td>
                                            <td><?php echo $objResult['station_description'] ?> </td>
                                            <td>
                                                <?php 
                                                $currentDate = "12.10";
                                                $futureDate = $currentDate+(60*20);
                                                $formatDate = date("H:i", $futureDate);

                                                echo $formatDate;
                                                ?>
                                            </td>
                                        </tr>


                                        <?php } ?>
                                    </table>
                                </div>


                    </div>

                </div>

                <!--Map-->
                <script async defer
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfiBNLgXaaDW480L6xGo5_nvaj0rqSsOs&callback=initMap">
                </script>
                <!-- jQuery first, then Bootstrap JS. -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
                <script src="js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
                <?php

                mysqli_close($objConnect);

                ?>
            </body>
        </html>