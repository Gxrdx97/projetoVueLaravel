<template>
  <nav class="navbar bg-dark navbar-dark navbar-expand-sm stick-top" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand">
        <router-link to="/"
          ><img class="sml" :src="logo" :alt="alt" id="logo"
        /></router-link>
        Burguer Market  
      </a>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <router-link to="/" class="nav-link" :class="{ 'active': isActive('/') }">Home</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/pedidos" class="nav-link" :class="{ 'active': isActive('/pedidos') }">Orders</router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  
</template>


<script>
export default {
  name: "Navbar",
  props: ["logo", "alt"],
  methods:{
    isActive(route) {
      return this.$route.path === route;
    }
  }
};
</script>

<style>
.sml {
  width: 40px;
  height: 40px;
}
</style>
