<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

// Map role IDs to role names
const roleNames: Record<number, string> = {
	1: 'Super Admin',
	2: 'Admin',
	3: 'User',
}

const props = defineProps<{
	user: {
		id: number
		name: string
		email: string
		role: number | null
		slug: string
	}, 
	from: 'index' | 'archived'
}>()

const breadcrumbs: BreadcrumbItem[] = [
	{ title: 'Dashboard', href: route('dashboard') },
	{ title: 'Users', href: route('users.index') },
	{ title: 'Details', href: '#' },
]

import type { PageProps } from '@inertiajs/core'

interface CustomPageProps extends PageProps {
	props: {
		from?: 'index' | 'archived'
	}
}

const page = usePage<CustomPageProps>()
const pageFrom = computed(() => page.props.from ?? 'index')
</script>

<template>
	<AppLayout title="User Details" :breadcrumbs="breadcrumbs">
		<Head title="User Details" />

		<div class="px-4 sm:px-6 lg:px-8 py-4 sm:py-6 lg:py-8 space-y-6">
			<h1 class="text-3xl font-bold text-gray-900 dark:text-white">User Details</h1>

			<div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 space-y-2">
				<p><strong>Name:</strong> {{ user.name }}</p>
				<p><strong>Email:</strong> {{ user.email }}</p>
				<p><strong>Role:</strong> {{ roleNames[user.role ?? 0] ?? '—' }}</p>
			</div>

			<div class="flex space-x-4">
				<Link 
                    :href="(props.from ?? pageFrom) === 'archived' ? route('users.archived') : route('users.index')" 
                    class="text-sm text-muted-foreground"
                >
                    Back
                </Link>
			</div>
		</div>
	</AppLayout>
</template>
