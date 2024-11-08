<template>
	<ProductList :products="data.products" />
</template>
<script setup>

import axios from "axios"
import { onMounted, reactive } from "vue"
import ProductList from "./products/ProductList.vue"


	const data = reactive({
		products: []
	})

const fetchAllProducts =async () => {
	try {
		const response = await axios.get('http://127.0.0.1:8001/api/products')
		data.products = response.data.data
		console.log(response.data.data)
	} catch (error) {
		console.log(error)
	}
}	

onMounted(() => fetchAllProducts())

</script>
<style></style>