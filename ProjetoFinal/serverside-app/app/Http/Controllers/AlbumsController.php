<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AlbumsController extends Controller
{
    public function getAll($id) {
        $albums = DB::table('albums')
        ->join('bands', 'bands.id', '=', 'albums.band_id')
        ->select('bands.name as bandname', 'albums.*')
        ->where('bands.id', $id)
        ->get();

        // dd($album);

        return view('albums.get_albums', compact('albums'));
    }

    public function getAlbums() {
        $albums = DB::table('albums')->get();
        return view('albums.get_albums', compact('albums'));
    }

    public function addAlbum(Request $request) {
        $id = $request->query('id');
        $bands = DB::table('bands')->get();

        $album = DB::table('albums')
        ->where('id', $id)
        ->first();

        return view('albums.add_album', compact('album', 'bands'));
    }

    public function storeAlbum(Request $request) {

        $validated = $request->validate([
            'name' => 'string|max:50|required',
            'release_at' => 'date|required',
            'image' => 'image',
            'band_id' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = Storage::putFile('albumsPhotos', $request->image);
        } else {
            $image = "";
        }

        $album = DB::table('albums')
        ->insert([
            'name' => $request->name,
            'release_at' => $request->release_at,
            'band_id' => $request->band_id,
            'created_at' => new DateTime(),
            'image' => $image
        ]);
        return redirect()->route('albums.view', $request->band_id)->with('message', 'Album adicionado com sucesso');
    }

    public function updateAlbum(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'string|max:50|required',
            'release_at' => 'date|required',
            'image' => 'image',
            'band_id' => 'required',
        ]);

        $album = DB::table('albums')
        ->where('id', $id)
        ->first();

        if ($request->hasFile('image')) {
            Storage::delete($album->image);
            $image = Storage::putFile('albumsPhotos', $request->image);
        } else {
            $image = $album->image;
        }

        $album = DB::table('albums')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'release_at' => $request->release_at,
                'image' => $image,
                'band_id' => $request->band_id
            ]);

        return redirect()->route('albums.view', $request->band_id)->with('message', 'Album atualizado com sucesso');
    }

    public function deleteAlbum(Request $request, $id) {

        $albums = DB::table('albums')
        ->where('id', $id)
        ->delete();

        return redirect()->route('albums.view', $request->band)->with('message', 'Album eliminado com sucesso');
    }
}
