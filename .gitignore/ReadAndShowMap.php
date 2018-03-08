	<!DOCTYPE html>
 

<style>
#map_wrapper {
    height: 400px;
}

#map_canvas {
    width: 100%;
    height: 100%;
}
</style>
<html>
	     <title>Google Maps Multiple Markers</title>
    	 <script src="https://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
		
<body>
	<?php
		$servername = "localhost";
		$username = "id4928552_map";
		$password = "map123";
		$dbname = "id4928552_map";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "SELECT Latitude, Longitude, Name FROM coordinates";
		$result = $conn->query($sql);

		$info = array();
		$rows_count = 0;
		if ($result->num_rows > 0) {
			$info[$rows_count] = array();
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "<br> Latitude: ". $row["Latitude"]. " - Longitude: ". $row["Longitude"]. " Name: " . $row["Name"] . "<br>";
				$info[$rows_count][0] = $row["Latitude"];
				$info[$rows_count][1] = $row["Longitude"];
				$info[$rows_count][2] = $row["Name"];
			$rows_count = $rows_count +1;
			}
		} else {
			echo "0 results";
		}

		$conn->close();
	?> 
	
	    <div id="map" style="width:100%;height:400px;"></div>
    	<script type="text/javascript">
    		var locations = <?php echo json_encode($info); ?>;
    
    		var map = new google.maps.Map(document.getElementById('map'), {
    		  zoom: 15,
    		  center: new google.maps.LatLng(42.681394, 23.303455),
    		  mapTypeId: google.maps.MapTypeId.ROADMAP
    		});
    
    		var infowindow = new google.maps.InfoWindow();
    
    		var marker, i;
    
    		for (i = 0; i < locations.length; i++) { 
    		  marker = new google.maps.Marker({
    			position: new google.maps.LatLng(locations[i][0], locations[i][1]),
    			map: map
    		  });

    		  google.maps.event.addListener(marker, 'click', (function(marker, i) {
    			return function() {
    			  infowindow.setContent(locations[i][2]);
    			  infowindow.open(map, marker);
    			}
    		  })(marker, i));
    		}
    	 </script>
		 </body>
	</html>
