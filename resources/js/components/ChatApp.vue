<template>
    <div class="chat-app">
        <Conversation :contact="SelectedContact" :messages="messages" @new="sendNewMessage"/>
        <ContactList :contacts="contacts" @selected="startConversationWith"/>
    </div>
</template>

<script>
    import Conversation from './Conversation';
    import ContactList from './ContactList';
    export default {
        props: {
            user: {
                type :Object,
                required :true
            }
        },
        data(){
            return{
                SelectedContact:null,
                messages : [],
                contacts : []
            }
        },
        mounted() {
            Echo.private(`messages.${this.user.id}`)
            .listen('NewMessage',(e) =>{
                this.handleIncoming(e.message);
            });
            axios.get('/contacts')
            .then((response) =>{
                console.log(response.data);
                this.contacts = response.data;
            })
        },
        methods :{
            startConversationWith(contact){
                this.updateUnreadCount(contact,true);
                axios.get(`/conversation/${contact.id}`)
                    .then((response) =>{
                        this.messages = response.data;
                        this.SelectedContact = contact;
                    });
            },
            sendNewMessage(message){
                this.messages.push(message);
            },
            handleIncoming(message){
                if(this.SelectedContact && message.from == this.SelectedContact.id){
                    this.sendNewMessage(message);
                    return;
                }
                 this.updateUnreadCount(message.from_contact,false);
            },
            updateUnreadCount(contact,reset){
                this.contacts = this.contacts.map((single) =>{
                    if (single.id != contact.id) {
                        return single;
                    }

                    if (reset) {
                        single.unread = 0;
                    }else{
                        single.unread +=1;
                    }

                    return single;
                });
            }
        },
        components:{
            Conversation,
            ContactList
        }
    }
</script>

<style  scoped>
    .chat-app{
        display :flex;
    }
</style>

