<script setup>
defineProps({});
</script>
<template>
	<button class="btn" onclick="my_modal_1.showModal()" open>Form delete</button>
	<dialog id="my_modal_1" class="modal">
		<div class="modal-box">
			<h3 class="font-bold text-lg">Comfirm delete!</h3>
			<p class="py-4">Are you sure delete</p>
			<div class="modal-action">
			<form method="dialog">
				<!-- if there is a button in form, it will close the modal -->
				<button class="btn mx-2">Close</button>
				<button class="btn bg-red-600">Delete</button>
			</form>
			</div>
		</div>
	</dialog>
</template>
