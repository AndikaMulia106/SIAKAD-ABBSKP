<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingController extends Controller
{
    public function edit()
    {
        $data = [];
        if (Storage::exists('landing.json')) {
            $data = json_decode(Storage::get('landing.json'), true);
        }
        return view('admin.landing-edit', compact('data'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'hero_title'     => 'required|string',
            'hero_desc'      => 'required|string',
            'siswa'          => 'required|integer',
            'guru'           => 'required|integer',
            'mapel'          => 'required|integer',
            'kelas'          => 'required|integer',
            'activities'     => 'array',
            'quick_actions'  => 'array',
            'quick_links'    => 'array',
        ]);

        Storage::put('landing.json', json_encode($validated));
        return redirect()->route('admin.landing.edit')->with('success', 'Landing page berhasil diperbarui!');
    }
}
