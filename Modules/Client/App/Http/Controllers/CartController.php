<?php

namespace Modules\Client\App\Http\Controllers;

use App\Models\Vnpay;
use Exception;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\CouponModel;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ProductVariant;
use App\Http\Controllers\Controller;
use App\Notifications\Checkout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Client\App\Events\NewOrderNotificationEvent;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $messages;
    public function __construct()
    {
        $this->messages = [
            'user_address.required' => 'Vui lòng nhập địa chỉ của bạn.',
            'user_phone.required' => 'Vui lòng nhập số điện thoại của bạn',
            'user_phone.number' => 'Vui lòng nhập số',
            'user_phone.regex' => 'Số điện thoại không đúng định dạng. Vui lòng nhập đúng số điện thoại.',
            'user_name.required' => 'Vui lòng nhập tên của bạn.',
            'user_name.max' => 'Tên của bạn không được quá 50 kí tự.',
            'user_email.required' => 'Vui lòng nhập email của bạn.',
            'user_email.email' => 'Email không đúng định dạng.',
            'payment_method.required' => 'Vui lòng chọn phương thức thanh toán.'
        ];
    }

    public function add(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'bạn chưa đăng nhập!'], 200);
        }

        if ($request->color_attribute_id == null || $request->size_attribute_id == null) {
            return response()->json(['message' => ' vui lòng kiểu sản phẩm'], 200);
        }

        if ($request->quantity == null) {
            return response()->json(['message' => ' vui lòng nhập số lượng sản phẩm'], 200);
        }
        if ($request->quantity <= 0) {
            return response()->json(['message' => ' số lượng sản phẩm phải lớn hơn 0'], 200);
        }
        $productId = $request->product_id;
        $productVariant = ProductVariant::where('product_id', '=', $productId)
            ->where('color_attribute_id', '=', $request->color_attribute_id)
            ->where('size_attribute_id', '=', $request->size_attribute_id)
            ->first();
        $productVariantId = $productVariant->id;
        if (!$productVariantId) {
            return response()->json(['message' => 'Sản phẩm không tồn tại!'], 200);
        }
        if ($productVariant->quantity == 0) {
            return response()->json(['message' => 'hết hàng'], 200);
        }
        if ($productVariant->quantity <  $request->quantity) {
            return response()->json(['message' => 'Số lượng hàng bạn mua đang bị vượt số lượng hàng hiện tại, vui lòng đểu chỉnh lại!'], 200);
        }
        $quantity = $request->quantity;
        $total_amount = 0;
        $product_image = Product::find($productId)->image_avatar;
        // dd($productVariantId);
        if (auth()->check()) {

            // Người dùng đã đăng nhập
            $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
            $cartItem = $cart->cartItems()->firstOrCreate(['product_id' => $productId, 'product_variant_id' => $productVariantId], ['quantity' => 0, 'price' => 0, 'price_total' => 0]);
            $cartItem->increment('quantity', $quantity);
            if ($cartItem->quantity > $productVariant->quantity) {
                $cartItem->decrement('quantity', $quantity);
                return response()->json(['message' => 'Số lượng hàng bạn mua đang bị vượt số lượng hàng hiện tại, vui lòng đểu chỉnh lại!'], 200);
            }
            $cartItem->product_image = $product_image;
            $cartItem->save();

            if ($cartItem) {
                $productVariant = ProductVariant::find($productVariantId);
                if ($productVariant) {
                    $current_date = now();
                    $price_sale = $productVariant->price_sale;
                    $start_date = $productVariant->start_date;
                    $end_date = $productVariant->end_date;
                    $price_default = $productVariant->price_default;
                    if ($price_sale !== null && $start_date !== null && $end_date !== null) {
                        // Kiểm tra xem thời gian hiện tại có nằm trong khoảng thời gian khuyến mãi không
                        if ($current_date >= $start_date && $current_date <= $end_date) {
                            $price = $price_sale; // Trong khoảng thời gian khuyến mãi
                        } else {
                            $price = $price_default; // Không trong khoảng thời gian khuyến mãi
                        }
                    } elseif ($price_sale !== null && $start_date === null && $end_date === null) {
                        $price = $price_sale; // Không có thời gian, chỉ có giá khuyến mãi
                    } elseif ($price_sale === null && $start_date === null && $end_date === null) {
                        $price = $price_default; // Không có giá khuyến mãi, trả về giá mặc định
                    };

                    if ($price_sale === 0 && $price_default === 0 && $start_date === null && $end_date === null) {
                        $product = Product::find($productId);
                        $current_date = now();
                        $product_price_sale = $product->price_sale;
                        $product_start_date = $product->start_date;
                        $product_end_date = $product->end_date;
                        $product_price_default = $product->price_regular;

                        if ($product_price_sale !== null && $product_start_date !== null && $product_end_date !== null) {
                            // Kiểm tra xem thời gian hiện tại có nằm trong khoảng thời gian khuyến mãi không
                            if ($current_date >= $product_start_date && $current_date <= $product_end_date) {
                                $price = $product_price_sale; // Trong khoảng thời gian khuyến mãi
                            } else {
                                $price = $product_price_default; // Không trong khoảng thời gian khuyến mãi
                            }
                        } elseif ($product_price_sale !== null && $product_start_date === null && $product_end_date === null) {
                            $price = $product_price_sale; // Không có thời gian, chỉ có giá khuyến mãi
                        } elseif ($product_price_sale === null && $product_start_date === null && $product_end_date === null) {
                            $price = $product_price_default; // Không có giá khuyến mãi, trả về giá mặc định
                        };
                    };

                    if ($price !== null) {
                        $cartItem->price = $price;
                        $cartItem->product_image = $product_image;
                        $cartItem->total_price = $cartItem->quantity * $price;
                        $cartItem->save();
                    };
                }
            }
            $listCartItem = CartItem::where('cart_id', $cart->id)->get();
            foreach ($listCartItem as $item) {
                $productVariant = ProductVariant::find($item->product_variant_id);
                if ($productVariant) {
                    $current_date = now();
                    $price_sale = $productVariant->price_sale;
                    $start_date = $productVariant->start_date;
                    $end_date = $productVariant->end_date;
                    $price_default = $productVariant->price_default;
                    if ($price_sale !== null && $start_date !== null && $end_date !== null) {
                        // Kiểm tra xem thời gian hiện tại có nằm trong khoảng thời gian khuyến mãi không
                        if ($current_date >= $start_date && $current_date <= $end_date) {
                            $price = $price_sale; // Trong khoảng thời gian khuyến mãi
                        } else {
                            $price = $price_default; // Không trong khoảng thời gian khuyến mãi
                        }
                    } elseif ($price_sale !== null && $start_date === null && $end_date === null) {
                        $price = $price_sale; // Không có thời gian, chỉ có giá khuyến mãi
                    } elseif ($price_sale === null && $start_date === null && $end_date === null) {
                        $price = $price_default; // Không có giá khuyến mãi, trả về giá mặc định
                    };
                    if ($price_sale === 0 && $price_default === 0 && $start_date === null && $end_date === null) {
                        $product = Product::find($item->product_id);
                        $current_date = now();
                        $product_price_sale = $product->price_sale;
                        $product_start_date = $product->start_date;
                        $product_end_date = $product->end_date;
                        $product_price_default = $product->price_regular;

                        if ($product_price_sale !== null && $product_start_date !== null && $product_end_date !== null) {
                            // Kiểm tra xem thời gian hiện tại có nằm trong khoảng thời gian khuyến mãi không
                            if ($current_date >= $product_start_date && $current_date <= $product_end_date) {
                                $price = $product_price_sale; // Trong khoảng thời gian khuyến mãi
                            } else {
                                $price = $product_price_default; // Không trong khoảng thời gian khuyến mãi
                            }
                        } elseif ($product_price_sale !== null && $product_start_date === null && $product_end_date === null) {
                            $price = $product_price_sale; // Không có thời gian, chỉ có giá khuyến mãi
                        } elseif ($product_price_sale === null && $product_start_date === null && $product_end_date === null) {
                            $price = $product_price_default; // Không có giá khuyến mãi, trả về giá mặc định
                        };
                        // dd($price);
                    };
                    if ($price !== null) {
                        $total_amount += $item->quantity * $price;
                    };
                }
            }
            $cart->total_amount = $total_amount;
            $cart->save();
            return response()->json(['message' => 'Thêm vào giỏ hàng thành công!'], 200);
        } else {
            return response()->json(['message' => 'bạn chưa đăng nhập!'], 200);
        }
    }


    public function index()
    {
        Cart::firstOrCreate(['user_id' => auth()->id()]);
        return view('client::contents.shops.cart');
    }

    public function list()
    {
        //ham check nếu user khác thêm vào giỏ hàng mà sản phẩm đó đã hết hoặc trong giỏ hàng đã có sản phẩm đó mà sản phẩm đó đã hết
        //thì xóa sản phẩm đó khỏi giỏ hàng -> thông báo cho user -> cập nhật lại giỏ hàng


        if (auth()->check()) {
            $cart = Cart::where('user_id', auth()->id())->first();
            $cartItems = CartItem::where('cart_id', $cart->id)
                ->with("productVariant")
                ->with("productVariant.size")
                ->with("productVariant.color")
                ->with("productVariant.product")
                ->get();

            // dd($cartItems->count());
            if ($cartItems->count() == 0) {
                return response()->json(['message' => 'Giỏ hàng của bạn đang trống!'], 404);
            } else {
                return response()->json([
                    'cartItems' => $cartItems,
                    'totalAmount' => $cart->total_amount,
                    'discount' => session('discount') ? session('discount') : 0,
                    'discount_code' => session('discount_code') ? session('discount_code') : '',
                    'message' => 'Lấy danh sách giỏ hàng thành công!'
                ], 200);
            };
        } else {
            return response()->json(['message' => 'chưa đăng nhập'], 400);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->check()) {
            // Người dùng đã đăng nhập
            $cartItem = CartItem::findOrFail($id);
            if (!$cartItem) {
                return response()->json(['error' => 'Sản phẩm không tồn tại trong giỏ hàng!'], 400);
            }
            $productQuantity = ProductVariant::find($cartItem->product_variant_id)->quantity;
            if ($request->quantity > $productQuantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Số lượng sản phẩm không đủ!'
                ], 200);
            }
            $cartItem->quantity = $request->quantity;
            $cartItem->total_price = $cartItem->quantity * $cartItem->price;
            $cartItem->save();
            $cart = Cart::where('user_id', auth()->id())->first();
            $cart->total_amount = CartItem::where('cart_id', $cart->id)->sum('total_price');
            $cart->save();
            return response()->json([
                'success' => 'Cập nhật giỏ hàng thành công!'
            ], 200);
        }
    }

    public function remove($id)
    {
        if (auth()->check()) {
            $cartItem = CartItem::findOrFail($id);
            if ($cartItem) {
                $cartItem->delete();
                $cart = Cart::where('user_id', auth()->id())->first();
                $cart->total_amount = CartItem::where('cart_id', $cart->id)->sum('total_price');
                $cart->save();
                return response()->json(['success' => 'Xóa sản phẩm khỏi giỏ hàng thành công!'], 200);
            } else {
                return response()->json(['error' => 'Xóa sản phẩm khỏi giỏ hàng thất bại!'], 400);
            }
        }
    }
    public function removeDiscountCode(Request $request)
    {
        // Xóa mã giảm giá khỏi phiên
        $request->session()->forget('discount');
        $request->session()->forget('discount_code');
        return response()->json(['success' => true], 200);
    }

    public function applyCoupon(Request $request)
    {

        $coupon = CouponModel::where('code', $request->coupon_code)->first();

        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn chưa đăng nhập!'
            ], 200);
        }
        $cartId = Cart::where('user_id', auth()->id())->first()->id;
        $cartItems = CartItem::where('cart_id', $cartId)->get();
        if ($cartItems->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Giỏ hàng của bạn đang trống!'
            ], 200);
        }

        if ($coupon) {
            $current_date = date('Y-m-d H:i:s');
            $order_total = Cart::where('user_id', auth()->id())->first()->total_amount;
            if ($current_date < $coupon->date_start) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mã giảm giá chưa có hiệu lực.'
                ], 200);
            } elseif ($current_date > $coupon->date_end) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mã giảm giá đã hết hạn.'
                ], 200);
            } else {
                // Tính toán giá trị giảm giá
                if ($coupon->discount_type == 'percent') {
                    $discount_value = ($order_total * $coupon->discount_amount) / 100;
                } elseif ($coupon->discount_type == 'fixed') {
                    $discount_value = $coupon->discount_amount;
                };

                // Kiểm tra số lượng mã giảm giá
                if ($coupon->quantity > 0) {

                    $discount_value = round($discount_value);

                    session(['discount' => $discount_value]);
                    session(['discount_code' => $request->coupon_code]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Áp dụng mã giảm giá thành công!',
                    ], 200);
                } else {
                    return response()->json(['error' => 'Mã giảm giá đã sử dụng hết.'], 200);
                }
            }
        } else {
            return response()->json(['error' => 'Mã giảm giá không tồn tại!'], 200);
        }
    }

    public function order()
    {
        $userId = auth()->check() ? auth()->user()->id : null;
        // dd(auth()->user());

        $cart = Cart::where('user_id', $userId)->first();
        if (!$cart) {
            return redirect()->route('cart.index');
        }
        $cartItems = CartItem::where('cart_id', $cart->id)
            ->with("productVariant")
            ->with("productVariant.size")
            ->with("productVariant.color")
            ->with("productVariant.product")
            ->get();

        $dataList = [];

        foreach ($cartItems as $item) {
            $productVariant = ProductVariant::find($item->product_variant_id);
            if ($item->quantity > $productVariant->quantity) {
                $dataList[] = [
                    'product_name' => $item->productVariant->product->name,
                    'size' => $item->productVariant->size->size_value,
                    'color' => $item->productVariant->color->color_value,
                ];
            };
        };

        // $dataList[] = [
        //     'product_name' => 'Áo sơ mi',
        //     'size' => 'M',
        //     'color' => 'Đỏ',
        // ];

        $message = '';
        foreach ($dataList as $item) {
            $message .= 'sản phẩm' . $item['product_name'] . ' - size:' . $item['size'] . ' -màu:' . $item['color'] . '\n';
        };

        if (count($dataList) > 0) {
            return redirect()->route('cart.index')
                ->with('messageSP', $message)
                ->with('errorSP', 'Số lượng sản phẩm không đủ!');
        };

        if ($cartItems->count() == 0) {
            return redirect()->route('cart.index');
        }

        if (auth()->check()) {
            return view('client::contents.shops.checkout', compact(['cartItems', 'cart', 'userId']));
            // dd([$cart,$cartItems]);
        } else {
            return redirect()->route('showForm');
        }
        // Hoặc redirect đến trang thanh toán
    }

    public function checkout(Request $request)
    {

        $userId = $request->input('user_id');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $ship_user_name = $last_name . ' ' . $first_name;
        $ship_user_phone = $request->input('user_phone');
        $ship_user_email = $request->input('user_email');
        $ship_user_address = $request->input('user_address');
        $ship_user_note = $request->input('user_note');
        $ship_user_note = $request->input('user_note');
        $discount_code = $request->input('discount_code');
        $payment_method = $request->input('payment_method');


        $user = User::find($userId);

        $discount_value = 0;
        $totalAmount = 0;

        $cart = Cart::where('user_id', $userId)->first();

        $totalAmount = $cart->total_amount;

        $coupon = CouponModel::where('code', $discount_code)->first();
        if ($coupon) {
            $current_date = date('Y-m-d H:i:s');
            $order_total = Cart::where('user_id', $userId)->first()->total_amount;
            if ($current_date < $coupon->date_start) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mã giảm giá không tồn tại hoặc đã hết hạn.'
                ], 200);
            } elseif ($current_date > $coupon->date_end) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mã giảm giá đã hết hạn.'
                ], 200);
            } else {
                // Tính toán giá trị giảm giá
                if ($coupon->discount_type == 'percent') {
                    $discount_value = ($order_total * $coupon->discount_amount) / 100;
                } elseif ($coupon->discount_type == 'fixed') {
                    $discount_value = $coupon->discount_amount;
                };

                // Kiểm tra số lượng mã giảm giá
                if ($coupon->quantity > 0) {
                    $discount_value = round($discount_value);
                }
            }
        }

        $totalAmount = $totalAmount - $discount_value;

        // dd($totalAmount);

        // $payment_method = $payment_method == 'cod' ? 'Thanh toán khi nhận hàng' : 'Thanh toán qua thẻ MOMO';
        if ($payment_method == 'vnpay') {

            $cartItems = CartItem::where('cart_id', $cart->id)
                ->with("productVariant")
                ->with("productVariant.size")
                ->with("productVariant.color")
                ->with("productVariant.product")
                ->get();

            foreach ($cartItems as $item) {
                ProductVariant::where('id', $item->product_variant_id)->decrement('quantity', $item->quantity);
            }

            $validator = Validator::make($request->all(), [
                'user_address' => 'required',
                'user_phone' => 'required|regex:/^[0-9]{10}$/',
                'first_name' => ['required', 'max:50'],
                'last_name' => ['required', 'max:50'],
                'user_email' => 'required|email',
                'payment_method' => 'required'
            ], messages: $this->messages);

            if ($validator->fails()) {
                return response()->json([
                    "type" => "error",
                    "message" => $validator->errors()
                ], 400);
            }


            $oder_detail = [];

            $user_full_name = $user->full_name;
            $user_phone = $user->phone;
            $user_email = $user->email;
            $user_address = $user->address;

            $order = Order::create([
                "users_id" => $userId,
                "user_name" => $user_full_name,
                "user_phone" => $user_phone,
                "user_email" => $user_email,
                "user_address" => $user_address,
                "ship_user_name" => $ship_user_name,
                "ship_user_phone" => $ship_user_phone,
                "ship_user_email" => $ship_user_email,
                "ship_user_address" => $ship_user_address,
                "ship_user_note" => $ship_user_note,
                'discount' => $discount_value,
                'date_create_order' => now(),
                "payment_method" => "Thanh toán qua VNpay",
                "status_order" => "Chờ xác nhận",
                "status_payment" => "Chưa thanh toán",
                "total_price" => $totalAmount
            ]);

            foreach ($cartItems as $item) {
                $oder_detail = OrderDetail::create([
                    "order_id" => $order->id,
                    "product_id" => $item->product_id,
                    "product_variant_id" => $item->product_variant_id,
                    "product_name" => $item->productVariant->product->name,
                    "product_sku" => $item->productVariant->product->sku,
                    "product_avatar" => $item->productVariant->product->image_avatar,
                    "product_price_final" => $item->price,
                    "product_quantity" => $item->quantity
                ]);
            }
            $vnpay = new Vnpay();
            $link =  $vnpay->create_link_payment_url($totalAmount / 10, 'vn', "http://127.0.0.1:8000/api/v1/meanhxuyen?order_id=$order->id&user_id=$userId");
            return response()->json([
                "type" => "success",
                "message" => "Đặt hàng thành công!",
                'method' => 'vnpay',
                "link" => "$link",
            ], 200);
        }


        //Nếu người dùng chọn thanh toán vnpay
        // Tạo  một đơn hàng mới set trạng thái là chưa thanh toán
        // tạo link kèm với mã đơn hàng vừa tạo
        // trả về link đó cho người dùng
        // nếu người dùng đó thanh toán thành công thì cập nhật trạng thái đơn hàng thành đã thanh toán -> xóa giỏ hàng
        // nếu người dùng không thanh toán thì cập nhật trạng thái đơn hàng thành chưa thanh toán -> tiến hành xóa đơn hàng và giữ lại giỏ hàng


        //wallet
        if ($payment_method == 'wallet') {
            $cartItems = CartItem::where('cart_id', $cart->id)
                ->with("productVariant")
                ->with("productVariant.size")
                ->with("productVariant.color")
                ->with("productVariant.product")
                ->get();

            foreach ($cartItems as $item) {
                ProductVariant::where('id', $item->product_variant_id)->decrement('quantity', $item->quantity);
            }

            $validator = Validator::make($request->all(), [
                'user_address' => 'required',
                'user_phone' => 'required|regex:/^[0-9]{10}$/',
                'first_name' => ['required', 'max:50'],
                'last_name' => ['required', 'max:50'],
                'user_email' => 'required|email',
                'payment_method' => 'required'
            ], messages: $this->messages);

            if ($validator->fails()) {
                return response()->json([
                    "type" => "error",
                    "message" => $validator->errors()
                ], 400);
            }


            $oder_detail = [];

            $user_full_name = $user->full_name;
            $user_phone = $user->phone;
            $user_email = $user->email;
            $user_address = $user->address;

            $order = Order::create([
                "users_id" => $userId,
                "user_name" => $user_full_name,
                "user_phone" => $user_phone,
                "user_email" => $user_email,
                "user_address" => $user_address,
                "ship_user_name" => $ship_user_name,
                "ship_user_phone" => $ship_user_phone,
                "ship_user_email" => $ship_user_email,
                "ship_user_address" => $ship_user_address,
                "ship_user_note" => $ship_user_note,
                'discount' => $discount_value,
                'date_create_order' => now(),
                "payment_method" => "Thanh toán ví tiền",
                "status_order" => "Chờ xác nhận",
                "status_payment" => "Chưa thanh toán",
                "total_price" => $totalAmount
            ]);

            foreach ($cartItems as $item) {
                $oder_detail = OrderDetail::create([
                    "order_id" => $order->id,
                    "product_id" => $item->product_id,
                    "product_variant_id" => $item->product_variant_id,
                    "product_name" => $item->productVariant->product->name,
                    "product_sku" => $item->productVariant->product->sku,
                    "product_avatar" => $item->productVariant->product->image_avatar,
                    "product_price_final" => $item->price,
                    "product_quantity" => $item->quantity
                ]);
            }
            $timestamp = now()->timestamp;
            $querybuilder = "?user_id=$userId&order_id=$order->id&ammount=$totalAmount&shop_name=PCV_FASHION&shop_desciprtion=Thanh toán qua ví điện tử&order_type=Create_payment_link&date_created=$timestamp";
            $link = route('wallet.pay.index') . $querybuilder;
            return response()->json([
                "type" => "success",
                "message" => "Đặt hàng thành công!",
                'method' => 'wallet',
                "link" => "$link",
            ], 200);
        }

        $cartItems = CartItem::where('cart_id', $cart->id)
            ->with("productVariant")
            ->with("productVariant.size")
            ->with("productVariant.color")
            ->with("productVariant.product")
            ->get();

        $validator = Validator::make($request->all(), [
            'user_address' => 'required',
            'user_phone' => 'required|regex:/^[0-9]{10}$/',
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'user_email' => 'required|email',
            'payment_method' => 'required'
        ], messages: $this->messages);

        if ($validator->fails()) {
            return response()->json([
                "type" => "error",
                "message" => $validator->errors()
            ], 400);
        }


        $oder_detail = [];

        $user_full_name = $user->full_name;
        $user_phone = $user->phone;
        $user_email = $user->email;
        $user_address = $user->address;

        if ($payment_method == 'cod') {
            $payment_method = 'Thanh toán khi nhận hàng';
        }

        $order = Order::create([
            "users_id" => $userId,
            "user_name" => $user_full_name,
            "user_phone" => $user_phone,
            "user_email" => $user_email,
            "user_address" => $user_address,
            "ship_user_name" => $ship_user_name,
            "ship_user_phone" => $ship_user_phone,
            "ship_user_email" => $ship_user_email,
            "ship_user_address" => $ship_user_address,
            "ship_user_note" => $ship_user_note,

            'discount' => $discount_value,
            'date_create_order' => now(),
            "payment_method" => $payment_method,
            "status_order" => "Chờ xác nhận",
            "status_payment" => "Chưa thanh toán",
            "total_price" => $totalAmount
        ]);

        if ($order) {
            $notification = " - ID: {$user->id}, Họ và Tên: {$user->full_name}";
            event(new NewOrderNotificationEvent($notification));

            $message = [
                'order_id' => $order->id,
                'user_id' => $user->id,
                'full_name' => $user->full_name,
                'message' => 'Đơn hàng mới ',
            ];

            DB::table('notifications')->insert([
                'user_id' => null,
                'title' => 'Thông báo đơn hàng mới',
                'message' =>  json_encode($message),
            ]);
        }

        foreach ($cartItems as $item) {
            ProductVariant::where('id', $item->product_variant_id)->decrement('quantity', $item->quantity);
        }

        foreach ($cartItems as $item) {
            $oder_detail = OrderDetail::create([
                "order_id" => $order->id,
                "product_id" => $item->product_id,
                "product_variant_id" => $item->product_variant_id,
                "product_name" => $item->productVariant->product->name,
                "product_sku" => $item->productVariant->product->sku,
                "product_avatar" => $item->productVariant->product->image_avatar,
                "product_price_final" => $item->price,
                "product_quantity" => $item->quantity
            ]);
        }

        if ($order) {
            $cart = Cart::where('user_id', $userId)->first();
            CartItem::where('cart_id', $cart->id)->delete();
            $cart->delete();
        }

        // try {
        //     return response()->json([
        //         "type" => "success",
        //         "message" => "Đặt hàng thành công!",
        //         "order" => $order,
        //         "order_detail" => $oder_detail
        //     ], 200);
        // } catch (Exception $e) {
        //     return response()->json([
        //         "message" => "Booking failed",
        //         "error" => [
        //             "message" => $e->getMessage(),
        //             "file" => $e->getFile(),
        //             "line" => $e->getLine(),
        //             "trace" => $e->getTrace()
        //         ]
        //     ], 500);
        // }


        $link = route('client.invoice.show', ['id' => $order->id]);
        return response()->json([
            "type" => "success",
            "message" => "Đặt hàng thành công!",
            'method' => 'vnpay',
            "link" => "$link?email=true",
        ], 200);
    }
    public function meanhxuyen()
    {
        $Ammout = $_GET['vnp_Amount'];
        $Bankcode = $_GET['vnp_BankCode'];
        $vnp_BankTranNo = isset($_GET['vnp_BankTranNo']) ? $_GET['vnp_BankTranNo'] : "";
        $vnp_CardType = $_GET['vnp_CardType'];
        $vnp_PayDate = $_GET['vnp_PayDate'];
        $vnp_ResponseCode = $_GET['vnp_ResponseCode'];
        $vnp_TransactionNo = $_GET['vnp_TransactionNo'];
        $vnp_TransactionStatus = $_GET['vnp_TransactionStatus'];
        $vnp_TxnRef = $_GET['vnp_TxnRef'];
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $order_id = $_GET['order_id'];
        $user_id = $_GET['user_id'];
        $returndata = [
            'Ammout' => $_GET['vnp_Amount'],
            'Bankcode' => $_GET['vnp_BankCode'],
            'vnp_BankTranNo' => isset($_GET['vnp_BankTranNo']) ? $_GET['vnp_BankTranNo'] : "",
            'vnp_CardType' => $_GET['vnp_CardType'],
            'vnp_PayDate' => $_GET['vnp_PayDate'],
            'vnp_ResponseCode' => $_GET['vnp_ResponseCode'],
            'vnp_TransactionNo' => $_GET['vnp_TransactionNo'],
            'vnp_TransactionStatus' => $_GET['vnp_TransactionStatus'],
            'vnp_TxnRef' => $_GET['vnp_TxnRef'],
            'vnp_SecureHash' => $_GET['vnp_SecureHash'],
            'order_id' => $_GET['order_id'],
            'user_id' => $_GET['user_id'],
        ];
        // dd(auth()->user());
        if ($vnp_ResponseCode == "00") {

            //dd( auth::id());
            $order = Order::find($order_id);
            $order->status_payment = "Đã thanh toán";
            $order->status_order = "Đã xác nhận";
            $order->save();

            $orderItems = OrderDetail::query()
                ->with('productVariant')
                ->with("productVariant.size")
                ->with("productVariant.color")
                ->with("productVariant.product")
                ->where('order_id', $order_id)
                ->get();

            if ($order) {
                $cart = Cart::where('user_id', $user_id)->first();
                CartItem::where('cart_id', $cart->id)->delete();
                $cart->delete();
            }

            if ($order) {
                $user = User::find($user_id);
                $user->notify(new Checkout($order, $orderItems));
            }

            // dd($returndata);
            return view('client::contents.shops.checkoutOrderDetail', compact('returndata', 'orderItems', 'order'));
        } else {
            $order = Order::query()->with('orderDetails')->find($order_id);
            $order->orderDetails()->forceDelete();
            $order->forceDelete();
            return view('client::contents.shops.checkoutOrderDetail', compact('returndata'));
        }
    }



    public function sendNotification(Request $request)
    {
        $orderId = $request->input('id');
        $order = Order::find($orderId);
        $orderItems = OrderDetail::query()
            ->with('productVariant')
            ->with("productVariant.size")
            ->with("productVariant.color")
            ->with("productVariant.product")
            ->where('order_id', $orderId)
            ->get();

        if (Auth::check()) {
            $user = \App\Models\User::find(Auth::user()->id);
            $user->notify(new \App\Notifications\Checkout($order, $orderItems));
        }

        return response()->json(['success' => true]);
    }

    public function handlewallet()
    {
        $status = $_GET['status'];
        $order_id = $_GET['order_id'];
        $ammount = $_GET['ammount'];
        $user_id = $_GET['user_id'];
        $returndata = [
            'status' => $status,
            'ammount' => $ammount,
            'order_id ' => $order_id,
            'user_id' => $user_id
        ];
        if ($status == 'failed') {
            $order = Order::query()->with('orderDetails')->find($order_id);
            $order->orderDetails()->forceDelete();
            $order->forceDelete();
            return view('client::contents.shops.checkoutresponewallet', compact('returndata'));
        } else {
            $order = Order::find($order_id);
            $order->status_payment = "Đã thanh toán";
            $order->status_order = "Đã xác nhận";
            $order->save();

            $orderItems = OrderDetail::query()
                ->with('productVariant')
                ->with("productVariant.size")
                ->with("productVariant.color")
                ->with("productVariant.product")
                ->where('order_id', $order_id)
                ->get();

            if ($order) {
                $cart = Cart::where('user_id', $user_id)->first();
                CartItem::where('cart_id', $cart->id)->delete();
                $cart->delete();
            }

            if ($order) {
                $user = User::find($user_id);
                $user->notify(new Checkout($order, $orderItems));
            }
            return view('client::contents.shops.checkoutresponewallet', compact('returndata', 'orderItems', 'order'));
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function retrypayment($id)
    {
        $order = Order::find($id);
        if ($order) {
            if ($order->payment_method == 'Thanh toán qua VNpay') {
                // dd($order);

                $vnpay = new Vnpay();
                $link =  $vnpay->create_link_payment_url($order->total_price / 10, 'vn', "http://127.0.0.1:8000/api/v1/meanhxuyen?order_id=$order->id&user_id=$order->users_id");
                return redirect($link);
            } else {
                $timestamp = now()->timestamp;
                $querybuilder = "?user_id=$order->users_id&order_id=$order->id&ammount=$order->total_price&shop_name=PCV_FASHION&shop_desciprtion=Thanh toán qua ví điện tử&order_type=Create_payment_link&date_created=$timestamp";
                $link = route('wallet.pay.index') . $querybuilder;
                return redirect($link);
            }
        } else {
            return response()->json(['error' => 'Đơn hàng không tồn tại!'], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */


    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('client::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('client::edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
