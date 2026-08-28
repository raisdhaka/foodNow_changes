
<script type="text/javascript">
        "use strict";

        var currentUserEmail="{{ auth()->user()->email }}";

        plans.forEach(plan => {
            
            if(plan.paddle_id != null && user.subscription_plan_id != plan.paddle_id){
                var buttonName="{{__('Switch to ')}}"+plan.name;
                $('#button-container-plan-'+plan.id).append("<a href=\"/iyzicosubscribe/subscribe?plan_id="+plan.paddle_id+"&plan_name="+plan.name+"\" class=\"btn btn-primary\">"+buttonName+"</a>" );
            }
        });


    </script> 