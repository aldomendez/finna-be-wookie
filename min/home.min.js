(function() {
  var Day, elList, q, re;

  q = {
    query: "--/text/Maquina de la que quieres saber las piezas por turno>machine\n--/today/Turno en el que se proceso el material....>dt-inicial\n--/shift/Final del rango de tiempo>dt-final\n\nselect * from lr4_shim_assembly where\nsystem_id = '{{machine}}'\nand process_date between '{{dt-inicial}}' and '{{dt-final}}'",
    name: "Prueba de formularios"
  };

  re = /^--\/(\w*)\/(.*)>([-\w]*)/gmi;

  elList = ['dummy', 'text', 'shift', 'today', 'yesterday'];

  Day = (function() {
    function Day() {
      this.day = new Date();
    }

    Day.prototype.today = function() {
      return this._today != null ? this._today : this._today = (function(_this) {
        return function() {
          var day;
          day = new Date(_this.day);
          day.setHours(0);
          day.setSeconds(0);
          day.setMinutes(0);
          day.setMilliseconds(0);
          return day;
        };
      })(this)();
    };

    Day.prototype.todayYYYYMMDD = function() {
      return "" + (this.today().getFullYear()) + (this.today().getMonth()) + (this.today().getDate());
    };

    Day.prototype.yesterday = function() {
      return this._yesterday != null ? this._yesterday : this._yesterday = (function(_this) {
        return function() {
          var day;
          day = new Date(_this.day);
          day.setDate(day.getDate() - 1);
          day.setHours(0);
          day.setSeconds(0);
          day.setMinutes(0);
          day.setMilliseconds(0);
          return day;
        };
      })(this)();
    };

    Day.prototype.yesterdayYYYYMMDD = function() {
      return "" + (this.yesterday().getFullYear()) + (this.yesterday().getMonth()) + (this.yesterday().getDate());
    };

    return Day;

  })();

  window.d = new Day();

  window.r = new Ractive({
    el: '#container',
    template: '#template',
    data: {
      query: q,
      queryToShow: '',
      ell: elList,
      fields: []
    }
  });

  r.observe('query.query', function(input) {
    var marr, res, type, value;
    res = [];
    while ((marr = re.exec(input)) != null) {
      type = elList.indexOf(marr[1]) >= 0 ? marr[1] : 'dummy';
      value = '';
      res.push({
        text: marr[2],
        "var": marr[3],
        value: value,
        type: type,
        capturedType: marr[1]
      });
    }
    console.log(res);
    return r.set('fields', res);
  });

  r.observe('query.query fields.*.value', function(newValue, oldValue, keypath) {
    var post, replaceElement;
    post = this.get('query.query');
    replaceElement = function(element, index, array) {
      var regex;
      regex = new RegExp('{{' + element["var"] + '}}', 'g');
      return post = post.replace(regex, element.value, 'g');
    };
    r.get('fields').forEach(replaceElement);
    return this.set('queryToShow', post);
  });

}).call(this);
