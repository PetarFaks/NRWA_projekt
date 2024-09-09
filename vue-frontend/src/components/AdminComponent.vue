<template>
    <div class="sidebar">
      <button @click="navigateHome">Home</button>
      <button @click="navigateTo('products')">Products</button>
      <button @click="navigateTo('addresses')">Addresses</button>
      <button @click="navigateTo('users')">Users</button>
      <button @click="navigateTo('sales-order-details')">Sales Order Details</button>
    </div>
  </template>
  
  <script>
  import { useRouter } from 'vue-router';
  
  export default {
    name: 'AdminComponent',
    setup() {
      const router = useRouter();
  
      const navigateHome = () => {
        router.push('/admin');
      };
  
      const navigateTo = (path) => {
        router.push(`/admin/${path}`);
      };
  
      return {
        navigateHome,
        navigateTo,
      };
    },
  };
  </script>
  
  <style scoped>
  .sidebar {
 
    top: 0;
    left: 0;
    width: 200px;
    height: 100vh;
    background-color: #333;
    color: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 20px;
    padding-right: 10px;
  }
  
  .sidebar button {
    background-color: #444;
    color: white;
    border: none;
    padding: 10px 20px;
    margin: 10px 0;
    cursor: pointer;
    width: 100%;
    text-align: left;
    padding-left: 30px;
  }
  
  .sidebar button:hover {
    background-color: #555;
  }
  </style>
  