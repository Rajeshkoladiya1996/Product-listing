<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Validator;

class ApiController extends Controller
{
    /** ---------------------------------------------------
     *  Filter Product List
     *  @Created By : Rajesh Koladiya
     *  @Created At : 03-06-2022
     * ---------------------------------------------------
    */
    public function getproduct(Request $request){

        $categoryIds = Category::get();
        $categoryList=[];
        foreach ($categoryIds as $key => $value) {
            if($value['id']==$request->cat_id || in_array($value['parent_id'], $categoryList)){
                $categoryList[]=$value['id'];
            }
        }

        if($request->cat_id){
            $result=Product::with('category')->whereIn('cat_id',$categoryList)->get();
        }else{
            $result=Product::with('category')->get();
        }
        if($result){
            return response()->json(['ResponseCode'=>1,'ResponseText'=>'Success.','ResponseData' => $result],200);
        }else{
            return response()->json(['ResponseCode'=>0,'ResponseText'=>'Something Went Wrong.'],500);
        }

    }

    /** ---------------------------------------------------
     *  Category List
     *  @Created By : Rajesh Koladiya
     *  @Created At : 03-06-2022
     * ---------------------------------------------------
    */

    public function getcategory(){
        $allcategory=Category::get();
        $result =$this->buildTree($allcategory);

        if($result){
            return response()->json(['ResponseCode'=>1,'ResponseText'=>'Success.','ResponseData' => $result],200);
        }else{
            return response()->json(['ResponseCode'=>0,'ResponseText'=>'Something Went Wrong.'],500);
        }

    }

    public function buildTree($items) {
        $childs = array();
        foreach($items as &$item){
            $childs[$item['parent_id']][] = &$item;
            unset($item);
        }
        foreach($items as &$item){
            if (isset($childs[$item['id']])){
                $item['childs'] = $childs[$item['id']];
            }
        }
        return $childs[0];
    }


}
