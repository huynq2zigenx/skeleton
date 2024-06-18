<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import { computed, reactive, ref } from "vue";
import InputLabel from "@/Components/InputLabel.vue";

const props = defineProps({
  	list: {
		type: Array,
		required: true,
	},
	groupName: {
		type: String,
		required: true,
	}
});

const emit = defineEmits(['chosseItemsCheckbox', 'clickSearch']);
const isModalOpen = ref(false);

function toggleModal() {
  isModalOpen.value = !isModalOpen.value;
}

function closeModal() {
  isModalOpen.value = false;
}

const updateChecked = (checked, checkboxItem) => {
	if(checked) {
		checkboxItem.checked = true;
		emit('chosseItemsCheckbox', props.list.filter((item) => item.checked == true));
	} else {
		checkboxItem.checked = false;
		emit('chosseItemsCheckbox', props.list.filter((item) => item.checked == true));
	}
};
const handleClickSearch = () => {
	emit('clickSearch');
	closeModal();
}
const classes = computed(() => 
  isModalOpen.value ? 'modal-open' : ''
);

const displayedList = reactive(props.list)

</script>

<template>
	<div class="p-[2px] max-w-[150px] text-end text-wrap border-[#f7931e] border rounded relative" @click="toggleModal">Add condition</div>
	<dialog class="modal" :class="classes">
		<div class="modal-box absolute w-[300px] smail-scrollbar" style="transform: translateX(-80px);">
			<div class="flex-col justify-between">
				<div class="flex justify-between items-center min-w-full p-2" v-for="item in displayedList">
					<InputLabel :for="`${groupName}_${item.id}`" :value="item.name"></InputLabel>
					<Checkbox :value="item.id" :id="`${groupName}_${item.id}`" :checked="item.checked" @update:checked="updateChecked($event, item)"></Checkbox>
				</div>
			</div>
			<div class="p-[8px] hover:bg-[#f7931e] w-ful text-center text-wrap bg-[#f7931e] border rounded cursor-pointer mt-4 sticky bottom-0" @click="handleClickSearch">Search</div>
		</div>
	</dialog>
</template>
<style>
.smail-scrollbar {
	scrollbar-width: none;
}
</style>