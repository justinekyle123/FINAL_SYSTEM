<?php include_once "includes/header.php"; ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm px-4 " id="mainNavbar">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center ms-auto" href="#">
      <i class="fas fa-layer-group me-2 fs-4"></i>
      <span class="fw-semibold fs-5">TripNest</span>
    </a>
  </div>
</nav>

<style>
  #mainNavbar {
  transition: top 0.3s;
}
</style>

<script>
let lastScrollTop = 0;
const navbar = document.getElementById('mainNavbar');

window.addEventListener('scroll', function () {
  let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

  if (scrollTop > lastScrollTop) {
    navbar.style.top = "-80px"; 
  } else {
 
    navbar.style.top = "0";
  }

  lastScrollTop = scrollTop;
});
</script>
