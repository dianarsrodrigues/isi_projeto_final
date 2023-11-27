<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BandsController extends Controller
{
    public function getAll() {
        $bands = $this->allBands();
        $search = request()->query('search') ? request()->query('search') : null;

        if ($search) {
            $bands = Band::where('name', "LIKE", "%{$search}%")->get();
        }
        return view('bands.all_bands', compact('bands'));
    }

    protected function allBands() {
        $bands = DB::table('bands')
        ->select('bands.*', DB::raw('COUNT(albums.id) as totalAlbums'))
        ->leftJoin('albums', 'bands.id', '=', 'albums.band_id')
        ->groupBy('bands.id')
        ->get();

        return $bands;
    }
    public function addBand(Request $request) {
        $id = $request->query('id');

        $band = DB::table('bands')
        ->where('id', $id)
        ->first();

        return view('bands.add_band', compact('band'));
    }

    public function storeBand(Request $request) {

        $validated = $request->validate([
            'name' => 'string|max:50|required',
            'image' => 'image',
        ]);

        if ($request->hasFile('image')) {
            $image = Storage::putFile('bandsPhotos', $request->image);
        } else {
            $image = "";
        }

        $band = DB::table('bands')
        ->insert([
            'name' => $request->name,
            'image' => $image,
            'created_at' => new DateTime(),
        ]);
        return redirect()->route('bands.all')->with('message', 'Banda adicionado com sucesso');
    }

    public function updateBand(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'string|max:50|required',
            'image' => 'image',
        ]);

        $band = DB::table('bands')
        ->where('id', $id)
        ->first();

        if ($request->hasFile('image')) {
            Storage::delete($band->image);
            $image = Storage::putFile('bandsPhotos', $request->image);
        } else {
            $image = $band->image;
        }

        $band = DB::table('bands')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'image' => $image,
            ]);

        return redirect()->route('bands.all')->with('message', 'Banda atualizado com sucesso');
    }

    public function deleteBand($id) {
        $albums = DB::table('albums')
        ->where('band_id', $id)
        ->delete();

        $band = DB::table('bands')
        ->where('id', $id)
        ->delete();

        return redirect()->route('bands.all')->with('message', 'Banda eliminado com sucesso');
    }

}
