<script setup>
const props = defineProps({
	total: {
		type: Number,
		default: 1,	
	},
	model: {
		type: Object,
		default: {},	
	},
	classes: {
		type: String,
		default: '',
	},
	queryString: {
		type: Object,
		default: null,
	}
});

const convertQueryParamsToString = (queryString) => {
	const queryStringParts = [];
	for (const [key, value] of Object.entries(queryString)) {
		const match = key.match(/^page$/);
		if(match) continue;

		if (Array.isArray(value) && value.length > 1) {
			for (const item of value) {
				queryStringParts.push(`${key}[]=${item}`);
			}
		} else {
			queryStringParts.push(`${key}=${value[0]}`);
		}
	}
	return queryStringParts.join('&');
}

const withQueryString = props.queryString != null ? convertQueryParamsToString(props.queryString) : '';

</script>

<template>
   <div class="join hidden sm:block" :class="classes">
		<a :class="model.current_page == 1 ? 'pointer-events-none': ''" :href="`${model.path}?page=${model.current_page - 1}&${withQueryString}`" class="join-item btn mr-1 disabled:opacity-50 bg-white">
			Previous
		</a>
		<template v-for="n in total" :key="n">
			<a :href="`${model.path}?page=${n}&${withQueryString}`" class="rounded-md">
				<span class="join-item btn" :class="model.current_page == n ? 'bg-blue-500 text-white' : 'bg-white'">{{ n }}</span>
			</a>
		</template>
		<a :class="model.current_page == total ? 'pointer-events-none': ''" :href="`${model.path}?page=${model.current_page + 1}&${withQueryString}`" class="join-item btn mr-1 disabled:opacity-50 bg-white">
			Next
		</a>
	</div>
	<div class="join grid grid-cols-2 sm:hidden ml-1" :class="classes">
		<a :class="model.current_page == 1 ? 'pointer-events-none hover:bg-gray-300 bg-gray-300': ''" :href="`${model.path}?page=${model.current_page - 1}&${withQueryString}`" class="join-item btn bg-white">
			Previous page
		</a>
		<a  :class="model.current_page == total ? 'pointer-events-none hover:bg-gray-300 bg-gray-300': ''" :href="`${model.path}?page=${model.current_page + 1}&${withQueryString}`" class="join-item btn bg-white">
			Next page
		</a>
	</div>
</template>
