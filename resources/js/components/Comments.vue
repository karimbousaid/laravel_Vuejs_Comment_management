<template>

    <div class="container">
                <div v-if="loader">
                    <loader></loader>
                </div>
                <div class="card my-2" v-for="comment in comments" :key="comment.id">
                    <comment 
                        :comment="comment" 
                        :now="now"
                        @respond-to="respondTo = $event"
                    ></comment>
                </div>
                <div v-if="nextPage">
                   <button class="font-weight-light" @click="fetchComments(nextPage)">Chargé {{ this.total_comments - this.comments.length }} 
                       next comments.....</button>
                </div>
                <hr>
                <comment-form
                @newComment="NewComment" 
                :respond-to="respondTo"
                @cancel-respond-to="respondTo = null"
                ></comment-form>
    </div> 
</template>

<script>

import { formatDistance } from 'date-fns'
import CommentForm from './CommentForm.vue'
import Comment from './Comment.vue'
import loader from './loader.vue'


export default {

    components: { CommentForm,Comment,loader },
    data() {
        return {
            comments: [],
            respondTo: null,
            now:new Date(),
            nextPage:null,
            total_comments:0,
            loader:true
        }
    },
    mounted() {
        setInterval(() => {
		 this.now=new Date();
        }, 1000),
        
        this.fetchComments('/comments/' + btoa(window.location.href))
    },
    methods: {
        fetchComments(url) {
            axios.get(url)
            .then(({ data: pagination }) => {
                console.log(pagination)
                this.loader=false
                this.comments=this.comments.concat(pagination.data)
                this.nextPage=pagination.next_page_url,
                this.total_comments=pagination.total
            })
        },

        NewComment(comment) {
            if(this.respondTo==null)
            {
               this.comments.push(comment)
               return
            }

            this.respondTo.children.push(comment)
        }
    },
}
</script>