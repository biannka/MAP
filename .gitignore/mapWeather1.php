<!DOCTYPE html>
<html>
  <head>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
	     <title>Google Maps Multiple Markers</title>
    	 <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
		
    <div id="map"></div>
    <script>
        // Create a <script> tag and set the USGS URL as the source.
        var script = document.createElement('script');

        // This example uses a local copy of the GeoJSON stored at
        // https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/2.5_week.geojsonp
        script.src = 'https://developers.google.com/maps/documentation/javascript/examples/json/earthquake_GeoJSONP.js';
        document.getElementsByTagName('head')[0].appendChild(script);

      function eqfeed_callback(results) {
	  var latLng = [];
        //var heatmapData = [];
        for (var i = 0; i < results.features.length; i++) {
		latLng[i] = [];
          var coords = results.features[i].geometry.coordinates;
          //var latLng = new google.maps.LatLng(coords[1], coords[0]);
          console.log(coords[1]);
          console.log(coords[0]);
		  latLng[i][0] = coords[1];
		  latLng[i][1] = coords[0];
          //heatmapData.push(latLng);
        }
		 // get the current url and append variable
        var url = document.location.href + '?latLng=' + latLng;
		console.log(latLng);
        // to prevent looping
        var exists = document.location.href.indexOf('?latLng=');
		if(exists < 0){
              // redirect passing variable
              window.location = url;
        }
      }
    </script>
  <?php echo $_GET['latLng'];
	
		$servername = "localhost";
		$username = "id4928552_map";
		$password = "map123";
		$dbname = "id4928552_map";
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		
		if (isset($_GET["latLng"]){
			$hello = json_encode($_GET["latLng"]);
			echo "<script language='text/javascript'>function sayHiFromPHP() { alert('Just wanted to say $hello'); }</script>";
		}else{
			echo "alert";
		}
		for ($i = 0; i < locations.length; $i++) {
			$sql = "INSERT INTO MyGuests (firstname, lastname, email) VALUES('$type', $hello[i][0], $hello[i][1])";
		}
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
	?>
  </body>
</html>