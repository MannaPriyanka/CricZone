<!DOCTYPE html>
<html lang="en">

<head>
    <title>CricZone</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
</head>
<style>
    .heading1 {
        font-weight: bold;
        color: teal;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        padding: 20px;
    }

    .heading2 {
        font-weight: bold;
        color: orange;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        margin-bottom: 40px;
        padding: 10px;
        font-size: 22px;
    }

    .btn {
        margin-left: 20px;
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

    .score {
        border-radius: 30px;
        padding: 10px;
    }
    .table{
        padding-left:  100px;
        padding-right:  100px;
    }
</style>
<?php

$url = "https://cricapi.com/api/matchCalendar?apikey=3dLnjyswyINT65QW3jl8fgEyoaS2";
$result = file_get_contents($url);
$result = json_decode($result, true);
//echo  "<pre>";
//print_r($result);
?>

<body>
    <div class="container">
        <nav class="navbar navbar-light">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">CricZone</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="matches/">Matches</a></li>
                    <li><a href="Players/">Players</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                </ul>
                <form class="navbar-form navbar-right" action="Players/player.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search any player" name="search">
                    </div>
                    <button type="submit" name="submit" class="btn btn-info">Search</button>

                </form>
            </div>
        </nav>

        <section class="main">
            <div class="row">
                <div class="col-lg-8">
                <h1 class="heading1">For All Cricket Lovers, get latest Cricket updates </h1>
                <h1 class="heading2">Match timetable, score ,players details everything .</h1>
                    
                  
                </div>
                <div class="col-lg-4">
                    <img src="cricket.jpg" alt="criket">
                </div>

            </div>

        </section>
        <h2 style="text-align:center; font-weight:bold; color:skyblue;"> Match TimeTable</h2>

        <section class="table">
            <div class="row">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr cla>
                            <th>Date</th>
                            <th>Team name</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result["data"] as $match) {
                        ?>
                            <tr>
                                <td><?php $date = strtotime($match['date']);
                                    echo date('d-M-Y', $date); ?></td>
                                <td><?php echo $match['name']; ?></td>
                                <td><?php if(is_numeric($match['unique_id'])){ ?>
                                    <button class="btn btn-info" onclick="window.location.href='matches/match.php?id=<?php echo $match['unique_id']; ?>'">View </button>
                                    <?php }else{
                                        echo $match['unique_id'];
                                        
                                        }?>
                                    </td>
                            </tr>
                        <?php } ?>

                    </tbody>

                </table>
            </div>
        </section>
    </div>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "aaSorting": [],
                columnDefs: [{
                    orderable: false,
                    targets: 0
                }]
            });
        });
    </script>
</body>

</html>