<template>
  <div class="messages">
    <el-row :gutter="20">
      <el-col :span="7">
        <div class="grid-content bg-purple message-f-f">
          <div class="message-list">
            <div class="list-header">Message List</div>
            <div class="list-body">
              <ul>
                <li v-for="(item, key) in 100" :key="key">
                  <el-image
                    style="width: 40px; height: 40px; border: 1px solid red; border-radius: 50%;"
                    src=""
                    fit="cover"
                  ></el-image>
                  <span>name</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </el-col>
      <el-col :span="17">
        <div class="grid-content bg-purple">
          <div class="body-message">
            <div class="name">
              <h4>{{ "Name here" }}</h4>
            </div>
            <div class="body-message-wrapper">
              <div class="messages-list">
                <ul>
                  <li
                    v-for="(item, key) in 20"
                    :key="key"
                    class="messages-item"
                    :class="key % 2 == 0 ? 'pos-right' : 'pos-left'"
                  >
                    <div class="messages-item-wrapper">
                      <p>
                        message content
                        asdsadsadsadsawwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwweqweqwewwwwwwwwwwwwwwwwwwwww
                      </p>
                      <div class="dt">
                        <span>2021-02-06</span>
                        <span>10:32:23 AM</span>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-message">
            <div class="input-f">
              <el-input
                type="textarea"
                :rows="2"
                placeholder="Please input message"
                v-model="message"
              >
              </el-input>
            </div>
            <div class="button-f">
              <el-image
                style="width: 50px; height: 50px"
                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAMAAAAPdrEwAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAC6FBMVEX////+/v79/f3c3Nza2trb29ve3t7d3d38+/zX19f6+vra2tra2tra2tra2tra2tra2tra2tra2tra2tra2trb29vb29vb29vb29vb29vb29vb29vb29vb29vb29vb29vb29vb29vb29vb29vb29vc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzd3d3c3Nzc3Nzc3Nzc3Nzd3d3d3d3d3d3c3Nzc3Nzc3Nze3t7d3d3d3d3c3Nzc3Nzc3Nzc3Nze3t7e3t7e3t7c3Nzc3Nzc3Nzc3Nze3t7e3t7c3Nzc3Nze3t7e3t7c3Nzc3Nzc3Nzc3Nzd3d3c3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3NzX19fc3Nzc3Nzc3Nzc3Nzc3Nze3t7X19fc3Nzc3Nze3t7c3Nzc3Nzc3Nze3t7c3Nzc3Nze3t7X19fc3Nzc3NzX19fc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzd3d3d3d3c3Nzc3Nzd3d3d3d3d3d3c3Nzc3Nzc3Nzd3d3d3d3d3d3c3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nza2trb29vc3Nzd3d3e3t7X19f////1XJ3wAAAA8XRSTlMAAAAAAAAAAAAAAAFClbinP0DN/DYqs2odnf0/EIj2/g8Gc+vdAlzhrUjOfTK8TCKm/hsUkPnqCnvwugRl5opR1Vk5xSmu9AMZmfvi9ccOhNSXBm7rZgHb1jTuNkLM2L78CTC32Rp1HqL92qMTjPjcHHMJdu/dHZJDAmLh3h5GE0vU4B84vyGxJKv+Y4AXlfrj81AMf+QlyCBq5+UmflQnNz/ojhuy6SqcXg7bKy1lLuz3Vy/LBrZsmwJY9msYw+8zzzpwxnRBI3jPEKgmfdTxpXcrgNg7WkepPcB4tjERSfhg8qRik9+fVnFXds0+0m2hZzI+ugAAAAFiS0dEAIgFHUgAAAAHdElNRQfkChAJNi2YukqFAAAAAW9yTlQBz6J3mgAAACV0RVh0ZGF0ZTpjcmVhdGUAMjAyMC0xMC0xNlQwOTo1NDo0NSswMDowMJSX2J4AAAAldEVYdGRhdGU6bW9kaWZ5ADIwMjAtMTAtMTZUMDk6NTQ6NDMrMDA6MDCGGlUYAAADtElEQVRYw+3WZ1gTMRgHcDAW3HvvhRMHVZGCyhBFLYoyqqAyHeAE90bFgQMXDsQ9cU8UVATFvXHvvbeS1s+m7dVe75LrXe/weXye/j9xIe+PkKZvzsbGGmus+XexRSlEi/ZZMhwwIuG6CzNSEHTxEiVLlS5TEHTZcr9QyleQkJbpUrFSvj6VJaarVK1GyfnVRVDMEyGT1ahZywDn164j4qQw6br16ucb00AmGe3QsBGkp7GY820iN2kKTdNMItqxOWSmhSR0y1ZOLBnKJaBbt2nLhqGzqF6iq2vnooC4uAqiATtu7TtAfDqKpN09ICmeomivTpAcbxG0d2cOGHbxsZju2q07i1P6Gn/uIey2MU7u6deFvdBerrSH3pbR/gGBmC3wCKA/BVlCqzz74Da3b3AI/bEfP9pOF3sUNK//AOzHFioPoz+GRwimI6PwB2LgoMGm+w4E0kOiY/DyUHmkaR8ZJowePmIk4RCPio1gfC3jhNCjx4xVq/HyuPFgAmNoIn960uQpajWBnjoNTGf263je9IyZGg2JnpUA4pntTwkIdCEGPXuORkOkG80FgNVN5pHoIsCuqPEXifMXqPXBrVnZEoCFrNFFJLoYjU5avASqyfTSRPS3l7GGl5unk1doy8j0ylXoolnNHk8xR7utSdVNJNJr16FZ69lyCOCmVRsMbYhEp25EdZvYfRuGcdObe/ydSaC3aO+oZFwb3MpFb9tOm4mnd6Rpy3bijs0uDnr3HmiOdt6rrXLHyXAfB73/tzna+YC2qOtBnHzIjYM+bI4OPKK7cKKwi04HHPTRY9z0wUhdTQZWhplctN3xE2HhZDrEUVeSdhJPZ3HS6FyfysiOwdM5p3UV/mfwMsw1R6PEnj3nxKYVwfqKjgQ5JplM0ztfwvl0Bq2g3gMuEO5JGAr40SgXL12m0Qov/egVJUGGVzlo5lVgb3/t+g2KvmnYyDySDG9x0LYsGuX2nbuobNk9avp9ogwfcNA2OBpl88OcR4aPIIdMJ1lAo/NGTfZ5TJY7AItoQ56QZfhUFP2sLQftJ4p+HjeKTG8QtyHA4cW8lwQ6UQjNDPWdeRW1BCO/VomiVbn6pcUH0fojlWwgin6D3m2i387Vlhn7I5V34mhKef/ho/a/j/20mvaiel8SGuWzvjjly1dqwDlCIjr829/6VS7f0YDvdCAN7dTehNgXkCUHEtFnAa9YQLvwky2g/XjKwuk2fGXBdKaqoOg8H96yIPqH8qcAWXjn+99oa6yxpoDzB32sVcYsHekFAAAAWmVYSWZNTQAqAAAACAAFARIAAwAAAAEAAQAAARoABQAAAAEAAABKARsABQAAAAEAAABSASgAAwAAAAEAAgAAAhMAAwAAAAEAAQAAAAAAAAAAAEgAAAABAAAASAAAAAEfUvc0AAAAAElFTkSuQmCC"
                @click="setMessageBy()"
                fit="cover"
              ></el-image>
            </div>
          </div>
        </div>
      </el-col>
    </el-row>
  </div>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      message: ""
    };
  },
  methods: {},
  props: {},
  created() {}
};
</script>

