
module.exports = {
  methods: {

    objectSize: function (object) {
      return Object.keys(object).length;
    },

    isArray: function (obj) {
      return Array.isArray(obj);
    },

    getKeys: function (obj) {
      return Object.keys(obj);
    }
  }
};