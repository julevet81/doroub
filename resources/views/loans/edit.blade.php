@extends('dashboard.layouts.master')
@section('title')
    تعديل المستخدم
@endsection
@section('css')
@endsection

@section('content')
  <br>
  <div class="container" style="font-size: large">
      <h2>تعديل الطلب</h2>
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

      <form  style="font-size: x-large" action="{{ route('demonds.update', $demond->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-3">
              <label for="beneficiary_id" class="form-label">المستفيد</label>
              <select name="beneficiary_id" id="beneficiary_id" class="form-control" required style="font-size: x-large">
                  <option value="">اختر المستفيد</option>
                  @foreach($beneficiaries as $beneficiary)
                      <option value="{{ $beneficiary->id }}" {{ $demond->beneficiary_id == $beneficiary->id ? 'selected' : '' }}>
                          {{ $beneficiary->full_name }}
                      </option>
                  @endforeach
              </select>
          </div>

          <div class="mb-3">
              <label for="demand_date" class="form-label">تاريخ الطلب</label>
              <input type="date" name="demand_date" id="demand_date" class="form-control" required style="font-size: x-large" value="{{ $demond->demand_date->format('Y-m-d') }}">
          </div>

          <div id="items-container">
            <h4 style="font-size: x-large">عناصر المساعدة المطلوبة</h4>
            @foreach($demond->items as $index => $item)
              <div class="row mb-2 item-row">
                  <div class="col">
                      <select name="items[{{ $index }}][assistance_item_id]" class="form-control" required style="font-size: x-large">
                          <option value="">اختر العنصر</option>
                          @foreach($assistance_items as $assistance_item)
                              <option value="{{ $assistance_item->id }}" {{ $item->assistance_item_id == $assistance_item->id ? 'selected' : '' }}>
                                  {{ $assistance_item->name }}
                              </option>
                          @endforeach
                      </select>
                  </div>

                  <div class="col">
                      <input type="number" name="items[{{ $index }}][quantity]" class="form-control" min="1" placeholder="الكمية" required style="font-size: x-large" value="{{ $item->quantity }}">
                  </div>
              </div>
            @endforeach
          </div>
          <button type="button" id="add-item" class="btn btn-secondary mb-3">إضافة عنصر آخر</button>

          <div class="mb-3">
              <label for="description" class="form-label">الوصف</label>
              <textarea name="description" id="description" class="form-control" style="font-size: x-large" rows="4">{{ $demond->description }}</textarea>
          </div>



          {{-- Submit --}}
          <button type="submit" class="btn btn-primary">تحديث المستخدم</button>
      </form>
  </div>
@endsection
@section('scripts')
  <script>
    document.addEventListener("DOMContentLoaded", function () {

      function checkAssignment(type, id, warningId) {
        if (!id) {
          document.getElementById(warningId).innerText = '';
          return;
        }

        fetch("{{ url('check-assignment') }}/" + type + "/" + id)
          .then(res => res.json())
          .then(data => {
            if (data.assigned) {
              document.getElementById(warningId).innerText = `⚠️ This ${type} is already assigned to another project.`;
            } else {
              document.getElementById(warningId).innerText = '';
            }
          })
          .catch(err => console.error(err));
      }

      document.getElementById('owner_id').addEventListener('change', function () {
        checkAssignment('owner', this.value, 'owner-warning');
      });

      document.getElementById('phone_id').addEventListener('change', function () {
        checkAssignment('phone', this.value, 'phone-warning');
      });

      document.getElementById('device_id').addEventListener('change', function () {
        checkAssignment('device', this.value, 'device-warning');
      });

      document.getElementById('credit_card_id').addEventListener('change', function () {
        checkAssignment('credit_card', this.value, 'credit-warning');
      });

      document.getElementById('network_id').addEventListener('change', function () {
        checkAssignment('network', this.value, 'network-warning');
      });

    });
  </script>

@endsection