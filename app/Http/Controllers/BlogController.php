<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogCategory;
use App\Blog;
use Session;
use App\image;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Blog::orderBy('type')->paginate(12);
        return view('admin.blog.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cates = BlogCategory::all();
        return view('admin.blog.create')->withCates($cates);
    }

    public static function slugify($text) {
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        $text = trim($text, '-');
        if (function_exists('transliterator_transliterate')) $text = transliterator_transliterate('Any-Latin; Latin-ASCII', $text);
        $text = iconv('utf-8', 'ASCII//TRANSLIT//IGNORE', $text);
        $text = strtolower($text);
        $text = preg_replace('~[^-\w]+~', '', $text);

        return $text;
    }
    public function all(Request $request)
    {
        $settings = Settings::first();
        $sliders = Photos::where('rules', 'sliders')->get();
        if(isset($request->url_redirectTo)){
            if($request->url_redirectTo != ''){
                foreach ($sliders as $url_link) {
                    if($url_link->descriptions == $request->url_redirectTo){
                        return redirect('http://'. $request->url_redirectTo);
                    }
                }
            }
        }
        $promotions = Blog::where('type', 'promotion')->where('status', 'published')->orderBy('sort_order', 'asc')->limit(4)->get();
        $recipes = Blog::where('type', 'recipe')->where('status', 'published')->orderBy('sort_order', 'asc')->limit(4)->get();
        $blogs = Blog::where('type', 'blog')->where('status', 'published')->orderBy('sort_order', 'asc')->limit(4)->get();
        $specials = Blog::where('type', 'special')->where('status', 'published')->limit(4)->orderBy('sort_order', 'asc')->get();
        $all_counts = UserType::join('restaurant_profiles', 'restaurant_profiles.rest_id' , '=', 'user_types.user_id')
                ->join('users', 'users.id', '=', 'restaurant_profiles.rest_id')
                ->where('user_types.progress', 'Finished')
                ->where('restaurant_profiles.status', 'opened')->get();
        $title = '';
        if(isset($request->type)){
            $type = $request->type;
            $allblogswithType = '';
            $passed = false;
            if($type == 'recipe')
            {
                $allblogswithType = Blog::where('type', 'recipe')->where('status', 'published')->orderBy('sort_order', 'asc')->get();
                $passed = true;
                $title = 'ສູດອາຫານທັງໝົດ';
            }else if($type == 'promotion')
            {
                $allblogswithType = Blog::where('type', 'promotion')->where('status', 'published')->orderBy('sort_order', 'asc')->get();
                $passed = true;
                $title = 'ໂປຣໂມຊັ້ນທັງໝົດ';
            }else if($type == 'blog'){
                $allblogswithType = Blog::where('type', 'blog')->where('status', 'published')->orderBy('sort_order', 'asc')->get();
                $passed = true;
                $title = 'ບົດຄວາມທົ່ວໄປທັງໝົດ';
            }else if($type == 'special'){
                $allblogswithType = Blog::where('type', 'special')->where('status', 'published')->orderBy('sort_order', 'asc')->get();
                $passed = true;
                $title = 'ສະປູນສະກຸບພິເສດທັງໝົດ';
            }
            if($type == '' || !$passed){
                return back();
            }
            return view('pages.blog.all')->with('settings', $settings)->with('rest_count', $all_counts)->with('sliders', $sliders)->with('promotions', $promotions)->with('recipes', $recipes)->with('blogs', $blogs)->with('allblogswithType', $allblogswithType)->with('type', $type)->with('title', $title)->with('specials', $specials);
        }else{
            $type = '';
            $title = 'ບົດຄວາມທັງໝົດ';
            $allblogswithType = '';
            $allpromotions = Blog::where('type', 'promotion')->where('status', 'published')->orderBy('sort_order', 'asc')->get();
            $allrecipes = Blog::where('type', 'recipe')->where('status', 'published')->orderBy('sort_order', 'asc')->get();
            $allblogs = Blog::where('type', 'blog')->where('status', 'published')->orderBy('sort_order', 'asc')->get();
            $allspecials = Blog::where('type', 'special')->where('status', 'published')->orderBy('sort_order', 'asc')->get();
            return view('pages.blog.all')->with('settings', $settings)->with('rest_count', $all_counts)->with('sliders', $sliders)->with('promotions', $promotions)->with('recipes', $recipes)->with('blogs', $blogs)->with('allpromotions', $allpromotions)->with('allrecipes', $allrecipes)->with('allblogs', $allblogs)->with('type', $type)->with('allblogswithType', $allblogswithType)->with('title', $title)->with('allspecials', $allspecials)->with('specials', $specials);
        }
        return back();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bodyClean = str_replace('src="../../../../img/', 'src="/../../../img/', $request->body);
        $bodyClean = str_replace('src="../../../img/', 'src="/../../img/', $request->body);
            $this->validate($request, 
            [
                'title' => 'required|max:191',
                'slug' => 'required|alpha_dash|min:5|max:191|unique:blogs,slug',
                'body' => 'required',
                'description'=>'required',
                'blog_category' => 'required',

            ]);
            if($request->hasFile('img_title')){
                $this->validate($request, ['img_title' => 'required|sometimes|image']);
                $file = $request->file('img_title');
                $filename = md5(date('Y-m-d h:m:s') . microtime()) . time() . '_attach_.' . $file->getClientOriginalExtension();
                $localtion = public_path('img/upload/');
                $file->move($localtion, $filename);
            }
            $postblog = new Blog;
            $postblog->img_title = $filename;
            $postblog->title = $request->title;
            $postblog->slug = $request->slug;
            $postblog->body = $bodyClean;
            $postblog->description = $request->description;
            $postblog->type= 'recipe';
            $postblog->category_id=$request->blog_category;
            $postblog->status='published';
            $postblog->save();
            Session::flash('success','The blog post was successfully saved!.');
            return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function single($slug)
    {
        $post = Blog::where('slug','=', $slug)->where('status', 'published')->first();
        if(!isset($post)){
            return back();
        }
        $logo=image::first();
        $blogs_gallery = Blog::where('status', 'published')->orderBy('sort_order', 'asc')->inRandomOrder()->limit(3)->get();
        if(isset($post)){
            return view('common.Readblog')->with('logoname', $logo)->with('blogs_gallery', $blogs_gallery)->with('read', $post);
        }else{
             return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Blog::find($id);
        $cates = BlogCategory::all();
        if(isset($post)){
            return view('admin.blog.edit')->with('post', $post)->withCates($cates);
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      
       $bodyClean = str_replace('src="../../../../img/', 'src="/../../../img/', $request->body);
       $bodyClean = str_replace('src="../../../img/', 'src="/../../img/', $request->body);
       $postblog_ = Blog::find($id);
       if(!isset($postblog_)){
            return back();
       }
            $filename = '';
            $postblog = Blog::find($id);
            if($request->hasFile('img_title')){
                $this->validate($request, ['img_title' => 'required|sometimes|image']);
                $file = $request->file('img_title');
                if(unlink(public_path() . '/img/upload/' . $postblog->img_title )){}
                $filename = md5(date('Y-m-d h:m:s') . microtime()) . time() . '_attach_.' . $file->getClientOriginalExtension();
                $localtion = public_path('img/upload/');
                $file->move($localtion, $filename);
            }
            if($postblog->slug == $request->slug){
                    $this->validate($request, 
                [
                    'title' => 'required|max:191',
                    'body' => 'required',
                    'description' => 'required',
                    'blog_category' => 'required',

                ]);
                if(isset($postblog)){
                    if($filename != ''){
                         $postblog->img_title = $filename;
                    }
                    $postblog->body = $bodyClean;
                    $postblog->title = $request->title;
                    $postblog->type='recipe';
                    $postblog->status='published';
                    $postblog->description = $request->description;
                    $postblog->category_id=$request->blog_category;
                    $postblog->save();
                    Session::flash('success','The blog post was successfully updated!.');
                }
            }else {
                $this->validate($request, 
                [
                    'title' => 'required|max:191',
                    'slug' => 'required|alpha_dash|min:5|max:191|unique:blogs,slug',
                    'body' => 'required',
                    'description' => 'required',
                    'blog_category' => 'required',

                ]);
                if(isset($postblog)){
                    if($filename != ''){
                         $postblog->img_title = $filename;
                    }
                    $postblog->title = $request->title;
                    $postblog->slug = $request->slug;
                    $postblog->body = $bodyClean;
                    $postblog->description = $request->description;
                    $postblog->category_id=$request->blog_category;
                    $postblog->type='recipe';
                    $postblog->status='published';
                    $postblog->save();
                    Session::flash('success','The blog post was successfully updated!.');
                }
            
            return back();
        }
       return back();
    }
    public function search(Request $request)
    {

        $settings = Settings::first();
        $title = '';
        $sliders = Photos::where('rules', 'sliders')->get();
        if(isset($request->url_redirectTo)){
            if($request->url_redirectTo != ''){
                foreach ($sliders as $url_link) {
                    if($url_link->descriptions == $request->url_redirectTo){
                        return redirect('http://'. $request->url_redirectTo);
                    }
                }
            }
        }
        $promotions = Blog::where('type', 'promotion')->where('status', 'published')->orderBy('sort_order', 'asc')->limit(4)->get();
        $recipes = Blog::where('type', 'recipe')->where('status', 'published')->orderBy('sort_order', 'asc')->limit(4)->get();
        $blogs = Blog::where('type', 'blog')->where('status', 'published')->orderBy('sort_order', 'asc')->limit(4)->get();
        $specials = Blog::where('type', 'special')->where('status', 'published')->limit(4)->orderBy('sort_order', 'asc')->get();
        $all_counts = UserType::join('restaurant_profiles', 'restaurant_profiles.rest_id' , '=', 'user_types.user_id')
                ->join('users', 'users.id', '=', 'restaurant_profiles.rest_id')
                ->where('user_types.progress', 'Finished')
                ->where('restaurant_profiles.status', 'opened')->get();
        $keywords = $request->search_text;
        if($keywords == ''){
            $title = 'ການຄົ້ນຫາ';
            $allpromotions = Blog::where('type', 'promotion')->where('status', 'published')->orderBy('sort_order', 'asc')->get();
            $allrecipes = Blog::where('type', 'recipe')->where('status', 'published')->orderBy('sort_order', 'asc')->get();
            $allblogs = Blog::where('type', 'blog')->where('status', 'published')->orderBy('sort_order', 'asc')->get();
            $allspecials = Blog::where('type', 'special')->where('status', 'published')->orderBy('sort_order', 'asc')->get();
            return view('pages.blog.search')->with('settings', $settings)->with('rest_count', $all_counts)->with('sliders', $sliders)->with('promotions', $promotions)->with('recipes', $recipes)->with('blogs', $blogs)->with('specials', $specials)->with('title', $title)->with('allspecials', $allspecials)->with('allpromotions', $allpromotions)->with('allrecipes', $allrecipes)->with('allblogs', $allblogs)->with('keywords', $keywords);
        }else{
            $title = $keywords;
            Session::flash('keywords', $keywords);
            $allpromotions = Blog::where(function($query) use ($keywords){
                $query->where('title', 'LIKE', '%' . $keywords . '%')
                ->orWhere('body', 'LIKE', '%' . $keywords . '%')
                ->orWhere('slug', 'LIKE', '%' . $keywords . '%')
                ->orWhere('description', 'LIKE', '%' . $keywords . '%')
                ->orWhere('type', 'LIKE', '%' . $keywords . '%')
                ->orWhere('start', 'LIKE', '%' . $keywords . '%')
                ->orWhere('expire', 'LIKE', '%' . $keywords . '%');
            })->where('type', 'promotion')->where('status', 'published')->orderBy('sort_order', 'asc')->get();


            $allrecipes = Blog::where(function($query) use ($keywords){
                $query->where('title', 'LIKE', '%' . $keywords . '%')
                ->orWhere('body', 'LIKE', '%' . $keywords . '%')
                ->orWhere('slug', 'LIKE', '%' . $keywords . '%')
                ->orWhere('description', 'LIKE', '%' . $keywords . '%')
                ->orWhere('type', 'LIKE', '%' . $keywords . '%')
                ->orWhere('start', 'LIKE', '%' . $keywords . '%')
                ->orWhere('expire', 'LIKE', '%' . $keywords . '%');
            })->where('type', 'recipe')->where('status', 'published')->orderBy('sort_order', 'asc')->get();


            $allblogs = Blog::where(function($query) use ($keywords){
                $query->where('title', 'LIKE', '%' . $keywords . '%')
                ->orWhere('body', 'LIKE', '%' . $keywords . '%')
                ->orWhere('slug', 'LIKE', '%' . $keywords . '%')
                ->orWhere('description', 'LIKE', '%' . $keywords . '%')
                ->orWhere('type', 'LIKE', '%' . $keywords . '%')
                ->orWhere('start', 'LIKE', '%' . $keywords . '%')
                ->orWhere('expire', 'LIKE', '%' . $keywords . '%');
            })->where('type', 'blog')->where('status', 'published')->orderBy('sort_order', 'asc')->get();


            $allspecials = Blog::where(function($query) use ($keywords){
                $query->where('title', 'LIKE', '%' . $keywords . '%')
                ->orWhere('body', 'LIKE', '%' . $keywords . '%')
                ->orWhere('slug', 'LIKE', '%' . $keywords . '%')
                ->orWhere('description', 'LIKE', '%' . $keywords . '%')
                ->orWhere('type', 'LIKE', '%' . $keywords . '%')
                ->orWhere('start', 'LIKE', '%' . $keywords . '%')
                ->orWhere('expire', 'LIKE', '%' . $keywords . '%');
            })->where('type', 'special')->where('status', 'published')->orderBy('sort_order', 'asc')->get();

            if($allpromotions->count() == 0 && $allrecipes->count() == 0 && $allblogs->count() == 0 && $allspecials->count() == 0){
                $title = 'ການຄົ້ນຫາ -';
                $allpromotions = Blog::where('type', 'promotion')->where('status', 'published')->orderBy('sort_order', 'asc')->get();
                $allrecipes = Blog::where('type', 'recipe')->where('status', 'published')->orderBy('sort_order', 'asc')->get();
                $allblogs = Blog::where('type', 'blog')->where('status', 'published')->orderBy('sort_order', 'asc')->get();
                $allspecials = Blog::where('type', 'special')->where('status', 'published')->orderBy('sort_order', 'asc')->get();
                return view('pages.blog.search')->with('settings', $settings)->with('rest_count', $all_counts)->with('sliders', $sliders)->with('promotions', $promotions)->with('recipes', $recipes)->with('blogs', $blogs)->with('specials', $specials)->with('title', $title)->with('allspecials', $allspecials)->with('allpromotions', $allpromotions)->with('allrecipes', $allrecipes)->with('allblogs', $allblogs)->with('keywords', $keywords);
            }

            return view('pages.blog.search')->with('settings', $settings)->with('rest_count', $all_counts)->with('sliders', $sliders)->with('promotions', $promotions)->with('recipes', $recipes)->with('blogs', $blogs)->with('specials', $specials)->with('title', $title)->with('allspecials', $allspecials)->with('allpromotions', $allpromotions)->with('allrecipes', $allrecipes)->with('allblogs', $allblogs)->with('keywords', $keywords);
        }
        return view('pages.blog.search')->with('settings', $settings)->with('rest_count', $all_counts)->with('sliders', $sliders)->with('promotions', $promotions)->with('recipes', $recipes)->with('blogs', $blogs)->with('specials', $specials)->with('title', $title)->with('keywords', $keywords);
    }
    
}
