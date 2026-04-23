@extends('user.layouts.app')

@section('title', 'Tính BMI')

@section('content')
<div class="site-section" id="bmi-section">
    <div class="container">
        <form method="POST" name="BMI" class="mt-5">
            @csrf
            <div class="row">   
                <div class="col-sm-12">
                    <div class="control-group form-group">
                        <div class="controls">
                            <h1 class="text-center">
                                ĐO CHỈ SỐ CÂN NẶNG - CHIỀU CAO (BMI) ONLINE
                            </h1>
                        </div>
                    </div>

                    <div class="controls">
                        <label>Nhập chiều cao của bạn:</label>
                        <input type="text" class="form-control" placeholder="Tính theo cm"
                            onfocus="this.form.height.value=''" size="3" name="height" />
                    </div>
                    <div class="controls" style="padding-top: 10px;">
                        <label>Nhập cân nặng của bạn:</label>
                        <input type="text" class="form-control" placeholder="Tính theo kg"
                            onfocus="this.form.weight.value=''" size="3" name="weight" />
                    </div>
                    <div class="controls" style="padding-top: 15px;">
                        <table class="table">
                            <tr>
                                <td style="text-align:center;">
                                    <input type="button" value="XEM" onclick="computeform(this.form)"
                                        class="btn btn-primary" />
                                </td>
                                <td style="text-align:center;">
                                    <input type="reset" value="XÓA" onclick="ClearForm(this.form)"
                                        class="btn btn-success">
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="controls" style="padding-top:10px;">
                        <label>Kết quả BMI của bạn:</label>
                        <input type="text" class="form-control" size="3" name="bmi">
                    </div>

                    <div class="controls" style="padding-top:10px;">
                        <label>Nhận xét BMI của bạn:</label>
                        <input type="text" class="form-control" size="3" name="my_comment">
                    </div>

                    <table class="table" cellspacing="3" cellpadding="2" bgcolor="#E2e2e2"
                        style="border-style: thin; padding-left: 5PX">
                        <tbody>
                            <tr>
                                <td>
                                    <h2 align="center" style="line-height: 175%;" class="MsoNormal"><strong>THÔNG TIN VỀ
                                            CHỈ SỐ BMI </strong></h2>
                                    <h2 align="justify" style="line-height: 175%;" class="MsoNormal"><strong><em><span
                                                    style="line-height: 175%; font-family: Arial; font-size: 10pt;">BMI
                                                    (Body mass Index) là chỉ số được tính từ chiều cao và cân nặng, là
                                                    một chỉ số đáng tin cậy về sự mập ốm của một
                                                    người.</span></em></strong></h2>
                                    <p align="justify" style="margin: 0in 0in 0.0001pt; line-height: 175%;"><span
                                            style="font-family: Arial; font-size: 10pt;">BMI không đo lường trực tiếp mỡ
                                            của cơ thể nhưng các nghiên cứu đã chứng minh rằng BMI tương quan với đo mỡ
                                            trực tiếp. BMI là phương pháp không tốn kém và dễ thực hiện để tầm soát vấn
                                            đề sức khoẻ. </span></p>

                                    <p align="justify" style="margin: 0in 0in 0.0001pt;"><span
                                            style="font-family: Arial; font-size: 10pt;">&nbsp;</span></p>

                                    <p align="justify" style="margin: 0in 0in 0.0001pt; line-height: 175%;">
                                        <strong>
                                            <h2 style="font-family: Arial; font-size: 10pt;">1. Sử dụng BMI như thế nào?
                                            </h2>
                                        </strong><span style="font-family: Arial; font-size: 10pt;">
                                            <br>
                                            BMI được sử dụng như là một công cụ tầm soát để xác định trọng lượng thích
                                            hợp cho người lớn. Tuy nhiên, BMI không phải là công cụ chẩn đoán. Ví dụ,
                                            một người có chỉ số BMI cao, để xác định trọng lượng có phải là một nguy cơ
                                            cho sức khoẻ không thì các bác sĩ cần thực hiện thêm các đánh giá khác.
                                            Những đánh giá này gồm đo độ dày nếp da, đánh giá chế độ ăn, hoạt động thể
                                            lực, tiền sử gia đình và các sàng lọc sức khoẻ khác.
                                        </span>
                                    </p>

                                    <p align="justify" style="margin: 0in 0in 0.0001pt;"><strong><span
                                                style="font-family: Arial; font-size: 10pt;">&nbsp;</span></strong></p>

                                    <p align="justify" style="margin: 0in 0in 0.0001pt; line-height: 175%;">
                                        <strong>
                                            <h2 style="font-family: Arial; font-size: 10pt;">2. Tại sao Cơ quan kiểm
                                                soát bệnh tật Hoa Kỳ - CDC sử dụng BMI để xác định sự thừa cân và béo
                                                phì?</h2>
                                        </strong><span style="font-family: Arial; font-size: 10pt;">
                                            <br>
                                            Tính chỉ số BMI là một phương pháp tốt nhất để đánh giá thừa cân và béo phì
                                            cho một quần thể dân chúng. Để tính chỉ số BMI, người ta chỉ yêu cầu đo
                                            chiều cao và cân nặng, không tốn kém và dễ thực hiện. Sử dụng chỉ số BMI cho
                                            phép người ta so sánh tình trạng cân nặng của họ với quần thể nói chung.
                                            Công thức tính BMI theo đơn vị kilograms và mét (xem cách tính dưới đây)
                                            <br>
                                            - <strong>
                                                <h2 style="font-family: Arial;">Cách tính và đánh giá chỉ số BMI như thế
                                                    nào? </h2>
                                            </strong><strong>
                                                <br>
                                                <!--[if !supportLineBreakNewLine]-->
                                                <br>
                                                <!--[endif]-->
                                            </strong>
                                        </span>
                                    </p>

                                   
                                    <p align="justify" style="margin: 0in 0in 0.0001pt; line-height: 175%;">
                                    <h2 style="font-family: Arial; font-size: 10pt;">
                                        <br>
                                        <strong>- &nbsp;Cách đánh giá chỉ số BMI </strong>
                                        <br>
                                        Đối với người lớn từ 20 tuổi trở lên, Sử dụng bảng phân loại chuẩn cho cả nam và
                                        nữ để đánh giá chỉ số BMI.
                                    </h2>
                                    </p>
                                    <div align="justify">
                                        <p>- BMI &lt;16: Gầy độ III </p>
                                        <p>- 16 ≤ BMI &lt;17: Gầy độ II</p>
                                        <p>- 17 ≤ BMI &lt;18.5: Gầy độ I</p>
                                        <p>- 18.5 ≤ BMI &lt;25: Bình thường</p>
                                        <p>- 25 ≤ BMI &lt;30: Thừa cân</p>
                                        <p>- 30 ≤ BMI 35: Béo phì độ 1</p>
                                        <p>- 35 ≤ BMI &lt;40: Béo phì độ II</p>
                                        <p>- BMI &gt;40: Béo phì độ III </p>
                                        <p>&nbsp; </p>
                                    </div>
                                    <p align="center" style="margin: 0in 0in 0.0001pt; line-height: 175%;"><span
                                            style="font-family: Arial; font-size: 10pt;">&nbsp;</span>---------------------------------------------------------------------------------
                                    </p>
                                    <p align="center" style="margin: 0in 0in 0.0001pt; line-height: 175%;">&nbsp;</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script language="JAVASCRIPT">
    function ClearForm(form) {
        form.weight.value = "";
        form.height.value = "";
        form.bmi.value = "";
        form.my_comment.value = "";
    }

    function bmi(weight, height) {
        bmindx = weight / (height * height);
        return bmindx.toFixed(2);
    }

    function checkform(form) {
        if (form.weight.value == null || form.weight.value.length == 0 || form.height.value == null || form.height.value.length == 0) {
            alert("\nVui lòng nhập đầy đủ thông tin về chiều cao (cm) & cân nặng (kg) của bạn. \nSau đó nhấn vào nút 'Xem' để kiểm tra BMI và phần nhận xét.");
            return false;
        }
        else if (parseFloat(form.height.value) <= 0 ||
            parseFloat(form.height.value) >= 250 ||
            parseFloat(form.weight.value) <= 0 ||
            parseFloat(form.weight.value) >= 500) {
            alert("\nBạn đã nhập không đúng. Vui lòng nhập đầy đủ thông tin về chiều cao (cm) & cân nặng (kg) của bạn. \nSau đó nhấn vào nút 'Xem' để kiểm tra BMI và phần nhận xét.");
            ClearForm(form);
            return false;
        }
        return true;
    }

    function computeform(form) {
        if (checkform(form)) {
            yourbmi = (bmi(form.weight.value, form.height.value / 100));
            form.bmi.value = yourbmi;

            if (yourbmi >= 40) {
                form.my_comment.value = "Bạn bị béo phì độ III !";
            }
            else if (yourbmi >= 35 && yourbmi < 40) {
                form.my_comment.value = "Chỉ số BMI ở trên cho thấy bạn bị béo phì độ II !";
            }
            else if (yourbmi >= 30 && yourbmi < 35) {
                form.my_comment.value = "Chỉ số BMI ở trên cho thấy bạn bị béo phì độ I";
            }
            else if (yourbmi >= 25 && yourbmi < 30) {
                form.my_comment.value = "Chỉ số BMI ở trên cho thấy bạn bị thừa cân !";
            }
            else if (yourbmi >= 18.5 && yourbmi < 25) {
                form.my_comment.value = "Chúc mừng bạn ! Bạn có chỉ số BMI bình thường !";
            }
            else if (yourbmi >= 17 && yourbmi < 18.5) {
                form.my_comment.value = "Chỉ số BMI ở trên cho thấy bạn bị gầy độ I !";
            }
            else if (yourbmi >= 16 && yourbmi < 17) {
                form.my_comment.value = "Chỉ số BMI ở trên cho thấy bạn bị gầy độ II ! ";
            }
            else if (yourbmi < 16) {
                form.my_comment.value = "Chỉ số BMI ở trên cho thấy bạn bị gầy độ III ! ";
            }
        }
        return;
    }
</script>
@endpush
@endsection