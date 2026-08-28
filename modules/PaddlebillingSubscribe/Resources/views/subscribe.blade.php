<script src="https://cdn.paddle.com/paddle/v2/paddle.js"></script>
<script type="text/javascript">
        "use strict";
        var token="{{ config('paddlebilling-subscribe.token')}}";
        var currentUserEmail="{{ auth()->user()->email }}";
        var currentUserID="{{ auth()->user()->id }}";
        Paddle.Setup({ token:token,
            eventCallback: function(data) {
                console.log(data);
            }
        });
        Paddle.Environment.set("production");

        function openCheckout(product_id) {
            var form = document.getElementById('pre-checkout');
        
            Paddle.Checkout.open({
                settings: {
                        displayMode: "overlay",
                        theme: "light",
                        locale: "en"
                    },
                items: [
                    {
                        priceId: product_id,
                        quantity: 1
                    }
                ],
                customer:{
                    email: currentUserEmail
                },
                customData: {
                    email: currentUserEmail,
                    user_id: currentUserID
                },
            });
        }

        plans.forEach(plan => {
         
            
            if(plan.paddle_id != null && user.subscription_plan_id != plan.paddle_id){
                var buttonName="{{__('Switch to ')}}"+plan.name;
                $('#button-container-plan-'+plan.id).append("<a href=\"javascript:openCheckout(\'"+plan.paddle_id+"\')\" class=\"btn btn-primary\">"+buttonName+"</a>" );
            }
        });


    </script> 