<script setup>

import {Head, router} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {reactive} from "vue";
import DeleteForm from "@/Components/DeleteForm.vue";

const { model } = defineProps({ model: Object })

const form = reactive({
    'name': model.company.name,
    'address': model.company.address
})

</script>

<template>
    <Head title="Companies"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Companies</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="name" value="Name" />

                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autofocus
							disabled
                        />

                    </div>

                    <div class="mt-4">
                        <InputLabel for="address" value="Address" />

                        <TextInput
                            id="address"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.address"
                            required
							disabled
                        />

                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <DeleteForm></DeleteForm>
                    </div>
                </form>
            </div>

        </div>
    </AuthenticatedLayout>

</template>
