// on créé la map et le gestionnaire d'erreur dès le début car unique
var mapInfos = new GoogleMap(null, 45.764043, 4.835659, 12, null, null);
var errorManager = new ErrorManager();

// une fois le document chargé
$(document).ready(function()
{
    let imgWidth = $(document).width() / 1.1;
    let imgHeight = 770;

    var slider = new Slider(
        $(document).width() / 1.1,
        imgHeight,
        imgWidth, 
        imgHeight,
        "header",
        ["img/slider/slide1.png",
        "img/slider/slide2.png",
        "img/slider/slide3.png",
        "img/slider/slide4.png",
        "img/slider/slide5.png"]
    );
    
    $(document).on("keydown", function(e)
    {   
        // réagis a la pression sur les flèches. Inversé pour une question de confort
        if(e.keyCode === 39)
            slider.goToNext();
        else if (e.keyCode === 37)
            slider.goToPrev();
    });

    $("#slide-selector").ready(function()
    {
        $("#left-arrow").on("click touchstart", function()
        {
            if(slider.move() === false)
                slider.goToPrev();
        });
        $("#right-arrow").on("click touchstart", function()
        {   
            if(slider.move() === false)
                slider.goToNext();
        });
    });


    slider.create(); // on créé le slider
    getAllStations(); // récupère les infos des stations

    Notification.requestPermission(function(permission) // demande la permission d'effectuer une notification
    {
        // si le champ "permission" n'existe pas dans notification, alors on le créé pour enregistrer l'accès ou non
        if(!("permission" in Notification))
            notification.permission = permission;
    });
});


