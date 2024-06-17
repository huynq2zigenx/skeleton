<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, Link} from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";

const { model } = defineProps({ model: Object })

function getTotalPage() {
	return Math.ceil(model.total / model.entries.per_page)
}
</script>

<template>
    <Head title="Entries" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Entries</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="flex justify-between">
					<Pagination :total="getTotalPage()" :model="model.entries"></Pagination>
				</div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <!-- head -->
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone</th>
								<th>Email</th>
								<th>Company</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- row 1 -->
                            <tr v-for="entry in model.entries.data">
                                <th>{{entry.id}}</th>
                                <th>{{entry.first_name}}</th>
                                <td>{{entry.last_name}}</td>
                                <td>{{entry.phone}}</td>
                                <td>{{entry.email}}</td>
                                <td>{{entry.company.name}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
