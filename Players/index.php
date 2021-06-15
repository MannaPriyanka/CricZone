<?php
error_reporting(0);
require_once '../config.php';
$pid = "35263";
if ($_GET['pid']) {
    $pid = $_GET['pid'];
}
$url = "https://cricapi.com/api/playerStats?apikey=3dLnjyswyINT65QW3jl8fgEyoaS2&pid=$pid";
$result = file_get_contents($url);
$result = json_decode($result, true);

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
</head>
<style>
    * {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    .main {
        padding-top: 50px;

    }

    .navbar-brand {
        font-weight: bold;
        font-size: 24px;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-stretch: narrower;
        color: orange;
    }

    th {
        text-transform: capitalize;
        padding: 5px;
        color: gray;

    }

    h4 {
        font-weight: bold;
        text-transform: capitalize;
        color: #5bc0de;
    }

    tr {
        padding: 5px;
        color: gray;

    }

    .profile {
        line-height: 2.0;
        font-size: 18px;
        color: gray;
        text-align: justify
    }

    .thead {
        padding-right: 18px;
    }
</style>

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


        <main role="main" class="container">
            <h4><?php echo $result['name']; ?></h4>
            <div class="row">

                <div class="col-lg-4">
                    <img src="<?php echo $result['imageURL']; ?>" alt="">

                </div>
                <div class="col-lg-8">
                    <p class="profile"> <?php echo $result['profile']; ?> </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <h4> Perosnal Information </h4>
                    <table>
                        <tr>
                            <th> Fullname </th>
                            <td> <?php echo $result['fullName']; ?></td>
                        </tr>
                        <tr>
                            <th> born </th>
                            <td> <?php echo $result['born']; ?></td>
                        </tr>
                        <tr>
                            <th> Age </th>
                            <td> <?php echo $result['currentAge']; ?></td>
                        </tr>
                        <tr>
                            <th> Country </th>
                            <td> <?php echo $result['country']; ?></td>
                        </tr>
                        <tr>
                            <th> Playing role </th>
                            <td> <?php echo $result['playingRole']; ?></td>
                        </tr>
                        <tr>
                            <th> batting Style </th>
                            <td> <?php echo $result['battingStyle']; ?></td>
                        </tr>
                        <tr>
                            <th> bowling Style </th>
                            <td> <?php echo $result['bowlingStyle']; ?></td>
                        </tr>
                        <tr>
                            <th> major teams </th>
                            <td> <?php echo $result['majorTeams']; ?></td>
                        </tr>

                    </table>
                </div>
                <div class="col-lg-8">
                    <h4>batting </h4>
                    <br>
                    <table>
                        <?php
                        $match = array();
                        foreach ($result['data']['batting'] as $match => $matchtype) {
                            $arr[] = $match;
                        }
                        //  print_r($arr);
                        ?>
                        <tr>
                            <th class="thead">Match</th>
                            <?php foreach ($result['data']['batting']['listA'] as $key => $value) { ?>
                                <th class="thead"> <?php echo $key; ?> </th>
                            <?php } ?>
                        </tr>
                        <?php for ($i = 0; $i < count($arr); $i++) { ?>
                            <tr>
                                <td> <?php echo  $arr[$i] ?> </td>
                                <?php foreach ($result['data']['batting'][$arr[$i]] as $key => $value) { ?>
                                    <td> <?php echo $value; ?> </td>
                            <?php }
                            } ?>
                            </tr>
                    </table>
                    <br>
                    <br>
                    <h4>bowling </h4>
                    <br>
                    <table>
                        <?php
                        $match = array();
                        foreach ($result['data']['bowling'] as $match => $matchtype) {
                            $bowling[] = $match;
                        }
                        //  print_r($arr);
                        ?>
                        <tr>
                            <th class="thead">Match</th>
                            <?php foreach ($result['data']['bowling']['listA'] as $key => $value) { ?>
                                <th class="thead"> <?php echo $key; ?> </th>
                            <?php } ?>
                        </tr>
                        <?php for ($i = 0; $i < count($bowling); $i++) { ?>
                            <tr>
                                <td> <?php echo  $arr[$i] ?> </td>
                                <?php foreach ($result['data']['bowling'][$bowling[$i]] as $key => $value) { ?>
                                    <td> <?php echo $value; ?> </td>
                            <?php }
                            } ?>
                            </tr>
                    </table>
                </div>
            </div>
        </main>


    </div>

</body>

</html>