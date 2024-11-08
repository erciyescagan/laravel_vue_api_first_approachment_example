<template>
	<div>
		Home
	</div>
</template>
<script setup>

const data = reactive({
	products : []
})

const fetchAllProducts =async () => {
	try {
		const response = await axios.get('localhost:8001/api/products')
		data.products = response.data.data
	} catch (error) {
		console.log(error)
	}
}

</script>
<style></style>