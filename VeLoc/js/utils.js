// rfécupère la position de la souris ou du doigt
function getMousePos(event, mobile) {
    var element = event.target.getBoundingClientRect();

    if(mobile)
    {
        return {
            x: event.changedTouches[0].clientX - element.left,
            y: event.changedTouches[0].clientY - element.top
        };
    }
    else
    {
        return {
            x: event.clientX - element.left,
            y: event.clientY - element.top
        };
    }
}

// permet de calculer la différence entre deux dates
function calculDate(date1, date2)
{
    var date = {};
    var temp = date2 - date1;

    temp = Math.floor(temp / 1000); // conversion des ms en secondes
    date.seconde = (temp % 60); // le résultat modulo 60 secondes

    temp = Math.floor((temp - date.seconde) / 60); // conversion des secondes en minutes
    date.minute =  (temp % 60); // le résultat modulo 60 minutes

    temp = Math.floor((temp - date.minute) / 60); // conversion des minutes en heure
    date.heure = (temp % 24); // le résultat modulo 24 heures

    date.jour = Math.floor((temp - date.minute) / 24); // conversion des heures en jours
    
    // inversion des valeurs
    date.seconde *= -1;
    date.minute *= -1;
    date.heure *= -1;
    date.jour *= -1;
    
    return date;
}

// fonction qui test si localStorage/sessionStorage fonctionnent
function testLocalStorage(type)
{
    try
    {
        let storage = window[type];
        let test = '_TestAdd_';

        storage.setItem(test, test);
        storage.removeItem(test);
        
        return true;
    }
    catch(error)
    {
        console.log(error);
        return false;
    }
}

// fonction qui désactive le scroll
function disableScroll(){
    let x = window.scrollX;
    let y = window.scrollY;
    window.onscroll = function() { window.scrollTo(x, y); };
}

// fonction qui réactive le scroll
function enableScroll(){
    window.onscroll = function() {};
}