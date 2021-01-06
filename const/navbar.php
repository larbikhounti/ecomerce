<?php
// nav bar
$fullname = $_SESSION['fullname']; 
$navbar = "<nav class='navbar navbar-expand-lg navbar-light bg-dark'>

<a class='navbar-brand' href='#'><b>Dashboard</b></a>
<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
  <span class='navbar-toggler-icon'></span>
</button>

<div class='collapse navbar-collapse' id='navbarSupportedContent'>
  <ul class='navbar-nav mr-auto'>
    <li class='nav-item active'>
      <a class='nav-link' href='#'>Home <span class='sr-only'>(current)</span></a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='../pages/members.php'>members</a>
    </li> 
    <li class='nav-item'>
    <a class='nav-link' href='#'>products</a>
  </li> 
  </ul>
  <div class='nav-item dropdown'>
  <div class='nav-link dropdown-toggle' id''navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
    welcome <b>". $fullname ."</b> </div>
  <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
    <a class='dropdown-item' href='../pages/profile.php'>Profile</a>
    <div class='dropdown-divider'></div>
    <a class='dropdown-item' href='../functions/auth/authontication.php?logout=1'>Log Out</a>
  </div>
</div>
</div>
</nav>";

