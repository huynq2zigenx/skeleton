<script setup>
import { router } from "@inertiajs/vue3";
import { computed, ref } from "vue";

const props = defineProps({
  routeName: {
	type: String,
	required: true,
  },
});

const isModalOpen = ref(false);

function toggleModal() {
  isModalOpen.value = !isModalOpen.value;
}

const classes = computed(() => 
  isModalOpen.value ? 'modal-open' : ''
);

function submit() {
  router.delete(props.routeName);
}
</script>

<template>
  <div class="btn btn-error" @click="toggleModal">Delete</div>
  <dialog class="modal" :class="classes">
	<div class="modal-box">
	  <h3 class="font-bold text-lg">Confirm Delete!</h3>
	  <p class="py-4">Are you sure you want to delete?</p>
	  <div class="modal-action">
		<form method="dialog">
		  <button type="button" class="btn mx-2" @click="toggleModal">Close</button>
		  <button type="button" class="btn btn-error" @click="submit">Delete</button>
		</form>
	  </div>
	</div>
  </dialog>
</template>
