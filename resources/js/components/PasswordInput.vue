<template>
       <center>
           <div class="container my-4">
               <div class="input-group">
                <input :type="show ? 'text' : 'password'" class="form-control" placeholder="Password" >
                <div class="input-group-append">
                    <button class="btn btn-success" type="submit" @click="show = !show">
                        <i class="fa fa-eye" v-show="show"></i>
                        <i class="fa fa-eye-slash" v-show="!show"></i>
                    </button>
                </div>
            </div>
           </div>
       </center>
</template>

<script>
export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                show: true,
            }
        },
    }
</script>