<?php
	session_start();
	if(isset($_POST["insert"])){
        $anun = htmlspecialchars($_POST["anun"]); 
        $azganun = htmlspecialchars($_POST["azganun"]);
        $email = htmlspecialchars($_POST["email"]);
        $pass = htmlspecialchars($_POST["pass"]);
        $pass2 = htmlspecialchars($_POST["pass2"]);
        $tari = htmlspecialchars($_POST["tari"]);
        $amis = htmlspecialchars($_POST["amis"]);
        $or = htmlspecialchars($_POST["or"]);
        $male = htmlspecialchars($_POST["ser"]);
        $_SESSION["anun"] = $anun;
        $_SESSION["azganun"] = $azganun;
        $_SESSION["email"] = $email;
        $_SESSION["pass"] = $pass;
        $_SESSION["pass2"] = $pass2;
        $_SESSION["tari"] = $tari;
        $_SESSION["amis"] = $amis;
        $_SESSION["or"] = $or;
        $_SESSION["ser"] = $male;
        $error_anun = "";
        $error_azganun = "";
        $error_email = "";
        $error_pass = "";
        $error_pass2 = "";
        $error_tari = "";
        $error_amis = "";
        $error_or = "";
        $error_male = "";
        $error = false;

        $aysor = date("YmdHis");
	  	$uploadPath = "upload/";
        $_SESSION["papka"] = $uploadPath;
	  	$newFile = basename(($_FILES["fileToUpload"]["name"]));
	  	$fileType = $_FILES["fileToUpload"]["type"];
	  	if(($_FILES["fileToUpload"]["size"] > 1048576)){	
	        $error_size = "Ձեր նկարի ծավալը մեծ է խնդրում ենք բեռնել մինջև 1 mb ծավալով նկար";
	        $errornkar = true;
	    } elseif(file_exists($aysor.$newFile)){
	  		$error_file = "Այդպիսի անունով նկար առկա է ";  
	  		$errornkar = true;   
		} elseif($fileType != "image/jpg" && $fileType != "image/png" && $fileType != "application/pdf" && $fileType != "image/jpeg"){
	        $error_type = "Խնդրում ենք բեռնել միայն նկար";
	        $errornkar = true;
	  	} else {
	  		  		
	    	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $uploadPath.$aysor.$newFile);
	    } 

        $nkariAnun = "";
        if(isset($newFile) && $newFile != ""){
            $nkariAnun = $uploadPath.$aysor.$newFile;
        }
        
        if(isset($_POST["ser"]) && $_POST["ser"] == 1){
        	$male = 1;
        } else {
        	$male = 2;
        }

        if(strlen($anun) == 0) {
            $error_anun = "Դուք չեք մուտքագրել ձեր անունը";
            $error = true;
        }

        if(strlen($azganun) == 0) {
            $error_azganun = "Դուք չեք մուտքագրել ձեր ազգանունը";
            $error = true;
        }

        if($email == "" || !preg_match("/@/", $email)) {
            $error_email = "Դուք չեք մուտքագրել ձեր էլ.փոս.հասցեն";
            $error = true;
        }

        if(strlen($pass) == 0) {
            $error_pass = "Դուք չեք մուտքագրել ձեր գաղտնաբառը";
            $error = true;
        } 

        if(strlen($pass2) == 0 || !($pass == $pass2)) {
            $error_pass2 = "կրկին մուտքագրել ձեր գաղտնաբառը";
            $error = true;
        } 

        if(!$error){
            $cnund = date( $tari."-".$amis."-".$or." 00:00:00");    
            $s2 = (time() - strtotime($cnund)) / (60 * 60 * 24 * 365);  
            $age = floor($s2);
           
           
            $aysTari = date("Y");    
            $birthday = $tari."-".$amis."-".$or;
            $kap = mysqli_connect('localhost:3306', 'root', '','usbaz');
            mysqli_query($kap,"SET NAMES 'utf-8'");
            $insertUser = mysqli_query($kap,"INSERT INTO ustab(name,surname,age,birthday,email,pswd,foto,regdate,male) VALUES ('$anun','$azganun','$age','$birthday','$email','$pass','$nkariAnun',NOW(),'$male');");
            if(!$error){
                header("location: index.php");
            }else {
                header("location: user.php");	
            } 
        } 
    }
?>

