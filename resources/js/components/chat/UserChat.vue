<template>
  <div class="row height-100">
    <div class="col-lg-4 height-100 padding-right-o manm-reasion-qut">
      <div class="chat-list-area profile-setting-area">
      <user-list :authUser="sender.id" :textUser.sync="sentUser" :userObj="user" @chatBoxUser="fetchReceiver" v-for="user in users" :key="user.id"></user-list>
      </div>
    </div>
		<div class="responsive-caht-page">
			<div class="chat-list-area profile-setting-area rom-pro-clcik">
                
				<div

        class="profile-setting-single active"
        v-for="(user,index) in users"
        :key="index"
        >
        <a href="#" v-on:click="fetchReceiver(user)">
          <img :src="user.profilePicture" alt>
          <template v-if="user.isPromoted === 1">
            <span>
              {{user.userName}}
              <i class="zmdi zmdi-star text-warning"></i>
            </span>
          </template>
          <template v-else>
            <span v-html="user.userName"></span>
          </template>
        </a>
      </div>						
    </div>
		</div>
    <div v-if="reciver" class="col-lg-8 height-100">
      <div class="chating-box-area height-100 d-flex flex-column">
        <div class="header-area" style="display:inline;">
          <div class="chat-create-area">
            <button class="my-chat-button">
              +
            </button>
		      </div>
          <h3>
            <a target="_blank" :href="'profile?user_id='+ reciver.id" v-html="reciver.userName"></a>
          </h3>
          <div class="block-fav-btn">
            <button @click.prevent="blockUser(reciver.id)" type="button" class="btn-block btn-radiaus small">Bloker</button>
            <button @click.prevent="favUser(reciver.id)" type="button" v-bind:class="{ btn_fav_active : isFavcolor }" class="btn-fav btn-radiaus small">{{btntext}}</button>
          </div>
        </div>
        <div class="chat-box-area-pro" v-chat-scroll>
           <b-modal size="lg" id="image-modal" hide-footer>
              <b-img
                rounded
                fluid
                :src="imagePath"
                alt="Thumbnail"
              />
            </b-modal>
          <div
            class="single-chat-area"
            v-for="(oldMessage,index) in oldMessages"
            :key="index"
            :class="{right: oldMessage.sender_id === sender.id}"
          >
          
            <template v-if="oldMessage.sender_id === sender.id">
              <div v-if="sender" class="chat-box-content">
                <div class="chat-box-text">
                  <template v-if="oldMessage.file !== ''">
                    <template v-if="isImages(oldMessage.file)">
                      <a @click.prevent="imageModel(oldMessage.file)" target="_blank">
                        <br>
                        <b-img
                          v-b-modal.image-modal 
                          width="110"
                          height="110"
                          rounded
                          fluid
                          :src="oldMessage.file"
                          alt="Thumbnail"
                        />
                      </a>
                    </template>
                    <template v-if="isVideos(oldMessage.file)">
                      <video class="message-video" width="125px" height="auto" controls>
                        <source :src="oldMessage.file" type="video/mp4">
                      </video>
                    </template>
                  </template>
                  <p>{{ oldMessage.detail }}</p>
                </div>
                <div class="img-area image">
                  &nbsp;
                  <img class="rounded-circle" :src="sender.profilePicture" alt>
                </div>
              </div>
              <div class="time">
                <p>{{ oldMessage.created_at }}</p>
              </div>
            </template>
            <template v-else>
              
              <div class="chat-box-content">
                <div class="img-area image">
                  <img class="rounded-circle" :src="reciver.profilePicture" alt> &nbsp;
                </div>
                <div class="chat-box-text">
                  <template v-if="oldMessage.file !== ''">
                    <template v-if="isImages(oldMessage.file)">
                      <a @click.prevent="imageModel(oldMessage.file)" target="_blank">
                        <br>
                        <b-img
                          v-b-modal.image-modal 
                          width="110"
                          height="110"
                          rounded
                          fluid
                          :src="oldMessage.file"
                          alt="Thumbnail"
                        />
                      </a>
                    </template>
                    <template v-if="isVideos(oldMessage.file)">
                      <video class="message-video" width="125px" height="auto" controls>
                        <source :src="oldMessage.file" type="video/mp4">
                      </video>
                    </template>
                  </template>
                  <p>{{ oldMessage.detail }}</p>
                </div>
              </div>
              <div class="time">
                <p>{{ oldMessage.created_at }}</p>
              </div>
            </template>
          </div>
        </div>

        <img v-if="filePath !== '' " class="cimage" v-bind:src="filePath" alt>
        <progress
          v-if="uploadPercentage > 0"
          class="progress-bar"
          role="progressbar"
          max="100"
          :value.prop="uploadPercentage"
        ></progress>
        <div class="chat-butoon">
          <div class="left-area-icon">
            <div class="icon-tell file-upload">
              <input @change="userFile($event)" type="file" id="file">
              <label for="file">
                <i class="zmdi zmdi-link" type="file"></i>
              </label>
            </div>
            <div class="icon-tell">
              <emoji @clicked="appendEmoji"></emoji>
            </div>
          </div>
          <div class="mdl-type-area">
            <input
              type="text"
              v-on:keyup.enter="sendCheck()"
              name
              v-model="message"
              placeholder="Skriv her..."
            >
          </div>
          <div class="right-ttype-area">
           
            <div class="play-sent">
              <button type="submit" @click="sendCheck()" :disabled="loadingChat">
                <i class="zmdi zmdi-mail-send"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import UserList from "./UserList";
