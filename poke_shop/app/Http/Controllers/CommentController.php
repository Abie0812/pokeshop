<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\Models\Pokemon;
use App\Models\User;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        // $this->validate($request, [
        //     'description'=>'required|min:5', 
        // ]);
        
        $pokemon = Pokemon::findOrFail($id);
        // dd($pokemon);

        $comment = Comment::create([
            'description'=>$request->desc, 
            'pokemon_id'=>$id,
            'user_id'=>Auth::user()->id, 
        ]);

        return redirect('/pokemon/'. $comment->pokemon->slug)->with('msg', 'Komentar Berhasil Di Kirim');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('member.comment.edit', compact('comment') );
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        if($comment->isOwner())
            $comment->update([
                'description'=>$request->description,
            ]);
        else abort(403);

        return redirect('/pokemon/'. $comment->pokemon->slug)->with('msg-edit', 'Komentar Berhasil Di Edit');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        
        if($comment->isOwner())
            $comment->delete();
        else abort(403);

        return redirect('/pokemon/'. $comment->pokemon->slug)->with('msg-delete', 'Komentar Berhasil Di Hapus');
    }
}
