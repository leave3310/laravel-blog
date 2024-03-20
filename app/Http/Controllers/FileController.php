<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostFileRequest;
use App\Utilities\ApiResponseTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class FileController extends Controller
{
    use ApiResponseTrait;

    public function postFile(PostFileRequest $request): JsonResponse
    {
        $image = $request->file('file');
        $file_path = $image->store('public');

        return $this->successResponse(["url" => Storage::url($file_path)], "圖片上傳成功", ResponseAlias::HTTP_OK);
    }
}
