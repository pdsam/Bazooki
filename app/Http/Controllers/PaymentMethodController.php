<?php

namespace App\Http\Controllers;

use App\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PaymentMethodController extends Controller
{

    public function create(Request $request) {
        $this->authorize('create', PaymentMethod::class);

        $bazooker = Auth::guard('bazooker')->user();

        $validator = Validator::make($request->all(), [
            'cardType' => ['required', Rule::in(['visa', 'maestro', 'mastercard'])],
        ]);

        $validator->validate();

        PaymentMethod::create([
            'bazooker_id' => $bazooker->id,
            'card_number' => $request->cardNumber,
            'type' => $request->cardType,
            'validated' => true
        ]);

        return redirect()->route('settings');
    }

    public function remove(Request $request) {
        $method = PaymentMethod::find($request->methodId);
        $this->authorize('remove', $method);

        $method->delete();

        return redirect()->route('settings');
    }
}
