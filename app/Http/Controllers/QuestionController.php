<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    /**
     * @return View
     */
    public function constructor(): View
    {
        return view('admin.questions.constructor');
    }
}
