/**
 * Created by jackmolnar1982 on 7/20/15.
 */

var costPerCharacter = +($('#costPerCharacter').text())*.01;

var description = $('job_description').html();

new Vue({
    el: '.job_create',

    data: {
        baseCost: 0,
        totalCost: 0,
        additionalCost: 0,
        characterCount: 0,
        freeCharacters: 0,
        description: description,
        costPerCharacter: 0
    },

    methods: {

        recalculate: function(){

            withoutSpace = this.description.replace(/ /g,"");
            this.characterCount = withoutSpace.length;


            if(this.characterCount > this.freeCharacters)
            {
                var additionalCharacters = this.characterCount - this.freeCharacters;

                this.additionalCost = additionalCharacters*this.costPerCharacter;

                this.totalCost = parseInt(this.baseCost) + this.additionalCost;
            } else {
                this.additionalCost = 0;
                this.totalCost = this.baseCost;
            }

            //cost = this.characterCount*this.costPerCharacter;
            //
            //if( cost > this.baseCost)
            //{
            //    this.additionalCost = cost - this.baseCost;
            //    this.totalCost = this.characterCount*this.costPerCharacter;
            //} else {
            //    this.totalCost = this.baseCost;
            //    this.additionalCost = 0;
            //}
        }
    },

    ready: function(){

        this.recalculate();

    }
});
