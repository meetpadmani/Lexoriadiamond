<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChunkUploadController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('file');

        // Resumable.js parameters (1-indexed)
        $chunkNumber = (int) $request->input('resumableChunkNumber', 1);
        $totalChunks = (int) $request->input('resumableTotalChunks', 1);
        $filename = $request->input('resumableFilename', 'video.mp4');
        $identifier = $request->input('resumableIdentifier', $filename);

        // Sanitize identifier for directory name
        $identifier = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $identifier);

        $chunkDir = storage_path('app/chunks/' . $identifier);

        // Create chunk directory
        if (!file_exists($chunkDir)) {
            mkdir($chunkDir, 0755, true);
        }

        // Store chunk with its original number (1-indexed)
        $chunkPath = $chunkDir . '/chunk_' . $chunkNumber;
        $file->move($chunkDir, 'chunk_' . $chunkNumber);

        Log::info("Chunk {$chunkNumber}/{$totalChunks} uploaded for {$filename}");

        // Count how many chunks we have
        $uploadedChunks = count(glob($chunkDir . '/chunk_*'));

        Log::info("Uploaded chunks: {$uploadedChunks} of {$totalChunks}");

        // If all chunks are uploaded, merge them
        if ($uploadedChunks >= $totalChunks) {
            return $this->mergeChunks($identifier, $totalChunks, $filename);
        }

        return response()->json([
            'status' => 'chunk_uploaded',
            'chunk' => $chunkNumber,
            'total' => $totalChunks
        ]);
    }

    private function mergeChunks($identifier, $totalChunks, $originalFilename)
    {
        $chunkDir = storage_path('app/chunks/' . $identifier);

        // Build safe output filename  
        $ext = pathinfo($originalFilename, PATHINFO_EXTENSION) ?: 'mp4';
        $safeName = time() . '_' . uniqid() . '.' . $ext;

        $videosDir = storage_path('app/public/videos');
        if (!file_exists($videosDir)) {
            mkdir($videosDir, 0755, true);
        }

        $finalPath = $videosDir . '/' . $safeName;

        // Merge all chunks in order (1-indexed from Resumable.js)
        $out = fopen($finalPath, 'wb');

        for ($i = 1; $i <= $totalChunks; $i++) {
            $chunkFile = $chunkDir . '/chunk_' . $i;

            if (file_exists($chunkFile)) {
                $in = fopen($chunkFile, 'rb');
                while (!feof($in)) {
                    fwrite($out, fread($in, 4096));
                }
                fclose($in);
                unlink($chunkFile);
                Log::info("Merged chunk {$i}");
            } else {
                Log::warning("Missing chunk {$i} at {$chunkFile}");
            }
        }

        fclose($out);

        // Remove chunk directory
        if (is_dir($chunkDir)) {
            @rmdir($chunkDir);
        }

        $fileSize = filesize($finalPath);
        Log::info("Video merged: {$safeName}, size: {$fileSize} bytes");

        return response()->json([
            'status' => 'completed',
            'path' => 'storage/videos/' . $safeName
        ]);
    }
}
