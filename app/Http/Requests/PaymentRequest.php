<?php

namespace App\Http\Requests;

use App\Services\MidtransService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class PaymentRequest extends FormRequest
{
    /**
     * *Container* untuk MidtransService
     */
    protected $midtrans;
    protected array $response;

    public function __construct(MidtransService $midtrans_service)
    {
        $this->midtrans = $midtrans_service;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $this->response = $this->midtrans->get_redirect(
            $this->order->id,
            $this->order->grand_total,
            $this->buyer
        );

        $this->merge(['response' => $this->response]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'buyer' => 'required',
            'response' => 'nullable',
        ];
    }

    /**
     * Get the "after" validation callables for the request.
     */
    public function after(): array
    {
        return [
            fn(Validator $validator) => $this->response['status'] !== 201
                ? $validator->errors()->add('payment', $this->messages()['payment.failed'])
                : null,
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'buyer.required' => 'You have to include your name.',
            'payment.failed' => "Sorry, something went wrong while processing your payment. Please try again.<br><br><em>Response code: {$this->response['status']}</em>",
        ];
    }
}
