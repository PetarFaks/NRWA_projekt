<template>
    <div>
      <p>Redirecting...</p>
    </div>
  </template>
  
  <script>
  export default {
    mounted() {
      const urlParams = new URLSearchParams(window.location.search);
      const token = urlParams.get('token');
      const role = urlParams.get('role');
  
      if (token && role) {
        localStorage.setItem('token', token);
        localStorage.setItem('role', role);
        this.$router.push('/products'); 
      } else {
        this.$router.push('/login'); 
      }
    }
  };
  </script>
  