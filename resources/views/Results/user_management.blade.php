@extends('layouts.AdminLayout')
@section('content')
    <br>
    <div id="load_module" style="color: rgb(0,0,0);">
{{--        @foreach($data as $key => $value)--}}

            <div class="col-md-2 col-sm-6 col-xs-6" style="padding: 5px">
                <button onclick="" class="rippler module rippler-inverse">
                <span class="icon_module">
                    <i class="dashboard-icons-colors special_offer_sl">

                    </i>
                </span>
                    <span class="title_module" style="font-size: 10px;">آپلود فایل اکسل</span>
                </button>
            </div>
        <div class="col-md-2 col-sm-6 col-xs-6" style="padding: 5px">
            <button onclick="" class="rippler module rippler-inverse">
                <span class="icon_module">
                    <i class="dashboard-icons-colors special_offer_sl">

                    </i>
                </span>
                <span class="title_module" style="font-size: 10px;">اضافه کردن تکی</span>
            </button>
        </div>

{{--        @endforeach--}}
    </div>
    <div class="k-rtl main-grid no-copy-pase ng-isolate-scope k-grid k-widget" api="api" options="gridOptions" data-role="grid" style="height: 802px;">
        <div class="k-grid-header" style="padding-left: 5px;">
            <div class="k-grid-header-wrap">
                <table role="grid">
                    <colgroup>
                        <col style="width:70px">
                        <col style="width:140px">
                        <col style="width:140px">
                        <col style="width:250px">
                        <col style="width:250px">
                        <col style="width:250px">
                    </colgroup>
                    <thead role="rowgroup">
                        <tr role="row">
                            <th role="columnheader" data-field="" rowspan="1" data-title="ردیف" data-index="0" class="column-row-number k-header">ردیف</th>
                            <th role="columnheader" data-field="id" rowspan="1" data-title="کد پرسنلی" data-index="1" class="k-header k-with-icon k-filterable" data-role="columnsorter" data-dir="asc" aria-sort="ascending">
                                <a class="k-grid-filter" href="#" tabindex="-1">
                                    <span class="k-icon k-filter" onclick="showformFilter()"></span>
                                </a>
                                <a class="k-link" href="#">کد پرسنلی<span class="k-icon k-i-arrow-n"></span></a>
                            </th>
                            <th role="columnheader" data-field="id" rowspan="1" data-title="کد پرسنلی" data-index="1" class="k-header k-with-icon k-filterable" data-role="columnsorter" data-dir="asc" aria-sort="ascending">
                                <a class="k-grid-filter" href="#" tabindex="-1">
                                    <span class="k-icon k-filter" onclick="showformFilter()"></span>
                                </a>
                                <a class="k-link" href="#">نام<span class="k-icon k-i-arrow-n"></span></a>
                            </th>
                            <th role="columnheader" data-field="id" rowspan="1" data-title="کد پرسنلی" data-index="1" class="k-header k-with-icon k-filterable" data-role="columnsorter" data-dir="asc" aria-sort="ascending">
                                <a class="k-grid-filter" href="#" tabindex="-1">
                                    <span class="k-icon k-filter" onclick="showformFilter()"></span>
                                </a>
                                <a class="k-link" href="#">نام خانوادگی<span class="k-icon k-i-arrow-n"></span></a>
                            </th>
                            <th role="columnheader" data-field="id" rowspan="1" data-title="کد پرسنلی" data-index="1" class="k-header k-with-icon k-filterable" data-role="columnsorter" data-dir="asc" aria-sort="ascending">
                                <a class="k-grid-filter" href="#" tabindex="-1">
                                    <span class="k-icon k-filter" onclick="showformFilter()"></span>
                                </a>
                                <a class="k-link" href="#">موبایل<span class="k-icon k-i-arrow-n"></span></a>
                            </th>
                            <th role="columnheader" data-field="id" rowspan="1" data-title="کد پرسنلی" data-index="1" class="k-header k-with-icon k-filterable" data-role="columnsorter" data-dir="asc" aria-sort="ascending">
                                <a class="k-grid-filter" href="#" tabindex="-1">
                                    <span class="k-icon k-filter" onclick="showformFilter()"></span>
                                </a>
                                <a class="k-link" href="#">عملیات<span class="k-icon k-i-arrow-n"></span></a>
                            </th>


                        </tr>

                    </thead>
                    <tbody>
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
                <div class="d-flex justify-content-lg-center">
                    {{ $data_user->appends(['sort' => 'department'])->links() }}
                    {{--                {{ $data->fragment(['sort' => 'department'])->links() }}--}}
                </div>

            </div>

        </div>

    </div>
        <div block-ui="main" class="ng-scope block-ui">
            <div ng-show="state.blockCount > 0" class="block-ui-overlay ng-hide" ng-class="{ 'block-ui-visible': state.blocking }"></div>
            <div ng-show="state.blocking" class="block-ui-message-container ng-hide">
                <div id="loader3" class="loader">
                    <div class="roller"></div>
                    <div class="roller"></div>
                </div>
                <div class="loader">
                    <div class="roller"></div>
                    <div class="roller"></div>
                </div>
                <div id="loader2" class="loader">
                    <div class="roller"></div>
                    <div class="roller"></div>
                </div>
            </div>
        </div>
        <div class="k-list-container k-popup k-group k-reset k-rtl" data-role="popup" style="position: absolute; height: auto; display: none;">
            <ul unselectable="on" class="k-list k-reset" tabindex="-1" role="listbox" aria-hidden="true" aria-live="off" style="overflow: auto; height: auto;">
                <li tabindex="-1" role="option" unselectable="on" class="k-item k-state-selected k-state-focused">5</li>
                <li tabindex="-1" role="option" unselectable="on" class="k-item">10</li>
                <li tabindex="-1" role="option" unselectable="on" class="k-item">20</li>
            </ul>
        </div>
        <div class="k-animation-container k-rtl" id="FormFilter" hidden="true" style="width: 229px; height: 161px; margin-left: 10px; padding-left: 10px; padding-right: 10px; padding-bottom: 15px; overflow: visible; display: block; position: absolute; top: 165.267px; z-index: 10002; left: 171.4px; box-sizing: content-box;">
            <form class="k-filter-menu k-popup k-group k-reset k-state-border-up"   data-role="popup" style="display: block; font-size: 16px; font-family: Yekan; font-stretch: 100%; font-style: normal; font-weight: 400; line-height: 24px; transform: translateY(0px); position: absolute;">
                <div>
                    <div class="k-filter-help-text">فیلتر:</div>
                    <span class="k-widget k-dropdown k-header" unselectable="on" role="listbox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-owns="" aria-disabled="false" aria-readonly="false" aria-busy="false" style="">
                        <span unselectable="on" class="k-dropdown-wrap k-state-default">
                            <span unselectable="on" class="k-input">مساوی</span>
                            <span unselectable="on" class="k-select">
                                <span unselectable="on" class="k-icon k-i-arrow-s">select</span>
                            </span>
                        </span>
                        <select data-bind="value: filters[0].operator" data-role="dropdownlist" style="display: none;">
                            <option value="eq" selected="selected">مساوی</option>
                            <option value="neq">مخالف</option>
                            <option value="gte">بزرگتر یا مساوی</option>
                            <option value="gt">بزگتر</option>
                            <option value="lte">کوچکتر یا مساوی</option>
                            <option value="lt">کوچکتر</option>
                        </select>
                    </span>
                    <span class="k-widget k-numerictextbox" style="">
                        <span class="k-numeric-wrap k-state-default">
                            <input type="text" class="k-formatted-value k-input" tabindex="0" aria-disabled="false" aria-readonly="false" style="display: inline-block;">
                            <input data-bind="value:filters[0].value" class="k-input" type="text" data-role="numerictextbox" role="spinbutton" aria-valuenow="" aria-disabled="false" aria-readonly="false" style="display: none;">
                            <span class="k-select">
                                <span unselectable="on" class="k-link">
                                    <span unselectable="on" class="k-icon k-i-arrow-n" title="Increase value">Increase value</span>
                                </span>
                                <span unselectable="on" class="k-link">
                                    <span unselectable="on" class="k-icon k-i-arrow-s" title="Decrease value">Decrease value</span>
                                </span>
                            </span>
                        </span>
                    </span>
                    <div>
                        <button type="submit" class="k-button k-primary">اعمال فیلتر</button>
                        <button type="reset" class="k-button">لغو فیلتر</button>
                    </div>
                </div>
                <div class="k-list-container k-popup k-group k-reset" data-role="popup" style="position: absolute; height: auto; display: none;">
                    <ul unselectable="on" class="k-list k-reset" tabindex="-1" role="listbox" aria-hidden="true" aria-live="off" style="overflow: auto; height: auto;">
                        <li tabindex="-1" role="option" unselectable="on" class="k-item k-state-selected k-state-focused">مساوی</li>
                        <li tabindex="-1" role="option" unselectable="on" class="k-item">مخالف</li>
                        <li tabindex="-1" role="option" unselectable="on" class="k-item">بزرگتر یا مساوی</li>
                        <li tabindex="-1" role="option" unselectable="on" class="k-item">بزگتر</li>
                        <li tabindex="-1" role="option" unselectable="on" class="k-item">کوچکتر یا مساوی</li>
                        <li tabindex="-1" role="option" unselectable="on" class="k-item">کوچکتر</li>
                    </ul>
                </div>
            </form></div>
        <div class="k-animation-container k-rtl" style="width: 229px; height: 164px; margin-left: 10px; padding-left: 10px; padding-right: 10px; padding-bottom: 15px; overflow: hidden; display: none; position: absolute; top: 165.267px; z-index: 10002; left: 1441.32px;">
            <form class="k-filter-menu k-popup k-group k-reset"   data-role="popup" style="display: none; font-size: 16px; font-family: Yekan; font-stretch: 100%; font-style: normal; font-weight: 400; line-height: 24px; position: absolute; transform: translateY(-164px);">
                <div>
                    <div class="k-filter-help-text">فیلتر:</div>
                    <span class="k-widget k-dropdown k-header" unselectable="on" role="listbox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-owns="" aria-disabled="false" aria-readonly="false" aria-busy="false" style="">
                        <span unselectable="on" class="k-dropdown-wrap k-state-default">
                            <span unselectable="on" class="k-input">شامل</span>
                            <span unselectable="on" class="k-select">
                                <span unselectable="on" class="k-icon k-i-arrow-s">select</span>
                            </span>
                        </span>
                        <select data-bind="value: filters[0].operator" data-role="dropdownlist" style="display: none;">
                            <option value="contains" selected="selected">شامل</option>
                            <option value="endswith">خاتمه یابد به</option>
                            <option value="eq">برابر با</option>
                            <option value="neq">مخالف با</option>
                            <option value="doesnotcontain">شامل نباشد</option>
                            <option value="startswith">شروع شود با</option>
                        </select>
                    </span>
                    <input data-bind="value:filters[0].value" class="k-textbox" type="text">
                    <div>
                        <button type="submit" class="k-button k-primary">اعمال فیلتر</button>
                        <button type="reset" class="k-button">لغو فیلتر</button>
                    </div>
                </div>
                <div class="k-list-container k-popup k-group k-reset" data-role="popup" style="position: absolute; height: auto; display: none;">
                    <ul unselectable="on" class="k-list k-reset" tabindex="-1" role="listbox" aria-hidden="true" aria-live="off" style="overflow: auto; height: auto;">
                        <li tabindex="-1" role="option" unselectable="on" class="k-item k-state-selected k-state-focused">شامل</li>
                        <li tabindex="-1" role="option" unselectable="on" class="k-item">خاتمه یابد به</li>
                        <li tabindex="-1" role="option" unselectable="on" class="k-item">برابر با</li>
                        <li tabindex="-1" role="option" unselectable="on" class="k-item">مخالف با</li>
                        <li tabindex="-1" role="option" unselectable="on" class="k-item">شامل نباشد</li>
                        <li tabindex="-1" role="option" unselectable="on" class="k-item">شروع شود با</li>
                    </ul>
                </div>
            </form>
        </div>
    <script>
        function showformFilter() {
            if(document.getElementById("FormFilter").hidden)
            {
                document.getElementById("FormFilter").hidden=false;
            }else{
                document.getElementById("FormFilter").hidden=true

            }
           console.log({
               "hide_val":document.getElementById("FormFilter").hidden
           })


        }
    </script>

@endsection

