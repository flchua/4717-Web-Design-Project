function openNav() {
    var sidenav = document.getElementById("cartSidenav");
    sidenav.style.right = "0px";
    sidenav.className += " open";
}
function closeNav() {
    var sidenav = document.getElementById("cartSidenav");
    sidenav.style.right = "-" +sidenav.clientWidth+"px";
    sidenav.className = "cart-side-nav";
}


