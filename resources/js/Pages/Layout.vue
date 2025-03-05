<script setup>
import {Button} from "@/components/ui/button/index.js";
</script>
<template>
    <main>
        <header>
            <nav class="bg-white border-gray-200 dark:bg-gray-900">
                <div class="flex flex-wrap mx-auto gap-3 p-4">
                    <div  v-if= "$page.props.user == null"  class="flex flex-wrap mx-auto gap-3 p-4">
                        <a href="/login"><Button class="w-full rounded-md mt-4"  variant="outline">Войти</Button></a>
                        <a href="/register"><Button  class="w-full rounded-md mt-4"  variant="table">Зарегистрироваться</Button></a>
                    </div>
                    <div  v-if= "$page.props.user !== null"  class="flex flex-wrap mx-auto gap-3 p-4">
                        <a href="/logout"><Button class="w-full rounded-md mt-4"  variant="table">Выйти</Button></a>
                    </div>
                </div>
            </nav>
        </header>
        <div class="container mx-auto">
            <slot/>
        </div>
    </main>
</template>
