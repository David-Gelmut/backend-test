<script setup>
import Layout from '../Layout.vue'
import { Button } from "@/components/ui/button"
import {
    FormControl,
    FormDescription,
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
    router.post('/register', {
        _token: page.props.csrf_token,
        email: values.email,
        name: values.name,
        password_confirmation: values.password_confirmation,
        password: values.password
    })
})

defineProps({  errors: Object })
</script>
<template>
    <Layout>
        <div class="w-[25%] m-auto flex flex-col justify-center p-6 shadow-2xl rounded-md mt-20">
            <h1 class="font-black text-2xl pb-3">Регистрация</h1>
            <form  @submit.prevent="onSubmit">
                <FormField name="name" v-slot="{ componentField }" :validate-on-blur="!isFieldDirty">
                    <FormItem>
                        <FormLabel>Имя</FormLabel>
                        <FormControl>
                            <Input :class="{'border-red-400':errors.name}" type="text" placeholder="Иванов Иван" v-bind="componentField" />
                        </FormControl>
                        <span class="text-red-500" v-if="errors.name">{{errors.name}}</span>
                    </FormItem>
                </FormField>
                <FormField name="email" v-slot="{ componentField }" :validate-on-blur="!isFieldDirty">
                    <FormItem>
                        <FormLabel>Email</FormLabel>
                        <FormControl>
                            <Input :class="{'border-red-400':errors.email}" type="text" placeholder="example@example.ru" v-bind="componentField" />
                        </FormControl>
                        <span class="text-red-500" v-if="errors.email">{{errors.email}}</span>
                    </FormItem>
                </FormField>
                <FormField name="password"  v-slot="{ componentField }" :validate-on-blur="!isFieldDirty">
                    <FormItem>
                        <FormLabel>Пароль</FormLabel>
                        <FormControl>
                            <Input :class="{'border-red-400':errors.password}" type="password"  v-bind="componentField" />
                        </FormControl>
                        <span class="text-red-500" v-if="errors.password">{{errors.password}}</span>
                    </FormItem>
                </FormField>
                <FormField  name="password_confirmation" v-slot="{ componentField }" :validate-on-blur="!isFieldDirty">
                    <FormItem>
                        <FormLabel>Подтвердите пароль</FormLabel>
                        <FormControl>
                            <Input :class="{'border-red-400':errors.password_confirmation}" type="password"  v-bind="componentField" />
                        </FormControl>
                        <span class="text-red-500" v-if="errors.password_confirmation">{{errors.password_confirmation}}</span>
                    </FormItem>
                </FormField>
                <Button type="submit" class="w-full rounded-md mt-4"  variant="table">
                    Создать аккаунт
                </Button>
            </form>
            <div class="m-auto text-sm">
                Уже есть аккаунт?
                <a href="/login">
                    <Button variant="link">
                        Войти
                    </Button>
                </a>
            </div>
        </div>
    </Layout>
</template>

