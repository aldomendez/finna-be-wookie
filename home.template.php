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

<!-- {{>today}} -->
<div class="ui form">
    <div class="field">
        <label for="{{this.var+i}}">{{this.text}}</label>
        <input id = '{{this.var+i}}' type="text" value="{{this.value}}">
    </div>
</div>
<!-- {{/today}} -->

<!-- {{>dummy}} -->
<p>Elemento no disponible: "{{.dummy}}". Puedes escoger entre <code>{{ell}}</code></p>
<!-- {{/dummy}} -->