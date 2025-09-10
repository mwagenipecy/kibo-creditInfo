<?php

namespace App\Http\Controllers;

use App\Models\PartnerDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    /**
     * Download a partner document
     */
    public function download($type, $id)
    {
        try {
            // Find the document
            $document = PartnerDocument::where('document_type', $type)
                ->where('partner_id', $id)
                ->first();

            if (!$document) {
                return response()->json(['error' => 'Document not found'], 404);
            }

            // Check if file exists in storage
            if (!Storage::disk('public')->exists($document->file_path)) {
                return response()->json(['error' => 'File not found in storage'], 404);
            }

            // Return file download
            return Storage::disk('public')->download(
                $document->file_path,
                $document->file_name
            );

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to download document: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Preview a partner document
     */
    public function preview($type, $id)
    {
        try {
            // Find the document
            $document = PartnerDocument::where('document_type', $type)
                ->where('partner_id', $id)
                ->first();

            if (!$document) {
                return response()->json(['error' => 'Document not found'], 404);
            }

            // Check if file exists in storage
            if (!Storage::disk('public')->exists($document->file_path)) {
                return response()->json(['error' => 'File not found in storage'], 404);
            }

            // Get file content
            $fileContent = Storage::disk('public')->get($document->file_path);
            $mimeType = Storage::disk('public')->mimeType($document->file_path);

            // Return file response
            return response($fileContent)
                ->header('Content-Type', $mimeType)
                ->header('Content-Disposition', 'inline; filename="' . $document->file_name . '"');

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to preview document: ' . $e->getMessage()], 500);
        }
    }
}

