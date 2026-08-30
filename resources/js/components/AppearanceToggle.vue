<script setup lang="ts">
import { Laptop, Moon, Sun } from '@lucide/vue';
import { useAppearance } from '@/composables/useAppearance';

const { appearance, updateAppearance } = useAppearance();

const tabs = [
    { value: 'system', Icon: Laptop, label: 'System theme' },
    { value: 'light', Icon: Sun, label: 'Light theme' },
    { value: 'dark', Icon: Moon, label: 'Dark theme' },
] as const;
</script>

<template>
    <div
        class="inline-flex items-center rounded-full border border-neutral-200/80 bg-neutral-100/80 p-1 dark:border-neutral-800 dark:bg-neutral-950/40"
    >
        <button
            v-for="{ value, Icon, label } in tabs"
            :key="value"
            type="button"
            :title="label"
            :aria-label="label"
            @click="updateAppearance(value)"
            :class="[
                'flex h-8 w-8 items-center justify-center rounded-full transition-all duration-150',
                appearance === value
                    ? 'bg-white text-neutral-900 shadow-xs dark:bg-neutral-800 dark:text-neutral-100'
                    : 'text-neutral-500 hover:text-neutral-900 dark:text-neutral-400 dark:hover:text-neutral-100',
            ]"
        >
            <component :is="Icon" class="h-4 w-4" />
        </button>
    </div>
</template>
