<template>
    <div class="card w-100 mt-2">
        <div class="card-body">
            {{ title }}
        </div>
    </div>
</template>

<script>
    export default {
        name: 'state',
        props: ['title'],
    }
</script>