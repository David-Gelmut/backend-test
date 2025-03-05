<script setup>
import {Dialog,DialogContent,DialogDescription,DialogFooter, DialogHeader,DialogTitle,DialogTrigger} from "@/components/ui/dialog";
import {Input} from "@/components/ui/input";
import {Form, FormControl, FormDescription, FormField, FormItem, FormMessage} from "@/components/ui/form";
import {Button} from "@/components/ui/button";
import {router} from "@inertiajs/vue3";
import { Toaster } from '@/components/ui/toast'
import { useToast } from '@/components/ui/toast/use-toast'
import {h} from "vue";
const { toast } = useToast()
function onSubmit(values) {
    router.post('/companies', {
        inn: values.inn
    },{
        onSuccess: () => {
            toast({
                title: 'Котрагент с ИНН ' + values.inn + ' успешно создан',
                variant: 'success'
            })
        }
    })
}
defineProps({ companies: Object, errors: Object })
</script>
<template>
    <Toaster />
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
</template>


