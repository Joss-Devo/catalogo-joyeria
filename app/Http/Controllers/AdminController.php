<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }
    public function index()
    {
        return view('admin.index');
    }

    public function brands()
    {
        $brands = Brand::orderBy('id','DESC')->paginate(10);
        return view('admin.brands',compact('brands'));
    }

    public function add_brand()
    {
        
        return view('admin.brand-add');
    }

   public function brand_store(Request $request)
    {
        $request->validate([
        'name' => 'required',
        'slug' => 'required|unique:brands,slug',
        'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $image = $request->file('image');
       if ($request->hasFile('image')) {
            $file_extention = $request->file('image')->extension();
        } else {
            return back()->with('error', 'No se ha subido ninguna imagen.');
        }
        
        $file_extention = $request->file('image')->extension(); 
        $file_name = Carbon::now()->timestamp.'.'.$file_extention; 
        $this->GenerateBrandThumbailsImage($image,$file_name);
        $brand->image = $file_name; 
        $brand->save();
        return redirect()->route('admin.brands')->with('status','ha sido agregado exitosamente!'); 
    }



   

public function brand_edit($id)
{
    $brand = Brand::find($id);
    return view('admin.brand-edit',compact('brand'));
}

public function brand_update(Request $request) 
{
    $request->validate([
        'name' => 'required',
        'slug' => 'required|unique:brands,slug,'.$request->id,
        'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);
        $brand = Brand::find($request->id);
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        if($request->hasFile('image')){
            if(File::exists(public_path('uploads/brands').'/'.$brand->image))
            {
                File::delete(public_path('uploads/brands').'/'.$brand->image);
            }
            $image = $request->file('image');
            $file_extention = $request->file('image')->extension();
            $file_name = Carbon::now()->timestamp.'.'.$file_extention;
            $this->GenerateBrandThumbailsImage($image,$file_name);
            $brand->image = $file_name;
        }
        
        $brand->save();
        return redirect()->route('admin.brands')->with('status','ha sido actualizado exitosamente!');
}

    public function GenerateBrandThumbailsImage($image, $imageName) 
    {
        $destinationPath = public_path('uploads/brands');
        $img = Image::read($image->path());
        $img ->cover(124,124,"top");
        $img->resize(124,124,function($constraint){
            $constraint->aspectRatio();
        
        })->save($destinationPath.'/'.$imageName);
    }

    public function brand_delete($id)
    {
        $brand = Brand::find($id);
        
            if(File::exists(public_path('uploads/brands').'/'.$brand->image))
            {
                File::delete(public_path('uploads/brands').'/'.$brand->image);
            }
            $brand->delete();
        return redirect()->route('admin.brands')->with('status','ha sido eliminado exitosamente!');
    }

    public function categories()
    {
        $categories = Category::orderBy('id','DESC')->paginate(10);
        return view ('admin.categories',compact('categories'));
    } 

    public function category_add()
    {
        
        return view ('admin.category-add');
    } 


    public function category_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug',
            'image' => 'mimes:png,jpg,jpeg|max:2048'
            ]);
    
            $category = new Category();
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $image = $request->file('image');
            if ($request->hasFile('image')) {
                $file_extension = $request->file('image')->extension();
            } else {
                return back()->with('error', 'No se ha subido ninguna imagen.');
            }
            
            $file_extention = $request->file('image')->extension();
            $file_name = Carbon::now()->timestamp.'.'.$file_extention;
            $this->GenerateCategoryThumbailsImage($image,$file_name);
            $category->image = $file_name;
            $category->save();
            return redirect()->route('admin.categories')->with('status','ha sido agregado exitosamente!'); 
    }

    public function GenerateCategoryThumbailsImage($image, $imageName) 
    {
        $destinationPath = public_path('uploads/categories');
        $img = Image::read($image->path());
        $img ->cover(124,124,"top");
        $img->resize(124,124,function($constraint){
            $constraint->aspectRatio();
        
        })->save($destinationPath.'/'.$imageName);
    }

    public function category_edit($id)
    {
        $category = Category::find($id);
        return view ('admin.category-edit',compact('category'));
    }

    public function category_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$request->id,
            'image' => 'mimes:png,jpg,jpeg|max:2048'
            ]);
            $category = Category::find($request->id);
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            if($request->hasFile('image')){
                if(File::exists(public_path('uploads/categories').'/'.$category->image))
                {
                    File::delete(public_path('uploads/categories').'/'.$category->image);
                }
                $image = $request->file('image');
                $file_extention = $request->file('image')->extension();
                $file_name = Carbon::now()->timestamp.'.'.$file_extention;
                $this->GenerateCategoryThumbailsImage($image,$file_name);
                $category->image = $file_name;
            }
            
            $category->save();
            return redirect()->route('admin.categories')->with('status','la Categoría ha sido actualizada exitosamente!');
    }

    public function category_delete($id)
    {
        $category = Category::find($id);
        
            if(File::exists(public_path('uploads/categories').'/'.$category->image))
            {
                File::delete(public_path('uploads/categories').'/'.$category->image);
            }
            $category->delete();
        return redirect()->route('admin.categories')->with('status','ha sido eliminado exitosamente!');
    }

    public function products()
    {
        $products = Product::orderBy('created_at','DESC')->paginate(10);
        return view ('admin.products',compact('products'));
    } 

    public function product_add()
    {
        $categories = Category::select('id','name')->orderBy('name')->get();
        $brands = Brand::select('id','name')->orderBy('name')->get();
        return view ('admin.product-add',compact('categories','brands'));
    }

   public function product_store(Request $request)
    {
        $request->validate([
        'name' =>'required',
        'slug' =>'required|unique:products,slug',
        'short_description' =>'required',
        'description' =>'required',
        'regular_price' =>'required',
        'sale_price' =>'required',
        'SKU' =>'required',
        'stock_status' =>'required',
        'featured' =>'required',
        'quantity' =>'required',
        'image' =>'required|mimes:png,jpg,jpeg|max:2048',
        'category_id'=>'required',
        'brand_id'=>'required'
        ], [
    'image.required' => 'No ha agregado la imagen principal del producto.',
    ]);
    

        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->SKU = $request->SKU;
        $product->stock_status = $request->stock_status;
        $product->featured = $request->featured;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        $current_timestamp = Carbon::now()->timestamp;

        if($request ->hasFile('image'))
        {
            $image = $request->file ('image');
            $imageName = $current_timestamp .'.'.$image->extension();
            $this->GenerateProductThumbnailImage($image,$imageName);
            $product -> image = $imageName;
        }
    
        $gallery_arr = array();
        $gallery_images = "";
        $counter = 1;

        if($request->hasFile('images'))
        {
            $allowedfileExtion = ['jpg','png','jpeg'];
            $files =$request->file('images');
            foreach($files as $file)
            {
             $gextension = $file->getClientOriginalExtension();
             $gcheck = in_array($gextension, $allowedfileExtion);
             if($gcheck)
             {
                $gfileName = $current_timestamp .".". $counter .".". $gextension;
                $this->GenerateProductThumbnailImage($file,$gfileName);
                array_push($gallery_arr,$gfileName);
                $counter = $counter + 1;
             }

            }
            $gallery_images = implode(',',$gallery_arr);
        }
        $product->images = $gallery_images;
        $product->save();
        return redirect()->route('admin.products')->with('status','El producto ha sido agregado exitosamente!');
    } 

    public function GenerateProductThumbnailImage($image, $imageName)
    {
        $destinationPathThumbnail = public_path('uploads/products/thumbnails');
        $destinationPath = public_path('uploads/products');
        $img = Image::read($image->path());

        $img ->cover(540,689,"top");
        $img->resize(540,689,function($constraint){
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$imageName);

        $img->resize(104,104,function($constraint){
            $constraint->aspectRatio();
        })->save($destinationPathThumbnail.'/'.$imageName);
    }

    public function product_edit($id)
    {
        $product = Product::find($id);
        $categories = Category::select('id','name')->orderBy('name')->get();
        $brands = Brand::select('id','name')->orderBy('name')->get();
        return view('admin.product-edit',compact('product','categories','brands'));
    }

   public function product_update(Request $request)
   {
    $request->validate([
        'name' =>'required',
        'slug' =>'required|unique:products,slug,'.$request->id,
        'short_description' =>'required',
        'description' =>'required',
        'regular_price' =>'required',
        'sale_price' =>'required',
        'SKU' =>'required',
        'stock_status' =>'required',
        'featured' =>'required',
        'quantity' =>'required',
        'image' =>'mimes:png,jpg,jpeg|max:2048',
        'category_id'=>'required',
        'brand_id'=>'required'
    ]);

        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->SKU = $request->SKU;
        $product->stock_status = $request->stock_status;
        $product->featured = $request->featured;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        $current_timestamp = Carbon::now()->timestamp;

        if($request ->hasFile('image'))
        {
            if(File::exists(public_path('uploads/products').'/'.$product->image))
            {
               File::delete(public_path('uploads/products').'/'.$product->image);
            }
            if(File::exists(public_path('uploads/products/thumbnails').'/'.$product->image))
            {
               File::delete(public_path('uploads/products/thumbnails').'/'.$product->image);
            }
            $image = $request->file ('image');
            $imageName = $current_timestamp .'.'.$image->extension();
            $this->GenerateProductThumbnailImage($image,$imageName);
            $product -> image = $imageName;
        }

        $gallery_arr = array();
        $gallery_images = "";
        $counter = 1;

        if($request->hasFile('images'))
        {
            foreach(explode(',',$product->images) as $ofile)
            {
                if(File::exists(public_path('uploads/products'.$ofile)))
            {
               File::delete(public_path('uploads/products'.$ofile));
            }
            if(File::exists(public_path('uploads/products/thumbnails'.$ofile)))
            {
               File::delete(public_path('uploads/products/thumbnails'.$ofile));
            }
            }

            $allowedfileExtion = ['jpg','png','jpeg'];
            $files =$request->file('images');
            foreach($files as $file)
            {
             $gextension = $file->getClientOriginalExtension();
             $gcheck = in_array($gextension, $allowedfileExtion);
             if($gcheck)
             {
                $gfileName = $current_timestamp .".". $counter .".". $gextension;
                $this->GenerateProductThumbnailImage($file,$gfileName);
                array_push($gallery_arr,$gfileName);
                $counter = $counter + 1;
             }

            }
            $gallery_images = implode(',',$gallery_arr);
            $product->images = $gallery_images;
        }
      
        $product->save();
        return redirect()->route('admin.products')->with('status','El producto ha sido Actualizado Exitosamente'); 

   } 

   public function product_delete ($id)
   {
    $product = Product::find($id);
    if(File::exists(public_path('uploads/products').'/'.$product->image))
            {
               File::delete(public_path('uploads/products').'/'.$product->image);
            }
            if(File::exists(public_path('uploads/products/thumbnails').'/'.$product->image))
            {
               File::delete(public_path('uploads/products/thumbnails').'/'.$product->image);
            }
            foreach(explode(',',$product->images) as $ofile)
            {
                if(File::exists(public_path('uploads/products'.$ofile)))
            {
               File::delete(public_path('uploads/products'.$ofile));
            }
            if(File::exists(public_path('uploads/products/thumbnails'.$ofile)))
            {
               File::delete(public_path('uploads/products/thumbnails'.$ofile));
            }
        }
    $product -> delete();
    return redirect()->route('admin.products')->with('status','El producto ha sido eliminado exitosamente!');
   }

   
public function coupons()
{
        $coupons = Coupon::orderBy("expiry_date","DESC")->paginate(12);
        return view("admin.coupons",compact("coupons"));
}

public function add_coupon()
{        
    return view("admin.coupon-add");
}

public function coupon_store(Request $request)
{
    $request->validate([
        'code' => 'required',
        'type' => 'required',
        'value' => 'required|numeric',
        'cart_value' => 'required|numeric',
        'expiry_date' => 'required|date'
    ]);
    $coupon = new Coupon();
    $coupon->code = $request->code;
    $coupon->type = $request->type;
    $coupon->value = $request->value;
    $coupon->cart_value = $request->cart_value;
    $coupon->expiry_date = $request->expiry_date;
    $coupon->save();
    return redirect()->route("admin.coupons")->with('status','Record has been added successfully !');
}

public function coupon_edit($id)
{
       $coupon = Coupon::find($id);
       return view('admin.coupon-edit',compact('coupon'));
} 

public function update_coupon(Request $request)
{
       $request->validate([
       'code' => 'required',
       'type' => 'required',
       'value' => 'required|numeric',
       'cart_value' => 'required|numeric',
       'expiry_date' => 'required|date'
       ]);
       $coupon = Coupon::find($request->id);
       $coupon->code = $request->code;
       $coupon->type = $request->type; 
       $coupon->value = $request->value;
       $coupon->cart_value = $request->cart_value;
       $coupon->expiry_date = $request->expiry_date;               
       $coupon->save();           
       return redirect()->route('admin.coupons')->with('status','Record has been updated successfully !');
}

public function delete_coupon($id)
{
        $coupon = Coupon::find($id);        
        $coupon->delete();
        return redirect()->route('admin.coupons')->with('status','Record has been deleted successfully !');
}

public function orders()
{
        $orders = Order::orderBy('created_at','DESC')->paginate(12);
        return view("admin.orders",compact('orders'));
}

public function order_details($order_id)
{
    $order = Order::find($order_id);
    $orderItems = OrderItem::where('order_id',$order_id)->orderBy('id')->paginate(12);
    $transaction = Transaction::where('order_id',$order_id)->first();
    return view('admin.order-details',compact('order','orderItems','transaction'));
}

public function update_order_status(Request $request)
{        
    $order = Order::find($request->order_id);
    $order->status = $request->order_status;
    if($request->order_status=='delivered')
    {
        $order->delivered_date = Carbon::now();
    }
    else if($request->order_status=='canceled')
    {
        $order->canceled_date = Carbon::now();
    }        
    $order->save();
    if($request->order_status=='delivered')
    {
        $transaction = Transaction::where('order_id',$request->order_id)->first();
        $transaction->status = 'approved';
        $transaction->save();
    }
    return back()->with("status", "Estado cambiado con éxito!");
}

public function user_delete($id)
{
    $user = User::findOrFail($id);
    $user->delete();
    return redirect()->route('admin.users')->with('status', 'Usuario eliminado exitosamente!');
}

public function user_update_utype(Request $request, $id)
{
    $request->validate([
        'utype' => 'required|string|max:255'
    ]);
    $user = User::findOrFail($id);
    $user->utype = $request->utype;
    $user->save();
    return redirect()->route('admin.users')->with('status', 'Tipo de usuario actualizado exitosamente!');
}

public function updateUtype(Request $request, $id)
    {
        $request->validate([
            'utype' => 'required|in:USR,ADM'
        ]);

        $user = User::findOrFail($id);
        $user->utype = $request->utype;
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Rol actualizado correctamente.');
    }

    public function add_user()
    {
        return view('admin.create');
    }

     public function store(Request $request)
    {
        $data = $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email',
        'mobile'   => 'nullable|numeric|unique:users,mobile',
        'utype'    => 'required|in:USR,ADM',
        'password' => 'required|min:8|confirmed',
        ], [
    'mobile.unique' => 'El número de teléfono ya está registrado. Ingrese otro diferente.',
    ]);

    
    User::create([
        'name'     => $data['name'],
        'email'    => $data['email'],
        'mobile'   => $data['mobile'],
        'utype'    => $data['utype'],
        'password' => Hash::make($data['password']),
    ]);

        return redirect()->route('admin.users')->with('success', 'Usuario creado correctamente.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:users,email,' . $user->id,
            'mobile' => 'nullable|string|max:20',
            'utype'  => 'required|in:USR,ADM',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->name   = $request->name;
        $user->email  = $request->email;
        $user->mobile = $request->mobile;
        $user->utype  = $request->utype;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'Usuario actualizado correctamente.');
    }
}