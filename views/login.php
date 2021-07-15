
<?php 
ob_start();

if ( isset($_SESSION['user'])!="" ) {
 header("Location: /");
 exit;
}

$error = false;

if( isset($_POST['login']) ) { 
 
 $email = trim($_POST['email']);
 $email = strip_tags($email);
 $email = htmlspecialchars($email);
 
 $pass = trim($_POST['password']);
 $pass = strip_tags($pass);
 $pass = htmlspecialchars($pass);
 
 if(empty($email)){
  $error = true;
  $emailError = "Please enter your email address.";
 } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
  $error = true;
  $emailError = "Please enter a valid email address.";
 }
 
 if(empty($pass)){
  $error = true;
  $passError = "Please enter your password.";
 }
 
 if (!$error) {
   
  $query = "SELECT id, name, password FROM users WHERE email='$email'";
  $res= $db->query($query);
  $row= $res->fetch(PDO::FETCH_ASSOC);

  $count = $res->rowCount();

  var_dump($row);
  echo "<br>";
  var_dump($count);
  if( $count == 1 && $row['password']==$pass ) {
   $_SESSION['user'] = $row['id'];
   header("Location: /");
  } else {
   $errMSG = "Incorrect Credentials, Please try again...";
   print_r($errMSG);
  } 
 }
}



if ( isset($_POST['signup']) ) {
  
	$name = trim($_POST['name']);
	$name = strip_tags($name);
	$name = htmlspecialchars($name);
	
	$email = trim($_POST['email']);
	$email = strip_tags($email);
	$email = htmlspecialchars($email);
	
	$pass = trim($_POST['password']);
	$pass = strip_tags($pass);
	$pass = htmlspecialchars($pass);
	
	if (empty($name)) {
	 $error = true;
	 $nameError = "Please enter your full name.";
	} else if (strlen($name) < 3) {
	 $error = true;
	 $nameError = "Name must have atleat 3 characters.";
	} else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
	 $error = true;
	 $nameError = "Name must contain alphabets and space.";
	}
	
	if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
	 $error = true;
	 $emailError = "Please enter valid email address.";
	} else {
	 $query = "SELECT email FROM users WHERE email='$email'";
	 $result = $db->query($query);
	 $count = $result->fetchColumn();
	 if($count!=0){
	  $error = true;
	  $emailError = "Provided Email is already in use.";
	 }
	}
	if (empty($pass)){
	 $error = true;
	 $passError = "Please enter password.";
	} else if(strlen($pass) < 6) {
	 $error = true;
	 $passError = "Password must have atleast 6 characters.";
	}
	
	$password = hash('sha256', $pass);
	
	if( !$error ) {

	 $query = $db->prepare("INSERT INTO users SET  name= ?, email= ?, password= ?"); 
	 $res = $query->execute(array($name,$email,$pass));

	 if ($res) {
	  $errTyp = "success";
	  $errMSG = "Successfully registered, you may login now";
	  unset($name);
	  unset($email);
	  unset($pass);
	 } else {
	  $errTyp = "danger";
	  $errMSG = "Something went wrong, try again later..."; 
	 } 
	  
	}
   }
?>

<?php
include 'layout/header.php';
?>
<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Hesabınıza Giriş Yapın</h2>
						<form action="login" method="post">
							<input type="email" placeholder="Email" name="email" />
							<input type="password" placeholder="Parola" name="password"/>
							<span>
								<input type="checkbox" class="checkbox"> 
								Beni Hatırla
							</span>
							<button type="submit" name="login" class="btn btn-default">Giriş Yap</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">YA DA</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Yeni Kullanıcı Oluşturun!</h2>
						<form action="signup" method="post">
						<div class="form-group">
							<input type="text" placeholder="Name" name="name"/>
							<span><?php if(!empty($nameError)) {echo $nameError;} ?></span>
						</div>
						<div class="form-group">
							<input type="email" placeholder="Email Address" name="email"/>
							<span ><?php if(!empty($emailError)) {echo $emailError;} ?></span>
						</div>
						<div class="form-group">
							<input type="password" placeholder="Password" name="password"/> 
							<span><?php if(!empty($passError)) {echo $passError;} ?></span>
						</div>

							<button type="submit" name="signup" class="btn btn-default">Kayıt Ol</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
    <?php
include 'layout/footer.php';
?>    