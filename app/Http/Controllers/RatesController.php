<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RateService;
use Illuminate\Validation\ValidationException;

class RatesController extends Controller
{
    protected $rateService;

    public function __construct(RateService $rateService)
    {
        $this->rateService = $rateService;
    }
public function store(Request $request)
{
    $request->validate([
        'id' => 'required|exists:products,id',
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:500',
    ]);

    $this->rateService->storeRate($request->all());

    return redirect()->back()->with('success', 'تم إرسال التقييم');
}

}
