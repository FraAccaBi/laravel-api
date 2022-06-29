<template>
    <div class="container">
        <section class="post">

        </section>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                posts: ''
            }
        },
        mounted() {
            axios
                .get('/api/posts')
                .then((response) => {
                    console.log(response);
                })
        }
    }
</script>
