<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <h5>{{ $t('common.emptyPage') }}</h5>
                <p>Use this page to start from scratch and place your custom content.</p>
            </div>
            <PickList v-model="products" listStyle="height:342px" dataKey="id" breakpoint="1400px">
                <template #sourceheader> Available </template>
                <template #targetheader> Selected </template>
                <template #item="slotProps">
                    <div class="flex flex-wrap p-2 align-items-center gap-3">
                        <img class="w-4rem shadow-2 flex-shrink-0 border-round" :src="'https://primefaces.org/cdn/primevue/images/product/' + slotProps.item.image" :alt="slotProps.item.name" />
                        <div class="flex-1 flex flex-column gap-2">
                            <span class="font-bold">{{ slotProps.item.name }}</span>
                            <div class="flex align-items-center gap-2">
                                <i class="pi pi-tag text-sm"></i>
                                <span>{{ slotProps.item.category }}</span>
                            </div>
                        </div>
                        <span class="font-bold text-900">$ {{ slotProps.item.price }}</span>
                    </div>
                </template>
            </PickList>
        </div>
    </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import Calendar from 'primevue/calendar';
import PickList from 'primevue/picklist';
import {ProductService} from "@/Pages/ProductService";

export default {
    props: {
        date: Array
    },
    data() {
        return {
            products: null
        }
    },
    mounted() {
        ProductService.getProductsSmall().then((data) => (this.products = [data, []]));
    },
    components: {
        Calendar,
        PickList
    },

    layout: AppLayout
};
</script>
