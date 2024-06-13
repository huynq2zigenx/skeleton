<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, Link} from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";

const { model } = defineProps({ model: Object })

function getTotalPage() {
	console.log(model.companies);
	return Math.ceil(model.total / model.recruits.per_page)
}
</script>

<template>
    <Head title="Companies" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Recruits</h2>
        </template>

          <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="flex justify-between">
					<Pagination :total="getTotalPage()" :model="model.recruits"></Pagination>
					<Link href="/recruits/create" method="get" as="button" type="button" class="btn btn-primary mb-2">Create</Link>
				</div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <!-- head -->
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Company</th>
                                <th>Start date</th>
                                <th>End date</th>
								<th colspan="2" class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- row 1 -->
                            <tr v-for="recruit in model.recruits.data">
                                <th>{{recruit.id}}</th>
                                <td>{{recruit.title}}</td>
                                <td>{{recruit.description}}</td>
                                <td>{{recruit.company.name}}</td>
                                <td>{{recruit.start_date}}</td>
                                <td>{{recruit.end_date}}</td>
								<td class="text-center"><Link :href="`${model.recruits.path}/${recruit.id}/edit`" class="btn btn-warning">Edit</Link></td>
								<td class="text-center"><Link :href="`${model.recruits.path}/${recruit.id}`" class="btn btn-info">show</Link></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
