<?php
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$email=$_POST['email'];
$user_name=$_POST['user_name'];
$password=$_POST['password'];
if(!empty($first_name)||!empty($last_name)||!empty($user_name)||!empty($email)||!empty($password))
{
	$host="localhost";
	$dbUsernamesername="root";
	$dbPassword=" ";
	$dbname="teachers";
	$conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
	if(mysqli_connect_error())
	{
		die(connect error('.mysqli_connect_error().')'.mysqli_connect_error());
	}
else
{
		$SELECT="SELECT email FROM teachers Where email=? Limit=1";
		$INSERT="INSERT Into teachers(first_name,last_name,user_name,email,password,) values(?,?,?,?,?)";
			$stmt=$conn->prepare($SELECT);
			$stmt->bind_param("s",$email);
			$stmt->execute();
			$stmt->bind_result($email);
			$stmt->store_result();
			$rnum=$stmt->num_rows;
			if(rnum==0)
			{
				$stmt->close();
				$stmt=$conn->prepare($INSERT);
				$stmt->bind_param("ssssi",$first_name,$last_name,$email,$user_name,$password);
				$stmt->execute();
				echo "WELCOME";
			}
			else{
				echo "email aldready exits";
			}
			$stmt->close();
			$conn->close();
}
}
else{
	echo "all fileds are required";
	die();
}
