var xmlHttp;
var show = false; 
var id, parent;
var upload;




// jQuery goes here

$(document).ready(function(){

	if ($("ul.catList").length > 0) {	
		$("ul.catList").sortable({
			opacity: 0.5,			
			update: function(e, ui){
				var ids = $(this).sortable("toArray").toString();
				newOrder(ids);
			}
		});
	}
	


	
	if ($("ul.docsList").length > 0) {	
		$("ul.docsList").sortable({
			opacity: 0.5,			
			update: function(e, ui){
				var ids = $(this).sortable("toArray").toString();
				newOrder(ids);
			}
		});
	}	
	
	
	
	
	
	if ($("div.top").length > 0) {	
		$("div.top").sortable({
			opacity: 0.5,
			items: 'span.links',
			update: function(e, ui){
				var ids = $(this).sortable("toArray").toString();
				newOrder(ids);
			}
		});
	}	
	
	
	
	
	
	if ($("div.items").length > 0) {	
		
		// sort
		
		$("div.items").sortable({
			opacity: 0.5,			
			update: function(e, ui){
				var ids = $(this).sortable("toArray").toString();
				newOrder(ids);
			}
		});
		
		// edit
		
		$("div.item").bind("click", function() {
			
			editItem($(this).attr("id"));
		})
	}	
	
	
	
	
	
	
	
	
	
	
	
	
	if ($("#images .image").length > 0) {
		
		$("#images").sortable({
		
			opacity: 0.5,
			/* axis:	 'y', */
			/* containment : "parent",  */
			
			update: function(e, ui){
			
				
			}
			
		});
		
	}	
	
	
	
	

	$("div.items div.item").hover(function(){
		$(".delete", this).css("display", "block");
	},function(){
		$(".delete", this).css("display", "none");
	}); 




	// remove image
	
	$("div.items .delete").click( function() {
		
		var id = $(this).parents("div").get(0).id;
	
		if (confirm("Are you sure? " + id)) {
		
			document.frm.admin.value = "remove";
			document.frm.action = "admin.php?id=" + id;
			
			document.frm.submit();
		}		
		
		return false;
	})	
	
	
	
	
	
	$("div#images div.image").hover(function(){
		$(".delete", this).css("display", "block");
	},function(){
		$(".delete", this).css("display", "none");
	}); 	
	
	
	

	
	
	// tabs
	
	$(".tabs li").click(function() {
		
		var tabs = $("ul.tabs li");
		var cont = $("#tabs>div");
		
		for(var i=0; i<tabs.length; i++) {
			tabs.get(i).className = "";
			$(cont.get(i)).css("display", "none");
		}
		
		this.className = "active";
		
		for(var i=0; i<tabs.length; i++) {
			
			if(tabs.get(i).className == "active") {
				$(cont.get(i)).css("display", "block");
			}
		}
		
	});	
	

	
	
	uploadDone();
	
	
	if($('#upload').length > 0) {
		
			upload = new SWFUpload({
				// Backend Settings
				upload_url: BASE_URL + "swfUpload.php",	// Relative to the SWF file (or you can use absolute paths)
				post_params: {"id" : $('body').attr('id')},
	
				// File Upload Settings
				file_size_limit : "102400",	// 100MB
				file_types : "*.jpg",
				file_types_description : "Image Files",
	
				// Event Handler Settings (all my handlers are in the Handler.js file)
				file_dialog_start_handler : fileDialogStart,
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_start_handler : uploadStart,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,
	
				// Button Settings
				button_image_url : "images/61x22.png",	// Relative to the SWF file
				button_placeholder_id : "upload",
				button_width: 61,
				button_height: 22,
				
				
				custom_settings : {
					progressTarget : "uploadProgress",
					cancelButtonId : "uploadCancel"
				},				
				
				
				// Flash Settings
				flash_url : "js/swfupload.swf",
				
				// Debug Settings
				debug: false
			});


	}

	
	
	
	
	// http://craigsworks.com/projects/qtip/docs/tutorials
	
	if($('a.event[title]').length > 0) {
	
		$('a.event[title]').qtip({ 
			
			style: { 
				name: 'dark', 
				width: 400, 
				tip: true },
				
			position: {
			      corner: {
			         target: 'topLeft',
			         tooltip: 'bottomLeft'
			      }
			}
	
		});
	
	}
	

	
	$('#container-1').tabs();
	
	if($('input.date').length > 0)
		$('input.date').datepicker({ firstDay: 1, dateFormat: 'yy-mm-dd'});
	

		
});




