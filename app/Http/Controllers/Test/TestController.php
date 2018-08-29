<?php

namespace App\Http\Controllers\Test;

use App\Facades\BlogFacade;
use App\Models\Collection;
use App\Models\Count;
use  Blog;
use App\Events\DXEvent;
use App\Services\TokenManageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function PHPSTORM_META\type;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {



        dd(BlogFacade::getImgName());

        $i = rand(12, 666);
        while ($i < 666){
        echo "x";
             }

             dd("q");



       $res=BlogFacade::AllBrowser();
       if(in_array('google',$res)){
           dd("x");
       }
       dd($res);
        $ips=Count::Select('ip')->get();
        foreach ($ips as $ip) {
            echo $ip->ip.request()->ip();

            if ($ip->ip == request()->ip())
            {
                  dd("q");}

        }
        dd("x");

            //            dd(var_dump($request->ip()));
//            dd(var_dump($ip->ip));

            echo $ip->ip;
        dd("s");
        $a=5;
        if($a==(1 || 2 || 4)    ){
            dd("s");
        }
        dd("x");


        $res= "Chrome/68.0.3440.75";
        if( preg_match('#(.+)/#',$res, $match)){
        dd($match[1]);
        }
dd("x");
       $count=new \App\Models\Count();
        $ip=request()->ip();
        $res=$count->where('ip',$ip)->first();
        if(empty($res)) {
            $count->ip = $ip;
            $count->is_mobile = 1;
            $count->save();
        }else{
            dd("q");
        }

        $browser=BlogFacade::is_mobile();
        dd($browser);
        $a=array(
           1 =>'hello',
        );
        echo $a[1];

return view("test.index");
        dd("s");
        $dataArr=array(
            'code'=>0,
            'data'=>'',
            'msg'=>'收藏成功'
        );

        return json_encode($dataArr);



        $collect=new Collection();
        $result=$collect->Where('user_id',1)->Where('article_id',49)->get();
        if(empty($result->first())){
   dd("bull") ;
        }
        dd($result);
       // dd($res);
            $res = Blog::getSex(1);
        //echo $res;

        //  $res = TokenManage::getToken('Hello World');
       // dd($res);
   //    dd(event(new DXEvent($request)));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
