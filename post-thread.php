<?php
        date_default_timezone_set('America/Los_Angeles');
        $game=$_GET["game"];
        $sql = "SELECT * FROM game";
        $con=mysqli_connect("fdb28.awardspace.net","3737981_web","DDeeaa123!","3737981_web");
        if (mysqli_connect_errno()){
              echo "Failed to connect to MySQL: ".    
              mysqli_connect_error();
        }
        $result = mysqli_query($con, $sql);
        mysqli_close($con);
       
        
        $imgPath = "img/sc2.jpg";
        //$imgPath = "img/".$game.".jpg";
        
        $map = array(array("csgo",1),array("dota2",2),array("cyberpunk2077",3),array("animalcrossing",4),
        array("worldofwarcraft",5),array("zelda",6));
        
        $gname = "";
        $gameId = 0;
        $title = "";
        $content = "";
        $createDate = date("Y-m-d H:i:s");
        $lateReplyDate = date("Y-m-d H:i:s");
        $numReply = 0;
        
        
        $titleErr = "";
        $contentErr = "";
        
        if ($_SERVER["REQUEST_METHOD"]=="POST") {
                $gname = $_POST["gameName"];
                $title = $_POST["title"];
                $content = $_POST["content"];
               
                if ($title == "") {
                       $titleErr = "*";
                }
                if ($content == "") {
                        $contentErr = "*";
                }
               
                if ($title != "" && $content != "") {
                        foreach($map as $m) {
                                if ($m[0] == $gname) {
                                        $gameId = $m[1];
                                        break;
                                }
                        }
                        
                        if (mysqli_connect_errno()){
                                echo "Failed to connect to MySQL: ".    
                                mysqli_connect_error();
                        }
                        
                       
                        
                        $sql_p = "INSERT INTO thread VALUES(NULL, '$createDate', 11, '$title', '$content', 0, '$createDate', '$gameId')";
                        $con_p=mysqli_connect("fdb28.awardspace.net","3737981_web","DDeeaa123!","3737981_web");
                        
                        $result_1 = mysqli_query($con_p, $sql_p);
                        
                        mysqli_close($con_p);
                        header("Location: discussion.php?game=$gname");
                }
        }
        
       
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post Thread</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="discussion.css" rel="stylesheet">
    <style>
        #bg {
            opacity: 15%;
            position: absolute;
            z-index:-1;
        }
        
        h3 {
           margin-top: 100px;
        }
        .error {
        color: red;
        font-size:10pt;
        }
        .form-label,h3,hr {
        color: black;
        }
        #back{
        margin-top:100px;
        color: black;
        border: 0px;
        outline:none;
        background-color: transparent;
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
        <!--form class="d-flex">
            <button name="login" class="btn btn-outline-primary" type="submit">Log In</button>
            <button name="signup" class="btn btn-primary btn-sm" type="submit">Sign Up</button>
        </form-->
   </div>
</nav>

<img id ="bg" src="<?= $imgPath?>" class="img-fluid">
<div class="container">
    <div class="row align-items-end">
       <div class="col-2" >
            <form action="discussion.php" method="GET">
                <input type="hidden" name="game" value="<?= $game?>">
                <button  id="back" type="submit">Back
                </button>
            </form>
        </div>
        <div class="col-2 offset-3">
            <h3>Create a post</h3>
        </div>
        </div>
        <hr>
        <div class="col-6 offset-3">
            <form action="<?= $_SERVER['PHP_SELF'];?>" method="POST" id="postform">
                <div class="mb-3">
                    <label for="community" class="form-label">Commuity</label>
                    <select class="form-select" name="gameName">
                        <?php while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {     
                            echo "<option value=".$row['game_name'].">".$row['game_title']."</option>";     
                        }?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <span class="error"><?= $titleErr;?></span>
                    <input type="text" class="form-control" name="title">
                    
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <span class="error"><?= $contentErr;?></span>
                    <textarea class="form-control" name="content" rows="8"></textarea>
                    
                </div>
                <div class= "col-2 offset-4">
                    <input type="submit" class="btn btn-primary" style="width: 200px" name="submit" value="Post">
                </div>
            </form>
        </div>
     </div>
    
</body>

</html>
