<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Address;
use App\Models\OrderItem;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function orders()
    {
    $orders = Order::where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->paginate(10);
    return view('user.orders',compact('orders'));
    }

    public function order_details($order_id)
{
        $order = Order::where('user_id',Auth::user()->id)->where('id',$order_id)->first();    
        if($order)
        {
        $orderItems = OrderItem::where('order_id',$order->id)->orderBy('id')->paginate(12);    
         $transaction = Transaction::where('order_id',$order->id)->first();
        return view('user.order-details',compact('order','orderItems','transaction'));
        }
        else
        {
            return redirect()->route('login');
        }
}

public function order_cancel(Request $request)
    {
    $order = Order::find($request->order_id);
    $order->status = "canceled";
    $order->canceled_date = Carbon::now();
    $order->save();
    return back()->with("status", "La orden ha sido Cancelado Exitosamente!");
    }

public function direccionEnvio()
{
     $addresses = Address::where('user_id', Auth::id())->get(); 
    return view('user.direccion-envio', compact('addresses'));
}



  public function create()
    {
        return view('user.create-dir');
    }

public function store(Request $request)
{
    $user_id = Auth::user()->id;
    $request->validate([
         'name' => 'required|max:100',
            'phone' => 'required|numeric|digits:10',
            'zip' => 'required|numeric|digits:5',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'locality' => 'required',
            'landmark' => 'required', 
    ]);

    $address = new Address();
        $address->name = $request->name; 
        $address->phone = $request->phone;
        $address->zip = $request->zip;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->address = $request->address;
        $address->locality = $request->locality;
        $address->landmark = $request->landmark;
        $address->country = 'México';
        $address->user_id = $user_id;
        $address->isdefault = true;
        $address->save();
    

    return redirect()->route('user.direccion')->with('success', 'Dirección agregada correctamente.');
}

public function destroy($id)
{
    $address = Address::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
    $address->delete();

    return redirect()->route('user.direccion')->with('success', 'Dirección eliminada correctamente.');
}

    public function order_reciente()
{
    $orders = Order::where('user_id', Auth::id())
                   ->orderBy('created_at', 'desc')
                   ->take(3)
                   ->get();

    return view('user.ped-recientes', compact('orders'));
}


}