<!DOCTYPE html>
<html>
    <head>
    	<title>Users List</title>
	    <meta charset="UTF-8" />
	    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
           <style type="text/css">

            body {
                background-color: #363954;
                color: #f3f5f0;
            } 	

            label {
	            font-size: 20px;
            }

            input {
	            font-size: 25px;
                /*padding: 5px 5px 5px 5px;*/
            }

            span {
	            color: red;
	            font-size: 15px;
            }

            h3 {
	            font-size: 30px;
            }

            select {
	            font-size: 20px;
            }

            div {
	            width: 90%;
	            padding: 5px; 
            }

            .maindiv {
	            width: 91%;
	            margin: auto;
	            text-align: center;
            }
        </style>	
    </head>
    <body bgcolor="grey">
    	<div class="container-lg">
	        <form action="" method="post" enctype="multipart/form-data" class="was-validated">
	            <div class="maindiv">
                    <div align="center">
                        <h3>Գրանցվեք մեր կայքում</h3>
                        <div>     	
                            <label for="anun" >Մուտքագրեք ձեր անունը :</label> 
                            <span><?=@$error_anun?></span>   
                            <input type="text" class="form-control" name="anun" id="anun" value="<?=@$_SESSION["anun"]?>" size="20" placeholder="Մուտքագրեք ձեր անունը..."  required/>
                            <div class="invalid-feedback">Դուք չեք մուտքագրել ձեր անունը</div>
                        </div>
                        <div> 
                            <label for="azganun" >Մուտքագրեք ձեր ազգանունը :</label>
                            <span><?=@$error_azganun?></span>    	
                            <input type="text" class="form-control" name="azganun" id="azganun" value="<?=@$_SESSION["azganun"]?>"  size="35" placeholder="Մուտքագրեք ձեր ազգանունը..."  required/>
                            <div class="invalid-feedback">Դուք չեք մուտքագրել ձեր ազգանունը</div>
                        </div>
                        <div>
                            <label for="email">Մուտքագրեք ձեր էլեկտրոնային փոստի հասցեն :</label>
                            <span><?=@$error_email?></span>
                            <input type="text" class="form-control" name="email" id="email" value="<?=@$_SESSION["email"]?>" size="35" placeholder="Մուտքագրեք ձեր էլեկտրոնային փոստի հասցեն..."  required/>
                            <div class="invalid-feedback">Դուք չեք մուտքագրել ձեր էլ.փոս.հասցեն</div>
                        </div>
                        <div>
                            <label for="pass">Մուտքագրեք ձեր գաղտնաբառը :</label>
                            <span><?=@$error_pass?></span> 	
                            <input type="password" class="form-control" name="pass" id="pass" value="<?=@$_SESSION["pass"]?>"  size="35" placeholder="Մուտքագրեք ձեր ձեր գաղտնաբառը..." required/>
                            <div class="invalid-feedback">Դուք չեք մուտքագրել ձեր գաղտնաբառը</div>
                        </div>
                        <div>
                            <label for="pass2">Կրկին մուտքագրեք ձեր գաղտնաբառը :</label>
                            <span><?=@$error_pass2?></span>
                            <input type="password" class="form-control" name="pass2" id="pass2" value="<?=@$_SESSION["pass2"]?>" size="35"placeholder="Կրկին մուտքագրեք ձեր ձեր գաղտնաբառը..." required/>
                            <div class="invalid-feedback">կրկին մուտքագրել ձեր գաղտնաբառը</div>
                        </div>
                        <div>
                            <label for="nkar">Տեղադրեք ձեր լուսանկարը :</label>
                            <span><?=@$error_nkar?></span> 	
                            <input type="file" name="fileToUpload" id="fileToUpload" value="Տեղադրել"/>
                            <div style="color: red"><?= @$error_size ?></div>
                            <div style="color: red"><?= @$error_file ?></div>
                            <div style="color: red"><?= @$error_type ?></div>
                        </div>
                        <div>
                        	<label for="male"> Արական </label> 
                        	<input type="radio" name="ser" id="male" value="1" />
							<label for="female"> Իգական </label> 
							<input type="radio" name="ser" id="female" value="2" />
                        </div>
                        <div>
                            <label for="date" > Մուտքագրեք ձեր ծննդյան տարին, ամիսը, օրը :</label>
                        </div>
                        <div>	
                            <select name="tari" id="tari">
                            	<option value="1940">1940</option>
		                        <option value="1941">1941</option>
		                        <option value="1942">1942</option>
								<option value="1943">1943</option>
								<option value="1944">1944</option>
								<option value="1945">1945</option>
								<option value="1946">1946</option>
								<option value="1947">1947</option>
								<option value="1948">1948</option>
								<option value="1949">1949</option>
                            	<option value="1950">1950</option>
		                        <option value="1951">1951</option>
		                        <option value="1952">1952</option>
								<option value="1953">1953</option>
								<option value="1954">1954</option>
								<option value="1955">1955</option>
								<option value="1956">1956</option>
								<option value="1957">1957</option>
								<option value="1958">1958</option>
								<option value="1959">1959</option>
		                        <option value="1960">1960</option>
		                        <option value="1961">1961</option>
		                        <option value="1962">1962</option>
								<option value="1963">1963</option>
								<option value="1964">1964</option>
								<option value="1965">1965</option>
								<option value="1966">1966</option>
								<option value="1967">1967</option>
								<option value="1968">1968</option>
								<option value="1969">1969</option>
								<option value="1970">1970</option>
								<option value="1971">1971</option>
								<option value="1972">1972</option>
								<option value="1973">1973</option>
								<option value="1974">1974</option>
								<option value="1975">1975</option>
								<option value="1976">1976</option>
								<option value="1977">1977</option>
								<option value="1978">1978</option>
								<option value="1979">1979</option>
								<option value="1980">1980</option>
								<option value="1981">1981</option>
								<option value="1982">1982</option>
								<option value="1983">1983</option>
								<option value="1984">1984</option>
								<option value="1985">1985</option>
								<option value="1986">1986</option>
								<option value="1987">1987</option>
								<option value="1988">1988</option>
								<option value="1989">1989</option>
								<option value="1990">1990</option>
								<option value="1991">1991</option>
								<option value="1992">1992</option>
								<option value="1993">1993</option>
								<option value="1994">1994</option>
								<option value="1995">1995</option>
								<option value="1996">1996</option>
								<option value="1997">1997</option>
								<option value="1998">1998</option>
								<option value="1999">1999</option>
								<option value="2000">2000</option>
								<option value="2001">2001</option>
								<option value="2002">2002</option>
								<option value="2003">2003</option>
								<option value="2004">2004</option>
								<option value="2005">2005</option>
								<option value="2006">2006</option>
								<option value="2007">2007</option>
								<option value="2008">2008</option>
								<option value="2009">2009</option>
								<option value="2010">2010</option>
								<option value="2011">2011</option>
								<option value="2012">2012</option>
								<option value="2013">2013</option>
								<option value="2014">2014</option>
								<option value="2015">2015</option>
								<option value="2016">2016</option>
								<option value="2017">2017</option>
								<option value="2018">2018</option>
								<option value="2019">2019</option>
								<option value="2020">2020</option>
                            </select>
	                        <select name="amis" id="amis">
								<option value="01">Հունվար</option>
								<option value="02">Փետրվար</option>
								<option value="03">Մարտ</option>
								<option value="04">Ապրիլ</option>
								<option value="05">Մայիս</option>
								<option value="06">Հունիս</option>
								<option value="07">Հուլիս</option>
								<option value="08">Օգոստոս</option>
							    <option value="09">Սեպտեմբեր</option>
								<option value="10">Հոկտեմբեր</option>
								<option value="11">Նոյեմբեր</option>
								<option value="12">Դեկտեմբեր</option>
	                        </select>	
	                        <select name="or" id="or">
								<option value="01">1</option>
								<option value="02">2</option>
								<option value="03">3</option>
								<option value="04">4</option>
								<option value="05">5</option>
								<option value="06">6</option>
								<option value="07">7</option>
								<option value="08">8</option>
								<option value="09">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
								<option value="13">13</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="16">16</option>
								<option value="17">17</option>
								<option value="18">18</option>
								<option value="19">19</option>
								<option value="20">20</option>
								<option value="21">21</option>
								<option value="22">22</option>
								<option value="23">23</option>
								<option value="24">24</option>
								<option value="25">25</option>
								<option value="26">26</option>
								<option value="27">27</option>
								<option value="28">28</option>
								<option value="29">29</option>
								<option value="30">30</option>
								<option value="31">31</option>
							</select>
                    	</div>
						<div>
							<input type="submit" class="btn btn-primary" name="insert" id="insert" value="Գրանցել">
						</div>
   					</div>
            	</div>	
        	</form>
        </dvi> 



       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
       <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    </body>
</html>