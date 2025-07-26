@extends('layouts.app')

@include('layouts.sidebar')

<style>
    /* Main Form Container */


    #frontier-form-container {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        padding: 30px;
        margin: 20px auto;
        border: 1px solid #e0e6ed;
        max-width: 1200px;

    }

    /* Form Title */
    .form-main-title {
        color: #2c3e50;
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 2px solid #3498db;
        position: relative;
        text-align: center;
    }

    /* Form Group Layout */
    .form-vertical-group {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    /* Input Groups - 4 columns */
    .form-input-row {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 20px;
        align-items: start;
    }

    /* Individual Input Fields */
    .form-field,
    .input-field {
        margin-bottom: 0;
        min-width: 0;
        display: flex;
        flex-direction: column;
    }

    .form-field-label,
    .input-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #2c3e50;
        font-size: 14px;
    }

    /* Form Controls - Equal width for all inputs */
    .form-input-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #e0e6ed;
        border-radius: 6px;
        background-color: #f8fafc;
        transition: all 0.3s ease;
        font-size: 14px;
        color: #3c4858;
        height: 42px;
        box-sizing: border-box;
    }

    /* Special styling for date inputs */
    .form-date-input {
        appearance: none;
        -webkit-appearance: none;
    }

    /* Special styling for time inputs */
    .form-time-input {
        appearance: none;
        -webkit-appearance: none;
    }

    .form-input-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        background-color: #ffffff;
        outline: none;
    }

    /* Readonly Fields */
    .form-readonly-input {
        background-color: #f1f5f9;
        color: #64748b;
        cursor: not-allowed;
    }

    /* Select Dropdowns */
    .form-select-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2364748b' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        background-size: 12px;
    }

    /* Error Messages */
    .form-error-message {
        font-size: 12px;
        color: #ef4444;
        margin-top: 5px;
        display: block;
        font-weight: 500;
    }

    /* Submit Button */
    .form-submit-section {
        margin-top: 30px;
        text-align: center;
    }

    .btn-form-submit {
        background-color: #3498db;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-form-submit:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(41, 128, 185, 0.3);
    }

    .btn-form-submit:active {
        transform: translateY(0);
    }

    .btn-icon {
        margin-right: 8px;
        font-size: 14px;
    }

    /* Responsive Adjustments */
    @media (max-width: 1200px) {
        .form-input-row {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 768px) {
        .form-input-row {
            grid-template-columns: minmax(0, 1fr);
        }

        #frontier-form-container {
            padding: 20px;
        }

        .form-main-title {
            font-size: 1.3rem;
        }
    }
</style>


@section('content')
@include('layouts.header')


