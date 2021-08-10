<?php
        date_default_timezone_set('America/Los_Angeles');
        $game=$_GET["game"];
        $sql = "SELECT * FROM thread as t JOIN game as g ON t.game_id = g.game_id JOIN user as u ON u.user_id = t.author_id WHERE g.game_name = '$game' ORDER BY t.last_reply_date DESC";
        $con=mysqli_connect("fdb28.awardspace.net","3737981_web","***","3737981_web");
        if (mysqli_connect_errno()){
              echo "Failed to connect to MySQL: ".    
              mysqli_connect_error();
        }
        $result = mysqli_query($con, $sql);
        
        mysqli_close($con);
       
        $imgPath = "img/".$game."banner.jpg";
        $link = "";
        $id = 0;
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?="Community - ".$game;?></title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="discussion.css" rel="stylesheet">
    <style>
         .card-text {
         font-size: 10pt;
         }
         .info, .info-date {
         font-size: 10pt;
         color:grey;
         margin-right:20px;
         }
         #mytitle{
         color:black;
         text-decoration:none;
         }
         .info-date{
         float: right
         }
    </style>
    
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


<div class="container" id="banner">
    <div class="row">

            <img id="imgbanner" src="<?= $imgPath?>" class="img-fluid" >

    </div>
</div>

<div class="container">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">New</a>
        </li>
    </ul>
</div>


<div class="container" >
    <div class="row">
        <div class="col-9" id="thread">
        <?php while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
              $link = $row['links'];
        ?>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <form action="thread.php" method="POST" id="<?=$row['thread_id']; ?>">
                    
                            <input type="hidden" name="id" value="<?=$row['thread_id']; ?>" >
                            <input type="hidden" name="gname" value="<?= $game; ?>" >
                            <input type="hidden" name="content" value="<?=$row['content']; ?>" >
                            <input type="hidden" name="title" value="<?=$row['title']; ?>" >
                            <input type="hidden" name="cd" value="<?=$row['create_date']; ?>" >
                            <input type="hidden" name="author" value="<?=$row['nickname']; ?>" >
                            
                            <a href="javascript:$('#<?=$row['thread_id']; ?>').submit()" id="mytitle"><?=$row['title'];?></a>
                    </form>
                    
                    <p><span class="info"><?=$row['nickname']?></span><span class="info-date">Last reply: <?=$row['last_reply_date']?></span></p>
                </li>
                <li class="list-group-item"></li>
            </ul>
            <?php } ?>
            
        </div>
        <div class="col-3" >
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Announcements</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Forum Announcement</h6>
                    <p class="card-text">link: <a href="<?= $link;?>"><?= $link?></a></p>
                    
                    <form action="post-thread.php">
                    <input type="hidden" name="game" value="<?= $game?>">
                            <input class="btn btn-primary" type="submit" style="width: 150px" value="Create a Post">
                    <form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer"></div>
<script>
        
</script>
</body>

</html>
