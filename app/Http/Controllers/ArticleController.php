<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Resources\Article as ArticleResource;
use Illuminate\Http\Response;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->slug!="all"){
           $articles =  Article::whereHas('category', function ($query) use($request) {
                return $query->where('slug',"=", $request->slug);
            })->get();
            return new Response($articles);

        }
        return new Response(Article::all());


    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new Response(Article::find($id));

    }


    public function store(Request $request)
    {
        $article = Article::create($request->all());
        if($article){
            $data =[
                'status'=>200,
                'msg'=>'Votre article a été bien ajouté',
                'article'=>$article
            ];
            return new Response($data);
        }
        $data =[
            'status'=>400,
            'msg'=>'une erreur s\'est produite'
        ];
        return new Response($data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        if($article){
            $article->update($request->all());
            $data =[
                'status'=>200,
                'msg'=>'Votre article a été bien modifié'
            ];
            return new Response($data);
        }
        $data =[
            'status'=>400,
            'msg'=>'une erreur s\'est produite'
        ];
        return new Response($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        if($article){
            $destroy = Article::destroy($id);
            if($destroy){
                $data =[
                    'status'=>200,
                    'msg'=>'Votre article a été bien supprimé'
                ];
                return new Response($data);
            }
        }

        $data =[
            'status'=>400,
            'msg'=>'une erreur s\'est produite'
        ];
        return new Response($data);



    }
}
