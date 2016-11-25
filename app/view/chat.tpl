<html>

<head>
  <title>CRNShare</title>
  <link href="<?= BASE_URL ?>/public/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>/public/css/style.css" type="text/css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-2.2.0.js"></script>
</head>

<body>

  <div id="med_rectangle">
    <div id="signout">Sign Out</div>
    <div id="signedin">Signed in as <em><?php echo $_SESSION['username']?></em></div>
  </div>

  <div id="main">

    <h1 class='elegantshadow'>CRNShare</h1>

    <div id="flat_rectangle">
      <ul class="tabrow">
        <li><a href="<?= BASE_URL ?>">Home</a></li>
        <li><a href="<?= BASE_URL ?>/calendar/">Calendar</a></li>
        <li class="selected"><a href="<?= BASE_URL ?>/chat/">Chat</a></li>
      </ul>
    </div>

    <div id="flat_rectangle">
      <div class="dropdown">
        <button onclick="myFunction()" class="dropbtn">Change Current CRN</button>
        <div id="myDropdown" class="dropdown-content">
          <a href="#">CRN 00000</a>
          <a href="#">CRN 11111</a>
          <a href="#">CRN 22222</a>
        </div>
      </div>
    </div>

    <div id="tall_rectangle"></div>

    <!-- Calendar  -->



    <div id="chat_box"><img src="<?= BASE_URL ?>/public/images/chat.png" alt="Chat" s"></div>

  </div>
  <script type="text/javascript" src="<?= BASE_URL ?>/public/js/main.js"></script>
</body>

</html>
