import { mixin as clickaway } from 'vue-clickaway';

export default {
  mixins: [ clickaway ],
  template: '<p v-on-clickaway="away">Click away</p>',
  methods: {
    away: function() {
      console.log('clicked away');
    },
  },
};