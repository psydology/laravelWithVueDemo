<template>
    <div class="container">
        <div class="invoices">
            <div class="card__header">
                <div>
                    <h2 class="invoice__title">Invoices</h2>
                </div>
                <div>
                    <a class="btn btn-secondary" @click="newInvoice"> New Invoice </a>
                </div>
            </div>

            <div class="table card__content">
                <div class="table--filter">
                    <span class="table--filter--collapseBtn">
                        <i class="fas fa-ellipsis-h"></i>
                    </span>
                    <div class="table--filter--listWrapper">
                        <ul class="table--filter--list">
                            <li>
                                <p
                                    class="table--filter--link table--filter--link--active"
                                >
                                    All
                                </p>
                            </li>
                            <li>
                                <p class="table--filter--link">Paid</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="table--search">
                    <div class="table--search--wrapper">
                        <select class="table--search--select" name="" id="">
                            <option value="">Filter</option>
                        </select>
                    </div>
                    <div class="relative">
                        <i class="table--search--input--icon fas fa-search"></i>
                        <input
                            class="table--search--input"
                            type="text"
                            placeholder="Search invoice"
                            v-model="search"
                            @keyup="searchinvoice()"
                        />
                    </div>
                </div>

                <div class="table--heading">
                    <p>ID</p>
                    <p>Date</p>
                    <p>Number</p>
                    <p>Customer</p>
                    <p>Due Date</p>
                    <p>Total</p>
                </div>

                <!-- item 1 -->
                <div class="table--items" v-for="inv in invoices" :key="inv.id" v-if="invoices.length > 0">
                    <a href="#" @click="invoiceShow(inv.id)">{{ inv.id }}</a>
                    <p>{{ inv.date }}</p>
                    <p>{{ inv.number }}</p>
                    <p v-if="inv.customers != null">{{ inv.customers.firstname }}</p>
                    <p>{{ inv.due_date }}</p>
                    <p>{{ inv.total }} $</p>
                </div>
                <div class="table--item" v-else>
                    <p>No Data Found</p>
                </div>
            </div>
        </div>
    </div>
    <br /><br /><br />
</template>

<script setup>
    import axios from 'axios';
    import { onMounted , ref} from 'vue';
    import { useRouter } from "vue-router";

    const router = useRouter();
    let invoices = ref([]);
    let search = ref([]);
    onMounted(async() => {
        getInvoices();
    });
    const getInvoices = async()=>{
        let response = await axios.get('/api/allinvoices');
        invoices.value = response.data.invoice
    }

    const searchinvoice = async() =>
    {
        let response = await axios.get('/api/search?s='+search.value)
        invoices.value = response.data.invoice
    }

    const newInvoice = async() =>
    {
        let form = await axios.get('/api/create')
        console.log(form.data)
        router.push('/invoice/new');
    }

    const invoiceShow = (id) =>
    {
        router.push('/invoice/show/' + id)
    }
</script>
