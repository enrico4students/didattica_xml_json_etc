<?php
    echo "
    	<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyChTsh9mTgKrBBzRAdmRVFLBTDWG__5aWk&&libraries=places'></script>
    	<script>
    		var map;
    		var service;
    	    var lat = 0;
    	    var lng = 0;
    	    var POI;
    	    var markerInit;
    	    var infowindow = [];
    	    var marker = [];

	    	function inizializza(){
				var opzioni =
			        {
			            zoom: 15,
			            center: new google.maps.LatLng(45.8081900, 9.0832000),    
			            mapTypeId: google.maps.MapTypeId.ROADMAP
			        }
			    map = new google.maps.Map(document.getElementById('mappa'), opzioni);

			    google.maps.event.addListener(map, 'click', function (e) 
			    {
			    	cancellaMarker();

					lat = e.latLng.lat();
					lng = e.latLng.lng();

					marker[0] = new google.maps.Marker 
		    		({
		       			map: map,
		        		draggable: false,
		        		animation: google.maps.Animation.BOUNCE,
		        		position: new google.maps.LatLng(lat, lng),
		    		});

		    		cerca()
				});
			}

			function cancellaMarker()
			{	
				for (x = 0;  x < marker.length; x++)
			    {
			    	marker[x].setMap(null);
			    }
			    marker = [];
			}

			function cerca()
			{
				var e = document.getElementById('mySel');
				POI = e.options[e.selectedIndex].value;

				raggio = 50001;
				while (!((raggio > 0) && (raggio <= 10000)))
				{
					raggio = prompt('Inserisci raggio (min --> 0m; max --> 10000m)',5000);
				}

				var request = {
    				location: new google.maps.LatLng(lat, lng),
    				radius: String(raggio),
    				type: [POI]
  				};

  				service = new google.maps.places.PlacesService(map);
  				service.nearbySearch(request, callback);
			}

			function callback(results, status) 
			{
        		if (status === google.maps.places.PlacesServiceStatus.OK) 
        		{
          			for (var i = 0; i < results.length; i++) 
          			{
            			creaMarker(results[i], i+1);
          			}
        		}
      		}

			function creaMarker(place, n) 
			{
			 	var placeLoc = place.geometry.location;
        		var image = {
    				url: './img/'+POI+'.png', 
    				scaledSize: new google.maps.Size(30, 30), 
    				origin: new google.maps.Point(0,0),
    				anchor: new google.maps.Point(0, 0),
				};

				infowindow[n] = new google.maps.InfoWindow({
          			content: place.name
        		});

        		marker[n] = new google.maps.Marker({
          			map: map,
         			position: place.geometry.location,
         			icon: image,
         		});

         		marker[n].addListener('click', function() {
          			infowindow[n].open(map, marker[n]);
        		});
			}
	    </script>
    ";
    echo "<body onload=inizializza()>";
    echo "<p>FUNZIONAMENTO:</p>";
    echo "<p>1) Scegli un PDI</p>";
    echo "<p>2) Clicca un punto sulla mappa</p>";  
    echo "<p>3) Ti indico quello che cerchi</p>";
    echo "<select id='mySel' multiple size=20>";
    echo "<option value=bakery>panettiere</option>";
    echo "<option value=bank>banca</option>";
    echo "<option>bar</option>";
    echo "<option value=book_store>libreria</option>";
    echo "<option>cafe</option>";
    echo "<option>clothing_store</option>";
    echo "<option>doctor</option>";
    echo "<option>gas_station</option>";
    echo "<option>travel_agency</option>";
    echo "<option>store</option>";
    echo "<option>shopping_mall</option>";
    echo "<option>school</option>";
    echo "<option>restaurant</option>";
    echo "<option>post_office</option>";
    echo "<option>police</option>";
    echo "<option>pharmacy</option>";
    echo "<option>parking</option>";
    echo "<option>night_club</option>";
    echo "<option>library</option>";
    echo "<option>hospital</option>";
    echo "</select><br><br>";
	echo "<div id=mappa style='position:absolute; top:100px; left:350px; height:750px; width:750px;'></div>";
	echo "</body>";
?>