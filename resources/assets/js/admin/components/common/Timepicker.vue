<template>
  <div class="timepicker-component">
    <div class="time-picker-overlay" v-if="showDropdown" @click.stop="toggleDropdown"></div>
    <input type="text" readonly="readonly" :value="value.hour+':'+value.minute" class="input" @click.stop="toggleDropdown">
    <div class="dropdown" v-show="showDropdown">
      <div class="select-lists">
        <ul>
          <li class="hint">mm</li>
          <li v-for="min in minutes" :class="{active: value.minute === min}" @click="select('minute', min)">{{min}}</li>
        </ul>
        <ul class="hours">
          <li class="hint">HH</li>
          <li v-for="hr in hours" :class="{active: value.hour === hr}" @click="select('hour', hr)">{{hr}}</li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      showDropdown: false,
      hours: [],
      minutes: [],
    };
  },
  props: {
    value: {
      type: Object,
      default: function(){
        return {
          hour: '00',
          minute: '00'
        }
      }
    }
  },
  methods: {
    toggleDropdown(){
      this.showDropdown = !this.showDropdown;
    },
    select(type, value){
      let newValue = this.value;
      if(type === 'hour'){
        newValue.hour = value;
      }
      if(type === 'minute'){
        newValue.minute = value;
      }
      this.$emit('update:value', newValue);
    },
    formatValue(value){
      return (value / 10 < 1 ? '0'+value : value).toString();
    },
    renderLists(){
      this.hours = [];
      for (let i = 0; i < 24; i++) {
        this.hours.push(this.formatValue(i));
      }
      this.minutes = [];
      for (let i = 0; i < 60; i++) {
        this.minutes.push(this.formatValue(i));
      }
    },
  },
  mounted(){
    this.renderLists();
  }
}
</script>

<style lang="scss" scoped>
.time-picker-overlay {
  z-index: 2;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
}
.timepicker-component{
  position: relative;
  font-size: 1em;
  font-family: sans-serif;
}
.dropdown{
  position: absolute;
  z-index: 5;
  top: calc(100% + 2px);
  left: 0;
  width: 100%;
  height: 10em;
  box-shadow: 0 1px 6px rgba(0,0,0,0.15);
  background: #fff;
}
.select-lists{
  width: 100%;
  height: 100%;
  overflow: hidden;
  display: flex;
  justify-content: space-between;
  ul{
    list-style-type: none;
    margin: 0;
    padding: 0;
    -webkit-flex: 1;
    -ms-flex: 1;
    flex: 1;
    overflow-x: hidden;
    overflow-y: auto;
    &:first-child{
      border-left: 1px solid #fff;
    }
  }
  li{
    text-align: center;
    padding: 0.3em 0;
    color: #161616;
    cursor: pointer;
    &:hover{
      background: rgba(0,0,0,.08);
    }
    &.hint{
      color: #a5a5a5;
      cursor: default;
      font-size: 0.8em;
      pointer-events: none;
    }
    &.active{
      background: #EB5757;
      color: #fff;
    }
  }
}
</style>
