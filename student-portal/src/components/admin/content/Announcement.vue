<template>
  <div class="schedule students">
    <div class="button-options">
      <el-button icon="el-icon-plus" @click="showAddStudent = true">
        Add Announcement
      </el-button>
    </div>
    <div class="top-options">
      <div>
        <div style="margin-top: 15px;">
          <el-input
            placeholder="Please input to search"
            v-model="search"
            @input="changeVal"
          >
            <template slot="append">
              <i class="el-icon-search"></i>
            </template>
          </el-input>
        </div>
      </div>
    </div>
    <TableAnnounce />
  </div>
</template>

<script>
import TableAnnounce from "@/components/admin/content/announcements/TableAnnounce";
export default {
  components: {
    TableAnnounce
  },
  data() {
    return {
      search: ""
    };
  },
  methods: {
    changeVal(val) {
      console.log(val);
    }
  },
  props: {},
  created() {}
};
</script>
