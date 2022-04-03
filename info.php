<?php
  session_start();
  $uid = $_GET["uid"];
  $_SESSION["uid"] = $uid;
  
  $kap = mysqli_connect('localhost:3306','root','','usbaz');
  mysqli_query($kap,"SET NAMES 'utf-8'");
  $user = mysqli_query($kap,"SELECT name,surname,male,foto FROM ustab WHERE id = '$uid'");
  $row = mysqli_fetch_array($user);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
            <?php if(isset($row[3]) && $row[3] != "") { ?>
 
                <img src="<?= $row[3] ?>" class="rounded-circle" alt="Cinque Terre" width="100" height="75">   
                <?php } else {
                    if($row[2] == 1){ ?>
                        <img src="admin.png" class="rounded-circle" alt="Cinque Terre" width="100" height="75">
                <?php    } else { ?>
                            <img src="axchik.png" class="rounded-circle" alt="Cinque Terre" width="100" height="75">
                <?php    }
                    } 
                ?>
             
            <div align="left"><?= $row[0] ?></div>
            <div align="left"><?= $row[1] ?></div>

</body>
</html>