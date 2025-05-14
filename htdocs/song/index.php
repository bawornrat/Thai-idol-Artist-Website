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
    ?>
    <link rel="stylesheet" href="../resources/css/style.css"> 
    <title>Song: IdolNiverse</title>
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
    <div class="container mt-3 p-3 rounded" id="jumbo">
        <h1 class="display-4 fw-bold">Song</h1>
        <p class="h3">ขอเชิญพบกับผลงานเพลงล่าสุดของแต่ละศิลปินที่ผู้เขียนเว็บติดตาม <br>
    ได้ที่นี่</p>
      </div>

      <div class="container mt-5 justify-content-center">
        <?php 
        $sql = "SELECT band_id, ytnewsongkey,band FROM bandinfo";
        $resultQuery = mysqli_query($conn, $sql);
        $resultArray = array();
        while($obResult = mysqli_fetch_array($resultQuery)) {
            array_push($resultArray,$obResult);
        }
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

        ?>
        <div class="row">
            <div class="container col border rounded-3 p-2 m-1" id="song">
                <h2><?php echo $resultArray[0]["band"];?></h2>
                <?php echo '<div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray[0]["ytnewsongkey"].'" allowfullscreen></iframe></div>';
                echo '<a class="btn btn-sm" href="view.php?bandid='.$resultArray[0]["band_id"].'" role="button" id="viewdetail">View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg></a>'
                ;?>
            </div>
            <div class="container col border rounded-3 p-2 m-1" id="song">
            <h2><?php echo $resultArray[1]["band"];?></h2>
                <?php echo '<div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray[1]["ytnewsongkey"].'" allowfullscreen></iframe></div>';
                echo '<a class="btn btn-sm" href="view.php?bandid='.$resultArray[1]["band_id"].'" role="button" id="viewdetail">View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg></a>'
                ;?>
            </div>
            <div class="container col border rounded-3 p-2 m-1" id="song">
            <h2><?php echo $resultArray[2]["band"];?></h2>
                <?php echo '<div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray[2]["ytnewsongkey"].'" allowfullscreen></iframe></div>';
                echo '<a class="btn btn-sm" href="view.php?bandid='.$resultArray[2]["band_id"].'" role="button" id="viewdetail">View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg></a>'
                ;?>
            </div>
            <div class="container col border rounded-3 p-2 m-1" id="song">
            <h2><?php echo $resultArray[3]["band"];?></h2>
                <?php echo '<div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray[3]["ytnewsongkey"].'" allowfullscreen></iframe></div>';
                echo '<a class="btn btn-sm" href="view.php?bandid='.$resultArray[3]["band_id"].'" role="button" id="viewdetail">View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg></a>'
                ;?>
            </div>
        </div>
        <div class="row">
            <div class="container col border rounded-3 p-2 m-1" id="song">
                <h2><?php echo $resultArray[4]["band"];?></h2>
                <?php echo '<div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray[4]["ytnewsongkey"].'" allowfullscreen></iframe></div>';
                echo '<a class="btn btn-sm" href="view.php?bandid='.$resultArray[4]["band_id"].'" role="button" id="viewdetail">View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg></a>'
                ;?>
            </div>
            <div class="container col border rounded-3 p-2 m-1" id="song">
            <h2><?php echo $resultArray[5]["band"];;?></h2>
                <?php echo '<div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray[5]["ytnewsongkey"].'" allowfullscreen></iframe></div>';
                echo '<a class="btn btn-sm" href="view.php?bandid='.$resultArray[5]["band_id"].'" role="button" id="viewdetail">View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg></a>'
                ;?>
            </div>
            <div class="container col border rounded-3 p-2 m-1" id="song">
            <h2><?php echo $resultArray[6]["band"];?></h2>
                <?php echo '<div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray[6]["ytnewsongkey"].'" allowfullscreen></iframe></div>';
                echo '<a class="btn btn-sm" href="view.php?bandid='.$resultArray[6]["band_id"].'" role="button" id="viewdetail">View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg></a>'
                ;?>
            </div>
            <div class="container col border rounded-3 p-2 m-1" id="song">
            <h2><?php echo $resultArray[7]["band"];?></h2>
                <?php echo '<div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray[7]["ytnewsongkey"].'" allowfullscreen></iframe></div>';
                echo '<a class="btn btn-sm" href="view.php?bandid='.$resultArray[7]["band_id"].'" role="button" id="viewdetail">View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg></a>'
                ;?>
            </div>
        </div>
        <div class="row">
            <div class="container col border rounded-3 p-2 m-1" id="song">
                <h2><?php echo $resultArray[8]["band"];?></h2>
                <?php echo '<div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray[8]["ytnewsongkey"].'" allowfullscreen></iframe></div>';
                echo '<a class="btn btn-sm" href="view.php?bandid='.$resultArray[8]["band_id"].'" role="button" id="viewdetail">View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg></a>'
                ;?>
            </div>
            <div class="container col border rounded-3 p-2 m-1" id="song">
            <h2><?php echo $resultArray[9]["band"];?></h2>
                <?php echo '<div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray[9]["ytnewsongkey"].'" allowfullscreen></iframe></div>';
                echo '<a class="btn btn-sm" href="view.php?bandid='.$resultArray[9]["band_id"].'" role="button" id="viewdetail">View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg></a>'
                ;?>
            </div>
            <div class="container col border rounded-3 p-2 m-1" id="song">
            <h2><?php echo $resultArray[10]["band"];?></h2>
                <?php echo '<div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray[10]["ytnewsongkey"].'" allowfullscreen></iframe></div>';
                echo '<a class="btn btn-sm" href="view.php?bandid='.$resultArray[10]["band_id"].'" role="button" id="viewdetail">View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg></a>'
                ;?>
            </div>
            <div class="container col border rounded-3 p-2 m-1" id="song">
            <h2><?php echo $resultArray[11]["band"];?></h2>
                <?php echo '<div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray[11]["ytnewsongkey"].'" allowfullscreen></iframe></div>';
                echo '<a class="btn btn-sm" href="view.php?bandid='.$resultArray[11]["band_id"].'" role="button" id="viewdetail">View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg></a>'
                ;?>
            </div>
        </div>
    </div>
    <?php mysqli_close($conn); ?>
    <hr class="mx-4 mt-5">
    <footer>
        <div class="text-left p-3">
          © CP251 1/2565 group02 รักครั้งแรกน่ะสิ </div>
          <img style="margin:1px 10px 20px 10px;" src="../resources/img/logoPJ.png" class="rounded-circle" width="55" height="55">    
    </footer>
</body>
</html>