(function ($) {
  $.fn.extend({
    cookieList: function (cookieName) {
      return {
        add: function (val) {
          var array = this.items();
          if(typeof(this.hasitem(val))== "undefined"){
            array.push(val);
            if(array.length > 5)
              array = array.splice(1,5);
            var inStr = JSON.stringify(array);
            $.cookie(cookieName, inStr, { expires: 1, path: '/' });
          }else{
          }
        },
        remove: function (idx) {
          var items = this.items();
          var index = items.indexOf(idx);
          if (index != -1) {
            items.splice(index, 1);
            $.cookie(cookieName, items.join(','), { expires: 1, path: '/' });
          }
        },
        indexOf: function (idx) {
          for(var i = 0; i < cookieList.length(); i++) {
            if(cookieList.items()[i].idx == idx)
              return i;
          }
        },
        clear: function () {
          $.cookie(cookieName, "", { expires: 1, path: '/' });
        },
        items: function () {
          var cookie = $.cookie(cookieName);
          return cookie ? JSON.parse(cookie):[];
        },
        hasitem: function (val){
          for (var k in this.items()){
            var entry1 = JSON.stringify(this.items()[k]);
            var val1 = JSON.stringify(val);
            if(val1 == entry1){
              return k;
            }
          }
        },
        length: function () {
          return this.items().length;
        },
      };
    }
  });
})(jQuery);
