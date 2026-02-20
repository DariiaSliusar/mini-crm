<?php

namespace App\Http\Requests\Api;

use App\Models\Ticket;
use Illuminate\Foundation\Http\FormRequest;

class TicketStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|phone:E164',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'file' => 'nullable|array',
            'file.*' => 'file|max:10240|mimes:jpg,jpeg,png,pdf,doc,docx',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $exists = Ticket::query()->whereHas('customer', function ($q) {
                $q->where('email', $this->email)
                    ->orWhere('phone', $this->phone);
            })
                ->where('created_at', '>=', now()->subDay())
                ->exists();

            if ($exists) {
                $validator->errors()->add('email', 'You have already submitted a request in the last 24 hours.');
            }
        });
    }
}
