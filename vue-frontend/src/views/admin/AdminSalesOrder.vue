<template>
    <HeaderComponent />
    <div class="admin-page">
      <AdminComponent />
      <div class="content">
        <h2>Sales Orders</h2>
        <table class="orders-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Product ID</th>
              <th>Order Qty</th>
              <th>Unit Price</th>
              <th>Line Total</th>
              <th>Order Date</th>
              <th>Naredbe</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="order in salesOrders" :key="order.SalesOrderDetailID">
              <td>{{ order.SalesOrderDetailID }}</td>
              <td>{{ order.ProductID }}</td>
              <td>{{ order.OrderQty }}</td>
              <td>{{ order.UnitPrice }}</td>
              <td>{{ order.LineTotal }}</td>
              <td>{{ order.OrderDate }}</td>
              <td>
                <button @click="editOrder(order.SalesOrderDetailID)">Obriši</button>
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
      salesOrders: [],
    };
  },
  components: {
    HeaderComponent,
    AdminComponent,
    FooterComponent,
  },
  async created() {
    await this.fetchSalesOrders();
  },
  methods: {
    async fetchSalesOrders() {
      try {
        const response = await apiClient.get('/admin/sales_order_details');
        this.salesOrders = response.data;
      } catch (error) {
        console.error('Error fetching sales orders:', error);
      }
    },
    editOrder(id) {
      this.$router.delete(`/admin/sales_order_details/${id}`);
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

.orders-table {
  width: 100%;
  border-collapse: collapse;
}

.orders-table th,
.orders-table td {
  padding: 10px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

.orders-table th {
  background-color: #f4f4f4;
}

.orders-table td {
  vertical-align: middle;
}

.orders-table button {
  background-color: #ff0004;
  color: white;
  border: none;
  padding: 5px 10px;
  border-radius: 4px;
  cursor: pointer;
}

.orders-table button:hover {
  background-color: #b30000;
}
</style>
