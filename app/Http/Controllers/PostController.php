<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Image;
use App\Blog;
use Session;
use App\Photo;
class PostController extends Controller
{
    public function getImages(Request $request)
    {
        if($request->ajax()){
            $img = Photo::where('rules', 'upload')->get();
            return response()->json(['success' => true, 'img' => $img]);
        }
        return back();
    }
    public function storeImages(Request $request)
    {
        $passed = 0;
        $files = $request->file('files');
        $count = count($files);
        if($count > 0){
                $rules = array('file' => 'sometimes|image');
                foreach ($files as $image_file) {
                    $validator = Validator::make(array('file' => $image_file), $rules);
                    if($validator->passes()){
                        $filename = md5(date('Y-m-d H:i:s')) . time() . $image_file->getClientOriginalName();
                        $image_file->move(public_path('img/upload/'), $filename);
                        $location = public_path('img/upload/thumbnails/'. $filename);
                        $img = Image::make('img/upload/' . $filename);
                        $img->resize(320, 300);
                        $img->save($location);
                        $passed++;
                        // save to database
                        $image_save = new Photo;
                        $image_save->img_url = $filename;
                        $image_save->rules = 'upload';
                        $image_save->file_name = $image_file->getClientOriginalName();
                        $image_save->save();
                    }
                }
                if($passed == $count ){
                    return response()->json(['success' => true, 'message' => 'Images was successfully uploaded.']);
                }else{
                    return response()->json(['success' => true, 'message' => 'Cannot Upload Images.']);
                }
        }
    }

    public function deleteImages(Request $request)
    {
        $ids = $request->img_id;
         $success = 0;
         if(isset($ids)){
           foreach ($ids as $id) {
              $ActionList = Photo::where('id', $id)->where('rules', 'upload');
                $image = Photo::find($id);
                unlink(public_path('img/upload/' . $image->img_url));
                unlink(public_path('img/upload/thumbnails/' . $image->img_url));
              $ActionList->delete();
              $success++;
           }
         }
         if($success > 0){
                return response()->json(['success' => true, 'message' => 'Images was successfully deleted.']);
         }else{
                return response()->json(['success' => true, 'message' => 'Cannot Delete Images.']);
         }
    }
    public function storeTempImage(Request $request)
    {
        if(!isset($request->name)){
          return;
        }
        $data = $request->img;
        $old = Photo::find($request->old_id);
        $id = '';
        if($request->name != ''){
            if(isset($old)){
                if($old->img_url != ''){
                    unlink(public_path('images/blog/' . $old->img_url));
                    unlink(public_path('images/blog/thumbnail/' . $old->img_url));
                }
                $image_name = md5(microtime()) . time() . '_temp' . '.' . $request->name;
                $img = Image::make($request->img_file);
                $location = public_path('images/blog/'. $image_name);
                $img->save($location)->destroy();

                $img_ = Image::make($location);
                $location_ = public_path('images/blog/thumbnail/'. $image_name);
                $img_ = Image::make($location);
                $location_ = public_path('images/blog/thumbnail/'. $image_name);

                if($request->type == 'recipe'){
                    $img_->resize($settings->crop_width_recipe, $settings->crop_height_recipe, function($ratio){
                        //$ratio->aspectRatio();
                    });
                }else if($request->type == 'promotion'){
                    $img_->resize($settings->crop_width_promotion, $settings->crop_height_promotion, function($ratio){
                        //$ratio->aspectRatio();
                    });
                }else if($request->type == 'blog'){
                    $img_->resize($settings->crop_width_blog_reszie, $settings->crop_height_blog_reszie, function($ratio){
                        //$ratio->aspectRatio();
                    });
                }else if($request->type == 'special'){
                    $img_->resize($settings->crop_width_blog_reszie, $settings->crop_height_blog_reszie, function($ratio){
                        //$ratio->aspectRatio();
                    });
                }


                $img_->save($location_)->destroy();

                $old->img_url = $image_name;
                $old->rules = 'upload';
                $old->descriptions = 'blog_temp';
                $old->save();
                $id = $old->id;
            }else{
                $image_name = md5(microtime()) . time() . '_temp' . '.' . $request->name;
                $img = Image::make($request->img_file);
                $location = public_path('images/blog/'. $image_name);
                $img->save($location)->destroy();

                $img_ = Image::make($location);
                $location_ = public_path('images/blog/thumbnail/'. $image_name);

                if($request->type == 'recipe'){
                    $img_->resize($settings->crop_width_recipe, $settings->crop_height_recipe, function($ratio){
                        //$ratio->aspectRatio();
                    });
                }else if($request->type == 'promotion'){
                    $img_->resize($settings->crop_width_promotion, $settings->crop_height_promotion, function($ratio){
                        //$ratio->aspectRatio();
                    });
                }else if($request->type == 'blog'){
                    $img_->resize($settings->crop_width_blog_reszie, $settings->crop_height_blog_reszie, function($ratio){
                        //$ratio->aspectRatio();
                    });
                }else if($request->type == 'special'){
                    $img_->resize($settings->crop_width_blog_reszie, $settings->crop_height_blog_reszie, function($ratio){
                        //$ratio->aspectRatio();
                    });
                }

                $img_->save($location_)->destroy();

                $blog = new Photo;
                $blog->img_url = $image_name;
                $blog->rules = 'upload';
                $blog->rest_id = $request->id;
                $blog->descriptions = 'blog_temp';
                $blog->save();
                $id = $blog->id;
            }
        }
        return response()->json(['success' => $image_name, 'id' => $id]);
    }

