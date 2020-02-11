<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <title>TEQUED LABS</title>
    <link rel="stylesheet" href="base.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="base.js">
    </script>
</head>

<body>
  <style>
    body {
      background-image: url("https://terillium.com/wp-content/uploads/2018/07/HomePage-background.jpg");
    }
  </style>
    <!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-black w3-card">
    <a
      class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right"
      href="javascript:void(0)"
      onclick="myFunction()"
      title="Toggle Navigation Menu"
      ><i class="fa fa-bars"></i
    ></a>

  <a
            href="sort.php"
            class="w3-bar-item w3-button w3-padding-large w3-hide-small"
            style="float: right;"
            >BACK</a
          >
  </div>
</div>

<div class="w3-content" style="max-width:2000px;margin-top:46px">
  <div
    class="w3-container w3-content w3-center w3-padding-64"
    style="max-width:800px"
    id="band"
  >
    <h2 class="w3-wide" style="color: white;">PDF GENERATION</h2>
    <br> <br>
    <br> <br>
    <div class="w3-row-padding w3-padding-32" style="margin:0 -16px">
        <div class="w3-third w3-margin-bottom">
          <div class="w3-container w3-white">
            <p><b>NAME</b></p>
            <br> <br>
            <p>
            <a href="pdfnameasc.php" class="button">ASCENDING ORDER</a>
            <br> <br>
            <br> <br>
            <a href="pdfnamedes.php" class="button">DESCENDING ORDER</a>
            </p>
          </div>
        </div>
        <div class="w3-third w3-margin-bottom">
          <div class="w3-container w3-white">
            <p><b>COLLEGE</b></p>
            <br> <br>
            <p>
            <a href="pdfcollasc.php" class="button">ASCENDING ORDER</a>
            <br> <br>
            <br> <br>
            <a href="pdfcolldes.php" class="button">DESCENDING ORDER</a>
            </p>
          </div>
        </div>
        <div class="w3-third w3-margin-bottom">
          <div class="w3-container w3-white">
            <p><b>YEAR OF STUDY</b></p>
            <br> <br>
            <p>
            <a href="pdfyearasc.php" class="button">ASCENDING ORDER</a>
            <br> <br>
            <br> <br>
            <a href="pdfyeardes.php" class="button">DESCENDING ORDER</a>
            </p>
          </div>
        </div>
    </div>
      <div class="w3-row-padding w3-padding-32" style="margin:0 -16px">
      <div class="w3-third w3-margin-bottom">
          <div class="w3-container w3-white">
            <p><b>COURSE OPTED</b></p>
            <br> <br>
            <p>
            <a href="pdfcourseasc.php" class="button">ASCENDING ORDER</a>
            <br> <br>
            <br> <br>
            <a href="pdfcoursedes.php" class="button">DESCENDING ORDER</a>
            </p>
          </div>
        </div>
        <div class="w3-third w3-margin-bottom">
          <div class="w3-container w3-white">
            <p><b>TRAINER</b></p>
            <br> <br>
            <p>
            <a href="pdftrainerasc.php" class="button">ASCENDING ORDER</a>
            <br> <br>
            <br> <br>
            <a href="pdftrainerdes.php" class="button">DESCENDING ORDER</a>
            </p>
          </div>
        </div>
        </div>
      </div>
</body>

</html>