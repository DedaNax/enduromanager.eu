<?php

function doLake($subf){

?>


    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script>

var points = [

<?php
	$connection = mysql_connect(RM_DB_ADDRESS,RM_DB_USER,RM_DB_PASS);
	mysql_select_db(RM_DB_NAME, $connection);
	
	$q_result = queryDB("SELECT * 
FROM  `d_checkpoint` 
WHERE  `RACE_ID` =54");
		$i = 1;
		$reslt = array();		
		 while ($row = mysql_fetch_assoc($q_result, MYSQL_ASSOC)) {
			
			if ($i != 1) {echo ",";}
			echo "['".$row[DESCR]."','".$row[IMAGE]."','".$row[NOTES]."', ". $row[lat]  ." , ".$row[long].", $i]\n";
			
			$i++;
		}
		
		 
	//	return $reslt;
	
	echo mysql_error($connection);
	mysql_close ($connection);
?>

  
  
];


  
function setMarkers(map, points) {
 
  for (var i = 0; i < points.length; i++) {
    var point = points[i];
    var myLatLng = new google.maps.LatLng(point[3], point[4]);
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,       
        title: point[0],
        zIndex: point[3]		
    });
	
	var content = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">'+point[0]+'</h1>'+
      '<div id="bodyContent">'+
      '<p>'+point[3].toFixed(5)+', '+point[4].toFixed(5)+' '+point[2]+'</p>'+
	  '<p><a target="_blank" href = "'+point[1]+'"><img border="o" src="'+point[1]+'" width="200"></a></p>'+
      '</div>'+
      '</div>';
	var infowindow = new google.maps.InfoWindow();
  
	google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
		return function() {
			infowindow.setContent(content);
			infowindow.open(map,marker);
		};
	})(marker,content,infowindow)); 	
	
  
  }
}

function initialize() {
  var mapOptions = {
    zoom: 7,
    center: new google.maps.LatLng(56.9489, 24.1064)
  }
  var map = new google.maps.Map(document.getElementById('map-canvas'),
                                mapOptions);

  setMarkers(map, points);
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  
    <div id="map-canvas"></div>
 





<?php 
}
?>