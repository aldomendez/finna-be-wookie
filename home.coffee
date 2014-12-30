q = {query:"--/text/Maquina de la que quieres saber las piezas por turno>machine\n--/today/Turno en el que se proceso el material....>dt-inicial\n--/shift/Final del rango de tiempo>dt-final\n\nselect * from lr4_shim_assembly where\nsystem_id = '{{machine}}'\nand process_date between '{{dt-inicial}}' and '{{dt-final}}'",name:"Prueba de formularios"}
re = ///
  ^--/       # Se diferencia de un comentario por la diagonal
  (\w*)      # Sigue una sola palabra para el tipo
  /(.*)      # Cualquier frase despues de la divicion
  >          # Asignamos a una variable
  ([-\w]*)   # que puede contener guiones
///gmi
elList = ['dummy','text','shift','today','yesterday']

class Day
  constructor: () ->
    @day = new Date()

  today:->
    @_today ?= do =>
      day = new Date(@day)
      day.setHours(0)
      day.setSeconds(0)
      day.setMinutes(0)
      day.setMilliseconds(0)
      return day
  todayYYYYMMDD:()->
    "#{@today().getFullYear()}#{@today().getMonth()}#{@today().getDate()}"
  yesterday:->
    @_yesterday ?= do =>
      day = new Date(@day)
      day.setDate(day.getDate()-1)
      day.setHours(0)
      day.setSeconds(0)
      day.setMinutes(0)
      day.setMilliseconds(0)
      return day
  yesterdayYYYYMMDD:()->
    "#{@yesterday().getFullYear()}#{@yesterday().getMonth()}#{@yesterday().getDate()}"



window.d = new Day()
window.r = new Ractive {
    el: '#container',
    template: '#template',
    data: {
        query: q
        queryToShow:''
        ell:elList
        fields:[]
    }
}
r.observe 'query.query', (input)->
    res = []
    while (marr = re.exec(input))?
      type =  if elList.indexOf(marr[1]) >= 0 then marr[1] else 'dummy'
      value = ''
      res.push {
        text:marr[2]
        var:marr[3]
        value: value
        type:type
        capturedType:marr[1]
      }
    console.log res
    r.set 'fields', res
  
r.observe 'query.query fields.*.value', (newValue, oldValue, keypath)->
    post = this.get('query.query')
    replaceElement = (element, index, array)->
        regex = new RegExp('{{'+element.var+'}}','g')
        post = post.replace(regex,element.value,'g')
    r.get('fields').forEach replaceElement
    this.set('queryToShow',post);
