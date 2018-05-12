<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\image;
use App\register;
use App\banner;
use App\homepage_service;
use App\aboutus;
use App\partners;
use App\contactarea;
use App\packagecat;
use App\package;
use App\service;
use App\portfolio;
use App\about_info;
use App\skill;
use App\team;
use App\contact;
use App\templateview;
use App\signup;

class adminController extends Controller
{
    public function index(){
      $contact=contact::all();
      $signupm=signup::all();
    	return view('admin.index')->with('contact',$contact)->with('signup',$signupm);
    }
    public function logo(){
      $show=image::first();
      $register=register::all();
    	return view('admin.common.logo')->with('logoname', $show)->with('registershow',$register);

    }
   public function uploadlogo(Request $request)
   {
    $check=image::first();
    if(isset($check->filename)){
      if($check->filename!=''){
        unlink(public_path('images/logo/'.$check->filename));
      }
      if($request->hasFile('pic')){
      $this->validate($request, ['pic' => 'required|sometimes|image']);
      $file = $request->file('pic');
      $filename = md5(date('Y-m-d h:m:s') . microtime()) . time() . '_attach_.' . $file->getClientOriginalExtension();
      $localtion = public_path('images/logo/');
      $file->move($localtion, $filename);
      $image = image::find($check->id);
      $image->filename = $filename;
      $image->save();
      return  back()->with('success','Successfully');
    }
    }
   	if($request->hasFile('pic')){
   		$this->validate($request, ['pic' => 'required|sometimes|image']);
   		$file = $request->file('pic');
   		$filename = md5(date('Y-m-d h:m:s') . microtime()) . time() . '_attach_.' . $file->getClientOriginalExtension();
   		$localtion = public_path('images/logo/');
   		$file->move($localtion, $filename);
   		$image = new image;
   		$image->filename = $filename;
   		$image->save();
   		return  back()->with('success','Successfully');
   	}
   }
   public function register(Request $request){
    $this->validate($request, ['name'=>'required','surname'=>'required']);
    $register=new register;
    $register->name=$request->name;
    $register->surname=$request->surname;
    $register->save();
    return back()->with('success','Sucess saved!');
   }
   public function edit(Request $request, $id)
   {
      $this->validate($request, ['name'=>'required', 'surname'=>'required']);
      $update=register::find($id);
      $update->name=$request->name;
      $update->surname=$request->surname;
      $update->save();
      return back();
   }
   public function delete($id)
   {
     $delete=register::find($id);
     $delete->delete();
     return back()->with('success','Successfully');
   }
   public function banner_delete($id){
    $delete=banner::find($id);
    $delete->delete();
    return back()->with('success','Successfully');
   }
   public function banner(){
    $show=banner::all();
    return view('admin.common.banner')->with('banner_name', $show);
   }
   public function uploadbanner(Request $request){
        if($request->hasFile('banner1')){
      $this->validate($request, ['banner1' => 'required|sometimes|image']);
      $file = $request->file('banner1');
      $banner_name = md5(date('Y-m-d h:m:s') . microtime()) . time() . '_attach_.' . $file->getClientOriginalExtension();
      $localtion = public_path('images/banners/');
      $file->move($localtion, $banner_name);
      $image = new banner;
      $image->banner_name = $banner_name;
      $image->save();
      return  back()->with('success','Successfully');
    }
   }
   public function homepage_service(){
    $show=homepage_service::all();
    return view('admin.common.homepage_services')->with('service_name', $show);
   }
   public function homepage_service_post(Request $request){
    
    $this->validate($request, ['logo_name'=>'required','service_name'=>'required','service_discription'=>'required']);
    $upload=new homepage_service;
    $upload->logo_name=$request->logo_name;
    $upload->service_name=$request->service_name;
    $upload->service_discription=$request->service_discription;
    $upload->save();
    return back()->with('success','Sucess saved!');
   }
   public function h_service_delete($id){
    $delete=homepage_service::find($id);
    $delete->delete();
    return back()->with('success','Successfully');
   }
   public function homepage_service_e($id){
    $show=homepage_service::find($id);
    return view('admin.common.service_edit')->with('service_show',$show);
   }
   public function service_edit(Request $request, $id){
      $this->validate($request, ['logo_name'=>'required', 'service_name'=>'required', 'service_discription'=>'required']);
      $update=homepage_service::find($id);
      $update->logo_name=$request->logo_name;
      $update->service_name=$request->service_name;
      $update->service_discription=$request->service_discription;
      $update->save();
      return redirect()->route('admin.homepage_service');
   }
   public function aboutus(){
    $display=aboutus::all();
    return view('admin.common.aboutus')->with('about_display',$display);
   }
   public function aboutusupload(Request $request){
      $this->validate($request, ['aboutpic' => 'required|sometimes|image', 'company_name'=>'required', 'company_info'=>'required']);
      $file = $request->file('aboutpic');
      $profile_image_name = md5(date('Y-m-d h:m:s') . microtime()) . time() . '_attach_.' . $file->getClientOriginalExtension();
      $localtion = public_path('images/');
      $file->move($localtion, $profile_image_name);
      $upload = new aboutus;
      $upload->profile_image_name=$profile_image_name;
      $upload->company_name=$request->company_name;
      $upload->company_info=$request->company_info;
      $upload->save();
      return  back()->with('success','Successfully');
   }
   public function aboutdelete($id){
    $delete=aboutus::find($id);
    $delete->delete();
    return back()->with('success','Successfully');
   }
   public function partners()
   {
    $show=partners::where('type','partner_logo')->get();
     return view('admin.common.partners')->with('partner_logo_show',$show);
   }
   public function partnerstore(Request $request){

     $check=partners::where('type','background')->first();
    if(isset($check->image_name)){
    if ($request->hasFile('background')) {
      if($check->image_name!=''){
        unlink(public_path('images/partners/'.$check->image_name));
      }
      $check->delete();
    $this->validate($request, ['background' => 'required|sometimes|image']);
    $file=$request->file('background');
    $image_name = md5(date('Y-m-d h:m:s') . microtime()) . time() . '_attach_.' . $file->getClientOriginalExtension();
    $location = public_path('images/partners/');
    $file->move($location, $image_name);
    $upload = new partners;
    $upload->type='background';
    $upload->image_name = $image_name;
    $upload->save();
    }
}else{
   if ($request->hasFile('background')) {
    $this->validate($request, ['background' => 'required|sometimes|image']);
    $file=$request->file('background');
    $image_name = md5(date('Y-m-d h:m:s') . microtime()) . time() . '_attach_.' . $file->getClientOriginalExtension();
    $location = public_path('images/partners/');
    $file->move($location, $image_name);
    $upload = new partners;
    $upload->type='background';
    $upload->image_name = $image_name;
    $upload->save();
}
}
    if ($request->hasFile('logo')) {

    $this->validate($request, ['logo' =>'required|sometimes|image']);

    $file=$request->file('logo');
    $image_name = md5(date('Y-m-d h:m:s') . microtime()) . time() . '_attach_.' . $file->getClientOriginalExtension();
    $location = public_path('images/partners/');
    $file->move($location, $image_name);
    $upload = new partners;
    $upload->type='partner_logo';
    $upload->image_name = $image_name;
    $upload->save();
    
    }
    return back()->with('success','Successfully');
   }

