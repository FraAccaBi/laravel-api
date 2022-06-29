<template>
    <div>
        <div class="d-flex justify-content-center py-4">
            <nav aria-label="Page navigation">
          <ul class="pagination">
            <li class="page-item" v-if="postsResponse.current_page > 1">
              <a class="page-link" href="#" aria-label="Previous"
              @click.prevent="getAllPosts(postsResponse.current_page - 1)">
                <span aria-hidden="true">&laquo;</span>
                <span class="visually-hidden">Previous</span>
              </a>
            </li>
            <li :class="{'page-item' : true,  'active': page == postsResponse.current_page }"
            v-for="page in postsResponse.last_page" :key="page">
                <a class="page-link" href="#"
                @click.prevent="getAllPosts(page)">
                   {{page}}
                </a>
            </li>

            <li class="page-item" v-if="postsResponse.current_page < postsResponse.last_page">
              <a class="page-link" href="#" aria-label="Next"
              @click.prevent="getAllPosts(postsResponse.current_page + 1)">
                <span aria-hidden="true">&raquo;</span>
                <span class="visually-hidden">Next</span>
              </a>
            </li>
          </ul>
        </nav>
        </div>
        <section class="post">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                    <div class="col" v-for="post in postsResponse.data" :key="post.id">
                        <div class="product card">
                            <img width="100%" :src="post.cover_img" alt="">
                            <div class="card-body">
                                <h3>{{post.title}}</h3>
                                <p>{{post.content}} </p>
                            </div>
                            <div class="card-footer">
                                <span v-if="post.category">
                                    <strong>Category: </strong> {{post.category.name}}
                                </span>
                                <div v-if="post.tags.length > 0">
                                    <ul>
                                        <li v-for="tag in post.tags" :key="tag.id">
                                            {{tag.name}}
                                        </li>
                                    </ul>
                                </div>
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

                postsResponse: ''
            }
        },
        methods:{
            getAllPosts(postPage){
                console.log(postPage);
                axios
                .get('/api/posts', {
                    params: {
                        page: postPage
                    }
                })
                .then((response) => {
                    console.log(response);
                    this.postsResponse = response.data
                    console.log(this.postsResponse.current_page);
                })
                .catch(e => {
                    console.error(e);
                })
            }
        },
        mounted() {
            console.log('mounted');
            this.getAllPosts(1);
        }
    }
</script>
