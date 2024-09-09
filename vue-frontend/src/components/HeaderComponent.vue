<template>
  <header class="header">
    <div class="logo">
      AdventureWorks<span class="db">DB</span>
    </div>
    <nav class="nav">
      <button class="nav-button" @click="navigateToHome">Početna</button>
      <button v-if="!isLoggedIn" class="nav-button" @click="navigateToLogin">Prijava</button>
      <button v-if="!isLoggedIn" class="nav-button" @click="navigateToRegister">Registracija</button>
      <button v-if="isLoggedIn" class="nav-button" @click="navigateToProfil">Profil</button>
      <button v-if="isAdmin" class="nav-button" @click="navigateToAdmin">Admin</button>
    </nav>
  </header>
</template>

<script>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';
import { useRouter } from 'vue-router';

export default {
  name: 'HeaderComponent',
  setup() {
    const isLoggedIn = ref(localStorage.getItem('token') !== null);
    const userRole = ref(localStorage.getItem('role')); 
    const router = useRouter();

    const isAdmin = computed(() => userRole.value === 'admin');

    const navigateToLogin = () => {
      router.push('/login');
    };

    const navigateToHome = () => {
      router.push('/');
    };

    const navigateToRegister = () => {
      router.push('/register');
    };

    const navigateToAdmin = () => {
      router.push('/admin');
    };

    const navigateToProfil = () => {
      router.push('/profil');
    };


   

    return {
      isLoggedIn,
      isAdmin,
      navigateToHome,
      navigateToLogin,
      navigateToRegister,
      navigateToAdmin,
      navigateToProfil
    };
  },
};
</script>


<style scoped>
* {
  box-sizing: border-box;
}

body {
  margin: 0;
  padding: 0;
}

.header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  padding: 20px;
  background-color: #333;
  color: white;
  display: flex;
  justify-content: space-between;
  align-items: center;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.45);
  z-index: 1000; 
}

.logo {
  font-family: 'Dancing Script', cursive;
  font-size: 24px;
  font-weight: bold;
}

.logo .db {
  color: green;
}

.nav {
  display: flex;
  gap: 10px;
}

.nav-button {
  background-color: #555;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.nav-button:hover {
  background-color: #777;
}


:root {
  --header-height: 75px;
}

body {
  padding-top: var(--header-height);
}
</style>
