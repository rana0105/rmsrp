<template>
    <li class="nav-item dropdown notif-menue-dropdown">
        <div class="dropdown-container dropdown-container-others">
            <a   data-dropdown="notificationMenu" class="othersNotificationMenu menu-link has-notifications nav-link dropdown-toggle" href="#" role="button"  aria-haspopup="true"
            aria-expanded="false">
                    <span v-if="uothersnotif.length != 0" class="begud">
        {{ uothersnotif.length}}</span>Notifikationer
            </a>
            <ul class="dropdown" name="notificationMenu">
                
                <li class=" notification-group-others">
                    <div class="notification-tab-others">
                       
                    </div>
                    <ul class="notification-list">
                        <div v-if="uothersnotif.length == 0" class="no-notif">
                            <p>No notifications right now</p>
                        </div>

                        <li v-for="unreadothers in uothersnotif" :key="unreadothers.id" class="notification-list-item" 
                            >
                            <div v-if="!unreadothers.data.thread.isGroupRequest" v-on:click="markMessageAsRead(unreadothers.data.thread,unreadothers.data.user, unreadothers.id)">
                                <p v-if="unreadothers.data.thread.comment" class="message">Commented on a post in {{unreadothers.data.thread.groupName}}</p>
                                <p v-else-if="unreadothers.data.thread.isGroupJoin" class="message">Join new member on {{unreadothers.data.thread.groupName}}</p>
                                <p v-else-if="unreadothers.data.thread.isApproveGroupJoinRequest" class="message">
                                    Accept your join request to {{unreadothers.data.thread.groupName}}                                    
                                </p>
                                <p v-else-if="unreadothers.data.thread.isRejectGroupJoinRequest" class="message">
                                    Reject your join request to {{unreadothers.data.thread.groupName}}                                    
                                </p>
                                <p v-else-if="unreadothers.data.thread.isEventJoin" class="message">Join new member on {{unreadothers.data.thread.eventName}}</p>
                                <p v-else-if="unreadothers.data.thread.isUserRating" class="message">{{unreadothers.data.thread.rating_value}} stars given</p>
                                <p v-else class="message">Posted in {{unreadothers.data.thread.groupName}}</p>
                                <div class="item-footer">
                                    <span class="from">
                                        <p :class="unreadothers.data.user.userNameColor">@{{ unreadothers.data.user.userName }}</p>
                                    </span>            
                                    <span class="date">{{unreadothers.data.thread.updated_at}}</span>
                                </div>
                            </div>
                            <div v-if="unreadothers.data.thread.isGroupRequest">
                                <p v-if="unreadothers.data.thread.isGroupRequest" class="message">
                                Requested to join {{unreadothers.data.thread.groupName}} <br>
                                    <button @click="accept(unreadothers.data.thread.group_id,
                                    unreadothers.data.user.id,
                                    unreadothers)" type="button"  class="notif-accept-btn btn-radiaus small">Accept</button>
                                    <button @click="reject(
                                        unreadothers.data.thread.group_id,
                                        unreadothers.data.user.id,
                                        unreadothers
                                        )" type="button"  class="notif-reject-btn btn-radiaus small">Reject</button>
                                </p>       
                                <div class="item-footer">
                                    <span class="from">
                                        <p @click="userprofile(unreadothers.data.user.id)" :class="unreadothers.data.user.userNameColor">@{{ unreadothers.data.user.userName }}</p>
                                    </span>            
                                    <span class="date">{{unreadothers.data.thread.updated_at}}</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </li>
</template>

