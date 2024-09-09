<template>
    <HeaderComponent />
    <div class="admin-page">
      <AdminComponent />
      <div class="content">
        <h2>Edit Address</h2>
        <form @submit.prevent="updateAddress">
          <div class="form-group">
            <label for="street">Street:</label>
            <input type="text" v-model="address.AddressLine1" id="street" required />
          </div>
          <div class="form-group">
            <label for="city">City:</label>
            <input type="text" v-model="address.City" id="city" required />
          </div>
          <div class="form-group">
            <label for="postalCode">Postal Code:</label>
            <input type="text" v-model="address.PostalCode" id="postalCode" required />
          </div>
          <div class="buttons">
            <button type="submit" class="save-button">Sačuvaj promjene</button>
            <button @click.prevent="deleteAddress" class="delete-button">Obriši</button>
          </div>
        </form>
      </div>
    </div>
    <FooterComponent />
  </template>
  
  <script>
  import { ref } from 'vue';
  import { useRoute, useRouter } from 'vue-router';
  import apiClient from '/src/axiosPostavke.js';
  import HeaderComponent from '/src/components/HeaderComponent.vue';
  import AdminComponent from '/src/components/AdminComponent.vue';
  import FooterComponent from '/src/components/FooterComponent.vue';
  
  export default {
    components: {
      HeaderComponent,
      AdminComponent,
      FooterComponent,
    },
    setup() {
      const address = ref({
        AddressLine1: '',
        City: '',
        PostalCode: ''
      });
      const route = useRoute();
      const router = useRouter();
  
      const fetchAddress = async () => {
        try {
          const response = await apiClient.get(`/admin/addresses/${route.params.id}`);
          address.value = response.data;
        } catch (error) {
          console.error('Error fetching address:', error);
        }
      };
  
      const updateAddress = async () => {
        try {
          await apiClient.put(`/admin/addresses/${route.params.id}`, address.value);
          router.push('/admin/addresses');
        } catch (error) {
          console.error('Error updating address:', error);
        }
      };
  
      const deleteAddress = async () => {
        try {
          await apiClient.delete(`/admin/addresses/${route.params.id}`);
          router.push('/admin/addresses');
        } catch (error) {
          console.error('Error deleting address:', error);
        }
      };
  
      fetchAddress();
  
      return {
        address,
        updateAddress,
        deleteAddress,
      };
    }
  };
  </script>

  <style scoped>
  .admin-page {
    display: flex;
    margin-top: 75px;
    height: 100vh;
    background-color: #fff;
  }
  
  .content {
    margin-left: 200px; 
    padding: 20px;
    width: calc(100% - 200px);
  }


  .form-group {
    margin-bottom: 15px;
  }
  
  .form-group label {
    display: block;
    margin-bottom: 5px;
  }
  
  .form-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }
  
  .buttons {
    display: flex;
    gap: 10px;
  }
  
  .save-button {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
  }
  
  .delete-button {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
  }
  </style>
  