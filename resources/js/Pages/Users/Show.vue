<template>
	<Head :title="user.name" />

	<AuthenticatedLayout>
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ user.name }}</h2>
		</template>

		<div class="py-12">
			<div class="text-center mb-4">
				<SecondaryButton v-on:click="loadComments">Load Comments</SecondaryButton>
			</div>
			<div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-4">
				<div v-for="post in posts" :key="post.id">
					<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
						<div class="p-6 text-gray-900 space-y-3">
							<h2 class="font-semibold">
								{{ post.user.name }}
							</h2>
							<div>{{ post.body }}</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</AuthenticatedLayout>
</template>

<script setup>
import SecondaryButton from '@/Components/SecondaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';

const props = defineProps({
	user: Object,
	posts: Array
})

const loadComments = () => {
	router.get(route('users.show', props.user), {}, {
		only: ['posts']
	})
}
</script>
