<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Map</title>
    <style>
        /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
        #map {
            height: 90vh;
        }
    </style>
</head>

<body>
    <main class="container-fluid">
        <h2>Lab1 - Pokemon War on Google Map</h2>
        <div class="row">
            <div class="col-sm-12 col-md-8">
                <div id="map"></div>
            </div>
            <div class="col-sm-12 col-md-4 text-center">
                <button id="get-data" type="button" class="btn btn-block btn-success my-2">Attack! (one round)</button>
                <button id="reset" type="button" class="btn btn-block btn-outline-secondary mb-2">Reset</button>    
                <div class="alert text-red" role="alert" id="show-data"></div>
            </div>
        </div>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <!-- NOTE this google map is using an ITAS Google Map key! Do not use for any of your private applications hosted live anywhere-->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBm8Vo8PUjj2HFaPBgfwKdTTjOyBo3LY-c&callback=initMap">
    </script>

    <script>
        let map;
        let myMarkers = [];

        function initMap() {
            const nanaimo = {
                lat: 49.159700,
                lng: -123.907750
            };
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 13,
                center: nanaimo,
            });
        }

        function clearMarkers() {
            for (let i = 0; i < myMarkers.length; i++) {
                myMarkers[i].setMap(null);
            }
            myMarkers = [];
        }

        $(function() {

            console.log("Document ready!");

            $('#reset').click(function() {

                // remove any previous markers
                clearMarkers();

                const url = 'getPokemon.php?reset=true';
                let data = {};
                $.getJSON(url, data, function(data, status) {
                    console.log("Back from the reset");
                    let showData = $('#show-data');
                    showData.text("World Reset");
                });
            });

            $('#get-data').click(function() {

                // remove any previous markers
                // BillD: note this might be somewhat inefficient.. for performance you might have to keep an index
                // of which marker is for which pokemon, and update the lat and long accordingly
                clearMarkers();

                let showData = $('#show-data');
                showData.empty();

                let url = 'getPokemon.php';
                let data = {
                    q: 'search',
                    text: 'not implemented yet!'
                };
                console.log("Sending request for Pokemon marker list...");

                try {
                    $.getJSON(url, data, function(data, status) {
                        console.log("Ajax call completed, status is: " + status);

                        // show the  message from the data
                        showData.text(data.message);

                        data.markers.forEach(function(marker) {

                            marker = JSON.parse(marker);
                            //console.log("Creating marker on map");
                            let myLatlng = new google.maps.LatLng(marker.lat, marker.long);

                            //let image = marker.image;
                            let myIcon = {
                                            url: "images/" + marker.image,
                                            origin: new google.maps.Point(0, 0),
                                            anchor: new google.maps.Point(0, 0),
                                            scaledSize: new google.maps.Size(50, 50),
                                            labelOrigin: new google.maps.Point(25, -10)
                                        };

                            let myLabel = {
                                    text: marker.group + ' ' +  marker.name + ':' + (marker.hp || '😎'),
                                    color: marker.group.toUpperCase() === 'WILD' ? "red" : "green",
                                };

                            let mmarker = new google.maps.Marker({
                                position: myLatlng,
                                map: map,
                                title: marker.group + marker.name,
                                icon: myIcon,   
                                label: myLabel
                            });

                            // add this marker to our array of markers
                            myMarkers.push(mmarker);
                        });
                    })
                } catch (error) {
                    console.log("Error requesting JSON data: " + error);
                }

            });
        });
    </script>
</body>

</html>