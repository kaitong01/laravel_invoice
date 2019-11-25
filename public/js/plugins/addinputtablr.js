// Utility
if ( typeof Object.create !== 'function' ) {
	Object.create = function( obj ) {
		function F() {};
		F.prototype = obj;
		return new F();
	};
}

(function( $, window, document, undefined ) {

	var addinputtablr = {
		init: function (options, elem) {
            var self = this;

			self.options = options;
            self.$elem = $(elem);
            self.$btn = self.$elem.find('.addform');
            self.$delbtn = self.$elem.find('.delform');
            
                 self.$btn.click(function () {
                $( "#managetable" ).clone().find("input:text").val("").end().appendTo( "tbody" );  
            });
            
                self.$delbtn.click(function () {
                $( "#managetable" ).remove(); 
                delSum();
              
                
            });


        //         $(".price").keyup(function(){

        //     if(isNaN($(".price").val()))
        //     {
        //         alert('Please input price is number');
        //         $(".price").val('');
        //     }
            
        //     $("#sum").val(parseFloat($(".price").val()));
        // });

    //     $(".price").each(function() {

    //         $(this).keyup(function(){
    //             calculateSum();
    //         });
    //     });

    //     function calculateSum() {

    //     var sum = 0;
    //     //iterate through each textboxes and add the values
    //     $(".price").each(function() {

    //         //add only if the value is number
    //         if(!isNaN($(".price").val()) ) {
    //             sum += parseFloat($(".price").val());
    //         }

    //     });
    //     //.toFixed() method will roundoff the final sum to 2 decimal places
    //     $("#sum").val(sum.toFixed(2));
    // }

    $(document).ready(function(){

        //iterate through each textboxes and add keyup
        //handler to trigger sum event
        

            $(this).keyup(function(){
                calculateSum();
            });
        

    });

    function calculateSum() {

        var invoiceprice = 0;
        //iterate through each textboxes and add the values
        $(".price").each(function() {

            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                invoiceprice += parseFloat(this.value);
            }

        });
        //.toFixed() method will roundoff the final invoiceprice to 2 decimal places
        $("#invoiceprice").val(invoiceprice.toFixed(2));
    }

    function delSum() {

        var invoiceprice = 0;
        //iterate through each textboxes and add the values
        $(".price").each(function() {

            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                invoiceprice += parseFloat(this.value);

            }

        });
        //.toFixed() method will roundoff the final invoiceprice to 2 decimal places
        $("#invoiceprice").val(invoiceprice.toFixed(2));
    }
           
    

            
		},

        // _change: function () {
        //     let self = this;

        //     let val = self.$elem.val();
        //     self.$elem.removeClass('primary').removeClass('danger');


        //     switch ( parseInt(val)  ) {
        //         case 1:
        //             self.$elem.addClass('primary');
        //             break;

        //         case 2:
        //             self.$elem.addClass('danger');
        //             break;

        //         default:
        //             break;
        //     }
        // }
	};


	$.fn.addinputtablr = function( options ) {
		return this.each(function() {
			var $this = Object.create( addinputtablr );
			$this.init( options, this );
			$.data( this, 'addinputtablr', $this );
		});
	};

})( jQuery, window, document );
