<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Session;
use DB;

class CategoryController extends Controller
{
    /** ---------------------------------------------------
     *  Category page
     *  @Created By : Rajesh Koladiya
     *  @Created At : 03-06-2022
     * ---------------------------------------------------
    */
    public function index(){
        $category = Category::get();
        return view('front.category.index',compact('category'));
    }

   /** ---------------------------------------------------
     *  Category page
     *  @Created By : Rajesh Koladiya
     *  @Created At : 03-06-2022
     * ---------------------------------------------------
    */
    public function addcategory(){
        $categoryTree = $this->categoryTree();
        // dd($categoryTree);
        // $allcategory=Category::get();
        // $catArray = [];
        // foreach($allcategory as $val){
        //     if($val->parent_id != 0){
        //         foreach($allcategory as $cat){
        //             if($val->parent_id == $cat->id){
        //                 $val['product'] =  $cat;
        //               break;
        //             }
        //         }
        //     }
        //     $catArray[]=$val;
        // }
        return view('front.category.create',compact('categoryTree'));
    }

    /** ---------------------------------------------------
     *  Store Category
     *  @Created By : Rajesh Koladiya
     *  @Created At : 03-06-2022
     * ---------------------------------------------------
    */
    public function store(request $request){
        $this->validate($request,[
            'category_name' => 'required',
        ]);

        $data['name'] = $request->category_name;
        $data['parent_id'] = $request->category;
        $data['status'] = '1';

        $category=Category::create($data);
        if($category){
            Session::flash('message', '<div class="alert alert-success"><strong>Success!</strong> Category Added Successfully </div>');
            return response()->json(['status'=>200,'msg' => "Category Add Successfully"]);
        }else{
            return response()->json(['status'=>401,'msg' => "please Add correct detail"]);
        }
    }
    /** ---------------------------------------------------
     *  Edit Category
     *  @Created By : Rajesh Koladiya
     *  @Created At : 03-06-2022
     * ---------------------------------------------------
    */
    public function edit($id){
        $category = Category::where('id',$id)->first();
        $categoryTree = $this->categoryTree();
        return view('front.category.create',compact('category','categoryTree'));
    }

    public function update(request $request){

        $this->validate($request,[
            'category_name' => 'required',
        ]);

        $data['name'] = $request->category_name;
        $category = Category::where('id',$request->id)->first();
        if($request->category == $category->id){
            $data['parent_id'] =0;
        }else{
            $data['parent_id'] = $request->category;
        }

        $data['status'] = '1';

        $category=Category::where('id',$request->id)->update($data);
        if($category){
            Session::flash('message', '<div class="alert alert-success"><strong>Success!</strong> Category Update Successfully </div>');
            return response()->json(['status'=>200,'msg' => "Category Update Successfully"]);
        }else{
            return response()->json(['status'=>401,'msg' => "please Add correct detail"]);
        }

    }

      /** ---------------------------------------------------
     *  Destroy Category
     *  @Created By : Rajesh Koladiya
     *  @Created At : 03-06-2022
     * ---------------------------------------------------
    */
    public function destroy($id){
         $category = Category::where('id',$id)->delete();
         if ($category) {
             return redirect(route('front.category.create'));
         } else {
             return 0;
         }
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
