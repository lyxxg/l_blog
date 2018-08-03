<?php

namespace App\Http\Controllers\Test;

use App\Models\Collection;
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
