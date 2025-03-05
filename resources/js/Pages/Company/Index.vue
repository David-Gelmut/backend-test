<script setup>
import Layout from "@/Pages/Layout.vue";
import Pagination from "@/Pages/Components/Pagination.vue";
import Create from "@/Pages/Components/Create.vue";
import SearchForm from "@/Pages/Components/SearchForm.vue";
defineProps({ companies: Object, errors: Object })
</script>
<template >
    <Layout>
        <div v-if = "companies.total > 0" class=" flex flex-col items-center gap-3">
            <div  class="w-3/5 m-auto p-2">
                <div class="flex justify-between">
                    <h1 class="font-black text-2xl pb-3">Добавленные контрагенты</h1>
                    <Create :errors="errors" :companies="companies" />
                </div>
                <div class="pb-4 bg-white dark:bg-gray-900">
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <SearchForm :errors="errors"/>
                    </div>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ИНН
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Наименование
                            </th>
                            <th scope="col" class="px-6 py-3">
                                ОГРН
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Адрес
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr :key="company.id" v-for="company in companies.data" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{company.inn}}
                            </th>
                            <td class="px-6 py-4">
                                {{company.name}}
                            </td>
                            <td class="px-6 py-4">
                                {{company.ogrn}}
                            </td>
                            <td class="px-6 py-4">
                                {{company.address}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div>
                <Pagination :items="companies"/>
            </div>
        </div>
        <div v-else  class="flex flex-col justify-between items-center  m-auto p-2 mt-[20%]">
            <div class="flex flex-col items-center gap-2">
                <div  class="font-black text-2xl">
                    Контрагенты ещё не добавлены
                </div>
                <div>
                     Добавьте первого контрагента
                </div>
                <div>
                    <Create :errors="errors" :companies="companies" />
                </div>
        </div>
    </div>
    </Layout>
</template>
