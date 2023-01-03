@extends('layouts.AdminLayout')
@section('content')
<div style="margin-right: 20px">

    <ul>
        <li><input type="radio" name="search_radio" id="search_by_EmpID" value="1" onclick="searchFunction()" style="-webkit-rtl-ordering: inherit" >پرسنلی</li>
        <li><input type="radio" name="search_radio" id="search_by_name" value="2" onclick="searchFunction()" style="-webkit-rtl-ordering: inherit" >نام</li>
        <li><input type="radio" name="search_radio" id="search_by_Family" value="3" onclick="searchFunction()" style="-webkit-rtl-ordering: inherit" > خانوادگی نام</li>
    </ul>
</div>
<h1 >
    <mark id="demo"></mark>
</h1>
    <table class="table table-bordered" id="Tel_Table" >
        <thead>
        <tr>
            <th>دیف</th>
            <th>شماره پرسنلی</th>
            <th>نام </th>
            <th>نام خانوادگی</th>
            <th>موبایل</th>

            <th width="300px;">عملیات</th>
        </tr>
        </thead>
        <tbody>
        <input type="text" id="myInput" onkeyup="myFunction()"  title="Type in a name" hidden>
        @php
            $count_row=1
        @endphp
        @if(!empty($data_user))
            @foreach($data_user as $value)
                <tr>
                    <td  class="column_name" data-column_name="User_Count" data-id={{ $value->id }}>{{ $count_row  }}</td>
                    <td  class="column_name" data-column_name="User_Emp_ID" data-id={{ $value->id }}>{{ $value->Emd_id  }}</td>
                    <td  class="column_name" data-column_name="User_Name" data-id={{ $value->id }}>{{ $value->name }}</td>
                    <td  class="column_name" data-column_name="User_Family" data-id={{ $value->id }}>{{ $value->family }}</td>
                    <td contenteditable style="background-color: #80ff00; font-family: "B Titr", "B Tir", "B Badr", "B Nazanin""  class="column_name" data-column_name="User_Mobile" data-id={{ $value->id }}>{{ $value->mobile }}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-xs delete" data-id={{ $value->id }}>حذف</button>
                        <button type="button" class="btn btn-success btn-xs edite" id={{$value->id."_".$count_row}}>بروزرسانی</button>
                    </td>
                </tr>
                @php
                    $count_row+=1
                @endphp

            @endforeach


        @endif
        </tbody>
    </table >
    <table class="table table-bordered" id="Tel_Table_temp" hidden>
        <thead>
        <tr>
            <th>دیف</th>
            <th>شماره پرسنلی</th>
            <th>نام </th>
            <th>نام خانوادگی</th>
            <th>موبایل</th>

            <th width="300px;">عملیات</th>
        </tr>
        </thead>
        <tbody>
        @php
            $count_row=1
        @endphp
        @if(!empty($data_user_all))
            @foreach($data_user_all as $value)
                <tr>
                    <td  class="column_name" data-column_name="User_Count" data-id={{ $value->id }}>{{ $count_row  }}</td>
                    <td  class="column_name" data-column_name="User_Emp_ID" data-id={{ $value->id }}>{{ $value->Emd_id  }}</td>
                    <td  class="column_name" data-column_name="User_Name" data-id={{ $value->id }}>{{ $value->name }}</td>
                    <td  class="column_name" data-column_name="User_Family" data-id={{ $value->id }}>{{ $value->family }}</td>
                    <td  class="column_name" data-column_name="User_Mobile" data-id={{ $value->id }}>{{ $value->mobile }}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-xs delete" data-id={{ $value->id }}>حذف</button>
                        <button type="button" class="btn btn-success btn-xs edite" id={{$value->id."_".$count_row}}>بروزرسانی</button>
                    </td>
                </tr>
                @php
                    $count_row+=1
                @endphp

            @endforeach


        @endif
        </tbody>
    </table>
    {{ csrf_field() }}
    <div class="d-flex justify-content-lg-center" hidden="false">
        {{ $data_user->appends(['sort' => 'department'])->links() }}
        {{--                {{ $data->fragment(['sort' => 'department'])->links() }}--}}
    </div>
    <script type="text/javascript" charset="utf-8">
        var token ='<?php echo csrf_token() ?>';
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue, flag;
            var radioValue=document.querySelector("input[type='radio'][name=search_radio]:checked").value;
            function toEnDigit(s) {
                return s.replace(/[\u0660-\u0669\u06f0-\u06f9]/g,    // Detect all Persian/Arabic Digit in range of their Unicode with a global RegEx character set
                    function(a) { return a.charCodeAt(0) & 0xf }     // Remove the Unicode base(2) range that not match
                )
            }
            // console.log({
            //     "Radio_value":radioValue
            // })

            input = document.getElementById("myInput").value;
            flag=0;
            // console.log({
            //     "inputs":input
            // })
            // filter = emp_id.value;
            table = document.getElementById("Tel_Table_temp");
            // console.log({
            //     "table":table
            // })
            tr = table.getElementsByTagName("tr");
            document.getElementById("Tel_Table_temp").hidden=false;
            document.getElementById("Tel_Table").hidden=true;
            document.getElementById("demo").innerHTML ="";
            for (i = 0; i < tr.length; i++) {// repeat this loop for each row of table
                td = tr[i].getElementsByTagName("td")[radioValue];
                

                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (radioValue==1){
                        txtValue=toEnDigit(txtValue);

                    //     console.log({
                    //     "TD_value":toEnDigit(txtValue)
                    // })

                    }
                       
                    if (txtValue.toLowerCase().indexOf(input) > -1) {
                        flag++;
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }

                }
            }
            if(flag==0 && input!="" && radioValue==1){
                document.getElementById("demo").innerHTML = "همچین پرسنلی اطلاعاتی در سیستم موجود نمی باشد.";
            }
            if(flag==0 && input!="" && radioValue==2){
                document.getElementById("demo").innerHTML = "همچین نامی در سیستم موجود نمی باشد.";
            }
            if(flag==0 && input!="" && radioValue==3){
                document.getElementById("demo").innerHTML = "همچین فامیلی در سیستم موجود نمی باشد.";
            }
            if(flag==0 || input=="" ){
                document.getElementById("Tel_Table_temp").hidden=true;
                document.getElementById("Tel_Table").hidden=false;
            }
            {{--console.log({--}}
            {{--    "prs_user":emp_id,--}}
            {{--    "token":_token--}}

            {{--});--}}
            {{--$.ajax({--}}
            {{--    url:"{{ route('prs_search') }}",--}}
            {{--    method:"POST",--}}
            {{--    data:{prs_user:emp_id,--}}
            {{--        _token:_token--}}
            {{--    },--}}
            {{--    success: function(data){ // What to do if we succeed--}}
            {{--        $('#message_new').html(data);--}}
            {{--        //$('#div_data').html(data2);--}}
            {{--        // div_header1.style.display="none";--}}
            {{--        // div_header_lte.style.display="none";--}}
            {{--        // div_ribon.style.display="none";--}}
            {{--        //div_header2.style.display="block";--}}
            {{--        //location.reload();--}}
            {{--    },--}}
            {{--    error: function(data){--}}
            {{--        alert('Error'+data);--}}
            {{--        //console.log(data);--}}
            {{--    }--}}
            {{--});--}}
        }
        function searchFunction() {
                document.getElementById("myInput").hidden=false;
        }
        function import_data(){

            if(confirm("آیا می خواهید فایل جدیدی را آپلود نمایید؟")==true)
            {
                // document.getElementById("demo").innerHTML = "در این قسمت کد های لازم را بنویسید.";
                $.ajax(
                    {

                        url: "file-import",
                        type: 'POST',
                        data: {
                            "_token": token,
                        },
                        success: function (){
                            //console.log("it Works");
                            document.getElementById("demo").innerHTML = "اطلاعات با موفقیت بروزرسانی گردید.";
                            //location.reload();
                            $( "#Tel_Table" ).load(window.location.href + " #Tel_Table" );
                        }
                    });
            }
            else
            {
                $('#demo').html("<div class='alert alert-danger'>در بر.زرسانی دادده ها خطایی رخ داده است.</div>");
                $( "#Tel_Table" ).load(window.location.href + " #Tel_Table" );
            }
        };
        $(document).on('click', '.delete', function(){
            var id = $(this).data("id");
            console.log({
                id:id,
            });
            if(confirm("آیا می خواهید این پیام را حذف نمایید؟")==true)
            {
                $.ajax(
                    {

                        url: "users/"+id,
                        type: 'DELETE',
                        data: {
                            "id": id,
                            "_token": token,
                        },
                        success: function (){
                            //console.log("it Works");
                            document.getElementById("demo").innerHTML = "اطلاعات با موفقیت حذف گردید.";
                            //location.reload();
                            $( "#Tel_Table" ).load(window.location.href + " #Tel_Table" );
                        }
                    });
            }
            else
            {
                $('#demo').html("<div class='alert alert-danger'>در حذف خطایی رخ داده است لطفا ذوباره سعی فرمایید.</div>");
                $( "#Tel_Table" ).load(window.location.href + " #Tel_Table" );
            }


        });
        $(document).on('click', '.edite', function(){

            var allid=$(this).attr("id").split("_");
            console.log(allid);
            var id2=allid[0];
            var countRow=Number(allid[1]);
            //var count_type=Number(allid[1]);
            var id_edit = document.getElementById("Tel_Table").rows[countRow].cells.item(0).innerHTML;
            var mob_user =document.getElementById("Tel_Table").rows[countRow].cells.item(4).innerHTML;
            //var link_type=$("#opttypes["+countRow+"]"+" :selected").val();// how many time i spent on this line, my God
            //var link_type = document.getElementById("opttypes["+count_type+"]").value;
            //var link_type = sel.options[opttypes.selectedIndex];
            //document.getElementById("demo").innerHTML = document.getElementById("tweblinks").rows[countRow].cells.item(0).innerHTML;
            console.log({
                new_mobile:mob_user,
                id_ajax:id2,
                _token:token
            });
            if(mob_user != '' )
            {

                if(!confirm("آیا می خواهید ورایش نمایید.")) {
                    return false;
                }

                //document.getElementById("demo").innerHTML = msg_user;

                try
                {
                    var _token=$("meta[name='csrf-token']").attr("content");
                    $.ajax({
                        url:"{{ route('Update_mobile') }}",
                        method:"POST",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data:{new_mobile:mob_user, id_ajax:id2, _token:token},
                        success: function(data){ // What to do if we succeed
                            $('#demo').html(data);
                            $( "#Tel_Table" ).load(window.location.href + " #Tel_Table" );
                        },
                        error: function(data){
                            alert('Error'+data);
                            //console.log(data);
                        }
                    })
                    //document.getElementById("div_data").contentWindow.location.reload(true);
                    //reload();
                    //$("#div_data").html(htmlData);
                }
                catch (e) {
                    $('#demo').html("<div class='alert alert-danger'>در دریافت و ارسال به پایگاه  خطای روی داده است.</div>");
                    $( "#Tel_Table" ).load(window.location.href + " #Tel_Table" );
                }
            }// end if check empty box
            else {
                $('#demo').html("<div class='alert alert-danger'>موبای نباید خالی باشد.</div>");
                $( "#Tel_Table" ).load(window.location.href + " #Tel_Table" );
            }

        });

    </script>
@endsection
