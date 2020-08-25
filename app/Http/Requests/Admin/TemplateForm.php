<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TemplateForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:30',
            'purpose' => 'max:150',
            'body' => 'max:10000',
            'context' => 'in:shipment,allocation',
            'subject' => 'required|max:100',
        ];
    }

    public function persist($model)
    {
        $model->title = $this->title;
        $model->purpose = $this->purpose;
        $model->body = $this->body;
        $model->context = $this->context;
        $model->user_id = Auth::id();
        $model->subject = $this->subject;

        $model->save();
    }
}
