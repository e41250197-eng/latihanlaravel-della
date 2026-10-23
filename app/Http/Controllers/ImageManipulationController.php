<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageManipulationController extends Controller
{
    // Form upload & dashboard hasil manipulasi gambar (Acara 31)
    public function index()
    {
        return view('acara31_image');
    }

    // Eksekusi berbagai teknik manipulasi gambar
    public function process(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $file = $request->file('photo');

        if ($file) {
            $manager = new ImageManager(Driver::class);
            $realPath = $file->getRealPath();
            $time = time();

            // 1. Gambar Asli (Original)
            $origName = $time . '_original.jpg';
            $imgOrig = $manager->decodePath($realPath);
            Storage::disk('public')->put('acara31/' . $origName, $imgOrig->encodeUsingFileExtension('jpg', quality: 90)->toString());

            // 2. Teknik Resize (300 x 200 px)
            $resizeName = $time . '_resized.jpg';
            $imgResize = $manager->decodePath($realPath)->resize(300, 200);
            Storage::disk('public')->put('acara31/' . $resizeName, $imgResize->encodeUsingFileExtension('jpg', quality: 85)->toString());

            // 3. Teknik Crop (250 x 250 px persegi)
            $cropName = $time . '_cropped.jpg';
            $imgCrop = $manager->decodePath($realPath)->cover(250, 250);
            Storage::disk('public')->put('acara31/' . $cropName, $imgCrop->encodeUsingFileExtension('jpg', quality: 85)->toString());

            // 4. Teknik Rotate (Putar 45 Derajat)
            $rotateName = $time . '_rotated.jpg';
            $imgRotate = $manager->decodePath($realPath)->rotate(45);
            Storage::disk('public')->put('acara31/' . $rotateName, $imgRotate->encodeUsingFileExtension('jpg', quality: 85)->toString());

            return back()->with('results', [
                'original' => 'acara31/' . $origName,
                'resized'  => 'acara31/' . $resizeName,
                'cropped'  => 'acara31/' . $cropName,
                'rotated'  => 'acara31/' . $rotateName,
            ])->with('success', 'Gambar berhasil diproses dengan teknik Resize, Crop, dan Rotate!');
        }

        return back()->with('error', 'Gagal memproses gambar.');
    }
}
