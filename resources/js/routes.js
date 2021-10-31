import { createRouter, createWebHistory } from "vue-router";
import Home from './components/Home.vue';

const base = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
      path: "/:pathMatch(.*)*",
      name: "NotFound",
      component: Home,
    },
];

const routes = [
    ...base
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;