    public function editTempImage(Request $request, $id)
    {
        if(!isset($request->name)){
          return;
        }
        $data = $request->img;
        $old = Blog::find($id);
        if($request->name != ''){
            if(isset($old)){
                if($old->img_title != ''){
                    unlink(public_path('images/blog/' . $old->img_title));
                    unlink(public_path('images/blog/thumbnail/' . $old->img_title));
                }
                $image_name = md5(microtime()) . time() . '_blog_temp' . '.' . $request->name;
                $img = Image::make($request->img_file);
                $location = public_path('images/blog/'. $image_name);
                $img->save($location)->destroy();

                $img_ = Image::make($location);
                $location_ = public_path('images/blog/thumbnail/'. $image_name);
                if($request->type == 'recipe'){
                    $img_->resize($settings->crop_width_recipe, $settings->crop_height_recipe, function($ratio){
                        //$ratio->aspectRatio();
                    });
                }else if($request->type == 'promotion'){
                    $img_->resize($settings->crop_width_promotion, $settings->crop_height_promotion, function($ratio){
                        //$ratio->aspectRatio();
                    });
                }else if($request->type == 'blog'){
                    $img_->resize($settings->crop_width_blog_reszie, $settings->crop_height_blog_reszie, function($ratio){
                        //$ratio->aspectRatio();
                    });
                }else if($request->type == 'special'){
                    $img_->resize($settings->crop_width_blog_reszie, $settings->crop_height_blog_reszie, function($ratio){
                        //$ratio->aspectRatio();
                    });
                }

                $img_->save($location_)->destroy();
                $old->img_title = $image_name;
                $old->save();
            }
        }else{
                $ext = pathinfo($old->img_title, PATHINFO_EXTENSION);
                $image_name = md5(microtime()) . time() . '_blog_temp.' . $ext;
                if($old->img_title != ''){
                    unlink(public_path('images/blog/' . $old->img_title));
                    unlink(public_path('images/blog/thumbnail/' . $old->img_title));
                }
                $img = Image::make($request->img_file);
                $location = public_path('images/blog/'. $image_name);
                $img->save($location)->destroy();

                $img_ = Image::make($location);
                $location_ = public_path('images/blog/thumbnail/'. $image_name);
                $img_ = Image::make($location);
                $location_ = public_path('images/blog/thumbnail/'. $image_name);
                if($request->type == 'recipe'){
                    $img_->resize($settings->crop_width_recipe, $settings->crop_height_recipe, function($ratio){
                        //$ratio->aspectRatio();
                    });
                }else if($request->type == 'promotion'){
                    $img_->resize($settings->crop_width_promotion, $settings->crop_height_promotion, function($ratio){
                        //$ratio->aspectRatio();
                    });
                }else if($request->type == 'blog'){
                    $img_->resize($settings->crop_width_blog_reszie, $settings->crop_height_blog_reszie, function($ratio){
                        //$ratio->aspectRatio();
                    });
                }else if($request->type == 'special'){
                    $img_->resize($settings->crop_width_blog_reszie, $settings->crop_height_blog_reszie, function($ratio){
                        //$ratio->aspectRatio();
                    });
                }

                $img_->save($location_)->destroy();
                $old->img_title = $image_name;
                $old->save();
        }
        return response()->json(['success' => $image_name]);
    }

    public function settings(Request $request)
    {
        if(isset($request->post_status)){
                foreach ($request->post_status as $ke => $valu) {
                   if(is_numeric($ke)){
                        $old = Blog::find($ke);
                        if(isset($old->status)){
                            if($valu[0] == 1){
                                Blog::where('id', $ke)->update([ 'status' => 'published']);
                            }else if($valu[0] == 0){
                                Blog::where('id', $ke)->update([ 'status' => 'unpublished']);
                            }
                        }
                }
            }
            Session::flash('success', 'The posts Was Succesfully Updated');
        }
        if(isset($request->post_delete)){
            foreach ($request->post_delete as $kes => $valus) {
                       if(is_numeric($kes)){
                                if($valus[0] == 0){
                                    $old_ = Blog::where('id', $kes)->first();
                                    if(isset($old_)){
                                         unlink(public_path('img/upload/' . $old_->img_title)); 
                                         $old_->delete();
                                    }
                                }
                        }
            }
            Session::flash('success', 'The posts Was Succesfully Updated');
        }
        #
        $passed_ = false;
        if(isset($request->sort)){
          $all_blog = Blog::all();
          $j = 1;
          foreach ($all_blog as $blog) {
              Blog::where('id', $blog->id)->update([
                        'sort_order' => $j,
              ]);
              $j++;
          }
  
          foreach ($request->sort as $kj => $vj) {
                  if(is_numeric($kj)){
                      if(is_numeric($vj[0])){
                          Blog::where('id', $kj)->update([
                                    'sort_order' => $vj[0],
                           ]);
                          $passed_ = true;
                      }
                }
          }

          if($passed_){
                Session::flash('success_order', 'All Number order of posts was successfully updated.');
           }

        }
        return back();
    }
}
