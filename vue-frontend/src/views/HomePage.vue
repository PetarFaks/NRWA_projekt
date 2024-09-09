
<template>
  <div>
    <HeaderComponent />
    <div class="background-container">
   
      <h1>Proizvodi</h1>
      <button @click="redirectProducts">Pogledaj asortiman</button>
    </div>
    <div class="new-block">
      <h2>Kupite kod nas</h2>
      <div class="image-row">
        <div class="image-container">
          <img src="../assets/deliveri.png" alt="Image 1" />
          <p>Dostava</p>
        </div>
        <div class="image-container">
          <img src="../assets/kvalitet.png" alt="Image 2" />
          <p>Kvalitet</p>
        </div>
        <div class="image-container">
          <img src="../assets/money.png" alt="Image 3" />
          <p>Niske cijene</p>
        </div>
      </div>
    </div>
  </div>
  <FooterComponent />
</template>

<script>
import HeaderComponent from '../components/HeaderComponent.vue';
import FooterComponent from '../components/FooterComponent.vue';
export default {
  name: 'HomePage',
  components: {
    HeaderComponent,
    FooterComponent,
  },
  computed:{
    redirectProducts(){
      this.$router.push('/products')
    }
  }
};
</script>
<style scoped>
.background-container {
  margin-top: 75px;
  width: 100%;
  background: url('../assets/person.jpg') no-repeat center center;
  background-size: cover;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: 110px; 
  box-sizing: border-box;
}


.background-container h1 {
  margin: 20px 0;
  color: black; 
}


.background-container button {
  padding: 10px 20px;
  font-size: 16px;
  color: white;
  background-color: #05aa2e; 
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.background-container button:hover {
  background-color: #0fd301; 
}


.new-block {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 100%;
  background-color: #f0f0f0; 
}


.new-block h2 {
  margin: 20px 0;
  font-size: 24px;
  color: #333; 
  text-align: center;
}


.image-row {
  display: flex;
  justify-content: center;
  gap: 200px; 
  margin: 20px 0;
}


.image-container {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.image-row img {
  width: 100px; 
  height: 100px; 
  object-fit: cover;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
}

.image-container p {
  margin-top: 10px;
  font-size: 20px;
  font-weight: bold;
  color: #333; 
  text-align: center;
}
</style>

