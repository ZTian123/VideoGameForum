<?php
        date_default_timezone_set('America/Los_Angeles');
        $sql = "SELECT * FROM game_view";
        $con=mysqli_connect("fdb28.awardspace.net","3737981_web","DDeeaa123!","3737981_web");
        if (mysqli_connect_errno()){
              echo "Failed to connect to MySQL: ".    
              mysqli_connect_error();
        }
        $result = mysqli_query($con, $sql);
        
        mysqli_close($con);
      
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Video Game Forums</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="home.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="home.php">Video Game Forums</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle"  id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                    Community</a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="toggleitem">
                    <li><a class="dropdown-item" href="discussion.php?game=csgo"><img class="img-fluid" src="img/csgobanner.jpg"></a></li>
                    <li><a class="dropdown-item" href="discussion.php?game=dota2"><img class="img-fluid" src="img/dota2banner.jpg"></a></li>
                    <li><a class="dropdown-item" href="discussion.php?game=cyberpunk2077"><img class="img-fluid" src="img/cyberpunk2077banner.jpg"></a></li>
                    <li><a class="dropdown-item" href="discussion.php?game=animalcrossing"><img class="img-fluid" src="img/animalcrossingbanner.jpg"></a></li>
                    <li><a class="dropdown-item" href="discussion.php?game=worldofwarcraft"><img class="img-fluid" src="img/worldofwarcraftbanner.jpg"></a></li>
                    <li><a class="dropdown-item" href="discussion.php?game=zelda"><img class="img-fluid" src="img/zeldabanner.jpg"></a></li>
                   </ul>
                </li>
            </ul>
        </div>
       </div>
</nav>

<div class="container" id="carousel">
    <div class="row">
        <div class="col-1" id="prev">
            <a class="carousel-control-prev" href="#newGameCarousel" role="button" data-slide="prev" >
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </a>
        </div>
        <div class="col-10">
            <div id="newGameCarousel" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <a href="https://www.residentevil.com/village/us/" target="_blank">
                            <img src="img/villagere.png" class="d-block w-100" alt="...">
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="https://www.monsterhunter.com/rise/us/" target="_blank">
                            <img src="img/monsterhunter.jpg" class="d-block w-100" alt="...">
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="https://www.nintendo.com/games/detail/super-mario-3d-world-plus-bowsers-fury-switch/" target="_blank">
                            <img src="img/supermario.jpg" class="d-block w-100" alt="...">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-1" id="next">
        <a class="carousel-control-next" href="#newGameCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>
    </div>
</div>

<div class="container">
    <div class="row" id="discussion">
        <p class="gamecat" id="steam">Community</p>
        <?php while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
              $imgPath = "img/".$row['game_name'].".jpg";
              $num_thread = $row['num_thread'];
              if ($row['num_reply'] == NULL) {
                     $num_reply = 0;
              } else {
                     $num_reply = $row['num_reply'];
              }?>
                        
        <div class="col-md-3 col-sm-6" style="margin-bottom: 20px">
            <div class="card" style="width: 18rem;">
                <img src="<?= $imgPath;?>" class="card-img-top" alt="..." style="height:160px">
                <div class="card-body">
                <form action="discussion.php" method="GET">
                        <input type="hidden" name="game" value="<?=$row['game_name']?>"/>
                        <input class="game_discussion" type="submit"value="<?=$row['game_title']?>">
                
                </form>
                    <p class="card-text">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Threads
                            <span class="badge"> <?= $num_thread;?> </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Replies:
                            <span class="badge"> <?= $num_reply;?> </span>
                        </li>
                    </ul>
                    </p>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
    
</div>
<div class="footer"></div>
</body>

</html>
