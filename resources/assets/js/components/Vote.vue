<template>
<div>
    <form>
        <button @click.prevent="upvote"
                class="btn btn-default">+1</button>
        Puntuación actual: <strong id="current-score">5</strong>
        <button @click.prevent="downvote"
                class="btn btn-default">11</button>
    </form>
</div>

</template>

<script>
export default {
    methods: {
        upvote() {
            alert(window.location.href + '/upvote')
            axios.post(window.location.href + '/upvote')
        },
        downvote() {
            
        }
    }
}
</script>

