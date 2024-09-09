<template>
    <HeaderComponent />
    <div class="profile-container">
      <div class="profile-card">
        <h2>Profil korisnika</h2>
        <div class="profile-info">
          <p><strong>Ime:</strong> {{ user.CustomerName }}</p>
          <p><strong>Email:</strong> {{ user.email }}</p>
          <p>
            <strong>Kontakt broj:</strong>
            <span v-if="!editContactNumber">{{ user.ContactNumber }}</span>
            <input v-else type="text" v-model="newContactNumber" />
            <button v-if="!editContactNumber" @click="editContactNumber = true">Uredi</button>
            <div style="display: inline;" v-else>
            <button @click="confirmEditContactNumber">Potvrdi</button>
            <button @click="cancelEditContactNumber">Otkaži</button>
        </div>
          </p>
        </div>
        <h3>Adresa</h3>
        <div v-if="address">
          <div class="address-info">
            <p><strong>Ulica:</strong> {{ address.AddressLine1 }}</p>
            <p><strong>Grad:</strong> {{ address.City }}</p>
            <p><strong>Poštanski broj:</strong> {{ address.PostalCode }}</p>
          </div>
          <button class="add-button" @click="editAddress = true">Uredi adresu</button>
        </div>
        <div v-else>
          <p>Nema povezanih adresa.</p>
          <button class="add-button" @click="createAddress = true">Dodaj adresu</button>
        </div>
        <button style="margin-top: 15px;" @click="logout" class="logout-button">Odjava</button>
      </div>
  
      <!-- Edit Address Modal -->
      <div v-if="editAddress || createAddress" class="modal">
        <div class="modal-content">
          <h3>{{ createAddress ? 'Dodaj adresu' : 'Uredi adresu' }}</h3>
          <form @submit.prevent="saveAddress">
            <div class="form-group">
              <label for="AddressLine1">Ulica:</label>
              <input type="text" v-model="addressData.AddressLine1" required />
            </div>
            <div class="form-group">
              <label for="city">Grad:</label>
              <input type="text" v-model="addressData.City" required />
            </div>
            <div class="form-group">
              <label for="postalCode">Poštanski broj:</label>
              <input type="text" v-model="addressData.PostalCode" required />
            </div>
            <div style="display: flex; justify-content: space-between; width: 100%;">
              <button class="add-button" type="submit">{{ createAddress ? 'Dodaj' : 'Spremi' }}</button>
              <button class="logout-button" @click="cancelEdit" type="button">Otkaži</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <FooterComponent />
  </template>
  
  <script>
  import apiClient from '../axiosPostavke.js';
  import HeaderComponent from '../components/HeaderComponent.vue';
  import FooterComponent from '../components/FooterComponent.vue';
  import { ref } from 'vue';
  
  export default {
    components: {
      HeaderComponent,
      FooterComponent,
    },
    data() {
      return {
        user: {},
        address: null,
        editContactNumber: false,
        newContactNumber: '',
        editAddress: false,
        createAddress: false,
        addressData: {
          AddressLine1: '',
          City: '',
          PostalCode: '',
        },
      };
    },
    async created() {
        await  this.isLoggedIn();
      await this.fetchUserData();
      await this.fetchUserAddress();
      
    },
    methods: {

    async isLoggedIn(){
            const token = localStorage.getItem('token');
            if(!token){
                this.$router.push('/')
            }
    },
      async fetchUserData() {
        try {
          const response = await apiClient.get('/user');
          this.user = response.data;
          this.newContactNumber = this.user.ContactNumber;
        } catch (error) {
          console.error('Error fetching user data:', error);
        }
      },
      async fetchUserAddress() {
        try {
          const response = await apiClient.get(`/addresses/${this.user.AddressID}`);
          this.address = response.data;
        } catch (error) {
          console.error('Error fetching address:', error);
        }
      },
      async saveAddress() {
        try {
          if (this.createAddress) {
            const response = await apiClient.post('/addresses', this.addressData);
            this.user.AddressID = response.data.id;
          } else {
            await apiClient.put(`/addresses/${this.user.AddressID}`, this.addressData);
          }
          this.fetchUserAddress();
          this.editAddress = false;
          this.createAddress = false;
        } catch (error) {
          console.error('Error saving address:', error);
        }
      },
      cancelEdit() {
        this.editAddress = false;
        this.createAddress = false;
      },
      logout() {
        localStorage.removeItem('token');
        localStorage.removeItem('role');
        this.$router.push('/login');
      },
      async confirmEditContactNumber() {
        try {
          await apiClient.put('/user/number', {
            ContactNumber: this.newContactNumber,
          });
          this.user.ContactNumber = this.newContactNumber;
          this.editContactNumber = false;
        } catch (error) {
          console.error('Error updating contact number:', error);
        }
      },
      cancelEditContactNumber() {
        this.newContactNumber = this.user.ContactNumber;
        this.editContactNumber = false;
      },
    },
  };
  </script>
  
  <style scoped>
  .profile-container {
    margin-top: 75px;
    height: 100vh;
    background-color: #fff;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
  }
  
  .profile-card {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 500px;
  }
  
  .profile-info,
  .address-info {
    margin-bottom: 20px;
  }
  
  .logout-button {
    background-color: #d9534f;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
  }
  
  .add-button {
    background-color: #0a8708;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
  }
  
  .logout-button:hover {
    background-color: #c9302c;
  }
  
  .modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .modal-content {
    background: white;
    padding: 20px;
    border-radius: 8px;
    width: 100%;
    max-width: 400px;
  }
  
  .form-group {
    margin-bottom: 15px;
  }
  
  .form-group label {
    display: block;
    margin-bottom: 5px;
  }
  
  .form-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }
  </style>
  