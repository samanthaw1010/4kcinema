<?php
//=====QUẢN LÝ THÔNG BÁO=====

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Package;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Country;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function create()
    {
        $list = Notification::all(); //lấy tất cả dữ liệu ra
        return view('admincp.notification.form', compact('list')); //thực hiện gửi list danh sách vào form
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $notification = new Notification();
        $notification->title = $data['title'];
        $notification->content = $data['content'];
        $notification->expired_at = $data['expired_at'];
        $notification->package_id = $data['package_id'];
        $notification->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $notification->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        //Thêm hình ảnh minh họa:
        $get_image = $request->file('image_notification');
        $path = 'uploads/notification/';
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName(); //hinhanh1.png (lấy ra tên của file ảnh)
            $name_image = current(explode('.', $get_name_image)); //[0]=>hinhanh1 . [1]=>png (nghĩa là tách tên ra dựa trên dâu chấm, tạo thành mảng) sau đó current sẽ lẩy giá trị của index thứ 0 trong mảng này. Nếu dùng end sẽ lấy giá trị của index cuối cùng.
            $new_image = $name_image . rand(0, 999) . '.' . $get_image->getClientOriginalExtension(); //dùng hàm rand tạo 3 số ngẫu nhiên sau tên file ảnh, để tránh trường hợp trùng tên. Sau đó hàm extension sẽ lấy phần đuôi file ảnh ví dụ png để ghép vào. Ex: hinhanh12345.png
            //Cách khác để không trùng lặp tên ảnh là dùng hàm time()
            $get_image->move($path, $new_image); //Sao chép hình ảnh mới upload vào đường dẫn $path
            $notification->image_notification = $new_image;
        }

        $notification->save();
        return redirect()->back()->with('success', 'Thêm thông báo thành công!');
    }
    public function edit($id)
    {
        $notification = Notification::find($id);
        $list = Notification::all(); //lấy tất cả dữ liệu ra
        if (!$notification) {
            return redirect()->back();
        }
        return view('admincp.notification.form', compact('list', 'notification')); //thực hiện gửi list danh sách vào form
    }
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $notification = Notification::find($id);
        $notification->title = $data['title'];
        $notification->content = $data['content'];
        $notification->expired_at = $data['expired_at'];
        $notification->package_id = $data['package_id'];
        $notification->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        //Sửa hình ảnh minh họa:
        $get_image = $request->file('image_notification_change');

        $path = 'uploads/notification/';

        if ($get_image) {
            if (file_exists($path . $notification->image_notification)) {
                unlink($path . $notification->image_notification);
                $get_name_image = $get_image->getClientOriginalName(); //hinhanh1.png (lấy ra tên của file ảnh)
                $name_image = current(explode('.', $get_name_image)); //[0]=>hinhanh1 . [1]=>png (nghĩa là tách tên ra dựa trên dâu chấm, tạo thành mảng) sau đó current sẽ lẩy giá trị của index thứ 0 trong mảng này (nghĩa là chỉ cho phép tải lên 1 ảnh poster thôi). (Nếu dùng end sẽ lấy giá trị của index cuối cùng.)
                $new_image = $name_image . rand(0, 999) . '.' . $get_image->getClientOriginalExtension(); //dùng hàm rand tạo 3 số ngẫu nhiên sau tên file ảnh, để tránh trường hợp trùng tên. Sau đó hàm extension sẽ lấy phần đuôi file ảnh ví dụ png để ghép vào. Ex: hinhanh12345.png
                $get_image->move($path, $new_image); //Sao chép hình ảnh mới upload vào đường dẫn $path

                $notification->image_notification = $new_image;
            } else {
                $get_name_image = $get_image->getClientOriginalName(); //hinhanh1.png (lấy ra tên của file ảnh)
                $name_image = current(explode('.', $get_name_image)); //[0]=>hinhanh1 . [1]=>png (nghĩa là tách tên ra dựa trên dâu chấm, tạo thành mảng) sau đó current sẽ lẩy giá trị của index thứ 0 trong mảng này (nghĩa là chỉ cho phép tải lên 1 ảnh poster thôi). (Nếu dùng end sẽ lấy giá trị của index cuối cùng.)
                $new_image = $name_image . rand(0, 999) . '.' . $get_image->getClientOriginalExtension(); //dùng hàm rand tạo 3 số ngẫu nhiên sau tên file ảnh, để tránh trường hợp trùng tên. Sau đó hàm extension sẽ lấy phần đuôi file ảnh ví dụ png để ghép vào. Ex: hinhanh12345.png
                $get_image->move($path, $new_image); //Sao chép hình ảnh mới upload vào đường dẫn $path

                $notification->image_notification = $new_image;
            }
        } else {
            $notification->image_notification = $notification->image_notification;
        }

        $notification->save();
        return redirect()->back()->with('success', 'Thay đổi thành công!');
    }
    public function destroy($id)
    {
        Notification::find($id)->delete();
        return redirect()->back();
    }
}