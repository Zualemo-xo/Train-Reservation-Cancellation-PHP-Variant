<?php
    session_start();
?>

<html>
<head>
  <title>Login</title>
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

  #Log-In{
    padding-left: 35px;
    padding-right: 35px;
    padding-top: 10px;
    padding-bottom: 10px;
    background-image: radial-gradient(#B2FEFA,#0ed2f7);
  }
</style>

<body>
  <h1>Railways Login Page</h1>
  <div id="form-ele" >
    <form action="#" id="form" method="post">

      <label for="username">Username:</label>
      <input type='text' id='uname' name='uname' placeholder="Enter username"></input><br><br>
      <label for="username">Password:</label>
      <input type='password' id='password' name='password' placeholder="Enter password"></input><br><br>
      <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me</label><br><br>
      <input type="submit" id="Log-In" name="Log-In" value="Log In">
    </form>
      <?php
        if(isset($_POST['Log-In']))
        {
          $uname=$_POST['uname'];
          $password=$_POST['password'];
          //Form Validation
          if($uname=="")
          {
            echo("<h3>Enter username!</h3>");
          }

          else if($password=="")
          {
            echo("<h3>Enter password!</h3>");
          }

          //Checking in database
          else
          {

            $con=mysqli_connect("localhost","Administrator","#Kalizen0123") or die("Unable to connect");
            mysqli_select_db($con,"train_database");
            $sql="select * from login where Username='$uname' and Password='$password'";
            $result = $con->query($sql);
            if($result->num_rows > 0)
            {
              echo("<h3>You will be redirected</h3>");
              $_SESSION['username']=$uname;
              header("Location: select.php");

            }

            else
            {
              echo("<h3 style='color:red;'>Wrong credentials!</h3>");
              // echo("<script>alert('Wrong credentials!');</script>")  ;
            }
          }
        }
    ?>
  </div>
</body>
</html>
