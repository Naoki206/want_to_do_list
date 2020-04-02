<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //ログインユーザーを取得する
        $folder = Auth::user()->folders()->first();
        
        //フォルダを作成したことがな場合はホーム画面にリダイレクト
        if (is_null($folder)) {
            return view('home');
        }

        // フォルダがあればそのフォルダのタスク一覧にリダイレクトする
        return redirect()->route('tasks.index', [
            'folder' => $folder,
        ]);
    }
}
