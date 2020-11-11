<?php
    session_start();
    if(isset($_POST['back']))
    {
      header("Location: select.php");
    }
?>

<html>
<head>
  <title>Book Journey</title>
</head>
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

  #Log-In,#back,#CA{
    padding-left: 35px;
    padding-right: 35px;
    padding-top: 10px;
    padding-bottom: 10px;
    background-image: radial-gradient(#B2FEFA,#0ed2f7);
  }
</style>

<body>
  <h1>Railways Login Page</h1>
  <?php echo("<h1>You are logged in as:" .$_SESSION['username']. "</h1>" ); ?>
  <form action="#" method="post">
<input type="submit" id="back" name="back" value="Go To Menu">
  </form>
  <div id="form-ele" >
    <form action="#" id="form" method="post">
      <label for="username">Date:</label><br>
      <input type='date' placeholder="Enter date" id="date" name="date"></input><br><br>
      <label for="username">Boarding location:</label><br>
      <input type='text' placeholder="Enter boarding location" id="start" name="start"></input><br><br>
      <input type="submit" id="CA" name="CA" value="Check Availability">

    </form>
      <?php
        if(isset($_POST['CA']))
        {
          $date=$_POST['date'];
          $start=$_POST['start'];
          $_SESSION['datez']=$_POST['date'];
          $_SESSION['startz']=$_POST['start'];
          $pattern="/[^A-Za-z]+/";
          //echo($date.$start);
          //Validation
          if($date=="")
          {
            echo("<h2>Enter Date</h2>");
          }
          else if($start=="")
          {
            echo("<h2>Enter Start Location</h2>");
          }

          else if(preg_match($pattern,$start))
          {
            echo("<h2 style='color:red;'>Enter Valid Start Location</h2>");
          }
          //sqldb
          else
          {


          $con=mysqli_connect("localhost","Administrator","#Kalizen0123") or die("Unable to connect");
          mysqli_select_db($con,"train_database");
          $sql="select * from train_details where Date='$date' and TrainFrom='$start'";
          $result = $con->query($sql);
          if ($result->num_rows > 0)
          {

              header("Location: book_tickets.php");
          }
          else
          {
            echo "Sorry,No trains available in selected timeframe";
          }
          }


        }
    ?>
  </div>
</body>
</html>
