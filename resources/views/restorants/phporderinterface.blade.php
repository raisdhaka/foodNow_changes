<script>
   
    <?php

    //Make the clean function available
    function cleans($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
     
   
    $items=[];
    $categories = [];
    foreach ($restorant->categories as $key => $category) {

        array_push($categories, cleans(str_replace(' ', '', strtolower($category->name)).strval($key)));

        foreach ($category->items as $key => $item) {

            $formatedExtras=$item->extras;

            foreach ($formatedExtras as &$element) {
                $element->priceFormated=@money($element->price, config('settings.cashier_currency'),config('settings.do_convertion'))."";
            }

            //Now add the variants and optins to the item data
            $itemOptions=$item->options;

            $theArray=[
                'name'=>$item->name,
                'id'=>$item->id,
                'qty'=>$item->qty_management.""=="1"?$item->qty:100,
                'priceNotFormated'=>$item->price,
                'price'=>@money($item->price, config('settings.cashier_currency'),config('settings.do_convertion'))."",
                'image'=>$item->logom,
                'extras'=>$formatedExtras,
                'options'=>$item->options,
                'variants'=>$item->availlablevariants,
                'has_variants'=>$item->has_variants==1&&$item->options->count()>0,
                'description'=>$item->description
            ];
            echo "items[".$item->id."]=".json_encode($theArray).";";
        }
    }
    ?>
    var categories = <?php echo json_encode($categories); ?>;
</script>  