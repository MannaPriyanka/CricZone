<?php
error_reporting(0);
$url = "https://cricapi.com/api/matches?apikey=3dLnjyswyINT65QW3jl8fgEyoaS2";
$result = file_get_contents($url);
$result = json_decode($result, true);


$oldmatchurl = "https://cricapi.com/api/cricket?apikey=3dLnjyswyINT65QW3jl8fgEyoaS2";
$oldresult = file_get_contents($oldmatchurl);
$oldresult = json_decode($oldresult, true);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CricZone</title>
    <link rel="stylesheet" href="css/index.css" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <style>
      .navbar-brand{
        font-weight: bold;
        font-size: 24px;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-stretch: narrower;
        color: orange;
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
                    <li><a href="#">Matches</a></li>
                    <li><a href="../Players/">Players</a></li>
                    <li><a href="../contact.html">Contact Us</a></li>
                </ul>
                <form class="navbar-form navbar-right" action="../Players/player.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search any player" name="search">
                    </div>
                    <button type="submit" name="submit" class="btn btn-info">Submit</button>
                </form>
            </div>
        </nav>
        <!--Whole Container -->
        <div class="rca-container rca-margin">

            <!--Live ScoreBoard -->
            <div class="rca-row">

                <!--Widget Inner -->
                <div class="rca-column-6">
                  

                    <div class="rca-medium-widget  rca-live-season rca-top-border ">
                    <ul class="rca-tab-list">
                        <li class="rca-tab-link" style="color:red" >
                        Todays matches

                        </li>
                        
                    </ul>
                    <div class="rca-tab-content rca-padding active">
                        <div class="rca-batting-score rca-padding">
                           
                            <div class="rca-row">
                                <div class="rca-header rca-table">
                                    <div class="rca-col rca-player">
                                        Team
                                    </div>
                                    <div class="rca-col">
                                        Date
                                    </div>
                                    <div class="rca-col">
                                        view
                                    </div>
                                </div>
                            </div>
                            <?php foreach ($result["matches"] as $newmatch) {
                                $todaydate = date("d-m-Y");
                                $matchdate = date('d-m-Y', strtotime($newmatch["date"]));
                                if (($newmatch["matchStarted"] == 1) && ($todaydate ==  $matchdate)) {
                            ?>
                                    <div class="rca-row">
                                        <div class="rca-table">
                                            <div class="rca-col rca-player">
                                                <?php echo $newmatch["team-1"] . " Vs <br> " . $newmatch["team-1"]; ?>
                                            </div>
                                            <div class="rca-col">
                                                <?php //echo $newmatch["date"]; 
                                                ?>
                                                <?php echo date('d-m-Y', strtotime($newmatch["date"])); ?>

                                            </div>
                                            <div class="rca-col">
                                                <button class="btn btn-info" onclick="window.location.href='match.php?id=<?php echo $newmatch['unique_id']; ?>'">View </button>

                                            </div>

                                        </div>
                                    </div>
                                    <hr />
                            <?php }
                            } ?>                            
                            


                            <div class="rca-clear"></div>
                        </div>

                    </div>
                   

                </div>

                </div>

            </div>
            <div class="rca-column-6">
                <!--Match Series-->
                <div class="rca-medium-widget rca-top-border ">
                    <ul class="rca-tab-list">
                        <li class="rca-tab-link active" data-tab="tab-41" onclick="showTab(this);">
                            Upcoming matches
                        </li>
                        <li class="rca-tab-link" data-tab="tab-42" onclick="showTab(this);">
                            old matches
                        </li>
                    </ul>
                    <div id="tab-41" class="rca-tab-content rca-padding active">
                        <div class="rca-batting-score rca-padding">
                            <h4>
                                <strong>
                                </strong>
                            </h4>


                            <div class="rca-row">
                                <div class="rca-header rca-table">
                                    <div class="rca-col rca-player">
                                        Team
                                    </div>
                                    <div class="rca-col">
                                        Date
                                    </div>
                                    <div class="rca-col">
                                        view
                                    </div>
                                </div>
                            </div>
                            <?php foreach ($result["matches"] as $newmatch) {
                                if ($newmatch["matchStarted"] == '') {
                            ?>
                                    <div class="rca-row">
                                        <div class="rca-table">
                                            <div class="rca-col rca-player">
                                                <?php echo $newmatch["team-1"] . " Vs <br> " . $newmatch["team-1"]; ?>
                                            </div>
                                            <div class="rca-col">
                                                <?php //echo $newmatch["date"]; 
                                                ?>
                                                <?php echo date('d-m-Y', strtotime($newmatch["date"])); ?>

                                            </div>
                                            <div class="rca-col">
                                                <button class="btn btn-info" onclick="window.location.href='match.php?id=<?php echo $newmatch['unique_id']; ?>'">View </button>

                                            </div>

                                        </div>
                                    </div>
                                    <hr />
                            <?php }
                            } ?>

                            <div class="rca-clear"></div>
                        </div>

                    </div>
                    <div id="tab-42" class="rca-tab-content rca-padding">
                        <div class="rca-batting-score rca-padding">
                            <h4>
                                <strong>
                                </strong>
                            </h4>
                            <div class="rca-row">
                                <div class="rca-header rca-table">
                                    <div class="rca-col rca-player">
                                        Teams with score
                                    </div>
                                    <div class="rca-col">
                                        view
                                    </div>
                                </div>
                            </div>
                            <?php foreach ($oldresult['data'] as $oldmatch) {
                            ?>
                                <div class="rca-row">
                                    <div class="rca-table">
                                        <div class="rca-col rca-player">
                                            <?php echo $oldmatch["description"]; ?>
                                        </div>
                                        <div class="rca-col">
                                            <button class="btn btn-info" onclick="window.location.href='match.php?id=<?php echo $oldmatch['unique_id']; ?>'">View </button>

                                        </div>
                                    </div>
                                </div>
                                <hr />
                            <?php
                            } ?>

                            <div class="rca-clear"></div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
    </div>
    </div>

    <script>
        function showTab(event) {
            var sourceParent = event.parentElement.parentElement;
            var sourceChilds = sourceParent.getElementsByClassName("rca-tab-content");
            var sourceLinkParent = sourceParent.getElementsByClassName("rca-tab-link");
            for (var i = 0; i < sourceChilds.length; i++) {
                sourceChilds.item(i).classList.remove("active");
            }
            for (var i = 0; i < sourceLinkParent.length; i++) {
                sourceLinkParent.item(i).classList.remove("active");
            }
            var dataTab = event.getAttribute("data-tab");

            event.classList.add("active");
            document.getElementById(dataTab).className += ' active';
        }
    </script>

</body>

</html>