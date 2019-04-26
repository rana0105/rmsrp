<template>
    <li class="notification-list-item" v-on:click="markMessageAsRead(unreadsinbox.data.user.id, unreadsinbox.id)">
        <p class="message">{{checkMessage(unreadsinbox.data.thread.detail)}}</p>
        <div class="item-footer">
            <span class="from">
                <p class="user-male">@{{ unreadsinbox.data.user.userName }}</p>
            </span>
             <span class="date">{{unreadsinbox.updated_at}}</span>
            
        </div>
    </li>
</template>

<script>
    export default {
        props:['unreadsinbox'],
        data(){
            return {
                threadUrl:""
            }
        },
        mounted(){
            console.log('notification item mounted');
        },
        methods: {
            markMessageAsRead(userid,id) {
                axios.get("/markAsRead/"+ id)
                    .then(function (response) {
                    console.log(response.status);
                        if(response.status == 200){
                            window.location = "/chat?id="+userid;
                        }
                    });
            },
            checkMessage(data){
                if(data != null){
                    return data.substring(0,20)+"...";
                }else{
                    return 'send a file';
                }
            }
        }

    }
</script>
