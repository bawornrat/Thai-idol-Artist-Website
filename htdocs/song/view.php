<?php 
    session_start();
    include('../common/server.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../resources/img/logoPJ.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Itim">
    <?php
    include('../common/headtag.php');
    try{
    $idquery = $_GET['bandid'];
        if ($idquery == null) {
            echo '<title>Song: IdolNiverse</title> ';
        }
        $sql = "SELECT * FROM (bandinfo LEFT JOIN comment ON bandinfo.band_id=comment.band_id) WHERE bandinfo.band_id = '$idquery'";
        $resultQuery = mysqli_query($conn, $sql);
        $resultArray = mysqli_fetch_assoc($resultQuery);
        echo '<title>'.$resultArray['band'].': IdolNiverse</title> ';
    ?>
    <link rel="stylesheet" href="../resources/css/style.css"> 
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="container-fluid color-light">
                <!-- this is for the header, the logo usually goes here -->
                <div class="navbar-header">
                <img src="../resources/img/logoPJ.png" class="rounded-circle" width="55" height="55">
                    <a class="navbar-brand" id="myidol" href="../index.php">My IdolNiverse</a>
                </div>
                <nav class="navbar navbar-expand-sm justify-content-center" id="navitem">
                    <div class="container-fluid">
                        <!-- Links -->
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Song</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../live/index.php">Live</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../event/index.php">Event</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <?php if (isset($_SESSION['username'])):?>
                    <p class="text-light">Hi <?php echo $_SESSION['username'];?> <a href="index.php?logout='1'" class="link-light">(Click to Sign-out)</a></p>
                <?php else: ?>
                    <a class="text-light" id="navlogin" href="../user/login.php">ลงชื่อเข้าใช้/สมัครสมาชิก</a>
                <?php endif ?>
            </div>
        </nav>
    </header>
    <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success" role="alert">
              <h3>
                <?php
                  echo $_SESSION['success'];
                  unset($_SESSION['success']);
                ?>
              </h3>
            </div>
            <?php endif ?>

      <div class="container mt-5">
        <?php
        if ($idquery == null) {
            throw new Exception();
        }
        
        /*while($obResult = mysqli_fetch_array($resultQuery)) {
            array_push($resultArray,$obResult);
        }*/
            // [SECURITY WARNING] ลบ API Key 
            // $youtube_api_key = 'XXXXXX';

            
            function getTitle($ytkey){
                global $youtube_api_key;
                $googleApiUrl = 'https://www.googleapis.com/youtube/v3/videos?part=snippet,statistics&id='.$ytkey.'&key='.$youtube_api_key;

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_VERBOSE, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);
                curl_close($ch);
                $data = json_decode($response);
                $value = json_decode(json_encode($data), true);
                $title = $value['items'][0]['snippet']['title'];
                return $title;
            }
        }
        catch (Exception $e){
            mysqli_close($conn);
            echo '<div class="alert alert-warning" role="alert"> คุณมาหน้านี้แบบผิดวิธี<br> กรุณากลับไปที่หน้า Song โดยการ <a href="index.php">กดที่นี่</a></p></div>';
        }
        ?>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6"><img src="../resources/Bandlogo/<?php echo $resultArray['bandlogo'];?>" class="img-fluid img-thumbnail" style="margin-left: auto; margin-right: auto; max-width: 45%"></div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                <h1 class="h1 font-weight-bold">วง: <?php echo $resultArray['band'];?></h1><br>
                <p class="h4">ผลงานล่าสุด ในเพลง: <?php echo getTitle($resultArray['ytnewsongkey']);?></p>
                <p class="h4">เผยแพร่เมื่อ: <?php echo date_format(date_create($resultArray['daterelease']),"d M Y");?></p>
            </div>
        </div>
        <div class="container mt-3">
            <div class="ratio ratio-16x9"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $resultArray['ytnewsongkey'];?>" allowfullscreen></iframe></div>
        </div>
    </div>
    <div>
        <?php if (isset($_SESSION['username'])):?>
            <div class="container mt-3">
                <p class="h2">พูดคุยคอมเมนต์</p>
            </div>
            <div class="container mt-3">
            <form action="commentDB.php?bandid=<?php echo $idquery;?>" method="post">
                <div class="mb-3 mt-3">
                    <label for="comment">Comments:</label>
                    <textarea class="form-control" rows="5" id="comment" name="comment" onkeyup="enableButton()" required></textarea>
                    <input type="hidden" id="username" name="username" value="<?php echo $_SESSION['username']; ?>">
                </div>
                <button type="submit" class="btn btn-primary" disabled="disabled" id="sendComment">Comment</button>
            </form>
            </div>

        <?php else: ?>
            <div class="container mt-3">
                <p class="h2">พูดคุยคอมเมนต์</p>
            </div>
            <div class="container mt-3">
            <form action="commentDB.php?bandid=<?php echo $idquery;?>" method="post">
                <div class="mb-3 mt-3">
                    <label for="comment">Comments:</label>
                    <textarea class="form-control" rows="5" id="comment" name="comment" placeholder="กรุณาเข้าสู่ระบบ เพื่อคอมเมนต์" disabled readonly></textarea>
                </div>
                <button type="submit" class="btn" disabled="disabled" id="sendComment">Comment</button>
            </form>
            </div>
        <?php endif ?>
            
        <?php
        $sql = "SELECT * FROM comment WHERE band_id='$idquery'";
        $result = mysqli_query($conn, $sql);?>

        <div class="container mt-3">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <div class="container mt-3 border rounded-3 p-2 m-1">
                    <h2 class="h2">จาก: <?php echo $row["username"];?></h2>
                    <p class><?php echo $row["comment"];?></p>
                    <br>
                    <p class>แสดงความคิดเห็นเมื่อ: <?php echo date_format(date_create($row["comment_time"]),"d F Y H:i");?></p>
                    <?php if(isset($_SESSION['username']) && $row["username"] == $_SESSION['username']): ?>
                    <a href="./delete.php?comment=<?php echo $row['comment_id']?>&bandid=<?php echo $row['band_id']?> "
                            onclick="return confirm('Are you sure you want to delete?')">
                            
                            <i class="fa-sharp fa-solid fa-trash fa-xl"></i>
                            </a>
                    <?php endif ?>
                </div>
            <?php endwhile ?>
        <?php else: ?>
            <div class="container mt-3 border rounded-3 p-2 m-1">
                <p class>ยังไม่มีความคิดเห็นใด ๆ ณ ขณะนี้</p>
            </div>
        <?php endif ?>
        <?php
            mysqli_close($conn);
        ?>
        </div>
    </div>
    <hr class="mx-4 mt-5">
    <footer>
        <div class="text-left p-3">
          © CP251 1/2565 group02 รักครั้งแรกน่ะสิ </div>
          <img style="margin:1px 10px 20px 10px;" src="../resources/img/logoPJ.png" class="rounded-circle" width="55" height="55">    
    </footer>
</body>
<script>
    function enableButton(){
        if(document.getElementById("comment").value === ''){
            document.getElementById("sendComment").disabled = true; 
        } else {
            document.getElementById("sendComment").disabled = false; 
        }
    }
</script>
</html>
