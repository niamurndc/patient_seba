<template>
  <div class="az-header">
    <div class="container">
        <div class="az-header-left">
        <a href="index.html" class="az-logo"><span></span> ps</a>
        <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
        </div><!-- az-header-left -->
        <div class="az-header-menu">
        <div class="az-header-menu-header">
            <a href="index.html" class="az-logo"><span></span> ps</a>
            <a href="" class="close">&times;</a>
        </div><!-- az-header-menu-header -->
        <ul class="nav">
            <li class="nav-item">
              <a href="" class="nav-link with-sub"><i class="typcn typcn-document-text"></i> Calls</a>
              <nav class="az-menu-sub">
                  <a href="page-signin.html" class="nav-link">Online</a>
                  <a href="page-signup.html" class="nav-link">Offline</a>
              </nav>
            </li>
            <li class="nav-item active show">
              <a href="/" class="nav-link"><i class="typcn typcn-chart-area-outline"></i> Orders</a>
            </li>
            
            <li class="nav-item">
              <a href="" class="nav-link with-sub"><i class="typcn typcn-group-outline"></i> User</a>
              <nav class="az-menu-sub">
                  <a href="" class="nav-link">Customer</a>
                  <a href="" class="nav-link">Doctor</a>
              </nav>
            </li>

            <li class="nav-item">
              <a href="" class="nav-link"><i class="typcn typcn-shopping-cart"></i> Products</a>
            </li>

            <li class="nav-item">
              <a href="" class="nav-link"><i class="typcn typcn-location-arrow-outline"></i> Area</a>
            </li>

            <li class="nav-item">
              <a href="" class="nav-link"><i class="typcn typcn-chart-line-outline"></i> Transections</a>
            </li>

            <li class="nav-item">
              <a href="" class="nav-link"><i class="typcn typcn-cog-outline"></i> Setting</a>
            </li>
            
        </ul>
        </div><!-- az-header-menu -->
        <div class="az-header-right">

            <div class="dropdown az-profile-menu">
                <a href="" class="az-img-user"><img src="" alt=""></a>
                <div class="dropdown-menu">
                <div class="az-dropdown-header d-sm-none">
                    <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                </div>
                <div class="az-header-profile">
                    <h6>Aziana Pechon</h6>
                    <span>Premium Member</span>
                </div><!-- az-header-profile -->

                <a href="" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
                <a href="" class="dropdown-item"><i class="typcn typcn-edit"></i> Edit Profile</a>
                <a href="page-signin.html" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Sign Out</a>
                </div><!-- dropdown-menu -->
            </div>
        </div><!-- az-header-right -->
    </div><!-- container -->
</div><!-- az-header -->
</template>