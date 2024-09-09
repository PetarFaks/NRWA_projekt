<template>
    <HeaderComponent />
    <div class="admin-page">
      <AdminComponent />
      <div class="content">
        <h2>Addresses</h2>
        <table class="products-table">
          <thead>
            <tr>
              <th>Address ID</th>
              <th>Street</th>
              <th>City</th>
              <th>Postal Code</th>
              <th>Naredbe</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="address in addresses" :key="address.AddressID">
              <td>{{ address.AddressID }}</td>
              <td>{{ address.AddressLine1 }}</td>
              <td>{{ address.City }}</td>
              <td>{{ address.PostalCode }}</td>
              <td><button @click="editAddress(address.AddressID)">Uredi</button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <FooterComponent />
  </template>
  
  <script>
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
    data() {
      return {
        addresses: [],
      };
    },
    async created() {
      await this.fetchAddresses();
    },
    methods: {
      async fetchAddresses() {
        try {
          const response = await apiClient.get('/admin/addresses');
          this.addresses = response.data;
        } catch (error) {
          console.error('Error fetching addresses:', error);
        }
      },
      editAddress(id) {
        this.$router.push(`/admin/addresses/${id}`);
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

  