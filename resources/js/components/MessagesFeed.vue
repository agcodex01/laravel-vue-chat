<template>
  <div class="feed" ref="feed">
      <ul v-if="contact">
          <li v-for="message in messages" :class="`message${message.to == contact.id ? ' sent ' : ' received'}`" :key="message.id">
              <div class="text">
                  {{message.text}}
              </div>
          </li>
      </ul>
  </div>
</template>

<script>
export default {
    props :{
        contact :{
            type : Object,
        },
        messages :{
            type : Array,
            required :true
        }
    },
    methods:{
        scrollToBottom(){
            setTimeout(() =>{
                this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
            },50);
        }
    },
    watch :{
        contact(contact){
            this.scrollToBottom();
        },
        messages(messages){
            this.scrollToBottom();
        }
    }
}
</script>

<style scoped>
    .feed{
        background: lightgray;
        height: 100%;
        max-height: 470px;
        overflow: scroll;
    }
    .feed ul{
       list-style-type: none;
       padding: 5px;

    }
    .feed ul li.message{
       
       margin: 10px 0;
       width: 100%; 
       
    }
    .feed ul li.message .text{
       
       max-width: 200px;
       border-radius: 5px;
       padding: 12px;
       display: inline-block;
       
    }

    .feed ul li.message.received {

       
        text-align: right;
       
    }
    .feed ul li.message.received .text{

        background: #888787;  
    }

    .feed ul li.message.sent {

       
        text-align: left;
       
    }
    .feed ul li.message.sent .text{
        
        background: #616060;  
    }
</style>


