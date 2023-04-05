<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

use Session;

class ProductController extends Controller
{
    /** ---------------------------------------------------
     *  Main Page Product List
     *  @Created By : Rajesh Koladiya
     *  @Created At : 03-06-2022
     * ---------------------------------------------------
    */
    public function index(){

        $product = Product::with('category')->orderby('created_at','DESC')->get();
        return view('front.product.index',compact('product'));
    }

    /** ---------------------------------------------------
     *  Create New Product
     *  @Created By : Rajesh Koladiya
     *  @Created At : 03-06-2022
     * ---------------------------------------------------
    */
    public function create(){
        $categoryTree = $this->categoryTree();
        return view('front.product.create',compact('categoryTree'));
    }

    /** ---------------------------------------------------
     *  Store New Product
     *  @Created By : Rajesh Koladiya
     *  @Created At : 03-06-2022
     * ---------------------------------------------------
    */
    public function store(request $request){

        $this->validate($request,[
            'product_name' => 'unique:products,name',
        ]);

        $product = new Product();
        $data['name']=$request->product_name;
        $data['price']=$request->product_price;
        $data['minqty']=$request->minquantity;
        $data['maxqty']=$request->maxquantity;
        $data['discription']=$request->description;
        $data['status']=$request->product_status;
        $data['cat_id']=$request->category;

        if($request['product_image'])
        {
            $images=json_decode($request['product_image']);
            if($images->output->image!=""){
                $itemImage=$images->output->image;
                $image_parts = explode(";base64,",  $itemImage);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);;
                $safeName ="product-".uniqid().'.'.$image_type;
                $success = file_put_contents(storage_path('/app/public/uploads/product').'/'.$safeName,$image_base64);
                $data['image']= $safeName;
            }
        }
        $product->fill($data);
        if($product->save()){
            Session::flash('message', '<div class="alert alert-success"><strong>Success!</strong> Product Added Successfully </div>');
            return response()->json(['status'=>200,'msg' => "Product Add Successfully"]);
        }else{
            return response()->json(['status'=>401,'msg' => "please Add correct detail"]);
        }

    }
    /** ---------------------------------------------------
     *  Edit Product
     *  @Created By : Rajesh Koladiya
     *  @Created At : 03-06-2022
     * ---------------------------------------------------
    */
    public function edit($id){
        $categoryTree = $this->categoryTree();
        $product = Product::where('id',$id)->first();
        return view('front.product.create',compact('product','categoryTree'));
    }

    /** ---------------------------------------------------
     *  Update Product
     *  @Created By : Rajesh Koladiya
     *  @Created At : 03-06-2022
     * ---------------------------------------------------
    */

    public function update(request $request){

        $product_status = Product::where('id',$request->id)->first();

        if($request['edit_product_image']){
            $images=json_decode($request['edit_product_image']);
            if(file_exists(storage_path('app/public/uploads/product'.$product_status->image)))
            {
                File::delete('storage/app/product/'.$product_status->image);
            }
            if($images->output->image!=""){
                $itemImage=$images->output->image;

                $image_parts = explode(";base64,",  $itemImage);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                // dd($image_parts[1]);
                $safeName ="product-".uniqid().'.'.$image_type;
                // $destinationPath = storage_path('/app/public/uploads/gift');
                $success = file_put_contents(storage_path('/app/public/uploads/product').'/'.$safeName,$image_base64);

                $data['image']= $safeName;
            }

        }

        $data['name']=$request->product_name;
        $data['price']=$request->product_price;
        $data['minqty']=$request->minquantity;
        $data['maxqty']=$request->maxquantity;
        $data['discription']=$request->description;
        $data['cat_id']=$request->category;

        Product::where('id',$request->id)->update($data);

        Session::flash('message', '<div class="alert alert-success"><strong>Success!</strong> Product Updated Successfully </div>');
        return response()->json(['status'=>200,'msg' => "Product update Successfully"]);

    }

    /** ---------------------------------------------------
     *  Destroy Product
     *  @Created By : Rajesh Koladiya
     *  @Created At : 03-06-2022
     * ---------------------------------------------------
    */
    public function destroy($id){

        $oldimage = Product::where('id',$id)->value('image');
        if(file_exists(storage_path('app/public/uploads/product'.$oldimage)))
        {
            File::delete('storage/app/product/'.$oldimage);
        }
         $product = Product::where('id',$id)->delete();

         if ($product) {
             return redirect(route('front.product.create'));
         } else {
             return 0;
         }
     }

     public function productList(Request $request){

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length =(int)$request->get('length');
        $page=($request->start/$length)+1;
        $search=$request->search['value'];

        // \DB::enableQueryLog();
        if(isset($request->order)){
            $order=$request->order[0]['dir'];
            $columns=$request->order[0]['column'];
            if($request->order[0]['column']==1 && $request->order[0]['column']==0 && $request->order[0]['column']==2){
                $name_field=$request->columns[$columns]['data'];
            }
        }
        $product =Product::get();
        if($search!=""){
            $product =$product->where(function($q) use($search){
                $q->where('name', 'like', '%' .$search. '%')
                ->orWhere('name', 'like', '%' .$search. '%')
                ->orWhere('user_login_logs.device_type', 'like', '%' .$search. '%')
                ->orWhere('user_login_logs.date', 'like', '%' .$search. '%')
                ->orWhere('users.email', 'like', '%' .$search. '%')
                ->orWhere('users.username', 'like', '%' .$search. '%')
                ->orWhere('users.stream_id', 'like','%'.$search.'%');
            });
        }
        if(!isset($request->order)){
            $members =$members->orderby('user_login_logs.id','DESC');
        }else{

            $name_field=$request->columns[$columns]['data'];
            if($request->order[0]['column']!=1 && $request->order[0]['column']!=0 && $request->order[0]['column']!=2){
                $members =$members->orderby($name_field,$order);
            }else{
                $members =$members->orderby('users.'.$name_field,$order);
            }
        }

        $members =$members->select('user_login_logs.*');
        $members =$members->paginate($length,['*'], 'page',$page);
        // dd(\DB::getQueryLog());

        foreach ($members as $key => $value) {

            $value->profile_pic='<span class="tabel-profile-img"><img src="'.$value['user']->profile_pic.'" alt=""></span></br>'.strtolower($value['user']->stream_id);
            if($value['user']->role_id==1){
                $value->role='Admin';
            }elseif($value['user']->role_id==2){
                $value->role='Subadmin';
            }elseif($value['user']->role_id==3){
                $value->role='Agent';
            }else{
                $value->role='User';
            }
            $value->device_type=($value->device_type==NULL)? 'Web' : $value->device_type;
            $value->username=$value['user']->username;
            $value->email=$value['user']->email;
            $value->phone=$value['user']->phone;
            $join_date = new Carbon($value->date);
            $join_date->timezone = env('APP_TIME_ZONE','Asia/Bangkok');
            $value->date =  date('d M, Y | h:i:s a',strtotime($join_date->toDayDateTimeString()));
            $value->type=($value->type=='login')? '<span class="green">'.$value->type.'</span>': '<span class="red">'.$value->type.'</span>';
        }

        $members=(array)json_decode(json_encode($members));


        $data = array(
           'draw' => $draw,
           'recordsTotal' => $members['total'],
           'recordsFiltered' =>$members['total'],
           'data' => $members['data'],
        );
        echo json_encode($data);
    }

    public function categoryTree(){
        $result = $this->tree($parent_id = 0, $sub_mark = '', $html='');
        return $result;
     }

     public function tree($parent_id = 0, $sub_mark = '', $html){
         $store=$html;
         $query = Category::where("parent_id",$parent_id)->orderBy('name', 'ASC')->get();
         if(count($query) > 0){
             foreach($query as $val){
                 $store .= '<option value="'.$val['id'].'">'.$sub_mark.$val['name'].'</option>';
                 $store=$this->tree($val['id'], $sub_mark.'---',$store);
             }
         }
         return $store;
     }



}