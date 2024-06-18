<script setup>

import {Head, useForm} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import DeleteForm from "@/Components/DeleteForm.vue";
import Checkbox from "@/Components/Checkbox.vue";
import { reactive } from "vue";

const props = defineProps({
    model: {
        required: true,
        type: Object
    },
    errors: Object
})

const allList = reactive({
	jobTypes: props.model.shokushu_items.map((item) => {
		item.checked = false; 
		if(props.model.recruit.shokushuItems && props.model.recruit.shokushuItems.includes(item.id)) {
			item.checked = true; 
		}
		return item
	}),
});

const form = useForm({
    'title': props.model.recruit.title,
    'description': props.model.recruit.description,
	'start_date': props.model.recruit.start_date,
	'end_date': props.model.recruit.end_date,
	'company_id': props.model.recruit.company.id,
	'prefecture_id': props.model.recruit.prefecture.id,
	'shokushu_items': props.model.recruit.shokushuItems,
})

</script>

<template>
    <Head title="Recruits"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Recruits</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form>
                    <div>
                        <InputLabel for="title" value="Title" />

                        <TextInput
                            id="title"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.title"
                            autofocus
							disabled
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
							disabled
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
							disabled
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
							disabled
                        />

                    	<div v-if="errors.end_date" class="text-red-500 mt-2">{{ errors.end_date }}</div>
                    </div>
					<div class="grid sm:grid-cols-2 sm:gap-2 grid-cols-1 gap-1">
						<div class="mt-4">
							<InputLabel for="company" value="Comapny" />
							<select class="select select-bordered w-full max-w-xs mt-1 block" id="company" v-model="form.company_id">
								<option v-for="(company, key) in model.companies" :value="company.id" :selected="company.id == form.company_id">
									{{company.name}}
								</option>
							</select>
						</div>
						<div class="mt-4">
							<InputLabel for="prefecture" value="Comapny" />
							<select class="select select-bordered w-full max-w-xs mt-1 block" id="prefecture" v-model="form.prefecture_id">
								<option v-for="(prefecture, key) in model.prefectures" :value="prefecture.id" :selected="prefecture.id == form.prefecture_id">
									{{prefecture.name}}
								</option>
							</select>
						</div>
					</div>
					
					<div class="mt-4">
						<span>Shokushu items</span>
						<div class="mt-4 grid sm:grid-cols-3 sm:gap-3 md:grid-cols-4 md:gap-4 grid-cols-2 gap-2">
							<div class="flex justify-between items-center min-w-full p-2 bg-white rounded-xl" v-for="item in allList.jobTypes">
								<InputLabel :for="`shokushu_items_${item.id}`" :value="item.name"></InputLabel>
								<Checkbox :value="item.id" :id="`shokushu_items_${item.id}`" :checked="item.checked" @update:checked="updateChecked($event, item)" disabled></Checkbox>
							</div>
						</div>
					</div>
                    <div class="flex items-center justify-end mt-4">
                        <DeleteForm :routeName="`/recruits/${model.recruit.id}`"></DeleteForm>
                    </div>
                </form>
            </div>

        </div>
    </AuthenticatedLayout>

</template>
