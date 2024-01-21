<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router, useForm, Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

defineProps({
	posts: Array,
});

const form = useForm({
	body: "",
});

const createPost = () => {
	form.post("/comments", {
		preserveScroll: true,

		onSuccess: () => {
			form.reset();
		},
	});
};

const refreshComments = () => {
	router.get('/comments', {}, {
		preserveScroll: true,

		only: ['posts']
	});

}
</script>

<template>
	<Head title="Comments">
		<meta name="description" content="Comments Index" />
	</Head>

	<AuthenticatedLayout>
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				Comments
			</h2>
		</template>

		<div class="py-12">
			<div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-4">
				<form v-on:submit.prevent="createPost" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
					<label for="body" class="sr-only">Body</label>
					<textarea v-model="form.body" v-on:focus="form.clearErrors('body')" name="body"
						class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
						id="body" cols="30" rows="5"></textarea>
					<InputError :message="form.errors.body" />
					<PrimaryButton type="submit" class="mt-4" :disabled="form.processing"
						:class="{ 'opacity-50': form.processing }">
						Post
					</PrimaryButton>
				</form>

				<div class="grid place-items-center">
					<SecondaryButton v-on:click="refreshComments">Refresh Comments</SecondaryButton>
				</div>

				<div v-for="post in posts" :key="post.id">
					<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
						<div class="p-6 text-gray-900 space-y-3">
							<h2 class="font-semibold">
								<Link :href="`/users/${post.user.id}`">{{ post.user.name }}</Link>
							</h2>
							<div>{{ post.body }}</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</AuthenticatedLayout>
</template>
