<script setup>
import { Link } from '@inertiajs/vue3'
</script>
<template>
    <main>
        <header>
            <nav>
                <li><Link href="/login">Login</Link></li>
                <li><Link href="/register">Register</Link></li>
            </nav>
        </header>
        <div class="container mx-auto">
            <slot/>
        </div>
    </main>
</template>
