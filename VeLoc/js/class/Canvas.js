var startDraw = false;

class Canvas
{
    constructor(width, height, params)
    {
        this.width = width;
        this.height = height;
        this.params = params;
        this.result = null;
    }
    
    drawSignature()
    {
        if($("#signature") !== null)
        {
            $("#signature").remove();
        }

        let canvasElt = document.createElement("canvas");
        let $canvas = $(canvasElt);
        $canvas.css("background-color", "rgb(200, 200, 200)"); // ajout du css
        $canvas.attr({ // ajout des attributs
            id: "signature",
            width: this.width,
            height: this.height
        });

        $("#reservation-surname").after($canvas); // on injecte le canvas
        $("#reservation-body").show();

        ///////////////////////////////////////////////////
        ///////////////////////////////////////////////////

        let context = document.getElementById("signature").getContext("2d"); // on créé le context2D
        let pixelMoveCount = 0;

        context.strokeStyle = "black"; // on défini la couleur du dessin
        context.lineWidth = "3";
        context.lineCap = 'round';
        context.fillStyle = "rgb(220, 220, 220)";
        context.font = "25px Arial";

        context.fillText("Signez ici à main levé", 5, 28);

        // evenements souris
        $canvas.bind({
            mousedown: function(e)
            {
                drawStart(context, e, false);
            },
            mousemove: function(e)
            {
                if(startDraw)
                {
                    drawMove(context, e, false);
                    pixelMoveCount++;
                }
            },
            mouseup: function(e)
            {
                drawEnd();
            }
        });

        // evenements smartphone
        $canvas.bind({
            touchstart: function(e)
            {
                drawStart(context, e, true);
            },
            touchmove: function(e)
            {
                if(startDraw)
                {
                    drawMove(context, e, true);
                    pixelMoveCount++;
                }
            },
            touchend: function(e)
            {
                drawEnd();
            }
        });

        // au clique sur le bouton d'envoi du formulaire, on vérifie les données
        $("#reservation-submit").on("click touchstart", function(e)
        {
            e.preventDefault();
            
            if(!$("#reservation-name").val() || !$("#reservation-surname").val() || pixelMoveCount < 50)
            {
                $("#reservation-error").text("Vous devez remplir tout les champs et signer").css("color", "red");
            }
            else
            {
                $("#reservation-error").text("");
                
                // on recherche les infos de la station courante et on les stock dans une variable
                let thisStation = mapInfos.markersInfos.find(obj => obj.number === Number($("#reserver").attr("data-id")));
                
                let reservation = new Reservation(
                    thisStation.number, 
                    thisStation.name, 
                    thisStation.address, 
                    $("#reservation-name").val(), 
                    $("#reservation-surname").val(), 
                    new Date().getTime(),
                    canvasElt.toDataURL()
                );
                
                reservation.update(true);

                if (e.type === "touchstart")
                    enableScroll();
            }
        });
    }

    drawIcon()
    {
        let canvasElt = document.createElement("canvas");
        canvasElt.width = this.width;
        canvasElt.height = this.height;

        let context = canvasElt.getContext("2d");

        context.strokeStyle = "grey";
        context.fillStyle = this.params.color;
        context.lineWidth = "2";
        context.lineCap = "round";

        let radius = (this.width / 2) - context.lineWidth;

        // fond de l'icone
        context.beginPath();
        context.arc(
            radius + context.lineWidth, 
            radius + context.lineWidth, 
            radius, Math.PI, Math.PI * 2, 
            false
        );
        
        // bezier gauche
        context.bezierCurveTo(
            this.width, this.height / 2,
            this.width / 2, this.height / 2,
            this.width / 2, this.height
        );
        
        // bezier droit
        context.bezierCurveTo(
            this.width / 2, this.height / 2, 
            0, this.height / 2, 
            context.lineWidth, radius
        );
        
        // contour et fond de l'image
        context.fill();
        context.stroke();

        // logo de vélo
        if (this.params.bikes)
            context.fillStyle = "white";
        else 
        {
            context.fillStyle = "#820000";
        }
        context.font = "22px FontAwesome";
        context.fillText("\uf206", 6, 27);

        // conversion en URL Base64
        this.result = canvasElt.toDataURL();
    }
}

// commence le tracé
function drawStart(context, event, mobile)
{
    startDraw = true;

    let position = getMousePos(event, mobile); 
            
    context.beginPath();
    context.moveTo(position.x, position.y); 
}

// dessine le tracé
function drawMove(context, event, mobile)
{
    let position = getMousePos(event, mobile);

    context.lineTo(position.x, position.y); 
    context.stroke();
}

// termine le tracé
function drawEnd()
{
    startDraw = false;
}