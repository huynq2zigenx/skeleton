<script setup>

import {Head, useForm} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
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
    'title': props.model.recruit.title,
    'description': props.model.recruit.description,
	'start_date': props.model.recruit.start_date,
	'end_date': props.model.recruit.end_date,
	'company_id': props.model.recruit.company.id
})

function submit() {
	form.put(route('recruits.update', props.model.recruit.id))
}

</script>

<template>
    <Head title="Recruits"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Recruits</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="title" value="Title" />

                        <TextInput
                            id="title"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.title"
                            autofocus
                        />

                        <div v-if="errors.title" class="text-red-500 mt-2">{{ errors.title }}</div>
                    </div>

                    <div class="mt-4">
                        <InputLabel for="description" value="Description" />

                        <TextInput
                            id="description"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.description"
                            required
                        />

                        <div v-if="errors.description" class="text-red-500 mt-2">{{ errors.description }}</div>
                    </div>
					<div class="mt-4">
                        <InputLabel for="start_date" value="Start date" />

                        <TextInput
                            id="start_date"
                            type="date"
                            class="mt-1 block w-full"
                            v-model="form.start_date"
                            required
                        />

                    </div>

                    <div v-if="errors.start_date" class="text-red-500 mt-2">{{ errors.start_date }}</div>
					<div class="mt-4">
                        <InputLabel for="end_date" value="End date" />

                        <TextInput
                            id="end_date"
                            type="date"
                            class="mt-1 block w-full"
                            v-model="form.end_date"
                            required
                        />

                    	<div v-if="errors.end_date" class="text-red-500 mt-2">{{ errors.end_date }}</div>
                    </div>
					<div class="mt-4">
                        <InputLabel for="company" value="Comapny" />
						<select class="select select-bordered w-full max-w-xs mt-1 block w-full" id="company" v-model="form.company_id">
							<option v-for="(company, key) in model.companies" :value="company.id" :selected="company.id == form.company_id">
								{{company.name}}
							</option>
						</select>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton class="ms-4"  type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Save
                        </PrimaryButton>
                    </div>
                </form>
            </div>

        </div>
    </AuthenticatedLayout>

</template>
