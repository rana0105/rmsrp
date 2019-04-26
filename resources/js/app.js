import Vue from "vue";
import BootstrapVue from "bootstrap-vue";
import VueChatScroll from "vue-chat-scroll";
import Toaster from "v-toaster";
import "v-toaster/dist/v-toaster.css";
import bEmbed from "bootstrap-vue/es/components/embed/embed";
import HomePage from './components/HomePage';
// import Vuetify from 'vuetify';
import { Picker } from 'emoji-mart-vue'
import {
    EmojiPickerPlugin
} from 'vue-emoji-picker';
Vue.use(EmojiPickerPlugin);


require("./bootstrap");
window.Vue = require("vue");
Vue.use(BootstrapVue);
Vue.use(EmojiPickerPlugin);
// Vue.use(Vuetify);

// chatRoom
Vue.use(Toaster, {
    timeout: 5000
});
Vue.use(VueChatScroll);

Vue.component("latest-chat", require("./components/chat/Latest.vue"));
Vue.component("user-chat", require("./components/chat/UserChat.vue"));
Vue.component("message", require("./components/chatRoom/Message.vue"));
Vue.component("online-user", require("./components/chatRoom/OnlineUser.vue"));
Vue.component("emoji", require("./components/chatRoom/Emoji.vue"));
Vue.component('notification', require('./components/notification/Notification.vue'));
Vue.component('inbox-notification', require('./components/notification/InboxNotification.vue'));
// Vue.component('test', require('./components/test.vue'));
Vue.component('test', HomePage);
Vue.component("b-embed", bEmbed);

new Vue({
    el: "#app",

    // chatRoom
    data: {
        onlineUserCollection: [],
        allOnlineUserList: [],
        latesMessageUser: "",
        uploadPercentage: 0,
        isimageorvideo: true,
        message: "",
        file: "",
        filePath: "",
        chat: {
            message: [],
            user: [],
            color: [],
            side: [],
            time: [],
            profilePicture: [],
            file: [],
            fileExtention: [],
            authUserPic: []
        },

        typeing: "",
        onlineUser: []
    },
    watch: {
        message() {
            Echo.private("chatRoom").whisper("typing", {
                name: this.message
            });
        }
    },
    methods: {
        toasterAlert(message) {
            this.$toaster.warning(message);
        },
        imageModal(url) {
            document.getElementById('chatroom-img').src = url;
        },

        latestMessage(userId) {
            console.log("called app");
            this.latesMessageUser = userId;
            console.log(this.latesMessageUser);
        },
        appendEmoji(emoj) {
            this.message += emoj;

        },
        userFile(event) {
            this.file = event.target.files[0];
            this.filePath = URL.createObjectURL(this.file);
            this.isVideo(this.file);
            this.isImage(this.file);
        },
        getExtension(filename) {
            var parts = filename.split(".");
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
                        this.chat.fileExtention.push(this.file["name"]);
                        this.submitMessage();
                        return true;
                    } else {
                        this.filePath = "";
                        this.file = "";
                        this.$toaster.warning("Max file limit 10Mb");
                    }
            }
            return false;
        },
        send() {
            if (
                this.message.replace(/\s/g, "").length !== 0 ||
                this.file.length != 0
            ) {
                if (this.file.length != 0) {
                    if (this.isImage(this.file) || this.isVideo(this.file)) {
                        this.chat.fileExtention.push(this.file["name"]);
                        this.submitMessage();
                    } else {
                        this.file = "";
                        this.filePath = "";
                        this.$toaster.warning("File not supported");
                    }
                } else {
                    this.chat.fileExtention.push("file.xyz");
                    this.submitMessage();
                }
            }
        },
        submitMessage() {
            if (this.message.length == 0) {
                this.chat.message.push("");
            } else {
                this.chat.message.push(this.message);
            }
            this.chat.user.push("me");
            this.chat.color.push("warning");
            this.chat.side.push("left");
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
            this.chat.time.push(dformat);
            this.chat.profilePicture.push(this.chat.authUserPic[0]);
            this.chat.file.push(this.filePath);

            this.filePath = "";
            if (this.chat.time.length !== this.chat.file.length) {
                this.chat.file.push("");
            }
            var formData = new FormData();
            formData.append("file", this.file);
            formData.append("message", this.message);
            formData.append("chat", this.chat);
            this.message = "";
            this.file = "";
            axios
                .post("send", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    },
                    onUploadProgress: function (progressEvent) {
                        this.uploadPercentage = parseInt(
                            Math.round(
                                (progressEvent.loaded * 100) /
                                progressEvent.total
                            )
                        );
                    }.bind(this)
                })
                .then(response => {
                    this.uploadPercentage = 0;
                    console.log("success");
                })
                .catch(error => {
                    console.log(error.response);
                });
        },
        getTime() {
            let time = new Date();
            return time;
        },
        getOldMessages() {
            axios
                .post("/chat-rooms/getOldMessage")
                .then(response => {
                    // console.log(response.data);
                    if (response.data != "") {
                        this.chat = response.data;
                        // console.log(this.chat);
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
    mounted() {
        this.getOldMessages();
        Echo.private("chatRoom")
            .listen("ChatRoomEvent", e => {
                axios
                    .post("checkEventUser", {
                        eventUser: e
                    })
                    .then(response => {
                        if (response.data === 1) {
                            // console.log(e);
                            if (e.message === null) {
                                this.chat.message.push("");
                            } else {
                                this.chat.message.push(e.message);
                            }
                            this.chat.user.push(e.user.userName);
                            this.chat.color.push("success");
                            this.chat.side.push("right");
                            var d = new Date();
                            this.chat.time.push(d.toLocaleTimeString());
                            // this.chat.time.push(this.getTime());
                            this.chat.profilePicture.push(
                                e.user.profilePicture
                            );
                            this.chat.file.push(e.filePath);
                            this.chat.fileExtention.push(e.filePath);
                            this.portalId = e.portalId;
                        }
                        // console.log(response.data);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            })
            .listenForWhisper("typing", e => {
                if (e.name != "") {
                    this.typeing = "typing....";
                    // console.log(this.typeing);
                } else {
                    this.typeing = "";
                }
            });

        Echo.join("chatRoom")
            .here(users => {
                this.allOnlineUserList = users;
                console.log("called online user event");
                users.forEach(item => {
                   
                    axios
                        .post("/checkUser", {
                            userObject: item
                        })
                        .then(response => {
                            console.log(response.status)
                            if (response.data === 1) {
                                this.onlineUser.push(item);
                            }

                        })
                        .catch(error => {
                            console.log(error.response);
                        });
                });
            })
            .joining(user => {
                this.allOnlineUserList.push(user);

                axios
                    .post("/checkUser", {
                        userObject: user
                    })
                    .then(response => {
                        if (response.data === 1) {
                            this.onlineUser.push(user);
                        }
                    })
                    .catch(error => {
                        console.log(error.response);
                    });
                // this.$toaster.success(user.userObj.userName + " joined");
            })
            .leaving(user => {
                this.allOnlineUserList.push(user);
                axios
                    .post("/checkUser", {
                        userObject: user
                    })
                    .then(response => {
                        if (response.data === 1) {
                            this.onlineUser.pop(user);
                        }
                    })
                    .catch(error => {
                        console.log(error.response);
                    });
                // this.$toaster.warning(user.userObj.userName + " leaved");
            });
    }
});
