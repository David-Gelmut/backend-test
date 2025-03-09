<script setup>
import Layout from "@/Pages/Errors/Layout.vue";
const props =  defineProps({status: Number})
const title = {
    503: 'Сервис недоступен',
    500: 'Ошибка сервера',
    404: '404: Страница не найдена',
    403: 'Запрещено'
}
const description = {
    503: 'Извините, мы проводим техническое обслуживание. Пожалуйста, попробуйте позже.',
    500: 'Упс, что-то пошло не так на наших серверах.',
    404: 'К сожалению, не удалось найти страницу, которую Вы ищете.',
    403: 'К сожалению, доступ запрещен.'
}
</script>
<template>
    <Layout>
        <div class="flex flex-col justify-between items-center  m-auto p-2 mt-[20%]">
            <div class="flex flex-col items-center gap-2">
                <div class="font-black text-2xl">
                    {{ title[props.status] }}
                </div>
                <div class="font-medium text-orange-600 dark:text-orange-300 hover:underline">{{ description[props.status] }}</div>
                <!--                <a href="/companies" class="font-medium text-orange-600 dark:text-orange-300 hover:underline"> Вернуться на страницу с контрагентами</a>-->
            </div>
        </div>
    </Layout>
</template>
