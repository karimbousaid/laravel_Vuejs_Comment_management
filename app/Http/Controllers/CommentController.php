<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Validation\Validator;

class CommentController extends Controller
{
    public function store() 
    {
         request()->validate([
            'name' => 'required',
            'body' => 'url',
            'body' => 'required'
         ]);

        return Comment::create([
          'respond_to_id' => request('respond_to_id'),
          'name' => request('name'),
          'url' => request('url'),
          'body' => request('body'),
        ])->setRelation('children', collect());

    }
    public function index($url) 
    {
         $comments = Comment::where('url' , base64_decode($url))
         ->whereNull('respond_to_id')
         ->paginate(2);
         return $comments;
    }
}
