<template>
  <div class="profile-setting-single active"  @click.prevent="openChat(user)">
    <a href="#"  >
      <img :src="user.profilePicture" >
      <template>
        <div class="title">
          <h2 :class="user.userNameColor" v-b-tooltip.hover="tooltipText(user)" id="h1">
            {{user.userName }}
            <i v-if="user.isPromoted == 1" class="zmdi zmdi-star text-warning" id="star"></i>
          </h2>
          <p v-bind:class="{'read-user-text' : isReadMessage}">{{messageMinimize(lastMessage.data.thread.detail)}}</p>
        </div>
        <div class="time">
         <p v-bind:class="{'read-user-text' : isReadMessage}">{{lastMessage.data.thread.updated_at}}</p>
        </div>
      </template>     
    </a>
  </div>
</template>

<script>
import axios from "axios";
export default {
  props: ["userObj","textUser","authUser"],
  name: "user-list",
  data() {
    return {
      users: [],
      user: this.userObj,
      lastMessage:{
        data:{
          thread:{
            detail:'',
            user_id:''
          }

        }
      },
      lastUserText: this.lastText,
      currentTabUser: '',
      authChatUser: this.authUser,
      isReadMessage: false

    };
  },
  mounted() {
    this.lastUserMessage(this.user.id);
    console.log(this.user.id);
     Echo.private('App.User.' + this.authChatUser)
        .notification((notification) => {
          console.log("called user list channel");
            let newUnreadNotifications = {data: {thread: notification.thread, user: notification.user},id: notification.id};
            this.checkUser(newUnreadNotifications);
           
      });
    
  },
  computed: {

  },
  methods: {  
    checkUser(notif){
      if(notif.data.user.id == this.user.id && notif.data.thread.portal_id == this.user.portalInfo.portal_id){
        if(notif.data.thread.notificationType == 1 || notif.data.thread.notificationType == 2){
          this.isReadMessage = false;
          return  this.lastMessage = notif; 

        }
      }
    },
    tooltipText(user) {
      return this.stringCheck(user.userName)
       +'\n'+ this.stringCheck(user.humanTime)
       +' år - '+ this.regionCheck(user.regions)
       +'\n Søger: '+ JSON.parse(user.searching)
        +'\n Matchwords: '+ user.commonMatchwords
         +'\nNegative matchwords: '+ JSON.parse(user.nMatchWords)
         +'\nHeight: '+ this.stringCheck(user.height) 
         +'\nWeight: '+ this.stringCheck(user.weight) 
         +'\nChildren: '+ this.stringCheck(user.children) 
         ;
    },
    stringCheck(data){
      if(data != null){
        return data;
      }else{
        return '';
      }
    },
    arrayCheck(){

    },
    regionCheck(data){
      if(data != null){
        return data.region_name;
      }else{
        return '';
      }
    },
    messageMinimize(message){
      if(message == null) return "Sent a file";
      if(message.length > 18) return  message.substring(0,18)+'. . .';
      else return  message;
    },
    lastUserMessage(id){
      console.log("last message called")
      axios.get("/last_message/"+ id)
      .then(response => {
        this.lastMessage = response.data;
        console.log(response);
        if(this.lastMessage.read_at != null) return this.isReadMessage = true;
      });
    },
    openChat(user) {
      this.$emit("chatBoxUser", user);
      this.$root.$emit('callNotifComponent', user);
      
       axios.get("/read_messages/"+ user.id)
      .then(response => {
        console.log(response)
        if(response.status == 200){
          this.isReadMessage = true;
          var parent = document.getElementById("h1");
          var child = document.getElementById("star");
          parent.removeChild(child);

        }

      });
    }
  },
   watch: { 
    textUser: function(newVal, oldVal) { // watch it
      if(newVal.user_id == this.user.id){
        this.isReadMessage = true;
        var parent = document.getElementById("h1");
        var child = document.getElementById("star");
        parent.removeChild(child);
      }
        // console.log('Prop changed: ', newVal, ' | was: ', oldVal)        
    }
  },
};
</script>

<style>
</style>
