<template>
<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <span class="navbar-item"  style="cursor:pointer;">
      <img src="bnn.jpg" alt="Phonebook" width="33" style="margin-right:6px;border-radius:22px;">
      <span>Phonebook</span>
    </span>
    <router-link to="/home" class="navbar-item">Home</router-link>
    <router-link to="/about" class="navbar-item">About</router-link>
    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>
</nav>
</template>
<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
