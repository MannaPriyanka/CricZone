<?php
error_reporting(0);
require_once '../config.php';
$unique_id = $_GET['id'];
$url = "https://cricapi.com/api/fantasySummary?apikey=3dLnjyswyINT65QW3jl8fgEyoaS2&unique_id=" . $unique_id;
$result = file_get_contents($url);
$result = json_decode($result, true);
//echo "<pre>";
//print_r($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ScoreBoard</title>
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
                <?php if (isset($result['error'])) {
                    echo "<h2>" . $result['error'] . "</h2>";
                } else {
                ?>
                    <!--Widget Inner -->
                    <div class="rca-column-6">
                        <!--Match Series-->
                        <div class="rca-medium-widget rca-padding rca-live-season rca-top-border">
                            <div class="rca-live-label rca-right">
                                <?php echo $result['data']['team'][0]['name'] . " Vs "; ?>
                                <?php echo $result['data']['team'][1]['name']; ?>
                                <br />
                                <br />



                            </div>
                            <div class="rca-clear"></div>
                            <div class="rca-padding">
                                <h3 class="rca-match-title">
                                    <?php
                                    $totalO = 0;
                                    $totalR = 0;
                                    $team = '';
                                    if (isset($result['data']['bowling'][0]['scores'])) {

                                        foreach ($result['data']['bowling'][0]['scores'] as $list) {
                                            $totalO = $totalO + $list['O'];
                                            $totalR = $totalR + $list['R'];
                                        } ?>
                                        <strong>
                                            <?php echo $result['data']['team'][1]['name']; ?>
                                            <?php echo $totalR; ?> in <?php echo $totalO; ?>
                                        </strong>
                                    <?php } ?>

                                    <br />
                                    <br />
                                    <?php
                                    $totalO = 0;
                                    $totalR = 0;
                                    $team = '';
                                    if (isset($result['data']['bowling'][1]['scores'])) {

                                        foreach ($result['data']['bowling'][1]['scores'] as $list) {
                                            $totalO = $totalO + $list['O'];
                                            $totalR = $totalR + $list['R'];
                                        } ?>
                                        <strong>
                                            <?php echo $result['data']['team'][0]['name']; ?>
                                            <?php echo $totalR; ?> in <?php echo $totalO; ?>
                                        </strong>
                                    <?php } ?>
                                </h3>
                            </div>
                        </div>
                        <!--Match Schedule Info-->
                        <div class="rca-mini-widget rca-history-info">
                            <div class="rca-row">
                                <span class="rca-col rca-history-title">Match:</span>
                                <span class="rca-col"> <?php echo $result['data']['team'][0]['name'] . " Vs "; ?>
                                    <?php echo $result['data']['team'][1]['name']; ?></span>
                            </div>
                            <!-- <div class="rca-row">
                                <span class="rca-col rca-history-title">Series:</span>
                                <span class="rca-col">IPL 2021</span>
                            </div> -->
                            <div class="rca-row">
                                <span class="rca-col rca-history-title">Date (GMT):</span>
                                <span class="rca-col">
                                    <?php echo date('d-m-Y', strtotime($result['dateTimeGMT'])); ?>
                                </span>
                            </div>
                            <!-- <div class="rca-row">
                                <span class="rca-col rca-history-title">Venue:</span>
                                <span class="rca-col"> India</span>
                            </div> -->
                            <!-- <div class="rca-row">
                                <span class="rca-col rca-history-title">Match Type:</span>
                                <span class="rca-col"> Twenty20 Cricket Match</span>
                            </div> -->
                            <div class="rca-row">
                                <span class="rca-col rca-history-title">Toss Winner Team:</span>
                                <span class="rca-col">
                                    <?php
                                    if (isset($result['data']['toss_winner_team'])) {
                                        echo $result['data']['toss_winner_team'];
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="rca-row">
                                <span class="rca-col rca-history-title">Man of the Match:</span>
                                <span class="rca-col">
                                    <?php
                                    if (isset($result['data']['man-of-the-match']['name'])) {
                                        echo $result['data']['man-of-the-match']['name'];
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="rca-row">
                                <span class="rca-col rca-history-title">Winning Team:</span>
                                <span class="rca-col">
                                    <?php
                                    if (isset($result['data']['winner_team'])) {
                                        echo $result['data']['winner_team'];
                                    }
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($result['data']['fielding'][0])) { ?>
                        <div class="rca-column-6">
                            <!--Match Series-->
                            <div class="rca-medium-widget rca-top-border ">
                                <ul class="rca-tab-list">
                                    <li class="rca-tab-link active" data-tab="tab-41" onclick="showTab(this);"> <?php echo $result['data']['team'][1]['name']; ?>
                                    </li>
                                    <li class="rca-tab-link" data-tab="tab-42" onclick="showTab(this);"><?php echo $result['data']['team'][0]['name']; ?></li>
                                </ul>
                                <div id="tab-41" class="rca-tab-content rca-padding active">
                                    <div class="rca-batting-score rca-padding">
                                        <h4><?php
                                            $totalO = 0;
                                            $totalR = 0;
                                            foreach ($result['data']['bowling'][0]['scores'] as $list) {
                                                $totalO = $totalO + $list['O'];
                                                $totalR = $totalR + $list['R'];
                                            }
                                            // echo $result['data']['batting'][0]['title'];
                                            ?>

                                            <strong>
                                                <?php echo $totalR; ?> in <?php echo $totalO; ?>
                                            </strong>
                                        </h4>
                                        <div class="rca-row">
                                            <div class="rca-header rca-table">
                                                <div class="rca-col rca-player">
                                                    Batsmen
                                                </div>
                                                <div class="rca-col">
                                                    R
                                                </div>
                                                <div class="rca-col">
                                                    4s
                                                </div>
                                                <div class="rca-col">
                                                    6s
                                                </div>
                                                <div class="rca-col">
                                                    SR
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        foreach ($result['data']['batting'][0]['scores'] as $list) {
                                            $color = 'red';
                                            if ($list['dismissal-info'] == 'not out') {
                                                $color = 'green';
                                            }
                                        ?>
                                            <div class="rca-row">
                                                <div class="rca-table">
                                                    <div class="rca-col rca-player">
                                                        <?php echo $list['batsman']; ?>
                                                        <br />
                                                        <span style="color:<?php echo $color; ?>; font-size:12px;">
                                                            <?php echo $list['dismissal-info'] ?>
                                                        </span>
                                                    </div>
                                                    <div class="rca-col">

                                                        <?php echo $list['R'] . "(" . $list['B'] . ")"; ?>
                                                    </div>
                                                    <div class="rca-col">
                                                        <?php echo $list['4s']; ?>

                                                    </div>
                                                    <div class="rca-col">
                                                        <?php echo $list['6s']; ?>

                                                    </div>
                                                    <div class="rca-col">
                                                        <?php echo $list['SR']; ?>
                                                    </div>
                                                </div>
                                            </div>


                                        <?php } ?>
                                        <div class="rca-clear"></div>
                                    </div>
                                    <div class="rca-bowling-score rca-padding">
                                        <div class="rca-row">
                                            <div class="rca-header rca-table">
                                                <div class="rca-col rca-player">
                                                    Bowler
                                                </div>
                                                <div class="rca-col small">
                                                    O
                                                </div>
                                                <div class="rca-col small">
                                                    M
                                                </div>
                                                <div class="rca-col small">
                                                    R
                                                </div>
                                                <div class="rca-col small">
                                                    W
                                                </div>
                                                <div class="rca-col small">
                                                    Econ
                                                </div>
                                                <div class="rca-col small">
                                                    Extras
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        foreach ($result['data']['bowling'][0]['scores'] as $list) {
                                        ?>
                                            <div class="rca-row">
                                                <div class="rca-table">
                                                    <div class="rca-col rca-player">
                                                        <?php echo $list['bowler']; ?>
                                                    </div>
                                                    <div class="rca-col small">
                                                        <?php echo $list['O']; ?>

                                                    </div>
                                                    <div class="rca-col small">
                                                        <?php echo $list['M']; ?>
                                                    </div>
                                                    <div class="rca-col small">
                                                        <?php echo $list['R']; ?>

                                                    </div>
                                                    <div class="rca-col small">
                                                        <?php echo $list['W']; ?>

                                                    </div>
                                                    <div class="rca-col small">
                                                        <?php echo $list['Econ']; ?>

                                                    </div>

                                                    <div class="rca-col small">
                                                        <?php echo $list['WD'] + $list['NB']; ?>
                                                    </div>
                                                </div>
                                            </div>


                                        <?php } ?>

                                        <div class="rca-clear"></div>
                                    </div>
                                </div>
                                <div id="tab-42" class="rca-tab-content rca-padding">
                                    <div class="rca-batting-score rca-padding">
                                        <h4><?php
                                            $totalO = 0;
                                            $totalR = 0;
                                            foreach ($result['data']['bowling'][1]['scores'] as $list) {
                                                $totalO = $totalO + $list['O'];
                                                $totalR = $totalR + $list['R'];
                                            }
                                            //  echo $result['data']['batting'][1]['title'];
                                            ?>
                                            <strong>
                                                <?php echo $totalR; ?> in <?php echo $totalO; ?>
                                            </strong>
                                        </h4>
                                        <div class="rca-row">
                                            <div class="rca-header rca-table">
                                                <div class="rca-col rca-player">
                                                    Batsmen
                                                </div>
                                                <div class="rca-col">
                                                    R
                                                </div>
                                                <div class="rca-col">
                                                    4s
                                                </div>
                                                <div class="rca-col">
                                                    6s
                                                </div>
                                                <div class="rca-col">
                                                    SR
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        foreach ($result['data']['batting'][1]['scores'] as $list) {
                                            $color = 'red';
                                            if ($list['dismissal-info'] == 'not out') {
                                                $color = 'green';
                                            }
                                        ?>
                                            <div class="rca-row">
                                                <div class="rca-table">
                                                    <div class="rca-col rca-player">
                                                        <?php echo $list['batsman']; ?>
                                                        <br />
                                                        <span style="color:<?php echo $color; ?>; font-size:12px;">
                                                            <?php echo $list['dismissal-info'] ?>
                                                        </span>
                                                    </div>
                                                    <div class="rca-col">

                                                        <?php echo $list['R'] . "(" . $list['B'] . ")"; ?>
                                                    </div>
                                                    <div class="rca-col">
                                                        <?php echo $list['4s']; ?>

                                                    </div>
                                                    <div class="rca-col">
                                                        <?php echo $list['6s']; ?>

                                                    </div>
                                                    <div class="rca-col">
                                                        <?php echo $list['SR']; ?>
                                                    </div>
                                                </div>
                                            </div>


                                        <?php } ?>
                                        <div class="rca-clear"></div>
                                    </div>
                                    <div class="rca-bowling-score rca-padding">
                                        <div class="rca-row">
                                            <div class="rca-header rca-table">
                                                <div class="rca-col rca-player">
                                                    Bowler
                                                </div>
                                                <div class="rca-col small">
                                                    O
                                                </div>
                                                <div class="rca-col small">
                                                    M
                                                </div>
                                                <div class="rca-col small">
                                                    R
                                                </div>
                                                <div class="rca-col small">
                                                    W
                                                </div>
                                                <div class="rca-col small">
                                                    Econ
                                                </div>
                                                <div class="rca-col small">
                                                    Extras
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        foreach ($result['data']['bowling'][1]['scores'] as $list) {
                                        ?>
                                            <div class="rca-row">
                                                <div class="rca-table">
                                                    <div class="rca-col rca-player">
                                                        <?php echo $list['bowler']; ?>
                                                    </div>
                                                    <div class="rca-col small">
                                                        <?php echo $list['O']; ?>

                                                    </div>
                                                    <div class="rca-col small">
                                                        <?php echo $list['M']; ?>
                                                    </div>
                                                    <div class="rca-col small">
                                                        <?php echo $list['R']; ?>

                                                    </div>
                                                    <div class="rca-col small">
                                                        <?php echo $list['W']; ?>

                                                    </div>
                                                    <div class="rca-col small">
                                                        <?php echo $list['Econ']; ?>

                                                    </div>

                                                    <div class="rca-col small">
                                                        <?php echo $list['WD'] + $list['NB']; ?>
                                                    </div>
                                                </div>
                                            </div>


                                        <?php } ?>

                                        <div class="rca-clear"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php } ?>
                <?php } ?>
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