   public function partnerdelete($id){

     $delete=partners::find($id);
     $delete->delete();
     unlink(public_path('images/partners/'.$delete->image_name));
     return back()->with('success','Successfully');
   }

   public function contactarea()
   {
    $show=contactarea::first();
     return view('admin.common.contactarea')->with('contactshow',$show);
   }
   public function contactarea_upload(Request $request)
   {
     $this->validate($request, ['email'=>'required','phone1'=>'required','phone2'=>'required']);
     $contact=contactarea::all();
     if($contact->count()>0){
      return back()->with('success','Successfully');
     }
     $upload=new contactarea;
     $upload->email=$request->email;
     $upload->phone_number1=$request->phone1;
     $upload->phone_number2=$request->phone2;
     $upload->save();
     return back()->with('success','Successfully');
   }
   public function contactarea_update(Request $request, $id)
   {
      $update=contactarea::find($id);
      $update->email=$request->email;
      $update->phone_number1=$request->phone1;
      $update->phone_number2=$request->phone2;
      $update->save();
      return back()->with('success','Updated');
   }
   public function package()
   {

    $show=packagecat::all();
    $package=package::all();
     return view('admin.common.package')->with('display', $show)->with('package', $package);
   }
    public function packagecat()
   {
     $show=packagecat::all();
     return view('admin.common.packagecat')->with('display', $show);
   }
   public function packagecatupload(Request $request){

    $this->validate($request, ['packagecat'=>'required','image'=>'required|sometimes|image']);

    $file=$request->file('image');
    $image = md5(date('Y-m-d h:m:s') . microtime()) . time() . '_attach_.' . $file->getClientOriginalExtension();
    $location = public_path('images/templatepackage/');
    $file->move($location, $image);
    $category= new packagecat;
    $category->image=$image;
    $category->name=$request->packagecat;
    $category->save();
    return back()->with('success','Successfully');
   }

