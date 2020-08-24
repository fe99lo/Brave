// Add all your JS here
<script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>
<script type="text/babel">
function student(name, ...john) {
    console.log(name);
    console.log(john); 
}
student('myname', 10, 20, 30, 40, 50);
</script>
<script>
var friends = ['John', 'Tim', 'Jimmy', 'Carson'];

console.log (friends[0]);
console.log (friends[1]);
console.log (friends[2]);
console.log (friends[3]);
</script>
<script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="{{ key }}" data-description="Payment: {{ course.course_title }}" data-amount="{% multiply design.design_price 100 %}" data-locale="auto"> </script>
<script
# Send the charge to Stripe charge = stripe.Charge.create( amount=amount, currency=currency, description=f"Payment for the design: {designTitle}", source=self.request.POST['stripeToken'] )

<script type="text/javascript">

   <!--

      // Form validation code will come here.

      function validate()

      {

     

         if( document.myForm.Name.value == "" )

         {

            alert( "Please provide your name!" );

            document.myForm.Name.focus() ;

            return false;

         }

        

         if( document.myForm.EMail.value == "" )

         {

            alert( "Please provide your Email!" );

            document.myForm.EMail.focus() ;

            return false;

         }

        

         if( document.myForm.Zip.value == "" ||

         isNaN( document.myForm.Zip.value ) ||

         document.myForm.Zip.value.length != 5 )

         {

            alert( "Please provide a zip in the format #####." );

            document.myForm.Zip.focus() ;

            return false;

         }

        

         if( document.myForm.Country.value == "-1" )

         {

            alert( "Please provide your country!" );

            return false;

         }

         return( true );

      }

   //-->

</script>


