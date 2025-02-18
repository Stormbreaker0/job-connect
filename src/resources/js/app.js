import './bootstrap';
import { createApp } from 'vue';


const app = createApp({});

import FormComponent from './components/FormComponent.vue';
import Navbar from './components/Navbar.vue';

app.component('form-component', FormComponent);
app.component('navbar', Navbar);


app.mount('#app');
