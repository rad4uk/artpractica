<?php

namespace App\Http\Controllers;


use App\Http\Requests\Frontend\ConsultationRequest;
use App\Mail\ConsultationShipped;
use App\Repositories\ConsultationRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class ConsultationController extends Controller
{
    public function __construct(
        private readonly ConsultationRepository $consultationRepository
    )
    {

    }

    public function __invoke(ConsultationRequest $request): Response|ResponseFactory
    {
        $validateData = $request->validated();

        $this->consultationRepository->create($validateData);

        Mail::to(env('MAIL_TO_ADDRESS'))->send(new ConsultationShipped(
            $request->request->get('name'),
            $request->request->get('phone'),
            $request->request->get('text')
        ));

        return response('',201);
    }
}
