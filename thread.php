<?php
        date_default_timezone_set('America/Los_Angeles');
        $id=$_POST["id"];
        $title=$_POST["title"];
        $cd=$_POST["cd"];
        $author = $_POST["author"];
        $game=$_POST["gname"];
        $content=$_POST["content"];
        
        $sql = "SELECT * FROM reply LEFT JOIN user ON reply.author_id = user.user_id WHERE reply.thread_id = '$id' ORDER BY reply.create_date DESC";
        
        $con=mysqli_connect("fdb28.awardspace.net","3737981_web","DDeeaa123!","3737981_web");
        
        if (mysqli_connect_errno()){
              echo "Failed to connect to MySQL: ".    
              mysqli_connect_error();
        }
        
        $result = mysqli_query($con, $sql);     

        mysqli_close($con);
        
        $imgPath = "img/".$game."banner.jpg";
               
        if (isset($_POST["replybtn"])) {
                $date = date("Y-m-d H:i:s");
                $comm = $_POST["comm"]; 
                if ($comm != "") {
                        $con=mysqli_connect("fdb28.awardspace.net","3737981_web","DDeeaa123!","3737981_web");
                        $sql = "INSERT INTO reply VALUES(NULL, '$id', '$date', 11, '$comm')";
                        mysqli_query($con, $sql);
                        mysqli_close($con);
                }
        }
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$title;?></title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="discussion.css" rel="stylesheet">
    <style>
        .content {
            min-height: 100px;
        }
        #thread, #comments{
            padding:20px;
            background-color: white;
            margin:0 50px 0 50px;
        }
        body {
            background: #f9f9f9 url("<?= $imgPath;?>") no-repeat top ;
        }
        .form-label {
            font-size: 15pt;
        }
        #back, #reply {
            margin:40px 50px 20px 50px;
        }
        #replybtn {
            width: 200px;
            margin-top: 20px;
        }
        .info{
            margin-right: 20px;
            color: grey;
            font-size: 12pt;
        }
        .error{
        color: red;
        display: none;
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

<div class="container" style="margin-top: 200px">
    <div class="row" id="thread">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <p><b><?=$title;?></b></p>
                <span class="info"><?=$author;?></span><span class="info"><?=$cd;?></span>
            </li>
            <li class="list-group-item">
                <p class="content"><?=$content;?></p>
            </li>
        </ul>
    </div>

</div>
<div class="container">
    <form action="discussion.php" method="GET">
        <input type="hidden" name="game" value="<?= $game?>">
        <button class="btn btn-primary" id="back" type="submit">Back</button>
    </form>
</div>

<div class="container">
    <div class="row" id="comments">
        <ul class="list-group list-group-flush">
        <?php while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                
        ?>
            <li class="list-group-item">
                <p><span class="info"><?=$row['nickname'];?></span><span class="info"><?=$row['create_date'];?></span></p>
                <p class="content"><?=$row['content'];?></p>
            </li>
            
            <?php };?>
        </ul>
    </div>
</div>

<div class="container">
    <hr>
</div>

<div class="container">
    <div class="row" id="reply">
        <form  method="POST">
        <input type="hidden" name="id" value="<?=$id; ?>" >
        <input type="hidden" name="gname" value="<?= $game; ?>" >
        <input type="hidden" name="content" value="<?=$content; ?>" >
        <input type="hidden" name="title" value="<?=$title; ?>" >
        <input type="hidden" name="cd" value="<?=$cd; ?>" >
        <input type="hidden" name="author" value="<?=$author; ?>" >
        
            <label class="form-label"><b>Comments</b></label><span class="error" id="err">*</span>
            <textarea class="form-control" placeholder="Reply to the thread" id="comm" name="comm" rows="3" value="<?= $_POST['comm'];?>"></textarea>
            <div class="col-4 offset-lg-5 offset-sm-4">
                <button class="btn btn-primary" type="submit" name="replybtn" id="replybtn" onclick='reply()'>Reply</button>
            </div>
        </form>
    </div>
</div>

<div class="footer"></div>
<script>
       function reply(){
       var x = document.getElementById("replybtn");
       x.value = "reply";
       }
</script>
</body>
</html>
