class Slider
{
    constructor(sliderWidth, sliderheight, imgWidth, imgHeight, handle, images)
    {
        this.sliderWidth = sliderWidth;
        this.sliderheight = sliderheight;
        this.imgWidth = imgWidth;
        this.imgHeight = imgHeight;
        this.handle = handle;
        this.images = images;
    }

    // créé le slider
    create()
    {
        var number = 0;

        // on créé le corps du slider dans le handle
        let $sliderElt = $((document).createElement("section")).attr("id", "slideshow");
        let $sliderSelectorElt = $((document).createElement("ul")).attr("id", "slide-selector");
        
        // on créé la fleche gauche
        let $beforeArrow = $(document.createElement("li")).text("\uf060").attr("id", "left-arrow");
        $sliderSelectorElt.append($beforeArrow); 

        // boucle qui créé les images et les selectors
        this.images.forEach(img => {
            number++;

            // on créé l'image, avec les bon attributs
            let $imgElt = $((document).createElement("img")).attr({
                src: img,
                class: "slide img-fluid",
                id: number
            });

            // on créé les selector
            let $dotSelector = $((document).createElement("li")).attr("id", "dot-" + number).addClass("selector").text("\uf111");

            // on injecte les images et les selectors
            $sliderElt.append($imgElt);
            $sliderSelectorElt.append($dotSelector);
        });

        // on créé la fleche droite
        let $afterArrow = $(document.createElement("li")).text("\uf061").attr("id", "right-arrow");
        $sliderSelectorElt.append($afterArrow);


        // on défini l'élément actif au millieu
        $(".slide:nth-child(1)").addClass("active");
        $(".selector#dot-1").addClass("active");

        // on injecte le corps et le selector après le slider
        $(this.handle).append($sliderElt);
        $sliderElt.after($sliderSelectorElt);

        this.replace(1);
    }

    // change élément active pour permettre le scroll
    replace(id)
    {
        // on réinitialise les class au click
        $(".slide").removeClass("active");
        $(".selector").removeClass("active");
        
        // on remet les class sur les bon éléments
        $(".slide#" + id).addClass("active");
        $(".selector#dot-" + id).addClass("active");
        // on reset le placement des slides
        $(".slide").css("left", "");

        // et on applique le "left" à chaque éléments
        $(".slide.active").css("left", "0");

        // on applique le style "left" a tout les éléments à gauche
        let $currentElt = $(".slide.active");
        let count = 0;

        while($currentElt.length !== 0)
        {
            $currentElt.prev().css("left", "-104%");
            $currentElt = $currentElt.prev();
        }

        // on répète la même opération pour tout les éléments a droite
        $currentElt = $(".slide.active");
        count = 0;

        while($currentElt.length !== 0)
        {
            $currentElt.next().css("left", "104%");
            $currentElt = $currentElt.next();
        }
    }

    // récupère l'élément précédent et change d'élément actif si différent de null
    goToPrev()
    {
        let $prevElt = $(".slide.active").prev();
        
        if($prevElt.length !== 0)
            this.replace($prevElt.attr("id"));
    }

    // récupère l'élément suivant et change d'élément actif si différent de null
    goToNext()
    {
        let $nextElt = $(".slide.active").next();
        
        if($nextElt.length !== 0)
            this.replace($nextElt.attr("id"));
    }

    move()
    {
        if($(".slide.active").css("left") !== "0px")
            return true;
        else
            return false;
    }
}