<div>
    <div class="card mt-4 profile-form-container" style="padding: 35px;">

        <h4 class="mb-4 text-primary">User Profile Update Frontier Information </h4>


        <form method="POST" action="{{ route('admin.frontier.update', $userdata->id) }}" id="frontier-update-form">
            @csrf
            @method('PUT')
            <div class="form-vertical-group">
                <!-- First Row of Inputs -->
                <div class="form-input-row">
                    <div class="form-field">
                        <label class="form-field-label">Created Date</label>
                        <input type="date" name="created_at" class="form-input-control form-date-input"
                            value="{{ old('created_at', $userdata->created_at ? $userdata->created_at->format('Y-m-d') : '') }}">
                        @error('created_at') <small class="form-error-message">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-field">
                        <label class="form-field-label">First Name</label>
                        <input type="text" name="first_name" class="form-input-control"
                            value="{{ old('first_name', $userdata->user->name ?? '') }}">
                        @error('first_name') <small class="form-error-message">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-field">
                        <label class="form-field-label">Last Name</label>
                        <input type="text" name="last_name" class="form-input-control"
                            value="{{ old('last_name', $userdata->user->last_name ?? '') }}">
                        @error('last_name') <small class="form-error-message">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-field">
                        <label class="form-field-label">Corp ID</label>
                        <input type="text" name="corp_id" class="form-input-control" placeholder="Enter Corp ID"
                            value="{{ old('corp_id', $userdata->corp_id) }}">
                        @error('corp_id') <small class="form-error-message">{{ $message }}</small> @enderror
                    </div>
                </div>

                <!-- Second Row of Inputs -->
                <div class="form-input-row">
                    <div class="form-field">
                        <label class="form-field-label">Address</label>
                        <input type="text" name="address" class="form-input-control" placeholder="Enter Address"
                            value="{{ old('address', $userdata->address) }}">
                        @error('address') <small class="form-error-message">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-field">
                        <label class="form-field-label">Billing TN</label>
                        <input type="text" name="billing_TN" class="form-input-control" placeholder="Enter Billing TN"
                            value="{{ old('billing_TN', $userdata->billing_TN) }}">
                        @error('billing_TN') <small class="form-error-message">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-field">
                        <label class="form-field-label">Order Number</label>
                        <input type="text" name="order_number" class="form-input-control"
                            placeholder="Enter Order Number" value="{{ old('order_number', $userdata->order_number) }}">
                        @error('order_number') <small class="form-error-message">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-field">
                        <label class="form-field-label">Install T.T. Soc TTC</label>
                        <select name="install_T_T_Soc_TTC" id="install-tt-soc"
                            class="form-input-control form-select-control">
                            <option value="">-- Select Option --</option>
                            <option value="SOC" {{ old('install_T_T_Soc_TTC',$userdata->install_T_T_Soc_TTC)=='SOC' ?
                                'selected' : '' }}>SOC</option>
                            <option value="TT" {{ old('install_T_T_Soc_TTC',$userdata->install_T_T_Soc_TTC)=='TT' ?
                                'selected' : '' }}>TT</option>
                        </select>
                        @error('install_T_T_Soc_TTC') <small class="form-error-message">{{ $message }}</small> @enderror
                    </div>
                </div>

                <!-- Third Row of Inputs -->
                <div class="form-input-row">
                    <div class="form-field">
                        <label class="form-field-label">ONT NTD</label>
                        <select name="ont_Ntd" id="ont-ntd" class="form-input-control form-select-control">
                            <option value="">-- Select Option --</option>
                            <option value="YES" {{ old('ont_Ntd',$userdata->ont_Ntd)=='YES' ? 'selected' : '' }}>YES
                            </option>
                            <option value="NO" {{ old('ont_Ntd',$userdata->ont_Ntd)=='NO' ? 'selected' : '' }}>NO
                            </option>
                        </select>
                        @error('ont_Ntd') <small class="form-error-message">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-field">
                        <label class="form-field-label">Comp or Refer</label>
                        <select name="comp_or_refer" id="comp-refer" class="form-input-control form-select-control">
                            <option value="">-- Select Option --</option>
                            <option value="COMP" {{ old('comp_or_refer', $userdata->comp_or_refer)=='COMP' ? 'selected'
                                : '' }}>COMP</option>
                            <option value="REFER" {{ old('comp_or_refer',$userdata->comp_or_refer)=='REFER' ? 'selected'
                                : '' }}>REFER</option>
                        </select>
                        @error('comp_or_refer') <small class="form-error-message">{{ $message }}</small> @enderror
                    </div>


                    @php
                    $codes = billingCodes();
                    @endphp

                    <div class="input-field">
                        <label class="input-label">Billing Code</label>
                        <select name="billing_code" id="billing_code" class="form-control">
                            <option value="">-- Select Billing Code --</option>
                            @foreach($codes as $code => $data)
                            <option value="{{ $code }}" {{ old('billing_code', $userdata->billing_code)==$code ?
                                'selected' : '' }}>
                                {{ $code }}
                            </option>
                            @endforeach
                        </select>
                        @error('billing_code') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-field">
                        <label class="form-field-label">Quantity</label>
                        <input type="number" name="qty" id="quantity" class="form-input-control"
                            placeholder="Enter Quantity" value="{{ old('qty', $userdata->qty) }}">
                        @error('qty') <small class="form-error-message">{{ $message }}</small> @enderror
                    </div>
                </div>

                <!-- Fourth Row of Inputs -->
                <div class="form-input-row">
                    <div class="form-field">
                        <label class="form-field-label">Description</label>
                        <input type="text" name="description" id="description"
                            class="form-input-control form-readonly-input" placeholder="Enter Description"
                            value="{{ old('description') }}" readonly>
                        @error('description') <small class="form-error-message">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-field">
                        <label class="form-field-label">Rate</label>
                        <input type="text" name="rate" id="rate" class="form-input-control form-readonly-input"
                            placeholder="Enter Rate" value="{{ old('rate') }}" readonly>
                        @error('rate') <small class="form-error-message">{{ $message }}</small> @enderror
                    </div>

                    <div class="input-field">
                        <label class="input-label">Total Billed</label>
                        <input type="text" name="total_billed" id="total_billed" class="form-control"
                            placeholder="Enter Total Billed" value="{{ old('total_billed') }}" readonly>
                        @error('total_billed') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-field">
                        <label class="form-field-label">Aerial Buried</label>
                        <input type="text" name="aerial_buried" id="aerial-buried" class="form-input-control"
                            placeholder="Enter Aerial Buried"
                            value="{{ old('aerial_buried', $userdata->aerial_buried) }}">
                        @error('aerial_buried') <small class="form-error-message">{{ $message }}</small> @enderror
                    </div>
                </div>

                <!-- Fifth Row of Inputs -->
                <div class="form-input-row">
                    <div class="form-field">
                        <label class="form-field-label">Fiber</label>
                        <input type="text" name="fiber" id="fiber" class="form-input-control" placeholder="Enter Fiber"
                            value="{{ old('fiber', $userdata->fiber) }}">
                        @error('fiber') <small class="form-error-message">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-field">
                        <label class="form-field-label">Closeout Notes</label>
                        <input type="text" name="closeout_notes" id="closeout-notes" class="form-input-control"
                            placeholder="Enter Closeout Notes"
                            value="{{ old('closeout_notes', $userdata->closeout_notes) }}">
                        @error('closeout_notes') <small class="form-error-message">{{ $message }}</small> @enderror
                    </div>

                    <div class="input-field">
                        <label class="input-label">In</label>
                        <input type="time" name="in" id="in" class="form-control" value="{{ old('in',$userdata->in) }}">
                        @error('in') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="input-field">
                        <label class="input-label">Out</label>
                        <input type="time" name="out" id="out" class="form-control"
                            value="{{ old('out',$userdata->out) }}">
                        @error('out') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <!-- Sixth Row (remaining fields) -->
                <div class="form-input-row">
                    <div class="input-field">
                        <label class="input-label">Hours</label>
                        <input type="number" name="hours" id="hours" value="{{ old('out',$userdata->hours) }}"
                            class="form-control" step="0.1" readonly>
                        @error('hours') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Empty fields to maintain grid layout -->
                    <div class="form-field"></div>
                    <div class="form-field"></div>
                    <div class="form-field"></div>
                </div>
            </div>

            <div class="form-submit-section">
                <button type="submit" class="btn-form-submit">
                    <i class="fas fa-save btn-icon"></i> Update Information
                </button>
            </div>

            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        </form>

    </div>

