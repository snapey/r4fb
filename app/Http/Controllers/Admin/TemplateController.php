<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\TemplateForm;
use App\Http\Controllers\Controller;
use App\Template;

class TemplateController extends Controller
{
    public function index()
    {
        return view('admin.templates.index')->withTemplates(Template::all());
    }

    public function create()
    {
        return $this->edit(new Template());
    }

    public function store(TemplateForm $request)
    {
        return $this->update($request, new Template());
    }

    public function edit(Template $template)
    {
        return view('admin.templates.edit')->withTemplate($template);
    }

    public function update(TemplateForm $request, Template $template)
    {
        $request->persist($template);

        return redirect(route('admin.templates.index'));
    }
}
