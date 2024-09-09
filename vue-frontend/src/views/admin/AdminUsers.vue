<template>
    <HeaderComponent />
    <div class="admin-page">
      <AdminComponent />
      <div class="content">
        <h2>Users</h2>
        <table class="products-table">
          <thead>
            <tr>
              <th>User ID</th>
              <th>Korisnicko ime</th>
              <th>Email</th>
              <th>AdresaID</th>
              <th>Google prijava</th>
              <th>Uloga</th>
              <th>Naredbe</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in users" :key="user.id">
              <td>{{ user.id }}</td>
              <td>{{ user.CustomerName }}</td>
              <td>{{ user.email }}</td>
              <td> {{ user.AddressID }}</td>
              <td>{{ user.google_id !== null ? 'Da' : 'Ne' }}</td>
              <td>{{ user.role }}</td>
              <td><button @click="deleteUser(user.id)">Obriši</button></td>
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
        users: [],
      };
    },
    async created() {
      await this.fetchUsers();
    },
    methods: {
      async fetchUsers() {
        try {
          const response = await apiClient.get('/admin/users');
          this.users = response.data;
        } catch (error) {
          console.error('Error fetching users:', error);
        }
      },
      async deleteUser(id) {
        if (confirm('Are you sure you want to delete this user?')) {
          try {
            await apiClient.delete(`/admin/users/${id}`);
            this.fetchUsers(); 
          } catch (error) {
            console.error('Error deleting user:', error);
          }
        }
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
  background-color: #ff0000;
  color: white;
  border: none;
  padding: 5px 10px;
  border-radius: 4px;
  cursor: pointer;
}

.products-table button:hover {
  background-color: #b30027;
}
</style>