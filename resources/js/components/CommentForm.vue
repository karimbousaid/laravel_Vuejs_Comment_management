<template>
    <form @submit.prevent="SaveComment">
           <div>
               <p v-if="respondTo">
                Replay Comment :<span class="badge badge-danger">{{ respondTo.name }}</span>
                <button @click="$emit('cancel-respond-to')"  type="button" class="badge badge-warning"><i class="fa fa-close"></i>Cancel</button>

                </p>
           </div>
           <div class="form-group">
               <input type="text" class="form-control" :class="{ 'border border-danger': errors.name }" v-model="form.name" placeholder="Psudo...">
               <p class="text-danger" v-if="errors.name" v-text="errors.name[0]"></p>
            </div>
           <div class="form-group">
                <textarea class="form-control" :class="{ 'border border-danger': errors.body }"  rows="3" cols="40" v-model="form.body" placeholder="Comment..."></textarea>
                <p class="text-danger" v-if="errors.body" v-text="errors.body[0]"></p>
            </div>
            <div class="form-group">
                <button type="submit" class="form-control">Commenté</button>
            </div>
    </form>
    
</template>

<script>
export default {
    props: ['respondTo'],
    data() {
        return {
            form: {
                name: '',
                url: window.location.href,
                body: '',
            },
            errors: {},
        }
    },
    computed: {
        fullForm() {
            if(this.respondTo)
            {
                return {
                    ...this.form,
                    respond_to_id:this.respondTo.id
                }
            }
            else return this.form
        }
    },
    methods: {
        SaveComment() {
            axios.post('/comments', this.fullForm )
            .then(response => {
             this.$emit('newComment', response.data)
             this.form.name='',
             this.form.body='',
             this.errors=[]
            })
            .catch(error => {
                this.errors=error.response.data.errors;
            })
        },
    },
}
</script>