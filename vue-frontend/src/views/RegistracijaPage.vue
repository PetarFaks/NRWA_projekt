<template>
  <div class="page-container">
    <HeaderComponent />
    <div class="form-container">
      <form @submit.prevent="register()">
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" v-model="name">
        </div>
        <div class="form-group">
          <label for="number">Contact Number:</label>
          <input type="text" v-model="number">
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" v-model="email" required>
        </div>
        <div class="form-group">
          <label for="password">Lozinka:</label>
          <input type="password" v-model="password" required>
        </div>
        <div class="form-group">
          <label for="password_confirmation">Potvrda Lozinke:</label>
          <input type="password" v-model="password_confirmation" required>
        </div>
        <button type="submit" class="submit-button">Registracija</button>
      </form>
    </div>
  </div>
  <FooterComponent />
</template>

<script>
import apiClient from '../axiosPostavke.js';
import FooterComponent from '../components/FooterComponent.vue';
import HeaderComponent from '../components/HeaderComponent.vue';

export default {
  components: {
    HeaderComponent,
    FooterComponent,
  },
  data() {
    return {
      name: '',
      number: '',
      email: '',
      password: '',
      password_confirmation: '' 
    };
  },
  methods: {
    async register() {
      try {
        const response = await apiClient.post('/register', {
          CustomerName: this.name,
          ContactNumber: this.number,
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation 
        });

        localStorage.setItem('token', response.data.token);
        localStorage.setItem('role', response.data.role); 
        localStorage.setItem('UserID', response.data.id); 
        console.log('User registered', response.data);
        console.log("Token: ", response.data.token)
        this.$router.push('/products');
      } catch (error) {
        console.error('Registration error', error);
        alert('An error occurred. Please try again later.');
      }
    }
  }
};
</script>

<style scoped>

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

.page-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  background-color: #f0f0f0; 
}

.form-container {
  background-color: #f9f9f9;
  padding: 30px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 400px;
  margin: 0 auto;
}

.form-group {
  margin-bottom: 20px;
}

.form-group label {
  display: block;
  margin-bottom: 8px;
  font-weight: bold;
  color: #333;
}

.form-group input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

.submit-button {
  width: 100%;
  padding: 12px;
  background-color: #05aa2e;
  color: white;
  border: none;
  border-radius: 4px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.submit-button:hover {
  background-color: #0fd301;
}
</style>