<script>
    export default {
        props: ['othersunreads', 'userid'],
        data(){
            return {
                uothersnotif: this.othersunreads,
            }
        },
        methods: {
            accept(group_id,user_id,thread){
                console.log(thread.id);
                var notificationList =  this.uothersnotif;
                var threadID = thread.id;
                 axios
                    .post("/approvedToJoin", {
                        group_id: group_id,
                        user_id: user_id,
                        thread_id: threadID
                    })
                    .then(response => {
                       if(response.status == 200){
                           console.log(response);
                            var index = notificationList.indexOf(thread);
                            if (index > -1) {
                                notificationList.splice(index, 1);
                            }
                        }
                    })
                    .catch(error => {
                        console.log(error.response);
                    });
            },
            reject(group_id,user_id,thread){
                console.log(thread.id);
                var notificationList =  this.uothersnotif;
                var threadID = thread.id;
                 axios
                    .post("/rejectToJoin", {
                        group_id: group_id,
                        user_id: user_id,
                        thread_id: threadID
                    })
                    .then(response => {                        
                        if(response.status == 200){
                           console.log(response);
                            var index = notificationList.indexOf(thread);
                            if (index > -1) {
                                notificationList.splice(index, 1);
                            }
                        }
                    })
                    .catch(error => {
                        console.log(error.response);
                    });
            },
            userprofile(id){
                 window.open('/profile?user_id='+id,'_blank');
            },
            markMessageAsRead(type,user,id) {
                axios.get("/markAsRead/"+ id)
                .then(function (response) {
                    console.log(response.status);
                    if(response.status == 200){
                        if(type.isEventJoin){
                            window.location = "/eventDetails/"+type.event_id;
                        }else if(type.isUserRating){
                            window.location = "/profile?user_id="+user.id;
                        }
                        else{
                            window.location = "/groupDetails/"+type.group_id;
                        }
                    }
                });
               
            },
            checkUser(isDisablePushNotif,notificationType, newNotif){
               if(notificationType == 3){ //favorite user message notification 
                    console.log("found others notif")
                    this.uothersnotif.push(newNotif);
                    this.pushNotification(isDisablePushNotif,notificationType,newNotif);
                }
                    
            },
            pushNotification(isDisablePushNotif,type, notif){
                if(isDisablePushNotif == 1){
                    return;
                }else{
                if (! ('Notification' in window)) {
                    alert('Web Notification is not supported');
                    return;
                }
                let alert = "";
                let message = "";
                let url = "";
               if(type ==3){
                    alert = 'New notification!';
                    if(notif.data.thread.comment){
                        message = '@'+notif.data.user.userName+' comented on your group post';
                        url = "/groupDetails/"+notif.data.thread.group_id;
                    }
                    else if(notif.data.thread.isGroupJoin){
                        message = '@'+notif.data.user.userName+' join your '+ notif.data.thread.groupName;
                        url = "/groupDetails/"+notif.data.thread.group_id;
                    }
                    else if(notif.data.thread.isGroupRequest){
                        message = '@'+notif.data.user.userName+' Requested to join '+ notif.data.thread.groupName;
                        url = "/profile?user_id="+notif.data.user.id;
                    }
                    else if(notif.data.thread.isApproveGroupJoinRequest){
                        message = '@'+notif.data.user.userName+' Accept your join request to  '+ notif.data.thread.groupName;
                        url = "/profile?user_id="+notif.data.user.id;
                    }
                    else if(notif.data.thread.isRejectGroupJoinRequest){
                        message = '@'+notif.data.user.userName+' Reject your join request to '+ notif.data.thread.groupName;
                        url = "/profile?user_id="+notif.data.user.id;
                    }
                    else if(notif.data.thread.isEventJoin){
                        message = '@'+notif.data.user.userName+' join your event';
                        url = "/eventDetails/"+notif.data.thread.event_id;
                    }
                    else if(notif.data.thread.isUserRating){
                        message = '@'+notif.data.user.userName+' given ' +notif.data.thread.rating_value + ' stars given';
                        url = "/profile?user_id="+notif.data.user.id;
                    }
                    else{
                        message = '@'+notif.data.user.userName+' posted on group';
                        url = "/groupDetails/"+notif.data.thread.group_id;
                    }
                }
                Notification.requestPermission( permission => {
                let notification = new Notification(alert, {
                body: message, // content for the alert
                icon: "/img/logo.png" // optional image url
                });
                
                // link to page on clicking the notification
                notification.onclick = () => {
                window.open(url);
                };
            });
            }
        },
        readPushNotif(thread){
            axios.get("/markAsRead/"+ thread.id);
        }
        },
        mounted() {
            // console.log('Notification Component mounted.');         
            Echo.private('App.User.' + this.userid)
                .notification((notification) => {
                    let newUnreadNotifications = {data: {thread: notification.thread, user: notification.user},id: notification.id};
                    
                    this.checkUser(notification['thread']['isDisablePushNotif'],notification['thread']['notificationType'], newUnreadNotifications);
              
          
           
           });
           
        }
    }
</script>
