<template>
    <footer class="footer">
      <div class="footer-section">
        <p>Petar Bošnjak</p>
        <p>Jure Sabljo</p>
      </div>
      <div class="footer-section">
        <p>AdventureWorksDB</p>
        <p>Projekt @ NRWA</p>
      </div>
      <div class="footer-section">
        <p>Kontakt: </p>
        <p>063-998-312</p>
      </div>
    </footer>
  </template>
  
  <script>
  export default {
    name: 'FooterComponent',
  };
  </script>
  
  <style scoped>
.footer {
  width: 100%;
  background-color: #333;
  color: white;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
  box-sizing: border-box;
}

.footer-section {
  display: flex;
  flex-direction: column;
}

.footer-section p {
  margin: 5px 0;
}
</style>
  