<style lang="scss">
.messages {
  height: 100%;
  .el-row {
    height: 100%;
  }
  .grid-content.message-f-f {
    height: 450px;
  }
  .grid-content {
    border: 1px solid red;
    height: 550px;
    border-radius: 3px;

    .message-list {
      height: 100%;
      overflow: hidden;
      max-height: 450px;
      .list-header {
        border-bottom: 1px solid #000;
        height: 30px;
        line-height: 30px;
      }
      .list-body {
        height: calc(100% - 30px);
        overflow: hidden;
      }
      .list-body ul {
        height: 100%;
        overflow-y: auto;
        padding: 5px 5px;
      }
      .list-body ul li {
        text-align: left;
        display: flex;
        align-items: center;
        margin-bottom: 10px;
      }

      .list-body ul li span {
        margin-left: 10px;
      }
    }

    .body-message {
      height: calc(100% - 80px);
      overflow: hidden;
      .name {
        height: 40px;
        line-height: 40px;
        border-bottom: 1px solid #000;
      }
      .messages-list {
        height: 100%;
        overflow: hidden;
        padding: 10px 10px;
      }
      .messages-list ul {
        height: 100%;
        overflow-y: auto;
        padding-bottom: 50px;
      }

      .messages-list ul li {
        margin-bottom: 10px;
      }
      .messages-item {
        text-align: left;
        .messages-item-wrapper {
          border: 1px solid #000;
          overflow: hidden;
          width: 60%;
          padding: 10px 10px;
          border-radius: 30px;
        }
        .messages-item-wrapper p {
          word-break: break-all;
          padding-bottom: 10px;
        }
        .messages-item-wrapper .dt {
          span {
            display: block;
            font-size: 12px;
          }
        }
      }

      .messages-item.pos-right {
        display: flex;
        justify-content: flex-end;

        .messages-item-wrapper {
          border-bottom-right-radius: 0px;
        }
        span {
          text-align: right;
        }
      }

      .messages-item.pos-left {
        .messages-item-wrapper {
          border-bottom-left-radius: 0px;
        }
        span {
          text-align: left;
        }
      }
    }
    .body-message .body-message-wrapper {
      height: 100%;
      overflow: hidden;
    }
    .footer-message {
      border-top: 1px solid #000;
      height: 80px;
      display: flex;
    }
    .footer-message .input-f {
      flex: 8;
      padding: 10px;
    }
    .footer-message .button-f {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
    }
  }
}
</style>
