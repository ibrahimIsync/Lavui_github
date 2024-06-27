<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\TamaraService;
use Illuminate\Http\Request;

class TamaraController extends Controller
{
    protected $tamaraService;

    public function __construct(TamaraService $tamaraService)
    {
        $this->tamaraService = $tamaraService;
    }

    public function tamaraIsAvailable($data)
    {
        try {
            /***
             *
             * here filter request and get the data.
             *
             */
            $data = [
                'country' => 'SA',
                'phone_number' => '544337766',
                'order_value' => [
                    'amount' => '300',
                    'currency' => 'SAR'
                ],
                'is_vip' => 'false'
            ];
            $response = $this->tamaraService->checkTamaraIsAvailable($data);

            return $response['available_payment_labels'];
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function createPayment(Request $request)
    {
        try {
            /***
             * Request must contain order details, then save it at session.
             */
            $response = $this->tamaraIsAvailable($request);
            if ($response) {
                $payment_type = $response[0]['payment_type'];
                $instalment = $response[0]['instalment'];
                /***
                 * Send here $payment_type, $instalment to orderDetails.
                 * Request must contain to order details.
                 */
                $orderDetails = $this->tamaraService->orderDetails($request);
                $response = $this->tamaraService->createCheckout($orderDetails);

                if (isset($response['checkout_url'])) {
                    return response()->json([
                        'status' => 'success',
                        'payment_url' => $response['checkout_url']
                    ]);
                }
            }
            return response()->json([
                'status' => 'fail',
                'message' => 'Failed to create payment'
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function captureOrder(Request $request)
    {
        try {
            $response = $this->tamaraService->authorizeOrder($request->orderId);
            if ($response['status'] === 'authorised') {

                /***
                 *
                 * Must replace $request by orderDetails.
                 *
                 */

                $orderDetails = $this->tamaraService->orderDetails($request);
                $data = [
                    'order_id' => $request->orderId,
                    'total_amount' => [
                        'amount' => $response['authorized_amount']['amount'],
                        'currency' => $response['authorized_amount']['currency']
                    ],
                    'shipping_info' => [
                        'shipped_at' => date("Y-m-d h:i:s"),
                        'shipping_company' => 'Lavui'
                    ],
                    'items' => $orderDetails['items']
                ];

                $this->tamaraService->captureOrder($data);
                /***
                 *
                 * Must save order at database.
                 *
                 */
                return response()->json([
                    'status' => 'success',
                    'payment_url' => 'Order is successfully capture'
                ]);
            }
            return response()->json([
                'status' => 'fail',
                'message' => 'Failed to create payment'
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function failPayment(Request $request)
    {
        return response()->json([
            'status' => 'fail',
            'message' => 'Payment failed'
        ]);
    }

    public function cancel()
    {
        return redirect('/#/checkout/payment');
    }
}
