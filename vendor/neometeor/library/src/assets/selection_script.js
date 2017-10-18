var dropdown = document.getElementById("this_is_a_dropdown");
dropdown.onchange = function(event){
    document.getElementById("selection").innerHTML = ("You want to go " + dropdown.value + ".")
}