export default {
  props: ["newmessageuser","isfavorite"],
  name: "user-chat",
  components: {
    UserList
  },
  data() {
    return {
      sentUser: {},
      isFavcolor: '',
      btntext:'',
      imagePath: "",
      notification: 0,
      isSeen: false,
      users: [],
      uploadPercentage: 0,
      reciver: {},
      sender: {},
      oldMessages: [],
      message: "",
      file: "",
      filePath: "",
      fileExtention: "",
      loadingChat: false,
      chat: {
        message: [],
        file: [],
        sender_id: [],
        user_id: []
      }
    };
  },
  watch: {
    reciver: {
      handler() {
        this.getMessages(this.reciver.id);
      },
      deep: true
    },
    message() {
      Echo.private("user." + this.sender.id).whisper("type", {
        name: this.message
      });
    }
  },
  mounted() {

    this.fetchSender();
    this.fetchUsers(this.newmessageuser);
    this.favBtnBehavior();
  },
  computed: {},
  methods: {
    imageModel(url){
      this.imagePath = url;
      console.log(url);
    },
    blockUser(recever){
      var formData = new FormData();
      formData.append("block_by", this.sender.id);
      formData.append("block_to", recever);
      if(recever != null){
       axios
        .post("blockList", formData,{
          headers: {
            "Content-Type": "application/json"
          }      
        })
        .then(response => {
          location.reload();
          this.$toaster.warning("User blocked");
        });
      }
    },
    favBtnBehavior(){
      if(window.location.pathname == "/chat"){
            this.btntext = 'Tilføj favorit';
            this.isFavcolor = false;
          }else{
             this.btntext = 'Fjern favorit';
             this.isFavcolor = true;
          }
    },
    favUser(recever){
       var formData = new FormData();
      formData.append("favourite_by", this.sender.id);
      formData.append("favourite_to", recever);
       axios
        .post("favourite", formData,{
          headers: {
            "Content-Type": "application/json"
          }      
        })
        .then(response => {
          if(window.location.pathname == "/chat"){
            window.location = "favchat";
          }else{
             window.location = "chat";
          }
        });
    },
    userFile(file) {
      return file;
    },
    checkFileExtention(filePath) {
      return filePath;
    },
    appendEmoji(emoji) {
      this.message += emoji;
    },
    userFile(event) {
      this.file = event.target.files[0];
      this.filePath = URL.createObjectURL(this.file);
      this.isVideo(this.file);
      // this.isImage(this.file);
    },
    getExtension(filename) {
      var parts = filename.toString().split(".");
      return parts[parts.length - 1];
    },
    isImage(filename) {
      var ext = this.getExtension(filename["name"]);
      switch (ext.toLowerCase()) {
        case "jpeg":
        case "jpg":
        case "png":
          if (filename["size"] <= 10000000) {
            return true;
          } else {
            this.filePath = "";
            this.file = "";
            this.$toaster.warning("Max file limit 10Mb");
          }
      }
      return false;
    },
    isVideo(filename) {
      var ext = this.getExtension(filename["name"]);
      switch (ext.toLowerCase()) {
        case "webm":
        case "wmv":
        case "mp4":
          if (filename["size"] <= 10000000) {
            this.fileExtention = this.file["name"];
            this.sendMessage();
            return true;
          } else {
            this.filePath = "";
            this.file = "";
            this.$toaster.warning("Max file limit 10Mb");
          }
      }
      return false;
    },
    isImages(filename) {
      if (filename !== null) {
        var ext = this.getExtension(filename);
        switch (ext.toLowerCase()) {
          case "jpeg":
          case "jpg":
          case "png":
            return true;
        }
        return false;
      } else {
        return false;
      }
    },
    isVideos(filename) {
      if (filename !== null) {
        var ext = this.getExtension(filename);
        switch (ext.toLowerCase()) {
          case "webm":
          case "wmv":
          case "mp4":
            return true;
        }
        return false;
      } else {
        return false;
      }
    },
    sendCheck() {
      
      if (
        this.message.replace(/\s/g, "").length !== 0 ||
        this.file.length != 0
      ) {
        if (this.file.length != 0) {
          if (this.isImage(this.file) || this.isVideo(this.file)) {
            this.fileExtention = this.file["name"];
            this.sendMessage();
          } else {
            this.file = "";
            this.filePath = "";
            this.$toaster.warning("File not supported ðŸ˜£");
          }
        } else {
          
          this.fileExtention = "file.xyz";
          this.sendMessage();
        }
      }
    },
    sendMessage() {
      
      this.loadingChat = true;
      var formData = new FormData();
      formData.append("user_id", this.reciver.id);
      formData.append("file", this.file);
      formData.append("message", this.message);
      formData.append("send", "free");
       
      axios
          .post("user_chat", formData, {
            headers: {
              "Content-Type": "multipart/form-data"
            },
            onUploadProgress: function(progressEvent) {
              this.uploadPercentage = parseInt(
                Math.round((progressEvent.loaded * 100) / progressEvent.total)
              );
            }.bind(this)
          })
          .then(response => {
            this.uploadPercentage = 0;
            this.filePath = "";
            this.file = "";
            this.message = "";
            this.loadingChat = false;
            this.oldMessages.push(response.data);
            axios.get("/read_messages/"+ this.sender.id)
            .then(response => {
              console.log(response.status)
            })
          })
          .catch(error => {
              console.log(error.response);
          });
        this.sentUser = {
            user_id: this.reciver.id,
        };
        this.$root.$emit('callNotifComponent', this.reciver);
    },
    getMessages(id) {
      axios.get("user_messages/" + id).then(response => {
        this.oldMessages = response.data;
      });
    },
    fetchReceiver(user) {
      this.reciver = user;
    },
    fetchUsers(id) {
      let userIndex;
       axios.get("chat_users",{
        params:{
          isFav : this.isfavorite
        }
      })
      .then(response => {
        this.users = response.data;
         this.users.forEach(function(user,index){
           if(user.id === id){
            userIndex = index;
           }else{
             userIndex = 0;
           }
      });
          this.fetchReceiver(this.users[userIndex]);
      });
    },
    fetchSender() {
      axios.get("get_auth").then(response => {
        this.sender = response.data;
        this.listenForNewMessage();
      });
    },
    listenForNewMessage() {
      var d = new Date();
            var dformat = [
                d.getFullYear(),
                d.getMonth() + 1,
                d.getDate()                
            ].join('-') + ' ' + [
                d.getHours(),
                d.getMinutes(),
                d.getSeconds()
            ].join(':');
      Echo.private("user." + this.sender.id).listen(".user.chat", e => {
        
        // console.log(this.latestMessage)
        if (this.reciver.id === e.user && this.reciver.portalInfo.portal_id == e.portal_id) {
          this.notification += 1;
          this.oldMessages.push({
            detail: e.message,
            file: e.file,
            sender_id: e.user,
            user_id: this.sender.id,
            portal_id: e.portal_id,
            created_at: dformat
          });
          
        }
      });
    }
  }
};
</script>

<style>
.message-video {
  padding: "5px";
}
</style>
