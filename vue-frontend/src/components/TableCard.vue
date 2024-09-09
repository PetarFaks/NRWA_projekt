<template>
    <div class="table-card" @click="$emit('click')">
      <h3>{{ title }}</h3>
      <p>Broj redaka: {{ count }}</p>
    </div>
  </template>
  
  <script>
  export default {
    name: 'TableCard',
    props: {
      title: {
        type: String,
        required: true,
      },
      count: {
        type: Number,
        required: true,
      },
    },
  };
  </script>
  
  <style scoped>
  .table-card {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    width: 200px;
    text-align: center;
  }
  
  .table-card:hover {
    background-color: #e9e9e9;
  }
  </style>
  