<template>
  <div class="latest-single-messages-profile">
    <div class="div-title">
      <h3>Nyeste besked</h3>
    </div>
    <template v-if="!emptyChat">
      <div class="messages-profile-header-area">
        <div class="messages-profile-image">
          <a :href="'/profile?user_id='+latestChat.sender.id">
            <img class="rounded-circle" :src="latestChat.sender.profilePicture" alt>
          </a>
        </div>
        <div class="messages-profile-header">
          <a :href="'/profile?user_id='+latestChat.sender.id"  v-bind:class="[latestChat.sender.userNameColor, 'latest-m-username'] " v-html="latestChat.sender.userName"></a>
          <h3 v-if="latestChat.sender.regions !== null">{{latestChat.sender.regions.region_name }}</h3>
          <h4>{{latestChat.sender.humanTime}} Years</h4>
        </div>
      </div>
      <div class="messages-profile-content-area">
        <p v-html="messageMinimize(latestChat.detail)"></p>
        <a v-if="isfav" :href="'/favchat?id='+latestChat.sender.id" @click="goInbox" class="btn btn-sm btn-default">Indbakke</a>
        <a v-else :href="'/chat?id='+latestChat.sender.id" @click="goInbox" class="btn btn-sm btn-default">Indbakke</a>
      </div>
    </template>
    <template v-else>
      <div class="alert alert-default">Ingen nye beskeder</div>
      <a href="/chat">Indbakke</a>
    </template>
  </div>
</template>

<script>
import lodash from "lodash";
import axios from "axios";
export default {
  name: "latest-chat",
  data() {
    return {
      latestChat: { },
      userId:"",
      isfav: "",
      isMale: "",
      isFemale: "",
      isCouple: "",
    };
  },
  computed: {
    emptyChat() {
      return lodash.isEmpty(this.latestChat);
    }
  },
  mounted() {
    this.fetchLatestChat();
  },
  methods: {
    messageMinimize(message){
      if(message == null) return "Sent a file";
      if(message.length > 25) return  message.substring(0,25)+'. . .';
      else return  message;
    },
    fetchLatestChat() {
      axios.get("/latest_chat").then(response => {
        console.log(response.data);
        this.latestChat = response.data;
        this.userId = this.latestChat.sender_id;
        this.isfav = this.latestChat.isfav;
        if(this.latestChat.sender.sex === 'mand'){
          this.isMale = true;
        }else if(this.latestChat.sender.sex === 'kvinde'){
          this.isFemale = true;
        }else{
          this.isCouple = true;
        }
      });
    },
    goInbox() {
      this.$emit("clicked", this.userId);
    }
  }
};
</script>

<style>
</style>
