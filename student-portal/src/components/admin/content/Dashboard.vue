<template>
  <div class="dashboard">
    <div class="dashboard-wrapper">
      <div class="top-panel">
        <div class="top-panel-wrapper">
          <div class="item">
            user count
          </div>
          <div class="item">
            student count
          </div>
          <div class="item">
            parent count
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  data() {
    return {};
  },
  methods: {},
  props: {},
  created() {}
};
</script>

<style lang="scss">
.dashboard {

  .top-panel .top-panel-wrapper {
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;

    .item {
      border: 1px solid #000;
      width: calc(33.3333% - 20px);
      height: 120px;
    }
    
  }

} 

</style>
