<template>
  <div class="header">
    <div class="header-left">header left</div>
    <div class="header-right">header right</div>
  </div>
</template>
<script>
export default {
  name: "Header",
  components: {}
};
</script>
<style lang="scss">
.header {
  display: flex;
  flex-direction: row;
  &>div {
    flex: 1;
  }

  .header-left {
    text-align: left;
  }

  .header-right {
    text-align: right;
  }
}
</style>
