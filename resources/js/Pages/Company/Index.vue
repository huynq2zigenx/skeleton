<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, Link} from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";
import DangerButton from "@/Components/DangerButton.vue";

const { model } = defineProps({ model: Object })

function getTotalPage() {
	return Math.ceil(model.total / model.companies.per_page)
}
</script>

<template>
    <Head title="Companies" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Companies</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="flex justify-between">
					<Pagination :total="getTotalPage()" :path="model.companies.path" :curentPage="model.companies.current_page"></Pagination>
					<Link href="/companies/create" method="get" as="button" type="button" class="btn btn-primary mb-2">Create</Link>
				</div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <!-- head -->
                            <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Owner</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- row 1 -->
                            <tr v-for="company in model.companies.data">
                                <th>{{ company.id }}</th>
                                <td>{{ company.name }}</td>
                                <td>{{ company.address }}</td>
                                <td>{{ company.user.name }}</td>
                                <td>
                                    <Link :href="`/companies/${company.id}/edit`" class="btn btn-primary">Edit</Link>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
