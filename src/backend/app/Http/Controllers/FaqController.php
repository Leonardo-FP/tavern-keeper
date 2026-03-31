<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        return response()->json(
            Faq::orderBy('order')->paginate(5)
        );
    }

    public function create()
    {
        //
    }

    public function store(StoreFaqRequest $request)
    {
        //
    }

    public function show(Faq $faq)
    {
        //
    }

    public function edit(Faq $faq)
    {
        //
    }

    public function update(UpdateFaqRequest $request, Faq $faq)
    {
        //
    }

    public function destroy(Faq $faq)
    {
        //
    }
}
