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
					<Pagination :total="getTotalPage()" :path="model.entries.path" :curentPage="model.entries.current_page"></Pagination>
					<Link href="/entries/create" method="get" as="button" type="button" class="btn btn-primary mb-2">Create</Link>
				</div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <!-- head -->
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>first_name</th>
                                <th>last_name</th>
                                <th>phone</th>
								<th>email</th>
								<th>company</th>
								<th colspan="2"></th>
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
								<td><Link :href="`${model.entries.path}/${entry.id}/edit`" method="get" as="button" type="button" class="btn mb-2">edit</Link></td>
								<td><a :href="`${model.entries.path}/${entry.id}/show`">delete</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
