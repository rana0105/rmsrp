<template>
  <div class="col-lg-3 height-100">
    <div class="online-box-area height-100">
      <div class="header-area">
        <h3>
          Online
          <small class="badge badge-pill badge-success">{{onlineusers.length}}</small>
        </h3>
      </div>
      <div class="online-box-area-pro">
        <div class="single-online-area" v-for="item in onlineusers">
          <a target="_blank" :href="profileLink(item.userObj.id)" :title="item.userObj.userName">
            <div class="online-box-content">
              <div class="img-area chat-room-online-users">
                <b-img
                  :src="getPicture(item.userObj.profilePicture)"
                  height="60px"
                  width="60px"
                  rounded="circle"
                  alt="img"
                  class="m-0"
                />
              </div>
              <div class="online-box-text">
                <p :class="item.userObj.userNameColor" v-b-tooltip.hover="tooltipText(item.userObj)">{{item.userObj.userName}}</p>
                <span>{{getAge(item.userObj.dob)}} years</span>
              </div>
            </div>
          </a>
          &nbsp;
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["onlineusers"],
  methods: {
    className(sex){
      if(sex == 'mand'){
        return 'user-male';
      }else if(sex == 'kvinde'){
        return 'user-female';
      }else{
        return 'user-par';
      }
    },
    tooltipText(user) {
      return this.stringCheck(user.userName)
       +'\n'+ this.stringCheck(user.humanTime)
       +' år - '+ this.regionCheck(user.regions)
       +'\n Søger: '+ JSON.parse(user.searching)
        +'\n Matchwords: '+ JSON.parse(user.matchWords)
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
    regionCheck(data){
      if(data != null){
        return data.region_name;
      }else{
        return '';
      }
    },
    getAge(dateString) {
      var today = new Date();
      var birthDate = new Date(dateString);
      var age = today.getFullYear() - birthDate.getFullYear();
      var m = today.getMonth() - birthDate.getMonth();
      if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
      }
      return age;
    },
    getPicture(path) {
      return "../"+path;
    },
    profileLink(id) {
      return "../profile?user_id=" + id;
    }
  }

};
</script>
<style>
.widt {
  max-width: 70%;
}
</style>