function uploadDone() {
	
	if ($("#galerija").length > 0) {

		$("#galerija").sortable({
			opacity: 0.5,
			update: function(e, ui){
				// nop
			}
			
		});	
	}		
		

	$("#galerija .imageSet").hover(function(){
		$(".delete", this).css("display", "block");
	},function(){
		$(".delete", this).css("display", "none");
	}); 		
	
}




function rmImage(el) {

	$(el).parents(".imageSet").remove();
}







var urlobj;

function BrowseServer(obj)
{
	//urlobj = obj;
	
	OpenServerBrowser(
		"ckfinder/ckfinder.html",
		screen.width * 0.7,
		screen.height * 0.7 ) ;
}

function OpenServerBrowser( url, width, height )
{
	var iLeft = (screen.width  - width) / 2 ;
	var iTop  = (screen.height - height) / 2 ;

	var sOptions = "toolbar=no,status=no,resizable=yes,dependent=yes" ;
	sOptions += ",width=" + width ;
	sOptions += ",height=" + height ;
	sOptions += ",left=" + iLeft ;
	sOptions += ",top=" + iTop ;

	var oWindow = window.open( url, "BrowseWindow", sOptions ) ;
}

function SetUrl( url, width, height, alt )
{
	//document.forms[0].img.value = url;
	//$("img").get(0).src = "/gimage.php?img=" + url + "&w=150";
	
	$("input#files").val(url);
	// setImage(0, url)
}












var ret = null;

function add_picture(el)
{
	
	ret = el;
	
	return BrowseServer();
	
	var id = document.forms[0].id.value;

	var item = 'add_picture.php?id=' + id;
	w = window.open (item,"Picture","titlebar=no,toolbar=no,direcotries=no,location=no,statusbar=no,scrollbars=no, width=350,height=50,modal=1,dependant=yes,dialog=1");
	
}




function setImage(id, file)
{
	
	var img = " \
	<div class='image'> \
	<input type='hidden' name='images[]' value='" + file + "'> \
	<span><img src='gimage.php?img=" + file + "&w=200'></span> \
	</div>";
	
	if(ret) {
			
		$("input", ret).val( file );
		$("img", ret).remove();
		
		var html = $(ret).html();
		$(ret).html("<img src='gimage.php?img=" + file + "&w=200'><br>" + html);
		
		return;
	}
	
	if($("#images").length > 0)
		$("#images").append(img);
	
	if($("#image").length > 0) {
		document.forms[0].images.value = file;
		$("#image").html("<img src='gimage.php?img=" + file + "&w=200'>");
	}
	
}




function removeImage(el)
{
	
	if(confirm("Delete?")) {
	
		$(el).parent(".image").remove();
		
	}
}






function editItem(ids) {
	
	var item = 'pop_item.php?id=' + ids;
	w = window.open (item,"Edit","titlebar=no,toolbar=no,direcotries=no,location=no,statusbar=no,scrollbars=no, width=300,height=300,modal=1,dependant=yes,dialog=1");
	w.focus();	
}





function editKalendars(ids)
{
	var item = 'admin_kalendars.php?id=' + ids;
	w = window.open (item,"Edit","titlebar=no,toolbar=no,direcotries=no,location=no,statusbar=no,scrollbars=no, width=800,height=650,modal=1,dependant=yes,dialog=1");
	w.focus();
}


function removeKalendars(ids, title)
{
	if(confirm("Are you sure? \n" + Base64.decode(title) ))
	{
		location.href = location.href + '&remove=' + ids;		
	}
}









function edit(ids)
{
	var item = 'admin.php?admin=edit&id=' + ids;
	w = window.open (item,"Edit","titlebar=no,toolbar=no,direcotries=no,location=no,statusbar=no,scrollbars=no, width=800,height=650,modal=1,dependant=yes,dialog=1");
	w.focus();
}


