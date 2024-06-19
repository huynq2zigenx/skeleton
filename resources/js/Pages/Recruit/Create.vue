<script setup>

import {Head, useForm} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Checkbox from "@/Components/Checkbox.vue";

const props = defineProps({
    model: {
        required: true,
        type: Object
    },
    errors: Object
})
const updateChecked = (checked, checkboxItem) => {
	if(checked) {
		form.shokushu_items.push(checkboxItem)
		checkboxItem.checked = true;
	} else {
		form.shokushu_items = form.shokushu_items.filter(item => item.id != checkboxItem.id)
		checkboxItem.checked = false;
	}
};
const form = useForm({
    'title': null,
    'description': null,
	'start_date': null,
	'end_date': null,
	'company_id': null,
	'prefecture_id': null,
	'shokushu_items': [],
})

function submit() {
	form.post(route('recruits.store', form))
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
							placeholder="Enter title"
                            required
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
							placeholder="Enter description"
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
                        <div v-if="errors.start_date" class="text-red-500 mt-2">{{ errors.start_date }}</div>
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
                        <div v-if="errors.end_date" class="text-red-500 mt-2">{{ errors.end_date }}</div>
                    </div>
					<div class="grid sm:grid-cols-2 sm:gap-2 grid-cols-1 gap-1">
						<div class="mt-4">
							<InputLabel for="company" value="Comapny" />
							<select class="select select-bordered w-full max-w-xs mt-1 block" id="company" v-model="form.company_id">
								<option v-for="(company, key) in model.companies" :value="company.id">
									{{company.name}}
								</option>
							</select>
						</div>
						<div class="mt-4">
							<InputLabel for="prefecture" value="Prefecture" />
							<select class="select select-bordered w-full max-w-xs mt-1 block" id="prefecture" v-model="form.prefecture_id">
								<option v-for="(prefecture, key) in model.prefectures" :value="prefecture.id">
									{{prefecture.name}}
								</option>
							</select>
						</div>
					</div>
					<div class="mt-4">
						<span>Shokushu items</span>
						<div class="mt-4 grid sm:grid-cols-3 sm:gap-3 md:grid-cols-4 md:gap-4 grid-cols-2 gap-2">
							<div class="flex justify-between items-center min-w-full p-2 bg-white rounded-xl" v-for="item in model.shokushu_items">
								<InputLabel :for="`shokushu_items_${item.id}`" :value="item.name"></InputLabel>
								<Checkbox :value="item.id" :id="`shokushu_items_${item.id}`" :checked="item.checked" @update:checked="updateChecked($event, item)"></Checkbox>
							</div>
						</div>
					</div>
                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton class="ms-4"  type="submit" :class="{ 'opacity-25': form.processing }" >
                            Create
                        </PrimaryButton>
                    </div>
                </form>
            </div>

        </div>
    </AuthenticatedLayout>

</template>
