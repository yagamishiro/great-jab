<template>
    <div class="d-flex flex-column min-vh-100">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="/">
            <img src="https://getbootstrap.com/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Logo" width="35" height="30" class="d-inline-block align-text-top">
            GreatJAB
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-link active" aria-current="page" href="/transactions">GCASH</a>
            </div>
          </div>
        </div>
      </nav>
  
      <!-- Main Content -->
      <div class="flex-grow-1">
        <router-view v-slot="{ Component, route }">
          <div :key="route.name">
            <Component :is="Component" />
          </div>
        </router-view>
      </div>
  
      <!-- Footer -->
      <footer class="bg-light text-center text-lg-start mt-4">
        <div class="text-center p-3">
          © 2024 GreatJAB. All rights reserved.
        </div>
      </footer>
    </div>
  </template>
  
  <style scoped>
  .navbar-brand {
    font-weight: bold;
    font-size: 1.5rem;
  }
  
  /* Sticky Footer */
  footer {
    width: 100%;
  }
  </style>
  