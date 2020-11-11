<?php
  session_start();
  echo("<h1>Welcome," .$_SESSION['username']. "</h1>" );
  if(isset($_POST['Booking']))
  {
      header("Location: book_journey.php");
  }
  if(isset($_POST['Cancellation']))
  {
      header("Location: cancellation.php");
  }
  if(isset($_POST['Logout']))
  {
    session_unset();
    session_destroy();
    header("Location: Login.php");
  }
 ?>
 <html>
 <head>
 <style>

   *{
   font-family: monospace;
   font-size: 16px;
   }
   body{
       background:url('https://static.toiimg.com/photo/77548457.cms') ;
       background-position: center;
       background-repeat: no-repeat;
       background-size: cover;

   }
   h1{
     background-image: linear-gradient(to right,orange,yellow);
     padding-top: 20px;
     padding-bottom: 20px;
     font-size: 24px;
     text-align: center;
   }
   #form-ele{

       background-image: linear-gradient(to right,#ddd6f3,#faaca8);
       box-shadow: 2px 2px 4px #000000;
       opacity:0.9;
       text-align:center;
       margin-top: 100px;
       margin-bottom: 100px;
       margin-left: 100px;
       margin-right: 100px;
       padding-left: 100px;
       padding-right: 100px;
       padding-top: 100px;
       padding-bottom: 100px;
   }

   #form{
     opacity:0.9;
   }
   #username{
     opacity:0.9;
   }

   #Logout,#Booking,#Cancellation{
     padding-left: 35px;
     padding-right: 35px;
     padding-top: 10px;
     padding-bottom: 10px;
     background-image: radial-gradient(#B2FEFA,#0ed2f7);
   }
 </style>
</head>

<body>
  <div id="form-ele" >
      <h2>Select your action to proceed</h2>
      <form action="#" method="post">
      <input type="submit" id="Booking" name="Booking" value="Booking" >
      <input type="submit" id="Cancellation" name="Cancellation" value="Cancellation" >
      <input type="submit" id="Logout" name="Logout" value="Logout" >
      </form>
  </div>
</body>

</html>
