<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Twin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TwinController extends Controller
{
    public function __construct()
    {
        $twinToken = config('app.twin_token');
        if ($twinToken !== request('twin_token')) {
            throw new \Exception('Wrong Twin Token');
        }
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'files' => 'array|required',
            'file.*' => 'file',
            'twin_external_id' => 'required|exists:twins,twin_external_id',
        ]);

        $twin = Twin::query()->where('twin_external_id', $request->twin_external_id)->first();
        $files = [];
        foreach ($request['files'] as $file) {
            $files[] = File::query()
                ->create([
                    'path' => $file->store('x_coach/files/'. $twin->id , 's3') ,
                    'name' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                    'size' => $file->getSize(),
                    'twin_id' => $twin->id,
                ]);
        }


        return response()->json([
            'message' => 'File uploaded successfully',
            'data' => $files
        ]);
    }


    public function removeFile(Request $request)
    {
        $request->validate([
            'file_path' => 'required',
        ]);
        $fileToDelete = File::query()->where('path', $request->file_path)->first();
        if (!$fileToDelete) {
            return response()->json([
                'message' => 'File not found',
            ], 404);
        }

        $fileToDelete->delete();
        \Storage::disk('s3')->delete($fileToDelete->getAttributes()['path']);

        return response()->json([
            'message' => 'File removed successfully',
        ]);
    }


    public function update(Request $request)
    {
        $request->validate([
            'twin_external_id'  => 'required|exists:twins,twin_external_id',
        ]);

        $twin = Twin::query()->where('twin_external_id', $request->twin_external_id)->first();
        $twin->update($request->all());
        return response()->json([
            'message' => 'File updated successfully',
            'data' => $twin
        ]);
    }


    public function train(Request $request)
    {
        $request->validate([
            'twin_external_id' => 'required|exists:twins,twin_external_id',
        ]);

        $twin = Twin::query()->where('twin_external_id', $request->twin_external_id)->first();
        $files  = File::query()->where('twin_id', $twin->id)->select('path')->get()->toArray();
        $filesToSend  = [] ;
        foreach ( $files as $fileToSend){
            $filesToSend[] = $fileToSend['path'];
        }

        if( ! empty( $filesToSend ) ){
            $r = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post(config('app.django_url').'/api/create-db',[
                'files' => $filesToSend,
                'twin_id' => $twin->twin_external_id,
            ]);
        }

        return response()->json([
            'message' => 'Training Started',
            'data' => $filesToSend
        ]);
    }
}
