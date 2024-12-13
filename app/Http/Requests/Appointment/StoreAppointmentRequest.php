<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
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
            'patient_id' => ['required', 'exists:patients,patient_id'],
            'dentist_id' => ['required', 'exists:dentists,dentist_id'],
            'appointment_date' => ['required', 'date', 'after:today'],
            'purpose_of_appointment' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:scheduled,completed,cancelled'],
            'notes' => ['nullable', 'string']
        ];
    }
}
