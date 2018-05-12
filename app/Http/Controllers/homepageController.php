<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\image;
use App\banner;
use App\homepage_service;
use App\aboutus;
use App\partners;
use App\contactarea;
use App\package;
use App\packagecat;
use App\service;
use App\portfolio;
use App\about_info;
use App\skill;
use App\team;
use App\contact;
use Mail;
use App\templateview;
use App\signup;
use App\Blog;
class homepageController extends Controller
{
    public function index(){
        $logo=image::first();
        $banner_name=banner::all();
        $homepage_service=homepage_service::all();
        $aboutus_display=aboutus::all();
        $partners=partners::where('type','partner_logo')->get();
        $background=partners::where('type','background')->first();
        $contact=contactarea::first();
        $blogs_gallery = Blog::where('status', 'published')->orderBy('sort_order', 'asc')->orderBy('sort_order', 'asc')->limit(3)->get();
    	return view('common.index')->with('logoname', $logo)->with('banner_name', $banner_name)->with('service_show',$homepage_service)->with('aboutus_display',$aboutus_display)->with('partner_display',$partners)->with('background_display',$background)->with('contactshow',$contact)->with('blogs_gallery', $blogs_gallery);
    }
    public function about(){
        $logo=image::first();
        $info=about_info::first();
        $skill=skill::all();
        $team=team::all();
    	return view('common.about')->with('logoname', $logo)->with('info',$info)->with('skill',$skill)->with('team',$team);
    }
    public function services(){
        $logo=image::first();
        $firstservice=homepage_service::limit(4)->get();
        $secondservice=homepage_service::where('id','>',4)->get();
        $image1=service::where('type','image1')->first();
        $image2=service::where('type','image2')->first();
    	return view('common.services')->with('logoname', $logo)->with('servicepage', $firstservice)->with('servicesecond',$secondservice)->with('service1', $image1)->with('service2',$image2);
    }
    public function templates(){
        $logo=image::first();
        $template=packagecat::all();
    	return view('common.templates')->with('logoname', $logo)->with('packagecate',$template);
    }
    public function portfolio(){
        $logo=image::first();
        $portfolio=portfolio::all();
    	return view('common.portfolio')->with('logoname', $logo)->with('portfolio',$portfolio);
    }
      public function plainblog(){
        $logo=image::first();
        $blogs = Blog::where('status', 'published')->orderBy('sort_order', 'asc')->paginate(2);
        $blogs_gallery = Blog::where('status', 'published')->orderBy('sort_order', 'asc')->inRandomOrder()->limit(3)->get();
    	return view('common.blog')->with('logoname', $logo)->with('blogs', $blogs)->with('blogs_gallery', $blogs_gallery);
    }
       public function contact(){
        $logo=image::first();
        $contact=contactarea::first();
    	return view('common.contact')->with('logoname', $logo)->with('contact',$contact);
    }
       public function Readblog(){
        $logo=image::first();
    	return view('common.Readblog')->with('logoname', $logo);
    }
      public function package(){
        $logo=image::first();
        $cats=packagecat::all();
        $show=packagecat::join('packages', 'packages.cat_id', '=', 'packagecats.id')->orderBy('packages.sort_order', 'asc')->get();
        $counts = [];
        foreach ($show as $sh) {
            $counts[$sh->cat_id][] = sizeof(array_filter(explode('^', $sh->package_name)));
        }
       

        return view('common.package')->with('logoname', $logo)->with('shows', $show)->with('cats', $cats)->with('counts', $counts);
    }

    public function contactpost(Request $request)
    {
        $this->validate($request, ['name'=>'required','email'=>'required','message'=>'required']);
        $upload=new contact;
        $upload->name=$request->name;
        $upload->email=$request->email;
        $upload->message=$request->message;
        $upload->save();
        $data=[];
        $data['name']=$upload->name;
        $data['email']=$upload->email;
        $data['messagebody']=$upload->message;
        Mail::send('common.mail', $data, function($message)use($data){
        $message->from ('info@mekong.digital');
        $message->to('phoud63@gmail.com');
        $message->subject('Message from Mekong Digital Works\'s customers');
        });
        return back()->with('success','ທ່ານໄດ້ສົ່ງຂໍ້ຄວາມເປັນທີ່ຮຽບຮ້ອຍແລ້ວ ຂໍ້ຄວາມຂອງທ່ານຈະຖືກຕອບຮັບໄວໆນີ້. ຂໍຂອບໃຈ');
    }

    public function contactdelete(Request $request,$id)
    {
        $delete=contact::find($id);
        $delete->delete();
        return back()->with('success','Delete successful');
    }

    public function templateview($id)
    {
       $logo=image::first();
       $templateview=templateview::join('packagecats', 'templateviews.cat_id', '=', 'packagecats.id')->where('templateviews.cat_id',$id)->select('templateviews.image as images', 'templateviews.template')->get();
        return view('common.templateview')->with('tem',$templateview)->with('logoname', $logo);
    }

public function signup($id)
{
    $existpackage=package::find($id);
     $logo=image::first();
    if(!isset($existpackage->id)){
        return back();
    }
    return view('common.signup')->with('exist',$id)->with('logoname', $logo);
}

public function blogread()
{
    return view('common.Readblog');
}

public function signuppost(Request $request)
{

    $this->validate($request,['name'=>'required','phone'=>'required','email'=>'required','message'=>'required']);
    $package=package::join('packagecats','packagecats.id','=','packages.cat_id')->where('packages.id','=',$request->pack_id)->first();
    $upload=new signup;
    $upload->cus_name=$request->name;
    $upload->cus_phone=$request->phone;
    $upload->cus_email=$request->email;
    $upload->cus_message=$request->message;
    $upload->pack_id=$request->pack_id;
    $upload->save();
    $data=[];
    $data['name']=$upload->cus_name;
    $data['email']=$upload->cus_email;
    $data['phone']=$upload->cus_phone;
    $data['package_cate']=$package->name;
    $data['packagetype']=$package->type;
    $data['link']=route('homepage.package');
    $data['messagebody']=$upload->cus_message;
    Mail::send('common.mailsignup', $data, function($message)use($data){
    $message->from ('info@mekong.digital');
    $message->to('phoud63@gmail.com');
    $message->subject('Message from Mekong Digital Works\'s customers');
    });
    return back()->with('success','ທ່ານໄດ້ສະມັກແພັກເກັດເປັນທີ່ຮຽບຮ້ອຍແລ້ວ ພະນັກງານຈະຕິດຕໍ່ຫາໄວໆນີ້. ຂໍຂອບໃຈ');
}
    
}
