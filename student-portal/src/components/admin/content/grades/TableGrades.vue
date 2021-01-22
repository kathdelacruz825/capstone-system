<template>
  <div class="table-grades">
    <el-table :data="tableData" style="width: 100%" max-height="370">
      <!-- <el-table-column
        v-for="(propItem, propKey) in tableProps"
        :key="propKey"
        :prop="propItem.propName"
        :label="propItem.propLabel"
        :width="propItem.width"
        :align="propKey == 2 ? 'left' : 'center'"
        class-name="text-style"
      >
      </el-table-column> -->
      <el-table-column
        prop="ID"
        label="ID"
        width="50">
      </el-table-column>
      <el-table-column
        prop="SubjectID"
        label="Subject"
        width="120">
      </el-table-column>
      <el-table-column label="Grading Period">
        <el-table-column
          prop="FirstGrade"
          label="1"
          width="80">
        </el-table-column>
        <el-table-column
          prop="SecondGrade"
          label="2"
          width="80">
        </el-table-column>
        <el-table-column
          prop="ThirdGrade"
          label="3"
          width="80">
        </el-table-column>
        <el-table-column
          prop="FourthGrade"
          label="4"
          width="80">
        </el-table-column>
      </el-table-column>
      <el-table-column
        prop="OverAllGrade"
        label="Final Grade"
        width="80">
        </el-table-column>
      <el-table-column
        prop="Remarks"
        label="Remarks"
        width="120">
        </el-table-column>
      <el-table-column fixed="right" label="Operations" :width="'230'">
        <template slot-scope="scope">
          <el-button
            type="warning"
            icon="el-icon-edit"
            @click.native.prevent="operationAction('Edit', tableData[scope.$index])"
            ></el-button>
          <el-button
            type="danger"
            icon="el-icon-delete"
            @click.native.prevent="operationAction('Delete', tableData[scope.$index])"
            ></el-button>
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
import { tableProps } from "@/components/admin/content/grades/tableProps_TableGrades.js";

export default {
  components: {},
  data() {
    return {
      tableProps: tableProps,
      gradeData: {},
      tableData: [],
    };
  },
  methods: {
    operationAction(name, itemData) {
      this.gradeData = itemData;
      switch (name) {
        case "Edit":
          break;
        case "Delete":
          break;
        default:
          console.log("Invalid Option");
      }
    },
  },
  props: {},
  created() {},
  mounted() {}
};
</script>

<style lang="scss">
.table-grades .cell {
    word-break: keep-all;
    text-align: center;
}
</style>
