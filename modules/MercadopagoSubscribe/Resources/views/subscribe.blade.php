<script src="https://sdk.mercadopago.com/js/v2"></script>

<script type="text/javascript">
    
    const PK="<?php echo config('mercadopago-subscribe.public_key'); ?>";
    alert(PK);
    const mp = new MercadoPago(PK);

    function updateSubscribtion(subscriptionID, planID){    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url: '/paypalsubscribe/subscribe',
            dataType: 'json',
            data: {
                subscriptionID: subscriptionID,
                planID: planID
            },
            success:function(response){
                if(response.status){
                    location.replace(response.success_url);
                    //window.location.reload();
                }
            }, error: function (response) {
            }
        })
    }


        plans.forEach(plan => {
            
            if((plan.paypal_id!=null&&plan.paypal_id!="") && user.paypal_subscribtion_id != plan.paypal_id){
                mp.checkout({
            tokenizer: {
                totalAmount: 4000,
                summary: {
                    arrears: 18,
                    taxes: 20,
                    charge: 30,
                    discountLabel: 'discount label',
                    discount: 5,
                    productLabel: 'product label',
                    product: 400,
                    shipping: 10,
                    title: 'summary title',
                },
                installments: {
                    minInstallments: 2,
                    maxInstallments: 9,
                },
                backUrl: 'http://YOUR_URL/process'
            },
            theme: {
                elementsColor: '#2ddc52',
                headerColor: '#2ddc52'
            }
        }).render({
            container: '#button-container-plan-'+plan.id,
            label: 'Pagar'
        });

            }
        });
 

</script>