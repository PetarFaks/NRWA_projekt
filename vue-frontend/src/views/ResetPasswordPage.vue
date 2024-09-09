<template>
    <div class="page-container">
      <HeaderComponent />
      <div class="form-container">
        <form @submit.prevent="resetPassword()">
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" v-model="email" required>
          </div>
          <div class="form-group">
            <label for="password">Nova lozinka:</label>
            <input type="password" v-model="password" required>
          </div>
          <div class="form-group">
            <label for="password_confirmation">Potvrda nove lozinke:</label>
            <input type="password" v-model="password_confirmation" required>
          </div>
          <button type="submit" class="submit-button">Resetiraj lozinku</button>
        </form>
      </div>
    </div>
    <FooterComponent />
  </template>
  
  <script>
  import apiClient from '../axiosPostavke.js';
  import FooterComponent from '../components/FooterComponent.vue';
  import HeaderComponent from '../components/HeaderComponent.vue';
  import { ref } from 'vue';
  import { useRoute } from 'vue-router';
  
  export default {
    components: {
      HeaderComponent,
      FooterComponent,
    },
    setup() {
      const email = ref('');
      const password = ref('');
      const password_confirmation = ref('');
      const route = useRoute();
  
      const resetPassword = async () => {
        try {
          const response = await apiClient.post('/resetPassword', {
            email: email.value,
            password: password.value,
            password_confirmation: password_confirmation.value,
            token: route.query.token 
          });
          alert('Lozinka uspješno resetirana.');
        } catch (error) {
          console.error('Error resetting password:', error);
          alert('Došlo je do greške. Molimo pokušajte ponovno kasnije.');
        }
      };
  
      return {
        email,
        password,
        password_confirmation,
        resetPassword
      };
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
.forgot-pass{
  margin-bottom: 15px;
  color: blue;
  text-decoration: underline;
  cursor: pointer;
  transition: ease-in 0.15s;
}
.forgot-pass:hover{
  color: rgb(6, 6, 120);
}
  </style>
  