<?php


class Invoice {
    public int $idInvoice;
    public DateTime $dateInvoice;
    public array $invoiceDetails;
   
}


class InvoiceDetail {
    public int $idInvoiceDetail;
    public int $idProduct;
    public int $price; // or decimal
    
}

function InvoiceFactory() {
    return ['idInvoice'=>null,'dateInvoice'=>null,'invoiceDetails'=>[]];
}
function InvoiceDetailFactory() {
    return ['idInvoiceDetail'=>null,'idProduct'=>null,'price'=>null];
}

$obj=InvoiceFactory();
$obj['invoiceDetails']=[InvoiceDetailFactory(),InvoiceDetailFactory()];




$obj=new Invoice();
$obj->dateInvoice=new DateTime();
$obj->invoiceDetails=[new InvoiceDetail(),new InvoiceDetail()];

var_dump(unserialize(serialize($obj)));
echo "<br>";

$obj2=objectToObject(json_decode( json_encode($obj)),'Invoice');

var_dump( $obj2);


function objectToObject($instance, $className) {
    return unserialize(sprintf(
        'O:%d:"%s"%s',
        strlen($className),
        $className,
        strstr(strstr(serialize($instance), '"'), ':')
    ));
}
