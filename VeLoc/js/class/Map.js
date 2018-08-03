var markerList = [];

class GoogleMap
{
    constructor(_map, _latitude, _longitute, _zoom, _markers, _markersInfos)
    {
        this.map = _map;
        this.latitude = _latitude;
        this.longitude = _longitute;
        this.zoom = _zoom;
        this.markers = _markers;
        this.markersInfos = _markersInfos;
    }

    // créér un marqueur google
    drawMarker(station)
    {
        let bikesAvailable = false;
        let bgColor;
        let bikeReserved = false; 
        let canvas = new Canvas(40, 70, null);

        if (station.availableBikes > 0)
            bikesAvailable = true;

        // on vérifie si la station en cours possède une réservation
        if(testLocalStorage("sessionStorage") && sessionStorage.getItem("reservationId") && station.number == sessionStorage.getItem("reservationId"))
        {
            bikeReserved = true;
        }

        if(station.status === "OPEN")
        {
            bgColor = "#00b715";

            // on vérifie si la station en cours possède une réservation
            if(bikeReserved)
            {
                bgColor = "blue";
            }
                
            canvas.params = { 
                color: bgColor, 
                bikes: bikesAvailable 
            };
            canvas.drawIcon();
        }
        else
        {
            bgColor = "#e80000";
            
            // on vérifie si la station en cours possède une réservation
            if(bikeReserved)
            {
                bgColor = "blue";
            }
                
            canvas.params = { 
                color: bgColor, 
                bikes: bikesAvailable 
            };
            canvas.drawIcon();
        }

        // on créé un marqueur google map
        return new google.maps.Marker({
            position: { lat: station.position.latitude, lng: station.position.longitude },
            map: mapInfos.map,
            title: station.name,
            id: station.number,
            icon: canvas.result
        });
    }

    // met à jour l'icone du marqueur
    updateMarkerIcon(station, marker)
    {
        let bikesAvailable = false;
        let bgColor;
        let bikeReserved = false; 
        let canvas = new Canvas(40, 70, null);

        if (station.availableBikes > 0)
            bikesAvailable = true;

        // on vérifie si la station en cours possède une réservation
        if(testLocalStorage("sessionStorage") && sessionStorage.getItem("reservationId") && station.number == sessionStorage.getItem("reservationId"))
        {
            bikeReserved = true;
        }

        if(station.status === "OPEN")
        {
            bgColor = "#00b715";

            // on vérifie si la station en cours possède une réservation
            if(bikeReserved)
            {
                bgColor = "blue";
            }
                
            canvas.params = { 
                color: bgColor, 
                bikes: bikesAvailable 
            };
            canvas.drawIcon();
        }
        else
        {
            bgColor = "#e80000";
            
            // on vérifie si la station en cours possède une réservation
            if(bikeReserved)
            {
                bgColor = "blue";
            }
                
            canvas.params = { 
                color: bgColor, 
                bikes: bikesAvailable 
            };
            canvas.drawIcon();
        }

        // on update le marqueur
        marker.icon = canvas.result;
    }

    // zoomer sur une marqueur
    goToMarker(markerId, zoom)
    {
        // on récupère les objets station et marqueur
        let marker = mapInfos.markers.find(obj => obj.id == markerId);

        mapInfos.map.setZoom(zoom);
        mapInfos.map.panTo(marker.position);
    }
}

// initialise la carte google map
function initMap() 
{
    mapInfos.map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: mapInfos.latitude, lng: mapInfos.longitude },
        zoom: mapInfos.zoom,
        minZoom: 12
    });

    mapInfos.map.addListener("click", function(e)
    {
        $("#station-infos").hide(); // on cache les infos de la station
        $("#reservation-body").hide();
    });
}

// génère les marqueurs sur la carte google map avec les infos des stations
function generateMarkers(stationsInfos)
{
    mapInfos.markersInfos = stationsInfos; // ajoute les infos de station à l'objet GoogleMap

    // foreach des marqueurs de l'objet GoogleMap
    mapInfos.markers = mapInfos.markersInfos.map(station => {

        // on créé un marqueur google map
        let thisMarker = mapInfos.drawMarker(station);

        // ajout d'un event au click sur le marqueur
        thisMarker.addListener("click", async function()
        {
            // scroll tout en bas
            $('html,body').animate({ scrollTop: $(document).height() }, 'slow');

            let mark = mapInfos.markersInfos.find(obj => obj.number === thisMarker.id);
            mark.showInfos(); // affichage des infos immédiatement

            $(".reload-station").attr("id", thisMarker.id); // on donne l'id de la station au bouton recharger
        });

        return thisMarker;
    });
    
    // fait un cluster des marqueurs
    new MarkerClusterer(mapInfos.map, mapInfos.markers, {imagePath: 'img/m'});

    // on met à jour ensuite la réservation si il y en a une
    getActiveReservation(); // vérifie si une réservation existe
}
