<script setup>
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import { ref } from 'vue';

const search = ref('')
const customers = ref({})

const isShow = ref(false)
const toggleStatus = () => {
    isShow.value = !isShow.value
}

const searchCustomers = async () => {
    try {
        await axios.get('/api/search-customers', {
            // params:で?search=${search.value}の変わりをしている
            params: {
                search: search.value
            }
        })
            .then(res => {
                console.log(res.data);
                customers.value = res.data;
            })
        toggleStatus();
    } catch (e) {
        console.log(e);
    }
}

// 「update:customerId」というイベントを親(今回はPruchase/Create.vue)で使用できるように宣言をしている
const emit = defineEmits(['update:customerId']);

const setCustomer = selectedCustomer => { // selected は { id: 66, kana: 'ヤマダタロウ' }
    search.value = selectedCustomer.kana
    emit('update:customerId', selectedCustomer.id) // emit('update:customerId', 引数)は親側で「@update:customerId="親のメソッド名"」としていれば、親で設定した”親のメソッド名”が呼ばれる
    toggleStatus()
}

</script>


<template>
    <div v-show="isShow" class="modal" id="modal-1" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
            <div class="modal__container w-2/3" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
                <header class="modal__header">
                    <h2 class="modal__title" id="modal-1-title">
                        顧客検索
                    </h2>
                    <button @click="toggleStatus" type="button" class="modal__close" aria-label="Close modal" data-micromodal-close></button>
                </header>
                <main class="modal__content" id="modal-1-content">
                    <div v-if="customers.data" class="lg:w-2/3 w-full mx-auto overflow-auto">
                        <table class="table-auto w-full text-left whitespace-nowrap">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">ID</th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">氏名</th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">カナ</th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">電話番号</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="customer in customers.data" :key="customer.id">
                                    <td class="border-b-2 border-gray-200 px-4 py-3">
                                        <button @click="setCustomer({id: customer.id, kana: customer.kana})" type="button" class="text-blue-400">
                                            {{ customer.id }}
                                        </button>
                                    </td>
                                    <td class="px-4 py-3">{{ customer.name }}</td>
                                    <td class="px-4 py-3">{{ customer.kana }}</td>
                                    <td class="px-4 py-3">{{ customer.tel }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </main>
                <footer class="modal__footer">
                    <button  @click="toggleStatus"type="button" class="modal__btn" data-micromodal-close aria-label="Close this dialog window">閉じる</button>
                </footer>
            </div>
        </div>
    </div>
    <input name="customer" v-model="search" class="bg-gray-100 bg-opacity-50 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
    <button @click="searchCustomers" type="button" data-micromodal-trigger="modal-1" class="ml-4 text-white bg-teal-500 border-0 py-2 px-8 focus:outline-none hover:bg-teal-600 rounded text-lg">検索する</button><br>
</template>