function remove(ids, title)
{
	if(confirm("Are you sure? \n" + title))
	{
		document.frm.admin.value = "remove";
		document.frm.submit();		
	}
}



function insert(ids)
{
	if(document.frm.item.value.length > 1)
	{

		document.frm.admin.value = "insert";
		document.frm.submit();	

	}
}





function showInsert(ids)
{

	// toggle display input
	
	show = show ? false : true;

	
	if(show)
	{
		document.getElementById("insert").style.display = 'block';
	} else {
		document.getElementById("insert").style.display = 'none';
	}
}








function newOrder(ids)
{
	admin("newOrder&items=" + ids);
}









function admin(str)
{     
	var url="admin.php?admin=" + str;
	xmlHttp=GetXmlHttpObject(stateChanged)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
}
	





function stateChanged() 
{ 

    if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
    { 

		//if(xmlHttp.responseText.length > 1)
			//alert(xmlHttp.responseText);

	}
} 







function GetXmlHttpObject(handler)
{ 
   	
    var objXmlHttp = null;

	if (window.XMLHttpRequest) {
		
		objXmlHttp = new XMLHttpRequest();
		objXmlHttp.onload=handler;
		objXmlHttp.onunload=handler;
		objXmlHttp.onerror=handler; 
		objXmlHttp.onreadystatechange=handler;

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






/**
*
*  Base64 encode / decode
*  http://www.webtoolkit.info/
*
**/
 
var Base64 = {
 
	// private property
	_keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
 
	// public method for encoding
	encode : function (input) {
		var output = "";
		var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
		var i = 0;
 
		input = Base64._utf8_encode(input);
 
		while (i < input.length) {
 
			chr1 = input.charCodeAt(i++);
			chr2 = input.charCodeAt(i++);
			chr3 = input.charCodeAt(i++);
 
			enc1 = chr1 >> 2;
			enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
			enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
			enc4 = chr3 & 63;
 
			if (isNaN(chr2)) {
				enc3 = enc4 = 64;
			} else if (isNaN(chr3)) {
				enc4 = 64;
			}
 
			output = output +
			this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
			this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);
 
		}
 
		return output;
	},
 
	// public method for decoding
	decode : function (input) {
		var output = "";
		var chr1, chr2, chr3;
		var enc1, enc2, enc3, enc4;
		var i = 0;
 
		input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
 
		while (i < input.length) {
 
			enc1 = this._keyStr.indexOf(input.charAt(i++));
			enc2 = this._keyStr.indexOf(input.charAt(i++));
			enc3 = this._keyStr.indexOf(input.charAt(i++));
			enc4 = this._keyStr.indexOf(input.charAt(i++));
 
			chr1 = (enc1 << 2) | (enc2 >> 4);
			chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
			chr3 = ((enc3 & 3) << 6) | enc4;
 
			output = output + String.fromCharCode(chr1);
 
			if (enc3 != 64) {
				output = output + String.fromCharCode(chr2);
			}
			if (enc4 != 64) {
				output = output + String.fromCharCode(chr3);
			}
 
		}
 
		output = Base64._utf8_decode(output);
 
		return output;
 
	},
 
	// private method for UTF-8 encoding
	_utf8_encode : function (string) {
		string = string.replace(/\r\n/g,"\n");
		var utftext = "";
 
		for (var n = 0; n < string.length; n++) {
 
			var c = string.charCodeAt(n);
 
			if (c < 128) {
				utftext += String.fromCharCode(c);
			}
			else if((c > 127) && (c < 2048)) {
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}
			else {
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}
 
		}
 
		return utftext;
	},
 
	// private method for UTF-8 decoding
	_utf8_decode : function (utftext) {
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;
 
		while ( i < utftext.length ) {
 
			c = utftext.charCodeAt(i);
 
			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			}
			else if((c > 191) && (c < 224)) {
				c2 = utftext.charCodeAt(i+1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			}
			else {
				c2 = utftext.charCodeAt(i+1);
				c3 = utftext.charCodeAt(i+2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}
 
		}
 
		return string;
	}
 
}


