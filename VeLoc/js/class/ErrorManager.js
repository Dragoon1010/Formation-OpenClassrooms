// class qui affiche une erreur à l'emplacement du handle souhaité 
// (peut être n'importe quel élément du site)
class ErrorManager
{
    constructor()
    {
        this.exist = false;
        this.errorCode = "";
        this.errorText = "";
        this.handle = "";
        this.$errorElt = $(document.createElement("div")).addClass("error");
    }

    // créé tout le corp de la div erreur prêt à être afficher
    create(errorCode, errorText, handle)
    {
        // met à jour les valeurs de l'objet
        this.exist = true;
        this.errorCode = errorCode;
        this.errorText = errorText;
        this.handle = handle;

        // créé un titre à l'erreur
        let $h1Elt = $(document.createElement("h1")).attr("id", "error-title");
        $h1Elt.text("Une erreur s'est produite, veuillez réessayer ultérieurement");

        // créé un paragraphe à l'erreur
        let $pElt = $(document.createElement("p")).attr("id", "error-text");
        $pElt.text("Code d'erreur : " + this.errorCode + " " + this.errorText);
        
        // créé un bouton "recharger" à l'erreur
        let $buttonElt = $(document.createElement("button")).attr("id", "error-reload");
        $buttonElt.text("Recharger");
        $buttonElt.on("click", function(e)
        {
            // TODO
        });
        
        // on ajoute la div error a la main section
        // et on ajoute le titre et le paragraphe à la div erreur
        $("#" + handle).append(this.$errorElt); 
        this.$errorElt.append($h1Elt).append($pElt).append($buttonElt);
    }

    // met à jour le code d'erreur et déplace l'erreur au handle
    update(errorCode, errorText, handle)
    {
        // met à jour les valeurs de l'objet
        this.errorCode = errorCode;
        this.errorText = errorText;
        this.handle = handle;

        // met à jour le contenu du paragraphe et déplace la div au handle associé
        errorManager.$errorElt.children("#error-text").text("Code d'erreur : " + errorCode + " " + errorText);
        $("#" + handle).append(errorManager.$errorElt);
    }

    // affiche ou non la div d'erreur
    show(bool)
    {
        if(bool === true)
            this.$errorElt.show();
        else 
            this.$errorElt.hide();
    }
}