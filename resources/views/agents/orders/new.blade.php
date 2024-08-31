@extends('admin.app')
@section('page_title', 'New Shipping Order')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">New Order</h5>
                @include('admin.partials.notification')
                <hr>
                <form action="{{ route('walkInOrderAgents.store') }}" method="post" id="order-form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="ui-widget">
                                <label for="tax_code">Customer No / Tax code <i class="text-danger">*</i> : </label>
                                <input type="text" id="tax_code" name="tax_code_" value="{{ old('tax_code_') }}"
                                    class="form-control" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button type="button" onclick="verifyTaxCode()" class="btn btn-primary mt-4">Verify</button>
                        </div>
                        <br>
                        <em id="tax_code_status_text"></em>
                        <br>
                        <em id="kyc_status_text"></em>
                    </div>
                    <hr>
                    <div class="stage0">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="ui-widget">
                                    <label for="surname">Surname <i class="text-danger">*</i> : </label>
                                    <input type="text" id="surname" name="surname_" value="{{ old('surname_') }}"
                                        class="form-control" autocomplete="off" required>

                                    <input type="hidden" id="cus_id" name="cus_id">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ui-widget">
                                    <label for="name">Firstname <i class="text-danger">*</i> : </label>
                                    <input type="text" id="name" name="name_" value="{{ old('name_') }}"
                                        class="form-control" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="ui-widget">
                                    <label for="gender">Gender <i class="text-danger">*</i> : </label>
                                    <input type="text" id="gender" name="gender_" value="{{ old('gender_') }}"
                                        class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ui-widget">
                                    <label for="dob">D.O.B <i class="text-danger">*</i> : </label>
                                    <input type="date" id="dob" name="dob_" value="{{ old('dob_') }}"
                                        class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="ui-widget">
                                    <label for="gender">Document Type <i class="text-danger">*</i> : </label>
                                    <select name="doc_type_" id="doc_type" class="form-control">
                                        <option value="">--select document type--</option>
                                        <option value="EU National ID Card / Carta d'Identita' Europea">EU National ID Card
                                            / Carta d'Identita' Europea</option>
                                        <option value="ID Card / Carta Di Identità">ID Card / Carta Di Identità </option>
                                        <option value="EU Driving License / Patente Di Guida">EU Driving License / Patente
                                            Di Guida</option>
                                        <option value="Others / Altro">Others / Altro</option>
                                        <option value="Passport / Passporto">Passport / Passporto</option>
                                        <option value="EU Resident Card / Permesso Di Soggiorno">EU Resident Card / Permesso
                                            Di Soggiorno</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ui-widget">
                                    <label for="doc_num">Document Number<i class="text-danger">*</i> : </label>
                                    <input type="text" id="doc_num" name="doc_num_" value="{{ old('doc_num_') }}"
                                        class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="ui-widget">
                                    <label for="doc_front">Document Front <i class="text-danger">*</i> : </label>
                                    <input type="file" id="doc_front" name="doc_front_" class="form-control">
                                    <br>
                                    <img src="" alt="doc_front" id="doc_front_img"
                                        style="width: 100%; border:1px solid gray">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ui-widget">
                                    <label for="doc_back">Document back <i class="text-danger">*</i> : </label>
                                    <input type="file" id="doc_back" name="doc_back_" class="form-control">
                                    <br>
                                    <img src="" alt="doc_back" id="doc_back_img"
                                        style="width: 100%; border:1px solid gray">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h5>Shipping details</h5>
                        <hr>
                        <div class="row">

                            <div class="col-6 mb-2">
                                <div class="ui-widget">
                                    <label for="origin">Shipping from Country<i class="text-danger">*</i> : </label>
                                    <select name="ship_from_country" id="ship_from_country" class="form-control">

                                    </select>
                                    @error('ship_from_country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    {{-- <label for="origin">Shipping from <i class="text-danger">*</i> : </label>
                                    <input type="text" id="origin" name="origin_" value="{{ old('origin_') }}"
                                        class="form-control" autocomplete="off">
                                    <input type="hidden" name="origin_id" value="{{ old('origin_id') }}"
                                        id="origin_id"> --}}

                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <div class="ui-widget">
                                    <label for="origin">Shipping from City<i class="text-danger">*</i> : </label>
                                    <select name="ship_from_city" id="ship_from_city" class="form-control">
                                    </select>
                                    @error('ship_from_city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-2">
                                <div class="ui-widget">
                                    <label for="ship_to_country">Shipping to Country<i class="text-danger">*</i> :
                                    </label>
                                    <select name="ship_to_country" id="ship_to_country" class="form-control">

                                    </select>
                                    @error('ship_to_country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <div class="ui-widget">
                                    <label for="ship_to_city">Shipping to City<i class="text-danger">*</i> : </label>
                                    <select name="ship_to_city" id="ship_to_city" class="form-select select2">
                                    </select>
                                    @error('ship_to_city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    {{-- <label for="dest">Shipping To <i class="text-danger">*</i> : </label>
                                    <input type="text" id="dest" name="dest_" value="{{ old('dest_') }}"
                                        class="form-control" autocomplete="off">
                                    <input type="hidden" name="dest_id" value="{{ old('dest_id') }}" id="dest_id"> --}}
                                </div>
                            </div>
                        </div>
                        <hr>
                        {{-- <div class="table-responsive"> --}}
                        {{-- <table class="table"> --}}
                        {{-- <thead>
                                    <th>Package Type <i class="text-danger">*</i></th>
                                    <th>length(cm) <i class="text-danger">*</i></th>
                                    <th>Width(cm) <i class="text-danger">*</i></th>
                                    <th>Height(cm) <i class="text-danger">*</i></th>
                                    <th>Weight(Kg) <i class="text-danger">*</i></th>
                                    <th>Content Desc <i class="text-danger">*</i></th>
                                    <th>Value(&euro;) <i class="text-danger">*</i></th>
                                    <th>Count/qty <i class="text-danger">*</i></th>
                                    <th><button class="btn btn-primary btn-sm" type="button" onclick="addRow()"><i
                                                class="fa fa-plus"></i> Add</button></th>
                                </thead> --}}
                        {{-- <tbody id="items_list">
                                    <tr>
                                        <td>
                                            <select name="type[]" class="form-control type"
                                                onchange="calculateTotItems('type')" required>
                                                <option value="">--select package type--</option>
                                                <option value="percel">Percel</option>
                                                <option value="doc">Document</option>
                                                <option value="pallet">Pallet</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" step="any" min="0" value="0"
                                                class="form-control len" onkeyup="calculateTot()" name="len[]"
                                                required>
                                        </td>
                                        <td>
                                            <input type="number" step="any" min="0" value="0"
                                                class="form-control width" onkeyup="calculateTot()" name="width[]"
                                                required>
                                        </td>
                                        <td>
                                            <input type="number" step="any" min="0" value="0"
                                                class="form-control height" onkeyup="calculateTot()" name="height[]"
                                                required>
                                        </td>
                                        <td>
                                            <input type="number" step="any" min="0" value="0"
                                                class="form-control weight" onkeyup="calculateTot()" name="weight[]"
                                                required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="item_desc[]"
                                                placeholder="Description...">
                                        </td>
                                        <td>
                                            <input type="number" step="any" min="0" value="0.0"
                                                class="form-control itemvalue" name="item_value[]" required>
                                        </td>
                                        <td>
                                            <input type="number" step="1" min="1" value="1"
                                                class="form-control count" onkeyup="calculateTot()" name="count[]"
                                                required>
                                        </td>
                                        <td> --}}
                        {{-- <button class="btn btn-danger" type="button" onclick="removeRow(this)"><i
                                                    class="fa fa-trash"></i></button> --}}
                        {{-- </td>
                                    </tr>
                                </tbody> --}}
                        {{-- <tfoot>
                                    <th>
                                        Packages: <span id="type-tot"></span>
                                        <input type="hidden" name="type_tot" id="type_tot">
                                    </th>
                                    <th>
                                        Total length: <span id="len-tot"></span>
                                        <input type="hidden" name="len_tot" id="len_tot">
                                    </th>
                                    <th>
                                        Total Width: <span id="width-tot"></span>
                                        <input type="hidden" name="width_tot" id="width_tot">
                                    </th>
                                    <th>
                                        Total Height: <span id="height-tot"></span>
                                        <input type="hidden" name="height_tot" id="height_tot">
                                    </th>
                                    <th>
                                        Total Weight: <span id="weight-tot"></span>
                                        <input type="hidden" name="weight_tot" id="weight_tot">
                                    </th>
                                    <th>
                                        Content Desc <i class="text-danger">*</i>
                                    </th>
                                    <th>
                                        Value(&euro;) <i class="text-danger">*</i>
                                    </th>
                                    <th>
                                        Total Quantity: <span id="count-tot"></span>
                                        <input type="hidden" name="count_tot" id="count_tot">
                                    </th>
                                </tfoot> --}}
                        {{-- </table>
                        </div> --}}
                        <div class="repeater">
                            <div data-repeater-list="group-a">
                                <div class="text-end">
                                    <button class="btn btn-primary btn-sm" type="button" data-repeater-create><i
                                            class="fa fa-plus"></i> Add</button>
                                </div>

                                <div data-repeater-item class="mt-2">
                                    <div class="row">
                                        <div class="col">
                                            <label for="">Select Package</label>
                                            <select name="type" class="form-control type" required>
                                                <option value="">--select package type--</option>
                                                <option value="percel">Percel</option>
                                                <option value="doc">Document</option>
                                                <option value="pallet">Pallet</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="">Length</label>
                                            <input type="number" step="any" min="0" value="0"
                                                class="form-control len" name="len" required>
                                        </div>
                                        <div class="col">
                                            <label for="">Width </label>
                                            <input type="number" step="any" min="0" value="0"
                                                class="form-control width" name="width" required>
                                        </div>
                                        <div class="col">
                                            <label for="">Height </label>
                                            <input type="number" step="any" min="0" value="0"
                                                class="form-control height" name="height" required>
                                        </div>
                                        <div class="col">
                                            <label for="">Weight </label>
                                            <input type="number" step="any" min="0" value="0"
                                                class="form-control weight" name="weight" required>
                                        </div>
                                        <div class="col">
                                            <label for="">Dscription </label>
                                            <input type="text" class="form-control" name="item_desc"
                                                placeholder="Description...">
                                        </div>
                                        <div class="col">
                                            <label for="">Price </label>
                                            <input type="number" step="any" min="0" value="0.0"
                                                class="form-control itemvalue" name="item_value" required>
                                        </div>
                                        <div class="col">
                                            <label for="">Quantitty </label>
                                            <input type="number" step="1" min="1" value="1"
                                                class="form-control count" name="count" required>
                                        </div>
                                    </div>
                                    <div class="text-end mt-2">
                                        <button data-repeater-delete class="btn btn-sm btn-danger" type="button"><i
                                                class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="text-nowrap">Packages: <span id="type-tot"></span></p>
                                <input type="hidden" name="type_tot" id="type_tot">
                            </div>
                            <div class="col">
                                <p class="text-nowrap">Total: <span id="len-tot"></span></p>
                                <input type="hidden" name="len_tot" id="len_tot">
                            </div class="col">
                            <div class="col">
                                <p class="text-nowrap">Total: <span id="width-tot"></span></p>


                                <input type="hidden" name="width_tot" id="width_tot">
                            </div>
                            <div class="col">
                                <p class="text-nowrap"> Total : <span id="height-tot"></span></p>
                                <input type="hidden" name="height_tot" id="height_tot">
                            </div>
                            <div class="col">
                                <p class="text-nowrap">Total : <span id="weight-tot"></span></p>
                                <input type="hidden" name="weight_tot" id="weight_tot">
                            </div>
                            <div class="col">
                                {{-- Content <i class="text-danger">*</i> --}}
                            </div>
                            <div class="col">
                                <p class="text-nowrap">Total : <span id="itemvalue-tot"></span></p>
                                <input type="hidden" name="itemvalue_tot" id="itemvalue_tot">
                            </div>
                            <div class="col">
                                <p class="text-nowrap">Total : <span id="count-tot"></span></span></p>
                                <input type="hidden" name="count_tot" id="count_tot">
                            </div>
                        </div>
                        <button type="button" onclick="getRates()" class="btn btn-primary">Get Available Rates</button>
                        <hr>
                        <h5>Shipping Rates</h5>
                        <div class="table-responsive">
                            <table id="locations_tbl" class="table table-sm  table-bordered table-striped display">
                                <thead>
                                    <tr>
                                        <th>Select <i class="text-danger">*</i></th>
                                        <th>Name</th>
                                        <th>Time</th>
                                        <th>Locations</th>
                                        <th>Price(&euro;)</th>
                                    </tr>
                                </thead>
                                <tbody id="shipping_rate_list">

                                </tbody>

                            </table>
                        </div>
                    </div>

                    <div class="stage_2" style="display: none;">
                        <hr>
                        <h5>Addresses</h5>
                        <hr>
                        <div class="add_set">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Sender Address</h6>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="s_name">Sender Name <i class="text-danger">*</i></label>
                                            <input type="text" name="s_name" class="form-control"
                                                value="{{ auth()->user()->name }}" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="s_email">Sender Email <i class="text-danger">*</i></label>
                                            <input type="email" name="s_email" class="form-control"
                                                value="{{ auth()->user()->email }}" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="s_phone">Sender Phone <i class="text-danger">*</i></label>
                                            <input type="text" value="{{ auth()->user()->agent->phone }}"
                                                name="s_phone" class="form-control" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="s_phone_alt">Sender Phone Alt. (optional)</label>
                                            <input type="text" value="{{ auth()->user()->agent->phone_alt }}"
                                                name="s_phone_alt" class="form-control">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="s_aadress1">Address1 <i class="text-danger">*</i></label>
                                            <textarea name="s_address1" class="form-control" required>{{ auth()->user()->agent->address1 }}</textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="s_aadress2">Address 2(additional data-optional)</label>
                                            <textarea name="s_address2" class="form-control">{{ auth()->user()->agent->address2 }}</textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="s_zip">Sender zip <i class="text-danger">*</i></label>
                                            <input type="text" name="s_zip"
                                                value="{{ auth()->user()->agent->zip }}" class="form-control" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="s_city">Sender city <i class="text-danger">*</i></label>
                                            <input type="text" name="s_city"
                                                value="{{ auth()->user()->agent->city->name }}" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="s_state">Sender State/Province <i
                                                    class="text-danger">*</i></label>
                                            <input type="text" name="s_state"
                                                value="{{ auth()->user()->agent->state->name }}" class="form-control"
                                                required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="s_country">Sender Country/ Region <i
                                                    class="text-danger">*</i></label>
                                            <input type="text" name="s_country"
                                                value="{{ auth()->user()->agent->country->name }}" class="form-control"
                                                id="s_country" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="r_date">Pickup Date <i class="text-danger">*</i></label>
                                            <input type="date" name="r_date" value="{{ old('r_date') }}"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6>Receiver Address</h6>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="rx_name">Receiver Name <i class="text-danger">*</i></label>
                                            <input type="text" name="rx_name" value="{{ old('rx_name') }}"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="rx_email">Receiver Email <i class="text-danger">*</i></label>
                                            <input type="email" name="rx_email" value="{{ old('rx_email') }}"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="rx_phone">Receiver Phone <i class="text-danger">*</i></label>
                                            <input type="text" name="rx_phone" value="{{ old('rx_phone') }}"
                                                class="form-control" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="rx_phone_alt">Receiver Phone Alt. (optional)</label>
                                            <input type="text" name="rx_phone_alt" value="{{ old('rx_phone_alt') }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="rx_aadress1">Address1 <i class="text-danger">*</i></label>
                                            <textarea name="rx_address1" class="form-control" required>{{ old('rx_address1') }}</textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="rx_aadress2">Address 2(additional data-optional) <i
                                                    class="text-danger">*</i></label>
                                            <textarea name="rx_address2" value="{{ old('rx_address2') }}" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="rx_zip">Receiver zip <i class="text-danger">*</i></label>
                                            <input type="text" name="rx_zip" value="{{ old('rx_zip') }}"
                                                class="form-control" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="rx_city">Receiver city <i class="text-danger">*</i></label>
                                            <input type="text" name="rx_city" value="{{ old('rx_city') }}"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="rx_state">Receiver State/Province <i
                                                    class="text-danger">*</i></label>
                                            <input type="text" name="rx_state" value="{{ old('rx_state') }}"
                                                class="form-control" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="rx_country">Receiver Country/ Region <i
                                                    class="text-danger">*</i></label>
                                            <input type="text" name="rx_country" value="{{ old('rx_country') }}"
                                                class="form-control" id="rx_country" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <label for="cond_of_goods">Condition Of goods/ Customs Declaration</label>
                                <input type="text" name="cond_of_goods" value="{{ old('cond_of_goods') }}"
                                    class="form-control" id="cond_of_goods">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="cond_of_goods">Terms Of Sale</label>
                                <select name="terms_of_sale" id="terms_of_sale" class="form-control">
                                    <option value="">--select term--</option>
                                    <option value="GIFT">Gift</option>
                                    <option value="SOLD">Sold</option>
                                    <option value="NOT_SOLD">Not Sold</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="customs_inv_num">Invoice Numbers(comma seperated)</label>
                                <input type="text" name="customs_inv_num" value="{{ old('customs_inv_num') }}"
                                    class="form-control" id="customs_inv_num" placeholder="e.g INV-001, INV-002">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="val_of_goods">Value Of goods</label>
                                <input type="number" name="val_of_goods" value="{{ old('val_of_goods') }}"
                                    class="form-control" id="val_of_goods">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="val_cur">Curency Of Value</label>
                                <input type="text" name="val_cur" value="{{ old('val_cur') }}" class="form-control"
                                    id="val_cur">
                            </div>
                        </div>
                        <hr>
                        <p>By clicking Proceed bellow, you attest that you have read and understood our terms.</p>
                        <button type="button" class="btn btn-primary" onclick="submit_form()"><i
                                class="fa fa-save"></i>
                            Proceed</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery.repeater@1.2.1/jquery.repeater.min.js"></script>
    <script>
        $(document).ready(function() {
            function calculateTot() {
                let the_classes = ['len', 'width', 'height', 'weight',
                    'itemvalue', 'count'
                ];

                for (let i = 0; i < the_classes.length; i++) {
                    let total = 0;
                    $('.' + the_classes[i]).each(function() {
                        let value = parseFloat($(this).val()) ||
                            0;
                        total += value;
                    });
                    $('#' + the_classes[i] + '-tot').text(total.toFixed(2));
                    $('#' + the_classes[i] + '_tot').val(total.toFixed(
                        2));
                }
            }


            function calculateTotItems(item_class) {
                let total = 0;
                $('.' + item_class).each(function(i, e) {
                    if ($(this).val() != '') {
                        total = total + 1
                    }
                })
                $('#' + item_class + '-tot').text(total);
                $('#type-tot').val(total);
            }

            function bindEvents() {
                $('.len, .width, .height, .weight, .count, .itemvalue').off('keyup').on('keyup',
                    function() {
                        calculateTot();
                    });
                $('.type').off('change').on('change', function() {
                    calculateTotItems('type');
                });
            }

            $('.repeater').repeater({
                isFirstItemUndeletable: true,
                show: function() {
                    $(this).slideDown();
                    calculateTot();
                    calculateTotItems('type');
                    bindEvents();
                },
                hide: function(deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement, function() {
                            $(this).remove();
                            calculateTotItems('type');
                            calculateTot();
                        });
                    }
                }
            });

            bindEvents();
        });
        $(document).ready(function() {

            $('#ship_from_country').select2();
            $('#ship_from_city').select2();
            $('#ship_to_country').select2();
            $('#ship_to_city').select2();

            countries();

            var ship_from_country = $("#ship_from_country");
            ship_from_country.wrap('<div class="position-relative"></div>');
            ship_from_country.on('change', function() {
                $("#ship_from_city").empty()
                $('#ship_from_city').html('<option value="">Select City</option>');

                var _token = '{{ csrf_token() }}';
                let url =
                    "{{ route('ajax-get-country-cities', ['countryId' => ':countryId']) }}"
                    .replace(':countryId', $(this).val());
                if ($(this).val() > 0) {
                    // showBlockUI();
                    $.ajax({
                        url: url,
                        type: 'post',
                        dataType: 'json',
                        data: {
                            'stateId': $(this).val(),
                            '_token': _token
                        },
                        success: function(response) {
                            if (response.success) {
                                $.each(response.cities, function(key, value) {
                                    $("#ship_from_city").append('<option value="' +
                                        value
                                        .id + '">' + value.name + '</option>');
                                });
                                $("#ship_from_city").trigger('change');
                                // hideBlockUI();
                                @if (!is_null(old('residential.city')))
                                    $('#ship_from_city').val({{ old('residential.city') }});
                                    $('#ship_from_city').trigger('change')
                                @endif
                            } else {
                                // hideBlockUI();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.message,
                                    title: 'Are You Sure',
                                });
                            }
                        },
                        error: function(error) {
                            console.log(error);
                            // hideBlockUI();
                        }
                    });
                } else {
                    // hideBlockUI();
                }
                // hideBlockUI();

            });

            var ship_to_country = $("#ship_to_country");
            ship_to_country.wrap('<div class="position-relative"></div>');
            ship_to_country.on('change', function() {
                $("#ship_to_city").empty()
                $('#ship_to_city').html('<option value="">Select City</option>');

                var _token = '{{ csrf_token() }}';
                let url =
                    "{{ route('ajax-get-country-cities', ['countryId' => ':countryId']) }}"
                    .replace(':countryId', $(this).val());
                if ($(this).val() > 0) {

                    $.ajax({
                        url: url,
                        type: 'post',
                        dataType: 'json',
                        data: {
                            'stateId': $(this).val(),
                            '_token': _token
                        },
                        success: function(response) {
                            if (response.success) {
                                $.each(response.cities, function(key, value) {
                                    $("#ship_to_city").append('<option value="' +
                                        value
                                        .id + '">' + value.name + '</option>');
                                });
                                $("#ship_to_city").trigger('change');

                                @if (!is_null(old('residential.city')))
                                    $('#ship_to_city').val({{ old('residential.city') }});
                                    $('#ship_to_city').trigger('change')
                                @endif
                            } else {

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.message,
                                    title: 'Are You Sure',
                                });
                            }
                        },
                        error: function(error) {
                            console.log(error);

                        }
                    });
                } else {

                }


            });
        })


        function countries() {

            $('#ship_from_country').html('<option value="">Select Country</option>');
            $('#ship_to_country').html('<option value="">Select Country</option>');
            var _token = '{{ csrf_token() }}';
            let url = "{{ route('ajax-get-countries') }}";
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                data: {
                    '_token': _token
                },
                success: function(response) {
                    if (response.success) {
                        $.each(response.countries, function(key, value) {
                            $("#ship_from_country").append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                            $("#ship_to_country").append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }


        function submit_form() {
            if (!$('#order-form')[0].checkValidity()) {
                alert('please fill all required fields, all fileds marked * are required')
                $('#order-form')[0].reportValidity()
            } else {
                if (confirm('Are you sure you sure you wish to proceed?')) {
                    $('#order-form').submit();
                }
            }
        }
        $(document).ready(function() {
            $('#origin').autocomplete({
                source: "{{ route('locations.search') }}",
                minLength: 1,
                select: function(event, ui) {
                    // Update the hidden input field with the selected value
                    $('#origin_id').val(ui.item.value);

                    // Update the visible input field with the label
                    $('#origin').val(ui.item.label);

                    // Prevent the default behavior of filling the input with the label
                    event.preventDefault();
                }
            });

            $('#dest').autocomplete({
                source: "{{ route('locations.search') }}",
                minLength: 1,
                select: function(event, ui) {
                    // Update the hidden input field with the selected value
                    $('#dest_id').val(ui.item.value);

                    // Update the visible input field with the label
                    $('#dest').val(ui.item.label);

                    // Prevent the default behavior of filling the input with the label
                    event.preventDefault();
                }
            });

            let countries = [
                "Afghanistan",
                "Albania",
                "Algeria",
                "Andorra",
                "Angola",
                "Antigua and Barbuda",
                "Argentina",
                "Armenia",
                "Australia",
                "Austria",
                "Azerbaijan",
                "Bahamas",
                "Bahrain",
                "Bangladesh",
                "Barbados",
                "Belarus",
                "Belgium",
                "Belize",
                "Benin",
                "Bhutan",
                "Bolivia",
                "Bosnia and Herzegovina",
                "Botswana",
                "Brazil",
                "Brunei",
                "Bulgaria",
                "Burkina Faso",
                "Burundi",
                "Cabo Verde",
                "Cambodia",
                "Cameroon",
                "Canada",
                "Central African Republic",
                "Chad",
                "Chile",
                "China",
                "Colombia",
                "Comoros",
                "Congo (Congo-Brazzaville)",
                "Costa Rica",
                "Croatia",
                "Cuba",
                "Cyprus",
                "Czechia (Czech Republic)",
                "Democratic Republic of the Congo (Congo-Kinshasa)",
                "Denmark",
                "Djibouti",
                "Dominica",
                "Dominican Republic",
                "Ecuador",
                "Egypt",
                "El Salvador",
                "Equatorial Guinea",
                "Eritrea",
                "Estonia",
                "Eswatini (fmr. Swaziland)",
                "Ethiopia",
                "Fiji",
                "Finland",
                "France",
                "Gabon",
                "Gambia",
                "Georgia",
                "Germany",
                "Ghana",
                "Greece",
                "Grenada",
                "Guatemala",
                "Guinea",
                "Guinea-Bissau",
                "Guyana",
                "Haiti",
                "Holy See",
                "Honduras",
                "Hungary",
                "Iceland",
                "India",
                "Indonesia",
                "Iran",
                "Iraq",
                "Ireland",
                "Israel",
                "Italy",
                "Ivory Coast",
                "Jamaica",
                "Japan",
                "Jordan",
                "Kazakhstan",
                "Kenya",
                "Kiribati",
                "Kuwait",
                "Kyrgyzstan",
                "Laos",
                "Latvia",
                "Lebanon",
                "Lesotho",
                "Liberia",
                "Libya",
                "Liechtenstein",
                "Lithuania",
                "Luxembourg",
                "Madagascar",
                "Malawi",
                "Malaysia",
                "Maldives",
                "Mali",
                "Malta",
                "Marshall Islands",
                "Mauritania",
                "Mauritius",
                "Mexico",
                "Micronesia",
                "Moldova",
                "Monaco",
                "Mongolia",
                "Montenegro",
                "Morocco",
                "Mozambique",
                "Myanmar (formerly Burma)",
                "Namibia",
                "Nauru",
                "Nepal",
                "Netherlands",
                "New Zealand",
                "Nicaragua",
                "Niger",
                "Nigeria",
                "North Korea",
                "North Macedonia (formerly Macedonia)",
                "Norway",
                "Oman",
                "Pakistan",
                "Palau",
                "Palestine State",
                "Panama",
                "Papua New Guinea",
                "Paraguay",
                "Peru",
                "Philippines",
                "Poland",
                "Portugal",
                "Qatar",
                "Romania",
                "Russia",
                "Rwanda",
                "Saint Kitts and Nevis",
                "Saint Lucia",
                "Saint Vincent and the Grenadines",
                "Samoa",
                "San Marino",
                "Sao Tome and Principe",
                "Saudi Arabia",
                "Senegal",
                "Serbia",
                "Seychelles",
                "Sierra Leone",
                "Singapore",
                "Slovakia",
                "Slovenia",
                "Solomon Islands",
                "Somalia",
                "South Africa",
                "South Korea",
                "South Sudan",
                "Spain",
                "Sri Lanka",
                "Sudan",
                "Suriname",
                "Sweden",
                "Switzerland",
                "Syria",
                "Tajikistan",
                "Tanzania",
                "Thailand",
                "Timor-Leste",
                "Togo",
                "Tonga",
                "Trinidad and Tobago",
                "Tunisia",
                "Turkey",
                "Turkmenistan",
                "Tuvalu",
                "Uganda",
                "Ukraine",
                "United Arab Emirates",
                "United Kingdom",
                "United States of America",
                "Uruguay",
                "Uzbekistan",
                "Vanuatu",
                "Venezuela",
                "Vietnam",
                "Yemen",
                "Zambia",
                "Zimbabwe",
            ];

            // Initialize autocomplete
            $("#s_country").autocomplete({
                source: countries,
                minLength: 1 // Minimum number of characters before triggering autocomplete
            });

            // Initialize autocomplete
            $("#rx_country").autocomplete({
                source: countries,
                minLength: 1 // Minimum number of characters before triggering autocomplete
            });

            var currencies = [
                'AED - United Arab Emirates Dirham',
                'AFN - Afghan Afghani',
                'ALL - Albanian Lek',
                'AMD - Armenian Dram',
                'ANG - Netherlands Antillean Guilder',
                'AOA - Angolan Kwanza',
                'ARS - Argentine Peso',
                'AUD - Australian Dollar',
                'AWG - Aruban Florin',
                'AZN - Azerbaijani Manat',
                'BAM - Bosnia-Herzegovina Convertible Mark',
                'BBD - Barbadian Dollar',
                'BDT - Bangladeshi Taka',
                'BGN - Bulgarian Lev',
                'BHD - Bahraini Dinar',
                'BIF - Burundian Franc',
                'BMD - Bermudian Dollar',
                'BND - Brunei Dollar',
                'BOB - Bolivian Boliviano',
                'BRL - Brazilian Real',
                'BSD - Bahamian Dollar',
                'BTN - Bhutanese Ngultrum',
                'BWP - Botswanan Pula',
                'BYN - Belarusian Ruble',
                'BZD - Belize Dollar',
                'CAD - Canadian Dollar',
                'CDF - Congolese Franc',
                'CHF - Swiss Franc',
                'CLP - Chilean Peso',
                'CNY - Chinese Yuan',
                'COP - Colombian Peso',
                'CRC - Costa Rican Colón',
                'CUP - Cuban Peso',
                'CVE - Cape Verdean Escudo',
                'CZK - Czech Republic Koruna',
                'DJF - Djiboutian Franc',
                'DKK - Danish Krone',
                'DOP - Dominican Peso',
                'DZD - Algerian Dinar',
                'EGP - Egyptian Pound',
                'ERN - Eritrean Nakfa',
                'ETB - Ethiopian Birr',
                'EUR - Euro',
                'FJD - Fijian Dollar',
                'FKP - Falkland Islands Pound',
                'FKP - Falkland Islands Pound',
                'FJD - Fijian Dollar',
                'FKP - Falkland Islands Pound',
                'FJD - Fijian Dollar',
                'FKP - Falkland Islands Pound',
                'FJD - Fijian Dollar',
                'FKP - Falkland Islands Pound',
                'FJD - Fijian Dollar',
                'FKP - Falkland Islands Pound',
                'GEL - Georgian Lari',
                'GGP - Guernsey Pound',
                'GHS - Ghanaian Cedi',
                'GIP - Gibraltar Pound',
                'GMD - Gambian Dalasi',
                'GNF - Guinean Franc',
                'GTQ - Guatemalan Quetzal',
                'GYD - Guyanaese Dollar',
                'HKD - Hong Kong Dollar',
                'HNL - Honduran Lempira',
                'HRK - Croatian Kuna',
                'HTG - Haitian Gourde',
                'HUF - Hungarian Forint',
                'IDR - Indonesian Rupiah',
                'ILS - Israeli New Shekel',
                'IMP - Isle of Man Pound',
                'INR - Indian Rupee',
                'IQD - Iraqi Dinar',
                'IRR - Iranian Rial',
                'ISK - Icelandic Króna',
                'JEP - Jersey Pound',
                'JMD - Jamaican Dollar',
                'JOD - Jordanian Dinar',
                'JPY - Japanese Yen',
                'KES - Kenyan Shilling',
                'KGS - Kyrgystani Som',
                'KHR - Cambodian Riel',
                'KID - Kiribati Dollar',
                'KRW - South Korean Won',
                'KWD - Kuwaiti Dinar',
                'KYD - Cayman Islands Dollar',
                'KZT - Kazakhstani Tenge',
                'LAK - Laotian Kip',
                'LBP - Lebanese Pound',
                'LKR - Sri Lankan Rupee',
                'LRD - Liberian Dollar',
                'LSL - Lesotho Loti',
                'LYD - Libyan Dinar',
                'MAD - Moroccan Dirham',
                'MDL - Moldovan Leu',
                'MGA - Malagasy Ariary',
                'MKD - Macedonian Denar',
                'MMK - Myanma Kyat',
                'MNT - Mongolian Tugrik',
                'MOP - Macanese Pataca',
                'MRU - Mauritanian Ouguiya',
                'MUR - Mauritian Rupee',
                'MVR - Maldivian Rufiyaa',
                'MWK - Malawian Kwacha',
                'MXN - Mexican Peso',
                'MYR - Malaysian Ringgit',
                'MZN - Mozambican Metical',
                'NAD - Namibian Dollar',
                'NGN - Nigerian Naira',
                'NIO - Nicaraguan Córdoba',
                'NOK - Norwegian Krone',
                'NPR - Nepalese Rupee',
                'NZD - New Zealand Dollar',
                'OMR - Omani Rial',
                'PAB - Panamanian Balboa',
                'PEN - Peruvian Nuevo Sol',
                'PGK - Papua New Guinean Kina',
                'PHP - Philippine Peso',
                'PKR - Pakistani Rupee',
                'PLN - Polish Złoty',
                'PYG - Paraguayan Guarani',
                'QAR - Qatari Rial',
                'RON - Romanian Leu',
                'RSD - Serbian Dinar',
                'RUB - Russian Ruble',
                'RWF - Rwandan Franc',
                'SAR - Saudi Riyal',
                'SBD - Solomon Islands Dollar',
                'SCR - Seychellois Rupee',
                'SDG - Sudanese Pound',
                'SEK - Swedish Krona',
                'SGD - Singapore Dollar',
                'SHP - Saint Helena Pound',
                'SLL - Sierra Leonean Leone',
                'SOS - Somali Shilling',
                'SRD - Surinamese Dollar',
                'SSP - South Sudanese Pound',
                'STN - São Tomé and Príncipe Dobra',
                'SVC - Salvadoran Colón',
                'SYP - Syrian Pound',
                'SZL - Swazi Lilangeni',
                'THB - Thai Baht',
                'TJS - Tajikistani Somoni',
                'TMT - Turkmenistani Manat',
                'TND - Tunisian Dinar',
                'TOP - Tongan Pa\'anga',
                'TRY - Turkish Lira',
                'TTD - Trinidad and Tobago Dollar',
                'TWD - New Taiwan Dollar',
                'TZS - Tanzanian Shilling',
                'UAH - Ukrainian Hryvnia',
                'UGX - Ugandan Shilling',
                'USD - United States Dollar',
                'UYU - Uruguayan Peso',
                'UZS - Uzbekistan Som',
                'VES - Venezuelan Bolívar',
                'VND - Vietnamese Đồng',
                'VUV - Vanuatu Vatu',
                'WST - Samoan Tala',
                'XAF - Central African CFA Franc',
                'XCD - East Caribbean Dollar',
                'XOF - West African CFA Franc',
                'XPF - CFP Franc',
                'YER - Yemeni Rial',
                'ZAR - South African Rand',
                'ZMW - Zambian Kwacha',
                'ZWL - Zimbabwean Dollar',
            ];
            // Initialize autocomplete
            $("#val_cur").autocomplete({
                source: currencies,
                minLength: 1 // Minimum number of characters before triggering autocomplete
            });

        });







        function verifyTaxCode() {
            let tax_code = $('#tax_code').val();

            if (tax_code != '') {
                $.ajax({
                    url: "{{ route('tax.fetch') }}",
                    type: "GET",
                    data: {
                        tax_code: tax_code,
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        if (data.isValid == true) {
                            // Populate the "Gender" and "D.O.B" fields
                            $('#gender').val(data.gender);
                            $('#dob').val(data.dob);
                            $('#surname').val(data.surname);
                            $('#name').val(data.name);
                            $('#doc_num').val(data.doc_num);
                            $('#doc_type').val(data.doc_type);
                            $('#doc_front_img').attr('src', data.doc_front_img);
                            $('#doc_back_img').attr('src', data.doc_back_img);

                            $('#tax_code_status_text').addClass('text-success');
                            $('#tax_code_status_text').removeClass('text-danger');
                            $('#tax_code_status_text').text('Customer No / Tax Code Is Valid');

                            if (data.kyc_status == 'pending') {
                                $('#kyc_status_text').text('KYC is pending');
                            } else if (data.kyc_status == 'approved') {
                                $('#kyc_status_text').text('KYC Is Approved');
                            } else if (data.kyc_status == 'rejected') {
                                $('#kyc_status_text').text('KYC Status Is Denied');
                            } else {
                                $('#kyc_status_text').text('KYC Status Is Not Yet Set');
                            }
                        } else {
                            $('#tax_code_status_text').text(
                                'Customer No / Tax Code Is Invalid, Please fill data accordingly');
                            $('#kyc_status_text').addClass('text-danger');
                            $('#kyc_status_text').removeClass('text-success');

                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", status, error);
                        alert("An error occurred while processing your request. Please try again later.");
                    }
                });
            }
        }


        // Function to set the source of the doc_front_img when a file is selected
        function setDocFrontSrc() {
            var fileInput = document.getElementById('doc_front');
            var img = document.getElementById('doc_front_img');

            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    img.src = e.target.result;
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        }

        // Function to set the source of the doc_back_img when a file is selected
        function setDocBackSrc() {
            var fileInput = document.getElementById('doc_back');
            var img = document.getElementById('doc_back_img');

            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    img.src = e.target.result;
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        }

        // Attach the change event handlers to the file input elements
        $('#doc_front').change(setDocFrontSrc);
        $('#doc_back').change(setDocBackSrc);

        function getRates() {

            let ship_from_country = $('#ship_from_country').val();
            let ship_from_city = $('#ship_from_city').val();
            let ship_to_country = $('#ship_to_country').val();
            let ship_to_city = $('#ship_to_city').val();
            let weightTotal = $('#weight_tot').val();
            let widthTotal = $('#width_tot').val();
            let heightTotal = $('#len_tot').val();
            let lengthTotal = $('#height_tot').val();
            let valueTotal = $('#itemvalue_tot').val();
            let countTotal = $('#count_tot').val();



            $.ajax({
                url: "{{ route('rates.fetch') }}",
                type: "GET",
                data: {
                    ship_from_country: ship_from_country,
                    ship_from_city: ship_from_city,
                    ship_to_country: ship_to_country,
                    ship_to_city: ship_to_city,
                    origin: origin,
                    weightTotal: weightTotal,
                    heightTotal: heightTotal,
                    widthTotal: widthTotal,
                    lengthTotal: lengthTotal,
                    valueTotal: valueTotal,
                    countTotal: countTotal 
                },
                success: function(data) {
                    console.log(data);

                    if (data.siopay.length > 0 || data.fedex) {
                        siopay = data.siopay;
                        let fedex = data.fedex;
                        let mar = '';
                        for (let j = 0; j < siopay.length; j++) {
                            mar += `
                                    <tr>
                                        <td>
                                            <input type = 'radio' value = ${siopay[j].id} name = 'rate' id = "rate_${siopay[j].id}" required>
                                        </td>
                                        <td>
                                            ${siopay[j].name}
                                        </td>
                                        <td>
                                            ${siopay[j].transit_days} Days
                                        </td>
                                        <td>
                                            Origin: ${siopay[j].origin.name}
                                            Destination: ${siopay[j].destination.name}
                                        </td>
                                        <td>
                                            ${siopay[j].price}
                                        </td>
                                    </tr>

                                `;
                        }
                        $('#shipping_rate_list').html(mar);
                        if (fedex) {
                            mar += `
                                    <tr>
                                        <td>
                                            <input type = 'radio' value = 'FEDEX' name = 'rate' id = "rate_fedex" required>
                                        </td>
                                        <td>
                                            FedEx
                                        </td>
                                        <td>
                                            Origin: ${origin}
                                            Destination: ${dest}
                                        </td>
                                        <td>
                                            Min: ${weight}
                                            Max: ${weight}
                                        </td>
                                        <td>
                                            ${fedex}
                                        </td>
                                        <td>
                                            Width: ${width}
                                            Height: ${height}
                                            Length: ${length}
                                        </td>
                                    </tr>

                                `;
                        }
                        $('#shipping_rate_list').html(mar);
                        //show second stage of form
                        $('.stage_2').show();
                    } else {
                        console.log('No results');
                        ($('#shipping_rate_list').html(
                            '<tr><td colspan="6">No results found</td></tr>'));
                        //hide second stage of form
                        $('.stage_2').hide();
                    }
                },
                error: function(data) {
                    console.log(data);

                }
            });



        }
    </script>
@endsection
