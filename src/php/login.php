<html>
<head><title>Message Board</title>
<h4>Message Board</h4>
</head>
<hr size=2 color =black><br>
<?php
//form start
echo '<form method="GET"><label> User Name &nbsp&nbsp </label><input type="text" name="username" value=""/> <br><br>';
echo '<label> Password&nbsp&nbsp&nbsp&nbsp&nbsp </label> <input type="password" name="pass" value=""/> <br><br>';
echo '<input type="submit" name="submit" value="Login"/> <br><br>';
//form end

//PDO Connection
try {
		$dbh = new PDO("mysql:host=127.0.0.1:3306;dbname=board","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

		if(isset($_GET['submit']))
		{
			print "Hiii...   ";
			$username = $_GET['username'];
			$password = $_GET['pass'];
			$login = $dbh->prepare('SELECT count(*) FROM  users WHERE username = :username and password=md5(:password)');
			$login->bindParam(':username', $username);
			$login->bindParam(':password', $password);
			$login->execute();
			$results = $login->fetchColumn();
			if($results > 0)
			{	

				print " Login Successful!!";
				print $results;
				session_start();
				$_SESSION['username']= $username;
				//echo "User Logged in: ". $_SESSION['username'];
				header('location: board.php');
			}
			else
			{

				print " Login Failed!!";
			}
		}
	
} 
catch (PDOException $e)
{
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
}
echo '</form>';
?>
</body>
</html>