<?php

namespace App\Http\Controllers\Blog;

use App\Facades\BlogFacade;
use App\Http\Requests\Blog\ArticlePost;
use App\Jobs\TopicRepled;
use App\Models\Answer;
use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Collection;
use App\Models\Comment;
use App\Models\Focu;
use App\Models\Tag;
use App\Services\BlogService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use function PHPSTORM_META\type;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $articles=Article::with(['tags','user.info'])->Where('del','0')
         ->orderBy('created_at','desc')->paginate(8);

        //焦点图
        $focus = \Redis::get('focus');

        if(empty($focus)){
            $focus = Focu::select('sico','href','title')->get();
            \Redis::set("focus",$focus);
            }
        $focus=json_decode($focus);

        //热门文章
        $taghots =Tag::all()->sortByDesc('hot')->take(10);

        return view("Blog.article.index",compact('articles','focus','taghots'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view("Blog.article.create");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticlePost $request)
    {


        $user_id=Auth::id();
        $data=$request->all();
        $data['user_id']=$user_id;
        //DB::beginTransaction();//真想换成innodb


        $tags=$request->tag_id;

        if(!empty($tags))
        $article = Article::create($data);
        else
        return back()->withErrors('为选择标签');


        if($article) {

            //添加标签和问题关联表
        foreach ($tags as $v) {
            $qt = new ArticleTag();
            $qt->article_id = $article->id;
            $qt->tag_id = $v;
            $qt->save();
        }
       }else{
            return back()->withErrors('文章添加失败');
        }

        return redirect('/');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Answer $answer,Comment $comment)
    {

        $auth_id=Auth::id();
        //是否是收藏 and 是否是作者  是为1
        $Mdata=array(
            'collect'=>0,
            'is'=>0,
        );
        $Mdata['collect']=Collection::Where('user_id',$auth_id)->Where('article_id',$id)->get();
        if(empty($Mdata['collect']->first())){
            $Mdata['collect']=0;
        }


        $article=Article::find($id);

        //楼中楼评论 没法优化了
        $answers=$answer::With('comments.fathercomment')->where('article_id',$article->id)->get();
        if($auth_id==$article->user_id){
            $Mdata['is']=1;
        }

        return view("Blog.article.show",compact('article','Mdata','answers'));


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

    public function imageupload(Request $request)
    {

        $message='';
        $url=$request->file('editormd-image-file')->store('avatar');

     //   $url = Storage::putFile('avatars', $request->file('editormd-image-file'));
       $url=Storage::url($url);

        $data = array(
            'success' => empty($message) ? 1 : 0,  //1：上传成功  0：上传失败
            'message' => $message,
            'url' => !empty($url) ? $url : ''
        );

        header('Content-Type:application/json;charset=utf8');
        exit(json_encode($data));

    }

}
