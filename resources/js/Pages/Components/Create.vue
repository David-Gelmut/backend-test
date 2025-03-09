<script setup>
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger
} from "@/components/ui/dialog";
import {Input} from "@/components/ui/input";
import {Form, FormControl, FormDescription, FormField, FormItem, FormMessage} from "@/components/ui/form";
import {Button} from "@/components/ui/button";
import {router} from "@inertiajs/vue3";
import {Toaster} from '@/components/ui/toast'
import {useToast} from '@/components/ui/toast/use-toast'
const {toast} = useToast();
const props = defineProps({companies: Object, errors: Object})

const title = {
    503: 'Сервис недоступен',
    500: 'Ошибка сервера',
    404: 'Не найдено',
    403: 'Запрещено',
    200: 'Успешно'
}

const description = {
    503: 'Извините, мы проводим техническое обслуживание. Пожалуйста, попробуйте позже.',
    500: 'Упс, что-то пошло не так на наших серверах.',
    404: 'Контрагенты с даанным ИНН не найдены.',
    403: 'К сожалению, доступ запрещен.',
    200: 'Контрагенты успешно добавлены.'
}

function onSubmit(values) {
    router.post('/companies', {
        inn: values.inn
    }, {
        onSuccess: (data) => {
            if (data.props.error) {
                toast({
                    title:   title[data.props.error],
                    description: description[data.props.error],
                    variant: 'destructive'
                })
            }
            if (data.props.success) {
                toast({
                    title: title[data.props.success],
                    description: description[data.props.success],
                    variant: data.props.success === 200 ? 'success' : 'default'
                })
            }
        }
    })
}

</script>
<template>
    <Toaster/>
    <Form v-slot="{ handleSubmit }">
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
                                <Input :class="{'border-red-400':errors.inn}" type="number" placeholder="ИНН"
                                       v-bind="componentField"/>
                            </FormControl>
                            <span class="text-red-500" v-if="errors.inn">{{ errors.inn }}</span>
                            <FormDescription>
                                После нажатия на кнопку Добавить, данные автоматически подгрузятся в таблицу
                            </FormDescription>
                            <FormMessage/>
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
</template>


