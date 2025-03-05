<script setup>
import { Button } from '@/components/ui/button'
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog'
import {
    Form,
    FormControl,
    FormDescription,
    FormField,
    FormItem,
    FormLabel,
    FormMessage,
} from '@/components/ui/form'
import { Input } from '@/components/ui/input'
import Layout from "@/Pages/Layout.vue";
import Pagination from "@/Pages/Components/Pagination.vue";
import { router, usePage  } from '@inertiajs/vue3'
import { useForm } from 'vee-validate'
const page = usePage()
const form = useForm()
function onSubmit(values) {
    return router.post('/companies', {
        _token: page.props.csrf_token,
        inn: values.inn
    })
}

const searchSubmit = form.handleSubmit((values) => {
    router.get('/search', {
        _token: page.props.csrf_token,
        search: values.search,
    })
})

defineProps({ companies: Object, errors: Object })
</script>
<template >
    <Layout>
        <div v-if = "companies.total > 0" class=" flex flex-col items-center gap-3">
            <div  class="w-3/5 m-auto p-2">
                <div class="flex justify-between">
                    <h1 class="font-black text-2xl pb-3">Добавленные контрагенты</h1>
                    <Form v-slot="{ handleSubmit }" >
                        <Dialog>
                            <DialogTrigger as-child>
                                <Button variant="table">
                                    Добавить
                                </Button>
                            </DialogTrigger>
                            <DialogContent class="sm:max-w-[425px]">
                                <DialogHeader>
                                    <DialogTitle>Добавление контрагента</DialogTitle>
                                    <DialogDescription>
                                        Введите ИНН, чтобы добавить контрагента.
                                    </DialogDescription>
                                </DialogHeader>
                                <form id="dialogForm" @submit="handleSubmit($event, onSubmit)">
                                    <FormField v-slot="{ componentField }" name="inn">
                                        <FormItem>
                                            <FormControl>
                                                <Input  :class="{'border-red-400':errors.inn}" type="number" placeholder="ИНН" v-bind="componentField" />
                                            </FormControl>
                                            <span class="text-red-500" v-if="errors.inn">{{errors.inn}}</span>
                                            <FormDescription>
                                                После нажатия на кнопку Добавить, данные автоматически подгрузятся в таблицу
                                            </FormDescription>
                                            <FormMessage />
                                        </FormItem>
                                    </FormField>
                                </form>

                                <DialogFooter>
                                    <Button type="submit" form="dialogForm" variant="table">
                                        Добавить
                                    </Button>
                                </DialogFooter>
                            </DialogContent>
                        </Dialog>
                    </Form>
                </div>
                <div class="pb-4 bg-white dark:bg-gray-900">
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <form @submit.prevent="searchSubmit">
                            <FormField v-slot="{ componentField }" name="search">
                                <input v-bind="componentField" type="text" id="table-search" class="w-full block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-sm bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Поиск по ИНН / наименованию">
                                <span class="text-red-500" v-if="errors.search">{{errors.search}}</span>
                            </FormField>
                        </form>
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
                    <Form v-slot="{ handleSubmit }">
                        <Dialog>
                            <DialogTrigger as-child>
                                <Button class="" variant="table">
                                    Добавить
                                </Button>
                            </DialogTrigger>
                            <DialogContent class="sm:max-w-[425px]">
                                <DialogHeader>
                                    <DialogTitle>Добавление контрагента</DialogTitle>
                                    <DialogDescription>
                                        Введите ИНН, чтобы добавить контрагента.
                                    </DialogDescription>
                                </DialogHeader>
                                <form id="dialogForm" @submit="handleSubmit($event, onSubmit)">
                                    <FormField v-slot="{ componentField }" name="inn">
                                        <FormItem>
                                            <FormControl>
                                                <Input :class="{'border-red-400':errors.inn}" type="text" placeholder="ИНН" v-bind="componentField" />
                                            </FormControl>
                                            <span class="text-red-500" v-if="errors.inn">{{errors.inn}}</span>
                                            <FormDescription>
                                                После нажатия на кнопку Добавить, данные автоматически подгрузятся в таблицу
                                            </FormDescription>
                                            <FormMessage />
                                        </FormItem>
                                    </FormField>
                                </form>
                                <DialogFooter>
                                    <Button type="submit" form="dialogForm" variant="table">
                                        Добавить
                                    </Button>
                                </DialogFooter>
                            </DialogContent>
                        </Dialog>
                    </Form>
                </div>
        </div>
    </div>
    </Layout>
</template>
