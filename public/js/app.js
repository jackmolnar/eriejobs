/**
 * Created by jackmolnar1982 on 7/20/15.
 */

var costPerCharacter = +($('#costPerCharacter').text())*.01;

var description = $('job_description').html();

new Vue({
    el: '.job_create',

    data: {
        totalCost: 100,
        characterCount: 0,
        description: description
    },

    methods: {

        recalculate: function(){

            withoutSpace = this.description.replace(/ /g,"");
            this.characterCount = withoutSpace.length;

            cost = this.characterCount*costPerCharacter;

            this.totalCost = cost > 100 ? this.characterCount*costPerCharacter : 100;
        }
    },

    ready: function(){

        this.recalculate();

    }
});
