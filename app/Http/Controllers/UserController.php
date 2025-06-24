<?php

namespace App\Http\Controllers;
use App\Models\Order;
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
    $orders = Order::where('user_id', Auth::id())->get();
    return view('user.direccion-envio', compact('orders'));
}



  public function create()
    {
        return view('user.create-dir');
    }

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'phone' => 'required|numeric',
        'address' => 'required',
        'city' => 'required',
        'country' => 'required',
        'zip' => 'required',
    ]);

    Order::create([
        'user_id' => Auth::id(),
        'name' => $request->name,
        'phone' => $request->phone,
        'address' => $request->address,
        'city' => $request->city,
        'country' => $request->country,
        'zip' => $request->zip,
    ]);

    return redirect()->route('user.direccion-envio')->with('success', 'Dirección agregada correctamente.');
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
