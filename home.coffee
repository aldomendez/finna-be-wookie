q = {query:"--/text/Maquina de la que quieres saber las piezas por turno>turno\n--/shift/Turno en el que se proceso el material....>dt-inicial\n--/shift/Final del rango de tiempo>dt-final\n\nselect * from lr4_shim_assembly where\nsystem_id = '{{turno}}'\nand process_date between '{{dt-inicial}}' and '{{dt-final}}'",name:"Prueba de formularios"}
re = ///
  ^--/       # Se diferencia de un comentario por la diagonal
  (\w*)      # Sigue una sola palabra para el tipo
  /(.*)      # Cualquier frase despues de la divicion
  >          # Asignamos a una variable
  ([-\w]*)   # que puede contener guiones
///gmi
elList = ['dummy','text','shift']
r = new Ractive {
    el: '#container',
    template: '#template',
    data: {
        query: q
        queryToShow:''
        ell:elList
        fields:[]
    }
}
r.observe 'query.query', (value)->
    res = []
    while (marr = re.exec(value))?
        type =  if elList.indexOf(marr[1]) >= 0 then marr[1] else 'dummy'
        res.push {type:type,text:marr[2],var:marr[3],value:"",dummy:marr[1]}
    r.set 'fields', res
  
r.observe 'query.query fields.*.value', (newValue, oldValue, keypath)->
    post = this.get('query.query')
    replaceElement = (element, index, array)->
        regex = new RegExp('{{'+element.var+'}}','g')
        post = post.replace(regex,element.value,'g')
    r.get('fields').forEach replaceElement
    this.set('queryToShow',post);
