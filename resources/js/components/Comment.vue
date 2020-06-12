<template>
<div>
                <div class="card-body my-3">
                    <span class="badge badge-secondary my3">{{ comment.name }} | {{ diffForHumains }}</span><br>

                    <div class="form-group" v-if="edit">
                        <textarea class="form-control" v-model="Newbody"  rows="3" cols="40"></textarea>
                    </div>

                    <span v-else>{{comment.body}} </span>
                    <br>
                   
                   <div v-if="edit">
                        <button @click="cancel"  type="button" class="btn btn-danger btn-sm"><i class="fa fa-close" style="margin-right:5px;"></i>Annuler</button>
                        <button @click="updateComment"  type="button" class="btn btn-primary btn-sm"><i class="fa fa-save" style="margin-right:5px;"></i>Save</button>
                   </div>

                   <div v-else>
                        <button @click="$emit('respond-to', comment)"  type="button" class="btn btn-success btn-sm"><i class="fa fa-reply" style="margin-right:5px;"></i>Replay</button>
                        <button @click="edit = true"  type="button" class="btn btn-dark btn-sm"><i class="fa fa-edit" style="margin-right:5px;"></i>Edit</button>
                   </div>

                   
                    <div class="card my-3" v-for="child in comment.children" :key="child.id">
                        <div class="card-body">
                            <comment 
                                
                                :comment="child" 
                                :now="now"
                                @respond-to="$emit('respond-to', child)"
                            ></comment>
                        </div>
                    </div>
                </div>
     
</div>
    
    
</template>
<script>
import { formatDistance } from 'date-fns'

export default {
    name:'comment',
    props: ['comment','now'],

    data() {
        return {
            edit:false,
            Newbody:this.comment.body,
        }
    },

    computed: {
       diffForHumains() {
           return formatDistance(new Date(this.comment.created_at), this.now)
       }
    },

    methods: {
        format(date) {
         return formatDistance(new Date(date), this.now)
        },
        cancel() {
            this.edit=false,
            this.Newbody=this.comment.body
        },
        updateComment() {
           this.comment.body=this.Newbody,
           this.edit=false
        }
    },
}
</script>