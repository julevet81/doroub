@extends('dashboard.layouts.master')
@section('title')
    تعديل الاعارة
@endsection
@section('css')
@endsection

@section('content')
  <br>
  <div class="container" style="font-size: large">
      <h2>تعديل الاعارة</h2>
      <div>
          {{-- Show Success Message --}}
          @if(session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          @endif
          @if($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
      </div>

      <form  style="font-size: x-large" action="{{ route('loans.update', $demond->id) }}" method="POST">
          @csrf
          @method('PUT')

          {{-- DEVICE --}}
          <div class="row mb-3">
            <div class="col">
              <label>الجهاز</label>
              <select name="device_id" class="form-control" required>
                @foreach($devices as $device)
                  <option value="{{ $device->id }}" {{ $loan->device_id == $device->id ? 'selected' : '' }}>
                    {{ $device->name }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>

          {{-- BENEFICIARY TYPE --}}
          <div class="row mb-3">
            <div class="col">
              <label>نوع المستفيد</label>
              <select id="beneficiary_type" name="beneficiary_type" class="form-control" required>
                <option value="existing" {{ !$loan->new_beneficiary ? 'selected' : '' }}>مسجل</option>
                <option value="new" {{ $loan->new_beneficiary ? 'selected' : '' }}>جديد</option>
              </select>
            </div>
          </div>

          {{-- EXISTING BENEFICIARY --}}
          <div id="existing_beneficiary_section" style="display: {{ !$loan->new_beneficiary ? 'block' : 'none' }}">
            <div class="row mb-3">
              <div class="col">
                <label>المستفيد</label>
                <select name="beneficiary_id" class="form-control">
                  @foreach($beneficiaries as $b)
                    <option value="{{ $b->id }}" {{ $loan->beneficiary_id == $b->id ? 'selected' : '' }}>
                      {{ $b->full_name }} - {{ $b->barcode }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          {{-- NEW BENEFICIARY --}}
          <div id="new_beneficiary_section"
            style="display: {{ $loan->new_beneficiary ? 'block' : 'none' }}; border: 2px solid #ccc; padding: 15px; border-radius: 10px;">

            @if($loan->new_beneficiary)
              @php $b = $loan->beneficiary; @endphp
            @endif

            <h4>تعديل بيانات المستفيد الجديد</h4>

            <input type="hidden" name="new_beneficiary" value="1">

            <div class="row">
              <div class="col">
                <label>الاسم</label>
                <input type="text" name="full_name" class="form-control"
                  value="{{ $loan->new_beneficiary ? $b->full_name : '' }}">
              </div>

              <div class="col">
                <label>تاريخ الميلاد</label>
                <input type="date" name="date_of_birth" class="form-control"
                  value="{{ $loan->new_beneficiary ? $b->date_of_birth : '' }}">
              </div>
            </div>

            <div class="row mt-3">
              <div class="col">
                <label>مكان الميلاد</label>
                <input type="text" name="place_of_birth" class="form-control"
                  value="{{ $loan->new_beneficiary ? $b->place_of_birth : '' }}">
              </div>

              <div class="col">
                <label>الهاتف</label>
                <input type="text" name="phone_1" class="form-control" value="{{ $loan->new_beneficiary ? $b->phone_1 : '' }}">
              </div>
            </div>

            {{-- يمكنك إضافة بقية الحقول إن أردت --}}
          </div>

          {{-- LOAN DATA --}}
          <hr>

          <div class="row mt-3">
            <div class="col">
              <label>التاريخ</label>
              <input type="date" name="loan_date" class="form-control" value="{{ $loan->loan_date }}" required>
            </div>

            <div class="col">
              <label>الحالة</label>
              <select name="status" class="form-control">
                <option value="active" {{ $loan->status == 'active' ? 'selected' : '' }}>نشط</option>
                <option value="returned" {{ $loan->status == 'returned' ? 'selected' : '' }}>معاد</option>
              </select>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col">
              <label>ملاحظات</label>
              <textarea name="notes" class="form-control">{{ $loan->notes }}</textarea>
            </div>
          </div>

          {{-- Submit --}}
          <button type="submit" class="btn btn-primary">تحديث المستخدم</button>
      </form>
  </div>
@endsection
@section('scripts')
  <script>
    document.getElementById('beneficiary_type').addEventListener('change', function () {
      let type = this.value;

      document.getElementById('existing_beneficiary_section').style.display =
        type === 'existing' ? 'block' : 'none';

      document.getElementById('new_beneficiary_section').style.display =
        type === 'new' ? 'block' : 'none';
    });
  </script>

@endsection