<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;


class TestController extends Controller
{
    public function index(): Response {
        return Inertia::render('Test/Test', [
            'name' => 'MyTestName',
            'tester' => 'Testare',
            'list'=> [
                'list1',
                'list2',
                'list3',
                'list4',
                'list5',
                'list6',
            ]
        ]);
    }
}
