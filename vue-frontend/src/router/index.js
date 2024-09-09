import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/HomePage.vue';
import Products from '../views/ProductsPage.vue';

import Login from '../views/LoginPage.vue';
import Register from '../views/RegistracijaPage.vue';
import GoogleCallback from '../views/GoogleCallback.vue';
import Profil from '../views/ProfilPage.vue';
import Admin from '../views/admin/AdminPage.vue';
import AdminProduct from '../views/admin/AdminProduct.vue';
import ProductEditPage from '../views/admin/ProductEditPage.vue'
import AdminAddresses from '../views/admin/AdminAddresses.vue';
import AddressesEditPage from '../views/admin/AddressesEditPage.vue'
import AdminUsers from '../views/admin/AdminUsers.vue';
import AdminSalesOrder from '../views/admin/AdminSalesOrder.vue';
const routes = [
  { path: '/', name: 'Home', component: Home },
  { path: '/products', name: 'Products', component: Products },
  { path: '/login', name: 'Login', component: Login, meta: { requiresAuth: false } },
  { path: '/register', name: 'Register', component: Register, meta: { requiresAuth: false } },
  {
    path: '/products/:id',
    name: 'ProductDetail',
    component: () => import('../views/ProductPage.vue')
  },
  {
    path: '/forgot-password',
    name: 'ForgotPassword',
    component: () => import('../views/ForgotPasswordPage.vue')
  },
  {
    path: '/reset-password',
    name: 'ResetPassword',
    component: () => import('../views/ResetPasswordPage.vue')
  },
  { path: '/google-callback', name: 'GoogleCallback', component: GoogleCallback },
  { path: '/profil', name: 'Profil', component: Profil },
  { path: '/admin', name: 'Admin', component: Admin },
  { path: '/admin/products', name: 'AdminProduct', component: AdminProduct },
  {
    path: '/admin/products/:id',
    name: 'ProductEdit',
    component: ProductEditPage,  
  },
  { path: '/admin/addresses', name: 'AdminAddresses', component: AdminAddresses },
  {
    path: '/admin/addresses/:id',
    name: 'AddressesEdit',
    component: AddressesEditPage,  
  },
  { path: '/admin/users', name: 'AdminUsers', component: AdminUsers },
  { path: '/admin/sales-order-details', name: 'AdminSalesOrder', component: AdminSalesOrder },
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

router.beforeEach((to, from, next) => {
  const loggedIn = localStorage.getItem('token');
  if (to.matched.some(record => record.meta.requiresAuth) && !loggedIn) {
    next({ name: 'Login' });
  } else {
    next();
  }
});

export default router;
