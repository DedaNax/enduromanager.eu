<?php

session_start();

ob_start();

?>


<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>

#container
{
	position: relative;
	width: 300px;
	height: 200px;
}

#label
{
	position: absolute;
	border-top: 1px solid black;
	border-left: 1px solid black;
	border-right: 1px solid black;
	background: white;
	font-family: verdana;
	font-size: 12px;
	top: 0px;
	left: 10px;
	width: 100px;
	height: 16px;
	z-index: 10; 
}

#labelshadow
{
	position: absolute;
	border: 1px solid gray;
	background: gray;
	top: 2px;
	left: 12px;
	width: 100px;
	height: 16px;
	z-index: 3; 
}

#shadow
{
	position: absolute;
	border: 1px solid gray;
	background: gray;
	top: 18px;
	left: 2px;
	width: 250px;
	height: 150px;	
	z-index: 0;
}

#frame
{
	position: absolute;
	border: 1px solid black;
	background: white;
	text-align: left;
	top: 15px;
	left: 0px;
	width: 250px;
	height: 150px;	
	z-index: 5;
}

</style>

<body bgcolor="#ECE9DB" OnLoad="document.logon.user.focus();">


<table width="100%" height="80%">

<tr>
	<td valign='middle' align='center'>
		<div id='container'>


			<div id='labelshadow'>&nbsp;</div>
			
			<div id='label' >
				<b>Logon:</b>
			</div>

			<div id='shadow'>&nbsp;</div>

			<div id='frame'>

				<form name='logon' method="POST" action="">

					<div style='position:absolute; top:18px; left:10px; width:200px; font-family: verdana; font-size:10px; text-align:center; color:red;'>
						<b><status></b>
					</div>

					<div style='position:absolute; top:42px; left:10px; width:80px; font-family: verdana; font-size:10px; text-align:right; color:gray;'>
						UserName:
					</div>

					<div style="position:absolute; top:40px; left:100px;">
						<input type="text" name="user" style='border: 1px solid gray; width:120px;'>
					</div>

					<div style='position:absolute; top:72px; left:10px; width:80px; font-family: verdana; font-size:10px; text-align:right; color:gray;'>
						Password:
					</div>

					<div style="position:absolute; top:70px; left:100px;">
						<input type="password" name="pass" style='border: 1px solid gray; width:120px;'>
					</div>


					<div style='position:absolute; top:112px; left:10px; width:110px; font-family: verdana; font-size:10px; text-align:right; color:gray;'>
						Atcerēties?
					</div>

					<div style='position:absolute; top:110px; left:120px; width:20px; font-family: verdana; font-size:10px; text-align:right; color:gray;'>
						<input type="checkbox" name="remember" style="border:1px solid gray;">
					</div>

					<div style="position:absolute; top:110px; left:200px;">
						<input type="submit" name="submit" value="Go" style='border: 1px solid gray; width:120px; width:22px;height:18px;font-family: verdana;font-size:10px;'>
					</div>



				</form>

			</div>


		</div>
	</td>
</tr>

</table>


</body>
</html>

<?php

$data = ob_get_contents();
ob_end_clean();
flush();



if(isset($_POST['user']) && !isset($_SESSION['adm']))
{

	// Chekojam, username:password

	$users = array("admin");
	$auth = false;

	if(($key = array_search($_POST['user'], $users)) !== false)
	{
		if($_POST['pass'] == "admin")
		{
			$auth = true;
			$_SESSION['adm'] = true;
			
			
		} else {

			$auth = false;
			$_SESSION['adm'] = false;

		}
	}


	if($auth != true)
	{
		$d = str_replace("<status>", "Autorizācija izgāzās!", $data);
		echo $d;
		exit;

	}


} else if(!isset($_SESSION['adm'])) {
	
	echo $data;
	exit;
}


?>