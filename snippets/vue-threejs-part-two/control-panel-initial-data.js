import { mapGetters, mapMutations } from "vuex";
export default {
  data () {
    return {
      axisLinesVisible: true,
      pyramidsVisible: true
    };
  },
  computed: {
    ...mapGetters(["CAMERA_POSITION"])
  },
  // ...
}
