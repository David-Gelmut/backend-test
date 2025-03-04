<script setup>
import Layout from '../Layout.vue'
import { Head } from '@inertiajs/vue3'
</script>
<template>
    <Head :title="title" />
    <Layout>
        <div>{{title}}</div>
    </Layout>
</template>
<script>
export default {
    props:{
        title:String
    }
}
</script>
