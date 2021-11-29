<html>
<head><title>Message Board</title></head>
<body>

<?php
session_start();
$username = $_SESSION['username'];
//$mid = $_SESSION['mid'];
echo "<hr size =2 color = black><br>";
echo '<form method="POST"> ';
if ($username == '')
{
	echo "user not logged in, Please login to continue...<br><br>";
	echo '<input type="submit" name="login_new" value="Login"/><br><br>';
	if(isset($_POST['login_new']))
	{
		session_destroy();
		header('location: login.php');
	}
	
	
}	

else
{
	echo "<p>User Logged in: ". $username."</p>";
	echo '<input type="submit" name="txtarea" value="New Post"/><br><br>';
	echo '<textarea name = "txt"></textarea><br><br>';
	echo '<input type="submit" name="logout" value="logout"/><br><br>';
	
	if(isset($_POST['logout']))
	{
		//session_start();
		session_destroy();
		header('location: login.php');
	}
	
	if(isset($_POST['txtarea']))
	{
		$Message = $_POST['txt'];
		//print $Message;
		try
		{
			$dbh = new PDO("mysql:host=127.0.0.1:3306;dbname=board","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			$dbh->beginTransaction();
			$dbh->exec('INSERT INTO `posts` (`id`, `postedby`, `datetime`, `message`) VALUES ("'. uniqid() . '"' .','. '"'.$username.'"' .', now(),"' . $Message . '")') or die(print_r($dbh->errorInfo(), true)) ;
			$dbh->commit();
		}
		
		catch (PDOException $e)
		{
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	
	}
	
	
	
	if(isset($_POST['reply']))
	{
			$mid = $_GET['mid'];
			//$mid = $_SESSION['mid'];
			//$mid='12dd3f55';
			$Message = $_POST['txt'];
			//echo "MID::::::::::::::::::::::: ". $mid ;
			
			try
			{
				$dbh = new PDO("mysql:host=127.0.0.1:3306;dbname=board","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
				$dbh->beginTransaction();
				$dbh->exec('INSERT INTO `posts` (`replyto`,`id`, `postedby`, `datetime`, `message`) VALUES ("'.$mid.'","'. uniqid() . '"' .',"'.$username.'"' .', now(),"' . $Message . '")') or die(print_r($dbh->errorInfo(), true)) ;
				$dbh->commit();
			}
		
			catch (PDOException $e)
			{
				print "Error!: " . $e->getMessage() . "<br/>";
				die();
			}
		
	}
	
	
	error_reporting(E_ALL);
	ini_set('display_errors','On');
	
	echo "<font face = garamond size =5><B><U>All Messages in forum: </U></B></font><br><br>";
	echo "<table border=1>";
	echo '<tr>
	<th> Message ID </th>
	<th> User Name </th>
	<th> Full Name </th>
	<th> Date and Time </th>
	<th> Reply To </th>
	<th> Message Text </th>
	<th> Reply Messages </th>
	</tr>';
	
	try
		{
			global $mid;
			$dbh = new PDO("mysql:host=127.0.0.1:3306;dbname=board","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			$dbh->beginTransaction();
			$dbh->exec('delete from users where username="smith"');
			$dbh->exec('insert into users values("smith","' . md5("mypass") . '","John Smith","priyankgupta2014@live.com")')
					or die(print_r($dbh->errorInfo(), true));
			$dbh->commit();
			$stmt = $dbh->prepare('select p.id, u.username, u.fullname, p.datetime, p.replyto, p.message from users u, posts p where u.username = p.postedby order by p.datetime desc');
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				echo "<tr> <td>". $row['id']. "</td>";
				echo "<td>". $row['username']. "</td>";
				echo "<td>". $row['fullname']. "</td>";
				echo "<td>". $row['datetime']. "</td>";
				echo "<td>". $row['replyto']. "</td>";
				echo "<td>". $row['message']. "</td>";
				$rp=$row['id'];
				//$_SESSION['mid']= $rp;			
				//echo '<td><button type=submit name=reply formaction="login.php?test=1234">Reply Message</button></td></tr>';
				echo '<td><button type=submit name=reply formmethod=POST formaction="board.php?mid='.$rp. '">Reply</button></td></tr>';
			}
			
		}
		
	catch (PDOException $e)
		{
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
		
	echo "</table>";
	echo "</form>";
}
?>
</body>
</html>
