var xmlHttp, xmlHttp2, xmlHttp3, xmlHttp4;
var markerPrev, dragable = false;

var galeryID;
var imgID, imgPos;


function listGaleries()
{ 
	document.getElementById("galeries").innerHTML="<img src='loading.gif' align='absmiddle'>&nbsp;&nbsp;<font face='verdana' size='1'>Loading data..</font>"
	
	var url="ajax.php?op=listGaleries&sid="+Math.random()
	xmlHttp=GetXmlHttpObject(stateChanged)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 

function stateChanged() 
{ 
    if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
    { 
	document.getElementById("galeries").innerHTML=xmlHttp.responseText 
    } else { 

	document.getElementById("galeries").innerHTML = "<img src='loading.gif' align='absmiddle'>&nbsp;&nbsp;<font face='verdana' size='1'>Loading data..</font>"
    }

	if(galeryID)
	{
		selectGalery(galeryID);
		
		if (navigator.appVersion.indexOf("MSIE")!=-1)
		{
			document.getElementById(galeryID).style.setAttribute("border", "1px solid red");
		} else {
			document.getElementById(galeryID).style.border = "1px solid red;";
		}

	}

} 


function listImages(gID, imgID, imgPos)
{ 
	galeryID = gID;
	
	document.getElementById("images").innerHTML="<img src='loading.gif' align='absmiddle'>&nbsp;&nbsp;<font face='verdana' size='1'>Loading data..</font>"

	var url="ajax.php?op=listImages&id=" + gID + "&imgID=" + imgID + "&imgPos="+imgPos;
	xmlHttp2=GetXmlHttpObject(stateChanged2)
	xmlHttp2.open("GET", url , true)
	xmlHttp2.send(null)
	
} 


function stateChanged2() 
{ 
    if (xmlHttp2.readyState==4 || xmlHttp2.readyState=="complete")
    { 
	document.getElementById("images").innerHTML=xmlHttp2.responseText 
    } else { 

	document.getElementById("images").innerHTML = "<img src='loading.gif' align='absmiddle'>&nbsp;&nbsp;<font face='verdana' size='1'>Loading data..</font>"
    }

} 



function cmdImage(op, id, parm)
{ 
	document.getElementById("images").innerHTML="<img src='loading.gif' align='absmiddle'>&nbsp;&nbsp;<font face='verdana' size='1'>Loading data..</font>"
	
	var url="ajax.php?op="+op+"&id="+id+"&parm="+parm+"&sid="+Math.random()
	xmlHttp3=GetXmlHttpObject(stateChanged3)
	xmlHttp3.open("GET", url , true)
	xmlHttp3.send(null)
} 


function stateChanged3() 
{ 
    if (xmlHttp3.readyState==4 || xmlHttp3.readyState=="complete")
    { 
	document.getElementById("images").innerHTML=xmlHttp3.responseText 
    } else { 

	document.getElementById("images").innerHTML = "<img src='loading.gif' align='absmiddle'>&nbsp;&nbsp;<font face='verdana' size='1'>Loading data..</font>"
    }
	
	reloadGalery();
} 


function cmdGalery(op, id, parm, parm1)
{ 
	document.getElementById("galeries").innerHTML="<img src='loading.gif' align='absmiddle'>&nbsp;&nbsp;<font face='verdana' size='1'>Loading data..</font>"
	
	var url="ajax.php?op="+op+"&id="+id+"&parm="+parm+"&parm1="+parm1+"&sid="+Math.random()
	xmlHttp4=GetXmlHttpObject(stateChanged4)
	xmlHttp4.open("GET", url , true)
	xmlHttp4.send(null)

	if(op == "delGalery")
	{
		galeryID = false;
		galeryPrev = false;
	}
} 

function stateChanged4() 
{ 
    if (xmlHttp4.readyState==4 || xmlHttp4.readyState=="complete")
    { 
	document.getElementById("galeries").innerHTML=xmlHttp4.responseText 
    } else { 

	document.getElementById("galeries").innerHTML = "<img src='loading.gif' align='absmiddle'>&nbsp;&nbsp;<font face='verdana' size='1'>Loading data..</font>"
    }
	
} 





document.onmousedown = mouseDown;
document.onmouseup = mouseUp;
//document.onmousemove = mouseMove;


function setPosition(el)
{

	if(dragable)
	{

		imgPos = el;

		// set marker
		document.getElementById(el).style.borderLeft = "2px solid red";



	}
	return false;
}





function resetPosition(el)
{

	// reset previous

	if(document.getElementById(el))
		document.getElementById(el).style.borderLeft = "0px solid white";

}






function setImage(el)
{

	imgID = el;
}






function mouseDown(e)
{
	
	dragable = true;
		
	return false;
}



function mouseUp(e)
{
	
	dragable = false;
	
	if(parseInt(imgID) && parseInt(imgPos))
	{
		listImages(galeryID, imgID, imgPos)
	}

	imgID = false;
	imgPos = false;

	return false;
}













function GetXmlHttpObject(handler)
{ 
   
	
    var objXmlHttp=null

    

	if (window.XMLHttpRequest) {
		objXmlHttp = new XMLHttpRequest();
		objXmlHttp.onload=handler
		objXmlHttp.onerror=handler 

	} else if (window.ActiveXObject) {
    		// Try ActiveX
		try { 
			objXmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
			objXmlHttp.onreadystatechange=handler;
		} catch (e1) { 
			// first method failed 
			try {
				objXmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
				objXmlHttp.onreadystatechange=handler;
			} catch (e2) {
				 // both methods failed 
				 alert("Unable to support your browser!");
			} 
		}
 	}

return objXmlHttp;



} 