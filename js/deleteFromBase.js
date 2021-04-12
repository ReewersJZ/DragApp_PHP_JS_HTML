
function deleteFromBase(delete_position_form){

    
    var answer = window.confirm("Na pewno usunąć z bazy?");
    if (answer) {
        console.log('tak');
        var delete_position_form = document.getElementById(delete_position_form);
        document.delete_position_form.submit();
    }
    else {
        console.log('nie');
    }
}
