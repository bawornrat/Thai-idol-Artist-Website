

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include('../common/headtag.php');
    ?>
    <title>Song: IdolNiverse</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-inverse bg-dark navbar-dark">
            <div class="container-fluid color-light">
                <!-- this is for the header, the logo usually goes here -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="../index.php">My IdolNiverse</a>
                </div>
                <nav class="navbar navbar-expand-sm bg-light justify-content-center">
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
                    <a class="text-light" href="../user/login.php">ลงชื่อเข้าใช้/สมัครสมาชิก</a>
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
    <div class="container mt-3 p-3 bg-secondary text-white rounded">
        <h1 class="display-4 fw-bold">Song</h1>
        <p class="h3 thsarabunnew center">พบกับผลงานเพลงล่าสุดของแต่ละศิลปินที่ผู้เขียนเว็บติดตาม <br>
    ได้ที่นี่เลย</p>
        <a class="btn btn-primary btn-lg" href="#" role="button">Learn more <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
            <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
          </svg></a>
      </div>

      <div class="container mt-5">
        <?php 
        $sql = "SELECT band_id, ytnewsongkey FROM bandinfo";
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
        <div style="background-color:#f4c7ff" id="demo" class="carousel slide" data-bs-ride="carousel">

<!-- Indicators/dots -->
<div class="carousel-indicators">
  <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
  <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
  <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
  <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>
</div>

<!-- The slideshow/carousel -->
<div class="carousel-inner">
  <div class="carousel-item active">
  <div class="container col">
  <h2><?php echo getTitle($resultArray[0]["ytnewsongkey"]);
  echo '<a class="btn btn-primary btn-sm" href="view.php?bandid='.$resultArray[0]["band_id"].'" role="button">View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
  <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
</svg></a>'?></h2>
                <?php echo '<center><div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray[0]["ytnewsongkey"].'" allowfullscreen></iframe>';
                echo '</div></center>'
                ;?>
  </div></div>
  <div class="carousel-item"><div class="container col">
  <h2><?php echo getTitle($resultArray[1]["ytnewsongkey"]);?></h2>
                <?php echo '<center><div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray[1]["ytnewsongkey"].'" allowfullscreen></iframe></div>';
                echo '<a class="btn btn-primary btn-sm" href="view.php?bandid='.$resultArray[1]["band_id"].'" role="button">View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg></a></center>'
                ;?></div>
  </div>
  <div class="carousel-item"><div class="container col">
  <h2><?php echo getTitle($resultArray[2]["ytnewsongkey"]);?></h2>
                <?php echo '<center><div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray[2]["ytnewsongkey"].'" allowfullscreen></iframe></div>';
                echo '<a class="btn btn-primary btn-sm" href="view.php?bandid='.$resultArray[2]["band_id"].'" role="button">View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg></a></center>'
                ;?>
  </div></div>
  <div class="carousel-item"><div class="container col">
  <h2><?php echo getTitle($resultArray[3]["ytnewsongkey"]);?></h2>
                <?php echo '<center><div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray[3]["ytnewsongkey"].'" allowfullscreen></iframe></div>';
                echo '<a class="btn btn-primary btn-sm" href="view.php?bandid='.$resultArray[3]["band_id"].'" role="button">View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg></a></center>'
                ;?>
  </div>
  </div>
</div>

<!-- Left and right controls/icons -->
<button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
  <span class="carousel-control-prev-icon"></span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
  <span class="carousel-control-next-icon"></span>
</button>
</div>

            <div class="container col">
                
            </div>
            <div class="container col">
            
            </div>
            <div class="container col">
            
            </div>
            <div class="container col">
            
            </div>
        </div>
        <div class="row">
            <div class="container col">
                <h2><?php echo getTitle($resultArray[4]["ytnewsongkey"]);?></h2>
                <?php echo '<div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray[4]["ytnewsongkey"].'" allowfullscreen></iframe></div>';
                echo '<a class="btn btn-primary btn-sm" href="view.php?bandid='.$resultArray[4]["band_id"].'" role="button">View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg></a>'
                ;?>
            </div>
            <div class="container col">
            <h2><?php echo getTitle($resultArray[5]["ytnewsongkey"]);?></h2>
                <?php echo '<div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray[5]["ytnewsongkey"].'" allowfullscreen></iframe></div>';
                echo '<a class="btn btn-primary btn-sm" href="view.php?bandid='.$resultArray[5]["band_id"].'" role="button">View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg></a>'
                ;?>
            </div>
            <div class="container col">
            <h2><?php echo getTitle($resultArray[6]["ytnewsongkey"]);?></h2>
                <?php echo '<div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray[6]["ytnewsongkey"].'" allowfullscreen></iframe></div>';
                echo '<a class="btn btn-primary btn-sm" href="view.php?bandid='.$resultArray[6]["band_id"].'" role="button">View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg></a>'
                ;?>
            </div>
            <div class="container col">
            <h2><?php echo getTitle($resultArray[7]["ytnewsongkey"]);?></h2>
                <?php echo '<div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray[7]["ytnewsongkey"].'" allowfullscreen></iframe></div>';
                echo '<a class="btn btn-primary btn-sm" href="view.php?bandid='.$resultArray[7]["band_id"].'" role="button">View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg></a>'
                ;?>
            </div>
        </div>
        <div class="row">
            <div class="container col">
                <h2><?php echo getTitle($resultArray[8]["ytnewsongkey"]);?></h2>
                <?php echo '<div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray[8]["ytnewsongkey"].'" allowfullscreen></iframe></div>';
                echo '<a class="btn btn-primary btn-sm" href="view.php?bandid='.$resultArray[8]["band_id"].'" role="button">View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg></a>'
                ;?>
            </div>
            <div class="container col">
            <h2><?php echo getTitle($resultArray[9]["ytnewsongkey"]);?></h2>
                <?php echo '<div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray[9]["ytnewsongkey"].'" allowfullscreen></iframe></div>';
                echo '<a class="btn btn-primary btn-sm" href="view.php?bandid='.$resultArray[9]["band_id"].'" role="button">View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg></a>'
                ;?>
            </div>
            <div class="container col">
            <h2><?php echo getTitle($resultArray[10]["ytnewsongkey"]);?></h2>
                <?php echo '<div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray[10]["ytnewsongkey"].'" allowfullscreen></iframe></div>';
                echo '<a class="btn btn-primary btn-sm" href="view.php?bandid='.$resultArray[10]["band_id"].'" role="button">View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg></a>'
                ;?>
            </div>
            <div class="container col">
            <h2><?php echo getTitle($resultArray[11]["ytnewsongkey"]);?></h2>
                <?php echo '<div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray[11]["ytnewsongkey"].'" allowfullscreen></iframe></div>';
                echo '<a class="btn btn-primary btn-sm" href="view.php?bandid='.$resultArray[11]["band_id"].'" role="button">View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg></a>'
                ;?>
            </div>
        </div>
    </div>
    <hr class="mx-4 mt-5">
    <footer class="bg-light text-center text-lg-start">
        <div class="text-left p-3">
          © Company 2014 </div>
      </footer>
</body>
</html>