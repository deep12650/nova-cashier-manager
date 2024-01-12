import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import ResourceTool from './components/ResourceTool.vue';
import UserDetails from './components/UserDetails.vue';

const app = createApp({});

// Create a router instance
const router = createRouter({
    history: createWebHistory(),
    routes: [],
});

app.component('cashier-tool', ResourceTool);

// Install the router as a plugin
app.use(router);

// Add the route to the router
router.addRoute({
    name: 'cashier-tool-user',
    path: '/cashier-tool/user/:userId',
    component: UserDetails,
    props: true,
});

app.mount('#app'); // Assuming you have an element with id 'app' in your HTML
