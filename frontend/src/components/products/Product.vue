<template>
	<div class="row my-5" v-if="data.product">
		<div class="col-md-10 mx-auto">
			<div class="card mb-3">
				<div class="row g-0">
					<div class="col-md-4">
						<img :src="data.product.image" alt="Product Image" class="img-fluid rounded-start">
					</div>
					<div class="col-md-4 row">
						<div class="card-title m-2">
							{{ data.product.name }}
						</div>
						<div class="card-body m-2">
							{{ data.product.description }}
						</div>
						<div class="text-body-secondary m-2">
							${{ data.product.price }}
						</div>
						<div class="text-body-secondary mb-4" v-if="data.product.reviews.length">
								<StarRating
							v-model:rating="reviewAvg"
							read-only
							:star-size="24"
							/>
						</div>
					</div>
					
				</div>
			</div>
			<div v-if="data.product.reviews.length">
				<ReviewsList 
					:reviews="data.product.reviews" 
					@editReviewEvent = "editReview"
					@removeReviewEvent="deleteReview"
				/>
			</div>
			<div class="my-3">
				<div class="card">
					<div clas="card-header bg-white text-center">
						<h5 class="mt-2" v-if="!data.reviewToUpdate.updating">Add a review</h5>
						<h5 class="mt-2" v-else>Edit review</h5>

					</div>
					<div class="card-body">
						<AddReview 
							:product="data.product"
							@reviewAdded = "setProduct"
							v-if="!data.reviewToUpdate.updating"
							/>
						<UpdateReview 
							:reviewToUpdate="data.reviewToUpdate.data"
							:product="data.product"
							@cancelUpdating="cancelUpdating"
							@reviewUpdated="setProduct"
							v-else/>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script setup>
	
	import { useRoute } from "vue-router"
	import { onMounted, reactive, computed } from "vue"
	import axios from "axios"
	import AddReview from '../reviews/AddReview.vue'
	import StarRating from 'vue-star-rating'
	import ReviewsList from '../reviews/ReviewsList.vue'
	import UpdateReview from '../reviews/UpdateReview.vue'
	import { useToast } from 'vue-toastification'

	const route = useRoute()

	const toast = useToast()

	const data = reactive({
		product : null,
		reviewToUpdate: {
			updating: false,
			data: null
		}
	})



	const fetchProductById = async () => {
		try {
			const response = await axios.get(`http://127.0.0.1:8001/api/product/${route.params.id}/show`)
			data.product = response.data.data
		} catch (error) {
			console.log(error)
		}
	}

	const setProduct = (newProductData) => {
		data.product = newProductData
		if(data.reviewToUpdate.updating) {
			data.reviewToUpdate = {
				updating: false,
				data: null
			}
		}
	}

	const editReview = (review) => {
		data.reviewToUpdate = {
			updating: true,
			data: review
		}
	}
	
	const cancelUpdating = () => {
		if (data.reviewToUpdate.updating) {
			data.reviewToUpdate = {
				updating: false,
				data: null
			}
		}
	}


	const deleteReview = async (review_id) => {
		try {
			const response = await axios.post(`http://127.0.0.1:8001/api/review/${route.params.id}/delete`, {
				review_id
			});

			data.product = response.data.data

			toast.success('Review has been deleted successfully!', {
				timeout: 2000
			})

		} catch (error) {
			console.log(error)
		}
	}


	const reviewAvg = computed( () => parseInt(data.product.reviews.reduce((acc, review) => acc + review.rating / data.product.reviews.length, 0).toFixed(1)) )


	onMounted(() => fetchProductById()) 
</script>

<style></style>