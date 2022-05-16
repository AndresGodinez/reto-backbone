<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ImportFileController extends Controller
{
    public function index(): Response
    {
        return response(view('import-data'));
    }

    public function import(Request $request): Response
    {
        $file = $request->file('file');
        $file->storeAs('public', $file->getClientOriginalName());

        return response(view('import-data'));
    }

}
