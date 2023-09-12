<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Revenue;
use App\Models\User;
use App\Models\User_Package;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    /**
     * create transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTransaction()
    {
        return view('pages.paypal.test');
    }

    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction(Request $request)
    {
        // Lấy giá trị của selectedPackage từ request
        $selectedPackage = $request->input('selectedPackage');
        $selectedName = $request->input('selectedName');
        $selectedPrice = $request->input('selectedPrice');
        $total_paypal = $request->input('total_paypal');
        // Lưu giá trị vào Session
        Session::put('selectedPackage', $selectedPackage);
        Session::put('selectedName', $selectedName);
        Session::put('selectedPrice', $selectedPrice);
        Session::put('total_paypal', $total_paypal);
        $total = $request->input('vnd_to_usd');
        Session::put('total', $total);
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $total
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('createTransaction')
                ->with('error', 'Something went wrong.');

        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $id = Auth::id();
            $user = User::find($id);

            if ($user) {
                $user->package_id = Session::get('selectedPackage');
                $user->save();
                Auth::login($user);

                $bill = new User_Package();
                $bill->user_id = $user->id;
                $bill->package_id = $user->package_id;
                $bill->name = Session::get('selectedName');
                $bill->price = Session::get('selectedPrice');
                $bill->purchase_total = Session::get('total_paypal');
                $bill->payment_method = 'PayPal';
                $bill->purchase_date = Carbon::now('Asia/Ho_Chi_Minh');
                $bill->save();

                $revenue = new Revenue();
                $revenue->user_id = $user->id;
                $revenue->payment_method = 'PayPal';
                $revenue->purchase_total = Session::get('total_paypal');
                $revenue->purchase_date = Carbon::now('Asia/Ho_Chi_Minh');
                $revenue->save();

            }
            return redirect()
                ->route('setting_info')
                ->with('success', 'Thanh toán thành công!');
        } else {
            return redirect()
                ->route('check_out')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('package')->with('error', 'Bạn đã hủy giao dịch.');
    }
}