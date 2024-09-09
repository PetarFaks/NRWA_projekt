<template>
  <div class="page-container">
    <HeaderComponent />
    <div class="form-container">
      <form @submit.prevent="login()">
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" v-model="email" required>
        </div>
        <div class="form-group">
          <label for="password">Lozinka:</label>
          <input type="password" v-model="password" required>
        </div>
        <button type="submit" class="submit-button">Prijava</button>
      </form>
      <button @click="loginWithGoogle" class="google-login-button">Google prijava</button>
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
      email: '',
      password: ''
    };
  },
  methods: {
    async login() {
      try {
        const response = await apiClient.post('/login', {
          email: this.email,
          password: this.password
        });

        localStorage.setItem('token', response.data.token);
        localStorage.setItem('role', response.data.role); 
        localStorage.setItem('UserID', response.data.id); 
        console.log('User logged in', response.data);
        this.$router.push('/products');
      } catch (error) {
        console.error('Login error', error);
        if (error.response && error.response.status === 401) {
          alert('Neispravan unos');
        } else {
          alert('Error. Pokušajte kasnije');
        }
      }
    },
    loginWithGoogle() {
      window.location.href = 'http://localhost:8000/api/auth/google';
    },
    redirectForgotPass() {
      this.$router.push('/forgot-password')
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

.google-login-button {
  width: 100%;
  padding: 12px;
  background-color: #4285F4;
  color: white;
  border: none;
  border-radius: 4px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  margin-top: 15px;
}

.google-login-button:hover {
  background-color: #357AE8;
}

.forgot-pass {
  margin-bottom: 15px;
  color: blue;
  text-decoration: underline;
  cursor: pointer;
  transition: ease-in 0.15s;
}

.forgot-pass:hover {
  color: rgb(6, 6, 120);
}
</style>
