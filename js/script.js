

var png = BASE_URL + '/js/iepngfix/blank.gif';

var fileLoadingImage = BASE_URL + "js/jquery-lightbox/images/loading.gif";
var fileBottomNavCloseImage = BASE_URL + "/js/jquery-lightbox/images/closelabel.gif";

var notikumi;

$(document).ready(function() {
   
	// lightbox
	
	$("a.lightbox").lightbox({'fileLoadingImage' : fileLoadingImage, 'fileBottomNavCloseImage' : fileBottomNavCloseImage});

	var date = new Date();
	
	notikumi = new Notikumi();
	//notikumi.load(date.getFullYear(), date.getMonth() + 1);
	

	
	
	$("#datepicker").datepicker({
		firstDay: 1,
		dayNamesMin: ['Sv', 'P', 'O', 'T', 'C', 'Pk', 'S'],
		monthNames: ['Janvāris','Februāris','Marts','Aprīlis','Maijs','Jūnijs','Jūlijs','Augusts','Septembris','Oktobris','Novembris','Decembris'],
		dateFormat: 'yy/m/d',
		onChangeMonthYear: notikumi.load,
		onSelect: notikumi.show,
		beforeShowDay: notikumi.check
	});

	
	// ie6 bugs - redraw

	var exp = "$('#datepicker').datepicker( 'setDate' , '' );";
	setTimeout(exp, 1);
	
	// ie6 bugs ar display un png
	
	$("#notikumi").css("visibility", "visible");
	$("#notikumi").css("display", "none");
	

	//http://blog.deconcept.com/swfobject/
	
	var so = new SWFObject(BASE_URL + "images/flash/notikums.swf", "kalendara_bilde", "145", "100", "8", "#FEFEFE");
	//so.addVariable("img", BASE_URL + "images/sample_small.jpg");
	so.addVariable("img", CAL_IMG);
	so.addVariable("url", CAL_URL);
	so.write("kalendara_bilde");


	// http://craigsworks.com/projects/qtip/docs/tutorials

	
	if($('a.event[title]').length > 0) {
		
		$('a.event[title]').qtip({
			position: {
		      corner: {
		         target: 'topLeft',
		         tooltip: 'bottomLeft'
		      }
			},
			style: { 
				name: 'dark', 
				background: '#4f4f4f',
				width: 400, 
				tip: true,
				border: {
		         width: 7,
		         radius: 5,
		         color: '#4f4f4f'
		      }
			}
		});
	}

	
	
});




var Notikumi = function() {
	
	var _self 	= this;
	var notikumi= new Array();
	var inCache = new Array();

	
	this.load = function(year, month, inst) {
			
		// mēnesi iekešots!
		
		if(typeof inCache[year + "/" + month] != 'undefined')
			return;
		
		
		$("#datepicker img").show();
		
		jQuery.ajax({
	         url:    BASE_URL + "feed.php?year=" + year + "&month=" + month,
	         success: function(json) {

	 			$("#datepicker img").hide();
	 			
	 			$.each(json, function(i,item){
	 				
	 				 notikumi[i] = item;
	 			});
	 			
	 			
	 			// set cache
	 			
	 			inCache[year + "/" + month] = true;
	 			
			},
	 		dataType: "json",
	 		async:   false
		}); 

	}

	
	
	this.check = function(date) {
		
		// formāts: yyyy/mm/ddd
		
		var datums = date.getFullYear() + "/" + (date.getMonth() + 1) + "/" + date.getDate(); 
		
		
		var style = "";
		
		
		// active
		
		if(typeof notikumi[datums] != 'undefined') {

			style += " ui-datapicker-eriks";
						
			return new Array(true, style);
		}

		
		return new Array(false);
	}
	

	
	this.show = function(date) {
		
		
		if( typeof notikumi[date] == 'undefined')
			return;
			
		$("#notikums").html( notikumi[date].join(''));	
		
		$("#notikumi").hide();
		$("#notikumi").slideDown("fast");
	}
	
	
	this.close = function() {
		$("#notikumi").slideUp("fast");
	}
	
}