   public function packagecatdelete($id)
   {
     $delete=packagecat::find($id);
     $pack=package::where('cat_id',$id);
     $pack->delete();
     if(unlink(public_path() . '/'. 'images/templatepackage/'. $delete->image)){}
     $delete->delete();
     return back()->with('success','Successfully');
   }
   public function packagecatupdate(Request $request, $id)
   {
    $update=packagecat::find($id);
    if($request->hasFile('image')){
    $file=$request->file('image');
    $image = md5(date('Y-m-d h:m:s') . microtime()) . time() . '_attach_.' . $file->getClientOriginalExtension();
    $location = public_path('images/templatepackage/');
    $file->move($location, $image);
    if(unlink(public_path() . '/'. 'images/templatepackage/'. $update->image)){}
    $update->image=$image;
    $update->name=$request->categoryname;
    $update->save();
    }
     return back();
   }
   public function packageupload(Request $request)
   {

     $this->validate($request, ['price'=>'required','type'=>'required','web'=>'required','package_name'=>'required']);
     $upload=new package;
     $upload->price=$request->price;
     $upload->cat_id=$request->web;
     $upload->type=$request->type;
     $order_number = -1;
     if($request->type=='basic'){
        $order_number = 0;
     }else if($request->type=='standard'){
        $order_number = 1;
     }else {
        $order_number = 2;
     }
     $upload->sort_order=$order_number;
     $upload->package_name=$request->package_name;
     $upload->save();
     return back()->with('success','Successfully');

   }
   public function packageupdate(Request $request, $id)
   {
     $this->validate($request, ['price'=>'required','type'=>'required','web'=>'required','package_name'=>'required']);
     $update=package::find($id);
     $update->price=$request->price;
     $update->cat_id=$request->web;
     $update->type=$request->type;
     $order_number = -1;
     if($request->type=='basic'){
        $order_number = 0;
     }else if($request->type=='standard'){
        $order_number = 1;
     }else {
        $order_number = 2;
     }
     $update->sort_order=$order_number;
     $update->package_name=$request->package_name;
     $update->save();
     return back();
   }
   public function packagedelete(Request $request, $id)
   {
     $delete=package::find($id);
     $delete->delete();
     return back()->with('success','Successfully');
   }




   public function service()
   {
     $service1=service::all();
     return view('admin.common.service')->with('ser_action',$service1);
   }

   public function serviceupload(Request $request)
   {

    
     $this->validate($request,['pic1'=>'required|sometimes|image','pic2'=>'required|sometimes|image','discription1'=>'required','discription2'=>'required']);
    service::truncate();
     if($request->hasFile('pic1')){
    $file=$request->file('pic1');
    $image_name = md5(date('Y-m-d h:m:s') . microtime()) . time() . '_attach_.' . $file->getClientOriginalExtension();
    $location = public_path('images/services/');
    $file->move($location, $image_name);
    $upload = new service;
    $upload->type='image1';
    $upload->image_name = $image_name;

    $upload->discription=$request->discription1;

    $upload->save();
  }

  if($request->hasFile('pic2')){
    $file=$request->file('pic2');
    $image_name = md5(date('Y-m-d h:m:s') . microtime()) . time() . '_attach_.' . $file->getClientOriginalExtension();
    $location = public_path('images/services/');
    $file->move($location, $image_name);
    $upload = new service;
    $upload->type='image2';
    $upload->image_name = $image_name;
    $upload->discription=$request->discription2;
    $upload->save();

   }
   return back()->with('success','Successfully');
  }

  public function servicedelete(Request $request, $id)
  {
    $delete=service::find($id);
    $delete->delete();
    return back()->with('success','Successfully');
  }

  public function portfolio()
  {
    $portfolio=portfolio::all();
    return view('admin.common.portfolio')->with('portfolio',$portfolio);
  }
  public function portfolioupload(Request $request)
  {

    $this->validate($request,['website'=>'required|sometimes|image','company'=>'required','address'=>'required']);
     if($request->hasFile('website')){
    $file=$request->file('website');
    $image_name = md5(date('Y-m-d h:m:s') . microtime()) . time() . '_attach_.' . $file->getClientOriginalExtension();
    $location = public_path('images/portfolios/');
    $file->move($location, $image_name);
    $upload = new portfolio;
    $upload->image_name =$image_name;
    $upload->company_name=$request->company;
    $upload->address=$request->address;
    $upload->save();
    return back()->with('success','Successfully');
  }
  }
  public function portfoliodelete(Request $request,$id)
  {
    $delete=portfolio::find($id);
    $delete->delete();
    return back()->with('success','Successfully');
  }

