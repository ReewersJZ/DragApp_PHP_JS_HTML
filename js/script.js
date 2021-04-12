
function AddNext(licznik){
    var licznik = parseInt(document.getElementById(licznik).value);
    
    if (licznik <= 24){
        licznik = licznik + 1;
        let divToShow = document.getElementById("divPomiary" + licznik);
        divToShow.style.display = "block";

    }
    else{
        alert('Synek! Nie można dodać więcej pól formularza');
    }

    document.getElementById('licznik').value = licznik;
}

function showMaterials(showMaterialsDivs){
    let showEverything = document.getElementById(showMaterialsDivs);
    showEverything.style.display = "block";

}