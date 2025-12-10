@extends('dashboard.layouts.master')
@section('title')
  تعديل الجهاز
@endsection
@section('css')
@endsection

@section('content')

  <div class="container" style="font-size: x-large;">
      <h2>نعديل الجهاز</h2>
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

      <form action="{{ route('devices.update', $device->id) }}" method="POST">
          @csrf
          @method('PUT')

          {{-- Device Name --}}
          <div class="mb-3">
            <label class="form-label">اسم الجهاز</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $device->name) }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          {{-- Serial Number --}}
          <div class="mb-3">
            <label class="form-label">الرقم التسلسلي</label>
            <input type="text" name="serial_number" class="form-control"
              value="{{ old('serial_number', $device->serial_number) }}" required>
            @error('serial_number') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          {{-- Barcode (read-only) --}}
          <div class="mb-3">
            <label class="form-label">الباركود</label>
            <input type="text" class="form-control" value="{{ $device->barcode }}" readonly>
          </div>

          {{-- Status --}}
          <div class="mb-3">
            <label class="form-label">حالة الاعارة</label>
            <select name="status" class="form-control">
              <option value="1" {{ $device->status ? 'selected' : '' }}>نعم</option>
              <option value="0" {{ !$device->status ? 'selected' : '' }}>لا</option>
            </select>
            @error('status') <small class="text-danger">{{ $message }}</small> @enderror
          </div>


          {{-- Submit --}}
          <button type="submit" class="btn btn-primary">تعديل الجهاز</button>
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