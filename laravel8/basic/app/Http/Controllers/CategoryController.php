<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon; //FOR Eloquent ORM DATA INSERT
use Illuminate\Support\Facades\DB; //FOR QUERY Builder DATA INSERT

class CategoryController extends Controller
{
  public function AllCategory(){
    $categories = Category::latest()->paginate(5); //get all data and paginate
    $trashCateegory = Category::onlyTrashed()->latest()->paginate(3); //

    return view('admin.category.categorypage', compact('categories', 'trashCateegory'));
  }

  public function AddCategory(Request $request){
    $validatedData = $request->validate([
        'category_name' => 'required|unique:categories|max:255',
    ],
    [
        // Create Message
        'category_name.required' => 'Input a Category name',
        'category_name.max' => 'Category Less than 255Chars',

    ]);

      // Eloquent ORM Insert Data
        Category::insert([
          'category_name' => $request->category_name,
          'user_id' => Auth::user()->id,
          'created_at' => Carbon::now()
      ]);

      // Alternative Eloquent ORM Insert Data
      // $category = new Category;
      // $category->category_name = $request->category_name;
      // $category->user_id = Auth::user()->id;
      // $category->save();

      // QUERY Builder Insert Data
      // $data = array();
      // $data['category_name'] = $request->category_name;
      // $data['user_id'] = Auth::user()->id;
      // DB::table('categories')->insert($data);

      // Redirects after inserting a new category and prints a message
      return Redirect()->back()->with('success', 'Category Inserted Successfully');


  }
      // Edit function
      public function Edit($id){
        $categories = Category::find($id);
        return view('admin.category.edit',compact('categories'));
      }

      public function Update(Request $request, $id){
        $update = Category::find($id)->update([
          'category_name' => $request->category_name,
          'user_id' => Auth::user()->id
        ]);
        return Redirect()->route('all.category')->with('success', 'Category Name Updated Successfully');
      }


    public function FirstDelete($id){
      $delete = Category::find($id)->delete();
      return Redirect()->back()->with('success', 'Category Moved Successfully to Trash');
    }

    public function Restore($id){
      $delete = Category::withTrashed()->find($id)->restore();
      return Redirect()->back()->with('success', 'Category Restored Successfully');

    }

    public function FinalDelete($id){
      $delete = Category::onlyTrashed()->find($id)->forceDelete();
      return Redirect()->back()->with('success', 'Category Permanently Deleted');
    }

}
