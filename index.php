<?php 
  @$err = $_GET["err"];

  session_start();
    if(isset($_POST["insert"])){
        $email = $_POST["email"];
        $pass = $_POST["pass"]; 
        $_SESSION["email"] = $email;
        $_SESSION["pass"] = $pass;
        $error_email = "";
        $error_password = "";
        $error = false;
        $err = "Դուք գրանցված չեք մեր կայքում";
        if(strlen($email) == 0) {
            $error_email = "Դուք չեք մուտքագրել ձեր մայիլը ";
            $error = true;
        }

        if(strlen($pass) == 0) {
            $error_password = "Դուք չեք մուտքագրել ձեր գաղտնաբառը";
            $error = true;
        }

        if(!$error){
         $kap = mysqli_connect('localhost:3306', 'root', '','usbaz');
          mysqli_query($kap,"SET NAMES 'utf-8'");
           $selectUser = mysqli_query($kap,"SELECT id,email,pswd FROM ustab WHERE email = '$email' AND pswd = '$pass'");
          $row = mysqli_fetch_array($selectUser);
              if(@$row[1] != "" && $row[2] != "" ){
                  header("location: info.php?uid=".$row[0]);
              } else {
                  @header("location: index.php?err=".$err);
              }      
          }
        } 
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Mutq gordzeq mer kayq</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <style type="text/css">

      body {
        background:url(111.jpg);
        background-repeat: no-repeat; 
        background-color: #3f4cbf;
        color: #f3f5f0;
        
      }      

      a {
        background-color: #b7dde8;
        color: #f3f5f0;
      }

      label {
  
        font-size: 30px;
      }

      input {
        
        font-size: 25px;
        /*padding: 5px 5px 5px 5px;*/
      }

      h3 {
        font-size: 30px;
      }

      div {
        width: 90%;
        padding: 7px; 
      }

      .maindiv {
        width: 91%;
        margin: auto;
        text-align: center;
      }

    </style>  
  
  <!-- post = 8mb -10mb get = 2kb post = 8 000 000 ic 10 000 000 tar get = 2048 tar  -->
  </head>
  <body>
    <div class="container-lg">
      <form action="" method="post" class="was-validated">
        <div class="maindiv">
          <div align="center">
            <h3>Բարի գալուստ մեր կայք</h3>
            <div class="form-group">
              <label for="email">Էլեկտրոնային փոստի հասցե :</label>
              <input  type="text" class="form-control" name="email" id="email" value="" size="35" placeholder="Մուտքագրեք ձեր էլեկտրոնային փոստի հասցեն..." required/>
              <div class="valid-feedback"></div>
              <div class="invalid-feedback">Դուք չեք մուտքագրել ձեր էլ.փոս.հասցեն</div>
            </div>
        
            <div class="form-group">  
              <label for="pass">Մուտքագրեք ձեր գաղտնաբառը :</label> 
              <input type="password" class="form-control" name="pass" id="pass" value=""  size="35" placeholder="Մուտքագրեք ձեր գաղտնաբառը..." required/>
              <div class="valid-feedback"></div>
              <div class="invalid-feedback">Դուք չեք մուտքագրել ձեր գաղտնաբառը</div>
            </div>
            <div class="container">
              <div style="color: red; "><h4><?= $err ?></h4></div>
              <input type="submit" name="insert" id="insert" value="Մուտք" title="Հաստատել" class="btn btn-primary"/>
            </div>

            <div>
              <h5>Գրանցվեք մեր կայքում</h5>
            </div> 
            <div class="container">
              <a href="user.php" class="btn btn-primary btn-sm" target="blank" title="Գրանցվեք մեր կայքում">Գրանցվել</a>
            </div> 
          </div>
        </div>
      </form>
    </div> 


     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  </body>
</html>