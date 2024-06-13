<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    model: {
        required: true,
        type: Object
    },
    errors: Object
})

const form = useForm({
    'first_name': null,
    'last_name': null,
	'phone': null,
	'email': null,
	'company_id': props.model.recruit.company.id,
})

function submit() {
	form.post(route('entry.store'), form)
}

</script>

<template>
    <Head title="Apply entry" />
	<div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 min-w-ful">
		<div class="w-full flex justify-center mt-2">
			<a href="/home" class="w-40 text-center btn leading-5 block p-3 text-3xl text-black">Home</a>
		</div>
		<div
			class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"
		>
			<div class="relative w-full max-w-2xl px-6 lg:max-w-5xl border border-gray-200 shadow-lg rounded-lg">
				<div class="capitalize py-3 mt-2 text-2xl text-black">Form apply</div>
				<main class="my-6">
					<form @submit.prevent="submit">
						<div>
							<InputLabel for="first_name" value="Firt Name" />

							<TextInput
								id="first_name"
								type="text"
								class="mt-1 block w-full"
								v-model="form.first_name"
								placeholder="Enter first name"
								required
								autofocus
							/>
							<div v-if="errors.first_name" class="text-red-500 mt-2">{{ errors.first_name }}</div>
						</div>

						<div class="mt-4">
							<InputLabel for="last_name" value="Last Name" />

							<TextInput
								id="last_name"
								type="text"
								class="mt-1 block w-full"
								v-model="form.last_name"
								placeholder="Enter Last Name"
								required
							/>
							<div v-if="errors.last_name" class="text-red-500 mt-2">{{ errors.last_name }}</div>
						</div>
						<div class="mt-4">
							<InputLabel for="email" value="Email" />

							<TextInput
								id="email"
								type="email"
								class="mt-1 block w-full"
								v-model="form.email"
								placeholder="Enter email"
								required
							/>
							<div v-if="errors.email" class="text-red-500 mt-2">{{ errors.email }}</div>
						</div>

						<div class="mt-4">
							<InputLabel for="phone" value="Phone" />

							<TextInput
								id="phone"
								type="text"
								class="mt-1 block w-full"
								v-model="form.phone"
								placeholder="Enter phone"
								required
							/>
							<div v-if="errors.phone" class="text-red-500 mt-2">{{ errors.phone }}</div>
						</div>
						<div class="flex items-center justify-center mt-4">
							<PrimaryButton class="ms-4"  type="submit" :class="{ 'opacity-25': form.processing }" >
								Apply
							</PrimaryButton>
						</div>
					</form>
				</main>
			</div>
		</div>
	</div>
  
</template>