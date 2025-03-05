<script setup>
import Layout from '../Layout.vue'
import { Button } from "@/components/ui/button"
import {
    FormControl,
    FormField,
    FormItem,
    FormLabel,
    FormMessage,
} from '@/components/ui/form'
import { Input } from '@/components/ui/input'
import { router, usePage } from '@inertiajs/vue3'
import { useForm } from 'vee-validate'
const page = usePage()
const form = useForm()

const onSubmit = form.handleSubmit((values) => {
    console.log('Form submitted!', values)
    router.post('/login', {
         _token: page.props.csrf_token,
         email: values.email,
         password: values.password
    },)
})

defineProps({  errors: Object })
</script>
<template>
    <Layout>
        <div class="w-[25%] m-auto flex flex-col justify-center p-6 shadow-2xl rounded-md mt-20">
            <h1 class="font-black text-2xl pb-3">Вход в аккаунт</h1>

<!--                <form v-on:submit.prevent="onSubmit">-->
                <form @submit.prevent="onSubmit">
                    <FormField name="email"  v-slot="{ componentField }">
                        <FormItem>
                            <FormLabel>Email</FormLabel>
                            <FormControl>
                                <Input :class="{'border-red-400':errors.email}" type="text" placeholder="example@example.ru" v-bind="componentField" />
                            </FormControl>
                            <span class="text-red-500" v-if="errors.email">{{errors.email}}</span>
                        </FormItem>
                    </FormField>
                    <FormField name="password"  v-slot="{ componentField }">
                        <FormItem>
                            <FormLabel>Пароль</FormLabel>
                            <FormControl>
                                <Input :class="{'border-red-400':errors.password}" type="password"  v-bind="componentField" />
                            </FormControl>
                            <span class="text-red-500" v-if="errors.password">{{errors.password}}</span>
                        </FormItem>
                    </FormField>
                    <Button type="submit" class="w-full rounded-md mt-4"  variant="table">
                        Войти
                    </Button>
                </form>

            <div class="m-auto text-sm">
                Нет аккаунта?
                <a href="/register">
                    <Button  variant="link">
                        Зарегистрироваться
                    </Button>
                </a>
            </div>
        </div>
    </Layout>
</template>



