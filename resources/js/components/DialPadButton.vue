<template>
    <button type="button" class="btn btn-dark col-3 d-flex flex-column justify-content-start align-items-center">
        <div class="digit">{{ digit }}</div>
        <div class="characters">{{ characters }}</div>
    </button>
</template>

<script setup>
    const props = defineProps([
        'digit',
        'characters'
    ])
</script>

<style lang="sass" scoped>
button .digit
    font-size: 2rem
    line-height: 2rem
    font-weight: 700

button .characters
    color: #aaa
    line-height: 1.2rem
</style>