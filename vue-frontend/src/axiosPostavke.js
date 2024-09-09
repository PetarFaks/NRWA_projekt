import axios from 'axios';
import store from '/store'; 

const apiClient = axios.create({
  baseURL: 'http://localhost:8000/api',
  withCredentials: true, 
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  },
});

apiClient.interceptors.request.use(config => {
  const token = localStorage.getItem('token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
    console.log(token)
  }
  return config;
}, error => {
  return Promise.reject(error);
});

apiClient.interceptors.response.use(response => {
  return response;
}, error => {
  if (error.response && error.response.status === 401) {
    store.dispatch('logout');
  }
  return Promise.reject(error);
});

export default apiClient;
