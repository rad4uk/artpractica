<?php

namespace App\Http\Controllers;

use App\Mail\ConsultationShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ConsultationController extends Controller
{
    public function __invoke(Request $request): \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
    {

        Mail::to(env('MAIL_TO_ADDRESS'))->send(new ConsultationShipped(
            $request->request->get('name'),
            $request->request->get('phone'),
            $request->request->get('text')
        ));

        return response('',201);
    }
}
