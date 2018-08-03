class Reservation
{
    constructor(id, stationName, stationAddress, nom, prenom, date, signature)
    {
        this.id = id;
        this.stationName = stationName;
        this.stationAddress = stationAddress;
        this.nom = nom;
        this.prenom = prenom;
        this.date = date;
        this.signature = signature;
        this.counter = null;
    }

    // instantier ou mettre à jour une réservation
    update(local)
    {
        // on met à jour les information de sessionStorage si c'est un edition ou un nouveau champs
        if (local && testLocalStorage("sessionStorage") && localStorage.getItem("reservationId") !== this.id)
        {
            sessionStorage.setItem("reservationId", this.id);
            sessionStorage.setItem("reservationStationName", this.stationName);
            sessionStorage.setItem("reservationStationAddress", this.stationAddress);
            
            sessionStorage.setItem("reservationName", this.prenom);
            sessionStorage.setItem("reservationSurname", this.nom);
            sessionStorage.setItem("reservationDate", this.date);
            sessionStorage.setItem("reservationSignature", this.signature);

            notify("normal", "top", "right", "Votre réservation a bien été effectué !");
        }
        // on récupère les objets station et marqueur
        let mark = mapInfos.markers.find(obj => obj.id == this.id);
        let station = mapInfos.markersInfos.find(obj => obj.number == mark.id);

        // on créé un lien pour zoomer sur le marqueur
        let $goToMarker = $(document.createElement("a")).text(this.id).attr({
            onclick: "mapInfos.goToMarker(" + this.id + ", 17)",
            href: "#map",
            title: "Zoomer sur la station"
        });

        // on update les infos de la réservation dans le footer
        $("#client-station-id").text("Identifiant station : ").append($goToMarker);
        $("#client-station-name").text("Nom : " + this.stationName);
        $("#client-station-address").text("Adresse : " + this.stationAddress);

        // on créé le compte à rebout de 20 minutes
        this.counter = setInterval(function()
        {
            let diff = calculDate(new Date(), sessionStorage.getItem("reservationDate"));

            $("#client-date").text("temps restant avant expiration : "  + (19 - diff.minute) + " minute(s) et " + (59 - diff.seconde) + " seconde(s)");

            if (19 - diff.minute === 0 && 59 - diff.seconde === 0)
            {
                clearInterval(this.counter);
                sessionStorage.clear();
                
                // on cache le footer
                $("#main").css("margin-bottom", "0");
                $("footer").hide();
            }

        }, 1000);

        $("#client-name").text("Identité enregistré : " + this.nom + " " + this.prenom);
        
        // on dessine l'image de la signature
        $("#client-signature").attr("href", this.signature);

        // on met à jour le marqueur
        mapInfos.updateMarkerIcon(station, mark);

        // on cache le bloc de reservation
        $("#reservation-body").hide();

        // on affiche le footer
        $("#main").css("margin-bottom", "115px");
        $("footer").show();

        let reservationTemp = this;
        // on active le clic sur la croix de suppression
        $("#delete-reservation").on("click", function()
        {
            reservationTemp.delete();
            mapInfos.map.setZoom(12);
        });
    }

    // supprimer la réservation courante
    delete()
    {
        clearInterval(this.counter);
        sessionStorage.clear();
        
        // on cache le footer
        $("#main").css("margin-bottom", "0");
        $("footer").hide();

        // on met à jour le marqueur
        let mark = mapInfos.markers.find(obj => obj.id == this.id);
        let station = mapInfos.markersInfos.find(obj => obj.number == mark.id);

        mapInfos.updateMarkerIcon(station, mark);
    }
}

// récupérer la réservation en cours si elle existe (-20 minutes)
function getActiveReservation()
{
    if (testLocalStorage("sessionStorage") && sessionStorage.getItem("reservationId"))
    {
        let diff = calculDate(new Date(), sessionStorage.getItem("reservationDate"));
        
        let reservation = new Reservation( 
            sessionStorage.getItem("reservationId"),
            sessionStorage.getItem("reservationStationName"),
            sessionStorage.getItem("reservationStationAddress"),
            sessionStorage.getItem("reservationName"),
            sessionStorage.getItem("reservationSurname"),
            sessionStorage.getItem("reservationDate"),
            sessionStorage.getItem("reservationSignature")
        );
        
        reservation.update(true);
    }
    else 
    {
        // on affiche le footer
        $("footer").hide();
    }
}