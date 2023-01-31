import ListAllCompanies from './vuejs/ListAllCompanies.vue';
import ListAllProvidersByCompany from "./vuejs/ListAllProvidersByCompany";
import CreateCompany from "./vuejs/CreateCompany";
import CreateProvidersByCompany from "./vuejs/CreateProviderByCompany";
import ListAllProviders from "./vuejs/ListAllProviders";
import PathNotFound from "./vuejs/PathNotFound";
import { createRouter, createWebHistory } from 'vue-router'
const routes = [
    {
        name: 'listProviders',
        path: '/',
        component: ListAllProviders,
        props: true
    },
    {
        name: 'listCompanies',
        path: '/companies',
        component: ListAllCompanies,
        props: true
    },
    {
        name: 'company-new',
        path: '/company',
        component: CreateCompany,
        props: true
    },
    {
        name: 'company-providers',
        path: '/company/:idcompany/providers',
        component: ListAllProvidersByCompany,
        props: true
    },
    {
        name: 'company-new-providers',
        path: '/providers',
        component: CreateProvidersByCompany,
        props: true
    },
    { path: '/:pathMatch(.*)*', component: PathNotFound },
];

export default createRouter({
    history: createWebHistory(),
    routes,
    linkActiveClass:'active'
})
