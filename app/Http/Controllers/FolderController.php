<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;
// Authクラスをインポート
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders/create');
    }

    public function create(Request $request)
    {
    // フォルダモデルのインスタンスを作成する
    $folder = new Folder();
    // タイトルに入力値を代入する
    $folder->title = $request->title;
    // ユーザーに紐づけて保存
    Auth::user()->folders()->save($folder);
    // インスタンスの状態をデータベースに書き込む
    $folder->save();

    return redirect()->route('tasks.index', [
        'folder' => $folder,
    ]);
    }
}
