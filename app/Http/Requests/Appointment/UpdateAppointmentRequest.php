<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
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
            'appointment_date' => ['sometimes', 'required', 'date'],
            'purpose_of_appointment' => ['sometimes', 'required', 'string', 'max:255'],
            'status' => ['sometimes', 'required', 'in:scheduled,completed,cancelled'],
            'notes' => ['nullable', 'string']
        ];
    }
}
