<?php
    $percorso = realpath("../DB/comuni.mdb"); 										//connessione database
    $sc="DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=".$percorso.";";
    $cn = new COM("ADODB.Connection") or die("Non va ADO");
    $rs = new COM("ADODB.Recordset");

    $cn->Open($sc); 
    if (isset($_GET['n'])) {$n = $_GET["n"];}									//se è il primo accesso setto n=0
    else {$n = 0;}

    echo "
    	<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyChTsh9mTgKrBBzRAdmRVFLBTDWG__5aWk&&libraries=places'></script>
    	<script>
				var map,latitudine,longitudine,service,marker=[];							//dichiarazione variabili globali
	    		function province(e)														//una volta selezionata la regione si leggono le provincie di quest'ultima nel DB
	    		{
	    			var str = e.options[e.selectedIndex].value;
	    			ajax=new XMLHttpRequest();
	            
	            	ajax.onreadystatechange=function()
	           		{
	               		if (ajax.readyState == 4 && ajax.status == 200)
	               		{
	                  		document.getElementById('prov').innerHTML = ajax.responseText;
	               		}
	            	}
	            	ajax.open('GET','Mappa_Places.php?n=1&stringa='+str ,true);
	            	ajax.send();
					map.setZoom(5);															//ogni volta che seleziono una regione riposiziono il centro della mappa
					map.setCenter(new google.maps.LatLng(42.0350577, 11.63511));
	    		}

	    		function comuni(e)															//una volta selezionata la provincia si leggono i paesi di quest'ultima nel DB
	    		{
	    			var str = e.options[e.selectedIndex].value;
	    			ajax=new XMLHttpRequest();
	            
	            	ajax.onreadystatechange=function()
	           		{
	               		if (ajax.readyState == 4 && ajax.status == 200)
	               		{
	                  		document.getElementById('com').innerHTML = ajax.responseText;
	               		}
	            	}
	            	ajax.open('GET','Mappa_Places.php?n=2&stringa='+str ,true);
	            	ajax.send();
					map.setZoom(5);															//ogni volta che seleziono una provincia riposiziono il centro della mappa
					map.setCenter(new google.maps.LatLng(42.0350577, 11.63511));
	    		}
				

	    		function inizializza()														//funzione di creazione della mappa al caricamento iniziale della pagina
				{
 					// echo'<b>Ricerca esercizi commerciali nel raggio di 5 km.<br></b>';

					var opzioni =
				    {
						zoom: 5,
				        center: new google.maps.LatLng(42.0350577, 11.63511),    
				        mapTypeId: google.maps.MapTypeId.ROADMAP
				    }
				    map = new google.maps.Map(document.getElementById('mappa'), opzioni);
				}

				function creaMarker(e) 														//ogni volta che seleziono un comune riposizione creo un marker
				{
					cancellaMarker();
				   	var str = e.options[e.selectedIndex].value;
				    var temp = str.split('/');
				    marker[0] = new google.maps.Marker 
				    ({
				        map: map,
				        draggable: false,
				        position: new google.maps.LatLng(temp[2], temp[3]),
						animation:google.maps.Animation.BOUNCE,
				        title: temp[0],
				    });
					latitudine=temp[2];
					longitudine=temp[3];
					document.getElementById('mySel').style.visibility='visible';			// rendo visibile la select contenente i luoghi che si vogliono cercare nel
																							// raggio del comune selezionato
					map.setZoom(13);														// ogni volta che seleziono un comune riposiziono il centro della mappa
					map.setCenter(new google.maps.LatLng(temp[2], temp[3]));
				}
				
			function cerca(e)							         			// ogni volta che seleziono il luogo desiderato da cercare nel raggio del comune scelto
			{																// creo un marker per ogni luogo esistente nei pressi del comune (5km)
				var cosa = e.options[e.selectedIndex].value;
				var raggio = 5000;
				
				map.setZoom(13);															// avvicino lo zoom della mappa nei pressi del comune
				map.setCenter(new google.maps.LatLng(latitudine,longitudine));
				
  				service = new google.maps.places.PlacesService(map);						// evento places per trovare i luoghi vicini al comune scelto
				var request = {
    				location: new google.maps.LatLng(latitudine, longitudine),
    				radius: raggio,
    				type: [cosa]
  				};
  				service.nearbySearch(request, callback);
			}

			function callback(results, status) 												
			{
        		if (status === google.maps.places.PlacesServiceStatus.OK) 
        		{
          			for (var i = 0; i < results.length; i++) 
          			{
            			newMarker(results[i],i+1);
          			}
        		}
      		}

			function newMarker(place,n) 														//creazione dei marker riguardanti i luoghi nei pressi del comune scelto
			{
				var image = 
				{
					url: place.icon,
					size: new google.maps.Size(71, 71),
					origin: new google.maps.Point(0,0),
					anchor: new google.maps.Point(17, 34),
					scaledSize: new google.maps.Size(25,25)
				}
        		marker[n] = new google.maps.Marker
				({
          			map: map,
         			position: place.geometry.location,
					title:place.name,
					icon:image
         		});
			}
			
			function cancellaMarker()																	//ogni volta che seleziono un nuovo comune elimino i marker precedenti
			{	
				for (x = 0;  x < marker.length; x++)
			    {
			    	marker[x].setMap(null);
			    }
			    marker = [];
			}
	    </script>";
		
	echo"<body onload=inizializza();>";
    if ($n == 0)																			//inserimento delle regioni nella select
    {
	    $rs->Open("SELECT * FROM Regioni", $cn);

		echo "<div id=reg>";
		echo "<select id=myReg style=position:absolute; onchange='province(this)'>";
	    echo "<option>scegli la regione</option>";
	    while (!$rs->eof) 
	    {
	       echo "<option>".$rs->fields['nome']->value."/".$rs->fields['codice_regione']->value."</option>";

	       $rs->movenext();
	    }
	    echo "</select>";
	    echo "</div>";
	    echo "<div id=prov>";
	    echo "</div>";
	    $cn->close();
	}

    if ($n == 1)																			//inserimento delle provincie nella select
    {
    	$rs->Open("SELECT * FROM Province", $cn);

		echo "<select id=myProv style=position:absolute;left:200; onchange='comuni(this)'>";
	    echo "<option>scegli la provincia</option>";
	    $tmp = $_GET["stringa"];
	    $reg = explode("/", $tmp);
	    while (!$rs->eof) 
	    {
	    	if ($reg[1] == $rs->fields['codice_regione']->value)
	    	{
	    		echo "<option>".$rs->fields['nome']->value."/".$rs->fields['codice_provincia_istat']->value."</option>";
	    	}

	        $rs->movenext();
	    }
	    echo "</select>";
	    echo "</div>";
	    echo "<div id=com>";
	    echo "</div>";
	    $cn->close();
    }

    if ($n == 2)																			//inserimento dei comuni nella select
    {
    	$rs->Open("SELECT * FROM Comuni", $cn);
		echo "<select id=myCom style=position:absolute;top:75; onchange='creaMarker(this)''>";
	    echo "<option> scegli il comune</option>";

	    $tmp = $_GET["stringa"];
	    $prov = explode("/", $tmp);
		$conta=0;
	    while (!$rs->eof) 
	    {
	    	if ($prov[1] == $rs->fields['codice_provincia_istat']->value)
	    	{
	    		echo "<option>".$rs->fields['nome']->value."/".$rs->fields['codice_provincia_istat']->value."/".$rs->fields['lat']->value."/".$rs->fields['lng']->value."</option>";
	    	}

	        $rs->movenext();
	    }
	    echo "</select>";
	    $cn->close();
    }
    echo "<select onchange='cerca(this)' style=position:absolute;top:175;visibility:hidden; id='mySel'>";	
    //creazione statica dei luoghi da cercare nei pressi del comune scelto
	echo "<option>cosa vuoi trovare? </option>";
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
	echo "<div id=mappa style='position:absolute; top:100;left:350;height:500;width:750;'></div></body>";	//contenitore della mappa
?>