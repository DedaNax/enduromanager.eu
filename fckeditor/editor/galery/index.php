<html>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<script>
	galeryID = false;
	galeryPrev = false;
</script>


<script src="ajax.js"></script>

<style>

.poga
{
	font-family: verdana;
	font-size: 10px;
	font-weight: bold;
}

.box
{
	font-family: verdana;
	font-size: 10px;
	text-align: center;
}

</style>

<script>



function isOK()
{
	if (galeryID)
	{
    str = "javascript:void(window.open('galery.php?id="+galeryID+"','xx','resizable=no,location=no,menubar=no,scrollbars=no,status=no,toolbar=no,fullscreen=no,width=720,height=450,dependent=no'))";

    window.opener.FromGalery(str);
	window.close();
	} else {
		alert("Galery shold be selected!");
	}
}


function selectGalery( id )
{
	galeryID = id;
	
	// ielasa bildītes
	document.getElementById("images").innerHTML = "buus bildiites" + galeryID;

	// aktivizē "Add Images"
	document.getElementById("addImages").style.visibility = "visible";
	//document.getElementById("delGalery").style.visibility = "visible";
	document.getElementById("editGalery").style.visibility = "visible";

	// iezīmē rāmīti

	if (navigator.appVersion.indexOf("MSIE")!=-1)
	{
		document.getElementById(id).style.setAttribute("border", "1px solid red");
	} else {
		document.getElementById(id).style.border = "1px solid red;";
	}
	
	if(galeryPrev != false)
	{
		if (navigator.appVersion.indexOf("MSIE")!=-1)
		{
			document.getElementById(galeryPrev).style.setAttribute("border", "1px solid black");
		} else {
			document.getElementById(galeryPrev).style.border = "1px solid black;";
		}
	
	}
	
	galeryPrev = id;

	listImages(galeryID);
}



function addGalery()
{
	var reply = prompt("Create new galery",  "Untitled");
	if(reply)
	{
		cmdGalery("addGalery", reply);
	}
}

function editGalery()
{
	{
	x = window.open("edit_galery.php?id="+galeryID,"edit","resizable=no,location=no,menubar=no,scrollbars=no,status=no,toolbar=no,fullscreen=no,width=320,height=50,dependent=yes");
	}
	

	//var reply = prompt("Rename galery");
	//if(reply)
	//{
	//	cmdGalery("editGalery", galeryID, reply, param1);
	//}
}

function delGalery()
{
	if(confirm("You are about to delete galery ["+galeryID+"] \n\n Are you sure?"))
	{
		cmdGalery("delGalery", galeryID);
	}
}


function reloadGalery()
{
	listGaleries();
}

function addImage()
{
   x = window.open("add_picture.php?id="+galeryID,"add","resizable=no,location=no,menubar=no,scrollbars=no,status=no,toolbar=no,fullscreen=no,width=320,height=50,dependent=yes");
}


function delImage(id)
{
	if(confirm("You are about to delete image ["+id+"] \n\n Are you sure?"))
	{
		cmdImage("delImage", id, galeryID);
	}
}

</script>


<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" onLoad=JavaScript:listGaleries();>


<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-color: #737152;">

<tr>
	<td height="50" bgcolor="#E7E3C6">
		<span style="font-family: arial; font-size: 20; font-weight: bold; color: #737152; padding: 10px;">Galery browser</span>
	</td>
</tr>

<tr>

<td bgcolor="#F7F3E7" valign="top" style="padding: 7px;">

<div id="galeries" style="overflow-x: hidden; overflow-y: auto; width: 100%; height: 400px;">

</div>
</td>
</tr>

<tr>
	<td height="30" bgcolor="#E7E3C6">
		<span style="padding-left: 17px;">
		<span id="addGalery" class="poga" onClick=JavaScript:addGalery();> Add &nbsp;&nbsp;</span>  
		<span id="editGalery" class="poga" onClick=JavaScript:editGalery(); style="visibility: hidden;"> Edit &nbsp;&nbsp;</span>
		<span id="reloadGalery" class="poga" onClick=JavaScript:reloadGalery();> <img src='reload.gif' align='middle'> &nbsp;&nbsp;</span>
		</span>
	</td>
</tr>


<tr>
	<td height="150" bgcolor="#F7F3E7" valign="top">
	<div id="images" style="position: absolute; overflow-x: auto; overflow-y: auto; width: 100%; height: 150px;">

	</div>
	</td>
</tr>


<tr>
	<td height="50" bgcolor="#E7E3C6">
	
	<div style="position: relative; width: 100%; height: 100%;">
		<div onClick=JavaScript:addImage(); id="addImages" style="position: absolute; top: 15px; left: 20px; visibility: hidden;" class="poga">
			Add images
		</div>
		<div style="position: absolute; top: 17px; left: 700px;">
			<input id="ok" type="button" value="OK" style="border: 1px solid #737152; background: #C6C78C; width: 100px; font-family: arial; font-size: 12px;" onClick="JavaScript:isOK();">
		</div>
		<div style="position: absolute; top: 17px; left: 810px;">
			<input onClick=JavaScript:window.close(); type="button" value="Cancel" style="border: 1px solid #737152; background: #C6C78C; width: 60px; font-family: arial; font-size: 12px;">
		</div>
	</div>

	</td>
</tr>
</table>

</body>
</html>