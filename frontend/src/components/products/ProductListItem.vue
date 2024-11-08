<template>
	<div class="col-md-4 mb-2">
		<div class="card h-100">
			<img :src="product.image" alt="Product Image" class="card-img-top">
			<div class="card-body">
				<p class="card-title">{{ product.name }} {{product.id}}</p>
				<p class="card-text">
					{{ product.description }}
				</p>	
				<p>
					<span class="fw-bold text-danger">
						$ {{ product.price }}
					</span>
				</p>
				<router-link  :to="`product/${product.id}`" class="nav-link" ><i class="bi bi-eye"></i> View </router-link>

			</div>
		</div>
	</div> 
</template>
,;<script setup>

	const props = defineProps ({
		product: {
			type : Object,
			required: true
		} 
	})

</script>
<style></style>