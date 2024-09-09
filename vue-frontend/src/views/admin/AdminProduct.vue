<template>
  <HeaderComponent />
  <div class="admin-page">
    <AdminComponent />
    <div class="content">
      <h2>Products</h2>
      <table class="products-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Number</th>
            <th>Color</th>
            <th>Cost</th>
            <th>Price</th>
            <th>Naredbe</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products" :key="product.ProductID">
            <td>{{ product.ProductID }}</td>
            <td>{{ product.ProductName }}</td>
            <td>{{ product.ProductNumber }}</td>
            <td>{{ product.Color }}</td>
            <td>{{ product.StandardCost }}</td>
            <td>{{ product.ListPrice }}</td>
            <td>
              <button @click="editProduct(product.ProductID)">Uredi</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <FooterComponent />
</template>

<script>
import apiClient from '/src/axiosPostavke';
import HeaderComponent from '/src/components/HeaderComponent.vue';
import AdminComponent from '/src/components/AdminComponent.vue';
import FooterComponent from '/src/components/FooterComponent.vue';

export default {
  data() {
    return {
      products: [],
    };
  },
  components: {
    HeaderComponent,
    AdminComponent,
    FooterComponent,
  },
  async created() {
    await this.fetchProducts();
  },
  methods: {
    async fetchProducts() {
      try {
        const response = await apiClient.get('/admin/products');
        this.products = response.data;
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    },
    editProduct(id) {
      this.$router.push(`/admin/products/${id}`);
    },
  },
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

.products-table {
  width: 100%;
  border-collapse: collapse;
}

.products-table th,
.products-table td {
  padding: 10px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

.products-table th {
  background-color: #f4f4f4;
}

.products-table td {
  vertical-align: middle;
}

.products-table button {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 5px 10px;
  border-radius: 4px;
  cursor: pointer;
}

.products-table button:hover {
  background-color: #0056b3;
}
</style>
