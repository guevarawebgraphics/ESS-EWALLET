<template>
  <div class="container">
      <!-- <h1>Dashboard</h1> -->
  </div>
</template>

<script>
export default {
  data(){
    return {
      user: window.localStorage.getItem('user'),
    }
  },
  methods: {
    checkAuthenticatedUser(){
      if(!this.user){
        window.location.href="/";
      }
    }
  },
  created(){
    this.checkAuthenticatedUser();
  }
}
</script>

<style>

</style>