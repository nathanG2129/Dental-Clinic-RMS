<?php

namespace App\Http\Requests\TreatmentRecord;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTreatmentRecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'patient_id' => ['sometimes', 'required', 'exists:patients,patient_id'],
            'dentist_id' => ['sometimes', 'required', 'exists:dentists,dentist_id'],
            'treatment_type' => ['sometimes', 'required', 'string', 'max:255'],
            'treatment_details' => ['sometimes', 'required', 'string'],
            'treatment_date' => ['sometimes', 'required', 'date'],
            'cost' => ['sometimes', 'required', 'numeric', 'min:0'],
            'payment_status' => ['sometimes', 'required', 'in:pending,paid,partially_paid'],
            'notes' => ['nullable', 'string']
        ];
    }
}
