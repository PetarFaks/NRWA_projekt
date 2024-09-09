<template>
    <HeaderComponent />
    <div class="admin-page">
      <AdminComponent />
      <div class="content">
        <div class="cards-container">
          <TableCard title="Products" :count="tableCounts.products" @click="navigateTo('products')" />
          <TableCard title="Addresses" :count="tableCounts.addresses" @click="navigateTo('addresses')" />
          <TableCard title="Users" :count="tableCounts.users" @click="navigateTo('users')" />
          <TableCard title="Sales Order Details" :count="tableCounts.salesOrderDetails" @click="navigateTo('sales-order-details')" />
        </div>
        <router-view></router-view>
      </div>
    </div>
    <FooterComponent />
  </template>
  
  <script>
  import AdminComponent from '/src/components/AdminComponent.vue';
  import HeaderComponent from '/src/components/HeaderComponent.vue';
  import FooterComponent from '/src/components/FooterComponent.vue';
  import TableCard from '/src/components/TableCard.vue'; 
  import apiClient from '/src/axiosPostavke.js';
  
  export default {
    name: 'AdminPage',
    components: {
      AdminComponent,
      HeaderComponent,
      FooterComponent,
      TableCard,
    },
    data() {
      return {
        tableCounts: {
          products: 0,
          addresses: 0,
          users: 0,
          salesOrderDetails: 0,
        },
      };
    },
    async created() {
      await this.fetchTableCounts();
    },
    methods: {
      async fetchTableCounts() {
        try {
          const productsResponse = await apiClient.get('/admin/products_count');
          const addressesResponse = await apiClient.get('/admin/addresses_count');
          const usersResponse = await apiClient.get('/admin/users_count');
          const salesOrderDetailsResponse = await apiClient.get('/admin/sales-order-details_count');
  
          this.tableCounts.products = productsResponse.data.count;
          this.tableCounts.addresses = addressesResponse.data.count;
          this.tableCounts.users = usersResponse.data.count;
          this.tableCounts.salesOrderDetails = salesOrderDetailsResponse.data.count;
        } catch (error) {
          console.log(this.tableCounts.products)
          console.error('Error fetching table counts:', error);
        }
      },
      navigateTo(path) {
        this.$router.push(`/admin/${path}`);
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
  
  .cards-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
  }
  </style>
  