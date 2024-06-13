<script setup>
defineProps({
	total: {
		type: Number,
		default: 1,	
	},
	curentPage: {
		type: Number,
		default: 1,	
	},
	path: {
		type: String,
		default: '',	
	}
});
</script>

<template>
   <div class="join">
		<button v-for="n in total" class="join-item btn" :class="curentPage == n ? 'btn-active' : ''">
			<a :href="path+'?page='+n">{{ n }}</a>
		</button>
	</div>
</template>
