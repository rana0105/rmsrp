<template>
    <li class="nav-item dropdown notif-menue-dropdown">
               <div class="dropdown-container dropdown-container-inbox">
                    <a   data-dropdown="inboxNotificationMenu" class="menu-link has-notifications nav-link dropdown-toggle" href="#" role="button"  aria-haspopup="true"
                    aria-expanded="false">
                            <span v-if="uinboxnotif.length + ufavnotif.length != 0" class="begud">
                {{uinboxnotif.length + ufavnotif.length}}</span>Indbakke
                    </a>
                    <ul class="dropdown" name="notificationMenu">
                        <li class="notification-group">
                            <div class="notification-tab">
                                <i class="fa fa-envelope"></i>
                                <h4>Beskeder</h4>
                                <span v-if="uinboxnotif.length > 0" class="label">{{uinboxnotif.length}}</span>
                            </div>
                            <ul class="notification-list">
                        <notification-inbox v-for="unread in uinboxnotif" :unreadsinbox="unread" :key="unread.id"></notification-inbox>
                                  
                            </ul>
                        </li>
                        <li class="notification-group">
                            <div class="notification-tab">
                                <i class="fa fa-envelope"></i>
                                <h4>Favorit beskeder</h4>
                                <span v-if="ufavnotif.length > 0" class="label">{{ufavnotif.length}}</span>
                            </div>
                            <ul class="notification-list">
                                <notification-favorite v-for="unread in ufavnotif" :unreadfavorite="unread" :key="unread.id"></notification-favorite>
                            </ul>
                        </li>
                        <li class="notification-group row" style="max-width: 105%;">
                            <div @click="goInbox" class="notification-tab-btn col">
                                <i class="fa fa-inbox"></i><br>
                                <h4 >Beskeder</h4>
                            </div>                           
                            <div @click="goFavInbox" class="notification-tab-btn col">
                                <i class="fa fa-heart"></i><br>
                                <h4>Favorit beskeder</h4>
                            </div>                           
                        </li>
                    </ul>
                </div>
    </li>
</template>

<script>
    import NotificationInbox from './NotificationInbox';
    import NotificationFavorite from './NotificationFavorite';
    export default {
        props: ['favoriteunreads','inboxunreads', 'user'],
        components: {NotificationInbox,NotificationFavorite},
        data(){
            return {
                uinboxnotif: this.inboxunreads,
                ufavnotif: this.favoriteunreads,
                userObj: this.user
            }
        },
        methods: {
            goInbox(){
                window.location.href = "/chat";
            },
            goFavInbox(){
                window.location.href = "/favchat";
            },
            checkUser(isDisablePushNotif,notificationType,portalId, newNotif){
               if(notificationType == 2 && portalId == this.userObj.portalInfo.portal_id){ //favorite user message notification 
                    this.ufavnotif.push(newNotif);
                    this.pushNotification(isDisablePushNotif,notificationType,newNotif);
                }else if(notificationType == 1 && portalId == this.userObj.portalInfo.portal_id){ //user message notification 
                    this.uinboxnotif.push(newNotif);
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
                if(type ==1){
                    alert = 'New message!';
                    message = notif.data.thread.detail.substring(0,30)+"...";
                    url = "chat?id="+notif.data.user.id;
                }else if(type == 2){
                    alert = 'New message!';
                    message = notif.data.thread.detail.substring(0,30)+"...";
                    url = "favchat?id="+notif.data.user.id;
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
        }
        },
        mounted() {
            console.log('Notification Component mounted.');         
            Echo.private('App.User.' + this.userObj.id)
                .notification((notification) => {
                    let newUnreadNotifications = {data: {thread: notification.thread, user: notification.user},id: notification.id};
                    this.checkUser(notification['thread']['isDisablePushNotif'],notification['thread']['notificationType'],notification['thread']['portal_id'], newUnreadNotifications);
              
          
           
           });
            this.$root.$on('callNotifComponent', (user) => {
                var removeValFromIndex = [];
                var notificationList = this.uinboxnotif;
                var notificationList2 = this.ufavnotif;
                for( var i = 0; i < notificationList.length; i++){
                    if(user.id == notificationList[i].data.user.id){
                        removeValFromIndex.push(i);
                    }
                }
                for (var i = removeValFromIndex.length -1; i >= 0; i--)
                    notificationList.splice(removeValFromIndex[i],1);
                
                removeValFromIndex = [];
                for( var i = 0; i < notificationList2.length; i++){
                    if(user.id == notificationList2[i].data.user.id){
                        removeValFromIndex.push(i);
                    }
                }
                for (var i = removeValFromIndex.length -1; i >= 0; i--)
                    notificationList2.splice(removeValFromIndex[i],1);
            })
             
        }
    }
</script>
