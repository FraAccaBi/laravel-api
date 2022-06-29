<template>
    <div>
        <section class="post">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                    <div class="col" v-for="post in posts" :key="post.id">
                        <div class="product">
                            <img width="100%" :src="post.cover_img" alt="">
                            <div class="card-body">
                                <h3>{{post.title}}</h3>
                                <p>{{post.content}} </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                    this.posts = response.data.data
                })
                .catch(e => {
                    console.error(e);
                })
        }
    }
</script>
