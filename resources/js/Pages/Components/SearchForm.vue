<script setup>
import {
    Form,
    FormField,
} from '@/components/ui/form'
import { Input } from '@/components/ui/input'
import {router} from "@inertiajs/vue3";
import {useForm} from "vee-validate";
const form = useForm()
const searchSubmit = form.handleSubmit((values) => {
    router.get('/search', {
        search: values.search,
    })
})
defineProps({ companies: Object, errors: Object })
</script>
<template>
    <form @submit.prevent="searchSubmit">
        <FormField v-slot="{ componentField }" name="search">
            <input v-bind="componentField" type="text" id="table-search" class="w-full block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-sm bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Поиск по ИНН / наименованию">
            <span class="text-red-500" v-if="errors.search">{{errors.search}}</span>
        </FormField>
    </form>
</template>

