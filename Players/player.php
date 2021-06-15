<?php
error_reporting(0);
require_once '../config.php';
if (isset($_POST['submit'])) {
    $name =  $_POST['search'];
    $searchname = str_replace(" ", "%20", $name);
    $url = "https://cricapi.com/api/playerFinder?apikey=" . 3dLnjyswyINT65QW3jl8fgEyoaS2 . "&name=" . $searchname;
    $pidresult = file_get_contents($url);
    $pidresult = json_decode($pidresult, true);
   // print_r($pidresult);
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>

            <title>CricZone</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
            <style>
                * {
                    font-family: Verdana, Geneva, Tahoma, sans-serif;
                }

                .navbar-brand {
                    font-weight: bold;
                    font-size: 24px;
                    font-family: Verdana, Geneva, Tahoma, sans-serif;
                    font-stretch: narrower;
                    color: orange;
                }

                h2 {
                    font-size: 16px;
                    text-transform: capitalize;
                    color: gray;
                    font-weight: bold;
                }

                .list {
                    margin: 30px;
                    padding: 20px;
                    border: 2px solid #D3D3D3;
                    border-radius: 5px;
                    box-shadow: 2px 2px #D3D3D3;

                }
            </style>
        </head>

        <body>
            <div class="container">
                <nav class="navbar navbar-light">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#">CricZone</a>
                        </div>
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="../">Home</a></li>
                            <li><a href="../matches/">Matches</a></li>
                            <li><a href="#">Players</a></li>
                            <li><a href="../contact.html">Contact Us</a></li>
                        </ul>
                        <form class="navbar-form navbar-right" action="player.php" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Search any player" name="search">
                            </div>
                            <button type="submit" name="submit" class="btn btn-info">Search</button>

                        </form>
                    </div>
                </nav>
                <div class="row">
                    <?php if(empty($pidresult['data']))
                      {    echo '<div class="container">';
                           echo "<h2>No record Found for '".$name."' .Please check the spelling!!!</h2> </div>";
                            exit();
                            
                     }
                if ($pidresult['data'] > 1) {
                    $nameid = array();

                    foreach ($pidresult['data'] as $name) {
                        $nameid[] = $name['pid'];
                    }
                    for ($i = 0; $i < count($nameid); $i++) {
                        $pid = $nameid[$i];
                        $url = "https://cricapi.com/api/playerStats?apikey=3dLnjyswyINT65QW3jl8fgEyoaS2&pid=$pid";
                        $result = file_get_contents($url);
                        $result = json_decode($result, true);
                        //print_r($result);
                    ?>
                        <div class="row list">
                            <div class="col-lg-4">
                                <img src="<?php echo $result['imageURL']; ?>" alt="<?php echo $result['fullName']; ?>" width="150" height="200">
                            </div>
                            <div class="col-lg-8 ">

                                <h2>Name </h2> <?php echo $result['fullName']; ?>
                                <h2>born </h2> <?php echo $result['born']; ?>
                                <h2>country </h2> <?php echo $result['country']; ?>
                                <br>
                                <button class="btn btn-info" onclick="window.location.href='index.php?pid=<?php echo $result['pid']; ?>'">View </button>

                            </div>
                        </div>

                    <?php  // echo $result['pid'];
                    }
                }
                    
}?>
                </div>
            </div>
        </body>

        </html>