<?php
//=====QUẢN LÝ GÓI VIP=====

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Revenue;
use App\Models\User;
use App\Models\User_Package;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PackageController extends Controller
{
    public function index()
    {
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $package = Package::where('status', 1)->get();
        $user = Auth::user();
        return view('pages.package', compact('genre', 'country', 'package', 'user'));
    }
    public function check_out(Request $request, $id)
    {
        if (auth()->check()) {
            $genre = Genre::orderBy('id', 'DESC')->get();
            $country = Country::orderBy('id', 'DESC')->get();
            // Lấy package_id từ request POST
            $packageId = $request->input('pack_id');

            // Tìm gói theo package_id
            $package = Package::find($packageId);
            $user = Auth::user();
            // Kiểm tra xem gói có tồn tại không
            if ($package) {
                // Lấy số tháng từ request
                $months = $request->input('months');

                // Tính toán tổng tiền
                $subTotal = $package->price * $months;

                // Thông báo thành công nếu là gói 12 tháng
                $successMessage = '';
                if ($months == 12) {
                    $subTotal = $package->price * 10; // Giảm giá 2 tháng
                    $successMessage = '2 months FREE for annual billing';
                }

                return view('pages.checkout', compact('genre', 'user', 'country', 'package', 'months', 'subTotal', 'successMessage'));
            } else {
                // Xử lý trường hợp gói không tồn tại
                return redirect()->back()->with('error', 'Gói không tồn tại');
            }
        } else {
            return redirect()->route('login')->with('success', 'Hãy đăng nhập trước khi mua gói nhé!');
        }
    }

    public function vnpay_payment(Request $request)
    {
        // Lấy giá trị của selectedPackage từ request
        $selectedPackage = $request->input('selectedPackage');
        $selectedName = $request->input('selectedName');
        $selectedPrice = $request->input('selectedPrice');
        $total_vnpay = $request->input('subTotal_vnpay');
        // Lưu giá trị vào Session
        Session::put('selectedPackage', $selectedPackage);
        Session::put('selectedName', $selectedName);
        Session::put('selectedPrice', $selectedPrice);
        Session::put('total_vnpay', $total_vnpay);
        $data = $request->all();
        $code_package = rand(11, 9999);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/setting-info";
        $vnp_TmnCode = "NGX9RNAY"; //Mã website tại VNPAY 
        $vnp_HashSecret = "KNALPBFLKAZQCBUBQEGTKYHBRVWECGUB"; //Chuỗi bí mật

        $vnp_TxnRef = $code_package; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán gói VIP';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $data['subTotal_vnpay'] * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        // $vnp_ExpireDate = $expire;

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
            // "vnp_ExpireDate" => $vnp_ExpireDate
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00'
            ,
            'message' => 'error'
            ,
            'data' => '00'
        );
        if (isset($_POST['redirect'])) {
            $id = Auth::id();
            $user = User::find($id);
            if ($user) {
                // Kiểm tra xem người dùng đã nhấn nút "Hủy giao dịch" hay không
                if ($request->has('cancelTransaction')) {
                    return redirect()->to($vnp_Url)->with('error', 'Bạn đã hủy giao dịch!');
                }
                // Người dùng không hủy giao dịch, tiến hành ghi nhận thông tin
                $user->package_id = Session::get('selectedPackage');
                $user->save();
                // Lưu thông tin cần thiết vào session
                Session::put('user_id', $user->id);
                Auth::login($user);

                $bill = new User_Package();
                $bill->user_id = $user->id;
                $bill->package_id = $user->package_id;
                $bill->name = Session::get('selectedName');
                $bill->price = Session::get('selectedPrice');
                $bill->purchase_total = Session::get('total_vnpay');
                $bill->payment_method = 'VN-Pay';
                $bill->purchase_date = Carbon::now('Asia/Ho_Chi_Minh');
                $bill->save();


                $revenue = new Revenue();
                $revenue->user_id = $user->id;
                $revenue->payment_method = 'VN-Pay';
                $revenue->purchase_total = Session::get('total_vnpay');
                $revenue->purchase_date = Carbon::now('Asia/Ho_Chi_Minh');
                $revenue->save();
                return redirect()->to($vnp_Url)->with('success', 'Thanh toán thành công!');
            } else {
                echo json_encode($returnData);
            }
        } else {
            echo json_encode($returnData);
        }

    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    // public function updateMonth(Request $request)
    // {
    //     if ($request->id && $request->quantity) {
    //         $cart = session()->get('cart');
    //         $cart[$request->id]["quantity"] = $request->quantity;
    //         session()->put('cart', $cart);
    //         session()->flash('success', 'Cập nhật số tháng thành công!');
    //     }
    // }

    public function create()
    {
        $list = Package::all(); //lấy tất cả dữ liệu ra
        return view('admincp.packageVIP.form', compact('list')); //thực hiện gửi list danh sách vào form
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $package = new Package();
        $package->name = $data['pack_name'];
        $package->price = $data['pack_price'];
        $package->quality = $data['pack_quality'];
        $package->chat = $data['pack_chat'];
        $package->bookmark = $data['pack_bookmark'];
        $package->save();
        return redirect()->back()->with('sucess', 'Thêm gói thành công!');
    }
    public function edit($id)
    {
        $package = Package::find($id);
        $list = Package::all(); //lấy tất cả dữ liệu ra
        if (!$package) {
            return redirect()->back();
        }
        return view('admincp.packageVIP.form', compact('list', 'package')); //thực hiện gửi list danh sách vào form
    }
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $package = Package::find($id);
        $package->name = $data['pack_name'];
        $package->price = $data['pack_price'];
        $package->quality = $data['pack_quality'];
        $package->chat = $data['pack_chat'];
        $package->bookmark = $data['pack_bookmark'];
        $package->save();
        return redirect()->back()->with('sucess', 'Cập nhật thành công!');
    }
    public function hide_package($id)
    {
        $package = Package::find($id);
        $package->status = 0;
        $package->save();
        return redirect()->to('/packageVIP/create');
    }
    public function show_package($id)
    {
        $package = Package::find($id);
        $package->status = 1;
        $package->save();
        return redirect()->to('/packageVIP/create');
    }
}