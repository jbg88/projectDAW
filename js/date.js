//creo la variable para usar el objeto date
var d = document.querySelector("#jsDate");

d.addEventListener('load', displayDate());

function displayDate() {
    var d2 = new Date();
    d.innerHTML = d2.getFullYear();
}