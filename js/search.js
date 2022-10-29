

function copie() {

    /*** had lvariable "d" htit fih l combo box kamla */
    var d = document.getElementById("choix");
    /****hna glt lih ched liya ghir la valeur choisi o affectiha l variable display */
    var display = d.options[d.selectedIndex].text;

    /**********hna fin drt test 3la dik la valeur choisi ila kant k tsawi wahda mn had les critères y affichiha sinon
     y khali dik input khawya o ybdel liha type dyalha mn "text" l "tel"
     */
    if (display == "Appartement" || display=="Villa" || display=="Magasin Commerce" || display=="Bureaux et Plateaux" || display=="Maison" || display=="locaux industriels") {
        document.getElementById("afficheur").value = display;
        document.getElementById("afficheur").readOnly = true;
    } else if (display == "Prix" || display=="Surface"  ) 
    {
        document.getElementById("afficheur").readOnly = false;
    }
    else{
        document.getElementById("afficheur").type = "tel"
        document.getElementById("afficheur").value = "";
    }
}
