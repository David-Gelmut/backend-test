<script setup>
import {
    Button,
} from '@/components/ui/button'
import {
    Pagination,
    PaginationFirst,
    PaginationLast,
    PaginationList,
    PaginationListItem,
    PaginationNext,
    PaginationPrev,
} from '@/components/ui/pagination';
defineProps({
    items: Array,
})
</script>
<template>
    <Pagination :items-per-page="10" :total="100" :sibling-count="1" show-edges :default-page="2">
        <PaginationList  class="flex items-center gap-1">
            <a :href="items.first_page_url"><PaginationFirst/></a>
                <a v-if="items.prev_page_url" :href="items.prev_page_url"><PaginationPrev class="w-20" >Назад</PaginationPrev></a>
                    <template v-for="(item, index) in items.links">
                        <PaginationListItem>
                            <a :href="item.url" v-if="index !== 0 && index !== items.links.length - 1">
                                <Button class="w-10 h-10 p-0" :variant="item.active ? 'default' : 'outline'">
                                    {{ Number.isInteger(Number(item.label))?item.label:''}}
                                </Button>
                            </a>
                        </PaginationListItem>
                    </template>
               <a v-if="items.next_page_url" :href="items.next_page_url"><PaginationNext class="w-20">Далее</PaginationNext></a>
            <a :href="items.last_page_url"><PaginationLast/></a>
        </PaginationList>
    </Pagination>
</template>

