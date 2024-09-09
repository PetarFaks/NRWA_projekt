<template>
    <HeaderComponent />
    <div class="admin-page">
      <AdminComponent />
      <div class="content">
        <h2>Edit Product</h2>
        <form @submit.prevent="updateProduct">
          <div class="form-group">
            <label for="productName">Product Name:</label>
            <input type="text" v-model="product.ProductName" id="productName" required />
          </div>
          <div class="form-group">
            <label for="productNumber">Product Number:</label>
            <input type="text" v-model="product.ProductNumber" id="productNumber" required />
          </div>
          <div class="form-group">
            <label for="color">Color:</label>
            <input type="text" v-model="product.Color" id="color" required />
          </div>
          <div class="form-group">
            <label for="standardCost">Standard Cost:</label>
            <input type="number" v-model="product.StandardCost" id="standardCost" required />
          </div>
          <div class="form-group">
            <label for="listPrice">List Price:</label>
            <input type="number" v-model="product.ListPrice" id="listPrice" required />
          </div>
          <div class="buttons">
            <button type="submit" class="save-button">Sačuvaj promjene</button>
            <button @click.prevent="deleteProduct" class="delete-button">Obrišit</button>
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
      const product = ref({
        ProductName: '',
        ProductNumber: '',
        Color: '',
        StandardCost: '',
        ListPrice: ''
      });
      const route = useRoute();
      const router = useRouter();
  
      const fetchProduct = async () => {
        try {
          const response = await apiClient.get(`/admin/products/${route.params.id}`);
          product.value = response.data;
        } catch (error) {
          console.error('Error fetching product:', error);
        }
      };
  
      const updateProduct = async () => {
        try {
          await apiClient.put(`/admin/products/${route.params.id}`, product.value);
          router.push('/admin/products');
        } catch (error) {
          console.error('Error updating product:', error);
        }
      };
  
      const deleteProduct = async () => {
        try {
          await apiClient.delete(`/admin/products/${route.params.id}`);
          router.push('/admin/products');
        } catch (error) {
          console.error('Error deleting product:', error);
        }
      };
  
      fetchProduct();
  
      return {
        product,
        updateProduct,
        deleteProduct,
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
  