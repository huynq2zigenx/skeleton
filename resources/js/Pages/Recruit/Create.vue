<script setup>

import {Head, router} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {reactive} from "vue";

const { model } = defineProps({ model: Object })
const form = reactive({
    'title': null,
    'description': null,
	'start_date': null,
	'end_date': null,
	'company_id': 1,
})

function submit() {
    router.post('/recruits',form)
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
                            required
                            autofocus
                        />

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

					<div class="mt-4">
                        <InputLabel for="end_date" value="End date" />

                        <TextInput
                            id="end_date"
                            type="date"
                            class="mt-1 block w-full"
                            v-model="form.end_date"
                            required
                        />

                    </div>
					<div class="mt-4">
                        <InputLabel for="company" value="Comapny" />
						<select class="select select-bordered w-full max-w-xs mt-1 block w-full" id="company" v-model="company_id">
							<option v-for="(company, key) in model.companies" :value="company.id">
								{{company.name}}
							</option>
						</select>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton class="ms-4"  type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Create
                        </PrimaryButton>
                    </div>
                </form>
            </div>

        </div>
    </AuthenticatedLayout>

</template>
