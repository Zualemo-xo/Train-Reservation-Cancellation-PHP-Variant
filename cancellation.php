<?php
    session_start();
    if(isset($_POST['back']))
    {
      header("Location: select.php");
    }
?>

<html>
<head>
  <title>Cancellation</title>
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

  #Cancel,#back{
    padding-left: 35px;
    padding-right: 35px;
    padding-top: 10px;
    padding-bottom: 10px;
    background-image: radial-gradient(#B2FEFA,#0ed2f7);
  }
</style>


<body>
  <h1>Cancellation</h1>
  <?php echo("<h1>You are logged in as:" .$_SESSION['username']. "</h1>" ); ?>
    <form action="#" method="post">
  <input type="submit" id="back" name="back" value="Go To Menu">
    </form>
  <div id="form-ele" >
    <form action="#" id="form" method="post">

      <label for="tnoo">Train Number:</label><br>
      <input type='text' placeholder="Enter Train Number" name="tno" id="tno"></input><br><br>
      <label for="class">Class:</label><br>

      <select name="train_class" id="train_class" required>
        <option value=""></option>
        <option value="A1">A1</option>
        <option value="2TIERAC">2 Tier AC</option>
          <option value="3TIERAC">3 Tier AC</option>
            <option value="SLEEPER">Sleeper</option>
      </select><br><br>
      <!-- <input type='text' placeholder="A1"></input><br><br> -->
      <label for="ticket">Ticket Number:</label><br>
      <input type='number' placeholder="1" min=1 name="tickets" id="tickets"></input><br><br>
      <input type="submit" id="Cancel" name="Cancel" value="Cancel">
    </form>

    <?php
    if(isset($_POST['Cancel']))
    {
      $tno=$_POST['tno'];
      $train_class=$_POST["train_class"];
      $tickets=$_POST["tickets"];
      $usname=$_SESSION["username"];

      $pattern="/[0-9]+/";

      //Validation
     if($tno=="")
      {
        echo("Please fill out train number");
      }
      else if($train_class=="")
      {
        echo("Please fill out train class");
      }
      else if($tickets=="")
      {
        echo("Please fill out tickets");
      }
      else if(!preg_match($pattern,$tickets))
      {
        echo("<h2 style='color:red;'>Please fill out tickets with numericals</h2>");
      }
      else if(!preg_match($pattern,$tno))
      {
        echo("<h2 style='color:red;'>Please fill out train number with numericals</h2>");
      }


      else
      {
          $con=mysqli_connect("localhost","Administrator","#Kalizen0123") or die("Unable to connect");
          mysqli_select_db($con,"train_database");
          $sql="select * from booking_details where TrainNumber='$tno' and Name='$usname' and Class='$train_class' and TicketsBooked='$tickets'";
          $result = $con->query($sql);
          if ($result->num_rows > 0)
          {
            while($row =$result ->fetch_assoc())
            {
              //echo($row['TicketsBooked']);//GETS RESPECTIVE CLASS TICKET COUNT LEFT
              //$tickets_in_db=$row[$train_class];
              $restore_tickets=$row['TicketsBooked'];


            }
            $restore_tickets+=$tickets;
            $sql="UPDATE train_details SET $train_class=$restore_tickets WHERE TrainNumber='$tno'";
            $result = $con->query($sql);

            //To ensure misuse by same account
            $sql="Delete from booking_details where TrainNumber='$tno' and Name='$usname' and Class='$train_class' and TicketsBooked='$tickets'";
            $result = $con->query($sql);
              echo("Your Ticket count of ".$tickets." has been cancelled successfully");

          }
          //  Validate
          else
          {
            echo("Invalid Details Entered");
          }
        }
    }
    ?>

  </div>
</body>
</html>
