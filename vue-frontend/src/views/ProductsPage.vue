<template>
  <HeaderComponent />
  <div class="products-container">
    <h1 class="title">Proizvodi</h1>
   
    <ul class="products-list">
      <li v-for="product in paginatedProducts" :key="product.ProductID">
        {{ product.ProductName }}
        <button @click="viewProduct(product.ProductID)">Pregledaj</button>
      </li>
    </ul>
  </div>
    <div class="pagination">
      <button @click="prevPage" :disabled="currentPage === 1">Predthodna</button>
      <span>Stranica {{ currentPage }} od {{ totalPages }}</span>
      <button @click="nextPage" :disabled="currentPage === totalPages">Sljedeća</button>
    </div>
  
  <FooterComponent />
</template>

<script>
import apiClient from '../axiosPostavke'; 
import HeaderComponent from '../components/HeaderComponent.vue';
import FooterComponent from '../components/FooterComponent.vue';
import { ref, computed } from 'vue';
import { useRouter } from 'vue-router';

export default {
  data() {
    return {
      products: [],
      currentPage: 1,
      pageSize: 5, 
    };
  },
  components: {
    HeaderComponent,
    FooterComponent
  },
  created() {
    console.log('Component created');
    this.fetchProducts();
  },
  methods: {
    async fetchProducts() {
      console.log('Fetching products');
      try {
        const response = await apiClient.get('/products');
        console.log('API called');
        this.products = response.data;
        console.log(response.data);
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    },
    viewProduct(productID) {
      this.$router.push(`/products/${productID}`);
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    },
  },
  computed: {
    totalPages() {
      return Math.ceil(this.products.length / this.pageSize);
    },
    paginatedProducts() {
      const start = (this.currentPage - 1) * this.pageSize;
      const end = start + this.pageSize;
      return this.products.slice(start, end);
    }
  }
};
</script>

<style scoped>
.products-container {
  background-color: #f0f0f0;
  height: 80vh;
  margin-top: 75px;
  text-align: center;
  padding: 20px;
}

.title {
  margin-bottom: 20px;
  font-size: 24px;
}

.products-list {
  width: 50%;
  margin: 0 auto; 
  padding: 10px;
  
  list-style: none;
}

.products-list li {
  padding: 25px;
  border: 1px solid #ddd;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}

button {
  background-color: #007BFF;
  color: white;
  border: none;
  padding: 10px 15px;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #0056b3;
}

.pagination {
  padding-bottom: 20px;
  left: 50%;
  background-color: #f0f0f0;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
}

.pagination button {
  margin: 0 5px;
}
</style>
