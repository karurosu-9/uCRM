<script setup>
import { getToday } from "@/common";
import { onMounted, reactive, ref, computed } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    customers: Object,
    items: Object,
});

onMounted(() => {
    form.date = getToday(); // 画面表示と同時に本日の日時を日時のフォームに表示させる
    props.items.forEach((item) => {
        itemList.value.push({
            id: item.id,
            name: item.name,
            price: item.price,
            quantity: 0,
        });
    });
});

const itemList = ref([]); // 空の配列

const form = reactive({
    date: null,
    customer_id: null,
    status: true,
    items: [],
});

const totalPrice = computed(() => {
    let total = 0;
    itemList.value.forEach((item) => {
        total += item.price * item.quantity;
    });

    return total;
});

const quantity = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
</script>

<template>
    日付<br />
    <input type="date" name="date" v-model="form.date" /><br />
    <br />
    会員名<br />
    <select name="customer" v-model="form.customer_id">
        <option
            v-for="customer in customers"
            :value="customer.id"
            :key="customer.id"
        >
            {{ customer.id }}：{{ customer.name }}
        </option></select
    ><br />
    <br />
    商品<br />
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>商品名</th>
                <th>金額</th>
                <th>数量</th>
                <th>小計</th>
            </tr>
        </thead>
        <tr v-for="item in itemList">
            <td>{{ item.id }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.price }}</td>
            <td>
                <select name="quantity" v-model="item.quantity">
                    <option v-for="q in quantity" :value="q">
                        {{ q }}
                    </option>
                </select>
            </td>
            <td>
                {{ item.price * item.quantity }}
            </td>
        </tr>
    </table>
    <br />
    合計：{{ totalPrice }} 円<br />
    <button>登録する</button>
</template>
