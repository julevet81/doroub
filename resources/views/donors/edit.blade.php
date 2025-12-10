@extends('dashboard.layouts.master')
@section('title')
  Edit project
@endsection
@section('css')
@endsection

@section('content')

  <div class="container">
      <h2>Edit project</h2>
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

      <form action="{{ route('projects.update', $project->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="row">

            {{-- Full Name --}}
            <div class="col-md-6 mb-3">
              <label class="form-label">الاسم الكامل</label>
              <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $donor->full_name) }}" required>
              @error('full_name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Activity --}}
            <div class="col-md-6 mb-3">
              <label class="form-label">النشاط (فريد)</label>
              <input type="text" name="activity" class="form-control" value="{{ old('activity', $donor->activity) }}" required>
              @error('activity') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Phone --}}
            <div class="col-md-6 mb-3">
              <label class="form-label">رقم الهاتف</label>
              <input type="text" name="phone" class="form-control" value="{{ old('phone', $donor->phone) }}">
              @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Assistance Category --}}
            <div class="col-md-6 mb-3">
              <label class="form-label">فئة المساعدة</label>
              <select name="assistance_category_id" class="form-control" required>
                <option value="">-- اختر الفئة --</option>

                @foreach($assistanceCategories as $cat)
                  <option value="{{ $cat->id }}" {{ old('assistance_category_id', $donor->assistance_category_id) == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                  </option>
                @endforeach
              </select>
              @error('assistance_category_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Description --}}
            <div class="col-12 mb-3">
              <label class="form-label">الوصف</label>
              <textarea name="description" class="form-control" rows="3">{{ old('description', $donor->description) }}</textarea>
              @error('description') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
          </div>
          {{-- Submit --}}
          <button type="submit" class="btn btn-primary">Update project</button>
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