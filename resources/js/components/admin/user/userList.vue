<template>
    <div>
        <span> {{ users.email }} </span>
        <span> {{ users.id }} </span>
        <span> {{ test_props.name }} </span>
    </div>

</template>

<script>
export default {
    props: ['users', 'test_props'],
}
</script>
