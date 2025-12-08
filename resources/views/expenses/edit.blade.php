@extends('dashboard.layouts.master')
@section('title')
  تعديل مصروف
@endsection
@section('css')
@endsection

@section('content')

  <div class="container">
      <h2>تعديل مصروف</h2>
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

      <form action="{{ route('expenses.update', $expense->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group">
              <label for="amount">المبلغ:</label>
              <input type="number" name="amount" id="amount" class="form-control" value="{{ $expense->amount }}" required>
          </div>
          <div class="form-group">
              <label for="transaction_date">تاريخ المعاملة:</label>
              <input type="date" name="transaction_date" id="transaction_date" class="form-control" value="{{ $expense->transaction_date }}" required>
          </div>
          <div class="form-group">
              <label for="out_orientation">التوجيه:</label>
              <select name="out_orientation" id="out_orientation" class="form-control" required>
                  <option value="project" {{ $expense->out_orientation == 'project' ? 'selected' : '' }}>المشروع</option>
                  <option value="sponsored_family" {{ $expense->out_orientation == 'sponsored_family' ? 'selected' : '' }}>المخزون</option>
                  <option value="services" {{ $expense->out_orientation == 'services' ? 'selected' : '' }}>خدمات مكتبية</option>
                  <option value="electricity" {{ $expense->out_orientation == 'electricity' ? 'selected' : '' }}>مصاريف كهرباء</option>
                  <option value="maintenance" {{ $expense->out_orientation == 'maintenance' ? 'selected' : '' }}>مصاريف صيانة</option>
                  <option value="internet" {{ $expense->out_orientation == 'internet' ? 'selected' : '' }}>مصاريف انترنت</option>
                  <option value="cleaning" {{ $expense->out_orientation == 'cleaning' ? 'selected' : '' }}>مواد تنظيف</option>
                  <option value="generals" {{ $expense->out_orientation == 'generals' ? 'selected' : '' }}>مصاريف عامة</option>
              </select>
          </div>
          <div class="col">
            <label for="attachment" class="control-label" style="font-size: x-large">الفاتورة</label>
            <input type="file" name="attachment" id="attachment" class="form-control" style="font-size: large">
        </div>
          <div class="form-group">
              <label for="notes">يصرف لأمر:</label>
              <textarea name="notes" id="notes" class="form-control" rows="3">{{ $expense->notes }}</textarea>
          </div>


          {{-- Submit --}}
          <button type="submit" class="btn btn-primary">تحديث المصروف</button>
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