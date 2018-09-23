function ajaxGet(url, handleErrror, callback) // methode pour créer une requete GET
{
    let requete = new XMLHttpRequest();

    requete.open("GET", url);
    requete.addEventListener("loadend", function()
    {
        if(requete.status >= 200 && requete.status < 400)
        {
            callback(requete.responseText);
        }
        else
        {
            // envoie un message d'erreur
            if(!errorManager.exist)
            {
                errorManager.create(requete.statusCode, requete.statusText, handleErrror);
                errorManager.show(true);
            }
            else 
            {
                errorManager.update(requete.statusCode, requete.statusText, handleErrror);
                errorManager.show(true);
            }
        }
    });
    requete.addEventListener("error", function()
    {
        // envoie un message d'erreur
        if(!errorManager.exist)
        {
            errorManager.create(requete.statusCode, requete.statusText, handleErrror);
            errorManager.show(true);
        }
        else 
        {
            errorManager.update(requete.statusCode, requete.statusText, handleErrror);
            errorManager.show(true);
        }
    });
    
    requete.send(null);
}

function ajaxPost(data, handleErrror, isJson) // methode pour créer une requete POST
{
    let requete = new XMLHttpRequest();

    requete.open("POST", url);
    requete.addEventListener("loadend", function()
    {
        if(requete.status >= 200 && requete.status < 400)
        {
            callback(requete.responseText);
        }
        else 
        {
            // envoie un message d'erreur
            if(!errorManager.exist)
            {
                errorManager.create(requete.statusCode, requete.statusText, handleErrror);
                errorManager.show(true);
            }
            else 
            {
                errorManager.update(requete.statusCode, requete.statusText, handleErrror);
                errorManager.show(true);
            }
        }
    });
    requete.addEventListener("error", function()
    {
        // envoie un message d'erreur
        if(!errorManager.exist)
        {
            errorManager.create(requete.statusCode, requete.statusText, "station-infos");
            errorManager.show(true);
        }
        else 
        {
            errorManager.update(requete.statusCode, requete.statusText, "station-infos");
            errorManager.show(true);
        }
    });
    
    if (isJson) 
    {
        requete.setRequestHeader("Content-Type", "application/json");
        data = JSON.stringify(data);
    }

    requete.send(data);
}