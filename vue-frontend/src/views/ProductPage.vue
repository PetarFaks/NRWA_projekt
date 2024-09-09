<template>
  <HeaderComponent />
  <div class="product-detail-container">
    <div class="product-info">
      <h1>
        {{ product.ProductName }}
        <button class="back-button" @click="goBack">Natrag</button>
      </h1>
      <p><strong>Product Number:</strong> {{ product.ProductNumber }}</p>
      <p><strong>Color:</strong> {{ product.Color }}</p>
      <p><strong>Standard Cost:</strong> {{ product.StandardCost }}</p>
      
      <div class="quantity-container">
        <label for="quantity">Količina:</label>
        <input type="number" id="quantity" v-model="quantity" min="1" />
      </div>
      
      <button class="order-button" @click="orderProduct">Naruči</button>
    </div>
  </div>

  <div v-if="showModal" class="modal">
    <div class="modal-content">
      
      <div v-if="address">
        <p><strong>Adresa:</strong> {{ address.AddressLine1 }}, {{ address.City }}, {{ address.PostalCode }}</p>
        <div style="display: flex; justify-content: space-between; width: 100%;">
        <button class="modal-button" @click="confirmOrder">Potvrdi </button>
        <button class="close-button" @click="closeModal">Natrag</button>
      </div>
      </div>
      <div  v-else>
        <p>Ne postoji adresa povezna s vašim profilom</p>
        <div style="display: flex; justify-content: space-between; width: 100%;">
        <button class="modal-button" @click="goToProfile">Dodaj adresu</button>
        <button class="close-button" @click="closeModal">Natrag</button>
      </div>
      </div>
    </div>
  </div>
  <FooterComponent />
</template>

<script>
import apiClient from '../axiosPostavke'; 
import HeaderComponent from '../components/HeaderComponent.vue';
import FooterComponent from '../components/FooterComponent.vue';
import { ref } from 'vue';
import { useRouter, useRoute } from 'vue-router';

export default {
  components: {
    HeaderComponent,
    FooterComponent,
  },
  setup() {
    const product = ref({});
    const quantity = ref(1);
    const showModal = ref(false);
    const address = ref(null);
    const router = useRouter();
    const route = useRoute();

    const fetchUserDetails = async () => {
    try {
        const response = await apiClient.get('/user/details');
        localStorage.setItem('userID', response.data.id);
    } catch (error) {
        console.error('Error fetching user details:', error);
    }
}


    const fetchProduct = async () => {
      try {
        const response = await apiClient.get(`/products/${route.params.id}`);
        product.value = response.data;
      } catch (error) {
        console.error('Error fetching product:', error);
      }
    };

    const fetchAddress = async () => {
      try {
        const response = await apiClient.get('/user/address');
        address.value = response.data;
      } catch (error) {
        console.error('Error fetching address:', error);
      }
    };

    const goBack = () => {
      router.push('/products');
    };

    const orderProduct = () => {
      const token = localStorage.getItem('token');
      if (!token) {
        router.push('/login');
      } else {
        fetchAddress();
        showModal.value = true;
      }
    };

    const closeModal = () => {
      showModal.value = false;
    };

    const confirmOrder = async () => {
      try {
        const response = await apiClient.post('/sales_order_details', {
          ProductID: product.value.ProductID,
          OrderQty: quantity.value,
          UnitPrice: product.value.StandardCost, 
          OrderDate: new Date().toISOString().slice(0, 10), 
          UserID: localStorage.getItem('userID') 
        });
        alert('Order confirmed!');
        closeModal();
      } catch (error) {
        console.error('Error confirming order:', error);
      }
    };

    const goToProfile = () => {
      router.push('/profil');
    };

    fetchProduct();
    fetchUserDetails();
    return {
      product,
      quantity,
      showModal,
      address,
      goBack,
      orderProduct,
      closeModal,
      confirmOrder,
      goToProfile,
      fetchUserDetails
    };
  },
};
</script>

<style scoped>
.product-detail-container {
  height: 75vh;
  margin-top: 75px;
  background-color: #f0f0f0;
  display: flex;
  justify-content: center;
  align-items: flex-start;
  padding: 20px;
}

.product-info {
  width: 50%;
  padding: 20px;
  border: 1px solid #ddd;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h1 {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.back-button {
  background-color: #007BFF;
  color: white;
  border: none;
  padding: 10px 15px;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.back-button:hover {
  background-color: #0056b3;
}

.order-button {
  display: block;
  width: 100%;
  padding: 10px;
  background-color: #28a745;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  margin-top: 20px;
}

.order-button:hover {
  background-color: #218838;
}

.quantity-container {
  margin-top: 20px;
}

.quantity-container label {
  margin-right: 10px;
}

.modal {
  display: flex;
  justify-content: center;
  align-items: center;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
  background-color: #fff;
  padding: 20px;
  border-radius: 4px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  width: 80%;
  max-width: 500px;
}

.close-button {

  
  display: block;
 
  padding: 10px;
  background-color: #c83500;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
 
}

.modal-button {

  
display: block;

padding: 10px;
background-color: #28a745;
color: white;
border: none;
border-radius: 4px;
cursor: pointer;
transition: background-color 0.3s ease;

}
</style>
