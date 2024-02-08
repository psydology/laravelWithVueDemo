<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function getallinvoices()
    {
        $inv = Invoice::with('customers')->get();
        return response()->json([
            'invoice' => $inv
        ], 200);
    }

    public function search(Request $request)
    {
        $item = $request->get('s');
        if ($item != null)
        {
             $search = Invoice::with('customers')->where('id' , 'LIKE' , "%$item%")->get();
        return response()->json([
            'invoice' => $search
        ], 200);
        }else{
            return $this->getallinvoices();
        }

    }


    public function create()
    {
        $counter = Counter::where('key' , 'Invoice')->first();
        //$random = Counter::where('key' , 'Invoice')->first();
        $invoice = Invoice::orderBy('id' , 'DESC')->first();
        if($invoice)
        {
            $invoice = $invoice->id + 1 ;
            $counters = $counter->value + $invoice;
        }else{
            $counters = $counter->value ;
        }
        $formData = [
            'number' => $counter->prefix.$counters,
            'customer_id' => null,
            'customers' => null,
            'date' => date('Y-m-d'),
            'due_date' => null,
            'discount' => 0,
            'referance' => null,
            'terms_conditions' => 'default terms and conditions',
            'items' => [
                'product_id' => null,
                'product' => null,
                'unit_price' => 0,
                'quantity' => 1
            ]
        ];
        return response()->json($formData);

    }

    public function addinvoice(Request $request)
    {
        $invoiceItem = $request->input('invoice_item');

        $invoiceData['sub_total'] = $request->input('subtotal');
        $invoiceData['total'] = $request->input('total');
        $invoiceData['customer_id'] = $request->input('customer_id');
        $invoiceData['number'] = $request->input('number');
        $invoiceData['date'] = $request->input('date');
        $invoiceData['due_date'] = $request->input('due_date');
        $invoiceData['discount'] = $request->input('discount');
        $invoiceData['referance'] = $request->input('referance');
        $invoiceData['terms_conditions'] = $request->input('terms_conditions');

        $invoice = Invoice::create($invoiceData);

        foreach(json_decode($invoiceItem) as $item)
        {
            $itemData['product_id'] = $item->id;
            $itemData['invoice_id'] = $invoice->id;
            $itemData['quantity'] = $item->quantity;
            $itemData['unit_price'] = $item->unit_price;

            $invItem = InvoiceItem::create($itemData);
        }
    }

    public function getinvoice($id)
    {
        $invoice = Invoice::with(['customers' , 'items.products'])->find($id);
        return response()->json([
            'invoice' => $invoice
        ], 200);
    }
}
