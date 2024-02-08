import {createRouter , createWebHistory} from "vue-router";
import invoiceindex from '../components/invoices/index.vue';
import newinvoice from '../components/invoices/new.vue';
import showinvoice from '../components/invoices/invShow.vue';
import notfound from '../components/NotFound.vue';

const routes = [

    {
        path : '/',
        component : invoiceindex

    },
    {
        path : '/invoice/new',
        component : newinvoice

    },
    {
        path : '/invoice/show/:id',
        component : showinvoice,
        props : true

    },
    {
        path : '/:pathMatch(.*)*',
        component : notfound
    }
]
const router = createRouter({
    history : createWebHistory(),
    routes
})

export default router
