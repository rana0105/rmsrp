<template>
 <li class="notification-list-item" v-on:click="markMessageAsRead(unreadfavorite.data.user.id,unreadfavorite.id)">
        <p class="message">{{checkMessage(unreadfavorite.data.thread.detail)}}</p>
        <div class="item-footer">
        <span class="date">{{unreadfavorite.updated_at}}</span>
            <span class="from">
                <p class="user-male">@{{ unreadfavorite.data.user.userName }}</p>
            </span>            
        </div>
    </li>
</template>
<script>
    export default {
        props:['unreadfavorite'],
        data(){
            return {
                threadUrl:""
            }
        },
        mounted(){
            console.log('notification item mounted');
            this.threadUrl="thread/"+ this.unreadfavorite.data.thread.id
        },
        methods: {
            markMessageAsRead(userid,id) {
                axios.get("/markAsRead/"+ id)
                    .then(function (response) {
                        console.log(response.status);
                        if(response.status == 200){
                            window.location = '/favchat?id='+userid;
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