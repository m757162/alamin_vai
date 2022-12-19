<template>
  <div class="">
    

     <!-- Content Row -->
    <div class="row">

        <!-- Chatting -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <h3>People</h3>                
                    
                </div><!--End card body-->
            </div><!--End card-->
        </div><!--End Col-->

        <div class="col-xl-8 col-md-8 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body" style="height: 400px;">

                    <div class="messaging_area overflow-auto">
                        <div class="message_history" v-for="message in messages" :key="message.id">

                            <div v-if="message.type == 'employee'" class="incoming_msg_box ">
                                <div  class="incoming_message w-75">
                                    <small class="time d-flex justify-content-center">{{ message.created_at }}</small>
                                    <small v-if="message.employee != null">{{ message.employee.name }}</small>

                                    <div class="d-flex align-items-center bg-light py-2 px-2 rounded-pill">
                                        <img v-if="message.employee != null" v-bind:src="message.employee.avatar" width="5%" height="5%" class="mr-2 rounded-circle" alt="">
                                        <p class="m-0">{{ message.message }}</p>
                                    </div>
                                    
                                </div><!--End outgoing message-->
                            </div>
                            

                            <div v-if="message.type == 'client'" class="outgoing_msg_box d-flex justify-content-end">
                                <div  class="outgoing_message w-75">
                                    <small class="time d-flex justify-content-center"><span>{{ message.created_at }}</span></small>

                                    <small v-if="message.client != null">{{ message.client.name }}</small>

                                    <div class="d-flex align-items-center primary-bg-color text-white py-2 px-2 rounded-pill">
                                        <img v-if="message.client != null" v-bind:src="message.client.image" width="5%" height="5%" class="mr-2 rounded-circle" alt="">
                                        <p class="m-0">{{ message.message }}</p>
                                    </div>
                                    
                                </div><!--End incoming message-->
                            </div>


                        </div><!--End message history-->                        

                    </div><!--End messaging_area-->

                    <div class="message d-flex align-items-end my-2">
                        <div class="input-group">
                            <input type="text" v-model="message" @keyup.enter="sendMessage"  class="form-control" placeholder="Message" aria-label="Message" aria-describedby="message-send-btn">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" @click="sendMessage" type="button" id="message-send-btn">Send</button>
                            </div>
                        </div>
                    </div><!--End message-->
                
                    
                </div><!--End card body-->
            </div><!--End card-->
        </div><!--End Col-->

    </div><!--End row-->

    <!-- Content Row -->

    
       
  </div>
</template>

<script>
import moment from 'moment'
export default {
    name: 'Chat',
    data() {
        return {
            sender_id: '1',
            message: '',
            baseUrl: 'http://127.0.0.1:8000',
            messages: [],
        }
    },
    updated() {
       //Scroll Always Bottom
       this.$nextTick(() => this.scrollToEnd());
   },
    mounted(){       

        this.fetchMessage()
    },
 
    methods: {
        sendMessage () {
            axios.post(this.baseUrl+'/clients/send-message', {
                type: 'client',
                message: this.message,
                sender_id: this.sender_id
            }).then((res) => {
                console.log(res)
            })
        },

        fetchMessage () {
            axios.get(this.baseUrl+'/clients/messages').then((res) => {
                this.messages = res.data                
            })
        },

        scrollToEnd: function () {
            const container = this.$el.querySelector(
                ".messaging_area"
            )
            container.scrollTop = container.scrollHeight
        },
        

    },
    created() {
        Echo.channel('chat')
        .subscribed(() => {
            console.log('Subscribed Client')
        })
        .listen('ChatEvent', (e) => {
       
            // var audio = 'http://127.0.0.1:8000/audio/mixkit-positive-notification-951.wav';
            // sound.setAttribute('src', audio)
            // sound.play();
            console.log('From App js broadcasting')
            this.fetchMessage() 
            this.message = ''
        })
    },
}
</script>

<style scoped>
   .messaging_area{
        height: 90%;
   }
</style>