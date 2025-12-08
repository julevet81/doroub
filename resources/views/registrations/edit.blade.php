@extends('dashboard.layouts.master')
@section('title')
    تعديل المستخدم
@endsection
@section('css')
@endsection

@section('content')
  <br>
  <div class="container" style="font-size: large">
      <h2>تعديل المستخدم</h2>
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

      <form  style="font-size: x-large" action="{{ route('users.update', $user->id) }}" method="POST">
          @csrf
          @method('PUT')

          {{-- user Name --}}
          <div class="mb-3">
              <label for="name" class="form-label">الاسم</label>
              <input type="text" name="name" id="name"
                     value="{{ old('name', $user->name) }}"
                     class="form-control" required>
          </div>
          
          <div class="mb-3">
              <label for="email" class="form-label">البريد الإلكتروني</label>
              <input type="email" name="email" id="email"
                     value="{{ old('email', $user->email) }}"
                     class="form-control" required>
          </div>
          {{-- user Phone --}}
          <div class="mb-3">
              <label for="phone" class="form-label">رقم الهاتف</label>
              <input type="text" name="phone" id="phone"
                     value="{{ old('phone', $user->phone) }}"
                     class="form-control" required>
          </div>
          {{-- user Address --}}
          <div class="mb-3">
              <label for="address" class="form-label">العنوان</label>
              <input type="text" name="address" id="address"  
                     value="{{ old('address', $user->address) }}"
                     class="form-control" required>
          </div>
          {{-- User Role --}}
          <div class="mb-3">
              <label for="role_id" class="form-label">الدور</label>
              <select name="role_id" id="role_id" class="form-control" required>
                  <option value="" disabled>اختر الدور</option>
                  @foreach($roles as $role)
                      <option value="{{ $role->id }}"
                          {{ (old('role_id', $user->role->name ?? '') == $role->id) ? 'selected' : '' }}>
                          {{ $role->name }}
                      </option>
                  @endforeach
              </select>
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