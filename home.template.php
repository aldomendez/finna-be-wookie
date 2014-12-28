{{=[[ ]]=}}
<h1 class="ui header">Formularios reactivos</h1>
<p>El siguiente es un ejemplo, de lo que espero sea el futuro de las "Aplicaciones" que tengo en la planta. Con esto podremos enfocarnos a crear los querys y dejar claro las partes moviles, actualizar los querys en cuanto sea pertinente y todos sin salir de la pagina de desarrollo.</p>
<p>Simplemente hay que agregar el siguiente marcado para crear los formularios:</p>
    <p><code>--/tipo/descripcion>variable</code></p>
<p><b><code>tipo</code></b>: El tipo de campo que usaremos, puede ser cualquier tipo de campo del que se tenga un <i>template</i>, espero que los templates, sean lo suficientemente listos como para validar que sea un numero de serie valido, una etiqueta, o un turno. Que cuando sea un campo para ingresar muchos numeros de serie con el escanner que se genere un campo que automaticamente ponga comillas y comas a las entradas para que sean ingresadas al query. Para este demo, solamente tengo definidos 'texto','shift','dummy'. Siendo este ultimo el que se muestra cuando el campo que se ingreso no existe y ademas muestra la <i>pista</i> de lo que se puede usar. <code>shift</code> es un selector del 1-5, y <code>texto</code> es un campo de texto simple. <b>No puede tener espacios</b></p>
<p><b><code>descripcion</code></b>: Es el texto que aparece al lado del campo y puede ser cualquier parrafo, que describa que debe de ingresar el usuario. Por ejemplo: "Maquina", "Numero de serie", etc.</p>
<p><b><code>variable</code></b>: Es el texto que se buscara en el query para sustituir por los valores que ingrese el usuario. Puede contener espacios, pero no lo recomiendo. Dentro del query, se tiene que escribir entre dobles corchetes "<code>{{varieble}}</code>" para que sea sustituido</p>
[[={{ }}=]]
<div class="ui horizontal header divider">
    <i class="lab icon"></i>Que empieze el juego
</div>
<div class="ui form">
    <div class="field">
        <label for="query">Query</label>
        <textarea name="" id="query" cols="30" rows="10" value="{{query.query}}"></textarea>
    </div>

{{#each fields: i}}
    {{>this.type}}
{{/each}}
</div>
    
<pre>{{queryToShow}}</pre>
<!-- {{>shift}} -->
<div class="ui form">
    <div class="inline fields">
        <label for="{{this.var}}">{{this.text}}</label>
        <div class="field">
            <div class="ui radio checkbox">
                <input id="{{this.var+'1'}}" type="radio" name="{{this.value}}" value="1" checked="">
                <label for="{{this.var+'1'}}">1ro</label>
            </div>
        </div>
        <div class="field">
            <div class="ui radio checkbox">
                <input id="{{this.var+'2'}}" type="radio" name="{{this.value}}" value="2">
                <label for="{{this.var+'2'}}">2do</label>
            </div>
        </div>
        <div class="field">
            <div class="ui radio checkbox">
                <input id="{{this.var+'3'}}" type="radio" name="{{this.value}}" value="3">
                <label for="{{this.var+'3'}}">3ro</label>
            </div>
        </div>
        <div class="field">
            <div class="ui radio checkbox">
                <input id="{{this.var+'4'}}" type="radio" name="{{this.value}}" value="4">
                <label for="{{this.var+'4'}}">4to</label>
            </div>
        </div>
        <div class="field">
            <div class="ui radio checkbox">
                <input id="{{this.var+'5'}}" type="radio" name="{{this.value}}" value="5">
                <label for="{{this.var+'5'}}">5to</label>
            </div>
        </div>
    </div>
</div>  
<!-- {{/shift}} -->
<!-- {{>text}} -->
<div class="ui form">
    <div class="field">
        <label for="{{this.var+i}}">{{this.text}}</label>
        <input id = '{{this.var+i}}' type="text" value="{{this.value}}">
    </div>
</div>  
<!-- {{/text}} -->
<!-- {{>dummy}} -->
<p>Elemento no disponible: "{{.dummy}}". Puedes escoger entre <code>{{ell}}</code></p>   
<!-- {{/dummy}} -->