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
                    <td  class="column_name" data-column_name="User_Mobile" data-id={{ $value->id }}>{{ $value->mobile }}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-xs delete" data-id={{ $value->id }}>حذف کامل</button>
                        <button type="button" class="btn btn-success btn-xs restore" data-id={{$value->id}}>بازیابی</button>
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
                        <button type="button" class="btn btn-danger btn-xs delete" data-id={{ $value->id }}>حذف کامل</button>
                        <button type="button" class="btn btn-success btn-xs restore" id={{$value->id."_".$count_row}}>بازیابی</button>
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
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[radioValue];

                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toLowerCase().indexOf(input) > -1) {
                        flag++;
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }

                }
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
        $(document).on('click', '.restore', function(){
            var id = $(this).data("id");
            console.log({
                id:id,
            });
            if(confirm("آآیا می خواهید این کاربر را دوبار بازیابی نمایید")==true)
            {
                $.ajax(
                    {

                        url: "restore_user",
                        type: 'POST',
                        data: {
                            "id": id,
                            "_token": token,
                        },
                        success: function (){
                            //console.log("it Works");
                            document.getElementById("demo").innerHTML = "اطلاعات با موفقیت بازیابی گردید.";
                            //location.reload();
                            $( "#Tel_Table" ).load(window.location.href + " #Tel_Table" );
                        }
                    });
            }
            else
            {
                $('#demo').html("<div class='alert alert-danger'>در بازیابی خطایی رخ داده است لطفا ذوباره سعی فرمایید.</div>");
                $( "#Tel_Table" ).load(window.location.href + " #Tel_Table" );
            }
        });
        $(document).on('click', '.delete', function(){
            var id = $(this).data("id");
            console.log({
                id:id,
            });
            if(confirm("آیا می خواهید این کاربر  را به طور کامل حذف نمایید؟")==true)
            {
                $.ajax(
                    {

                        url: "ForceDeleteUser/"+id,
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
    </script>
@endsection
