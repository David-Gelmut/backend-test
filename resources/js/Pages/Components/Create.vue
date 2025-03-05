<script setup>
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter, DialogHeader,
    DialogTitle,
    DialogTrigger
} from "@/components/ui/dialog/index.js";
import {Input} from "@/components/ui/input/index.js";
import {Form, FormControl, FormDescription, FormField, FormItem, FormMessage} from "@/components/ui/form/index.js";
import {Button} from "@/components/ui/button/index.js";
import {router} from "@inertiajs/vue3";
function onSubmit(values) {
    return router.post('/companies', {
        inn: values.inn
    })
}
defineProps({ companies: Object, errors: Object })
</script>
<template>
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
</template>


