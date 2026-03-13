<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvestigasiRequest extends FormRequest
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
            'no_case'=>['required','string'],
            // 'tgl_registrasi' => ['required', 'string'],
            'asuransi_id'=>['required','string'],
            'jenisclaim_id'=>['required'],
            'investigator_id'=>['required'],
            // 'no_polis'=>['required'],
        ];
    }
}
