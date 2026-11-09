<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

type PaginationLink = { url: string | null; label: string; active: boolean };

const props = defineProps<{
    meta: { links: PaginationLink[]; current_page: number; last_page: number };
}>();

// Laravel puts « Previous / Next » first and last; the rest are page numbers and "..." gaps.
const previous = computed(() => props.meta.links[0]);
const next = computed(() => props.meta.links[props.meta.links.length - 1]);
const pages = computed(() => props.meta.links.slice(1, -1));

const baseClass =
    'min-h-9.5 min-w-9.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-foreground hover:bg-muted-hover focus:outline-hidden focus:bg-muted-focus';
const disabledClass = 'opacity-50 pointer-events-none';
</script>

<template>
    <!-- Pagination -->
    <nav v-if="meta.last_page > 1" class="flex items-center gap-x-1" aria-label="Pagination">
        <component :is="previous.url ? Link : 'span'" :href="previous.url ?? undefined" preserve-scroll
            :class="[baseClass, 'py-2 px-2.5', !previous.url && disabledClass]" aria-label="Previous">
            <svg aria-hidden="true" class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="m15 18-6-6 6-6" />
            </svg>
            <span>Previous</span>
        </component>

        <div class="flex items-center gap-x-1">
            <template v-for="(link, index) in pages" :key="index">
                <Link v-if="link.url" :href="link.url" preserve-scroll
                    :class="[baseClass, 'py-2 px-3', link.active && 'bg-muted font-semibold']"
                    :aria-current="link.active ? 'page' : undefined">
                    {{ link.label }}
                </Link>
                <span v-else :class="[baseClass, 'py-2 px-3', disabledClass]">{{ link.label }}</span>
            </template>
        </div>

        <component :is="next.url ? Link : 'span'" :href="next.url ?? undefined" preserve-scroll
            :class="[baseClass, 'py-2 px-2.5', !next.url && disabledClass]" aria-label="Next">
            <span>Next</span>
            <svg aria-hidden="true" class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="m9 18 6-6-6-6" />
            </svg>
        </component>
    </nav>
    <!-- End Pagination -->
</template>
