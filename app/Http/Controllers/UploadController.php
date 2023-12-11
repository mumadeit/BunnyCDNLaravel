<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BunnyCDNService;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    /**
     * Upload Page.
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Uploading the files to BunnyCDN Using A Post Method.
     *
     */
    public function store(Request $request)
    {
        // Validate the file
        $request->validate([
            'file' => 'required|mimes:png,jpg,jpeg|max:5048',
        ]);

        // Initialize the BunnyCDN Service
        $bunnyCDNService = new BunnyCDNService();

        // Get the file from the request
        $file = $request->file('file');


        // Get the current date
        $today = date('Y-m-d');


        // Get the file name
        $fileName = $today . '-' . Str::random(10) . '.' . $file->getClientOriginalExtension();

        // Get the file path
        $filePath = $file->getPathname();

        // Upload the file to BunnyCDN
        $bunnyCDNService->uploadImage($filePath, $fileName);

        $uri = env('CDN_URL') . '/' . env('BUNNYCDN_DIR') . '/' . $fileName;

        // Return the response
        return back()
            ->with('success', 'You have successfully uploaded your file. ✅' . ' ' . 'Your file URL is: ' . $uri)
            ->with('file', $fileName);
    }
}