  public function information()
  {
    return view('admin.common.information');
  }

  public function info_upload(Request $request){
    $this->validate($request, ['image'=>'required|sometimes|image','slogan'=>'required','discription'=>'required']);
    about_info::truncate();
    if($request->hasFile('image')){
    $file=$request->file('image');
    $profile = md5(date('Y-m-d h:m:s') . microtime()) . time() . '_attach_.' . $file->getClientOriginalExtension();
    $location = public_path('images/About/');
    $file->move($location, $profile);
    $upload = new about_info;
    $upload->profile = $profile;
    $upload->slogan=$request->slogan;
    $upload->discription=$request->discription;
    $upload->save();
    return back()->with('success','Successfully');
  }
}
public function skill()
{
  $skill=skill::all();
  return view('admin.common.skill')->with('skill',$skill);
}
public function skillstore(Request $request){

  $this->validate($request, ['skill_name'=>'required','color'=>'required','percentage'=>'required']);
  $upload=new skill;
  $upload->skill_name=$request->skill_name;
  $upload->color=$request->color;
  $upload->percent=$request->percentage;
  $upload->save();
  return back()->with('success','Successfully');
}

public function skillupdate(Request $request,$id)
{
  $this->validate($request, ['skill_name'=>'required','color'=>'required','percentage'=>'required']);
  $update=skill::find($id);
  $update->skill_name=$request->skill_name;
  $update->color=$request->color;
  $update->percent=$request->percentage;
  $update->save();
  return back()->with('success','Successfully');
  
}

public function skilldelete(Request $request,$id)
{
  $delete=skill::find($id);
  $delete->delete();
  return back()->with('success','Successfully');
}
public function team()
{
  $team=team::all();
  return view('admin.common.team')->with('team',$team);
}
public function teampost(Request $request)
{
  $this->validate($request, ['profile'=>'required|sometimes|image','name'=>'required','email'=>'required','phone'=>'required','facebook'=>'required']);
  if($request->hasFile('profile')){
    $file=$request->file('profile');
    $profile = md5(date('Y-m-d h:m:s') . microtime()) . time() . '_attach_.' . $file->getClientOriginalExtension();
    $location = public_path('images/About/');
    $file->move($location, $profile);
    $upload=new team;
    $upload->profile_name=$profile;
    $upload->name=$request->name;
    $upload->position=$request->position;
    $upload->email=$request->email;
    $upload->phone=$request->phone;
    $upload->facebook=$request->facebook;
    $upload->save();
    return back()->with('success','Successfully');

  }
}

public function teamdelete(Request $request,$id)
{
  $delete=team::find($id);
  $delete->delete();
  return back()->with('success','Successfully');
}

public function template()
{
  $pack=packagecat::all();
  $template=templateview::all();
  return view('admin.common.template')->with('pack',$pack)->with('template',$template);
}

public function templatepost(Request $request)
{
  $this->validate($request,['template_url'=>'required','cate'=>'required','image'=>'required|sometimes|image']);
  if($request->hasFile('image')){
    $file=$request->file('image');
    $image = md5(date('Y-m-d h:m:s') . microtime()) . time() . '_attach_.' . $file->getClientOriginalExtension();
    $location = public_path('images/templateview/');
    $file->move($location,$image);
    $upload=new templateview;
    $upload->image=$image;
    $upload->template=$request->template_url;
    $upload->cat_id=$request->cate;
    $upload->save();
    return back()->with('success','Successfully');
  }
}

public function templateupdate(Request $request,$id)
{
   $this->validate($request,['template_url'=>'required','cate'=>'required','image'=>'required|sometimes|image']);
   $update=templateview::find($id);
     if($request->hasFile('image')){
    $file=$request->file('image');
    $image = md5(date('Y-m-d h:m:s') . microtime()) . time() . '_attach_.' . $file->getClientOriginalExtension();
    $location = public_path('images/templateview/');
    $file->move($location,$image);
    if(unlink(public_path() . '/'. 'images/templateview/'. $update->image)){}
    $update->image=$image;
    $update->template=$request->template_url;
    $update->cat_id=$request->cate;
    $update->save();
    return back()->with('success','Successfully');
  }

}
public function signupdelete($id)
{
  $delete=signup::find($id);
  $delete->delete();
  return back()->with('success','Delete Successfully');
}
}