</div>

@if(session('redirect_to_report'))
<script>
    window.onload = function () {
            // 👇 this line is same as if you clicked the Report tab manually
            showSection('report-section');

            // ✅ Show SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('update_success') }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        };
</script>
@endif

<script>
    const billingData = @json(billingCodes());

    document.getElementById('billing_code').addEventListener('change', function () {
        const selected = this.value;
        const data = billingData[selected];

        if (data) {
            document.getElementById('description').value = data.description;
            document.getElementById('rate').value = data.rate;
            document.getElementById('total_billed').value = data.rate;
        } else {
            document.getElementById('description').value = '';
            document.getElementById('rate').value = '';
            document.getElementById('total_billed').value = '';
        }
    });

    // Trigger on load (if user selected something before error)
    window.addEventListener('DOMContentLoaded', () => {
        document.getElementById('billing_code').dispatchEvent(new Event('change'));
    });
</script>

<script>
    function calculateHours() {
        const inTime = document.getElementById('in').value;
        const outTime = document.getElementById('out').value;

        if (inTime && outTime) {
            const [inHours, inMinutes] = inTime.split(':').map(Number);
            const [outHours, outMinutes] = outTime.split(':').map(Number);

            const inDate = new Date(0, 0, 0, inHours, inMinutes);
            const outDate = new Date(0, 0, 0, outHours, outMinutes);

            let diff = (outDate - inDate) / (1000 * 60 * 60); // in hours

            // Handle next day
            if (diff < 0) diff += 24;

            document.getElementById('hours').value = diff.toFixed(2);
        }
    }

    document.getElementById('in').addEventListener('change', calculateHours);
    document.getElementById('out').addEventListener('change', calculateHours);
</script>
@endsection