(function() {
  var elList, q, r, re;

  q = {
    query: "--/text/Maquina de la que quieres saber las piezas por turno>turno\n--/shift/Turno en el que se proceso el material....>dt-inicial\n--/shift/Final del rango de tiempo>dt-final\n\nselect * from lr4_shim_assembly where\nsystem_id = '{{turno}}'\nand process_date between '{{dt-inicial}}' and '{{dt-final}}'",
    name: "Prueba de formularios"
  };

  re = /^--\/(\w*)\/(.*)>([-\w]*)/gmi;

  elList = ['dummy', 'text', 'shift'];

  r = new Ractive({
    el: '#container',
    template: '#template',
    data: {
      query: q,
      queryToShow: '',
      ell: elList,
      fields: []
    }
  });

  r.observe('query.query', function(value) {
    var marr, res, type;
    res = [];
    while ((marr = re.exec(value)) != null) {
      type = elList.indexOf(marr[1]) >= 0 ? marr[1] : 'dummy';
      res.push({
        type: type,
        text: marr[2],
        "var": marr[3],
        value: "",
        dummy: marr[1]
      });
    }
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
