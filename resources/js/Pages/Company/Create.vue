<script setup>

import {Head, router} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {reactive} from "vue";

defineProps({ errors: Object })

const form = reactive({
    'name': null,
    'address': null
})

function submit() {
    router.post('/companies',form)
}

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
                            autofocus
                        />
                        <div v-if="errors.name" class="text-red-500 mt-2">{{ errors.name }}</div>

                    </div>

                    <div class="mt-4">
                        <InputLabel for="address" value="Address" />

                        <TextInput
                            id="address"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.address"
                            required
                        />
                        <div v-if="errors.address" class="text-red-500 mt-2">{{ errors.address }}</div>

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
