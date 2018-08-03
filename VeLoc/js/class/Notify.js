class Notify
{
    constructor(type, position1, position2, text)
    {
        this.type = type;
        this.position1 = position1;
        this.position2 = position2;
        this.text = text;
    }

    // créé le corp de la notification
    create()
    {
        let $notification = $(document.createElement("div")).addClass("notification");
        let $text = $(document.createElement("span")).text(this.text);

        $notification.append($text);
        $("#body-content").append($notification);

        this.show(5000);
    }

    // effectue l'animation de la notification
    show(time)
    {
        let pos = this.position2;
        let animationId = null;

        // place la notification en dehors du cadre
        $(".notification").addClass(this.position1 + " " + this.position2);

        // lance la notification
        function notifyAnimation()
        {
            $("." + pos).css(pos, "2%");

            animationId = requestAnimationFrame(notifyAnimation, 10000);
            
            // Retour en arrière de l'animation + suppression
            setTimeout(() => {
                $("." + pos).css(pos, "-100%");
                cancelAnimationFrame(animationId);

                setTimeout(() => {
                    $(".notification").remove();
                }, time);
            }, time);
        }

        animationId = requestAnimationFrame(notifyAnimation, 10000);
    }
}

// test si Notification() existe sur le navigateur. Si il n'existe pas, fait appel à la méthode alternative
function notify(type, position1, position2, text)
{
    var notify = null;

    // on vérifie si le navigateur prend en charge les notifications. Si il ne le prend pas en charge, on envoie une notifications alternative.
    if(!Notification in window)
    {
        notify = new Notify(type, position1, position2, text);
    }
    else if(Notification.permission === "granted") // Si le navigateur prend en charge les navigation et que l'utilisateur accepte les notifications, alors on lui affiche.
    {
        notify = new Notification(text);
        
        setTimeout(function()
        {
            notify.close();
        }, 5000);
    }
    else if(Notification.permission === "denied")
    {
        notify = new Notify(type, position1, position2, text);
        notify.create();
    }
    else // sinon, on viens lui demander d'accepter ou non les notification
    {
        Notification.requestPermission(function(permission) // demande la permission d'effectuer une notification
        {
            // si le champ "permission" n'existe pas dans notification, alors on le créé pour enregistrer l'accès ou non
            if(!("permission" in Notification))
                notification.permission = permission;

            // si il accepte les notification, alors elles s'affichera juste après
            if(permission === "granted")
            {
                notify = new Notification(text);
                
                setTimeout(function()
                {
                    notify.close();
                }, 5000);
            }
                
            else // sinon on créé une notification alternative
                notify = new Notify(type, position1, position2, text);
                notify.create();
        });
    }
}