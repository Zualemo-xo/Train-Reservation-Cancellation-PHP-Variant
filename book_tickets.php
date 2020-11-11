<?php
session_start();

if(isset($_POST['back']))
{
  header("Location: select.php");
}
?>
<html>
<head>
  <title>Book Tickets</title>
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

  #Book,#back{
    padding-left: 35px;
    padding-right: 35px;
    padding-top: 10px;
    padding-bottom: 10px;
    background-image: radial-gradient(#B2FEFA,#0ed2f7);
  }
</style>

<body>
  <h1>Book Tickets</h1>
  <?php echo("<h1>You are logged in as:" .$_SESSION['username']. "</h1>" ); ?>
    <form action="#" method="post">
  <input type="submit" id="back" name="back" value="Go To Menu">
    </form>
  <div id="form-ele" >
    <h3>Available Train Services</h3>
    <?php
    $datez=$_SESSION['datez'];
    $startz=$_SESSION['startz'];
    $con=mysqli_connect("localhost","Administrator","#Kalizen0123") or die("Unable to connect");
    mysqli_select_db($con,"train_database");
    $sql="select * from train_details where Date='$datez' and TrainFrom='$startz'";
    $result = $con->query($sql);
    //Printdirectly as verified in book_journey.php
    echo "<table border=3px  bgcolor='yellow' cellpadding='15'><th>Train Number</th><th>Train Name</th><th>Date</th><th>From</th><th>To</th><th>A1</th><th>2 Tier AC</th><th>3 Tier AC</th><th>Sleeper</th>";
      while($row =$result ->fetch_assoc())
      {
        // echo "Train Number" . $row["TrainNumber"]."Train Name".  $row["TrainName"]. "Date ".$row["Date"]. "From" . $row["TrainFrom"]."To" . $row["TrainTo"] ."A1".$row["A1"].
        // "2 Tier AC".$row["2TIERAC"]."3 Tier AC".$row["3TIERAC"]."Sleeper".$row["SLEEPER"]."<br>";
        echo "<tr><td>" . $row["TrainNumber"]."</td><td>".  $row["TrainName"]. "</td><td>".$row["Date"]. "</td><td>" .
         $row["TrainFrom"]."</td><td>" . $row["TrainTo"] ."</td><td>".$row["A1"].
        "</td><td>".$row["2TIERAC"]."</td><td>".$row["3TIERAC"]."</td><td>".$row["SLEEPER"]."</td></tr>";
      }
    echo("</table>");


    ?>

    <div id="form-elem" >
      <form action="#" id="form" method="post">

        <label for="tnoo">Enter Train Number:</label><br>
        <input type='text' placeholder="Enter Train Number" name="tno" id="tno"></input><br><br>
        <label for="class">Enter Class:</label><br>

        <select name="train_class" id="train_class" required>
          <option value=""></option>
          <option value="A1">A1</option>
          <option value="2TIERAC">2 Tier AC</option>
            <option value="3TIERAC">3 Tier AC</option>
              <option value="SLEEPER">Sleeper</option>
        </select><br><br>
        <!-- <input type='text' placeholder="A1"></input><br><br> -->
        <label for="ticket">Enter Total Number of Tickets:</label><br>
        <input type='number' placeholder="1" min=1 name="tickets" id="tickets"></input><br><br>
        <input type="submit" id="Book" name="Book" value="Book">
      </form>


  </div>
  <?php
        //echo("<script>alert('Wrong credentialssqxd!');</script>") ;
        if(isset($_POST['Book']))
        {
          $tno=$_POST['tno'];
          $train_class=$_POST["train_class"];
          $tickets=$_POST["tickets"];

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


           //db
          else
          {
            $con=mysqli_connect("localhost","Administrator","#Kalizen0123") or die("Unable to connect");
            mysqli_select_db($con,"train_database");
            //$sql="select '$train_class' from train_details where TrainNumber='$tno'";
            $sql="select * from train_details where TrainNumber='$tno'";
            $result = $con->query($sql);
            if ($result->num_rows > 0)
            {
                  while($row =$result ->fetch_assoc())
                  {
                    //echo($row[$train_class]);//GETS RESPECTIVE CLASS TICKET COUNT LEFT
                    $tickets_in_db=$row[$train_class];
                    //echo($row["A1"]);
                  }
                  //$tickets_in_db-=
                  //echo($result);

                  if($tickets_in_db-$tickets<0)
                  {
                    echo("Sorry,the count of ".$tickets." tickets is not available");
                  }
                  else
                  {
                    $tickets_in_db-= $tickets;
                    $sql="UPDATE train_details SET $train_class=$tickets_in_db WHERE TrainNumber=$tno";
                    $result = $con->query($sql);
                    $usname=$_SESSION['username'];
                    $sql="INSERT INTO booking_details (Name,TrainNumber,Class,TicketsBooked) VALUES ('$usname','$tno','$train_class','$tickets')";
                    $result = $con->query($sql);
                    echo("The count of ".$tickets." successfully booked in ".$train_class." class" );



                  }

            }

            else
            {
              echo("Server Error,Please Try Again");
            }
          }

        }

   ?>
</div>
</body>
<html>
