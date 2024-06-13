<script setup>
defineProps({
	total: {
		type: Number,
		default: 1,	
	},
	model: {
		type: Object,
		default: {},	
	}
});
</script>

<template>
   <div class="join hidden sm:block">
		<a v-if="model.prev_page_url" :href="model.prev_page_url" class="join-item btn mr-1 disabled:opacity-50 disabled:cursor-not-allowed bg-white">
			Previous
		</a>
		<template v-for="n in total" :key="n">
			<a :href="`${model.path}?page=${n}`" class="rounded-md">
				<span class="join-item btn bg-white" :class="model.current_page === n ? 'bg-blue-500 text-white' : ''">{{ n }}</span>
			</a>
		</template>
		<a v-if="model.current_page < total" :href="`${model.path}?page=${model.current_page + 1}`" class="join-item btn mr-1 disabled:opacity-50 disabled:cursor-not-allowed bg-white">
			Next
		</a>
	</div>
	<div class="join grid grid-cols-2 sm:hidden ml-1">
		<a v-if="model.prev_page_url" :href="model.prev_page_url" class="join-item btn btn-outline disabled:opacity-50 disabled:cursor-not-allowed">
			Previous page
		</a>
		<a v-if="model.current_page < total" :href="`${model.path}?page=${model.current_page + 1}`" class="join-item btn btn-outline disabled:opacity-50 disabled:cursor-not-allowed">
			Next page
		</a>
	</div>
</template>
