{{-- TRANG USER INFORMATION CỦA WEBSITE XEM PHIM --}}

@extends('layout')
@section('content')

<!-- SETTING -->
<div class="setting-account">
    <div class="container">
        <h1 class="title">CHÍNH SÁCH VÀ QUY ĐỊNH CHUNG</h1><br>
        <div class="article-body">
            <div class="block block--static">
                <ol>
                    <li>
                        <h4>GIỚI THIỆU DỊCH VỤ</h4><br>
                        <ol>
                            <li>4K Cinema<!-- --> là dịch vụ xem video theo yêu cầu và dịch vụ phát thanh, truyền hình trên mạng Internet do 4K Cinema Channel cung cấp. Khách hàng có thể xem các nội dung video như phim điện ảnh, phim truyền hình, v.v trên các thiết bị khác nhau có kết nối Internet, như máy tính, thiết bị di động, smartTV, v.v.</li><br>
                            <li>4K Cinema<!-- --> có các nội dung miễn phí (có thể kèm quảng cáo) và các nội dung có tính phí nội dung tính phí sẽ được trả tiền theo tháng hoặc trả tiền theo từng bộ phim.</li><br>
                            <li>Một số tính tăng của Dịch vụ <!-- -->4K Cinema<!-- -->:
                                <ul class="lower-alpha">
                                    <li>Xem miễn phí: Khách hàng xem miễn phí nội dung là các phim VOD trên Dịch vụ <!-- -->4K Cinema<!-- -->. Nội dung miễn phí có thể kèm thêm quảng cáo theo đúng qui định của Nghị Định 06/2016/NĐ-CP;</li>
                                    <li>Thuê nội dung theo gói: Khách hàng trả tiền trọn gói để được xem tất cả các nội dung của một gói dịch vụ trong một khoảng thời gian quy định. Khách hàng có thể chọn đăng ký trả tiền theo chu kỳ (1 tháng, 3 tháng và 12 tháng) để xem các bộ phim hoặc kênh truyền hình có trong gói này và sẽ được xem không giới hạn số lượt của các nội dung trong gói đăng ký của Khách hàng;</li>
                                    <li>Thuê lẻ từng nội dung: Khách hàng trả tiền cho từng nội dung xem trong một khoảng thời gian nhất định, gọi là “thời gian xem”. Các nội dung cần thuê lẻ này có thể có “thời gian xem” khác nhau;</li>
                                    <li>Dịch vụ <!-- -->Thanh Toán Tự Động<!-- -->: là tiện ích trên Dịch vụ <!-- -->4K Cinema<!-- --> cho phép Khách hàng thanh toán phí Dịch vụ <!-- -->4K Cinema<!-- --> tự động bằng các loại thẻ quốc tế mang thương hiệu Visa, MasterCard phát hành hợp pháp tại Việt Nam;</li>
                                    <li>Chia sẻ Video: Khách hàng có thể chia sẻ video trên Dịch vụ <!-- -->4K Cinema<!-- --> bằng cách sử dụng đường dẫn (link) được cung cấp bởi <!-- -->4K Cinema<!-- --> chạy trên video player.</li>
                                </ul>
                            </li>
                        </ol>
                    </li>
                    <li>
                        <br><h4>CHÍNH SÁCH BẢO HÀNH</h4><br>
                        <p>Các gói dịch vụ của <!-- -->4K Cinema<!-- --> không áp dụng chính sách bảo hành.</p>
                    </li>
                    <li>
                        <br><h4>CHÍNH SÁCH HOÀN TIỀN</h4><br>
                        <ol>
                            <li>Vie Channel chịu trách nhiệm hoàn tiền trong trường hợp phát sinh giao dịch lỗi trong quá trình thanh toán. Việc hoàn tiền được thực hiện tùy theo quy định của các cổng thanh toán điện tử mà Khách hàng đã thanh toán trong thời hạn quá 30 (ba mươi) ngày kể từ ngày tiếp nhận thông báo lỗi. Trường hợp Đơn vị chấp nhận thanh toán cần nhiều thời gian hơn để xác thực giao dịch, Vie Channel sẽ thông báo để Khách hàng được biết và nỗ lực giải quyết trong thời gian sớm nhất.</li>
                            <li>Vie Channel không áp dụng chính sách hoàn tiền trong trường hợp Khách hàng thanh toán thành công và nhận đầy đủ Gói dịch vụ.</li>
                        </ol>
                    </li>
                    <li>
                        <br><h4>BẢO VỆ THÔNG TIN TÀI KHOẢN</h4><br>
                        <ol>
                            <li>Khách hàng có trách nhiệm bảo mật tài khoản đã đăng ký thông qua việc bảo mật mật khẩu và các thông tin liên quan đến tài khoản của Khách hàng. Việc kiểm soát tài khoản được thực hiện thông qua việc sử dụng các mật khẩu; để duy trì độc quyền kiểm soát, Khách hàng không tiết lộ mật khẩu cho bất cứ ai. Ngoài ra, Khách hàng không tiết lộ các chi tiết thông tin thanh toán liên kết với tài khoản của mình.</li>
                            <li>Khách hàng cần bảo quản cẩn thận các thiết bị đã dùng để truy cập Dịch vụ <!-- -->4K Cinema<!-- --> nhằm bảo mật tài khoản của Khách hàng.</li>
                            <li>Vie Channel không chịu trách nhiệm về bất kỳ thiệt hại nào phát sinh từ việc tài khoản của Khách hàng bị sử dụng trái phép. Đồng thời, Vie Channel có quyền tạm dừng hoặc chấm dứt việc sử dụng tài khoản của Khách hàng với mục đích bảo vệ cho Khách hàng, Vie Channel hoặc các đối tác của Vie Channel khỏi các hành vi sai trái, vi phạm pháp luật.</li>
                        </ol>
                    </li>
                    <li>
                        <br><h4>KHUYẾN MẠI VÀ DÙNG THỬ</h4><br>
                        <ol>
                            <li>Khách hàng hiểu rõ rằng, tuỳ từng thời điểm, Khách hàng có thể được miễn, giảm Phí Dịch vụ theo các chương trình khuyến mại hoặc dùng thử Dịch vụ <!-- -->4K Cinema<!-- --> có thời hạn do Vie Channel và các đối tác thực hiện.</li>
                            <li>Khách hàng hiểu rõ và đồng ý rằng sau khi kết thúc thời hạn khuyến mại hoặc dùng thử nói trên, việc Khách hàng tiếp tục sử dụng Dịch vụ <!-- -->4K Cinema<!-- --> sẽ tạo thành một giao dịch mua bán giữa Khách hàng và Vie Channel, và Vie Channel có quyền thu Phí Dịch vụ từ Khách hàng tính từ thời điểm kết thúc chương trình khuyến mại/dùng thử trở đi. Khách hàng đồng ý cho phép Vie Channel thu tiền sử dụng Dịch vụ <!-- -->4K Cinema<!-- --> thông qua Phương Thức Thanh Toán đã đăng ký.</li>
                        </ol>
                    </li>
                    <li>
                        <br><h4>QUẢNG CÁO</h4><br>
                        <p>Khách hàng xem các nội dung không thu phí do Vie Channel cung cấp có thể kèm thêm quảng cáo theo đúng quy định của Nghị định 06/2016/NĐ-CP về quản lý, cung cấp và sử dụng dịch vụ phát thanh, truyền hình.</p>
                        <ol>
                            </ol>
                        </li>
                        <li>
                            <br><h4>SỬ DỤNG DỊCH VỤ</h4><br>
                            <ol>
                                <li>Khách hàng cam kết sẽ sử dụng các Dịch vụ của <!-- -->4K Cinema<!-- --> và bất kỳ nội dung nào được cung cấp thông qua Dịch vụ <!-- -->4K Cinema<!-- --> cho mục đích giải trí cá nhân và phi lợi nhuận. Khách hàng được cấp quyền không độc quyền để truy cập và xem nội dung thông qua Dịch vụ <!-- -->4K Cinema<!-- -->.</li>
                                <li>Khách hàng đồng ý rằng chất lượng Dịch vụ <!-- -->4K Cinema<!-- --> và nội dung có thể bị ảnh hưởng bởi nhiều yếu tố như vị trí, chất lượng băng thông, tốc độ kết nối internet cũng như cấu hình của thiết bị của Khách hàng và Vie Channel sẽ không chịu bất kỳ trách nhiệm nếu chất lượng Dịch vụ <!-- -->4K Cinema<!-- --> và nội dung trên thực tế bị ảnh hưởng bởi các yếu tố này.</li>
                                <li>Khách hàng đồng ý rằng, để cung cấp Dịch vụ <!-- -->4K Cinema<!-- --> và nội dung với chất lượng tốt nhất, Vie Channel có thể thực hiện kiểm tra, cập nhật và nâng cấp các đặc tính Dịch vụ <!-- -->4K Cinema<!-- -->, bao gồm nhưng không giới hạn: website, các ứng dụng trên điện thoại, trải nghiệm giao diện người dùng, mức độ dịch vụ, kế hoạch, tính năng quảng cáo, danh mục nội dung, phương thức giao sản phẩm và giá dịch vụ. Bằng việc sử dụng Dịch vụ <!-- -->4K Cinema<!-- -->, Khách hàng đồng ý cho phép Vie Channel thực hiện kiểm tra, cập nhật và nâng cấp nói trên mà không cần thông báo hay xin phép trước đối với Khách hàng, và việc kiểm tra, cập nhật và nâng cấp này có thể dẫn đến gián đoạn Dịch vụ <!-- -->4K Cinema<!-- --> trong một khoảng thời gian hợp lý.</li>
                            </ol>
                        </li>
                        <li>
                            <br><h4>CÁC HÀNH VI KHÁCH HÀNG KHÔNG ĐƯỢC LÀM KHI SỬ DỤNG DỊCH VỤ</h4><br>
                            <ol>
                                <li>Khách hàng hiểu và cam kết không thực hiện các hành vi sau khi sử dụng <!-- -->4K Cinema<!-- -->:
                                    <ul class="lower-alpha">
                                        <li>Cấp lại, chuyển nhượng hay chuyển giao bản quyền của bất kỳ nội dung nào dưới bất kỳ hình thức nào;</li>
                                        <li>Sử dụng Dịch vụ <!-- -->4K Cinema<!-- --> và/hoặc nội dung để phục vụ các hoạt động công chúng hoặc trình chiếu cho số đông người xem;</li>
                                        <li>Thu trái phép, lưu trữ, tái bản, phân phối, sửa đổi, trưng bày, trình diễn, xuất bản, tạo sản phẩm phái sinh, chào bán, hoặc sử dụng các nội dung được cung cấp thông qua Dịch vụ <!-- -->4K Cinema<!-- --> trừ khi được cho phép rõ ràng trong Điều Khoản Sử Dụng này hoặc được <!-- -->4K Cinema<!-- --> đồng ý bằng văn bản;</li>
                                        <li>Dịch ngược, đảo ngược hoặc tháo rời bất kỳ phần mềm hoặc sản phẩm hoặc quy trình nào được cung cấp thông qua Dịch vụ <!-- -->4K Cinema<!-- -->;</li>
                                        <li>Chèn thêm bất kỳ mã hoặc sản phẩm hay chỉnh sửa nội dung hoặc phần mềm được cung cấp thông qua Dịch vụ <!-- -->4K Cinema<!-- -->;</li>
                                        <li>Sử dụng bất kỳ biện pháp khai thác, thu thập hoặc phân tách dữ liệu nào từ Dịch vụ <!-- -->4K Cinema<!-- -->;</li>
                                        <li>Đăng tải, gửi hoặc sử dụng biện pháp khác nhằm làm gián đoạn, phá huỷ hoặc hạn chế các chức năng của phần mềm hoặc phần cứng trong bất kỳ thiết bị hoặc nền tảng nào được sử dụng để truy cập Dịch vụ <!-- -->4K Cinema<!-- -->;</li>
                                        <li>Lợi dụng việc sử dụng dịch vụ <!-- -->4K Cinema<!-- --> để gây phương hại đến an ninh quốc gia, trật tự, an toàn xã hội; phá hoại khối đại đoàn kết toàn dân; tuyên truyền chiến tranh xâm lược, khủng bố; gây hận thù, mâu thuẫn giữa các dân tộc, sắc tộc, chủng tộc, tôn giáo; tuyên truyền, kích động bạo lực, dâm ô, đồi trụy, tội ác, tệ nạn xã hội, mê tín dị đoan, phá hoại thuần phong, mỹ tục của dân tộc;</li>
                                        <li>Lợi dụng Dịch vụ <!-- -->4K Cinema<!-- --> để thu thập thông tin của người sử dụng, công bố thông tin, tư liệu về đời tư của người sử dụng khác;</li>
                                        <li>Cản trở trái pháp luật, gây rối, phá hoại hệ thống máy chủ;</li>
                                        <li>Cản trở việc truy cập thông tin và sử dụng các dịch vụ hợp pháp trên Dịch vụ <!-- -->4K Cinema<!-- -->;</li>
                                        <li>Tạo đường dẫn trái phép tới tên miền hợp pháp của tổ chức, cá nhân;</li>
                                        <li>Tạo, cài đặt, phát tán các phần mềm độc hại, vi rút máy tính;</li>
                                        <li>Xâm nhập trái phép, chiếm quyền điều khiển hệ thống thông tin, tạo lập công cụ tấn công trên Internet;</li>
                                        <li>Sử dụng bất kỳ chương trình, công cụ hay hình thức nào khác để can thiệp vào Dịch vụ <!-- -->4K Cinema<!-- -->;</li>
                                        <li>Các hành vi xâm phạm khác dưới mọi hình thức tới sản phẩm, tài sản và uy tín của Dịch vụ <!-- -->4K Cinema<!-- --> và Vie Channel.</li>
                                    </ul>
                                </li>
                                <li>Vie Channel có quyền đơn phương chấm dứt việc cung cấp dịch vụ cho Khách hàng và không hoàn trả phí dịch vụ mà Khách hàng đã thanh toán nếu Khách hàng thực hiện bất kỳ hành vi nào trong số các hành vi không được làm nêu tại Điều 8.1 Điều Khoản Sử Dụng này. Đồng thời, trong trường hợp này, Khách hàng chịu mọi trách nhiệm pháp lý và bồi thường thiệt hại cho bất kỳ bên thứ ba nào theo quy định của pháp luật.</li>
                            </ol>
                        </li>
                        <li>
                            <br><h4>XỬ LÝ VI PHẠM ĐIỀU KHOẢN SỬ DỤNG</h4><br>
                            <ol>
                                <li>Tùy theo mức độ nghiêm trọng của hành vi, vi phạm của người sử dụng với Điều Khoản Sử Dụng này, Vie Channel sẽ đơn phương và toàn quyền quyết định hình thức xử lý phù hợp dưới đây:
                                    <ul class="lower-alpha">
                                        <li>Khóa tài khoản có thời hạn (số ngày khóa do Vie Channel quyết định tùy thuộc vào mức độ vi phạm) hoặc khóa vĩnh viễn;</li>
                                        <li>Hủy bỏ toàn bộ những quyền lợi của người sử dụng gắn liền với các sản phẩm, dịch vụ do Vie Channel cung cấp. Nếu tài khoản <!-- -->4K Cinema<!-- --> của Khách hàng bị khóa vĩnh viễn, toàn bộ những quyền lợi của chủ tài khoản cũng sẽ khóa vĩnh viễn;</li>
                                    </ul>
                                </li>
                                <li>Hình thức xử phạt khóa tài khoản có thời hạn được áp dụng đối với các hành vi xâm phạm quyền riêng tư như sử dụng hình ảnh cá nhân của người khác, công khai những tư liệu cá nhân và những thông tin của khác như danh tính, địa chỉ, số điện thoại mà chưa được sự đồng ý hoặc bất kỳ hành vi vi phạm nào khác theo sự xem xét và quyết định của Vie Channel.</li>
                                <li>Hình thức xử phạt khóa vĩnh viễn được áp dụng đối với các vi phạm được quy định tại Mục 8 Điều Khoản Sử Dụng này.</li>
                                <li>Đối với các hành vi, dấu hiệu gian lận trong thanh toán, Vie Channel có quyền áp dụng một trong các hình thức xử phạt nói trên tùy thuộc vào tính chất và mức độ vi phạm mà Vie Channel xét thấy cần thiết.</li>
                                <li>Trường hợp hành vi vi phạm của người sử dụng chưa được quy định trong Điều Khoản Sử Dụng này thì tùy vào tính chất, mức độ của hành vi vi phạm, Vie Channel sẽ đơn phương, toàn quyền quyết định mức xử phạt hợp lý.</li>
                            </ol>
                        </li>
                        <li>
                            <br><h4>TRAO ĐỔI THÔNG TIN</h4><br>
                            <ol>
                                <li>Khách hàng có thể tương tác lựa chọn sử dụng các nội dung trên Dịch vụ <!-- -->4K Cinema<!-- --> và không được can thiệp bằng các bình luận hoặc không đưa nội dung cá nhân lên Dịch vụ <!-- -->4K Cinema<!-- -->. Khách hàng chấp nhận những rủi ro phát sinh và <!-- -->4K Cinema<!-- --> được loại trừ trách nhiệm này.</li>
                                <li>Khách hàng đồng ý cấp quyền cho <!-- -->4K Cinema<!-- --> sử dụng nội dung trao đổi thông tin của Khách hàng cho mục đích quảng bá, phát triển dịch vụ, bao gồm các dịch vụ mới mà chúng tôi có thể cung cấp trong tương lai.</li>
                            </ol>
                        </li>
                        <li>
                            <br><h4>GIỚI HẠN TRÁCH NHIỆM CỦA VIE CHANNEL</h4><br>
                            <ol>
                                <li>Vie Channel sẽ không chịu bất kỳ trách nhiệm nào trong những trường hợp sau:<ul class="lower-alpha">
                                    <li>Dịch vụ <!-- -->4K Cinema<!-- --> bị gián đoạn, không đạt chất lượng vì Sự Kiện Bất Khả Kháng;</li>
                                    <li>Vie Channel không thực hiện được các cam kết theo Điều Khoản Sử Dụng này vì Sự Kiện Bất Khả Kháng;</li>
                                    <li>Bất kỳ cam kết, thỏa thuận nào đối với Khách hàng không được quy định một cách rõ ràng tại Điều Khoản Sử Dụng này hoặc bằng văn bản đã được xác nhận giữa Vie Channel và Khách hàng.</li>
                                    <li>Những thiệt hại, mất mát, trách nhiệm hành chính, dân sự, hình sự gây ra cho bất kỳ Bên thứ ba nào do Khách hàng gây ra trong quá trình sử dụng dịch vụ <!-- -->4K Cinema<!-- -->.</li>
                                </ul>
                            </li>
                            <li>Cho mục đích của Điều Khoản Sử Dụng này, “<b>Sự Kiện Bất Khả Kháng</b>” được hiểu là sự kiện không nằm trong sự kiểm soát hợp lý của bên chịu ảnh hưởng của sự kiện đó và không thể lường trước và tránh được, cho dù nó xảy ra trong hiện tại hay tương lai, bao gồm thiên tai, chiến tranh, đe dọa chiến tranh, hành động khủng bố, sự can thiệp về quân sự hoặc hải quân, sự phá hoại, hành động cố ý phá hoại, khởi nghĩa, lũ lụt, lốc xoáy, động đất, sấm sét, bão, cháy, cấm vận, dịch bệnh, đình công, hỏng hóc của vệ tinh, chập điện, hư hỏng phần cứng, phần mềm, sự cố đường truyền Internet có thể làm gián đoạn hoặc giảm chất lượng Dịch vụ <!-- -->4K Cinema<!-- -->.</li>
                        </ol>
                    </li>
                    <li>
                        <br><h4>CHẤT LƯỢNG DỊCH VỤ</h4><br>
                        <div class="table-scroll m-l3">
                            <table class="table table--package">
                                <thead>
                                    <tr>
                                        <th>
                                            <h4><span style="color:#FFFFFF;"><strong>STT</strong></span></h4>
                                        </th>
                                        <th>
                                            <h4><span style="color:#FFFFFF;"><strong>Tên chỉ tiêu</strong></span></h4>
                                        </th>
                                        <th>
                                            <h4><span style="color:#FFFFFF;"><strong>Mức theo Quy chuẩn kỹ thuật quốc gia (số hiệu Quy chuẩn kỹ thuật quốc gia)</strong></span></h4>
                                        </th>
                                        <th>
                                            <h4><span style="color:#FFFFFF;"><strong>Mức công bố</strong></span></h4>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1.</td>
                                        <td>TCVN 10298:2014</td>
                                        <td>Tốc độ chương trình tương ứng cho từng cấu hình (Video bitrates):<br>+ CIF: tốc độ từ 64 kbit/s tới 2Mbit/s<br>+ VGA: tốc độ từ 128 kbit/s đến 4Mbit/s</td>
                                        <td>Tốc độ chương trình tương ứng cho từng cấu hình (Video bitrates):<br>+ VGA: tốc độ từ 800 kbit/s đến 4Mbit/s</td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>TCVN 10298:2014</td>
                                        <td>Tốc độ tải trung bình chương trình truyền hình: Tth ≥ 320 kbps</td>
                                        <td>Tốc độ tải trung bình chương trình truyền hình: Tth ≥ 800 kbps</td>
                                    </tr>
                                    <tr>
                                        <td>3.</td>
                                        <td>TCVN 10298:2014</td>
                                        <td>Điểm chất lượng tín hiệu Video trung bình ≥ 3</td>
                                        <td>Điểm chất lượng tín hiệu Video trung bình ≥ 4</td>
                                    </tr>
                                    <tr>
                                        <td>4.</td>
                                        <td>TCVN 10298:2014</td>
                                        <td>Điểm chất lượng tín hiệu Audio trung bình ≥ 3</td>
                                        <td>Điểm chất lượng tín hiệu Audio trung bình ≥ 4</td>
                                    </tr>
                                    <tr>
                                        <td>5.</td>
                                        <td>TCVN 10298:2014</td>
                                        <td>Điểm chất lượng tín hiệu Video/Audio trung bình ≥ 3</td>
                                        <td>Điểm chất lượng tín hiệu Video/Audio trung bình ≥ 4</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </li>
                    <li>
                        <br><h4>TỔNG ĐÀI HỖ TRỢ KHÁCH HÀNG</h4><br>
                        <p>Mọi thông tin liên hệ, thắc mắc, khiếu nại hoặc đề nghị trợ giúp, Khách hàng vui lòng liên hệ theo thông tin sau:</p><br>
                        <address class="p-t1" style="font-style:normal;padding-left:24px"><b style="font-weight:bold">CÔNG TY CỔ PHẦN 4K CINEMA</b><br>
                            <br>
                            <b style="font-weight:bold">Trung Tâm Dịch Vụ Khách hàng</b><br>
                            <br>
                            Email: <a style="color:antiquewhite" class="link" href="mailto:support@4kcinema.vn" title="Email hỗ trợ">support@4kcinema.vn</a><br>
                            <br>
                            Hotline: <a style="color:antiquewhite" class="link" href="tel:(+84)1800599920" title="Hãy gọi cho chúng tôi">1800599920</a> (miễn phí)
                            <br><br>
                            Thời gian liên hệ: 24/7.
                        </address>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

@if(Auth::check())
    @if($user->package_id != 1)
        {{-- Chat Tawk.to --}}
        <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/64b14ab894cf5d49dc63936a/1h5a8noec';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
            })();
        </script>
    @endif
@endif
@endsection