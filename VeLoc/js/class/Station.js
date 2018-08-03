var stationsList = [];
var apiKey = "80c3a5c11b30d242493e2dc2ef6b4ee84d71bb23";

class Station
{
    constructor(_station)
    {
        this.number = _station.number;
        this.contractName = _station.contract_name;
        this.name = _station.name;
        this.address = _station.address;
        this.position = { latitude: _station.position.lat, longitude: _station.position.lng }
        this.banking = _station.banking;
        this.status = _station.status;
        this.bikeStands = _station.bike_stands;
        this.availableBikeStands = _station.available_bike_stands;
        this.availableBikes = _station.available_bikes;
        this.lastUpdate = _station.last_update;
        this.lastUpdateClient = new Date().getTime();
    }

    // met à jour les infos du marqueur courant
    updateInfos(station)
    {
        //https://api.jcdecaux.com/vls/v1/stations/{station_number}?contract={contract_name}
        var updateStation = ajaxGet("https://api.jcdecaux.com/vls/v1/stations/" + this.number + "?contract=Lyon&apiKey=" + apiKey, "station-infos", function(response)
        {
            var temp = JSON.parse(response);

            station.number = temp.number;
            station.contractName = temp.contract_name;
            station.name = temp.name;
            station.address = temp.address;
            station.latitude = temp.position.lat;
            station.longitude = temp.position.lng;
            station.banking = temp.banking;
            station.status = temp.status;
            station.bikeStands = temp.bike_stands;
            station.availableBikeStands = temp.available_bike_stands;
            station.availableBikes = temp.available_bikes;
            station.lastUpdate = temp.last_update;
            station.lastUpdateClient = new Date().getTime();
            station.showInfos();
        });
    }

    // récupère les infos du marqueur courant
    showInfos()
    {  
        $("#reload-station").hide(); // on cache le bouton recharger
        $("#reservation-body").hide(); // on cache le cadre de réservation si il existe
        $("#station-infos").show(); // on montre les infos de la station en cours

        let date = new Date(this.lastUpdate);

        // bouton pour fermer le panel
        $("#close-reservation-panel").on("click touchstart", function()
        {
            $("#reservation-body").hide();
        });

        $("#station-address").text("Adresse : " + this.address);
        $("#places-available").text("Places libres : " + this.availableBikeStands + " sur un total de " + this.bikeStands);
        $("#bicycles-available").text("Vélos disponibles : " + this.availableBikes);
        $("#last-updated").text("Dernière mise à jour : " + date.getDate() + "/" + date.getMonth() + "/" + date.getFullYear() + " à " + date.getHours() + ":" + date.getMinutes());
        $("#reload-station").attr("data-id", this.number);
        $("#reserver").attr("data-id", this.number);

        if(this.availableBikes === 0 || this.status === "CLOSE")
            $("#reserver").hide();
        else
            $("#reserver").show();

        let update = this.lastUpdateClient;
        // calcul de la différence entre l'update des infos clientside, et l'heure actuelle
        var disableReload = setInterval(function()
        {
            var diff = calculDate(new Date(), update);

            if (diff.seconde >= 10)
            {
                $("#reload-station").show();
                // bouton de reload de la station en cours
                $("#reload-station").on("click touchstart", function(e)
                {
                    e.preventDefault();
    
                    $("#reload-station").off("click", "**");
                    
                    let mark = mapInfos.markersInfos.find(obj => obj.number === Number(e.target.dataset.id));
                    mark.updateInfos(mark); // mise à jour des infos ensuite
                });
                clearInterval(disableReload);
            }
            else
            {
                $("#reload-station").hide();
            }
        }, 1000);

        $("#reserver").on("click touchstart", function()
        {
            // on demande la création du canvas (pour réninitialisé si il a déjà été créé)
            let canvas = new Canvas("250px", "150px", null);
            canvas.drawSignature();
        });
    }
}

// fonction générique permettant de récupérer toutes les stations de Lyon
function getAllStations()
{
    var initStation = ajaxGet("https://api.jcdecaux.com/vls/v1/stations?contract=Lyon&apiKey=" + apiKey, "map", function(response)
    {
        initStation = JSON.parse(response);
        
        // parcours le json, créé de nouveaux objets "Station" puis l'ajoute à une liste globale de stations
        initStation.map(station => {
            let stationInfos = new Station(station);
            stationsList.push(stationInfos);
        });

        generateMarkers(stationsList);
    });
}
