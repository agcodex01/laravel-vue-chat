<template>
    <div class="contact-list">
        <ul>
            <li v-for="contact in sortedContacts" :key="contact.id" @click="selectContact(contact)" :class="{'selected' : contact == selected}">
                <div class="avatar">
                    <img :src="contact.profile_image" :alt="contact.name">
                </div>
                <div class="contact">
                    <p class="name">{{contact.name}}</p>
                    <p class="email">{{contact.email}}</p>
                </div>
                <span class="unread" v-if="contact.unread">{{contact.unread}}</span>
            </li>
        </ul>
    </div>
</template>

<script>
export default {

    props:{
        contacts :{
            type :Array,
            default : []
        }
    },
    data(){
        return {
            selected : this.contacts.length ? contacts[0] : null
        };
    },
    methods :{
        selectContact(contact){
            this.selected = contact;
            this.$emit('selected',contact);
        }
    },
    computed :{
        sortedContacts(){
            return _.sortBy(this.contacts,[(contact) =>{
                if(contact == this.selected){
                    return Infinity;
                }
                return contact.unread;
            }]).reverse();
        }
    }
    
}
</script>

<style scoped>
    .contact-list{
        flex : 2;
        max-height: 600px;
        overflow: scroll;
        border-left: 1px solid gray;
    }
        
    
    .contact-list ul{

        list-style-type: none;
        padding-left: 0;
    }

    .contact-list ul li{

        display: flex;
        padding: 2px;
        border-bottom: 1px solid gray;
        position: relative;
        height: 80px;
        cursor: pointer;
    }
    .contact-list ul li.selected{

        background: #dedcdc;
    }

    .contact-list ul li .unread{

        background: #147762;
        color: azure;
        position: absolute;
        right: 11px;
        top: 20px;
        display: flex;
        font-weight: 700;
        min-width: 20px;
        justify-content: center;
        align-items: center;
        line-height: 20px;
        font-size: 12px;
        padding: 0 4px;
        border-radius: 3px;
    }

    .contact-list ul li .avatar{

        flex: 1;
        display: flex;
        align-items: center;
    }
    .contact-list ul li .avatar img{

       width: 35px;
       border-radius: 50%;
       margin: 0 auto;
    }

    .contact-list ul li .contact{

        flex: 3;
        font-size: 10px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .contact-list ul li .contact p{

      margin: 0;
    }
    .contact-list ul li .contact p.name{

        font-weight: bold;
    }

        
</style>
