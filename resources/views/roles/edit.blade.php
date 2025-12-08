@extends('dashboard.layouts.master')
@section('title')
    تعديل الدور
@endsection
@section('css')
@endsection

@section('content')
  <br>
  <div class="container" style="font-size: large">
      <h2>تعديل الدور</h2>
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

      <form  style="font-size: x-large" action="{{ route('roles.update', $role->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="form-group mb-3">
              <label>اسم الدور</label>
              <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
          </div>
          <div class="form-group mb-3">
              <label>الوصف</label>
              <textarea name="description" class="form-control" rows="3">{{ $role->description }}</textarea>
          </div>
          <h4>الصلاحيات</h4>
          <div class="row">
              @foreach($permissions as $permission)
                  <div class="col-md-3">
                      <label>
                          <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                              {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                          {{ $permission->name }}
                      </label>
                  </div>
              @endforeach
          </div>

          {{-- Submit --}}
          <button type="submit" class="btn btn-primary">تحديث الدور</button>
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