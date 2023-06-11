<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactPageUpdateRequest;
use App\Repositories\PageRepository;
use App\ValueObjects\Page\Contact\Address;
use App\ValueObjects\Page\Contact\Contact;
use App\ValueObjects\Page\Contact\Email;
use App\ValueObjects\Page\Contact\Phone;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

class ContactPageController extends Controller
{
    public function __construct(
        private readonly PageRepository $pageRepository,
    )
    {
    }

    public function edit(): View|Factory
    {
        $pageData = $this->pageRepository->findById(3);
        return view('adminlte.pages.contact.edit', [
            'page' => $pageData
        ]);
    }

    public function update(ContactPageUpdateRequest $request): Response|ResponseFactory
    {
        $validated = $request->validated();
        $contactInstance = new Contact(
            new Address($validated['fields']['address']),
            new Phone($validated['fields']['phone']),
            new Email($validated['fields']['email']),
        );
        $details = [
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'status' => $validated['status'],
            'first_section_data' => $contactInstance->jsonSerialize(),
            'meta_title' => $validated['meta_title'],
            'meta_description' => $validated['meta_description'],
        ];

        $this->pageRepository->update(3, $details);

        return response('', 201);
    }

}
